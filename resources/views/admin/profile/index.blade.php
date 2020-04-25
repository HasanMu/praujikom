@extends('layouts.be')

@section('title', Auth::user()->name)
@section('header', "Profilku")

@section('content')
    <div class="section-body">
        <h2 class="section-title">Halo, {{ Auth::user()->name }}!</h2>
        <p class="section-lead">
            Ubah informasi tentangmu di halaman ini.
        </p>

        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-5">
            <div class="card profile-widget">
                <div class="profile-widget-header">
                <img alt="image" src="{{ asset('assets/images/users/'.Auth::user()->image) }}" class="rounded-circle profile-widget-picture">
                <div class="profile-widget-items">
                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Kajian</div>
                        <div class="profile-widget-item-value">{{ Auth::user()->post->count() }}</div>
                    </div>
                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Diperbarui pada</div>
                        <div class="profile-widget-item-value">{{ Auth::user()->updated_at->diffForHumans() }}</div>
                    </div>
                </div>
                </div>
                <div class="profile-widget-description">
                <div class="profile-widget-name">{{ Auth::user()->name }} <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> Admin Muslim Society</div></div>
                {!! Auth::user()->bio ? Auth::user()->bio : 'Belum ada bio' !!}
                </div>
            </div>
            </div>
            <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
                <form id="form-profile" class="needs-validation" novalidate="">
                    <div class="card-header">
                        <h4>Ubah Profil</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label>Nama</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" required="">
                            <div class="invalid-feedback">
                            Kolom nama harus diisi!
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label>Email</label>
                            <input type="email" class="form-control" value="{{ Auth::user()->email }}" required="" readonly>
                            <div class="invalid-feedback">
                            Kolom email harus diisi
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-7 col-12">
                            <label>Tanggal Lahir</label>
                            <input type="date" class="form-control" value="{{ Auth::user()->dob }}">
                        </div>
                        <div class="form-group col-md-5 col-12">
                            <label>Jenis Kelamin</label>
                            <div class="selectgroup-item w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" name="gender" value="0" class="selectgroup-input" {{ Auth::user()->gender == 0 ? 'checked' : '' }}>
                                    <span class="selectgroup-button">Laki - Laki</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="gender" value="1" class="selectgroup-input" {{ Auth::user()->gender == 1 ? 'checked' : '' }}>
                                    <span class="selectgroup-button">Perempuan</span>
                                </label>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Bio</label>
                                <textarea name="bio" class="form-control" rows="5" placeholder="Bio">{{ Auth::user()->bio }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Alamat</label>
                                <textarea name="address" class="form-control" rows="5" placeholder="Alamat">{{ Auth::user()->address }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="foto">Foto Profil</label>
                                <div id="image-preview" class="image-preview">
                                    <label for="image-upload" id="image-label">Pilih Foto</label>
                                    <input type="file" name="image-upload" id="image-upload" accept="image/*"/>
                                </div>
                                <div id="err-foto" style="color: #dc3545;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/stisla220/assets/modules/izitoast/css/iziToast.min.css') }}">
@endsection
@push('js')
<script src="{{ asset('assets/stisla220/assets/modules/izitoast/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/stisla220/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js')}}"></script>
<script src="{{ asset('js/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/jquery-validation/additional-methods.min.js') }}"></script>
<script>
    "use strict"

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"').attr("content")
        }
    });

    $.uploadPreview({
        input_field: "#image-upload",   // Default: .image-upload
        preview_box: "#image-preview",  // Default: .image-preview
        label_field: "#image-label",    // Default: .image-label
        label_default: "Pilih Foto",   // Default: Choose File
        label_selected: "Ganti Foto",  // Default: Change File
        no_label: false,                // Default: false
        success_callback: null          // Default: null
    });

    let rules_data = {
        "image-upload": {
            maxsize: 2048000,
            extension: "jpg|jpeg|png"
        }
    };

    let message_data = {
        "image-upload": {
            maxsize: "Ukuran maksimal foto 2 MB",
            extension: "File harus berekstensikan *.jpg, *.jpeg atau *.png"
        }
    };

    JQFValidation("#form-profile", '/admin/profile', 'POST', rules_data, message_data);

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
                    : e[0].id == "image-upload" ? $("#err-foto").append(element) : e.parent("label").length
                    ? element.insertBefore(e.parent())
                    : element.insertAfter(e);

                    console.log("elemet", element);
                    console.log("e", e);

            },
            submitHandler: function(form) {
                let formData = new FormData($(form)[0]);

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
                            iziToast.success({
                                transitionIn: "flipInX",
                                transitionOut: "bounceInDown",
                                transitionInMobile: "flipInX",
                                transitionOutMobile: "bounceInDown",
                                title: res.title + "!",
                                message: res.message,
                                position: "bottomLeft"
                            });

                            setTimeout(() => {
                                location.reload()
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
</script>
@endpush
