@extends('app')

@section('content')

	<h3> {{ $industry->slug }} </h3>

	<article>
		{{ $industry->name}}
	</article>

    @if ( !$industry->profiles->count())
        Specialization has no profiles.
    @else
        <ul>
            @foreach( $industry->profiles as $profile )
				<li><a href="{{ route('industries.profiles.show', array($industry->id, $profile->id)) }}">{{ $profile->name }}</a></li>
            @endforeach
        </ul>
    @endif

	
	<p>
      {!! link_to_route('industries.index', 'Back to Specializations') !!} 
	</p>

@stop		
		
