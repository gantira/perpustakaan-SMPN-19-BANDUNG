@extends('layouts.app', ['linkelibrary'=>' active'])

@section('content')
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                E-Library
            </h1>
        </div>
        <div class="row row-cards row-deck">
            @foreach ($ebooks as $row)
            <div class="col-lg-6">
                <div class="card card-aside">
                    <a href="#" class="card-aside-column" style="background-image: url({{ asset('upload/ebooks/'.$row->image) }})"></a>
                    <div class="card-body d-flex flex-column">
                        <h4><a href="#" class="text-uppercase">{!! $row->title !!}</a></h4>
                        <div class="text-muted" style="height: 55px">{!! str_limit($row->description, 150) !!}</div>
                        <div class="d-flex align-items-center pt-5 mt-auto">
                            {{-- <div class="avatar avatar-md mr-3" style="background-image: url(tabler/demo/faces/female/18.jpg)"><i class="fa fa-univesity"></i></div> --}}
                            <div>
                                <a href="tabler/profile.html" class="text-default">{!! $row->author !!}</a>
                                <small class="d-block text-muted">{!! $row->created_at->diffForHumans() !!}</small>
                            </div>
                            <div class="ml-auto text-muted">
                                <a href="{{ asset('upload/ebooks/pdf/'.$row->pdf) }}" target="_blank" class="btn btn-danger-o btn-sm" data-toggle="tooltip" title="PDF"><i class="fa fa-file-pdf-o"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection