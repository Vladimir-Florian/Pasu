@extends('app')

@section('content')

 <h2> Specializations </h2>
 
   @if(!$industries->count())
	   No specializations
   @else
	   <ul>
		@foreach ($industries as $industry)
		 <li>
			<!-- <a href="{{ url('industries', ['id' => $industry->id])}}"> {{ $industry->slug }} </a> -->
			
			{!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('industries.destroy', $industry->id))) !!}
                <a href="{{ route('industries.show', $industry->id) }}">{{ $industry->slug }}</a>
                (
                  {!! link_to_route('industries.edit', 'Edit', array($industry->id), array('class' => 'btn btn-info')) !!},
                  {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                )
            {!! Form::close() !!}
		 </li>
		@endforeach
	   </ul>
   @endif
		 
	<p>
	    {!! link_to_route('industries.create', 'Create Specialization') !!} 
	</p>
		 
@stop		
		
