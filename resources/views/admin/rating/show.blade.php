@extends('admin.layout.master')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .circle-image img {

        border: 6px solid #fff;
        border-radius: 100%;
        padding: 0px;
        top: -28px;
        position: relative;
        width: 70px;
        height: 70px;
        border-radius: 100%;
        z-index: 1;
        background: #e7d184;
        cursor: pointer;

    }

    .card {

        width: 350px;
        border: none;
        box-shadow: 5px 6px 6px 2px #e9ecef;
        border-radius: 12px;
    }

    .dot {
        height: 18px;
        width: 18px;
        background-color: blue;
        border-radius: 50%;
        display: inline-block;
        position: relative;
        border: 3px solid #fff;
        top: -48px;
        left: 186px;
        z-index: 1000;
    }

    .name {
        margin-top: -21px;
        font-size: 18px;
    }


    .fw-500 {
        font-weight: 500 !important;
    }


    .start {

        color: green;
    }

    .stop {
        color: red;
    }


    .rate {

        border-bottom-right-radius: 12px;
        border-bottom-left-radius: 12px;

    }



    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: center
    }

    .rating>input {
        display: none
    }

    .rating>label {
        position: relative;
        width: 1em;
        font-size: 30px;
        font-weight: 300;
        color: #FFD600;
        cursor: pointer
    }

    .rating>label::before {
        content: "\2605";
        position: absolute;
        opacity: 0
    }

    .rating>label:hover:before,
    .rating>label:hover~label:before {
        opacity: 1 !important
    }

    .rating>input:checked~label:before {
        opacity: 1
    }

    .rating:hover>input:checked~label:before {
        opacity: 0.4
    }


    .buttons {
        top: 36px;
        position: relative;
    }


    .rating-submit {
        border-radius: 15px;
        color: #fff;
        height: 49px;
    }



    .rating-submit:hover {

        color: #fff;
    }

    .checked {
        color: orange;
        width: 10px;
        height: 5px;
        
    }
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
                    <li><a href="#">Forms</a></li>
                    <li class="active">Basic</li>
                </ol>
            </div>
        </div>
    </div>
</div>



<div class="content mt-3">
    <div class="animated fadeIn">


        <center>
            <div class="row">
                <div class="col-lg-12 ">

                    <div class="card ">
                        <div class="card-header">
                            <strong>{{$pagename}}</strong>
                        </div>
                        <div class="card-body card-block ">

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


                        </div>

                        <div class="container d-flex justify-content-center mt-5">

                            <div class="card text-center mb-5">

                                <div class="circle-image">
                                    <img src="{{asset('images/avatar/1.png')}}" width="50">
                                </div>

                                <span class="dot"></span>

                                <span class="name mb-1 fw-500">{{$data->user->name}}</span>
                                <small class="text-black-50">Mekanik</small>
                                <small class="text-black-50 font-weight-bold">{{$data->email}}</small>



                                <div class="location mt-4">

                                    <span><i class="fa fa-map-marker stop mt-2"></i> <small class="text-truncate ml-2">{{$data->komplain}}</small> </span>

                                </div>


                                <div class="rate bg-success py-3 text-white mt-3">

                                    <h6 class="mb-0">Rate Mekanik</h6>
                                    
                                    <div >
                                        @if($data->rating == 1)
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        @elseif($data->rating == 2)
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        @elseif($data->rating == 3)
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        @elseif($data->rating == 4)
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        @elseif($data->rating == 5)
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        @endif
                                    </div>

                                    <div class="buttons px-4 mt-0">
                                        <a href="{{url('dashboard/rating')}}" class="btn btn-warning btn-block rating-submit">Kembali</a>
                                    </div>

                                    
                                </div>






                            </div>



                        </div>
                    </div>


                </div>


            </div>
        </center>
    </div>
    <!-- Button trigger modal -->




    @endsection