        <!-- Form Input Partial -->
		<div class="form-group">
			{!! Form::label('jobtype', 'Job Type:') !!}<br />
			{!! Form::select('jobtype',
				(['0' => 'Select a jobtype'] + $jobtypes), 
					null, 
					['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('employment_type', 'Employment Type:') !!}<br />
			{!! Form::select('employment_type',
				(['0' => 'Select an employment_type'] + $employment_types), 
					null, 
					['class' => 'form-control']) !!}
		</div>
        <div class="form-group">
            {!! Form::label('experience', 'Experience (years):') !!}
			{!! Form::text('experience', null, ['class' => 'form-control']) !!}
        </div>			
        <div class="form-group">
            {!! Form::label('education', 'Education:') !!}
			{!! Form::text('education', null, ['class' => 'form-control']) !!}
        </div>			
        <div class="form-group">
            {!! Form::label('benefits', 'Benefits:') !!}
			{!! Form::text('benefits', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('incentives', 'Incentives:') !!}
			{!! Form::text('incentives', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('responsabilities', 'Responsabilities:') !!}
			{!! Form::text('responsabilities', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('salary', 'Salary:') !!}
			{!! Form::text('salary', null, ['class' => 'form-control']) !!}
        </div>			
        <div class="form-group">
            {!! Form::label('currency', 'Currency:') !!}
			{!! Form::text('currency', null, ['class' => 'form-control']) !!}
        </div>			
        <div class="form-group">
            {!! Form::label('workhours', 'Workhours:') !!}
			{!! Form::text('workhours', null, ['class' => 'form-control']) !!}
        </div>			
        <div class="form-group">
            {!! Form::label('request_date', 'Request date:') !!}
			{!! Form::input('date', 'request_date', date('Y-m-d'), ['class' => 'form-control']) !!}
        </div>			
		
        <!-- Submit Button -->
        <div class="form-group">
            {!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
        </div> 