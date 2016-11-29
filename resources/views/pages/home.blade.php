@extends('app')
 
@section('content')

@if($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li >{{ $error }}</li>
        @endforeach
    </ul>
@endif  

    <div class="container-fluid">

        <div>
            <ul >
                @if (Auth::guest())
					<h1>Welcome to Pasu</h1>
					<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores, possimus, ullam? Deleniti dicta eaque facere, facilis in inventore mollitia officiis porro totam voluptatibus! Adipisci autem cumque enim explicabo, iusto sequi.</p>
					<hr>
				@else
                    <li >
					<a href="{{ route('employees.index') }}" class="btn btn-info">Candidates</a>
                    </li>
                    <li >
					<a href="{{ route('employers.index') }}" class="btn btn-info">Employers</a>
                    </li>
					
                @endif
            </ul>
        </div>
    </div>

<!-- 
<a href="{{ route('about') }}" class="btn btn-info">About</a>
<a href="{{ route('contact') }}" class="btn btn-primary">Contact</a> 

	<div class="title"> <a href="{{url('/auth/login')}}" class="btn btn-primary pull-right"> Login </a> 
	</div>
	<div class="title"> <a href="{{url('/auth/register')}}" class="btn btn-primary pull-right"> Register </a> 
	</div>
-->
 
@stop