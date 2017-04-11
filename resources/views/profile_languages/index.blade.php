@extends('app')

@section('content')

 <h2> Foreign Languages for Profile "{{$profile->name}}" </h2>

   @if(!$profile->languages->count())
	   No languagess entered
   @else
	   <ul>
		@foreach ($profile->languages as $language)
		 <li>
			
			{!! Form::open(array('class' => 'form-inline', 'method'=>'DELETE', 'route'=>array('profile_languages.destroy', $profile->id, $language->id))) !!}
                <a href="{{ route('profile_languages.show', array($profile->id, $language->id)) }}">{{ $language->slug }}</a> 

				(
                  {!! link_to_route('profile_languages.edit', 'Edit', array($profile->id, $language->id), array('class' => 'btn btn-info')) !!},
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
		<a href="{{route('profile_languages.create', ['id' => $profile->id])}}"> Add language </a>	
	</p>
		 
@stop		
		
