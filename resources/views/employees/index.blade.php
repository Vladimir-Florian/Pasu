@extends('app')

@section('content')

	<div class="row">
		<div class="page-header">
			<h2>{{$profile->name}}'s Page</h2>
		</div>
	</div>

        <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <h4>
                                <strong><a href="{{route('employees.show', ['id' => $profile->id])}}"> Show Profile </a></strong>
                            </h4>
                        </div>					
					
                        <div class="col-md-3">
							<h4>
                                <strong><a href="{{route('employees.edit', ['id' => $profile->id])}}"> Update Profile </a></strong>
							</h4>
                        </div>
                        <div class="col-md-3">
							<h4>
								{!! Form::open(array('class' => 'form-inline', 'method'=>'DELETE', 'route'=>array('employees.destroy', $profile->id))) !!}
                				{!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
								{!! Form::close() !!}
							</h4>
                        </div>
						
                    </div>
                    <div class="row">

                        <div class="col-md-3">
                            <h4>
                                <strong><a href="{{route('profile_certificates.index', ['id' => $profile->id])}}"> Certificates </a></strong>
                            </h4>
                        </div>					
					
                        <div class="col-md-3">
                            <h4>
                                <strong><a href="{{route('drivinglicences.index', ['id' => $profile->id])}}"> Driving Licence </a></strong>
                            </h4>
                        </div>                  

                        <div class="col-md-3">
							<h4>
                                <strong><a href="{{route('profile_locations.index', ['id' => $profile->id])}}"> Locations </a></strong>
							</h4>
                        </div>

                        <div class="col-md-3">
							<h4>
                                <strong><a href="{{route('profile_resume.index', ['id' => $profile->id])}}"> Resume </a></strong>
							</h4>
                        </div>
						
                    </div>

                    <div class="row">
                       <div class="col-md-3">
							<h4>
                                <strong><a href="{{route('candidate_jobposts.index', ['id' => $profile->id])}}"> Job Posts </a></strong>
							</h4>
                        </div>
                        <div class="col-md-3">
							<h4>
                                <strong><a href="{{route('applications.index', ['id' => $profile->id])}}"> My Applications </a></strong>
							</h4>
                        </div>
						
					</div>				   
                </div>
        </div>

		
		
@endsection		
		
