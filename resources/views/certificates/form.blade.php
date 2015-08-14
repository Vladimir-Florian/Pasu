        <!-- Form Input Partial -->
        <div class="form-group">
            {!! Form::label('slug', 'Slug:') !!}
			{!! Form::text('slug', null, ['class' => 'form-control']) !!}
        </div>			
        <div class="form-group">
            {!! Form::label('description', 'Description:') !!}
			{!! Form::text('description', null, ['class' => 'form-control']) !!}
            <!-- {!! Form::textarea('name', null, ['class' => 'form-control']) !!} -->
        </div>

		
        <!-- Submit Button -->
        <div class="form-group">
            {!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
        </div> 