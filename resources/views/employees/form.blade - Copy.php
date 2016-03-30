        <!-- Form Input Partial -->
        <div class="form-group">
            {!! Form::label('name', 'Full Name:') !!}
			{!! Form::text('name', null, ['class' => 'form-control']) !!}
            <!-- {!! Form::textarea('name', null, ['class' => 'form-control']) !!} -->
        </div>
        <div class="form-group">
            {!! Form::label('phone_no', 'Phone:') !!}
			{!! Form::text('phone_no', null, ['class' => 'form-control']) !!}
        </div>			
        <div class="form-group">
            {!! Form::label('birthdate', 'Birth date:') !!}
			{!! Form::input('date', 'birthdate', date('Y-m-d'), ['class' => 'form-control']) !!}
        </div>			
        <div class="form-group">
            {!! Form::label('experience', 'Experience (years):') !!}
			{!! Form::text('experience', null, ['class' => 'form-control']) !!}
        </div>			
		<div class="form-group">
			{!! Form::label('specialization', 'Specialization:') !!}<br />
			{!! Form::select('specialization', 
				(['0' => 'Select a specialization'] + $industries->toArray()), 
					null, 
					['class' => 'form-control']) !!}
		</div>
		
        <!-- Submit Button -->
        <div class="form-group">
            {!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
        </div> 