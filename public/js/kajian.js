$(function() {
    var base_url = window.location.origin;

    /* Setting CSRF TOKEN */
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    $(document).on("click", ".new-kajian", e => {
        e.preventDefault();

        /* Open modal*/
        $("#modal").iziModal("open");
    });

    /* Image Preview Helper */
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $("#modal #img-preview")
                    .parent()
                    .css("display", "block");
                $("#modal #img-preview").attr("src", e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    /* Instantiating iziModal */
    $("#modal").iziModal({
        title: "Buat Kajian",
        subtitle: "Ketik sebuah jadwal kajian yang akan kamu buat",
        icon: "fa fa-edit fa-lg",
        headerColor: "rgba(138, 144, 255, 0.9)",
        top: 10,
        overlayClose: false,
        overlayColor: "rgba(0, 0, 0, 0.6)",
        afterRender: function() {
            $("#modal #cities").select2({});
            $("#modal #districts").select2({});
        },
        onOpening: function(modal) {
            modal.startLoading();
            ajaxGET("cities", "#cities", modal);
        },
        onOpened: function(modal) {
            $("#modal").on("change", "#cities", function() {
                let _id = $(this).val();

                if (!_id) {
                    modal.startLoading();
                    ajaxGET("cities", "#cities", modal);
                }

                modal.startLoading();
                ajaxGET("" + _id + "/districts", "#districts", modal);
            });

            $("#modal").on("change", "#image", function() {
                readURL(this);
            });

            let rules = {
                description: "required",
                image: {
                    maxsize: 2048000,
                    extension: "jpg|jpeg|png"
                }
            };

            let message = {
                description: {
                    required: "Kolom harus diisi!"
                },
                image: {
                    maxsize: "Ukuran maksimal foto 2 MB",
                    extension:
                        "File harus berekstensikan *.jpg, *.jpeg atau *.png"
                }
            };

            formValidation("#form", rules, message, "/kajian", "POST");
        }
    });

    /* Form Validation */
    function formValidation(idForm, rules = {}, message = {}, to, method) {
        $("#modal " + idForm).validate({
            rules: rules,
            messages: message,
            highlight: function(element) {
                $(element)
                    .closest(".form-group")
                    .addClass("has-error");
            },
            unhighlight: function(element) {
                $(element)
                    .closest(".form-group")
                    .removeClass("has-error");
            },
            errorElement: "span",
            errorClass: "help-block",
            errorPlacement: function(element, e) {
                e.parent(".input-group").length
                    ? element.insertAfter(e.parent())
                    : e.parent(".select2-selection").length
                    ? element.insertAfter(e.parent(".select2-selection"))
                    : e.parent("label").length
                    ? element.insertBefore(e.parent())
                    : element.insertAfter(e);
            },
            submitHandler: function(form) {
                let formData = new FormData($(form)[0]);
                let userId;

                $.ajax({
                    url: "/user/data",
                    success: d => {
                        $(idForm + ' button[type="submit"]').attr(
                            "disabled",
                            true
                        );

                        formData.append("user_id", d.data.id);

                        $.ajax({
                            url: to,
                            data: formData,
                            method: method,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: res => {
                                let data = res.data || {};

                                $(idForm + ' button[type="submit"]').attr(
                                    "disabled",
                                    false
                                );

                                if (!res.success) {
                                    iziToast.error({
                                        transitionIn: "flipInX",
                                        transitionOut: "bounceInDown",
                                        transitionInMobile: "flipInX",
                                        transitionOutMobile: "bounceInDown",
                                        title: res.title + "!",
                                        message: res.message,
                                        position: "bottomRight"
                                    });
                                } else {
                                    $(form)[0].reset();
                                    $("#modal").iziModal("close");
                                    getData();

                                    iziToast.success({
                                        transitionIn: "flipInX",
                                        transitionOut: "bounceInDown",
                                        transitionInMobile: "flipInX",
                                        transitionOutMobile: "bounceInDown",
                                        title: res.title + "!",
                                        message: res.message,
                                        position: "bottomLeft"
                                    });
                                }
                            },
                            error: err => {
                                $(idForm + ' button[type="submit"]').attr(
                                    "disabled",
                                    false
                                );

                                console.log(err);
                            }
                        });
                    }
                });

                console.log(userId);
            }
        });
    }

    /* Helper AJAX GET and append to SELECT */
    function ajaxGET(url, idSelect, modal) {
        $.ajax({
            url: base_url + "/api/v1/" + url,
            method: "GET",
            success: res => {
                $("#modal " + idSelect).html("");
                $("#modal " + idSelect).html(
                    `<option value="">-- Pilih salah satu -- </option>`
                );
                $.each(res.data, (k, v) => {
                    $("#modal " + idSelect).append(
                        `
                            <option value="${v.id}">${v.name}</option>
                        `
                    );
                });

                modal.stopLoading();
            },
            error: err => {
                console.log(err);
            }
        });
    }

    /**
     * GET Data Kajian
     */
    getData();
    function getData() {
        $.ajax({
            url: "/api/v1/kajian",
            method: "GET",
            beforeSend: () => {
                $(".posts-kajian").html("");
                $(".posts-kajian").append(
                    `
                <p class="posts-not-found">Mohon tunggu sebentar .. </p>
                `
                );
            },
            success: res => {

                $(".posts-kajian").html("");
                let imgProfileModal = $(".modal-profile-img");

                const _postKajian = $(".posts-kajian");
                if (!res.success) {
                    $.ajax({
                        url: "/user/data",
                        success: data => {
                            if (data.success) {
                                _postKajian.append(
                                    `<div class="single-widget">
                            <p class="posts-not-found mt-10">${res.message}</p>
                            <p class="posts-not-found">
                                <a href="javascript:void(0)" class="btn btn-link btn-sm border-primary new-kajian">Buat Kajian</a>
                            </p>
                            </div>
                                `
                                );
                            } else {
                                _postKajian.append(
                                    `
                                    <div class="single-widget">
                            <p class="posts-not-found mt-10">${res.message}</p>
                            </div>
                            `
                                );
                            }
                        }
                    });
                } else {

                    $.each(res.data, (k, v) => {
                        // console.log(v);

                        let user = v.user;
                        let post = v;

                        let $isLogin = isLogin(v);

                        imgProfileModal.attr(
                            "src",
                            "/assets/images/users/" + user.image
                        ).attr("alt", user.name);


                        _postKajian.append(
                            `
                        <div class="single-widget">
                            <div class="post-list blog-post-list mb-10">
                                <div class="single-post">

                                    <div class="nav-post">
                                        <img class="img-fluid" src="/assets/images/users/${
                                            user.image
                                        }" alt="" style="height: 45px; width: 45px;">
                                        <div class="nav-post-profile">
                                            <h6>${user.name}</h6>
                                            <p>${dateTF(user.created_at)}</p>
                                        </div>
                                        ` + $isLogin +`
                                    </div>
                                    <img class="img-fluid banner-post" src="/assets/images/posts/${
                                        post.image
                                    }" alt="" style="border-radius: 10px;" data-action="zoom">
                                    <ul class="tags city-tags">
                                        <li><a href="#">${
                                            post.city_id ? post.city_id : ""
                                        }, </a></li>
                                        <li><a href="#">${
                                            post.district_id ? post.city_id : ""
                                        } </a></li>
                                    </ul>
                                        <p class="content-post">
                                        ${handleHTML(post.description)}
                                        </p>
                                    <div class="bottom-meta">
                                        <div class="user-details row align-items-center">
                                            <div class="comment-wrap col-lg-6">
                                                <ul>
                                                    <li><a href="#"><span class="lnr lnr-bubble"></span> 06 Comments</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `
                        );
                    });
                }
            },
            error: err => {
                console.log(err);
            }
        });
    }

    function handleHTML(text) {
        return text;
    }

    function dateTF(date) {
        /* Date Format */
        let d = new Date(date);
        let option = {
            year: "numeric",
            month: "short",
            day: "2-digit",
            hour: "numeric",
            minute: "numeric",
            second: "numeric"
        };
        let dtf = new Intl.DateTimeFormat("id", option);
        let [
            { value: da },
            ,
            { value: mo },
            ,
            { value: ye },
            ,
            { value: ho },
            ,
            { value: mi },
            ,
            { value: se }
        ] = dtf.formatToParts(d);

        return `${da} ${mo} ${ye}, ${ho}:${mi}`;
    }

    function isLogin(post) {
        $.ajax({
            url: "/profile/data",
            method: "GET",
            dataType: "JSON",
            success: res => {
                if (!res.success) {
                    console.log(res);
                } else {
                    if (post.user_id === res.data.id) {

                        let data = `
                                <div class="nav-post-right">
                                    <a href="javascript:void(0)" class="" id="dropdownMenuLink" data-toggle="dropdown">
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    </a>

                                    <div class="dropdown-menu setting-post" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Ubah
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="fa fa-trash" aria-hidden="true"></i>Hapus
                                        </a>
                                    </div>
                                </div>
                                `;

                        return data;
                    }
                    return "";
                }
            },
            error: err => {
                // console.log(err);
                if (err.status === 401) {
                    return `
                                <div class="nav-post-right">
                                    <a href="javascript:void(0)" class="" id="dropdownMenuLink" data-toggle="dropdown">
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    </a>

                                    <div class="dropdown-menu setting-post" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Ubah
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="fa fa-trash" aria-hidden="true"></i>Hapus
                                        </a>
                                    </div>
                                </div>
                                `;
                }
            }
        });
    }
});
