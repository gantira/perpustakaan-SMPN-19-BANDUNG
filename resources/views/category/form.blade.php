<div class="card-body">
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label class="form-label">Category Code</label>
				{!! Form::text('kode_kategori', null, ['class' => $errors->has('kode_kategori') ? 'form-control is-invalid' : $errors->has('kode_kategori') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Enter Kode Category', 'maxlength'=>2, 'minlength'=>2]) !!}
				@if ($errors->has('kode_kategori'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('kode_kategori') }}</strong>
                    </span>
                @endif
			</div>
		</div>
		<div class="col-sm-6 col-md-5">
			<div class="form-group">
				<label class="form-label">Category Name</label>
				{!! Form::text('nama', null, ['class' => $errors->has('nama') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Enter Nama Category']) !!}
				@if ($errors->has('nama'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('nama') }}</strong>
                    </span>
                @endif
			</div>
		</div>

	</div>
</div>