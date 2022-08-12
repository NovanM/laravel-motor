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
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Layanan</th>
                                    <th>ID Tranksaksi</th>
                                    <th>Waktu Tranksaksi</th>
                                    <th>Nama Mekanik</th>
                                    <!-- DITERIMA SAMPAI SELESAI -->
                                    <th>Status Kerja</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allMekanikStatus as $i => $row)
                              
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$row->transaksi->nama_layanan}}</td>
                                    <td>0000{{$row->transaksi->id}}</td>
                                    <td>{{date('d F Y h:m',strtotime($row->created_at))}}</td>
                                    <td>{{$row->user->name}}</td>
                                    <td> @if($row->status_kerja == 'Diterima')
                                     <label class="badge badge-secondary">{{$row->status_kerja}}</label>
                                        @elseif($row->status_kerja == 'Proses')
                                        <label class="badge badge-danger">{{$row->status_kerja}}</label>
                                        @else
                                        <label class="badge badge-success">{{$row->status_kerja}}</label>
                                        @endif

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


@endsection