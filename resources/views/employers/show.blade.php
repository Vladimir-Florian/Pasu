@extends('app')

@section('content')

 <h2> {{ $employer->company_name }} </h2>
 
	<article>
		{{ $employer->phone_no}}
	</article>
	<article>
		{{ $employer->company_j}}
	</article>
	<article>
		{{ $employer->company_cui}}
	</article>
	<article>
		{{ $employer->company_account}}
	</article>


	<p>
      {!! link_to_route('employers.index', 'Back to Company Home page') !!} 
	</p>
 

@endsection		
		
