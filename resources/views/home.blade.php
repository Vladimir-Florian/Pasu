@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					You are logged in!
				</div>
			</div>
		</div>
	</div>


	<div class="row">

	  <div class="col-md-3 col-md-offset-1">
		<div class="title"> <a href="{{route('employers.index')}}" class="btn btn-primary pull-right"> Employers </a>
		</div>
		<div> </div>
		<div class="title"> <a href="{{route('employees.index')}}" class="btn btn-primary pull-right"> Employees </a>
		</div>
	  </div>
	</div>

</div>
@endsection
