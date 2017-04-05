@extends('app')

@section('content')

    <h2> Edit Licence of Profile: {{ $profile->name }} </h2>

	{!! Form::model($profile, ['method' => 'PATCH','action' => ['DrivinglicenceController@update', $profile->id, $drivinglicence->id]]) !!}
		@include ('drivinglicences.form', ['submitButtonText' => 'Update Licence'])
    {!! Form::close() !!}

	<p>
	<a href="{{route('drivinglicences.index', ['id' => $profile->id])}}"> Back to Driving licences list </a>
	</p>
		
	@include ('errors.list')
	
@stop
