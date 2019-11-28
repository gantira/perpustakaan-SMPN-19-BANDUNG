@extends('layouts.app', ['linkstuff'=>' active'])

@section('content')
<div class="container">
		<div class="page-header">
            <h1 class="page-title">
                Edit # {!! $volume->title !!}
            </h1>
        </div>
        	{!! Form::model($volume, ['route' => ['volume.update', $volume->id], 'method' => 'PUT', 'class' => 'card', 'files' => true]) !!}

				@include('volume.form')
            	
				<div class="card-footer text-right">
					<button type="button" class="btn btn-secondary mr-1" onclick="event.preventDefault();history.back();">Cancel</button>
					<button type="submit" class="btn btn-primary" onclick="event.preventDefault();this.className=('btn btn-primary btn-loading');submit();">Save and continue</button>
				</div>
			{!! Form::close() !!}
		</div>

		
@endsection
