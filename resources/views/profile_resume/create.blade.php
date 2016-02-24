@extends('app')

@section('content')
	<h2> Resume for Profile {{ $profile->name }} </h2>
	
	
	{!! Form::open(['route'=> ['profile_resume.store', $profile->id],
					'class' => 'form',
					'novalidate' => 'novalidate',
					'files' => true ]) !!}
					
		@include ('profile_resume.cr_form', ['submitButtonText' => 'Create Resume'])
		
    {!! Form::close() !!}
	
	@include ('errors.list')
	
	<p>
	<a href="{{route('profile_resume.index', ['id' => $profile->id])}}"> Back to Resume </a>
	</p>
	
@stop
