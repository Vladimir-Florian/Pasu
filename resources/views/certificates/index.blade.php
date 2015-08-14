@extends('app')

@section('content')

 <h2> Certificates </h2>
 
   @if(!$certificates->count())
	   No certificates
   @else
	   <ul>
		@foreach ($certificates as $certificate)
		 <li>
			{!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('certificates.destroy', $certificate->id))) !!}
                <a href="{{ route('certificates.show', $certificate->id) }}">{{ $certificate->slug }}</a>
                (
                  {!! link_to_route('certificates.edit', 'Edit', array($certificate->id), array('class' => 'btn btn-info')) !!},
                  {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                )
            {!! Form::close() !!}
		 </li>
		@endforeach
	   </ul>
   @endif
		 

	<a href="{{ route('certificates.create') }}" class="btn btn-info">Create a Certification</a>
		 
@stop		
		
