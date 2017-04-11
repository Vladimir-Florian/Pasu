@extends('app')

@section('content')
	<h2> Add a Language for Profile {{ $profile->name }} </h2>
	
	
	{!! Form::open(['route'=> ['profile_languages.store', $profile->id]]) !!}	
		@include ('profile_languages.cr_form', ['submitButtonText' => 'Add Language'])
		
    {!! Form::close() !!}
	
	@include ('errors.list')
	
	<p>
	<a href="{{route('profile_languages.index', ['id' => $profile->id])}}"> Back to Languages </a>
	</p>
	
@stop
