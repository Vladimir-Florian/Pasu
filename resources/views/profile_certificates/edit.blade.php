@extends('app')

@section('content')

    <h2> Edit Profile: {{ $profile->name }} </h2>


	{!! Form::model($profile, ['method' => 'PATCH','action' => ['EmployeeController@update', $profile->id]]) !!}
		@include ('profiles.form', ['submitButtonText' => 'Update Profile'])
    {!! Form::close() !!}

	
	
	@include ('errors.list')
	
@stop
