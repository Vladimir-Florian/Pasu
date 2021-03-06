        <!-- Form Input Partial -->


        <div class="form-group">
            {!! Form::label('address', 'Address:') !!}
			{!! Form::text('address', $location->address, ['class' => 'form-control']) !!}
        </div>			
        <div class="form-group">
            {!! Form::label('postal_code', 'Zip Code:') !!}
			{!! Form::text('postal_code', $location->postal_code, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('city', 'City:') !!}
			{!! Form::text('city', $location->city, ['class' => 'form-control']) !!}
        </div>			
        <div class="form-group">
            {!! Form::label('province', 'Province:') !!}
			{!! Form::text('province', $location->province, ['class' => 'form-control']) !!}
        </div>			
        <div class="form-group">
            {!! Form::label('country_code', 'Country Code:') !!}
			{!! Form::text('country_code', $location->country_code, ['class' => 'form-control']) !!}
        </div>			
        <div class="form-group">
            {!! Form::label('latitude', 'Latitude:') !!}
			{!! Form::text('latitude', $location->latitude, ['class' => 'form-control']) !!}
        </div>			
        <div class="form-group">
            {!! Form::label('longitude', 'Longitude:') !!}
			{!! Form::text('longitude', $location->longitude, ['class' => 'form-control']) !!}
        </div>			
			
        <div class="form-group">
            {!! Form::label('location_type', 'Location Type:') !!}
			{!! Form::text('location_type', $location->pivot->location_type, ['class' => 'form-control']) !!}
        </div>			
        <div class="form-group">
            {!! Form::label('start_date', 'Start date:') !!}
			{!! Form::text('start_date', $location->pivot->start_date, ['class' => 'form-control']) !!}
        </div>			
        <div class="form-group">
            {!! Form::label('end_date', 'End date:') !!}
			{!! Form::text('end_date', $location->pivot->end_date, ['class' => 'form-control']) !!}
        </div>			
			  

		
        <!-- Submit Button -->
        <div class="form-group">
            {!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
        </div> 