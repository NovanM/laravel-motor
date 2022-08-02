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
                        <a href="{{route('layanan.create')}}" class="btn btn-success pull-right">Create</a>
                        <strong class="card-title">{{$pagename}}</strong>
                    </div>
                   
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Jenis Layanan</th>
                                    <th>Keterangan</th>
                                    <th>Harga</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allLayanan as $i => $row)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$row->jenis_layanan}}</td>
                                    <td>{{$row->keterangan}}</td>
                                    <td> @currency($row->harga)</td>
                                    <td>
                                        
                                        <form class="form-inline" action="{{route('layanan.destroy', $row ->id)}}" method="post" >
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger"  type="submit">Delete</button> 
                                            <a href="{{route('layanan.edit', $row ->id)}}" class="btn btn-outline-primary ml-3" >Edit</a>
                                        </form>
                                    

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