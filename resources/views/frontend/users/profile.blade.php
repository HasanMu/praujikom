@extends('frontend.users/template/template')

@section('title', 'Profil')
@section('header', 'Profilku')

@section('content')
    <div class="callout callout-info">
        <h4>Reminder!</h4>
        Instructions for how to use modals are available on the
        <a href="http://getbootstrap.com/javascript/#modals">Bootstrap documentation</a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Data diri</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Lengkap</label>
                            <input type="email" class="form-control" id="nama_lengkap" placeholder="Nama Lengkap" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group {{ (Auth::user()->dob == '' || Auth::user()->dob == null) ? 'has-warning' : '' }}">
                            <label for="exampleInputEmail1">Tanggal lahir</label>
                            <input type="text" class="form-control" id="dob" placeholder="Tanggal Lahir" value="{{ Auth::user()->dob }}">
                            @if(Auth::user()->dob == '' || Auth::user()->dob == null)
                                <span class="help-block">Tanggal lahir belum di set</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat email</label>
                            <input type="email" class="form-control" id="email" disabled placeholder="Alamat email" value="{{ Auth::user()->email }}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Bio (optional)</label>
                            <textarea cols="5" class="form-control" id="Bio" placeholder="Bio">{{ Auth::user()->bio }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Jenis kelamin</label>

                            <div class="radio">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>
                                            <input type="radio" name="gender" class="gender" value="1" {{ Auth::user()->gender == 1 ? "checked" : "" }}>
                                            Laki - Laki
                                        </label>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>
                                            <input type="radio" name="gender" class="gender" value="2" {{ Auth::user()->gender == 2 ? "checked" : "" }}>
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group {{ (Auth::user()->address == '' || Auth::user()->address == null) ? 'has-warning' : '' }}"">
                            <label for="exampleInputEmail1">Alamat</label>
                            <textarea cols="5" class="form-control" id="alamat" placeholder="Alamat email">{{ Auth::user()->address }}</textarea>
                            @if(Auth::user()->address == '' || Auth::user()->address == null)
                                <span class="help-block">Alamat belum di set</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <input type="file" id="exampleInputFile">

                            <p class="help-block">Example block-level help text here.</p>
                        </div>

                        <img src="https://upload.wikimedia.org/wikipedia/commons/f/f9/Google_Lens_-_new_logo.png" class="img-thumbnail" alt="Responsive image" style="width: 200px; height: 200px;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/f/f9/Google_Lens_-_new_logo.png" class="img-thumbnail" alt="Responsive image" style="width: 200px; height: 200px;">
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
                <div class="box-body">
                    <form role="form">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Text</label>
                        <input type="text" class="form-control" placeholder="Enter ...">
                    </div>
                    <div class="form-group">
                        <label>Text Disabled</label>
                        <input type="text" class="form-control" placeholder="Enter ..." disabled="">
                    </div>

                    <!-- textarea -->
                    <div class="form-group">
                        <label>Textarea</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Textarea Disabled</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..." disabled=""></textarea>
                    </div>

                    <!-- input states -->
                    <div class="form-group has-success">
                        <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Input with success</label>
                        <input type="text" class="form-control" id="inputSuccess" placeholder="Enter ...">
                        <span class="help-block">Help block with success</span>
                    </div>
                    <div class="form-group has-warning">
                        <label class="control-label" for="inputWarning"><i class="fa fa-bell-o"></i> Input with
                        warning</label>
                        <input type="text" class="form-control" id="inputWarning" placeholder="Enter ...">
                        <span class="help-block">Help block with warning</span>
                    </div>
                    <div class="form-group has-error">
                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Input with
                        error</label>
                        <input type="text" class="form-control" id="inputError" placeholder="Enter ...">
                        <span class="help-block">Help block with error</span>
                    </div>

                    </form>
                </div>
                <!-- /.box-body -->
                </div>
        </div>
    </div>
@endsection

@section('css')
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{ asset('assets/fe/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('assets/fe/AdminLTE/plugins/iCheck/all.css') }}">
@endsection
@push('js')
    <!-- InputMask -->
    <script src="{{ asset('assets/fe/AdminLTE/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('assets/fe/AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('assets/fe/AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('assets/fe/AdminLTE/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $('#dob').inputmask('mm/dd/yyyy', { 'placeholder': 'bb/hh/tttt' })
        // iCheck
        $('input[type="radio"].gender').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
        })
    </script>
@endpush