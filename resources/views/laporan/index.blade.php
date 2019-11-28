@extends('layouts.app', ['linklaporan'=>' active'])

@section('content')
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Report
            </h1>
        </div>

        @include('session.alert')

        <div class="row row-cards">
            <div class="col-lg-12">
                <div class="card">
                    {{-- <div class="card-header float-right">
                        <h3 class="card-title">
                            Laporan
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
                    </div> --}}

                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th></th>
                                <th>Book(s)</th>
                                <th>Status</th>
                                <th>Charges</th>
                            </tr>
                        </thead>
                        @forelse ($laporan as $row)
                        <tr>
                            <td class="text-center w-1">
                                <div class="avatar avatar-lg d-block" style="background-image: url({{ asset('upload/users/'.$row->user->image) }})">
                                </div>
                            </td>
                            <td class="w-8">
                                <div>{!! $row->user->name !!}</div>
                                <div class="small text-muted">
                                    Registered: {!! \Carbon\Carbon::parse($row->user->created_at)->format('M d, Y') !!} <br>
                                    Nik: {!! $row->user->nik !!} <br>
                                    Kelas: {!! $row->user->kelas !!}
                                </div>
                            </td>
                            <td class="">
                                @foreach ($row->transactionDetail as $val)
                                    
                                    <div class="clearfix">
                                      {{--   <div class="float-left">
                                            <strong>Day {!! $row->hariKe($val->tgl_pinjam, $val->tgl_kembali) !!}</strong>
                                        </div> ~  --}}
                                        <span class="fe fe-book"></span>{!! $val->book->title !!} 
                                        <div class="float-right">
                                            <small class="text-muted">{!! \Carbon\Carbon::parse($val->tgl_pinjam)->format('M d, Y') !!} - {!! \Carbon\Carbon::parse($val->tgl_kembali)->format('M d, Y') !!}</small>
                                        </div>
                                    </div>
                                    {{-- <div class="progress progress-xs">
                                        <div class="progress-bar {!! $val->status == 'returned' ? 'bg-secondary' : $row->indktrBg($row->id, $row->tgl_pinjam, $row->tgl_kembali) !!}" role="progressbar" style="width: {!! $row->indktrW($row->tgl_pinjam, $row->tgl_kembali) !!}"
                                     aria-valuenow="{!! \Carbon\Carbon::parse($row->tgl_pinjam)->diffInDays(\Carbon\Carbon::parse($row->tgl_kembali)) !!}" aria-valuemin="0" aria-valuemax="7"></div>
                                    </div> --}}

                                @endforeach
                            </td>
                            <td class="text-muted">
                                @foreach ($row->transactionDetail as $val)
                                    {!! $val->status !!} <br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($row->transactionDetail as $val)
                                    Rp. {!! number_format($val->denda) !!} <br>
                                @endforeach
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
                    <a href="{{ route('laporan.create') }}" class="btn btn-info"><span class="fa fa-print"></span>Print</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
