@extends('app')

@section('content')
	<h1> Create a Location for the job post </h1>
	
	
	{!! Form::open(['route' => ['jobpost_locations.store', $jobpost->id]]) !!}
		@include ('jobpost_locations.form', ['submitButtonText' => 'Add Location'])
    {!! Form::close() !!}
	
	@include ('errors.list')
@stop
