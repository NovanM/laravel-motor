@extends('admin.layout.master')

@section('content')


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />



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
                    <li><a href="#">Forms</a></li>
                    <li class="active">Basic</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">


        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <strong>{{$pagename}}</strong>
                    </div>
                    <div class="card-body card-block">

                        @if($errors->any())
                        <div class="alert alert-danger">
                            <div class="list-group">
                                @foreach($errors->all() as $error)
                                <li class="list-group-item">
                                    {{$error}}
                                </li>
                                @endforeach
                            </div>
                        </div>

                        @endif
                        <form action="{{route('layanan.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Jenis Layanan</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="jenis_layanan"  class="form-control"> </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Keterangan Penambahan Sparepart</label></div>
                               
                                <div class="col-12 col-md-9">
                                    <select id="sparepart_id" name="sparepart_id[]" class="mul-select form-control" multiple='multiple' >
                                        @foreach($data_sparepart as $sparepart)
                                        <option value={{$sparepart ->id}}>{{$sparepart -> nama}}</option>
                                        @endforeach
                                        <!-- <option value="1">Option #1</option>
                                        <option value="2">Option #2</option>
                                        <option value="3">Option #3</option> -->
                                    </select>
                                </div>

                          
                                
                            </div>
                            

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Harga Layanan</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="harga"  class="form-control"    > </div>
                            </div>

                           
                            <button type="submit" class="btn btn-primary btn-sm mr-2">
                                <i class="fa fa-dot-circle-o"></i> Save
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Reset
                            </button>
                        </form>

                    </div>

                </div>
            </div>

        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script>

            $(document).ready(function () {

                $("#sparepart_id").select2({

                    placeholder: "Silahkan Pilih"

                });

            });

        </script>

    @endsection