@extends('app')

@section('content')

    <h1> Edit Location for the job post </h1>


	{!! Form::model($location, ['method' => 'PATCH','action' => ['Jobpost_locationsController@update', $jobpost->id]]) !!}
		@include ('jobpost_locations.form', ['submitButtonText' => 'Update Location'])
    {!! Form::close() !!}

	@include ('errors.list')
	
@stop
