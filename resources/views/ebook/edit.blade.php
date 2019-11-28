@extends('layouts.app', ['linkstuff'=>' active'])

@section('content')
<div class="container">
		<div class="page-header">
            <h1 class="page-title">
                Edit # {!! $ebook->title !!}
            </h1>
        </div>
        	{!! Form::model($ebook, ['route' => ['ebook.update', $ebook->id], 'method' => 'PUT', 'class' => 'card', 'files' => true]) !!}

				@include('ebook.form')

				<div class="card-footer text-right">
					<button type="button" class="btn btn-danger float-left" onclick="event.preventDefault();confirm('Confirm delete?') ? document.getElementById('hapus').submit() : '';">Delete</button>
					<button type="button" class="btn btn-secondary mr-1" onclick="event.preventDefault();history.back();">Cancel</button>
					<button type="submit" class="btn btn-primary" onclick="event.preventDefault();this.className=('btn btn-primary btn-loading');submit();">Update</button>
				</div>

				{!! Form::open([
	                'method'=> 'PATCH',
	                'route' => ['ebook.destroy', $ebook->id],
	                'style' => 'display:none',
	                'id' => 'hapus',
	            	]) !!}

	            {!! Form::close() !!}
            
			{!! Form::close() !!}
		</div>

		
@endsection
