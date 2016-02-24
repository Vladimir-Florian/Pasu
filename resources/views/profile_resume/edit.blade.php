@extends('app')

@section('content')

    <h2> Edit Resume of Profile: {{ $profile->name }} </h2>

	{!! Form::model($profile->resume, ['method' => 'PATCH','action' => ['ResumesController@update', $profile->id]]) !!}
		@include ('profile_resume.form', ['submitButtonText' => 'Update CV'])
    {!! Form::close() !!}

		
	@include ('errors.list')
	
@stop
