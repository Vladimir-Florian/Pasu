@extends('app')

@section('content')

 <h2> Employment Types </h2>
 
   @if(!$employment_types->count())
	   No Employment Types
   @else
	   <ul>
		@foreach ($employment_types as $employment_type)
		 <li>
			<!-- <a href="{{ url('employment_types', ['id' => $employment_type->id])}}"> {{ $employment_type->name }} </a> -->
			
			{!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('employment_types.destroy', $employment_type->id))) !!}
                <a href="{{ route('employment_types.show', $employment_type->id) }}">{{ $employment_type->name }}</a>
                (
                  {!! link_to_route('employment_types.edit', 'Edit', array($employment_type->id), array('class' => 'btn btn-info')) !!},
                  {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                )
            {!! Form::close() !!}

			
		 </li>
		@endforeach
	   </ul>
   @endif
		 

	<!-- <a href="{{ route('employment_types.create') }}" class="btn btn-info">Create Type</a> -->
	{!! link_to_route('employment_types.create', 'Create Type') !!}	 
@stop		
		
