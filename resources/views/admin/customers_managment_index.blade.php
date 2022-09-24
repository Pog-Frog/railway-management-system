<?php

use App\User;

$users = User::all();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Railway Management System</title>


    <!-- Bootstrap core CSS -->
    <link href="{{ url('styles/admin/bootstrap.min.css') }}" rel="stylesheet">
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
                            <a class="nav-link" href="{{url("admin/trips")}}">
                                <span data-feather="briefcase"></span>
                                Trips
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url("admin/customers")}}">
                                <span data-feather="users"></span>
                                Customer accounts
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
    <form method="get" action="{{route("search_customers")}}">
        @csrf
        <div class="input-group p-2">
            <input type="search" class="form-control rounded" placeholder="Search by ID, name, email" aria-label="Search"
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
                <th scope="col" style="text-align: center">name</th>
                <th scope="col" style="text-align: center">email</th>
                <th scope="col" style="text-align: center">phone</th>
                <th scope="col" style="text-align: center">gender</th>
                <th scope="col" style="text-align: center">view booked tickets</th>
                <th scope="col" style="text-align: center">delete</th>
            </tr>
            </thead>

            <tbody>
            @if(isset($result))
                @foreach($result as $user)
                    <tr>
                        <td style="text-align: center">
                            <div style="max-width: 500px;max-height: 100px;overflow-y: auto;">
                                <input type="type" style="max-width: 50px; max-height: 100px;overflow-y: auto; text-align: center;" name="train_id" value="{{$user->id}}" disabled>
                            </div>
                        </td>

                        <td style="text-align: center">
                            <div style="max-width: 500px;max-height: 100px;overflow-y: auto;">
                                {{$user->name}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 500px;max-height: 100px;overflow-y: auto;">
                                {{$user->email}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                {{$user->phone}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                {{$user->gendre}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <a href="{{route('view_booked_tickets', ['user_id'=>($user->id)])}}">view</a>
                        </td>
                        <td style="text-align: center">
                            <a href="{{route('delete_customer', ['user_id'=>($user->id)])}}">delete</a>
                        </td>
                    </tr>
                @endforeach
            @else
                @foreach($users as $user)
                    <tr>
                        <td style="text-align: center">
                            <div style="max-width: 500px;max-height: 100px;overflow-y: auto;">
                                <input type="type" style="max-width: 50px; max-height: 100px;overflow-y: auto; text-align: center;" name="train_id" value="{{$user->id}}" disabled>
                            </div>
                        </td>

                        <td style="text-align: center">
                            <div style="max-width: 500px;max-height: 100px;overflow-y: auto;">
                                {{$user->name}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 500px;max-height: 100px;overflow-y: auto;">
                                {{$user->email}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                {{$user->phone}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                {{$user->gendre}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <a href="{{route('view_booked_tickets', ['user_id'=>($user->id)])}}">view</a>
                        </td>
                        <td style="text-align: center">
                            <a href="{{route('delete_customer', ['user_id'=>($user->id)])}}">delete</a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</main>
</body>

<script src="{{ url('/scripts/admin/jquery.min.js') }}"></script>
<script src="{{ url('/scripts/admin/bootstrap.min.js') }}"></script>
<script src="{{ url('/scripts/admin/feather.min.js') }}"></script>
<script src="{{ url('/scripts/admin/dashboard.js') }}"></script>
</html>
