@extends('app')

@section('content')

	<div class="row">
		<div class="page-header">
			<h2>Job Posts for Profile "{{$profile->name}}"</h2>
		</div>
	</div>

        <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <h4>
                                <strong><a href="{{route('candidate_jobposts.forindustry', ['id' => $profile->id])}}"> For Specialization </a></strong>
                            </h4>
                        </div>					
					
                        <div class="col-md-3">
							<h4>
                                <strong><a href="{{route('candidate_jobposts.jobtypes', ['id' => $profile->id])}}"> By Job Type </a></strong>
							</h4>
                        </div>
                        <div class="col-md-3">
							<h4>
                                <strong><a href="{{route('markedjobposts.index', ['id' => $profile->id])}}"> Marked Job Posts </a></strong>
							</h4>
                        </div>
						
                    </div>
							<p> </p>
					
                    <div class="row">
                       <div class="col-md-3">
                            <p>
                                <span class="glyphicon glyphicon-user"></span> by 
								<span class="muted">History</span> | 
								<span class="glyphicon glyphicon-calendar"></span> List
                            </p>
                        </div>
                    </div>
                </div>
        </div>
		<h4>
	     <a href="{{route('employees.index', ['id' => $profile->id])}}"> Back to Profile </a> 
		</h4>
		
		
@endsection		
		
