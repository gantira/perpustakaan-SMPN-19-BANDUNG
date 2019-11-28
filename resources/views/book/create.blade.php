@extends('layouts.app', ['linkstuff'=>' active'])

@section('content')
<div class="container">
	<div class="page-header">
		<h1 class="page-title">
			Create new Book
		</h1>
	</div>
	{!! Form::open(['route' => 'book.store', 'method' => 'POST', 'class' => 'card', 'files' => true]) !!}
	<div class="dimmer" id="dimmer">
		<div class="loader"></div>
		<div class="dimmer-content">
			<div class="card-body">
				<div class="row">
					@include('book.form')
				</div>
			</div>
			<div class="card-footer text-right">
				<button type="button" class="btn btn-secondary mr-1" onclick="event.preventDefault();history.back();">Cancel</button>
				<button type="submit" class="btn btn-primary" onclick="event.preventDefault();this.className=('btn btn-primary btn-loading');document.getElementById('dimmer').className=('dimmer');submit();">Save and continue</button>
			</div>
		</div>
	</div>
</div>
{!! Form::close() !!}
@endsection