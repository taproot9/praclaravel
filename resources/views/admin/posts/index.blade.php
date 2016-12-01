@extends('layouts.admin')

@section('content')

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
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->category_id ? $post->category->name : 'Uncategorize'}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->body}}</td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>




@stop