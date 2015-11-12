@extends('app')

@section('content')

    <h2> Change Tag  </h2>

	{!! Form::model($jobpost, ['method' => 'PATCH','action' => ['Jobpost_jobtagsController@update', $jobpost->id, $jobtag->id]]) !!}
		@include ('jobpost_jobtags.cr_form', ['submitButtonText' => 'Update Post'])
    {!! Form::close() !!}

		
	@include ('errors.list')
	
@stop
