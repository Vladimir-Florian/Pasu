        <!-- Form Input Partial -->


		<div class="form-group">
			{!! Form::label('language', 'Language:') !!} <br />
			{!! Form::select('language',
				(['0' => 'Select a language'] + $langs->toArray()), 
					null, 
					['class' => 'form-control']) !!}
		</div>
			
		<div class="form-group">
			{!! Form::label('level', 'Level:') !!} <br />
			{!! Form::select('level',
				(['0' => 'Select a level'] + $levels->toArray()), 
					null, 
					['class' => 'form-control']) !!}
		</div>
 			  

		
        <!-- Submit Button -->
        <div class="form-group">
            {!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
        </div> 