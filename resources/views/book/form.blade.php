		{!! Form::hidden('kode_buku', \Carbon\Carbon::now(), []) !!}
		
		<div class="col-md-5">
			<div class="form-group">
				<label class="form-label">Title</label>
				{!! Form::text('title', null, ['class' => $errors->has('title') ? 'form-control is-invalid' : $errors->has('title') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Enter title']) !!}
				@if ($errors->has('title'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
			</div>
		</div>

		<div class="col-sm-6 col-md-3">
			<div class="form-group">
				<label class="form-label">Author</label>
				{!! Form::text('author', null, ['class' => $errors->has('author') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Enter author']) !!}
				@if ($errors->has('author'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('author') }}</strong>
                    </span>
                @endif
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="form-group">
				<label class="form-label">Publisher</label>
				{!! Form::text('publisher', null, ['class' => $errors->has('publisher') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Enter publisher']) !!}
				@if ($errors->has('author'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('author') }}</strong>
                    </span>
                @endif
			</div>
		</div>

		<div class="col-sm-6 col-md-3">
			<div class="form-group">
				<label class="form-label">ISBN</label>
				{!! Form::text('isbn', null, ['class' => $errors->has('isbn') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Enter isbn']) !!}
				@if ($errors->has('isbn'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('isbn') }}</strong>
                    </span>
                @endif
			</div>
		</div>

		<div class="col-sm-6 col-md-3">
			<div class="form-group">
				<label class="form-label">Year</label>
				{!! Form::number('year', null, ['class' => $errors->has('year') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Enter year']) !!}
				@if ($errors->has('year'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('year') }}</strong>
                    </span>
                @endif
			</div>
		</div>

		<div class="col-sm-6 col-md-3">
			<div class="form-group">
				<label class="form-label">Stock</label>
				{!! Form::number('stock', null, ['class' => $errors->has('stock') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Enter stock']) !!}
				@if ($errors->has('stock'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('stock') }}</strong>
                    </span>
                @endif
			</div>
		</div>

		<div class="col-sm-6 col-md-3">
			<div class="form-group">
				<label class="form-label">Harga</label>
				{!! Form::number('harga', null, ['class' => $errors->has('harga') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Enter harga']) !!}
				@if ($errors->has('harga'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('harga') }}</strong>
                    </span>
                @endif
			</div>
		</div>

		<div class="col-sm-6 col-md-6 mb-0">
			<div class="form-group">
				<div class="form-label">Image File</div>
				@isset ($book->image)
					<img class="img-thumbnail mb-2" width="200px" src="{!! asset('upload/books/'.$book->image) !!}">
				@endisset
				<div class="">
					<label class="">Choose file</label>
					{!! Form::file('image', ['class' => $errors->has('image') ? 'custom-file-input is-invalid' : '']) !!}
					@if ($errors->has('image'))
	                    <span class="invalid-feedback">
	                        <strong>{{ $errors->first('image') }}</strong>
	                    </span>
	                @endif
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-md-3">
			<div class="form-group">
				<label class="form-label">Category</label>
				{!! Form::select('category_id', \App\Category::pluck('nama', 'id'), null, ['class' => $errors->has('category_id') ? 'form-control is-invalid' : 'form-control', 'placeholder'=>'']) !!}
				@if ($errors->has('category_id'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('category_id') }}</strong>
                    </span>
                @endif
			</div>
		</div>

		<div class="col-sm-6 col-md-3">
			<div class="form-group">
				<label class="form-label">Volume</label>
				{!! Form::select('volume_id', \App\Volume::pluck('nama', 'id'), null, ['class' => $errors->has('volume_id') ? 'form-control is-invalid' : 'form-control', 'placeholder'=>'']) !!}
				@if ($errors->has('volume_id'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('volume_id') }}</strong>
                    </span>
                @endif
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group mb-0">
				<label class="form-label">Description</label>
				{!! Form::textarea('description', null, ['class' => $errors->has('description') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Here can be your description of book', 'rows' => 5]) !!}
				@if ($errors->has('description'))
	                    <span class="invalid-feedback">
	                        <strong>{{ $errors->first('description') }}</strong>
	                    </span>
	               @endif
			</div>
		</div>
