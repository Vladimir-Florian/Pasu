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



	<p>
      {!! link_to_route('employees.index', 'Back to Profiles') !!} 
	</p>
 

@endsection		
		
