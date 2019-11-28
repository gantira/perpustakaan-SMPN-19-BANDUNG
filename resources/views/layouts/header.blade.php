        <div class="header py-4">
			<div class="container">
				<div class="d-flex">
					<a class="header-brand tracking-wide" href="{{ route('home.index') }}">
						 <img src="{{ asset('img/logo.jpg') }}" class="header-brand-img" alt="tabler logo"> 
						{!! strtoupper(config('app.name')) !!}
					</a>
					<div class="d-flex order-lg-2 ml-auto">
						{{--  <div class="nav-item d-none d-md-flex">
							<a href="https://github.com/tabler/tabler" class="btn btn-sm btn-outline-primary" target="_blank">Source code</a>
						</div>  --}}
						<div class="dropdown d-none d-md-flex">
							<a class="nav-link icon" data-toggle="dropdown">
								<i class="fe fe-bell"></i>
								<span class="nav-unread"></span>
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
								@forelse (auth()->user()->hasRole('member') ? auth()->user()->transaction()->limit(5)->orderBy('id', 'desc')->get() : \App\Transaction::orderBy('id', 'desc')->get() as $row)

								<a href="#" class="dropdown-item d-flex">
									<span class="avatar mr-3 align-self-center" style="background-image: url({{ asset('upload/users/'.$row->user->image) }})"></span>
									<div>
										<strong>{!! $row->user->name !!}</strong> has borrowed {!! $row->transactionDetail->count() !!} book(s). Due date {!! \Carbon\Carbon::parse($row->tgl_kembali)->format('d, F y') !!}
										<div class="small text-muted">{!! $row->created_at->diffForHumans() !!}</div>
									</div>
								</a>
								@if ($loop->last)
								<div class="dropdown-divider"></div>
								<a href="#" class="dropdown-item text-center text-muted-dark">Mark all as read</a>
								@endif
								@empty
								<a href="#" class="dropdown-item d-flex">
									<span class="text-muted">no notifications</span>
								</a>
								@endforelse
								
								
							</div>
						</div>
						<div class="dropdown">
							<a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
								<span class="avatar" style="background-image: url({{ asset('upload/users/'.auth()->user()->image) }})"></span>
								<span class="ml-2 d-none d-lg-block">
									<span class="text-default">{{ auth()->user()->name }}</span>
									<small class="text-muted d-block mt-1">
									@foreach (auth()->user()->roles as $role)
										{{ $role->name }}
									@endforeach
									</small>
								</span>
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#setting">
									<i class="dropdown-icon fe fe-settings"></i> Settings
								</a>
								{{-- <a class="dropdown-item" href="#">
									<i class="dropdown-icon fe fe-user"></i> Profile
								</a>
								<a class="dropdown-item" href="#">
									<span class="float-right"><span class="badge badge-primary">6</span></span>
									<i class="dropdown-icon fe fe-mail"></i> Inbox
								</a>
								<a class="dropdown-item" href="#">
									<i class="dropdown-icon fe fe-send"></i> Message
								</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">
									<i class="dropdown-icon fe fe-help-circle"></i> Need help?
								</a> --}}
								<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
								document.getElementById('logout-form').submit();">
								<i class="dropdown-icon fe fe-log-out"></i> Sign out
								
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</a>
						</div>
					</div>
				</div>
				<a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
					<span class="header-toggler-icon"></span>
				</a>
			</div>
		</div>
	</div>
	<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
		<div class="container">
			<div class="row align-items-center">
				@if (url()->current() == url('/home'))
					
				<div class="col-lg-3 ml-auto">
					<form action="{{ url()->current() }}" class="input-icon my-3 my-lg-0">
						{!! Form::search('q', null, ['class' => 'form-control header-search', 'placeholder' => 'Search&hellip;', 'tabindex' => '1']) !!}
						<div class="input-icon-addon">
							<i class="fe fe-search"></i>
						</div>
					</form>
				</div>
				@endif
				<div class="col-lg order-lg-first">
					<ul class="nav nav-tabs border-0 flex-column flex-lg-row">
						@role('member')
						<li class="nav-item">
							<a href="{{ url('/home') }}" class="nav-link{{ $linkhome or '' }}"><i class="fe fe-home"></i> Home</a>
						</li>
						<li class="nav-item">
							<a href="{{ url('/elibrary') }}" class="nav-link{{ $linkelibrary or '' }}"><i class="fe fe-book"></i> E-Library</a>
						</li>
						@endrole

						@role('admin')
						<li class="nav-item">
							<a href="javascript:void(0)" class="nav-link{{ $linktransaction or '' }}" data-toggle="dropdown"><i class="fe fe-shopping-cart"></i> Transaction</a>
							<div class="dropdown-menu dropdown-menu-arrow">
								<a href="{{ route('transaction.index') }}" class="dropdown-item"><i class="fe fe-book"></i> Transaction List</a>
								<a href="{{ route('transaction.create') }}" class="dropdown-item"><i class="fe fe-book"></i> Create Transaction</a>
							</div>
						</li>
						<li class="nav-item">
							<a href="javascript:void(0)" class="nav-link{{ $linkstuff or '' }}" data-toggle="dropdown"><i class="fe fe-box"></i> Stuff</a>
							<div class="dropdown-menu dropdown-menu-arrow">
								<a href="{{ route('book.index') }}" class="dropdown-item"><i class="fe fe-book"></i> Book</a>
								<a href="{{ route('category.index') }}" class="dropdown-item"><i class="fe fe-book"></i> Category</a>
								<a href="{{ route('volume.index') }}" class="dropdown-item"><i class="fe fe-book"></i> Volume</a>
								<a href="{{ route('ebook.index') }}" class="dropdown-item"><i class="fe fe-book"></i> E-Book</a>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-user"></i> Manage User & Role</a>
							<div class="dropdown-menu dropdown-menu-arrow">
								<a href="{{ route('roles.index') }}" class="dropdown-item "> Role</a>
								<a href="{{ route('permissions.index') }}" class="dropdown-item "> Permission</a>
								<a href="{{ route('users.index') }}" class="dropdown-item "> User</a>
							</div>
						</li>
						@endrole
						@role('head of library')
						<li class="nav-item">
							<a href="{{ url('/home') }}" class="nav-link{{ $linkhome or '' }}"><i class="fe fe-home"></i> Home</a>
						</li>
						<li class="nav-item">
							<a href="{{ url('/laporan') }}" class="nav-link{{ $linklaporan or '' }}"><i class="fe fe-book"></i> Laporan</a>
						</li>
						@endrole
					</ul>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Setting-->
	{!! Form::model(\App\Setting::find(1), ['route'=>['setting.update', 1], 'method'=>'patch']) !!}
	<div class="modal fade" id="setting" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Charges (Late\Lost\Broken)</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"></span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="form-control-label">Late (Rp)</label>
						{!! Form::number('telat', null, ['class'=>'form-control']) !!}
					</div>
					<div class="form-group">
						<label class="form-control-label">Lost (Rp)</label>
						{!! Form::number('hilang', null, ['class'=>'form-control']) !!}
					</div>
					<div class="form-group">
						<label class="form-control-label">Broken (Rp)</label>
						{!! Form::number('rusak', null, ['class'=>'form-control']) !!}
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="event.preventDefault();this.className=('btn btn-primary btn-loading');submit();">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	{!! Form::close() !!}