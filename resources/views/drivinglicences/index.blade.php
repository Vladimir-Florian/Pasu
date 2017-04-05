@extends('app')

@section('content')

 <h2> Driving licences for Profile "{{$profile->name}}" </h2>
 
   @if(!$profile->drivinglicences->count())
	   No driving licences entered
   @else
	   <ul>
		@foreach ($profile->drivinglicences as $drivinglicence)
		 <li>
			{!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('drivinglicences.destroy', $profile->id, $drivinglicence->id))) !!}
				  {{ $drivinglicence->category }}
				(
                  {!! link_to_route('drivinglicences.edit', 'Edit', array($profile->id, $drivinglicence->id), array('class' => 'btn btn-info')) !!},
                  {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                )
            {!! Form::close() !!}
		 </li>
		@endforeach
	   </ul>
   @endif
		 
	<p>
      	{!! link_to_route('employees.index', 'Back to Profile') !!} 
		<a href="{{ route('drivinglicences.create', ['id' => $profile->id]) }}" class="btn btn-info"> Add a Category </a>
	</p>

		 
@stop		
		
