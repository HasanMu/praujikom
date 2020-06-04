@extends('frontend.kajian.template')

@section('konten')
    <div class="col-lg-8 posts-kajian w-100 order-first">
        <div class="single-widget">
            <div class="post-list blog-post-list mb-10">
                <div class="single-post">

                    <div class="nav-post">
                        <img class="img-fluid" src="/assets/images/users/{{ $post->user->image ? $post->user->image : 'default-avatar.jpg' }}" alt="" style="height: 45px; width: 45px;">
                        <div class="nav-post-profile">
                            <h6>{{ $post->user->name }}</h6>
                            <p>{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                        @php
                            $uId = Auth::check() ? Auth::user()->id : 0;
                        @endphp
                        {{--
                        @if ($post->user_id == $uId)
                            <div class="nav-post-right">
                                <a href="javascript:void(0)" class="" id="dropdownMenuLink" data-toggle="dropdown">
                                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                </a>

                                <div class="dropdown-menu setting-post" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item post-edit" href="javascript:void(0)" data-id="{{ $post->id }}">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Ubah
                                    </a>
                                    <a class="dropdown-item post-delete" href="javascript:void(0)" data-id="{{ $post->id }}">
                                        <i class="fa fa-trash" aria-hidden="true"></i>Hapus
                                    </a>
                                </div>
                            </div>
                        @endif --}}
                    </div>
                    @if ($post->image)
                        <img class="img-fluid banner-post" src="/assets/images/posts/{{ $post->image }}" alt="" style="border-radius: 10px;" data-action="zoom">
                    @else
                    @endif

                    @if ($post->city_id && $post->district_id)
                        <ul class="tags city-tags">
                            <li><a href="#">{{ $post->city->name }}</a></li> |
                            <li><a href="#">{{ $post->district->name}}</a></li>
                        </ul>
                    @elseif($post->city_id)
                        <ul class="tags city-tags">
                            <li><a href="#">{{ $post->city->name }}</a></li> |
                        </ul>
                    @elseif($post->district_id)
                        <ul class="tags city-tags">
                            <li><a href="#">{{ $post->city->name }}</a></li> |
                        </ul>
                    @endif
                        <p class="content-post">
                            {{$post->description}}
                        </p>
                    <div class="bottom-meta">
                        <div class="user-details row align-items-center">
                            <div class="comment-wrap col-lg-6">
                                <ul>
                                    <li>
                                        <a href="javascript:void(0)" id="comments-post">
                                            <span class="lnr lnr-bubble"></span> {{ $post->comment->count() }} Comments
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ui collapsed threads comments" id="collapse-comment">
                        <hr class="ui diving headers">
                        @if ($uId)
                            <div class="comment">
                                <a class="avatar">
                                    <img src="/assets/images/users/{{ Auth::user()->image ? Auth::user()->image : 'default-avatar.jpg' }}">
                                </a>
                                <div class="content">
                                    <form action="/kajian/{{ $post->id }}/comment/add" method="post">
                                        @csrf
                                        <div class="ui action input container-fluid">
                                            <input type="text" name="content" placeholder="Tuliskan komentar" required>
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            <button class="btn btn-primary" type="submit">Kirim</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                        @if ($post->comment->count())
                            @foreach ($post->comment as $data)
                                <div class="comment">
                                    <a class="avatar">
                                        <img src="/assets/images/users/{{ $data->user->image ? $data->user->image : 'default-avatar.jpg' }}">
                                    </a>
                                    <div class="content">
                                        <a class="author">{{ $data->user->name }}</a>
                                        <div class="metadata">
                                            <div class="date">{{ $data->created_at->diffForHumans() }}</div>
                                            @if ($post->user->id == $data->user_id)
                                                <div class="rating"><i class="fa fa-star" aria-hidden="true"></i> Author</div>
                                            @endif
                                            <div class="">
                                                @if (Auth::check())
                                                    @if (Auth::user()->id === $data->user_id)
                                                        <form action="/kajian/comment/{{ $data->id }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                        </form>
                                                    @endif
                                                @endif
                                            </div>

                                        </div>
                                        <div class="text">
                                            {{ $data->content }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <br>
                            <p class="text-center">Belum ada komentar!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
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
    <script>
        $(function() {
            $("#comments-post").on('click', (e) => {
                e.preventDefault()

                const colCom = $('#collapse-comment');
                if (colCom.hasClass('collapsed')) {
                    colCom.removeClass("collapsed")
                } else {
                    colCom.addClass("collapsed")
                }
            });

            $(".posts-kajian").on('click', '.post-edit', (e) => {
                e.preventDefault();

                const $this = this;

                $("#modal-edit").iziModal({
                    headerColor: "rgba(138, 144, 255, 0.9)",
                    top: 10,
                    overlayClose: false,
                    overlayColor: "rgba(0, 0, 0, 0.6)",
                    afterRender: function() {},
                    onOpening: function(modal) {
                        modal.startLoading();
                        $this.replaceDataInModal(modal);
                        $("form-edit #description").select2({})
                        modal.stopLoading();
                    },
                    onOpened: function(modal) {
                        $("#modal-edit").on("change", "#cities", function() {
                            let _id = $(this).val();

                            if (!_id) {
                                modal.startLoading();
                                $this.isSelected("/cities", "cities", 0, modal);
                            }

                            modal.startLoading();
                            $this.isSelected(
                                "" + _id + "/districts",
                                "districts",
                                0,
                                modal
                            );
                        });

                        $("#modal-edit").on("change", "#image", function() {
                            $("#modal-edit .delete-img").css("display", "block");
                            $("#modal-edit #prev-image img").css(
                                "display",
                                "block"
                            );
                            d_image = false;
                            readURL("-edit", this);
                        });

                        $("#modal-edit .delete-img").on("click", () => {
                            $("#modal-edit .delete-img").css("display", "none");
                            $("#modal-edit #image").val("");

                            $("#modal-edit #prev-image img").css("display", "none");
                            $("#modal-edit #prev-image img").attr("src", "");
                            d_image = true;
                        });

                        let rules = {
                            description: "required",
                            image: {
                                maxsize: 2048000,
                                extension: "jpg|jpeg|png"
                            }
                        };

                        let message = {
                            description: {
                                required: "Kolom harus diisi!"
                            },
                            image: {
                                maxsize: "Ukuran maksimal foto 2 MB",
                                extension:
                                    "File harus berekstensikan *.jpg, *.jpeg atau *.png"
                            }
                        };


                        formValidationEdit(
                            "#form-edit",
                            rules,
                            message,
                            "/kajian/ubah",
                            "POST"
                        );
                    }
                });

                /* Open modal*/
                $("#modal-edit").iziModal("open");
            });

            $(".posts-kajian").on('click', '.post-delete', (e) => {
                e.preventDefault();
            })
        });
    </script>
@endpush
