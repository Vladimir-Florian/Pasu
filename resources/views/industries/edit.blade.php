@extends('app')

@section('content')

    <h1> Edit: {{ $industry->slug }} </h1>


	{!! Form::model($industry, ['method' => 'PATCH','action' => ['IndustriesController@update', $industry->id]]) !!}
		@include ('industries.form', ['submitButtonText' => 'Update Specialization'])
    {!! Form::close() !!}

	@include ('errors.list')
	
@stop
