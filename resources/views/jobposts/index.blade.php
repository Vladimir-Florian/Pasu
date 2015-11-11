@extends('app')

@section('content')

 <h2> Job Posts for Employer "{{$employer->company_name}}" </h2>
 
   @if(!$employer->jobposts->count())
	   No Job Posts
   @else
	   <ul>
		@foreach ($employer->jobposts as $jobpost)
		 <li>
			
			{!! Form::open(array('class' => 'form-inline', 'method'=>'DELETE', 'route'=>array('employers.jobposts.destroy', $employer->id, $jobpost->id))) !!}
                <a href="{{ route('employers.jobposts.show', array($employer->id, $jobpost->id)) }}">{{ $jobpost->request_date }}</a>
				(
                  {!! link_to_route('employers.jobposts.edit', 'Edit', array($employer->id, $jobpost->id), array('class' => 'btn btn-info')) !!},
                  {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!},				

				  {!! link_to_route('jobpost_locations.create', 'Create Location', $jobpost->id, array('class' => 'btn btn-info')) !!},	
				  {!! link_to_route('jobpost_locations.edit', 'Update Location', $jobpost->id, array('class' => 'btn btn-info')) !!}	

				)
            {!! Form::close() !!}
		 </li>
		@endforeach
	   </ul>
   @endif
		 
	<p>
	    {!! link_to_route('employers.index', 'Back to Employer') !!} |
		{!! link_to_route('employers.jobposts.create', 'Create Job Post', $employer->id) !!}
	</p>
		 
@stop		
		
