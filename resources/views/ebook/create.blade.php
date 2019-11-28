@extends('layouts.app', ['linkstuff'=>' active'])

@section('content')
<div class="container">
		<div class="page-header">
            <h1 class="page-title">
                Create new E-Book
            </h1>
        </div>
        	{!! Form::open(['route' => 'ebook.store', 'method' => 'POST', 'class' => 'card', 'files' => true]) !!}

				@include('ebook.form')

				<div class="card-footer text-right">
					<button type="button" class="btn btn-secondary mr-1" onclick="event.preventDefault();history.back();">Cancel</button>
					<button type="submit" class="btn btn-primary" onclick="event.preventDefault();this.className=('btn btn-primary btn-loading');submit();">Save and continue</button>
				</div>
			{!! Form::close() !!}
		</div>
@endsection