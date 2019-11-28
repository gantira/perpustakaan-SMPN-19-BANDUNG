@extends('layouts.app', ['linktransaction'=>' active'])

@section('content')
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Edit Transaction # {{ $transaction->transaction->id }} # {{ $transaction->transaction->user->name }} # {{ $transaction->transaction->user->nik }} 
            </h1>
        </div>

        @include('session.alert')

        <div class="row row-cards">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-header ">
                                <h3 class="card-title">
                                    Cart
                                </h3>
                            </div>
                            <div class="card-body">
                                <table class="table card-table table-vcenter" border="0">
                                    @foreach (Cart::content() as $row)
                                    <tr>
                                        <td><span class="avatar" style="background-image: url({{ asset('upload/books/'.$row->model->image) }})"></span></td>
                                        <td>{{ $row->model->title}}</td>
                                        <td class="w-1"><a href="{{ route('transaction.removeItem', $row->rowId) }}" class="icon"><i class="fe fe-trash"></i></a></td>
                                    </tr>
                                    @endforeach
                                </table>

                                @if (Cart::content()->count())
                                {!! Form::model($transaction, ['route' => ['transaction.update', $transaction->transaction->id], 'method' => 'PATCH']) !!}

                                {{-- <div class="form-group">
                                    <label class="form-label">Users list</label>
                                    <select name="user_id" id="select-users" class="form-control custom-select">
                                            <option></option>
                                        @foreach ($users as $row)
                                            <option value="{!! $row->id !!}" data-data='{"image": "{{ asset('upload/users/'.$row->image) }}"}'>{{ $row->name }} | {{ $row->nik }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('user_id'))
                                        <small style="color: red">{{ $errors->first('user_id') }}</small>
                                    @endif
                                    <script>
                                        require(['jquery', 'selectize'], function ($, selectize) {
                                            $(document).ready(function () {
                                                $('#select-users').selectize({
                                                    render: {
                                                        option: function (data, escape) {
                                                            return '<div>' +
                                                            '<span class="image"><img src="' + data.image + '" alt=""></span>' +
                                                            '<span class="title">' + escape(data.text) + '</span>' +
                                                            '</div>';
                                                        },
                                                        item: function (data, escape) {
                                                            return '<div>' +
                                                            '<span class="image"><img src="' + data.image + '" alt=""></span>' +
                                                            escape(data.text) +
                                                            '</div>';
                                                        }
                                                    }
                                                });

                                            });
                                        });
                                    </script>
                                </div> --}}

                               
                                <div class="mt-5 d-flex align-items-center">
                                    <div class="ml-auto">
                                        <strong>{!! Cart::content()->count(); !!} book(s)</strong>
                                    </div>
                                    @if ($transaction->transaction->status_pinjam)
                                    <div class="ml-auto">
                                        <button class="btn btn-primary" onclick="event.preventDefault();this.className=('btn btn-secondary btn-loading');submit();"><i class="fe fe-shopping-cart"></i> Finish Transaction</button>
                                    </div>
                                    @else
	                                <div class="ml-auto">
                                    	<button class="btn btn-green" disabled="">Returned</button>
                                    </div>
                                    @endif
                                </div>
                                @else
                                <i class="fe fe-shopping-cart"></i>
                                @endif
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header float-right">
                        <h3 class="card-title">
                            Book Lists
                        </h3>
                        <div class="card-options">
                            <form action="">
                                <div class="input-group">
                                    {!! Form::text('q', null, ['class' => 'form-control form-control-sm ml-2', 'placeholder' => 'Search book...']) !!}
                                    <span class="input-group-btn ml-2">
                                        <button class="btn btn-sm btn-default" type="submit">
                                            <span class="fe fe-search"></span>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table card-table table-vcenter">
                        @forelse ($books as $row)
                        <tr>
                            <td><img src="{{ asset('upload/books/'.$row->image) }}" alt="" class="h-8"></td>
                            <td>
                                {{ $row->title }}
                            </td>
                            <td class="text-right text-muted d-none d-md-table-cell text-nowrap">{{ $row->stock }} stock of book(s)</td>
                            <td class="text-right text-muted d-none d-md-table-cell text-nowrap">{{ $row->stockRemaining($row->id) }} remaining</td>
                            <td class="text-right">
                                <strong></strong>
                            </td>
                            <td><a href="{{ route('transaction.addItem', [$row->id, $row->title]) }}" class="btn btn-secondary {{ $row->stockRemaining($row->id) ? '' : 'disabled' }}"><i class="fe fe-plus"></i></a></td>
                        
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