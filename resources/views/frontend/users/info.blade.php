@extends('frontend.users/template/template')

@section('title', 'Info')
@section('header', 'Info')

@section('content')
        <div class="box box-widget">
            <div class="box-header with-border">
                <div class="user-block">
                    <span class="text-bold">&nbsp;</span>
                </div>
                <!-- /.user-block -->
                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @php
                    $color = ['info', 'danger', 'primary', 'warning', 'success'];
                    $random = array_rand($color);
                @endphp
                @if ($info->count() > 0)
                    @foreach ($info as $data)
                        <div class="callout callout-{{ $color[$random] }}">
                            <h4>{{ $data->title }}</h4>

                            <p>{{ $data->description }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted text-center">Belum ada informasi</p>
                @endif
            </div>
        </div>
@endsection


@push('js')
    <script src="{{ asset('js/frontend/myposts.js') }}"></script>
@endpush
