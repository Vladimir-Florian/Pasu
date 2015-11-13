@extends('app')

@section('content')

 <h2> {{$jobpost->employer->company_name}}  {{$jobpost->request_date}} </h2>
 
	<article>
		{{ $jobtag->name }}
	</article>


	<p>
		<a href="{{route('jobpost_jobtags.index', ['id' => $jobpost->id])}}"> Back to Tags for Job Post </a>	
	</p>
 

@endsection		
		
