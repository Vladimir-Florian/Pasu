@extends('app')

@section('content')

    <h1> Edit: {{ $specific_skill->slug }} </h1>


	{!! Form::model($specific_skill, ['method' => 'PATCH','action' => ['SpecificSkillsController@update', $specific_skill->id]]) !!}
		@include ('specific_skills.form', ['submitButtonText' => 'Update specific_skill'])
    {!! Form::close() !!}

	@include ('errors.list')
	
@stop
