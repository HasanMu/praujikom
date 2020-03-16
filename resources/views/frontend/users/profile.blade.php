@extends('frontend.users/template/template')

@section('title', 'Profil')
@section('header', 'Profilku')

@section('content')
    <div class="callout callout-info" id="info-alert"></div>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Data diri</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="edit-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputnama lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" placeholder="Nama Lengkap" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal lahir</label>
                            <input type="text" class="form-control" id="dob" placeholder="Tanggal Lahir" name="dob">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" disabled placeholder="Alamat email" name="email">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Bio</label>
                            <textarea cols="5" class="form-control" id="Bio" placeholder="Bio" name="bio"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Jenis kelamin</label>

                            <div class="radio">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>
                                            <input type="radio" name="gender" class="gender" value="1" id="g1">
                                            Laki - Laki
                                        </label>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>
                                            <input type="radio" name="gender" class="gender" value="2" id="g2">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat</label>
                            <textarea cols="5" class="form-control" id="alamat" placeholder="Alamat" name="address"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="img-avatar">Foto Profil</label>
                            <input type="file" id="image" name="image">
                        </div>

                        <img src="" class="img-thumbnail" alt="" style="width: 200px; height: 200px;" id="img-now">
                        &nbsp; > &nbsp;
                        <img src="https://upload.wikimedia.org/wikipedia/commons/f/f9/Google_Lens_-_new_logo.png" class="img-thumbnail" id="img-avatar-preview" alt="Responsive image" style="width: 200px; height: 200px;">
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">Ubah</button>
                    </div>
                </form>
                </div>
        </div>
        <div class="col-md-6">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Keamanan</h3>
                </div>
                <!-- /.box-header -->
                <form role="form" id="edit-sec">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Kata sandi</label>
                            <input type="password" class="form-control" placeholder="Kata sandi sekarang" name="password">
                        </div>
                        <div class="form-group">
                            <label>Kata sandi baru</label>
                            <input type="password" class="form-control" placeholder="Kata sandi baru" name="new-password">
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi kata sandi baru</label>
                            <input type="password" class="form-control" placeholder="Konfirmasi" name="new-password-confirm">
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-danger">Ubah kata sandi</button>
                    </div>
                </form>
                </div>
        </div>
    </div>
@endsection

@section('css')
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{ asset('assets/fe/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('assets/fe/AdminLTE/plugins/iCheck/all.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/Semantic-UI-master/dist/components/step.min.css') }}">
@endsection
@push('js')
    <!-- InputMask -->
    <script src="{{ asset('assets/fe/AdminLTE/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('assets/fe/AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('assets/fe/AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('assets/fe/AdminLTE/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('js/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('js/redux.min.js') }}"></script>
    <script src="{{ asset('js/frontend/profile.js') }}"></script>
@endpush
