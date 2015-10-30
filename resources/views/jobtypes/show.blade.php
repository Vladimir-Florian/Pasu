@extends('app')

@section('content')

 <h2> {{ $jobtype->name }} </h2>
 
	<article>
		{{ $jobtype->description}}
	</article>
	<article>
		{{ $jobtype->occupational_category}}
	</article>



	<p>
      {!! link_to_route('industries.jobtypes.index', 'Back to Jobtypes', $industry->id) !!} 
	</p>
 

@endsection		
		
