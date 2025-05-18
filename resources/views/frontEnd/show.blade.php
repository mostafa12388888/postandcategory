@extends('layouts.frontend.app')
@section('title')
    show{{ $mainPost->title }}
@endsection

@section('body')

    <!-- Single News Start-->
    <div class="single-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-8" style="word-wrap: break-word; overflow-wrap: break-word;">
                    <!-- Carousel -->
                    <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#newsCarousel" data-slide-to="1"></li>
                            <li data-target="#newsCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            @foreach ($mainPost->images as $image)
                                <div class="carousel-item @if ($loop->index == 0) active @endif">
                                    <img src="{{ '/storage' . $image->path }}" class="d-block w-100"
                                        alt="{{ $mainPost->title }}">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>{{ $mainPost->name }}</h5>
                                        <p>
                                            {{ Str::limit(strip_tags($mainPost->desc), 80) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Add more carousel-item blocks for additional slides -->
                        </div>
                        <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="sn-content">
                        <p> {!! chunk_split($mainPost->desc, 70) !!}</p>
                    </div>

                    <!-- Comment Section -->
                    @if ($mainPost->comment_able)
                        <div class="comment-section">
                            <!-- Comment Input -->
                            <form method="post" id="commentForm">
                                @csrf
                                <div class="comment-input">

                                    <input id="commentInput" name="comment" type="text" placeholder="Add a comment..."
                                        id="commentBox" />
                                    <input name="userId" type="hidden" value="{{ auth('web')->user()->id }}" />
                                    <input name="postId" type="hidden" value="{{ $mainPost->id }}" />
                                    <button id="addCommentBtn" type="submit">Comment</button>
                                </div>
                            </form>
                            <div style="display: none" id="error-message" class="alert alert-danger">
                                <!-- display Error -->
                            </div>

                            <!-- Display Comments -->
                            <div class="comments">
                                @forelse ($mainPost->comments as $comment)
                                    <div class="comment">
                                        <img src="{{ '/storage' . $comment->user->image }}" alt="User Image"
                                            class="comment-img" />
                                        <div class="comment-content">
                                            <span class="username">{{ $comment->user->name }}</span>
                                            <p class="comment-text">{{ $comment->comment }}</p>
                                        </div>
                                    </div>
                                @empty
                                @endforelse

                                <!-- Add more comments here for demonstration -->
                            </div>

                            <!-- Show More Button -->
                            @if ($mainPost->comments->count() > 2)
                                <button id="showMoreBtn" class="show-more-btn">Show more</button>
                            @endif
                        </div>
                    @endif

                    <!-- Related News -->
                    <div class="sn-related">
                        <h2>Related News</h2>
                        <div class="row sn-slider">
                            @foreach ($category_posts as $post)
                                <div class="col-md-4">
                                    <div class="sn-img">
                                        <img src="{{ '/storage' . $post->images->first()?->path }}" class="img-fluid"
                                            alt="Related News 1" />
                                        <div class="sn-title">
                                            <a
                                                href="{{ route('frontend.post.show', $mainPost->slug) }}">{{ $mainPost->title }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <h2 class="sw-title">In This Category</h2>
                            <div class="news-list">
                                @foreach ($category_posts as $post)
                                    <div class="nl-item">
                                        <div class="nl-img">
                                            <img src="{{ '/storage' . $post->images->first()?->path }}" />
                                        </div>
                                        <div class="nl-title">
                                            <a
                                                href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}</a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <div class="image">
                                <a href="https://htmlcodex.com"><img src="img/ads-2.jpg" alt="Image" /></a>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <div class="tab-news">
                                <ul class="nav nav-pills nav-justified">

                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#popular">Popular</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#latest">Latest</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div id="popular" class="container tab-pane fade">
                                        @foreach ($gratePostComments as $post)
                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img src="{{ '/storage' . $post->images->first()?->path }}"
                                                        alt="{{ $post->title }}" />
                                                </div>
                                                <div class="tn-title">
                                                    <a
                                                        href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}</a>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div id="latest" class="container tab-pane fade">
                                        @foreach ($latestPost as $post)
                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img src="{{ '/storage' . $post->images->first()?->path }}"
                                                        alt="{{ $post->title }}" />
                                                </div>
                                                <div class="tn-title">
                                                    <a
                                                        href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}</a>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-widget">
                            <h2 class="sw-title">News Category</h2>
                            <div class="category">
                                <ul>
                                    @foreach ($categories as $category)
                                        <li><a
                                                href="{{ route('frontend.category.posts', $category->slug) }}">{{ $category->name }}</a>
                                            <span>({{ $category->posts->count() }})</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <h2 class="sw-title">Tags Cloud</h2>
                            <div class="tags">
                                <a href="">National</a>
                                <a href="">International</a>
                                <a href="">Economics</a>
                                <a href="">Politics</a>
                                <a href="">Lifestyle</a>
                                <a href="">Technology</a>
                                <a href="">Trades</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single News End-->
@endsection
@push('js')
    <script>
        // show all comments start
        $(document).on('click', '#showMoreBtn', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('frontend.comment.show', $mainPost->slug) }}",
                type: 'GET',
                success: function(data) {
                    $('.comments').empty();
                    $.each(data, function(key, comment) {
                        let imagePath = comment.user?.image ? `/storage/${comment.user.image}` :
                            '/default-user.png';

                        $('.comments').append(`
                    <div class="comment d-flex mb-3">
                        <img src="${imagePath}" alt="User Image" class="comment-img me-2" style="width:40px;height:40px;border-radius:50%;" />
                        <div class="comment-content">
                            <span class="username fw-bold">${comment.user.name}</span>
                            <p class="comment-text mb-0">${comment.comment}</p>
                        </div>
                    </div>
                `);
                    });
                    $('#showMoreBtn').hide();
                },
                error: function(xhr) {
                    console.error('Error loading comments', xhr);
                }
            });
        });
        // show all comments end

        // save comment

        $(document).on('submit', '#commentForm', function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: "{{ route('frontend.comment.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    const comment = response.data;
                    const user = comment.user;

                    // التأكد من وجود صورة للمستخدم
                    const imagePath = user.image ? `/storage/${user.image}` : '/default-user.png';

                    $('#error-message').fadeOut();
                    $('#commentInput').val('');

                    $('.comments').prepend(`
                <div class="comment d-flex mb-3">
                    <img src="${imagePath}" alt="User Image" class="comment-img me-2" style="width: 40px; height: 40px; border-radius: 50%;" />
                    <div class="comment-content">
                        <span class="username fw-bold">${user.name}</span>
                        <p class="comment-text mb-0">${comment.comment}</p>
                    </div>
                </div>
            `);
                },
                error: function(xhr) {
                    const message = xhr.responseJSON?.message || 'حدث خطأ أثناء إرسال التعليق.';
                    $('#error-message').text(message).fadeIn();

                    setTimeout(function() {
                        $('#error-message').fadeOut();
                    }, 5000);
                }
            });
        });
    </script>
@endpush
