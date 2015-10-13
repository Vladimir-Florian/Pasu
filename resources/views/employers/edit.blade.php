@extends('app')

@section('content')

    <h2> Edit Employer: {{ $employer->name }} </h2>


	{!! Form::model($employer, ['method' => 'PATCH','action' => ['EmployersController@update', $employer->id]]) !!}
		@include ('employers.form_ed', ['submitButtonText' => 'Update Employer'])
    {!! Form::close() !!}

	
	
	@include ('errors.list')
	
@stop
