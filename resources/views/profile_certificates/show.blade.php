@extends('app')

@section('content')

 <h2> {{ $profile->name }} </h2>
 
	<article>
		{{ $certificate->slug }}
	</article>
	<article>
		{{ $certificate->description }}
	</article>
	<article>
		{{ $certificate->pivot->details }}
	</article>


	<p>
		<a href="{{route('profile_certificates.index', ['id' => $profile->id])}}"> Back to Certificates for Profile </a>	
	</p>
 

@endsection		
		
