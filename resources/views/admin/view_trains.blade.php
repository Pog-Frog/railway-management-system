<?php

use App\Train;

$trains = Train::all();
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
                            <a class="nav-link" href="{{route("view_trains")}}">
                                <span data-feather="file-text"></span>
                                View Trains
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
    <form method="get" action="{{route("search_trains")}}">
        @csrf
        <div class="input-group p-2">
            <input type="search" class="form-control rounded" placeholder="Search by number, type, number of cars, ID, status, line, captain" aria-label="Search"
                   name="search_query" aria-describedby="search-addon"/>
            <button type="submit" class="btn btn-outline-primary">search</button>
        </div>
    </form>
    <div style="overflow-x: auto;" class="p-3 my-3 border rounded">
        @csrf
        @if(Session::has('success'))
            <div class="alert-success">{{Session::get('success')}}

            </div>
        @else
            <div class="alert-danger">{{Session::get('fail')}}

            </div>
        @endif
        <table id="task-table" class="table table-r">
            <thead>
            <tr>
                <th scope="col" style="text-align: center">ID</th>
                <th scope="col" style="text-align: center">number/name</th>
                <th scope="col" style="text-align: center">type</th>
                <th scope="col" style="text-align: center">number of cars</th>
                <th scope="col" style="text-align: center">status</th>
                <th scope="col" style="text-align: center">line</th>
                <th scope="col" style="text-align: center">captain</th>
                <th scope="col" style="text-align: center">updated at</th>
                <th scope="col" style="text-align: center">edit</th>
            </tr>
            </thead>

            <tbody>
            @if(isset($result))
                @foreach($result as $train)
                    <tr>
                        <th scope="row">
                            <input type="type" style="max-width: 50px; max-height: 100px;overflow-y: auto; text-align: center;" name="train_id" value="{{$train->id}}" disabled>
                        </th>

                        <td style="text-align: center">
                            <div style="max-width: 500px;max-height: 100px;overflow-y: auto;">
                                {{$train->number}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                @if(is_null($train->types))
                                    {{"not assigned"}}
                                @else
                                    {{$train->types->name}}
                                @endif
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                {{$train->no_of_cars}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                {{$train->status}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                @if(is_null($train->lines))
                                    {{"not assigned"}}
                                @else
                                    {{$train->lines->name}}
                                @endif
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                @if(is_null($train->captain))
                                    {{"not assigned"}}
                                @else
                                    {{$train->captains->name}}
                                @endif
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                {{$train->updated_at}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <a href="{{route('edit_train_index', ['train_id'=>($train->id)])}}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            @else
                @foreach($trains as $train)
                        <tr>
                            <th scope="row">
                                <input type="type" style="max-width: 50px; max-height: 100px;overflow-y: auto; text-align: center;" name="train_id" value="{{$train->id}}" disabled>
                            </th>

                            <td style="text-align: center">
                                <div style="max-width: 500px;max-height: 100px;overflow-y: auto;">
                                    {{$train->number}}
                                </div>
                            </td>
                            <td style="text-align: center">
                                <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                    @if(is_null($train->types))
                                        {{"not assigned"}}
                                    @else
                                        {{$train->types->name}}
                                    @endif
                                </div>
                            </td>
                            <td style="text-align: center">
                                <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                    {{$train->no_of_cars}}
                                </div>
                            </td>
                            <td style="text-align: center">
                                <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                    {{$train->status}}
                                </div>
                            </td>
                            <td style="text-align: center">
                                <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                    @if(is_null($train->lines))
                                        {{"not assigned"}}
                                    @else
                                        {{$train->lines->name}}
                                    @endif
                                </div>
                            </td>
                            <td style="text-align: center">
                                <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                    @if(is_null($train->captain))
                                        {{"not assigned"}}
                                    @else
                                        {{$train->captains->name}}
                                    @endif
                                </div>
                            </td>
                            <td style="text-align: center">
                                <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                    {{$train->updated_at}}
                                </div>
                            </td>
                            <td style="text-align: center">
                                <a href="{{route('edit_train_index', ['train_id'=>($train->id)])}}">Edit</a>
                            </td>
                        </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</main>
</body>
<script src="{{ url('/scripts/bootstrap.bundle.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE"
        crossorigin="anonymous"></script>
<script src="{{ url('/scripts/admin/dashboard.js') }}"></script>
</html>
