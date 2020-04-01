
$(function() {

var base_url = window.location.origin;
let $dataPOST = false;
let d_image = null;

    /* Setting CSRF TOKEN */
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    /* ADD Post */
    $(document).on("click", ".post-add", e => {
        e.preventDefault();

        /* Open modal*/
        $("#modal").iziModal("open");
    });
    /* End Add Post */

    /* Image Preview Helper */
    function readURL(edit, input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $("#modal"+edit+" #img-preview")
                    .parent()
                    .css("display", "block");
                $("#modal"+edit+" #img-preview").attr("src", e.target.result);
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
                let formData = FormData($(form)[0]);
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
    /* End Form Validation */

    /* Form V Edit */
    function formValidationEdit(idForm, rules = {}, message = {}, to, method) {
        $("#modal-edit " + idForm).validate({
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
                    ? element.insertBefore(e)
                    : element.insertAfter(e);

                if (
                    e.parent("label").context.parentElement.className ==
                    "d-flex"
                ) {
                    element.insertAfter(e.parent());
                }
            },
            submitHandler: function(form) {
                let formData = new FormData($(form)[0]);
                formData.append("d_img", d_image);
                formData.append("_idPKJn", $dataPOST.id);

                for (var pair of formData.entries()) {
                    console.log(pair[0]+ ', ' + pair[1]);
                }

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
                                position: "bottomRight",
                                timeout: 3000,
                            });
                        } else {
                            $("#modal-edit").iziModal("close");

                            iziToast.success({
                                transitionIn: "flipInX",
                                transitionOut: "bounceInDown",
                                transitionInMobile: "flipInX",
                                transitionOutMobile: "bounceInDown",
                                title: res.title + "!",
                                message: res.message,
                                position: "bottomLeft",
                                timeout: 3000,
                            });

                            setTimeout(() => {
                                location.reload();
                            }, 3000);
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

                        editData(post)

                        _postKajian.append(
                            `
                        <div class="single-widget">
                            <div class="post-list blog-post-list mb-10">
                                <div class="single-post">

                                    <div class="nav-post">
                                        <img class="img-fluid" src="/assets/images/users/${
                                            user.image
                                                ? handleHTML(user.image)
                                                : "default-avatar.jpg"
                                        }" alt="" style="height: 45px; width: 45px;">
                                        <div class="nav-post-profile">
                                            <h6>${handleHTML(user.name)}</h6>
                                            <p>${dateTF(post.created_at)}</p>
                                        </div>
                                        ${
                                            post.poster
                                                ? KajianAction().dropdownPoster(
                                                      post
                                                  )
                                                : ""
                                        }
                                    </div>
                                    ${KajianAction().getImg(post)}
                                    ${KajianAction().getLoc(post)}
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

                                    <div class="ui comments">
                                        <div class="comment">
                                            <a class="avatar">
                                                <img src="/assets/images/users/${handleHTML(
                                                    user.image
                                                )}">
                                            </a>
                                            <div class="content">
                                                <a class="author">Stevie Feliciano</a>
                                                <div class="metadata">
                                                    <div class="date">2 days ago</div>
                                                    <div class="rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        5 Faves
                                                    </div>
                                            </div>
                                            <div class="text">
                                                Hey guys, I hope this example comment is helping you read this documentation.
                                            </div>
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

        $.ajax({
            url: base_url +"/profile/data",
            success: res => {
                let user = res.data;

                let imgProfileModal = $(".modal-profile-img");

                imgProfileModal
                    .attr(
                        "src",
                        `/assets/images/users/${user.image? user.image : "default-avatar.jpg" }`
                    )
                    .attr("alt", user.name);
            }
        })
    }

    function handleHTML(text) {
        return $(`<p>${text}</p>`).text();
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
        let dtf = Intl.DateTimeFormat("id", option);
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

    function editData (post) {
        $(document).on("click", ".post-edit-" + post.id, e => {
            e.preventDefault();
            KajianAction().dataPost(post).set();

            KajianAction().confModalEdit();

            /* Open modal*/
            $("#modal-edit").iziModal("open");
        });
    }

    function KajianAction(){

        return {
            /* Get Image */
            getImg(post) {
                if (post.image) {
                    return `
                        <img class="img-fluid banner-post" src="/assets/images/posts/${post.image}" alt="" style="border-radius: 10px;" data-action="zoom">
                    `;
                } else {
                    return "";
                }
            },
            /* End Get Image */

            /* Get Location */
            getLoc(post) {
                if (post.city_id || post.district_id) {
                    return post.city_id && post.district_id
                        ? `<ul class="tags city-tags">
                                <li><a href="#">${post.city.name}</a></li> |
                                <li><a href="#">${post.district.name}</a></li>
                            </ul>`
                        : "" + post.city_id
                        ? `<ul class="tags city-tags">
                                <li><a href="#">${post.city.name}</a></li>
                            </ul>`
                        : "" + post.district_id
                        ? `<ul class="tags city-tags">
                            <li><a href="#">${post.district.name} </a></li>
                            </ul>`
                        : "";
                } else {
                    return '<p class="tags"></p>';
                }
            },
            /* End Get Location */

            /* Dropdown Post */
            dropdownPoster(post) {
                return `
                <div class="nav-post-right">
                    <a href="javascript:void(0)" class="" id="dropdownMenuLink" data-toggle="dropdown">
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    </a>

                    <div class="dropdown-menu setting-post" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item post-edit-${post.id}" href="javascript:void(0)" data-id="${post.id}">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Ubah
                        </a>
                        <a class="dropdown-item post-delete" href="javascript:void(0)" data-id="${post.id}">
                            <i class="fa fa-trash" aria-hidden="true"></i>Hapus
                        </a>
                    </div>
                </div>
                `;
            },
            /* End Dropdown Post */

            /* Get set Modal */
            setModalEdit(modalId) {
                $(modalId).iziModal("setTitle", "Ubah Kajian");
                $(modalId).iziModal("setSubtitle", "Ubah Kajian ");
                $(modalId).iziModal("setIcon", "fa fa-trash");
                $(modalId).iziModal("resetContent", true);
            },
            /* End Get set Modal */

            /**
             * ====================
             * CONTROLLER
             * ===================
             */

            /* Get and Set Data Post*/
            dataPost(data) {
                return {
                    get: $dataPOST,
                    set: () => {
                        if ($dataPOST != null) {
                            $dataPOST = null;
                            return ($dataPOST = data);
                        } else {
                            return ($dataPOST = data);
                        }
                    }
                };
            },
            /* End Get and Set Data Post*/

            /* IsSelected ModalEdit */
            isSelected(url, idSelect, data_id, modal) {
                $.ajax({
                    url: base_url + "/api/v1/" + url,
                    method: "GET",
                    success: res => {
                        $("#form-edit #" + idSelect).html("");
                        $("#form-edit #" + idSelect).html(
                            `<option value="">-- Pilih salah satu -- </option>`
                        );

                        $.each(res.data, (k, v) => {
                            $("#form-edit #" + idSelect).append(
                                `
                                    <option value="${v.id}" ${
                                    v.id === data_id ? "selected" : ""
                                }>${v.name}</option>
                                `
                            );
                        });

                        modal.stopLoading();
                    },
                    error: err => {
                        console.log(err);
                    }
                });
            },
            /* End IsSelected ModalEdit */

            /* replace Data ModalEdit */
            replaceDataInModal(modal) {
                const modalId = "#" + modal.id;
                const dataForm = $(modalId + " #form-edit").get();
                console.log(dataForm);


                /* SELECT 2 ACTIVE */
                $("#form-edit #" + dataForm[0][1].id).select2({});
                $("#form-edit #" + dataForm[0][2].id).select2({});
                $dataPOST.image
                    ? $("#form-edit #prev-image").css("display", "block")
                    : "";
                $dataPOST.image
                    ? $("#form-edit .delete-img").css("display", "block")
                    : $("#form-edit .delete-img").css("display", "none");

                dataForm[0][0].value = $dataPOST.description;
                this.isSelected("cities", dataForm[0][1].id, $dataPOST.city_id, modal);
                this.isSelected(
                    $dataPOST.city_id + "/districts",
                    dataForm[0][2].id,
                    $dataPOST.district_id,
                    modal
                );
                $dataPOST.image
                    ? $("#form-edit #prev-image img").attr(
                        "src",
                        "/assets/images/posts/" + $dataPOST.image
                    )
                    : "";
            },
            /* End replace Data ModalEdit */

            confModalEdit() {
                /* Instantiating iziModal */
                const $this = this;

                $("#modal-edit").iziModal({
                    headerColor: "rgba(138, 144, 255, 0.9)",
                    top: 10,
                    overlayClose: false,
                    overlayColor: "rgba(0, 0, 0, 0.6)",
                    afterRender: function() {},
                    onOpening: function(modal) {
                        modal.startLoading();
                        $this.replaceDataInModal(modal);
                        $("form-edit #description").select2({})
                        modal.stopLoading();
                    },
                    onOpened: function(modal) {
                        $("#modal-edit").on("change", "#cities", function() {
                            let _id = $(this).val();

                            if (!_id) {
                                modal.startLoading();
                                $this.isSelected("/cities", "cities", 0, modal);
                            }

                            modal.startLoading();
                            $this.isSelected(
                                "" + _id + "/districts",
                                "districts",
                                0,
                                modal
                            );
                        });

                        $("#modal-edit").on("change", "#image", function() {
                            $("#modal-edit .delete-img").css("display", "block");
                            $("#modal-edit #prev-image img").css(
                                "display",
                                "block"
                            );
                            d_image = false;
                            readURL("-edit", this);
                        });

                        $("#modal-edit .delete-img").on("click", () => {
                            $("#modal-edit .delete-img").css("display", "none");
                            $("#modal-edit #image").val("");

                            $("#modal-edit #prev-image img").css("display", "none");
                            $("#modal-edit #prev-image img").attr("src", "");
                            d_image = true;
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


                        formValidationEdit(
                            "#form-edit",
                            rules,
                            message,
                            "/kajian/ubah",
                            "POST"
                        );
                    }
                });

                this.setModalEdit("#modal-edit");
            },
        }
    }
});
