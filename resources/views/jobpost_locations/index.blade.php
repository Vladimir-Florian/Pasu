@extends('app')

@section('content')

 <h2> Locations </h2>
 
   @if(!$locations->count())
	   No locations
   @else
	   <ul>
		@foreach ($locations as $location)
		 <li>
			{!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('locations.destroy', $location->id))) !!}
                <a href="{{ route('locations.show', $location->id) }}"> Look </a>
                (
                  {!! link_to_route('locations.edit', 'Edit', array($location->id), array('class' => 'btn btn-info')) !!},
                  {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                )
            {!! Form::close() !!}
		 </li>
		@endforeach
	   </ul>
   @endif
		 

	<a href="{{ route('locations.create') }}" class="btn btn-info">Create a Location</a>
		 
@stop		
		
