@extends('app')

@section('content')

    <h2> Edit Profile: {{ $profile->name }} </h2>


	{!! Form::model($profile, ['method' => 'PATCH','action' => ['ProfilesController@update', $industry->id, $profile->id]]) !!}
		@include ('profiles.form', ['submitButtonText' => 'Edit Profile'])
    {!! Form::close() !!}

	
	
	@include ('errors.list')
	
@stop
