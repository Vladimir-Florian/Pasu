@extends('app')

@section('content')
	<h2> Add a Certificate for Profile {{ $profile->name }} </h2>
	
	
	{!! Form::open(['route' => ['employees.store']]) !!}
		@include ('profile_certificates.form_v0', ['submitButtonText' => 'Add Certificate'])
		
    {!! Form::close() !!}
	
	@include ('errors.list')
@stop
