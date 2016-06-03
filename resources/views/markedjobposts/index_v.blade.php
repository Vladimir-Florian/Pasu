@extends('app')

@section('content')

	@include('errors.list')


 <h2> Marked Job Posts </h2>
 
   @if(!$markedposts->count())
	   No job posts
   @else
	   
	   <ul>
		@foreach ($markedposts as $markedjobpost)
		 <li>
			
			{!! Form::open(array('class' => 'form-inline', 'method'=>'DELETE', 'route'=>array('profile_certificates.destroy', $profile->id, $certificate->id))) !!}
                <a href="{{ route('profile_certificates.show', array($profile->id, $certificate->id)) }}"> Details </a>

				(
                  {!! link_to_route('profile_certificates.edit', 'Edit', array($profile->id, $certificate->id), array('class' => 'btn btn-info')) !!},
                  {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}				
				)
            {!! Form::close() !!}
		 </li>
		@endforeach
	   </ul>
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
					<th> Delete </th>
					<th> Apply </th>
					 
				</tr>
              @endforeach
			</tbody>
		</table>	   
   
   @endif
		 
	<p>
       <!-- <strong><a href="{{route('candidate_jobposts.jobtypes', ['id' => $profile->id])}}"> By Job Type </a></strong> -->
	   <strong> <a href="{{htmlspecialchars($_SERVER['HTTP_REFERER'])}}" class="btn btn-primary" > Back </a> </strong>
	   
	</p>
		 
@stop		
		
