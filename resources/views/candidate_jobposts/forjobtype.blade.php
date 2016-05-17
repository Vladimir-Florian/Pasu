@extends('app')

@section('content')

 <h2> Jobtypes </h2>
 
   @if(!$jobposts->count())
	   No job posts
   @else
	   <ul>
		@foreach ($jobposts as $jobpost)
		 <li>
			
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
			
		 </li>
		@endforeach
	   </ul>
   @endif
		 
	<p>
        <strong><a href="{{route('candidate_jobposts.jobtypes', ['id' => $profile->id])}}"> By Job Type </a></strong>
	</p>
		 
@stop		
		
