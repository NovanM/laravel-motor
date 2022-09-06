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
                        <form action="{{route('users.update', $user->id)}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @method('PATCH')
                            @csrf
             
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Name</label></div>
                                <div class="col-12 col-md-9"><input type="text" value ="{{$user->name}}" id="text-input" name="txtname_user"  class="form-control"> </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Email Address</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" value ="{{$user -> email}}" name="txtemail_user"  class="form-control"> </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Password</label></div>
                                <div class="col-12 col-md-9"><input type="password" id="text-input" name="txtpassword_user"  class="form-control"> </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Confirm Password</label></div>
                                <div class="col-12 col-md-9"><input type="password" id="text-input" name="txtConfirmPassword_user"  class="form-control"> </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="select" class=" form-control-label">Select</label></div>
                                <div class="col-12 col-md-9">
                                    <select name="role_user" id="select" class="form-control">
                                        @foreach($allRoles as $row)
                                        <option value={{$row ->id}}
                                        @if(in_array($row->id, $userRole))
                                            selected
                                        @endif
                                        >
                                        {{$row -> name}}</option>
                                        @endforeach
                                      
                                    </select>
                                </div>
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