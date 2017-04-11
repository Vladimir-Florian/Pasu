@extends('app')

@section('content')

    <h2> Edit language: {{ $language->name }} of Profile: {{ $profile->name }} </h2>

	{!! Form::model($profile, ['method' => 'PATCH','action' => ['Profile_languagesController@update', $profile->id, $language->id]]) !!}
		@include ('profile_languages.form', ['submitButtonText' => 'Update Profile'])
    {!! Form::close() !!}

		
	@include ('errors.list')
	
@stop
