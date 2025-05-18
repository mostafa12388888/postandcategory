@extends('layouts.frontend.app')
@section('title')
    {{ config('app.name') }} | profile
@endsection
@section('body')
    <!-- Profile Start -->
    <div class="dashboard container">
        <!-- Sidebar -->
        <aside class="col-md-3 nav-sticky dashboard-sidebar">
            <!-- User Info Section -->
            <div class="user-info text-center p-3">
                <img src="{{ '/storage' . auth('web')->user()->image }}" alt="User Image" class="rounded-circle mb-2"
                    style="width: 80px; height: 80px;">
                <!-- style="width: 80px; height: 80px; object-fit: cover" /> -->
                <h5 class="mb-0" style="color: #ff6f61">{{ auth('web')->user()->name }}</h5>
            </div>

            <!-- Sidebar Menu -->
            <div class="list-group profile-sidebar-menu">
                <a href="{{ route('frontend.dashboard.profile') }}"
                    class="list-group-item list-group-item-action active menu-item" data-section="profile">
                    <i class="fas fa-user"></i> Profile
                </a>
                <a href="./notifications.html" class="list-group-item list-group-item-action menu-item"
                    data-section="notifications">
                    <i class="fas fa-bell"></i> Notifications
                </a>
                <a href="{{route('frontend.dashboard.setting')}}" class="list-group-item list-group-item-action menu-item" data-section="settings">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Profile Section -->
            <section id="profile" class="content-section active">
                <h2>User Profile</h2>
                <div class="user-profile mb-3">
                    <img src="{{ '/storage' . auth('web')->user()->image }}" alt="User Image"
                        class="profile-img rounded-circle" style="width: 100px; height: 100px;" />
                    <span class="username">{{ auth('web')->user()->name }}</span>
                </div>
                <br>

                <!-- Add Post Section -->
                @if (session()->has('errors'))
                    <div class="alert alert-danger">
                        @foreach (session('errors')->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach
                    </div>
                @endif
                <form action="{{ route('frontend.dashboard.post.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <section id="add-post" class="add-post-section mb-5">
                        <h2>Add Post</h2>
                        <div class="post-form p-3 border rounded">
                            <!-- Post Title -->
                            <input type="text" name="title" id="postTitle" class="form-control mb-2"
                                placeholder="Post Title" />

                            <!-- Post Content -->
                            <textarea id="postContent" name="desc" class="form-control mb-2" rows="3" placeholder="What's on your mind?"></textarea>

                            <!-- Image Upload -->
                            <input type="file" name="images[]" id="postImage" class="form-control mb-2" accept="image/*"
                                multiple />
                            <div class="tn-slider mb-2">
                                <div id="imagePreview" class="slick-slider"></div>
                            </div>

                            <!-- Category Dropdown -->
                            <select id="postCategory" name="categoryId" class="form-control mb-2">
                                <option value="" selected>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <br />

                            <!-- Enable Comments Checkbox -->
                            <label class="form-check-label mb-2">
                                Enable Comments : <input name="commentAble" type="checkbox" class="form-check-input" />
                            </label><br>

                            <!-- Post Button -->
                            <button type="submit" class="btn btn-primary post-btn">Post</button>
                        </div>
                    </section>
                </form>

                <!-- Posts Section -->
                <section id="posts" class="posts-section">
                    <h2>Recent Posts</h2>
                    <div class="post-list">
                        <!-- Post Item -->
                        @forelse ($posts as $post)
                            <div class="post-item mb-4 p-3 border rounded">
                                <div class="post-header d-flex align-items-center mb-2">
                                    <img src="/storage{{$post->images->first()?->path}}" alt="User Image" class="rounded-circle"
                                        style="width: 50px; height: 50px;" />
                                    <div class="ms-3">
                                        <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                                    </div>
                                </div>
                                <h4 class="post-title">{{ $post->title }}</h4>
                                <div style="word-wrap: break-word; overflow-wrap: break-word;">
                                    <p class="post-content">{!! chunk_split($post->desc, 70) !!}</p>

                                </div>
                                <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#newsCarousel" data-slide-to="1"></li>
                                        <li data-target="#newsCarousel" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        @foreach ($post->images as $index => $image)
                                            <div class="carousel-item @if ($index == 0) 'active' @endif">
                                                <img src="{{ '/storage' . $image->path }}" class="d-block w-100"
                                                    alt="{{ $post->title }}">
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h5>{{ $post->title }}</h5>
                                                    <p>
                                                        {{ Str::limit(strip_tags($post->desc), 60) }}

                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach


                                        <!-- Add more carousel-item blocks for additional slides -->
                                    </div>
                                    <a class="carousel-control-prev" href="#newsCarousel" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#newsCarousel" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                                <div class="post-actions d-flex justify-content-between">
                                    <div class="post-stats">
                                        <!-- View Count -->
                                        <span class="me-3">
                                            <i class="fas fa-eye"></i> {{ $post->number_of_views }}
                                        </span>
                                    </div>

                                    <div>
                                        <a href="{{ route('frontend.dashboard.post.edit', $post->slug) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="javascript:void(0)"
                                            onclick="if(confirm('are you sure delete this post?')){document.getElementById('delete-form_{{ $post->id }}').submit()}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-thumbs-up"></i> Delete
                                        </a>

                                        <button id="getComment-btn{{ $post->id }}" class="getComment"
                                            post-id="{{ $post->id }}"
                                            data-url="{{ route('frontend.dashboard.post.comments', ['id' => $post->id]) }}"
                                            class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-comment"></i> Comments
                                        </button>
                                        <button id="hide-Comment-btn{{ $post->id }}" class="hideComment"
                                            post-id="{{ $post->id }}" class="btn btn-sm btn-outline-secondary"
                                            style="display: none;">
                                            <i class="fas fa-comment"></i> Hide Comments
                                        </button>
                                        <form id="delete-form_{{ $post->id }}"
                                            action="{{ route('frontend.dashboard.post.delete') }}" method="post">
                                            @csrf
                                            <input name="postId" type="hidden" value="{{ $post->id }}">
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>

                                <!-- Display Comments -->
                                <div id="displayComment_{{ $post->id }}" class="comments">

                                    <!-- Add more comments here for demonstration -->
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info">
                                No Posts !
                            </div>
                        @endforelse

                        <!-- Add more posts here dynamically -->
                    </div>
                </section>
            </section>
        </div>
    </div>
    <!-- Profile End -->
@endsection
@push('js')
    <script>
        $(function() {
            $("#postImage").fileinput({
                enableResumableUpload: false,
                maxFileCount: 5,
                theme: 'fa5',
                allowedFileTypes: ['image'], // allow only images
                showCancel: true,
                showUpload: false,
            });

        });

        $('#postContent').summernote({
            height: 300,
        });
    </script>
    <script>
        $(document).on('click', '.getComment', function(e) {
            e.preventDefault();
            var postId = $(this).attr('post-id');

            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: "get",
                success: function(data) {
                    $('#displayComment_' + postId).empty()
                    $.each(data.data, function(key, value) {
                        $('#displayComment_' + postId).append(`
                                   <div class="comment">
                                        <img src="/storage${value.user.image}" alt="User Image" class="comment-img" />
                                        <div class="comment-content">
                                            <span class="username">${value.user.name}</span>
                                            <p class="comment-text">${value.comment}</p>
                                        </div>
                                    </div>

                            `).show();
                    })
                    $('#getComment-btn' + postId).hide()
                    $('#hide-Comment-btn' + postId).show()
                },
                error: function() {},

            })

        })
        //  hide post comments
        $(document).on('click', '.hideComment', function(e) {
            e.preventDefault();
            var postId = $(this).attr('post-id');
            $('#getComment-btn' + postId).show();
            $('#hide-Comment-btn' + postId).hide();
            $('#displayComment_' + postId).empty();

        })
    </script>
@endpush
