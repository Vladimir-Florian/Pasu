        <!-- Form Input Partial -->

    @if ( !$profile->certificates->count())
        Profile has no certificates.
    @else

		<div class="form-group">
			<h3> Certificate: {{ $certificate->description}}</h3>
		</div>
			
		<div class="form-group">
			{!! Form::label('details', 'Details:') !!}
			{!! Form::textarea('details', $certificate->pivot->details, ['class' => 'form-control']) !!}
		</div>			
			  
    @endif

		
        <!-- Submit Button -->
        <div class="form-group">
            {!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
        </div> 