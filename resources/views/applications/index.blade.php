@extends('app')

@section('content')

	@include('errors.list')


 <h2> Applications for "{{$profile->name}}"</h2>
 
   @if(!$applications->count())
	   No applications
   @else
	   
		<table class="table table-condensed table-striped">
			<thead>
				<tr>
					<th>Title</th>
					<th>Request Date</th>
					<th>Employer</th>
					<th> Experience </th>
					<th> Education</th>
					<th> Benefits</th>
					<th> Incentives</th>
					<th> Responsabilities</th>
					<th> Salary</th>
					<th> Currency</th>
					<th> Workhours</th>
					<th> Validity days</th>
					<th> Award Date</th>
					<th> Employment Type</th>
					<th> Job Type</th>
					<th> </th>
					<th> </th>
					<th> </th>
					<th> </th>
				</tr>
			</thead>
			<tbody>
              @foreach( $applications as $application )
				<tr>
					<td>{{ $application->jobtitle }}</td>
					<td>{{ $application->request_date }}</td>
					<td>{{ $application->company_name }}</td>
					<td>{{ $application->experience }}</td>
					<td>{{ $application->education }}</td>
					<td>{{ $application->benefits }}</td>
					<td>{{ $application->incentives }}</td>
					<td>{{ $application->responsabilities }}</td>
					<td>{{ $application->salary }}</td>
					<td>{{ $application->currency }}</td>
					<td>{{ $application->workhours }}</td>
					<td>{{ $application->validity_days }}</td>
					<td>{{ $application->award_date }}</td>
					<td>{{ $application->employment_type }}</td>
					<td>{{ $application->job_type }}</td>					 
					<th>
					  {!! Form::open(array('class' => 'form-inline', 'method'=>'DELETE', 'route'=>array('applications.destroy', $profile->id, $application->id))) !!}
					  {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}				
					  {!! Form::close() !!}
					</th>					 
				</tr>
              @endforeach
			</tbody>
		</table>	   
   
   @endif
		 
	<p>
      <!-- <strong><a href="{{route('candidate_jobposts.index', ['id' => $profile->id])}}"> Back to Job Posts </a></strong>	 -->  
	  <div class="title"> <a href="{{route('employees.index')}}" class="btn btn-primary pull-left"> Back to Profile </a> </div>

	</p>
		 
@stop		
		
