@extends('layouts.admin')


@section('styles')
    <link rel="stylesheet" href="{{asset('css/dropzone.min.css')}}">

@stop

@section('content')

    <h1>Upload Media</h1>

    {!! Form::open(['method'=>'POST', 'action'=>'AdminMediasController@store', 'class' => 'dropzone', 'files' => true]) !!}

    {!! Form::close() !!}


@stop


@section('scripts')

    <script src="{{asset('js/dropzone.min.js')}}"></script>



@stop