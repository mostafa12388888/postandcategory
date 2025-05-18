@extends('layouts.frontend.app')
@section('title')
    Show Posts
@endsection
@section('body')
    <div class="dashboard container">
        <!-- Main Content -->
        <div class="main-content ">
            <!-- Show/Edit Post Section -->
            <!-- <section id="posts-section" class="posts-section"> -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">title</th>
                        <th scope="col">number of view</th>
                        <th scope="col">category</th>
                        <th scope="col">user</th>
                        <th scope="col">create At</th>
                        <th scope="col">update At</th>

                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->number_of_views }}</td>
                            <td>{{ $post->category->name }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td>{{ $post->updated_at }}</td>

                            <td><a href="{{route('frontend.dashboard.post.edit',$post->slug)}}" class="btn btn-blue">Edit</a>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#exampleModal{{ $post->id }}">
                                    Delete </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $post->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">DELETE {{ $post->title }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                are you sure delete post for {{ $post->user->name }} ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                    <form action="{{route('frontend.admin.post.delete')}}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <input type="hidden" name="postId" value="{{$post->id}}">
                                                        <button type="submit" class="btn btn-primary">Delete Post</button>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $posts->links() }}

            <!-- </section> -->
        </div>
    </div>
    <br />
    <br />
    <br />
@endsection
