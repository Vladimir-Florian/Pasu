@extends('app')

@section('content')

 <h2> Post </h2>

	<article>
		{{ $jobpost->request_date }}
	</article>
 
	<article>
		{{ $jobpost->experience}}
	</article>
	<article>
		{{ $jobpost->education}}
	</article>
	<article>
		{{ $jobpost->benefits}}
	</article>
	<article>
		{{ $jobpost->incentives}}
	</article>
	<article>
		{{ $jobpost->responsabilities}}
	</article>
	<article>
		{{ $jobpost->salary}}
	</article>
	<article>
		{{ $jobpost->currency}}
	</article>
	<article>
		{{ $jobpost->workhours}}
	</article>



	<p>
      {!! link_to_route('employers.jobposts.index', 'Back to Job Posts', $employer->id) !!} 
	</p>
 

@endsection		
		
