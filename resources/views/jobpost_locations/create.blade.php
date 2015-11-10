@extends('app')

@section('content')
	<h1> Create a new Location</h1>
	
	
	{!! Form::open(['route' => ['jobpost_locations.store', array($employer->id, $jobpost->id)]]) !!}
		@include ('jobpost_locations.form', ['submitButtonText' => 'Add Location'])
    {!! Form::close() !!}
	
	@include ('errors.list')
@stop
