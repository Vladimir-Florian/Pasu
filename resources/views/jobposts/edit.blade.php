@extends('app')

@section('content')

    <h2> Edit Job Post: {{ $jobpost->name }} </h2>


	{!! Form::model($jobpost, ['method' => 'PATCH','action' => ['JobpostsController@update', $employer->id, $jobpost->id]]) !!}
		@include ('jobposts.form', ['submitButtonText' => 'Update Job Post'])
    {!! Form::close() !!}

	
	
	@include ('errors.list')
	
@stop
