@extends('app')

@section('content')

 <h2> location </h2>
 
	<article>
		{{ $location->address}}
	</article>
	<article>
		{{ $location->postal_code}}
	</article>
	<article>
		{{ $location->city}}
	</article>
	<article>
		{{ $location->province}}
	</article>
	<article>
		{{ $location->country_code}}
	</article>
	<article>
		{{ $location->latitude}}
	</article>
	<article>
		{{ $location->longitude}}
	</article>
	
	<p>
      {!! link_to_route('locations.index', 'Back to Locations') !!}
	</p>

@stop		
		
