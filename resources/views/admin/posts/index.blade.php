@extends('layouts.admin')

@section('content')

    @if(session('deleted_post'))
        <p class="bg-danger">{{session('deleted_post')}}</p>
    @endif

    <h1>Index in post</h1>

    <table class="table">
        <thead>
        <tr>

            <th>Post Id</th>
            <th>Photo Id</th>
            <th>Poster Name</th>
            <th>Category Id</th>
            <th>Title</th>
            <th>Body Id</th>
            <th>Created At</th>
            <th>Updated At</th>

        </tr>
        </thead>
        <tbody>

        @if($posts)
            @foreach($posts as $post)
                <tr>

                    <td>{{$post->id}}</td>
                    <td><img height="50" width="50" src="{{$post->photo_id ? $post->photo->file : 'http://placehold.it/400x400'}}" alt=""></td>
                    <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->user->name}}</a></td>
                    <td>{{$post->category_id ? $post->category->name : 'Uncategorize'}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{str_limit($post->body,10)}}</td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>




@stop