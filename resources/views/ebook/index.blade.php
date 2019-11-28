@extends('layouts.app', ['linkstuff'=>' active'])

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="card mt-5">
				<div class="card-header float-right">
					<h3 class="card-title">
						E-Book List
					</h3>
					<div class="card-options">
						<form action="">
							<div class="input-group">
								<a href="{{ route('ebook.create') }}" class="btn btn-primary btn-sm">Add</a>
								{!! Form::text('q', null, ['class' => 'form-control form-control-sm ml-2', 'placeholder' => 'Search something...']) !!}
								<span class="input-group-btn ml-2">
									<button class="btn btn-sm btn-default" type="submit">
										<span class="fe fe-search"></span>
									</button>
								</span>
							</div>
						</form>
					</div>
				</div>
				@if(Session::has('message'))
				<div class="card-alert alert {{ Session::get('alert-class') }} mb-0">
                    {!! Session::get('message') !!}
                </div>
                @endif
				<div class="table-responsive">
					<table class="table card-table table-vcenter text-nowrap">
						<thead>
							<tr>
								<th class="w-1">No.</th>
								<th>Title</th>
								<th>Author</th>
								<th>Publisher</th>
								<th>ISBN</th>
								<th>Published</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@forelse ($ebooks as $row)

							<tr>
								<td><span class="text-muted">{!! $row->id !!}</span></td>
								<td><a href="#" class="text-inherit">{!! $row->title !!}</a></td>
								<td>
									{!! $row->author !!}
								</td>
								<td>
									{!! $row->publisher !!}
								</td>
								<td>
									{!! $row->isbn !!}
								</td>
								<td>
									{!! $row->created_at->format('Y') !!}
								</td>
								<td class="w-1">

									<a class="icon" href="{!! route('ebook.edit', $row->id) !!}">
										<button class="btn btn-secondary btn-sm btn" title="Edit Ebook"><i class="fe fe-edit"></i></button>
									</a>
									{!! Form::open([
			                            'method'=> 'DELETE',
			                            'route' => ['ebook.destroy', $row->id],
			                            'style' => 'display:inline'
			                        	]) !!}

			                            {!! Form::button('<i class="fe fe-trash" aria-hidden="true"></i>', array(
			                                    'type' => 'submit',
			                                    'class' => 'btn btn-secondary btn-sm',
			                                    'title' => 'Delete Ebook',
			                                    'onclick'=>'return confirm("Confirm delete?")'
			                            )) !!}

			                        {!! Form::close() !!}
								</td>
							</tr>

							@empty
							<td><i>No Data</i></td>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
