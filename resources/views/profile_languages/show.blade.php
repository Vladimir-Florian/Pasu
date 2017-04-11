@extends('app')

@section('content')

 <h2> {{ $profile->name }} </h2>
 
	<article>
		{{ $language->slug }}
	</article>
	<article>
		{{ $language->name }}
	</article>
	<article>
		{{ $level->name }}
	</article>


	<p>
		<a href="{{route('profile_languages.index', ['id' => $profile->id])}}"> Back to languages for Profile </a>	
	</p>
 

@endsection		
		
