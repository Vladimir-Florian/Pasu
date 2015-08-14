@extends('app')

@section('content')
	<h1> Create a new Certification</h1>
	
	
	{!! Form::open(['route' => ['certificates.store']]) !!}
		@include ('certificates.form', ['submitButtonText' => 'Add Certification'])
    {!! Form::close() !!}
	
	@include ('errors.list')
@stop
