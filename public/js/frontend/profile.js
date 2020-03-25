$(document).ready(() => {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"').attr("content")
        }
    });

    /** =======================
     * iCheck - Gender select
     * =======================
     */

    $("#dob").inputmask("mm/dd/yyyy", { placeholder: "bb/hh/tttt" });
    // iCheck
    $('input[type="radio"].gender').iCheck("destroy");
    $('input[type="radio"].gender').iCheck({
        checkboxClass: "icheckbox_flat-green",
        radioClass: "iradio_flat-green"
    });

    /** ===============
     * Image Preview
     * ===============
     */

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $("#img-avatar-preview").attr("src", e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    /** ===================
     * JQ Form Validation
     * ===================
     */

    let rules_data = {
        name: "required",
        image: {
            maxsize: 2048000,
            extension: "jpg|jpeg|png"
        }
    };

    let message_data = {
        name: {
            required: "Nama harus diisi!"
        },
        image: {
            maxsize: "Ukuran maksimal foto 2 MB",
            extension: "File harus berekstensikan *.jpg, *.jpeg atau *.png"
        }
    };

    // Sec

    let rules_sec = {
        password: { required: true },
        "new-password": { required: true, minlength: 6 },
        "new-password-confirm": { required: true, equalTo: "input[name='new-password']" }
    };

    let message_sec = {
        password: {
            required: "Kata sandi harus diisi!"
        },
        "new-password": {
            required: "Kata sandi harus diisi!",
            minlength: "Kata sandi minimal 6 karakter"
        },
        "new-password-confirm": {
            required: "Kata sandi harus diisi!",
            equalTo: "Kata sandi baru tidak sama"
        }
    };

    JQFValidation("#edit-data", "/profile", "POST", rules_data, message_data);
    JQFValidation(
        "#edit-sec",
        "/profile/security",
        "POST",
        rules_sec,
        message_sec,
        true
    );

    function JQFValidation(
        idForm,
        to,
        method,
        rules = {},
        message = {},
        sec = false
    ) {
        // jQuery.validator.setDefaults({
        //     debug: true
        // });

        $("#image").change(function() {
            readURL(this);
        });

        $(idForm).validate({
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
            errorElement: "div",
            errorClass: "help-block",
            errorPlacement: function(element, e) {
                e.parent(".input-group").length
                    ? element.insertAfter(e.parent())
                    : e.parent("label").length
                    ? element.insertBefore(e.parent())
                    : element.insertAfter(e);
            },
            submitHandler: function(form) {
                let formData = new FormData($(form)[0]);
                formData.append("security", sec);

                $(idForm + ' button[type="submit"]').attr("disabled", true);

                $("input#g1").val(1);
                $("input#g2").val(2);

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

                        $("#img-avatar-preview").attr(
                            "src",
                            "https://upload.wikimedia.org/wikipedia/commons/f/f9/Google_Lens_-_new_logo.png"
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
                            if (res.security) {
                                $(form)[0].reset();
                            }
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
    }

    /** ===========================
     * Auto Fill Form Edit Profile
     * ===========================
     */

    getData();
    function getData() {
        $.ajax({
            url: "/profile/data",
            method: "GET",
            success: res => {
                const el = $("#edit-data [name]").get();
                const data = res.data;
                let img = res.data.image
                    ? res.data.image
                    : "default-avatar.jpg";

                // Side
                $("#profile-sidebar-name").text(res.data.name);
                $("#profile-sidebar-image")
                    .attr("src", "/assets/images/users/" + img)
                    .attr("alt", res.data.name);

                // Navbar
                $("#profile-navbar-name").text(res.data.name);
                $("#profile-navbar-image")
                    .attr("src", "/assets/images/users/" + img)
                    .attr("alt", res.data.name);

                // Dropdown
                $("#profile-navbar-dropdown-name")
                    .text(res.data.name)
                    .children()
                    .text(res.data.email);
                $("#profile-navbar-dropdown-image")
                    .attr("src", "/assets/images/users/" + img)
                    .attr("alt", res.data.name);

                // Info Alert
                let d = new Date(res.data.created_at)
                let option = {
                    year: "numeric",
                    month: "long",
                    day: "2-digit",
                };
                let dtf = new Intl.DateTimeFormat('id', option)
                let [{ value: da },,{ value: mo },,{ value: ye }] = dtf.formatToParts(d)

                $("#info-alert").text('');
                $("#info-alert").append(
                    $("<h4>").text(`Halo, ${res.data.name}!`),
                    $("<p>").text(`Kamu bergabung sejak ${da} ${mo} ${ye}`)
                );

                // Updated
                if(res.data.updated_at){
                    let d = new Date(res.data.updated_at);
                    let dtf = new Intl.DateTimeFormat("id", {
                        year: "numeric",
                        month: "long",
                        day: "2-digit"
                    });
                    let [{ value: da },,{ value: mo },,{ value: ye }] = dtf.formatToParts(d);

                    $("#updated").text("");
                    $("#updated").append(
                        $('<small style="color: white; font-size: 13px;">').text("Terakhir diperbarui pada " + da + " " + mo + " " + ye),
                    );

                }

                $("#edit-data")[0].reset();

                // console.log(res.data);

                el.map((val, key) => {
                    if (data[val.name]) {
                        if (val.name == "gender") {
                            //
                            if (val.id == "g1") {
                                if (data.gender === $("#g1").val()) {
                                    $("#g1").iCheck("check");
                                }
                            }
                            if (val.id == "g2") {
                                if (data.gender === $("#g2").val()) {
                                    $("#g2").iCheck("check");
                                }
                            }
                        }

                        if (val.name == "dob") {
                            let d = new Date(data[val.name]);
                            let dtf = new Intl.DateTimeFormat("id", {
                                year: "numeric",
                                month: "2-digit",
                                day: "2-digit"
                            });
                            let [
                                { value: da },
                                ,
                                { value: mo },
                                ,
                                { value: ye }
                            ] = dtf.formatToParts(d);

                            $('#dob').val(`${mo}/${da}/${ye}`)
                        }

                        if (val.name !== "gender" && val.name !== "dob") {

                            $(val.localName + '[name="' + val.name + '"]').val(
                                data[val.name]
                            );
                            $("#img-now")
                                .attr("src", "/assets/images/users/" + img)
                                .attr("alt", res.data.name);
                        }
                    }
                });
            }
        });
    }
});
