@extends('layouts.app', ['linkstuff'=>' active'])

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="card mt-5">
				<div class="card-header float-right">
					<h3 class="card-title">
						Book List
					</h3>
					<div class="card-options">
						<form action="">
							<div class="input-group">
								<a href="{{ route('book.create') }}" class="btn btn-primary btn-sm">Add</a>
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
								<th>Book Code</th>
								<th>Category</th>
								<th>Title</th>
								<th>Year</th>
								<th>Author</th>
								<th>Publisher</th>
								<th>ISBN</th>
								<th>Stock</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@forelse ($books as $row)
							<tr>
								<td><span class="text-muted">{!! $loop->iteration !!}</span></td>
								<td><span class="text-muted">{!! $row->category->kode_kategori . $row->kode_buku !!}</span></td>
								<td><a href="#" class="text-inherit">{!! $row->category->nama !!}</a></td>
								<td><a href="#" class="text-inherit">{!! $row->title !!}</a></td>
								<td>{!! $row->year !!}</td>
								<td>
									{!! $row->author !!}
								</td>
								<td>
									{!! $row->publisher !!}
								</td>
								<td>
									{!! $row->isbn !!}
								</td>
								<td>{!! $row->stock !!}</td>
								<td></td>
								<td class="w-1">
									<a class="icon" href="{!! route('book.edit', $row->id) !!}">
										<button class="btn btn-secondary btn-sm btn" title="Edit Book"><i class="fe fe-edit"></i></button>
									</a>
									{!! Form::open([
										'method'=> 'DELETE',
										'route' => ['book.destroy', $row->id],
										'style' => 'display:inline'
										]) !!}

									{!! Form::button('<i class="fe fe-trash" aria-hidden="true"></i>', array(
										'type' => 'submit',
										'class' => 'btn btn-secondary btn-sm',
										'title' => 'Delete Book',
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
