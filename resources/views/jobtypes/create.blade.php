@extends('app')

@section('content')
	<h2> Create a Jobtype for Specialization "{{$industry->slug}}"</h2>
	
	
	{!! Form::open(['route' => ['industries.jobtypes.store', $industry->id]]) !!}
		@include ('jobtypes.form', ['submitButtonText' => 'Add profile'])
    {!! Form::close() !!}
	
	@include ('errors.list')
@stop
