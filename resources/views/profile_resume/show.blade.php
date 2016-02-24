@extends('app')

@section('content')

 <h2> {{ $profile->name }} </h2>
 
	<article>
		{{ $location->address }}
	</article>
	<article>
		{{ $location->postal_code }}
	</article>
	<article>
		{{ $location->city }}
	</article>
	<article>
		{{ $location->province }}
	</article>
	<article>
		{{ $location->country_code }}
	</article>
	<article>
		{{ $location->latitude }}
	</article>
	<article>
		{{ $location->longitude }}
	</article>
	<p>
	
	</p>
	<article>
		{{ $location->pivot->location_type }}
	</article>
	<article>
		{{ $location->pivot->start_date }}
	</article>
	<article>
		{{ $location->pivot->end_date }}
	</article>


	<p>
		<a href="{{route('profile_locations.index', ['id' => $profile->id])}}"> Back to Locations for Profile </a>	
	</p>
 

@endsection		
		
