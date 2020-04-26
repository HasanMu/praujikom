@extends('frontend.users/template/template')

@section('title', 'Postingan')
@section('header', 'Postinganku')

@section('content')
    @if ($posts->count() > 0)
        @foreach ($posts as $post)
            <div class="box box-widget">
                <div class="box-header with-border">
                    <div class="user-block">
                        <img class="img-circle" src="/assets/images/users/{{$post->user->image ? $post->user->image : 'default-avatar.jpg' }}" alt="User Image">
                        <span class="username"><a href="#">{{ $post->user->name }}</a></span>
                        <span class="description">{{ $post->created_at->diffForHumans() }}</span>
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
                    @if ($post->image)
                        <img class="img-responsive pad" src="/assets/images/posts/{{ $post->image }}" alt="Photo">
                    @endif

                    <p>{{ $post->description }}</p>
                    <a href="/kajian/{{ $post->id }}" class="btn btn-default btn-xs">Lihat selengkapnya</a>
                    <span class="pull-right text-muted">{{ $post->comment->count() }} komentar</span>
                </div>
                <!-- /.box-body -->
                {{-- <div class="box-footer box-comments">
                    <div class="box-comment">
                    <!-- User image -->
                    <img class="img-circle img-sm" src="../dist/img/user3-128x128.jpg" alt="User Image">

                    <div class="comment-text">
                        <span class="username">
                        Maria Gonzales
                        <span class="text-muted pull-right">8:03 PM Today</span>
                        </span><!-- /.username -->
                        It is a long established fact that a reader will be distracted
                        by the readable content of a page when looking at its layout.
                    </div>
                    <!-- /.comment-text -->
                    </div>
                    <!-- /.box-comment -->
                    <div class="box-comment">
                    <!-- User image -->
                    <img class="img-circle img-sm" src="../dist/img/user4-128x128.jpg" alt="User Image">

                    <div class="comment-text">
                        <span class="username">
                        Luna Stark
                        <span class="text-muted pull-right">8:03 PM Today</span>
                        </span><!-- /.username -->
                        It is a long established fact that a reader will be distracted
                        by the readable content of a page when looking at its layout.
                    </div>
                    <!-- /.comment-text -->
                    </div>
                    <!-- /.box-comment -->
                </div>
                <!-- /.box-footer -->
                <div class="box-footer">
                    <form action="#" method="post">
                    <img class="img-responsive img-circle img-sm" src="../dist/img/user4-128x128.jpg" alt="Alt Text">
                    <!-- .img-push is used to add margin to elements next to floating images -->
                    <div class="img-push">
                        <input type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                    </div>
                    </form>
                </div> --}}
                <!-- /.box-footer -->
            </div>
        @endforeach
    @else
        <div class="box box-widget">
            <div class="box-header with-border">
                <p></p>
            </div>
            <div class="box-body">
                <h4 class="text-center text-muted">Belum ada postingan kajian</h4>
            </div>
        </div>
    @endif
@endsection


@push('js')
    <script src="{{ asset('js/frontend/myposts.js') }}"></script>
@endpush
