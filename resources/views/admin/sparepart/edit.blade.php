@extends('admin.layout.master')

@section('content')

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
                        <form action="{{route('sparepart.update', $data->id)}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @method('PATCH')
                            @csrf
             
                            
                            <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Edit Nama Supplier</label></div>
                                <div class="col-12 col-md-9">
                                    <select class="form-control"  name="nama_supplier" value="{{$data->supplier->nama}}" id="">
                                       
                                        @foreach($dataSupplier as $supplier)                                        
                                            <option   
                                            @if($supplier->nama == $data->supplier->nama)
                                            value="{{$supplier->nama}}"
                                                        selected
                                                   @endif>
                                            {{$supplier->nama}}
                                            </option>
                                        @endforeach
                                        
                                    </select>    
                                </div>
                            </div>



                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">kode</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" value="{{$data->kode}}" name="kode" placeholder="Text" class="form-control"><small class="form-text text-muted">This is a help text</small></div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" value="{{$data->nama}}" name="nama" placeholder="Text" class="form-control"><small class="form-text text-muted">This is a help text</small></div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Harga</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" value="{{$data->harga}}" name="harga" placeholder="Text" class="form-control"><small class="form-text text-muted">This is a help text</small></div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Harga Jual</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" value="{{$data->harga_jual}}" name="harga_jual" placeholder="Text" class="form-control"><small class="form-text text-muted">This is a help text</small></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Stok</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" value="{{$data->stok}}" name="stok" placeholder="Text" class="form-control"><small class="form-text text-muted">This is a help text</small></div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="file-input" class=" form-control-label">File Gambar</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="file" id="file" name="images" value="{{$data->images}}" class="form-control-file" value="{{ old('images') }}">
                                </div>

                                @error('images')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                               
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



    @endsection