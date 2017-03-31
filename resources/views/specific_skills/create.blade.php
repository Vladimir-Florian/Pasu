@extends('app')

@section('content')
	<h1> Create a new Skill for this Specialization</h1>
	
	
	{!! Form::open(['route' => ['specific_skills.store']]) !!}
		@include ('specific_skills.form', ['submitButtonText' => 'Add Skill'])
    {!! Form::close() !!}
	
	@include ('errors.list')
@stop
