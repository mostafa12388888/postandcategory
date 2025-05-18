@extends('layouts.frontend.app')
@section('title')
Home
@endsection
@section('body')
    @php
        $latestThree = $posts->take(3);
    @endphp
    <!-- Top News Start-->
    <div class="top-news">
        <div class="container">
            <div class="row">
                <div class="col-md-6 tn-left">
                    <div class="row tn-slider">
                        @foreach ($latestThree as $post)
                            <div class="col-md-6">
                                <div class="tn-img">
                                    <img src="{{ '/storage'.$post->images->first()?->path }}" />
                                    <div class="tn-title">
                                        <a href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-md-6 tn-right">
                    <div class="row">
                        @php
                            $fourPosts = $posts->take(4);
                        @endphp

                        @foreach ($fourPosts as $post)
                            <div class="col-md-6">
                                <div class="tn-img">
                                    <img src="{{'/storage'. $post->images->first()?->path }}" />
                                    <div class="tn-title">
                                        <a href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top News End-->

    <!-- Category News Start-->
    <div class="cat-news">
        <div class="container">
            <div class="row">

                @foreach ($categoryWithPost as $category)
                    <div class="col-md-6">
                        <h2>{{ $category->name }}</h2>
                        <div class="row cn-slider">
                            @foreach ($category->posts as $post)
                                <div class="col-md-6">

                                    <div class="cn-img">
                                        <img src="{{'/storage'. $post->images->first()?->path }}" />
                                        <div class="cn-title">
                                            <a href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Category News End-->


    <!-- Tab News Start-->
    <div class="tab-news">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#featured">old News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#popular">Popular News</a>
                        </li>

                    </ul>

                    <div class="tab-content">
                        <div id="featured" class="container tab-pane active">
                            @foreach ($oldestNews as $old)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ '/storage'. $old->images->first()?->path }}" />
                                    </div>
                                    <div class="tn-title">
                                        <a href="">{{ $old->title }}</a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div id="popular" class="container tab-pane fade">

                            @foreach ($gratePostComments as $post)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ '/storage'. $post->images->first()?->path }}" />
                                    </div>
                                    <div class="tn-title">
                                        <a href="">{{ $post->title }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                    </div>
                </div>

                <div class="col-md-6">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#m-viewed">Latest Viewed</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#m-read">Most Read</a>
                        </li>

                    </ul>

                    <div class="tab-content">
                        <div id="m-viewed" class="container tab-pane active">
                            @foreach ($latestThree as $post)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{  '/storage'.$post->images->first()?->path }}" />
                                    </div>
                                    <div class="tn-title">
                                        <a href="">{{ $post->title }}</a>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                        <div id="m-read" class="container tab-pane fade">
                            @foreach ($grate_of_views as $grate)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ '/storage'. $grate->images->first()?->path }}" />
                                    </div>
                                    <div class="tn-title">
                                        <a href="">{{ $grate->title }}</a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div id="m-recent" class="container tab-pane fade">
                            <div class="tn-news">
                                <div class="tn-img">
                                    <img src="{{ asset('assets/frontEnd') }}/img/news-350x223-4.jpg" />
                                </div>
                                <div class="tn-title">
                                    <a href="">Lorem ipsum dolor sit amet</a>
                                </div>
                            </div>
                            <div class="tn-news">
                                <div class="tn-img">
                                    <img src="{{ asset('assets/frontEnd') }}/img/news-350x223-5.jpg" />
                                </div>
                                <div class="tn-title">
                                    <a href="">Lorem ipsum dolor sit amet</a>
                                </div>
                            </div>
                            <div class="tn-news">
                                <div class="tn-img">
                                    <img src="{{ asset('assets/frontEnd') }}/img/news-350x223-1.jpg" />
                                </div>
                                <div class="tn-title">
                                    <a href="">Lorem ipsum dolor sit amet</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tab News Start-->

    <!-- Main News Start-->
    <div class="main-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        @foreach ($posts as $post)
                            <div class="col-md-4">
                                <div class="mn-img">
                                    <img src="{{ '/storage'. $post->images->first()?->path }}" />
                                    <div class="mn-title">
                                        <a href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $posts->links() }}
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="mn-list">
                        <h2>Read More</h2>
                        <ul>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News End-->
@endSection
