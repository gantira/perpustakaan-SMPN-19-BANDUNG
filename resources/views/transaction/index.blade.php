@extends('layouts.app', ['linktransaction'=>' active'])

@section('content')
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Transaction
            </h1>
        </div>

        @include('session.alert')

        <div class="row row-cards">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header float-right">
                        <h3 class="card-title">
                            Transaction Lists
                        </h3>
                        <div class="card-options">
                            <form action="">
                                <div class="input-group">
                                    {!! Form::text('q', null, ['class' => 'form-control form-control-sm ml-2', 'placeholder' => 'Search transaction...']) !!}
                                    <span class="input-group-btn ml-2">
                                        <button class="btn btn-sm btn-default" type="submit">
                                            <span class="fe fe-search"></span>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>

                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th></th>
                                <th>deadline for return of books</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        @forelse ($transactions as $row)
                        <tr>
                            <td class="text-center w-1">
                                <div class="avatar avatar-lg d-block" style="background-image: url({{ asset('upload/users/'.$row->user->image) }})">
                                </div>
                            </td>
                            <td class="w-8"
                                <div>{!! $row->user->name !!}</div>
                                <div class="small text-muted">
                                    Registered: {!! \Carbon\Carbon::parse($row->user->created_at)->format('M d, Y') !!} <br>
                                    NIS: {!! $row->user->nik !!} <br>
                                    Kelas: {!! $row->user->kelas !!}
                                </div>
                            </td>
                            <td class="">
                                @foreach ($row->transactionDetail as $val)
                                    
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <strong>Day {!! $row->hariKe($val->tgl_pinjam, $val->tgl_kembali) !!}</strong>
                                        </div> ~ 
                                        <span class="fe fe-book"></span>{!! $val->book->title !!} <a href="javascript:void(0)" data-toggle="popover" title="{!! $val->book->title !!}" data-placement="top" data-content='@include('transaction.popover', ['id' => $val->id, 'status'=>$val->status, 'tgl_kembali'=>$val->tgl_kembali])'><span class="text-muted">({!! $val->status !!})</span></a>
                                        <div class="float-right">
                                            <small class="text-muted">{!! \Carbon\Carbon::parse($val->tgl_pinjam)->format('M d, Y') !!} - {!! \Carbon\Carbon::parse($val->tgl_kembali)->format('M d, Y') !!}</small>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar {!! $val->status == 'returned' ? 'bg-secondary' : $row->indktrBg($row->id, $row->tgl_pinjam, $row->tgl_kembali) !!}" role="progressbar" style="width: {!! $row->indktrW($row->tgl_pinjam, $row->tgl_kembali) !!}"
                                     aria-valuenow="{!! \Carbon\Carbon::parse($row->tgl_pinjam)->diffInDays(\Carbon\Carbon::parse($row->tgl_kembali)) !!}" aria-valuemin="0" aria-valuemax="7"></div>
                                    </div>

                                @endforeach
                            </td>
                            <td>
                                @if ($row->hariKe($row->tgl_pinjam, $row->tgl_kembali) > 7 && $row->status_pinjam)
                                    <span class='status-icon bg-danger'></span> Return Now
                                @else
                                    {!! $row->status_pinjam ? "<span class='status-icon bg-warning'></span> On Going" : "<span class='status-icon bg-secondary'></span> Returned" !!}</td>
                                @endif
                            <td class="text-center w-1">
                                <div class="item-action dropdown">
                                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        @if ($row->status_pinjam)
                                            
                                        <a href="{{ route('transaction.edit', $row->id) }}" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Edit </a>
                                        <a href="{{ route('transaction.return', $row->id) }}" class="dropdown-item"><i class="dropdown-icon fe fe-repeat"></i> Return</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="{{ route('transaction.destroy', $row->id) }}" class="dropdown-item" onclick="event.preventDefault();confirm('Confirm delete?') ? document.getElementById('destroy-{{$row->id}}').submit() : '';"><i class="dropdown-icon fe fe-link"></i> Delete</a>
                                        @else
                                        <a href="{{ route('transaction.receipt', $row->id) }}" class="dropdown-item"><i class="dropdown-icon fa fa-print"></i> Receipt</a>
                                        
                                        @endif
                                        
                                        {!! Form::open(['route' => ['transaction.destroy', $row->id], 'method' => 'DELETE', 'id' => 'destroy-'.$row->id]) !!}
                                        {!! Form::close() !!}
                                   
                                    </div>
                                </div>
                            </td>
                            {{-- <td class="text-right text-muted d-none d-md-table-cell text-nowrap">98 reviews</td>
                            <td class="text-right text-muted d-none d-md-table-cell text-nowrap">38 offers</td> --}}
                        </tr>
                        @empty
                        <tr>
                            <td>No Data</td>
                        </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
