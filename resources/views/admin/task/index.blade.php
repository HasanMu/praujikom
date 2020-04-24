@extends('layouts.be')

@section('title', 'Data Informasi')
@section('header', 'Data Informasi')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header justify-content-between">
            <h4>Data Informasi</h4>
            <a name="" id="" class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#modal-add">Buat Informasi</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-light table-hover data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Diperuntukan untuk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="data-info">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/stisla220/assets/modules/izitoast/css/iziToast.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/stisla220/assets/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/stisla220/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endsection

@push('js')
<script src="{{ asset('assets/stisla220/assets/modules/izitoast/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/stisla220/assets/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/stisla220/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/stisla220/assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.task') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'title', name: 'title'},
            {data: 'description', name: 'description'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#modal-add').on('submit', '#form-add', (e) => {
        e.preventDefault();

        $.ajax({
            url: "/admin/task-scheduller",
            method: "POST",
            data: $("#form-add").serialize(),
            success: res => {
                iziToast.info({
                    title: 'Berhasil!',
                    message: 'Informasi telah disebarkan kepada semua member!',
                    position: 'bottomLeft'
                });
                table.draw();
                $("#form-add")[0].reset();
                $('#modal-add').modal('hide');
            },
            error: err => console.log(err)
        });
    });

    $('.data-info').on('click', '#info-info', function (e) {
        e.preventDefault();
        $("#modal-info").modal('show')

        let title = $(this).data('title');
        let description = $(this).data('description');

        $("#modal-info #title").html("");
        $("#modal-info #description").html("");
        $("#modal-info #title").text(title);
        $("#modal-info #description").text(description);
    })

    $('.data-info').on('click', '#btn-delete', function (e) {
        e.preventDefault();

        let data = $(this).data('id');
        let c = confirm("Apakah kamu yakin ingin menghapus informasi ini?")
        c ? deleteMember(data) : false
    })

    function deleteMember(id) {
        $.ajax({
            url: "/admin/task-scheduller",
            method: "DELETE",
            data: {id: id},
            success: res => {
                iziToast.show({
                    title: 'Berhasil!',
                    message: 'Informasi Telah Dihapus!',
                    position: 'bottomLeft'
                });
                table.draw();
            },
            error: err => console.log(err)
        });
    }
</script>

@endpush
