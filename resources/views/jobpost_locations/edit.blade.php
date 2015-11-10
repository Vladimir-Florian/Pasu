@extends('app')

@section('content')

    <h1> Edit Location </h1>


	{!! Form::model($location, ['method' => 'PATCH','action' => ['LocationsController@update', $location->id]]) !!}
		@include ('locations.form', ['submitButtonText' => 'Update Location'])
    {!! Form::close() !!}

	@include ('errors.list')
	
@stop
