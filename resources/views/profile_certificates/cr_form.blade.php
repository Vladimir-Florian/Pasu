        <!-- Form Input Partial -->


		<div class="form-group">
			{!! Form::label('certificate', 'Certificate:') !!} <br />
			{!! Form::select('certificate',
				(['0' => 'Select a certificate'] + $fields->toArray()), 
					null, 
					['class' => 'form-control']) !!}
		</div>
			
       <div class="form-group">
            {!! Form::label('awarder', 'Awarding Institution:') !!}
			{!! Form::text('awarder', null, ['class' => 'form-control']) !!}
        </div>			
        <div class="form-group">
            {!! Form::label('date_awarded', 'Awarding date:') !!}
			{!! Form::input('date', 'date_awarded', date('Y-m-d'), ['class' => 'form-control']) !!}
        </div>			
 			  

		
        <!-- Submit Button -->
        <div class="form-group">
            {!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
        </div> 