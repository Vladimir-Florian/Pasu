@extends('app')

@section('content')

    <h1> Edit: </h1>


	{!! Form::model($employment_type, ['method' => 'PATCH','action' => ['Employment_typesController@update', $employment_type->id]]) !!}
		@include ('employment_types.form', ['submitButtonText' => 'Update Employment Type'])
    {!! Form::close() !!}

	@include ('errors.list')
	
@stop
