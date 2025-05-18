@extends('layouts.frontend.app')
@section('title')
    Edit| {{ $post->title }}
@endsection
@section('body')
    <div class="dashboard container">
        <!-- Sidebar -->
        <aside class="col-md-3 nav-sticky dashboard-sidebar">
            <!-- User Info Section -->
            <div class="user-info text-center p-3">
                <img src="{{ '/storage' . auth()->user()?->image }}" alt="User Image" class="rounded-circle mb-2"
                    style="width: 80px; height: 80px;">
                <!-- style="width: 80px; height: 80px; object-fit: cover" /> -->
                <h5 class="mb-0" style="color: #ff6f61">{{ auth()->user()?->name }}</h5>
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
                <a href="{{ route('frontend.dashboard.setting') }}" class="list-group-item list-group-item-action menu-item"
                    data-section="settings">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content col-md-9">
            <!-- Show/Edit Post Section -->
            @if (session()->has('errors'))
            <div class="alert alert-danger">
                @foreach (session('errors')->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </div>
        @endif
            <form method="post" enctype="multipart/form-data"
                action="{{ route('frontend.dashboard.post.update', $post->id) }}">
                @csrf
                @method('PUT')
                <section id="posts-section" class="posts-section">
                    <h2>Your Posts</h2>
                    <ul class="list-unstyled user-posts">
                        <!-- Example of a Post Item -->
                        <li class="post-item">
                            <!-- Editable Title -->
                            <input type="text" name="title" class="form-control mb-2 post-title"
                                value="{{ $post->title }}" />

                            <!-- Editable Content -->
                            <textarea id="post-desc" name="desc" class="form-control mb-2 post-content">{!! $post->desc !!}</textarea>




                            <!-- Image Upload Input for Editing -->
                            <input id="post-images" name="images[]" type="file" class="form-control mt-2 edit-post-image"
                                accept="image/*" multiple />

                            <!-- Editable Category Dropdown -->
                            <select class="form-control mb-2 post-category" name="categoryId">
                                <!-- <option value="general" >General</option> -->
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected($category->id == $post->category_id)>{{ $category->name }}
                                    </option>
                                @endforeach


                            </select>

                            <!-- Editable Enable Comments Checkbox -->
                            <div class="form-check mb-2">
                                <input class="form-check-input enable-comments" @checked($post->comment_able == 1)
                                    name="commentAble" type="checkbox" />
                                <label class="form-check-label">
                                    Enable Comments
                                </label>
                            </div>

                            <!-- Post Meta: Views and Comments -->
                            <div class="post-meta d-flex justify-content-between">
                                <span class="views">
                                    <i class="fa fa-eye"></i> {{ $post->number_of_views }}
                                </span>
                                <span class="post-comments">
                                    <i class="fas fa-comment"></i> {{ $post->comments()->count() }}
                                </span>
                            </div>

                            <!-- Post Actions -->
                            <div class="post-actions mt-2">

                                <button type="submit" class="btn btn-success save-post-btn">
                                    Save
                                </button>


                                <a href="{{ route('frontend.dashboard.profile') }}" class="btn btn-secondary cancel-edit-btn">
                                    Cancel
                                </a>
                            </div>

                        </li>
                        <!-- Additional posts will be added dynamically -->
                    </ul>
                </section>

            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
 const initialPreview = [
        @if ($post->images->count())
            @foreach ($post->images as $image)
                "{{ '/storage' . $image->path }}",
            @endforeach
        @endif
    ];

    $('#post-images').fileinput({
        enableResumableUpload: false,
        maxFileCount: 5,
        theme: 'fa5',
        allowedFileTypes: ['image'],
        showCancel: true,
        showUpload: false,
        initialPreview: initialPreview,
        initialPreviewAsData: true, // important to show images as thumbnails
        initialPreviewFileType: 'image',
        initialPreviewConfig: [
            @foreach ($post->images as $image)
                {
                    caption: "{{ basename($image->path) }}",
                    key: "{{ $image->id }}",
                    url: "{{ route('frontend.dashboard.post.image.delete', $image->id) }}", // لو عندك route للحذف
                    extra: {
                        _token: "{{ csrf_token() }}"
                    }
                },
            @endforeach
        ],

    });


    // Summer Note
    $('#post-desc').summernote({
            height: 300,
        });
    </script>
@endpush
