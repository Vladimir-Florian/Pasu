@extends('app')

@section('content')
	<h1> Create a new Specialization</h1>
	
	
	{!! Form::open(['route' => ['industries.store']]) !!}
		@include ('industries.form', ['submitButtonText' => 'Add Specialization'])
    {!! Form::close() !!}
	
	@include ('errors.list')
@stop
