@extends('app')

@section('content')

 <h2> {{ $profile->name }} </h2>

    @if ( !$jobposts->count())
        No Job Posts.
    @else
        <ul>
            @foreach( $jobposts as $jobpost )
				<article>
					Title: {{ "$jobpost->jobtitle" }}
				</article>
				<article>
					Request Date: {{ $jobpost->request_date }}
				</article>
				<article>
					Employer: {{ $jobpost->company_name }}
				</article>
				<p>
            @endforeach
        </ul>
    @endif

 


	<p>
	   <a href="{{route('candidate_jobposts.index', ['id' => $profile->id])}}"> Back to Job Posts </a> 
	</p>
 

@endsection		
		
