@extends('layouts.app', ['linkhome'=>' active'])

@push('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    
    <style type="text/css">
        .carousel img {
            width: 100%; // Add this
        }
    </style>
@endpush

@section('content')
<div class="my-3 my-md-5">
    <div class="container">


        <div class="row">
            <div class="col-md-12">
                <div id="demo" class="carousel slide" data-ride="carousel">
                    <ul class="carousel-indicators">
                        <li data-target="#demo" data-slide-to="0" class="active"></li>
                        <li data-target="#demo" data-slide-to="1"></li>
                        <li data-target="#demo" data-slide-to="2"></li>
                        <li data-target="#demo" data-slide-to="3"></li>
                    </ul>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('img/4.jpeg') }}" alt="Los Angeles" width="100%" height="500">
                            <div class="carousel-caption">
                                <h3>Welcome to Library of SMPN 19 Bandung</h3>
                                <p>Reading is part of Faith</p>
                            </div>   
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('img/2.jpeg') }}" alt="Chicago" width="500" height="500">
                            <div class="carousel-caption">
                                <h3>Mosque of SMPN 19 Bandung</h3>
                                <p>Dont forget to pray!</p>
                            </div>   
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('img/3.jpeg') }}" alt="New York" width="500" height="500">
                            <div class="carousel-caption">
                                <h3>Monday Ceremonial</h3>
                                <p>We love Indonesia!</p>
                            </div> 
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('img/1.jpeg') }}" alt="New York" width="500" height="500">
                            <div class="carousel-caption">
                                <h3>Welcome to Library of SMPN 19 Bandung</h3>
                                <p>Reading is part of Faith</p>
                            </div> 
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div>

                <br>
                <br>
                <br>
                    
                <h3>
                    <p align="center">Rules of Library</p>
                    <ol type="1">
                        <li>Don't make any noise in the library.</li>
                        <li>Do not make some damages of library properties.</li>
                        <li>Every member candidates should registered as a member of library.</li>
                        <li>If members are return the book beyond the time determined, member will got charges Rp.20.000.</li>
                        <li>If members are broke or lost the books of library, member will got charges competiable with the damage</li>
                        <li>Every member only can borrow the books are 3 books.</li>
                    </ol>
                </h3>
            </div>
        </div>

        <div class="row">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap" id="example">
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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($books as $row)
                            <tr>
                                <td><span class="text-muted">{!! $loop->iteration !!}</span></td>
                                <td><span class="text-muted">{!! $row->category->kode_kategori . $row->kode_buku !!}</span></td>
                                <td>{!! $row->category->nama !!}</td>
                                <td>{!! $row->title !!}</td>
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
                                @empty
                                <td><i>No Data</i></td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
        <script>
            require(['jquery', 'datatables'], function ($, selectize) {
                $(document).ready( function () {
                    $('#example').DataTable();

                    $('.carousel').carousel({
                      interval: 2000
                    });
                });
            });
        </script>

    </div>
</div>
@endsection

@push('scripts')

<script type="text/javascript">


       
   
</script>
@endpush