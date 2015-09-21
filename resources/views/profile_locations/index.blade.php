@extends('app')

@section('content')

 <h2> Locations for Profile "{{$profile->name}}" </h2>

   @if(!$profile->locations->count())
	   No locations
   @else
	   <ul>
		@foreach ($profile->locations as $location)
		 <li>
			
			{!! Form::open(array('class' => 'form-inline', 'method'=>'DELETE', 'route'=>array('profile_locations.destroy', $profile->id, $location->id))) !!}
                <a href="{{ route('profile_locations.show', array($profile->id, $location->id)) }}"> Address </a>

				(
                  {!! link_to_route('profile_locations.edit', 'Edit', array($profile->id, $location->id), array('class' => 'btn btn-info')) !!},
                  {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}				
				)
            {!! Form::close() !!}
		 </li>
		@endforeach
	   </ul>
   @endif
		 
	<p>
      {!! link_to_route('employees.index', 'Back to Profile') !!} 
	   <!--	<a href="{{route('employees.index', ['id' => $profile->id])}}"> Back to Profile </a> -->
		<a href="{{route('profile_locations.create', ['id' => $profile->id])}}"> Add Location </a>	
	</p>
		 
@stop		
		
