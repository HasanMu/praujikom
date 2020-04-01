@extends('frontend.kajian.template')

@section('konten')
<div class="col-lg-8 posts-kajian w-100 order-first">
</div>

<!-- Modal -->
<div id="modal" style="display: none;">
    <form id="form" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="profile-post-modal">
                <img class="img-fluid modal-profile-img" src="" alt="" style="height: 45px; width: 45px;">
                    <div class="form-group">
                        <textarea id="description" class="form-control" cols="5" rows="5" name="description" placeholder="Ketik kajian"></textarea>
                        <div class="d-flex">
                            <div class="form-group">
                                <label for="cities" class="col-sm-1-12 col-form-label">Kota</label>
                                <select class="form-control" style="width: 90%;" name="cities" id="cities"></select>
                            </div>
                            <div class="form-group">
                                <label for="district" class="col-sm-1-12 col-form-label">Kota</label>
                                <select class="form-control" style="width: 90%" name="districts" id="districts"></select>
                            </div>
                        </div>
                        <input id="image" class="form-control-file" type="file" name="image">
                        <div id="prev-image" style="display: none;">
                            <img src="" alt="" class="img-fluid" id="img-preview">
                        </div>
                    </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-iziModal-close>Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

<div id="modal-edit" style="display: none;">
    <form id="form-edit" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="profile-post-modal">
                <img class="img-fluid modal-profile-img" src="" alt="" style="height: 45px; width: 45px;">
                    <div class="form-group">
                        <textarea id="description" class="form-control" cols="5" rows="5" name="description" placeholder="Ketik kajian"></textarea>
                        <div class="d-flex">
                            <div class="form-group">
                                <label for="cities" class="col-sm-1-12 col-form-label">Kota</label>
                                <select class="form-control" style="width: 90%;" name="cities" id="cities"></select>
                            </div>
                            <div class="form-group">
                                <label for="district" class="col-sm-1-12 col-form-label">Kota</label>
                                <select class="form-control" style="width: 90%" name="districts" id="districts"></select>
                            </div>
                        </div>
                        <div class="d-flex">
                            <input id="image" class="form-control-file" type="file" name="image">
                            <button type="button" class="btn btn-outline-danger delete-img" data-toggle="tooltip" data-placement="left" title="Hapus Gambar?"><i class="fa fa-trash"></i></button>
                        </div>
                        <div id="prev-image" style="display: none;">
                            <img src="" alt="" class="img-fluid" id="img-preview">
                        </div>
                    </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-iziModal-close>Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

@endsection

@push('scripts')
    <script src="{{ asset('js/zoom.min.js') }}"></script>
    {{-- <script src="{{ asset('js/zoom.js') }}"></script> --}}
    <script src="{{ asset('js/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/jquery-validation/additional-methods.min.js') }}"></script>

    {{-- <script src="{{ asset('js/actions/kajian_actions.js') }}"></script> --}}
    <script src="{{ asset('js/kajian.js') }}"></script>

@endpush
