@extends('app')

@section('content')
	<h2> Add a tag to Job Post </h2>
	
	
	{!! Form::open(['route'=> ['jobpost_jobtags.store', $jobpost->id]]) !!}	
		@include ('jobpost_jobtags.cr_form', ['submitButtonText' => 'Add Tag'])
		
    {!! Form::close() !!}
	
	@include ('errors.list')
	
	<p>
	<a href="{{route('jobpost_jobtags.index', ['id' => $jobpost->id])}}"> Back to Tags </a>
	</p>
	
@stop
