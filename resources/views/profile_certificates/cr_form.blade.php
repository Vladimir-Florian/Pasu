        <!-- Form Input Partial -->

    @if ( !$profile->certificates->count())
        Profile has no certificates.
    @else

		<div class="form-group">
			{!! Form::label('certificate', 'Certificate:') !!} <br />
			{!! Form::select('certificate',
				(['0' => 'Select a certificate'] + $fields), 
					null, 
					['class' => 'form-control']) !!}
		</div>
			
		<div class="form-group">
			{!! Form::label('details', 'Details:') !!}
			{!! Form::textarea('details', null, ['class' => 'form-control']) !!}
		</div>			
			  
    @endif

		
        <!-- Submit Button -->
        <div class="form-group">
            {!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
        </div> 