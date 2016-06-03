@extends('app')

@section('content')

	@include('errors.list')


 <h2> Marked Job Posts </h2>
 
   @if(!$markedposts->count())
	   No job posts
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
              @foreach( $markedposts as $markedjobpost )
				<tr>
					<td>{{ $markedjobpost->jobtitle }}</td>
					<td>{{ $markedjobpost->request_date }}</td>
					<td>{{ $markedjobpost->company_name }}</td>
					<td>{{ $markedjobpost->experience }}</td>
					<td>{{ $markedjobpost->education }}</td>
					<td>{{ $markedjobpost->benefits }}</td>
					<td>{{ $markedjobpost->incentives }}</td>
					<td>{{ $markedjobpost->responsabilities }}</td>
					<td>{{ $markedjobpost->salary }}</td>
					<td>{{ $markedjobpost->currency }}</td>
					<td>{{ $markedjobpost->workhours }}</td>
					<td>{{ $markedjobpost->validity_days }}</td>
					<td>{{ $markedjobpost->award_date }}</td>
					<td>{{ $markedjobpost->employment_type }}</td>
					<td>{{ $markedjobpost->job_type }}</td>					 
					<th>
					  {!! Form::open(array('class' => 'form-inline', 'method'=>'DELETE', 'route'=>array('markedjobposts.destroy', $profile->id, $markedjobpost->id))) !!}
					  {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}				
					  {!! Form::close() !!}
					</th>
					<th> 
					{!! link_to_route('applications.store', 'Apply', [$profile->id, $markedjobpost->id], ['class' => 'btn btn-info']) !!} 					  
					</th>
					 
				</tr>
              @endforeach
			</tbody>
		</table>	   
   
   @endif
		 
	<p>
      <strong><a href="{{route('candidate_jobposts.index', ['id' => $profile->id])}}"> Back to Job Posts </a></strong>
       <!--  
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
					
 	   
	   <strong> <a href="{{htmlspecialchars($_SERVER['HTTP_REFERER'])}}" class="btn btn-primary" > Back </a> </strong>
	   -->
	   
	</p>
		 
@stop		
		
