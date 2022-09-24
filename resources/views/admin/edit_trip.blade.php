<?php
use App\Line;
use App\Captain;
use App\Employee;

$captains = Captain::all();
$lines = Line::all();
$employees = Employee::all();
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

    <script src="{{ url('/scripts/admin/popper.min.js') }}"></script>
    <script src="{{ url('/scripts/admin/solid.min.js') }}"></script>
    <script src="{{ url('/scripts/admin/fontawesome.min.js') }}"></script>
    <script src="{{ url('/scripts/admin/tempus-dominus.js') }}"></script>

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
    <link href="{{ url('styles/admin/tempus-dominus.css') }}" rel="stylesheet">

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
                            <a class="nav-link" href="{{url("admin/trips?insert_trip_index")}}">
                                <span data-feather="file-text"></span>
                                Add new trip
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route("view_trips")}}">
                                <span data-feather="file-text"></span>
                                View Trips
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
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Edit Trip</h1>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <form method="POST" action="{{route('edit_trip', ['trip_id'=>($trip->id)])}}">
            @if(Session::has('success'))
                <div class="alert-success">{{Session::get('success')}}

                </div>
            @else
                <div class="alert-danger">{{Session::get('fail')}}

                </div>
            @endif
            @csrf
            <div class="row g-3">
                <div class="col-md-8">
                    <label for="captain" class="form-label">Assign Captain<span class="text-muted">(Required)</span></label>
                    <select class="form-select" id="captain" name="captain">
                        <option value="null">--None--</option>
                        @foreach($captains as $captain)
                            @if( !is_null($trip->captains) && $trip->captains->id == $captain->id)
                                <option selected value="{{$captain->id}}">{{$captain->name}}</option>
                            @else
                                <option value="{{$captain->id}}">{{$captain->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    <span class="text-danger">@error('captain') {{$message}} @enderror</span>
                </div>

                <div class="col-sm-5">
                    <label for="line" class="form-label">Assign Line<span class="text-muted">(Required)</span></label>
                    <select class="form-select" id="line" name="line">
                        <option value="null">--None--</option>
                        @foreach($lines as $line)
                            @if(!is_null($trip->lines) && $trip->lines->id == $line->id)
                                <option selected value="{{$line->id}}">No. {{$line->id}}</option>
                            @else
                                <option value="{{$line->id}}">No. {{$line->id}}</option>
                            @endif
                        @endforeach
                    </select>
                    <span class="text-danger">@error('line') {{$message}} @enderror</span>
                </div>

                <div class="col-md-8 pb-3">
                    <label for="employee" class="form-label">Assign Employee<span class="text-muted">(Required)</span></label>
                    <select class="form-select" id="employee" name="employee">
                        <option value="null">--None--</option>
                        @foreach($employees as $employee)
                            @if(!is_null($trip->employees) && $trip->employees->id == $employee->id)
                                <option selected value="{{$employee->id}}">{{$employee->name}}</option>
                            @else
                                <option value="{{$employee->id}}">{{$employee->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    <span class="text-danger">@error('employee') {{$message}} @enderror</span>
                </div>

                <div class="row">
                    <div class="col-sm-5">
                        <label for="date" class="form-label">Choose Date and Time<span class="text-muted">(Required)</span></label>
                        <div
                            class="input-group"
                            id="datetimepicker1"
                            data-td-target-input="nearest"
                            data-td-target-toggle="nearest"
                        >
                            <input
                                name="date"
                                type="text"
                                class="form-control"
                                data-td-target="#datetimepicker1"
                                placeholder="DateTime"
                                value="{{ old('date', $trip->date) ?? date('Y/m/d h:i:s a') }}"
                            />
                            <span
                                class="input-group-text"
                                data-td-target="#datetimepicker1"
                                data-td-toggle="datetimepicker"
                            >
                                <span class="fa-solid fa-calendar"></span>
                            </span>
                        </div>
                        <span class="text-danger">@error('date') {{$message}} @enderror</span>
                    </div>
                </div>

                <button class="w-100 btn btn-outline-primary btn-lg" type="submit">Submit</button>
        </form>
        <form method="POST" action="{{route('delete_trip', ['trip_id'=>($trip->id)])}}">
            @csrf
            <div class="col text-center">
                <button class="w-25 btn btn-primary btn-danger" type="submit">Delete Trip</button>
            </div>
        </form>
    </div>
</main>
<script>
    var td_1 = new tempusDominus.TempusDominus(
        document.getElementById('datetimepicker1')
    );
</script>
</body>

<script src="{{ url('/scripts/admin/jquery.min.js') }}"></script>
<script src="{{ url('/scripts/admin/bootstrap.min.js') }}"></script>
<script src="{{ url('/scripts/admin/feather.min.js') }}"></script>
<script src="{{ url('/scripts/admin/dashboard.js') }}"></script>
</html>
