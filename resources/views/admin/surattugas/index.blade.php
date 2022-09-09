@extends('admin.layout.master')

@section('content')

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .checked {
        color: orange;
    }

    tfoot, td { border: none; }
</style>
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
                        <a href="{{route('surattugas.create')}}" class="btn btn-success pull-right">tambah</a>
                        <strong class="card-title">{{$pagename}}</strong>
                    </div>

                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Nama Layanan</th>
                                    <th>Nama sparepart</th>
                                    <th>Harga total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allSurattugas as $i => $row)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$row ->nama_pelanggan}}</td>
                                    <td>{{$row ->layanan->jenis_layanan}}</td>
                                    <td>{{$row ->layanan->keterangan}}</td>
                                    <td>@currency($row->layanan->harga)</td>
                                    <td>



                                        <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModal-{{$row->id}}" data-whatever="@mdo">Cetak Data</button>


                                    </td>

                                </tr>

                                @endforeach
                                <!-- <tr>
                                    <td>Garrett Winters</td>
                                    <td>Accountant</td>
                                    <td>Tokyo</td>
                                    <td>$170,750</td>
                                </tr> -->

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->


<!-- <script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('vendors/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script> -->
@foreach($allSurattugas as $i => $row)
<div class="modal fade" id="exampleModal-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cetak Surat Tugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="get" action="">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label ">Nama Pelanggan</label>
                        <input type="text" name="nama_pelanggan" class="form-control " value="{{$row->nama_pelanggan}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label ">Nama Layanan</label>
                        <input type="text" name="nama_layanan" class="form-control " value="{{$row->layanan->jenis_layanan}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label ">Rincian Sparepart</label>
                        <input type="text" name="nama_layanan" class="form-control " value="{{$row->layanan->keterangan}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label ">Harga Total</label>
                        <input type="text" name="nama_layanan" class="form-control " value="{{$row->layanan->harga}}" disabled>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" onclick="printDiv('print_area-{{$row->id}}')" class="btn btn-submit  btn-primary">Cetak Data</button>
                    </div>
                    <div id="print_area-{{$row->id}}" class="table-responsive" hidden>
                        <h4 style="margin-top: 30px; text-align: center;" class="mb-5">Cetak Surat Tugas</h4>

                        <table style="border: 1px solid black; border-collapse: collapse;" class="table table-bordered" width="100%" cellspacing="0">
                            <img src="{{asset('images/logo_motor.png')}}" class="py-3" width="100" alt="Logo">
                            <thead>
                                <tr>
                                    <th style="border: 1px solid black;">Nama Pelanggan</th>
                                    <th style="border: 1px solid black;">Nama Layanan</th>
                                    <th style="border: 1px solid black;">Rincian Sparepart</th>
                                    <th style="border: 1px solid black;">Harga Total</th>

                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td style="border: 1px solid black;">{{$row->nama_pelanggan}}</td>
                                    <td style="border: 1px solid black;">{{$row->layanan->jenis_layanan}}</td>
                                    <td style="border: 1px solid black;">{{$row->layanan->keterangan}}</td>
                                    <td style="border: 1px solid black;"> @currency($row->harga_total)</td>
                                </tr>

                            </tbody>
                            <tfoot  class="py-5">
                            <td >
                            <div class="row">
                                <div class="col-auto">
                                    <h4> Pelanggan</h4>
                                    <br>
                                    <br>
                                    <hr>
                                    
                                </div>
                               
                            </div>
                            </td>
                            <td >
                            <div class="col-auto">
                                    <h4> Mekanik</h4>
                                    <br>
                                    <br>
                                    <hr>
                                    
                                </div>
                            </td>
                            </tfoot>
                        </table>


                    </div>
                </form>


            </div>

        </div>
    </div>
</div>
@endforeach


<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        window.location.href = document.URL
    }
</script>
@endsection