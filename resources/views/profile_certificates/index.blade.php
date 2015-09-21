@extends('app')

@section('content')

 <h2> Certificates for Profile "{{$profile->name}}" </h2>

   @if(!$profile->certificates->count())
	   No certificates
   @else
	   <ul>
		@foreach ($profile->certificates as $certificate)
		 <li>
			
			{!! Form::open(array('class' => 'form-inline', 'method'=>'DELETE', 'route'=>array('profile_certificates.destroy', $profile->id, $certificate->id))) !!}
                <a href="{{ route('profile_certificates.show', array($profile->id, $certificate->id)) }}">{{ $certificate->slug }}</a>

				(
                  {!! link_to_route('profile_certificates.edit', 'Edit', array($profile->id, $certificate->id), array('class' => 'btn btn-info')) !!},
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
		<a href="{{route('profile_certificates.create', ['id' => $profile->id])}}"> Add Certificate </a>	
	</p>
		 
@stop		
		
