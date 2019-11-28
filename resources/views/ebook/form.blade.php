<div class="card-body">
	<div class="row">
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
		<div class="col-sm-6 col-md-6">
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
		<div class="col-sm-12 col-md-12 mb-0">
			<div class="form-group">
				<div class="form-label">Image</div>
				@isset ($ebook->image)
					<img class="img-thumbnail mb-2" width="200px" src="{!! asset('upload/ebooks/'.$ebook->image) !!}">
				@endisset
				<div class="custom-file">
					<label class="custom-file-label">Choose file</label>
					{!! Form::file('image', ['class' => $errors->has('image') ? 'custom-file-input is-invalid' : 'custom-file-input']) !!}
					@if ($errors->has('image'))
	                    <span class="invalid-feedback">
	                        <strong>{{ $errors->first('image') }}</strong>
	                    </span>
	                @endif
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-12 mb-0">
			<div class="form-group">
				<div class="form-label">Upload PDF</div>
				@isset ($ebook->pdf)
					<a href="{!! asset('upload/ebooks/pdf/'.$ebook->pdf) !!}" target="_blank">{!! $ebook->title !!}</a>
				@endisset
				<div class="custom-file">
					<label class="custom-file-label">Choose pdf file</label>
					{!! Form::file('pdf', ['class' => $errors->has('pdf') ? 'custom-file-input is-invalid' : 'custom-file-input']) !!}
					@if ($errors->has('pdf'))
	                    <span class="invalid-feedback">
	                        <strong>{{ $errors->first('pdf') }}</strong>
	                    </span>
	                @endif
				</div>
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
	</div>
</div>
