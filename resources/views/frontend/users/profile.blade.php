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
        <div class="col-xs-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Modal Examples</h3>
                </div>
                <div class="box-body">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                        Launch Default Modal
                    </button>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
                        Launch Info Modal
                    </button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger">
                        Launch Danger Modal
                    </button>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-warning">
                        Launch Warning Modal
                    </button>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-success">
                        Launch Success Modal
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
