@extends('app')

@section('content')
	<h2> Create a Profile for "{{Auth::user()->name}}"</h2>
	
	
	{!! Form::open(['route' => ['employees.store', $industry->id]]) !!}
		@include ('employees.form', ['submitButtonText' => 'Add employee profile'])
    {!! Form::close() !!}
	
	@include ('errors.list')
@stop
