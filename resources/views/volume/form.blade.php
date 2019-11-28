<div class="card-body">
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label class="form-label">Volume Code</label>
				{!! Form::text('kode_volume', null, ['class' => $errors->has('kode_volume') ? 'form-control is-invalid' : $errors->has('kode_volume') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Enter Kode Volume', 'maxlength'=>2, 'minlength'=>2]) !!}
				@if ($errors->has('kode_volume'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('kode_volume') }}</strong>
                    </span>
                @endif
			</div>
		</div>
		<div class="col-sm-6 col-md-5">
			<div class="form-group">
				<label class="form-label">Volume Name</label>
				{!! Form::text('nama', null, ['class' => $errors->has('nama') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Enter Nama Volume']) !!}
				@if ($errors->has('nama'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('nama') }}</strong>
                    </span>
                @endif
			</div>
		</div>

	</div>
</div>