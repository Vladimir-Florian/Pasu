@extends('app')

@section('content')

	<h2> Industries </h2>


	@foreach ($industries as $industry)
		<article>
		 <h3>
			<a href="{{ url('industries', ['id' => $industry->id])}}"> {{ $industry->slug }} </a>
		 </h3>
		 
		 <div class="body">{{ $industry->name }}</div>
		</article>
	@endforeach
	
@stop		
		
