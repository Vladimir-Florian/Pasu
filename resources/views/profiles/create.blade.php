@extends('app')

@section('content')
	<h2> Create a Profile for Specialization "{{$industry->slug}}"</h2>
	
	
	{!! Form::open(['route' => ['industries.profiles.store', $industry->id]]) !!}
		@include ('profiles.form', ['submitButtonText' => 'Add profile'])
    {!! Form::close() !!}
	
	@include ('errors.list')
@stop
