        <!-- Form Input Partial -->

	
       <div class="form-group">
            {!! Form::label('category', 'Category:') !!}
			{!! Form::text('category', null, ['class' => 'form-control']) !!}
        </div>			
 			  

		
        <!-- Submit Button -->
        <div class="form-group">
            {!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
        </div> 