@extends('admin.layout.master')

@section('content')

<link rel="stylesheet" href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('vendors/themify-icons/css/themify-icons.css')}}">
<link rel="stylesheet" href="{{asset('vendors/flag-icon-css/css/flag-icon.min.css')}}">
<link rel="stylesheet" href="{{asset('vendors/selectFX/css/cs-skin-elastic.css')}}">
<link rel="stylesheet" href="{{asset('vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">



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

<!-- Button trigger modal -->

<!-- <script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('vendors/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script> -->

<script>

</script>



<script src="{{asset('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/jszip/dist/jszip.min.js')}}"></script>
<script src="{{asset('vendors/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{asset('vendors/pdfmake/build/vfs_fonts.js')}}"></script>
<script src="{{asset('vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/js/init-scripts/data-table/datatables-init.js')}}"></script>


@endsection