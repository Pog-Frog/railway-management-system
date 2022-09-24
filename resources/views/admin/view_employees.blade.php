<?php

use Illuminate\Support\Facades\DB;

$captains = DB::table('captains')->get();
$reservation_emps = DB::table('employees')->get();
$technicians = DB::table('technicians')->get();
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
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Management tools</span>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url("admin/employees?insert_employee_index")}}">
                                <span data-feather="file-text"></span>
                                Add new employee
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route("view_employees")}}">
                                <span data-feather="file-text"></span>
                                View Employees
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
    <form method="get" action="{{route("search_employees")}}">
        @csrf
        <div class="input-group p-2">
            <input type="search" class="form-control rounded" placeholder="Search by name, by email"
                   aria-label="Search"
                   name="search_query" aria-describedby="search-addon"/>
            <select class="form-select" id="profession" name="profession" style="max-width: 15%;">
                <option value="captain">in captains</option>
                <option value="technician">in technicians</option>
                <option value="reservation">in reservations</option>
            </select>
            <button type="submit" class="btn btn-outline-primary">search</button>
        </div>
    </form>
    <div style="overflow-x: auto;" class="p-3 my-3 border rounded">
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
                <th scope="col" style="text-align: center">created at</th>
                <th scope="col" style="text-align: center">updated at</th>
                <th scope="col" style="text-align: center">profession</th>
                <th scope="col" style="text-align: center">edit</th>
            </tr>
            </thead>

            <tbody>
            @if(isset($result))
                @foreach($result as $x)
                    <tr>
                        <td style="text-align: center">
                            <input type="type"
                                   style="max-width: 50px; max-height: 100px;overflow-y: auto; text-align: center;"
                                   name="train_id" value="{{$x->id}}" disabled>
                        </td>

                        <td style="text-align: center">
                            <div style="max-width: 500px;max-height: 100px;overflow-y: auto;">
                                {{$x->name}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                {{$x->email}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                {{$x->created_at}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                {{$x->updated_at}}
                            </div>
                        </td>
                        @if($index == 1)
                            <td style="text-align: center">
                                <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                    captain
                                </div>
                            </td>
                            <td style="text-align: center">
                                <a href="{{route('edit_captain_index', ['emp_id'=>($x->id)])}}">Edit</a>
                            </td>
                        @elseif($index == 2)
                            <td style="text-align: center">
                                <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                    technician
                                </div>
                            </td>
                            <td style="text-align: center">
                                <a href="{{route('edit_technician_index', ['emp_id'=>($x->id)])}}">Edit</a>
                            </td>
                        @else
                            <td style="text-align: center">
                                <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                    reservation employee
                                </div>
                            </td>
                            <td style="text-align: center">
                                <a href="{{route('edit_reservation_employee_index', ['emp_id'=>($x->id)])}}">Edit</a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            @else
                @foreach($captains as $captain)
                    <tr>
                        <td style="text-align: center">
                            <input type="type"
                                   style="max-width: 50px; max-height: 100px;overflow-y: auto; text-align: center;"
                                   name="train_id" value="{{$captain->id}}" disabled>
                        </td>

                        <td style="text-align: center">
                            <div style="max-width: 500px;max-height: 100px;overflow-y: auto;">
                                {{$captain->name}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                {{$captain->email}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                {{$captain->created_at}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                {{$captain->updated_at}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                captain
                            </div>
                        </td>
                        <td style="text-align: center">
                            <a href="{{route('edit_captain_index', ['emp_id'=>($captain->id)])}}">Edit</a>
                        </td>
                    </tr>
                @endforeach
                @foreach($technicians as $technician)
                    <tr>
                        <td style="text-align: center">
                            <input type="type"
                                   style="max-width: 50px; max-height: 100px;overflow-y: auto; text-align: center;"
                                   name="train_id" value="{{$technician->id}}" disabled>
                        </td>

                        <td style="text-align: center">
                            <div style="max-width: 500px;max-height: 100px;overflow-y: auto;">
                                {{$technician->name}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                {{$technician->email}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                {{$technician->created_at}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                {{$technician->updated_at}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                technician
                            </div>
                        </td>
                        <td style="text-align: center">
                            <a href="{{route('edit_technician_index', ['emp_id'=>($technician->id)])}}">Edit</a>
                        </td>
                    </tr>
                @endforeach
                @foreach($reservation_emps as $reservation_emp)
                    <tr>
                        <td style="text-align: center">
                            <input type="type"
                                   style="max-width: 50px; max-height: 100px;overflow-y: auto; text-align: center;"
                                   name="train_id" value="{{$reservation_emp->id}}" disabled>
                        </td>

                        <td style="text-align: center">
                            <div style="max-width: 500px;max-height: 100px;overflow-y: auto;">
                                {{$reservation_emp->name}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                {{$reservation_emp->email}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                {{$reservation_emp->created_at}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                {{$reservation_emp->updated_at}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                reservation employee
                            </div>
                        </td>
                        <td style="text-align: center">
                            <a href="{{route('edit_reservation_employee_index', ['emp_id'=>($reservation_emp->id)])}}">Edit</a>
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
