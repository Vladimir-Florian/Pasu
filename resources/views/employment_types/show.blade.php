@extends('app')

@section('content')

	<h3>  

	<article>
		{{ $employment_type->name}}
	</article>
	
	</h3>
	
	<p>
      {!! link_to_route('employment_types.index', 'Back to Types List') !!} 
	</p>

@stop		
		
