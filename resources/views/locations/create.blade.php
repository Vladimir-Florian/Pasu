@extends('app')

@section('content')
	<h1> Create a new Location</h1>
	
	
	{!! Form::open(['route' => ['locations.store']]) !!}
		@include ('locations.form', ['submitButtonText' => 'Add Location'])
    {!! Form::close() !!}
	
	@include ('errors.list')
@stop
