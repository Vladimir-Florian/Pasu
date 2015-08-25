@extends('app')

@section('content')
	<h2> Add a Certificate for Profile {{ $profile->name }} </h2>
	
	
	{!! Form::open(['route'=> ['profile_certificates.store', $profile->id]]) !!}	
		@include ('profile_certificates.cr_form', ['submitButtonText' => 'Add Certificate'])
		
    {!! Form::close() !!}
	
	@include ('errors.list')
@stop
