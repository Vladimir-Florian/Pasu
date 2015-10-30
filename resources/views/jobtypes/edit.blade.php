@extends('app')

@section('content')

    <h2> Edit Jobtype: {{ $jobtype->name }} </h2>


	{!! Form::model($jobtype, ['method' => 'PATCH','action' => ['JobtypesController@update', $industry->id, $jobtype->id]]) !!}
		@include ('jobtypes.form', ['submitButtonText' => 'Edit Jobtype'])
    {!! Form::close() !!}

	
	
	@include ('errors.list')
	
@stop
