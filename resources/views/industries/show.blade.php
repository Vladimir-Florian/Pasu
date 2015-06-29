@extends('app')

@section('content')

	<h3> {{ $industry->slug }} </h3>

	<article>
		{{ $industry->name}}
	</article>
	
	<p>
      {!! link_to_route('industries.index', 'Back to Specializations') !!} |
	</p>

@stop		
		
