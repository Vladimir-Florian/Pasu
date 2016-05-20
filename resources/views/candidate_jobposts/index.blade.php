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
								Marked
							</h4>
                        </div>
						
                    </div>
                    <div class="row">

						
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

	   <a href="{{route('employees.index', ['id' => $profile->id])}}"> Back to Profile </a> 
		
		
@endsection		
		