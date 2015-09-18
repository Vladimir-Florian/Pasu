@extends('app')

@section('content')
	<h2> Add a Location for Profile {{ $profile->name }} </h2>
	
	
	{!! Form::open(['route'=> ['profile_locations.store', $profile->id]]) !!}	
		@include ('profile_locations.form', ['submitButtonText' => 'Add Location'])
		
    {!! Form::close() !!}
	
	@include ('errors.list')
	
	<p>
	<a href="{{route('profile_locations.index', ['id' => $profile->id])}}"> Back to Locations </a>
	</p>
	
@stop
