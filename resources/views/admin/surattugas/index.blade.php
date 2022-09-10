@extends('admin.layout.master')

@section('content')

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
                        <!-- <a href="{{route('surattugas.create')}}" class="btn btn-success pull-right">tambah</a> -->
                        <strong class="card-title">{{$pagename}}</strong>
                    </div>

                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Nama Mekanik</th>
                                    <th>Nama Layanan</th>
                                    <th>Nama sparepart</th>
                                    <th>Harga total</th>
                                    <th>Waktu Transaksi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allSurattugas as $i => $row)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$row ->nama_pelanggan}}</td>
                                    @empty($row->nama_mekanik)
                                    <td>Mekanik Belum Dipilih</td>
                                    @else
                                    <td>{{$row ->nama_mekanik}}</td>
                                    @endempty
                                    <td>{{$row ->layanan->jenis_layanan}}</td>
                                    <td>{{$row ->layanan->keterangan}}</td>
                                    <td>@currency($row->layanan->harga)</td>
                                    <td>{{date('d F Y',strtotime($row->created_at))}}</td>
                                    <td>



                                        <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModal-{{$row->id}}" data-whatever="@mdo">Pilih Mekanik</button>


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
                <h5 class="modal-title" id="exampleModalLabel">Surat Tugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('update-nama-mekanik', $row->id)}}" enctype="multipart/form-data" method="POST">
                    
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label ">Nama Pelanggan</label>
                        <input type="text" name="nama_pelanggan" class="form-control " value="{{$row->nama_pelanggan}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label ">Nama Mekanik</label>

                        <select class="form-control" name="nama_mekanik" id="">
                            <option value="" label="Pilih Mekanik"></option>
                            @foreach($dataMekanik as $mekanik)

                            <option value="
                                            {{$mekanik->name}}">
                                {{$mekanik->name}}
                            </option>

                            @endforeach
                        </select>
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
                        <button type="submit" class="btn btn-submit  btn-primary">Submit</button>
                    </div>

                </form>


            </div>

        </div>
    </div>
</div>
@endforeach


@endsection