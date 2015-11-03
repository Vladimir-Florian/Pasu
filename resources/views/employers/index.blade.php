@extends('app')

@section('content')

	<div class="row">
		<div class="page-header">
			<h2>Employer Home Page</h2>
		</div>
	</div>

        <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <h4>
                                <strong><a href="{{route('employers.show', ['id' => $employer->id])}}"> Show Employer </a></strong>
                            </h4>
                        </div>					
					
                        <div class="col-md-3">
							<h4>
                                <strong><a href="{{route('employers.edit', ['id' => $employer->id])}}"> Update Employer </a></strong>
							</h4>
                        </div>
                        <div class="col-md-3">
							<h4>
								{!! Form::open(array('class' => 'form-inline', 'method'=>'DELETE', 'route'=>array('employers.destroy', $employer->id))) !!}
                				{!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
								{!! Form::close() !!}
							</h4>
                        </div>
						
                    </div>
                    <div class="row">

                        <div class="col-md-3">
                            <h4>
                                <strong><a href="{{route('employers.jobposts.index', ['id' => $employer->id])}}"> Job Posts </a></strong>
                            </h4>
                        </div>					
					
                        <div class="col-md-3">
							<h4>
                                <strong><a href="{{route('about', ['id' => $employer->id])}}"> Locations </a></strong>
							</h4>
                        </div>
					
                        <div class="col-md-3">
							<h4>
                            <strong> Apply </strong>
							</h4>
							<p>
							</p>
                            <p>
                                <a class="btn btn-mini btn-default"
                                   href="{{route('about')}}">Apply</a>
                            </p>
                        </div>					
					
                        <div class="col-md-3">
                            <p></p>

                            <p>
                                <span class="glyphicon glyphicon-user"></span> by <span
                                        class="muted">History</span> | <span
                                        class="glyphicon glyphicon-calendar"></span> List
                            </p>
                        </div>
                    </div>
                </div>
        </div>

		
		
@endsection		
		
