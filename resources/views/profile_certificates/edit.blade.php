@extends('app')

@section('content')

    <h2> Edit Profile: {{ $profile->name }} </h2>


	{!! Form::model($profile, ['method' => 'PATCH','action' => ['Profile_certificates@update', $profile->id]]) !!}
		@include ('profile_certificates.form', ['submitButtonText' => 'Update Profile'])
    {!! Form::close() !!}

		
	@include ('errors.list')
	
@stop
