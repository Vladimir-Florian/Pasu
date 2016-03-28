        <!-- Form Input Partial -->
        <div class="form-group">
            {!! Form::label('company_name', 'Company Name:') !!}
			{!! Form::text('company_name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('phone_no', 'Phone:') !!}
			{!! Form::text('phone_no', null, ['class' => 'form-control']) !!}
        </div>			
        <div class="form-group">
            {!! Form::label('company_j', 'company j:') !!}
			{!! Form::text('company_j', null, ['class' => 'form-control']) !!}
        </div>				
        <div class="form-group">
            {!! Form::label('company_cui', 'company cui:') !!}
			{!! Form::text('company_cui', null, ['class' => 'form-control']) !!}
        </div>			
        <div class="form-group">
            {!! Form::label('company_account', 'company account:') !!}
			{!! Form::text('company_account', null, ['class' => 'form-control']) !!}
        </div>			
		<div class="form-group">
			{!! Form::label('industry', 'Industry:') !!}
			Create industry for "{{$industries}}"
					

		</div>
		
        <!-- Submit Button -->
        <div class="form-group">
            {!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
        </div> 