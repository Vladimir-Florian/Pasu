@extends('app')

@section('content')

 <h2> Tags for Job Post "{{$jobpost->employer->company_name}}" "{{$jobpost->request_date}}" </h2>

   @if(!$jobpost->jobtags->count())
	   No tags
   @else
	   <ul>
		@foreach ($jobpost->jobtags as $jobtag)
		 <li>
			
			{!! Form::open(array('class' => 'form-inline', 'method'=>'DELETE', 'route'=>array('jobpost_jobtags.destroy', $jobpost->id, $jobtag->id))) !!}
                <a href="{{ route('jobpost_jobtags.show', array($jobpost->id, $jobtag->id)) }}"> show </a>

				(
                  {!! link_to_route('jobpost_jobtags.edit', 'Edit', array($jobpost->id, $jobtag->id), array('class' => 'btn btn-info')) !!},
                  {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}				
				)
            {!! Form::close() !!}
		 </li>
		@endforeach
	   </ul>
   @endif
		 
	<p>
      {!! link_to_route('employers.jobposts.index', 'Back to Job Post', $jobpost->employer->id) !!} 

	  <a href="{{route('jobpost_jobtags.create', ['id' => $jobpost->id])}}"> Add Tag </a>	
	</p>
		 
@stop		
		
