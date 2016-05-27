@extends('app')

@section('content')

	@include('errors.list')


 <h2> Job Posts for {{$jobtype->name}} </h2>
 
   @if(!$jobposts->count())
	   No job posts
   @else
	   
		<table class="table table-condensed table-striped">
			<thead>
				<tr>
					<th>Title</th>
					<th>Request Date</th>
					<th>Employer</th>
					<th> </th>
					<th> </th>
				</tr>
			</thead>
			<tbody>
              @foreach( $jobposts as $jobpost )
				<tr>
					<td>{{$jobpost->jobtitle}}</td>
					<td>{{ $jobpost->request_date }}</td>
					<td>{{ $jobpost->company_name }}</td>
					<td>{!! link_to_route('candidate_jobposts.show', 'Details', array($profile->id, $jobpost->id), array('class' => 'btn btn-info')) !!}</td>
					<td>{!! link_to_route('markedjobposts.store', 'Mark', array($profile->id, $jobpost->id), array('class' => 'btn btn-info')) !!}</td>
				</tr>
              @endforeach
			</tbody>
		</table>	   
   
   @endif
		 
	<p>
        <strong><a href="{{route('candidate_jobposts.jobtypes', ['id' => $profile->id])}}"> By Job Type </a></strong>
	</p>
		 
@stop		
		
