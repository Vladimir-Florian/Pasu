        <!-- Form Input Partial -->

    @if ( !$profile->certificates->count())
        Profile has no certificates.
    @else
        <ul>
            @foreach( $profile->certificates as $certificate )

  			  <div class="form-group">
				<h3> Certificate: {{ $certificate->description}}</h3>
			  </div>

			
			  <div class="form-group">
				  {!! Form::label('details'.$certificate->id, 'Details:') !!}
				  {!! Form::textarea('details'.$certificate->id, $certificate->pivot->details, ['class' => 'form-control']) !!}
			  </div>			
			  
            @endforeach
        </ul>
    @endif

		
        <!-- Submit Button -->
        <div class="form-group">
            {!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
        </div> 