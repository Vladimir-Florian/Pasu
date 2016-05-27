@extends('app')

@section('content')

 <h2> Post </h2>

	<article>
		Type: {{ $jobpost->jobtype->name}}
	</article>
	<article>
		Employment: {{ $jobpost->employment_type->name}}
	</article>
	<article>
		Title: {{ $jobpost->jobtitle}}
	</article>
 
	<article>
		Experience: {{ $jobpost->experience}}
	</article>
	<article>
		Education: {{ $jobpost->education}}
	</article>
	<article>
		Benefits: {{ $jobpost->benefits}}
	</article>
	<article>
		Incentives: {{ $jobpost->incentives}}
	</article>
	<article>
		Responsabilities: {{ $jobpost->responsabilities}}
	</article>
	<article>
		Salary: {{ $jobpost->salary}}
	</article>
	<article>
		Currency: {{ $jobpost->currency}}
	</article>
	<article>
		Workhours: {{ $jobpost->workhours}}
	</article>
	<article>
		Request_date: {{ $jobpost->request_date }}
	</article>
	<article>
		Award_date: {{ $jobpost->award_date }}
	</article>



	<p>
       <!-- <strong><a href="{{route('candidate_jobposts.forindustry', ['id' => $profile->id])}}"> Back to Specialization </a></strong> -->
	   <!-- <input type="button" value="Go Back!" onclick="history.back(-1)" class="btn btn-primary" /> -->
	   <strong> <a href="{{htmlspecialchars($_SERVER['HTTP_REFERER'])}}" class="btn btn-primary" > Back </a> </strong>
	</p>
 

@endsection		
		
