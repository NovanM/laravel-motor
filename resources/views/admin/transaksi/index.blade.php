@extends('admin.layout.master')

@section('content')


<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>


<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Table</a></li>
                    <li class="active">Data table</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{session()-> get('success')}}
                    </div>
                    @endif
                    <div class="card-header">
                        <!-- <a href="{{route('layanan.create')}}" class="btn btn-success pull-right">Create</a> -->
                        <strong class="card-title">{{$pagename}}</strong>
                    </div>

                    <div class="card-body">
                        <button type="button" class="btn btn-success mb-4" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Cetak Data</button>



                        <form action="{{url('dashboard/transaksi/pesanan')}}" method="get">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-1 mt-1">
                                        <p>Filter Laporan</p>
                                    </div>
                                    <div class="col">
                                        <!-- <input type="date" class="form-control" placeholder="date" aria-label="First name"> -->
                                        <input class="form-control dari" id="myInput" name="dari" type="date" value="{{date('Y-m-d')}}">
                                    </div>
                                    <div class="col-auto mt-2">
                                        <p>S/D</p>
                                    </div>
                                    <div class="col">
                                        <input type="date" class="form-control sampai" placeholder="date" name="sampai" value="{{date('Y-m-d')}}">
                                    </div>

                                    <div class="col-auto">
                                        <button class="btn-warning btn" type="submit" id="">Lihat Laporan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @include('admin.transaksi.table')
                        <center>
                            <tr>
                                <div class="row form-group">
                                    <div class="col col-md-12"><label for="text-input" class=" form-control-label text-success"> Total Keseluruhan : @currency($total)</label></div>

                                </div>
                            </tr>
                        </center>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cetak Data Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="get" action="{{route('download-transaksi')}}">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label ">Cetak Dari Tanggal</label>
                        <input type="date" name="dari_ke" class="form-control ">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label ">Sampai Tanggal</label>
                        <input type="date" name="sampai_ke" class="form-control ">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-submit  btn-primary">Cetak Data</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


@endsection