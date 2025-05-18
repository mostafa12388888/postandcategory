@extends('layouts.frontend.app')
@section('Breadcrumb')
@parent
<li class="breadcrumb-item active">{{$category->name}}</li>

@endsection
@section('title')
{{$category->name}}
@endsection
@section('body')
    <br>
    <br>
    <br>
    <!-- Main News Start-->
    <div class="main-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">



                        @forelse ($posts as $post)
                            <div class="col-md-4">
                                <div class="mn-img">
                                    <img src="{{  '/storage'.$post->images->first()?->path }}" alt="{{ $post->title }}" />
                                    <div class="mn-title">
                                        <a href="">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert-info">
                                this category is empty
                            </div>
                        @endforelse




                    </div>
                    {{$posts->links()}}
                </div>

                <div class="col-lg-3">
                    <div class="mn-list">
                        <h2>Other Categories</h2>
                        <ul>
                            @foreach ($categories as $category)
                                <li> <a href="{{ route('frontend.category.posts', $category->slug) }}" class="dropdown-item"
                                        title="{{ $category->name }}"> {{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News End-->
@endsection
