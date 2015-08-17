@extends('app')

@section('content')

 <h2> Certificates for Profile "{{$profile->name}}" </h2>
 
   @if(!$profile->certificates->count())
	   No certificates
   @else
	   <ul>
		@foreach ($profile->certificates as $certificate)
		 <li>
			
			{!! Form::open(array('class' => 'form-inline', 'method'=>'DELETE', 'route'=>array('profile_certificates.destroy', $profile->id, $profile->id))) !!}
                <a href="{{ route('profile_certificates.show', array($industry->id, $profile->id)) }}">{{ $certificate->name }}</a>
				(
                  {!! link_to_route('profile_certificates.edit', 'Edit', array($industry->id, $profile->id), array('class' => 'btn btn-info')) !!},
                  {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}				
				)
            {!! Form::close() !!}
		 </li>
		@endforeach
	   </ul>
   @endif
		 
	<p>
	    {!! link_to_route('employees.index', 'Back to Profiles') !!} |
		{!! link_to_route('profile_certificates.create', 'Add Certificate', $profile->id) !!}
	</p>
		 
@stop		
		
