@extends('app')

@section('content')

 <h2> Specialization specific Skills </h2>
 
   @if(!$specific_skills->count())
	   No Skills entered
   @else
	   <ul>
		@foreach ($specific_skills as $specific_skill)
		 <li>
			{!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('specific_skills.destroy', $specific_skill->id))) !!}
                <a href="{{ route('specific_skills.show', $specific_skill->id) }}">{{ $specific_skill->slug }}</a>
                (
                  {!! link_to_route('specific_skills.edit', 'Edit', array($specific_skill->id), array('class' => 'btn btn-info')) !!},
                  {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                )
            {!! Form::close() !!}
		 </li>
		@endforeach
	   </ul>
   @endif
		 

	<a href="{{ route('specific_skills.create') }}" class="btn btn-info">Create a new Skill</a>
		 
@stop		
		
