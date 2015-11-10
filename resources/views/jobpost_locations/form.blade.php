        <!-- Form Input Partial -->
        <div class="form-group">
            {!! Form::label('address', 'Address:') !!}
			{!! Form::text('address', null, ['class' => 'form-control']) !!}
        </div>			
        <div class="form-group">
            {!! Form::label('postal_code', 'Zip Code:') !!}
			{!! Form::text('postal_code', null, ['class' => 'form-control']) !!}
            <!-- {!! Form::textarea('name', null, ['class' => 'form-control']) !!} -->
        </div>
        <div class="form-group">
            {!! Form::label('city', 'City:') !!}
			{!! Form::text('city', null, ['class' => 'form-control']) !!}
        </div>			
        <div class="form-group">
            {!! Form::label('province', 'Province:') !!}
			{!! Form::text('province', null, ['class' => 'form-control']) !!}
        </div>			
        <div class="form-group">
            {!! Form::label('country_code', 'Country Code:') !!}
			{!! Form::text('country_code', null, ['class' => 'form-control']) !!}
        </div>			
        <div class="form-group">
            {!! Form::label('latitude', 'Latitude:') !!}
			{!! Form::text('latitude', null, ['class' => 'form-control']) !!}
        </div>			
        <div class="form-group">
            {!! Form::label('longitude', 'Longitude:') !!}
			{!! Form::text('longitude', null, ['class' => 'form-control']) !!}
        </div>			

		
        <!-- Submit Button -->
        <div class="form-group">
            {!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
        </div> 