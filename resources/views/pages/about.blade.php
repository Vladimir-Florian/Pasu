@extends('app')

@section('content')

<h1> About </h1>

<h3> People I like: </h3>

<ul>
	@foreach ($people as $person)
		<li> {{ $person}}</li>
	@endforeach
</ul>
	
		<h2>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum metus velit, sit amet vestibulum dui finibus at. Mauris sodales vestibulum lacus nec porta.
		</h2>

@stop		
		
