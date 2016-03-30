        <!-- Form Input Partial -->


		<div class="form-group">
			{!! Form::label('tag', 'Tag:') !!} <br />
			{!! Form::select('tag',
				(['0' => 'Select a tag'] + $fields->toArray()), 
					null, 
					['class' => 'form-control']) !!}
		</div>
			
			  

		
        <!-- Submit Button -->
        <div class="form-group">
            {!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
        </div> 