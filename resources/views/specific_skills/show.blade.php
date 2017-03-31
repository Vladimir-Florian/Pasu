@extends('app')

@section('content')

	<h3> {{ $specific_skill->slug }} </h3>

	<article>
		{{ $specific_skill->name}}
	</article>

	<article>
		{{ $specific_skill->description}}
	</article>
	
	<p>
      {!! link_to_route('specific_skills.index', 'Back to specific_skills') !!}
	</p>

@stop		
		
