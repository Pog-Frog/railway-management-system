<?php

use Illuminate\Support\Facades\DB;

$train_types = DB::table('train_types')->get();
$lines = DB::table('lines')->get();
$captains = DB::table('captains')->get();

?>
    <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Dashboard Template · Bootstrap v5.1</title>


    <!-- Bootstrap core CSS -->
    <link href="{{ url('styles/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="{{ url('styles/admin/dashboard.css') }}" rel="stylesheet">

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0  shadow">
        <a class="navbar-brand col-md-3 position-sticky col-lg-2 me-0 px-3"
           href="#">Welcome {{$data->name}}</a>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="{{url("admin/logout")}}">Sign out</a>
            </li>
        </ul>
        <button style="margin-right: 80px;" class="navbar-toggler position-absolute d-md-none collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{url("admin/trains")}}">
                                <span data-feather="airplay"></span>
                                Train management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{url("admin/stations")}}">
                                <span data-feather="airplay"></span>
                                Station management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{url("admin/lines")}}">
                                <span data-feather="airplay"></span>
                                Line management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url("admin/employees")}}">
                                <span data-feather="user"></span>
                                Employee Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="briefcase"></span>
                                Trips
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="users"></span>
                                Customer accounts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="bar-chart-2"></span>
                                Reports
                            </a>
                        </li>
                    </ul>
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Management tools</span>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url("admin/trains?insert_train")}}">
                                <span data-feather="file-text"></span>
                                Add Trains
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url("admin/trains/?view_all_trains")}}">
                                <span data-feather="file-text"></span>
                                View Trains
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text"></span>
                                Search Trains
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url("admin/trains?insert_train_type")}}">
                                <span data-feather="file-text"></span>
                                Insert new Train type
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url("admin/trains?view_train_types")}}">
                                <span data-feather="file-text"></span>
                                View Train types
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</head>
<body>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Edit Train</h1>
    </div>
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <form method="POST" action="{{route('edit_train', ['train_id'=>($train->id)])}}">
            @csrf
            @if(Session::has('success'))
                <div class="alert-success">{{Session::get('success')}}

                </div>
            @else
                <div class="alert-danger">{{Session::get('fail')}}

                </div>
            @endif
            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="number" class="form-label">Train number<span
                            class="text-muted">(Required)</span></label>
                    <input type="text" class="form-control" id="number" placeholder="" name="number"
                           value="{{$train->number}}">
                    <span class="text-danger">@error('number') {{$message}} @enderror</span>
                </div>


                <div class="col-md-7">
                    <label for="type" class="form-label">Type<span class="text-muted">(Required)</span></label>
                    <select class="form-select" id="type" name="type">
                        @foreach($train_types as $train_type)
                            @if($train->type == $train_type->id)
                                <option selected value="{{$train_type->id}}">{{$train_type->name}}</option>
                            @else
                                <option value="{{$train_type->id}}">{{$train_type->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    <span class="text-danger">@error('type') {{$message}} @enderror</span>
                </div>

                <div class="col-md-8">
                    <label for="line" class="form-label">Line<span class="text-muted">(Required)</span></label>
                    <select class="form-select" id="type" name="line">
                        @foreach($lines as $line)
                            @if($train->line == $line->id)
                                <option selected value="{{$line->id}}">{{$line->name}}</option>
                            @else
                                <option value="{{$line->id}}">{{$line->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    <span class="text-danger">@error('line') {{$message}} @enderror</span>
                </div>

                <div class="col-8">
                    <label for="no_of_cars" class="form-label">Number of cars<span class="text-muted">(Required)</span></label>
                    <input type="type" class="form-control" id="no_of_cars" placeholder="" name="no_of_cars" value="{{$train->no_of_cars}}">
                    <span class="text-danger">@error('no_of_cars') {{$message}} @enderror</span>
                </div>

                <div class="col-md-8">
                    <label for="captain" class="form-label">Assign captain<span class="text-muted">(Required)</span></label>
                    <select class="form-select" id="captain" name="captain">
                        <option value="null">--None--</option>
                        @foreach($captains as $captain)
                            @if($train->captain == $captain->id)
                                <option selected value="{{$captain->id}}">{{$captain->name}}</option>
                            @else
                                <option value="{{$captain->id}}">{{$captain->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    <span class="text-danger">@error('captain') {{$message}} @enderror</span>
                </div>

                <div style="margin-top: 15px;" class="row ">
                    <label style="margin-left: -10px;" class="form-label">Train status</label>
                    <div class="form-check col-auto">
                        @if($train->status == "true")
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" checked
                                   value="true">
                            <label class="form-check-label" for="flexRadioDefault1">
                                true
                            </label>
                        @else
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="true">
                            <label class="form-check-label" for="flexRadioDefault1">
                                true
                            </label>
                        @endif
                    </div>
                    <div class="form-check col-auto">
                        @if($train->status == "true")
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2"
                                   value="false">
                            <label class="form-check-label" for="flexRadioDefault2">
                                false
                            </label>
                        @else
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="false"
                                   checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                false
                            </label>
                        @endif
                    </div>
                </div>
                <button class="w-100 btn btn-primary btn-lg" type="submit">Submit</button>
        </form>
        <form method="POST" action="{{route('delete_train', ['train_id'=>($train->id)])}}">
            @csrf
            <div class="col text-center">
                <button class="w-25 btn btn-primary btn-danger" type="submit">Delete Train</button>
            </div>
        </form>
    </div>
</main>
</body>
<script src="{{ url('/scripts/bootstrap.bundle.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE"
        crossorigin="anonymous"></script>
<script src="{{ url('/scripts/admin/dashboard.js') }}"></script>
</html>
