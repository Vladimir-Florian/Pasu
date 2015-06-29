@extends('layouts.master')
 
@section('content')
 
<h1>Welcome to Pasu</h1>
<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores, possimus, ullam? Deleniti dicta eaque facere, facilis in inventore mollitia officiis porro totam voluptatibus! Adipisci autem cumque enim explicabo, iusto sequi.</p>
<hr>

 
<a href="{{ route('about') }}" class="btn btn-info">About</a>
<a href="{{ route('contact') }}" class="btn btn-primary">Contact</a> 

	<div class="title"> <a href="{{url('/auth/login')}}" class="btn btn-primary pull-right"> Login </a> 
	</div>
	<div class="title"> <a href="{{url('/auth/register')}}" class="btn btn-primary pull-right"> Register </a> 
	</div>

 
@stop