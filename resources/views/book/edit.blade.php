@extends('layouts.app', ['linkstuff'=>' active'])

@section('content')
<div class="container">
	<div class="page-header">
		<h1 class="page-title">
			Edit # {!! $book->title !!}
		</h1>
	</div>
	{!! Form::model($book, ['route' => ['book.update', $book->id], 'method' => 'PUT', 'class' => 'card', 'files' => true]) !!}
	<div class="dimmer " id="dimmer">
		<div class="loader"></div>
		<div class="dimmer-content">

			@include('book.form')

			<div class="card-footer text-right">
				<button type="button" class="btn btn-danger float-left" onclick="event.preventDefault();confirm('Confirm delete?') ? document.getElementById('hapus').submit() : '';">Delete</button>
				<button type="button" class="btn btn-secondary mr-1" onclick="event.preventDefault();history.back();">Cancel</button>
				<button type="submit" class="btn btn-primary" onclick="event.preventDefault();this.className=('btn btn-primary btn-loading');document.getElementById('dimmer').className=('dimmer');submit();">Update</button>
			</div>

			{!! Form::open([
				'method'=> 'PATCH',
				'route' => ['book.destroy', $book->id],
				'style' => 'display:none',
				'id' => 'hapus',
				]) !!}
			{!! Form::close() !!}
			
		</div>
	</div>
	{!! Form::close() !!}
</div>

@endsection
