@extends('app')

@section('content')

 <h2> {{ $industry->slug }} </h2>
 
   @if(!$industry->profiles->count())
	   No profiles
   @else
	   <ul>
		@foreach ($industry->profiles as $profile)
		 <li>
			{!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('industries.profiles.destroy', $industry->id, $profile->id))) !!}
                <a href="{{ route('industries.profiles.show', [$industry->id, $profile->id]) }}">{{ $industry->slug }}</a>
                (
                  {!! link_to_route('industries.profiles.edit', 'Edit', array($industry->id, $profile->id), array('class' => 'btn btn-info')) !!},
                  {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                )
            {!! Form::close() !!}
		 </li>
		@endforeach
	   </ul>
   @endif
 

	<p>
      {!! link_to_route('industries.index', 'Back to Specializations') !!} |
      {!! link_to_route('industries.profiles.create', 'Create Profile', $industry->id) !!}
	</p>

@endsection		
		
