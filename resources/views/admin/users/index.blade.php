@extends('layouts.be')

@section('title', 'Data member')
@section('header', 'Data Member')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header justify-content-between">
            <h4>Data Member</h4>
            <a name="" id="" class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#modal-add">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-light table-hover data-table">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>Email</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody class="data-users">
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
        ajax: "{{ route('admin.users') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#modal-add').on('submit', '#form-add', (e) => {
        e.preventDefault();

        $.ajax({
            url: "/admin/users",
            method: "POST",
            data: $("#form-add").serialize(),
            success: res => {
                iziToast.success({
                    title: 'Berhasil!',
                    message: 'Member baru telah di tambahkan',
                    position: 'bottomLeft'
                });
                table.draw();
                $("#form-add")[0].reset();
                $('#modal-add').modal('hide');
            },
            error: err => console.log(err)
        });
    });

    $('.data-users').on('click', '#btn-delete', function (e) {
        e.preventDefault();

        let data = $(this).data('id');
        let c = confirm("Apakah kamu yakin ingin menghapus member ini?")
        c ? deleteMember(data) : false
    })

    function deleteMember(id) {
        $.ajax({
            url: "/admin/users",
            method: "DELETE",
            data: {id: id},
            success: res => {
                iziToast.warning({
                    title: 'Peringatan!',
                    message: 'Salah satu member telah dihapus!',
                    position: 'bottomLeft'
                });
                table.draw();
            },
            error: err => console.log(err)
        });
    }
</script>

@endpush
