@extends('app')

@section('content')

 <h2> {{ $profile->name }} </h2>
 

    @if ( !$profile->certificates->count())
        Profile has no certificates.
    @else
        <ul>
            @foreach( $$profile->certificates as $certificate )

				<li> {{ $certificate->slug}}</li>
				<li> {{ $certificate->description}}</li>
				<li> {{ $certificate->pivot->details}}</li>

            @endforeach
        </ul>
    @endif



	<p>
		<a href="{{route('profile_certificates.index', ['id' => $profile->id])}}"> Back to Profile_Certificates </a>	
	</p>
 

@endsection		
		
