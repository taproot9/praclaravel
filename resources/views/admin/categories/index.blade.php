@extends('layouts.admin')

@section('content')
    <h1>Categories</h1>


    <div class="row">

        <div class="col-sm-6">

             {!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!}

                 {{csrf_field()}}

                 <div class="form-group">
                     {!! Form::label('name', 'Name:') !!}
                     {!! Form::text('name', null, ['class'=>'form-control']) !!}
                 </div>


                 <div class="form-group">
                     {!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
                 </div>


                 {!! Form::close() !!}

        </div>

        <div class="col-sm-6">
            <table class="table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>

                </tr>
                </thead>

                <tbody>
                @if($categories)

                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td><a href="{{route('admin.categories.edit', $category->id)}}">{{$category->name}}</a></td>
                            <td>{{$category->created_at ? $category->created_at->diffForHumans() : 'No date'}}</td>
                            <td>{{$category->updated_at ? $category->updated_at->diffForHumans() : 'No date'}}</td>
                        </tr>
                    @endforeach

                @endif


                </tbody>
            </table>
        </div>

    </div>


@stop