        <!-- Form Input Partial -->


        <div class="form-group">
            {!! Form::label('cv', 'CV:') !!}
			{!! Form::textarea('cv', null, ['class' => 'form-control']) !!}
        </div>			
		
        <!-- Submit Button -->
        <div class="form-group">
            {!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
        </div> 