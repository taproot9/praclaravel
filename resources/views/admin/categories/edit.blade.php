@extends('layouts.admin')

@section('content')

    <h1>Edit Categories</h1>


    <div class="row">


        <div class="col-sm-6">

            {!! Form::model($category, ['method'=>'PATCH', 'action'=>['AdminCategoriesController@update', $category->id]]) !!}

            {{csrf_field()}}

            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', $category->name, ['class'=>'form-control']) !!}
            </div>


            <div class="form-group">
                {!! Form::submit('Update Category', ['class'=>'btn btn-primary col-sm-6']) !!}
            </div>


            {!! Form::close() !!}

            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminCategoriesController@destroy', $category->id]]) !!}

            <div class="form-group">
                {!! Form::submit('Delete Category', ['class'=>'btn btn-danger col-sm-6']) !!}
            </div>

            {!! Form::close() !!}

        </div>

    </div>

@stop