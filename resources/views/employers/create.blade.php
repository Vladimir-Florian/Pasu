@extends('app')

@section('content')
	<h2> Create Employer Info for "{{Auth::user()->name}}"</h2>
	
	
	{!! Form::open(['route' => ['employers.store']]) !!}
		@include ('employers.form', ['submitButtonText' => 'Add employer'])
    {!! Form::close() !!}
	
	@include ('errors.list')
@stop
