@extends('app')

@section('content')

 <h2> Jobtypes for Specialization "{{$industry->slug}}" </h2>
 
   @if(!$industry->jobtypes->count())
	   No jobtypes
   @else
	   <ul>
		@foreach ($industry->jobtypes as $jobtype)
		 <li>
			
			{!! Form::open(array('class' => 'form-inline', 'method'=>'DELETE', 'route'=>array('industries.jobtypes.destroy', $industry->id, $jobtype->id))) !!}
                <a href="{{ route('industries.jobtypes.show', array($industry->id, $jobtype->id)) }}">{{ $jobtype->name }}</a>
				(
                  {!! link_to_route('industries.jobtypes.edit', 'Edit', array($industry->id, $jobtype->id), array('class' => 'btn btn-info')) !!},
                  {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}				
				)
            {!! Form::close() !!}

			
		 </li>
		@endforeach
	   </ul>
   @endif
		 
	<p>
	    {!! link_to_route('industries.index', 'Back to Specializations') !!} |
		{!! link_to_route('industries.jobtypes.create', 'Create Jobtype', $industry->id) !!}
	</p>
		 
@stop		
		
