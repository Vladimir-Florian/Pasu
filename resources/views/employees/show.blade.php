@extends('app')

@section('content')

 <h2> {{ $profile->name }} </h2>
 
	<article>
		{{ $profile->phone_no}}
	</article>
	<article>
		{{ $profile->birthdate}}
	</article>
	<article>
		{{ $profile->experience}}
	</article>

    @if ( !$profile->certificates->count() )
        No certificates
    @else
        <ul>
            @foreach( $profile->certificates as $certificate )
                <li> {{ $certificate->description }}</li>
			@endforeach
        </ul>
    @endif


	<p>
      {!! link_to_route('employees.index', 'Back to Profile Home page') !!} 
	</p>
 

@endsection		
		
