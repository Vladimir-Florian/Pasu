@extends('app')

@section('content')

    <h1> Edit: {{ $certificate->slug }} </h1>


	{!! Form::model($certificate, ['method' => 'PATCH','action' => ['CertificatesController@update', $certificate->id]]) !!}
		@include ('certificates.form', ['submitButtonText' => 'Update Certificate'])
    {!! Form::close() !!}

	@include ('errors.list')
	
@stop
