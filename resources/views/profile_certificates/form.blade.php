        <!-- Form Input Partial -->

    @if ( !$profile->certificates->count())
        Profile has no certificates.
    @else

		<div class="form-group">
			<h3> Certificate: {{ $certificate->description}}</h3>
		</div>
			
      <div class="form-group">
            {!! Form::label('awarder', 'Awarding Institution:') !!}
			{!! Form::text('awarder', $certificate->pivot->awarder, ['class' => 'form-control']) !!}
        </div>			
        <div class="form-group">
            {!! Form::label('date_awarded', 'Awarding date:') !!}
			{!! Form::input('date', 'date_awarded', $certificate->pivot->awarder, ['class' => 'form-control']) !!}
        </div>			
			  
    @endif

		
        <!-- Submit Button -->
        <div class="form-group">
            {!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
        </div> 