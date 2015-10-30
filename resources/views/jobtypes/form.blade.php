        <!-- Form Input Partial -->
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
			{!! Form::text('name', null, ['class' => 'form-control']) !!}
            <!-- {!! Form::textarea('name', null, ['class' => 'form-control']) !!} -->
        </div>
        <div class="form-group">
            {!! Form::label('description', 'Description:') !!}
			{!! Form::text('description', null, ['class' => 'form-control']) !!}
        </div>			
        <div class="form-group">
            {!! Form::label('occupational_category', 'Occupational category:') !!}
			{!! Form::text('occupational_category', null, ['class' => 'form-control']) !!}
        </div>			
		
        <!-- Submit Button -->
        <div class="form-group">
            {!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
        </div> 