        <!-- Form Input Partial -->


        <div class="form-group">
            {!! Form::label('cv', 'CV:') !!}
			{!! Form::textarea('cv', null, ['class' => 'form-control']) !!}
        </div>			
			
       <div class="form-group">
            {!! Form::label('Upload file') !!}
			{!! Form::file('file', null) !!}
        </div>			
			  

		
        <!-- Submit Button -->
        <div class="form-group">
            {!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
        </div> 