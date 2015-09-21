@extends('app')

@section('content')

    <h2> Edit Location {{ $location->pivot->location_type }} of Profile: {{ $profile->name }} </h2>

	{!! Form::model($profile, ['method' => 'PATCH','action' => ['Profile_locations@update', $profile->id, $location->id]]) !!}
		@include ('profile_locations.form', ['submitButtonText' => 'Update Profile'])
    {!! Form::close() !!}

		
	@include ('errors.list')
	
@stop
