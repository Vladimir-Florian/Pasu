@extends('app')

@section('content')

 <h2> Jobtypes </h2>
 
   @if(!$jobtypes->count())
	   No jobtypes
   @else
	   <ul>
		@foreach ($jobtypes as $jobtype)
		 <li>
			
                {{ $jobtype->name }}
				(
                 {!! link_to_route('candidate_jobposts.forjobtype', 'Job posts', array($profile->id, $jobtype->id), array('class' => 'btn btn-info')) !!} 
				)

			
		 </li>
		@endforeach
	   </ul>
   @endif
		 
	<p>
	   <a href="{{route('candidate_jobposts.index', ['id' => $profile->id])}}"> Back to Job Posts </a> 
	</p>
		 
@stop		
		
