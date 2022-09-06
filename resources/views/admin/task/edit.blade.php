@extends('admin.layout.master')

@section('content')

<link rel="stylesheet" href="{{asset('public/vendors/bootstrap/dist/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('public/vendors/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('public/vendors/themify-icons/css/themify-icons.css')}}">
<link rel="stylesheet" href="{{asset('public/vendors/flag-icon-css/css/flag-icon.min.css')}}">
<link rel="stylesheet" href="{{asset('public/vendors/selectFX/css/cs-skin-elastic.css')}}">

<link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">

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
                        <form action="{{route('task.update', $data ->id)}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @method('PATCH')
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Name Task</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="txtname_task" value="{{$data->name_task}}"  class="form-control"> </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="select" class=" form-control-label">Select</label></div>
                                <div class="col-12 col-md-9">
                                    <select name="optionid_category" id="select" class="form-control">
                                        @foreach($data_category as $category)
                                        <option value={{$category ->id}} @if($category -> id == $data->id_category)
                                            selected
                                            @endif
                                            >{{$category -> name_category}}</option>
                                        @endforeach
                                        <!-- <option value="1">Option #1</option>
                                        <option value="2">Option #2</option>
                                        <option value="3">Option #3</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Description Task</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="txtdescription_task" value="{{$data ->desc_task}}"  class="form-control"> </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label class=" form-control-label">Status Task</label></div>
                                <div class="col col-md-9">
                                    <div class="form-check-inline form-check">
                                        <label for="inline-radio1" class="form-check-label ">
                                            <input type="radio" id="inline-radio1" name="radiostatus_task" value="0" {{$data -> status_task == 0 ? 'checked' : ''}} class="form-check-input">Ongoing
                                        </label>
                                        <label for="inline-radio2" class="form-check-label ml-1 ">
                                            <input type="radio" id="inline-radio2" name="radiostatus_task" value="1" {{$data -> status_task == 1 ? 'checked' : ''}} class="form-check-input">Done
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm mr-2">
                                <i class="fa fa-dot-circle-o"></i> Update
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



    <script src="{{asset('public/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('public/vendors/popper.js/dist/umd/popper.min.js')}}"></script>

    <script src="{{asset('public/vendors/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script src="{{asset('public/vendors/jquery-validation-unobtrusive/dist/jquery.validate.unobtrusive.min.js')}}"></script>

    <script src="{{asset('public/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/assets/js/main.js')}}"></script>
    @endsection