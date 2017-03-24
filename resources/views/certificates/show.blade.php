@extends('app')

@section('content')

	<h3> {{ $certificate->slug }} </h3>

	<article>
		{{ $certificate->name}}
	</article>

	<article>
		{{ $certificate->description}}
	</article>
	
	<p>
      {!! link_to_route('certificates.index', 'Back to Certificates') !!}
	</p>

@stop		
		
