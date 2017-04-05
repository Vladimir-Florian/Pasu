@extends('app')

@section('content')
	<h2> Add a Licence type for Profile {{ $profile->name }} </h2>
	
	{!! Form::open(['route'=> ['drivinglicences.store', $profile->id]]) !!}	
		@include ('drivinglicences.form', ['submitButtonText' => 'Add Licence type'])
		
    {!! Form::close() !!}
	
	
	@include ('errors.list')
@stop
