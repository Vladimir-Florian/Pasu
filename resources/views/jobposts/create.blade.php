@extends('app')

@section('content')
	<h2> Create a Job Post for Employer "{{$employer->company_name}}"</h2>
	
	
	{!! Form::open(['route' => ['employers.jobposts.store', $employer->id]]) !!}
		@include ('jobposts.form', ['submitButtonText' => 'Add Post'])
    {!! Form::close() !!}
	
	
	@include ('errors.list')
@stop
