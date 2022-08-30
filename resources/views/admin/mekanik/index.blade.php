@extends('admin.layout.master')

@section('content')


<style>
    .checked {
        color: orange;
    }
</style>



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
                        <a href="{{route('mekanik.create')}}" class="btn btn-success pull-right">Tambah</a>
                        <strong class="card-title">{{$pagename}}</strong>
                    </div>
                   
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Telepon</th>
                                    <th>Rating Mekanik</th>
                                    <th>Aksi</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                              
                                @foreach($allUsers as $row)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->username}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>
                                            
                                    <label class ="badge badge-success"> {{$row->role}}</label>
                                                                  
                                    </td>
                                    <td>
                                    @if($row->status=='activate')         
                                    <label class ="badge badge-success"> Aktif</label>
                                    @else
                                    <label class ="badge badge-danger">Tidak Aktif</label>
                                    @endif
                                    </td>
                                    <td>{{$row ->telepon}}</td>
                                    @if($row->rating == '[]')
                                    <td>-</td>
                                    @else
                                    <td>
                                    <?php
                                        $total = 0;
                                        foreach ($row->rating as $value) {
                                            $total += $value->rating;    
                                        }
                                        $total = round($total/count($row->rating))
                                    ?>
                                     <div >
                                       
                                        @if($total == 1 )
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        @elseif($total == 2)
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        @elseif($total == 3)
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        @elseif($total == 4)
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        @elseif($total == 5 )
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        @endif
                                    </div>
                                    </td>
                                    @endif


                                    <td>
                                        
                                        <form class="form-inline" action="{{route('mekanik-deactivate', $row ->id)}}" method="post" >
                                            @csrf
                                            @method('PATCH')
                                            @if($row->status=='activate')
                                            <button class="btn btn-outline-danger"  type="submit">Tidak Aktif</button> 
                                            @else
                                            <button class="btn btn-outline-success"  type="submit">Aktif</button> 
                                            @endif
                                            <a href="{{route('mekanik.edit', $row ->id)}}" class="btn btn-outline-primary ml-3" >Edit</a>
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