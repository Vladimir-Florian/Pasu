@extends('app')

@section('content')
	<h1> Create a new Employment Type</h1>
	
	
	{!! Form::open(['route' => ['employment_types.store']]) !!}
		@include ('employment_types.form', ['submitButtonText' => 'Add Employment Type'])
    {!! Form::close() !!}
	
	@include ('errors.list')
@stop
