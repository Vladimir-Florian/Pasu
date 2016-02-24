@extends('app')

@section('content')

 <h2> Resume for Profile "{{$profile->name}}" </h2>

   @if(!$profile->resume)
	   No resume
   @else
	   <ul>
		 <li>
			
			{!! Form::open(array('class' => 'form-inline', 'method'=>'DELETE', 'route'=>array('profile_resume.destroy', $profile->id))) !!}
				<article>
					{{ $profile->resume->cv }}
				</article>

				(
                  {!! link_to_route('profile_resume.edit', 'Edit', array($profile->id), array('class' => 'btn btn-info')) !!},
                  {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}				
				)
            {!! Form::close() !!}
		 </li>
	   </ul>
   @endif
		 
	<p>
      {!! link_to_route('employees.index', 'Back to Profile') !!} 
	   <!--	<a href="{{route('employees.index', ['id' => $profile->id])}}"> Back to Profile </a> -->
		<a href="{{route('profile_resume.create', ['id' => $profile->id])}}"> Create Resume </a>	
	</p>
		 
@stop		
		
