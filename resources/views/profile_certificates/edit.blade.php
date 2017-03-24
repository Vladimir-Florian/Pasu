@extends('app')

@section('content')

    <h2> Edit Certificate: {{ $certificate->name }} of Profile: {{ $profile->name }} </h2>

	{!! Form::model($profile, ['method' => 'PATCH','action' => ['Profile_certificates@update', $profile->id, $certificate->id]]) !!}
		@include ('profile_certificates.form', ['submitButtonText' => 'Update Profile'])
    {!! Form::close() !!}

		
	@include ('errors.list')
	
@stop
