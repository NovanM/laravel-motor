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
                        <form action="{{route('sparepart.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf

                            
                            <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Supplier</label></div>

                                <div class="col-12 col-md-9">
                                    <select class="form-control" name="nama_supplier" id="">
                                        <option value="" label="Pilih Supplier"></option>
                                        @foreach($dataSupplier as $supplier)
                                        
                                            <option value="
                                            {{$supplier->nama}}">
                                            {{$supplier->nama}}
                                        </option>
                                        
                                        @endforeach
                                    </select>    
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Kode</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="kode"  class="form-control"> </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Sparepart</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="nama"  class="form-control"> </div>
                            </div>
                          
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Harga</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="harga"  class="form-control"> </div>
                            </div>
                          
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Harga Jual</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="harga_jual"  class="form-control"> </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Stok</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="stok"  class="form-control"> </div>
                            </div>
                            

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="file-input" class=" form-control-label">File Gambar</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="file" id="file" name="images" class="form-control-file" value="{{ old('images') }}">
                                </div>

                                @error('file_disposisi')
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