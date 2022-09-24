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
                            <a class="nav-link" href="{{url("admin/lines?insert_line")}}">
                                <span data-feather="file-text"></span>
                                Add Lines
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route("view_lines")}}">
                                <span data-feather="file-text"></span>
                                View Lines
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
    <div style="overflow-x: auto;" class="p-3 my-3 border rounded">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <a href="#collapse" data-bs-toggle="collapse"><h1 class="h5">Add new Schedule</h1></a>
        </div>
        @if(Session::has('success'))
            <div class="alert-success">{{Session::get('success')}}

            </div>
        @else
            <div class="alert-danger">{{Session::get('fail')}}

            </div>
        @endif
        <div id="collapse" class="collapse">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <form method="POST" action="{{route('add_train_schedule',  ['line_id'=>($line_id), 'train_id'=>($train->id)])}}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label for="source_station" class="form-label">Assign source station<span
                                    class="text-muted">(Required)</span></label>
                            <select class="form-select" id="source_station" name="source_station">
                                <option value="null">--None--</option>
                                @foreach($stations as $station)
                                    <option value="{{$station->name}}">{{$station->name}} - {{$station->city}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('source_station') {{$message}} @enderror</span>
                        </div>

                        <div class="col-md-8 pb-3">
                            <label for="destination_station" class="form-label">Assign destination station<span
                                    class="text-muted">(Required)</span></label>
                            <select class="form-select" id="destination_station" name="destination_station">
                                <option value="null">--None--</option>
                                @foreach($stations as $station)
                                    <option value="{{$station->name}}">{{$station->name}} - {{$station->city}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('destination_station') {{$message}} @enderror</span>
                        </div>

                        <div class="row pb-3">
                            <div class="col-sm-5">
                                <label for="scheduled_arrival_time" class="form-label">Choose arrival time<span class="text-muted">(Required)</span></label>
                                <div
                                    class="input-group"
                                    id="datetimepicker2"
                                    data-td-target-input="nearest"
                                    data-td-target-toggle="nearest"
                                >
                                    <input
                                        name="scheduled_arrival_time"
                                        type="text"
                                        class="form-control"
                                        data-td-target="#datetimepicker2"
                                    />
                                    <span
                                        class="input-group-text"
                                        data-td-target="#datetimepicker2"
                                        data-td-toggle="datetimepicker"
                                    >
                                <span class="fa-solid fa-clock"></span>
                            </span>
                                </div>
                                <span class="text-danger">@error('scheduled_arrival_time') {{$message}} @enderror</span>
                            </div>
                        </div>
                        <div class="row pb-3">
                            <div class="col-sm-5">
                                <label for="scheduled_departure_time" class="form-label">Choose departure time<span class="text-muted">(Required)</span></label>
                                <div
                                    class="input-group"
                                    id="datetimepicker1"
                                    data-td-target-input="nearest"
                                    data-td-target-toggle="nearest"
                                >
                                    <input
                                        name="scheduled_departure_time"
                                        type="text"
                                        class="form-control"
                                        data-td-target="#datetimepicker1"
                                    />
                                    <span
                                        class="input-group-text"
                                        data-td-target="#datetimepicker1"
                                        data-td-toggle="datetimepicker"
                                    >
                                <span class="fa-solid fa-clock"></span>
                            </span>
                                </div>
                                <span class="text-danger">@error('scheduled_departure_time') {{$message}} @enderror</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <label for="date" class="form-label">Choose date<span class="text-muted">(Required)</span></label>
                                <div
                                    class="input-group"
                                    id="datetimepicker3"
                                    data-td-target-input="nearest"
                                    data-td-target-toggle="nearest"
                                >
                                    <input
                                        name="date"
                                        type="text"
                                        class="form-control"
                                        data-td-target="#datetimepicker3"
                                    />
                                    <span
                                        class="input-group-text"
                                        data-td-target="#datetimepicker3"
                                        data-td-toggle="datetimepicker"
                                    >
                                <span class="fa-solid fa-calendar"></span>
                            </span>
                                </div>
                                <span class="text-danger">@error('date') {{$message}} @enderror</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="price" class="form-label">Price<span
                                    class="text-muted">(Required)</span></label>
                            <input type="text" class="form-control" id="price" placeholder="" name="price">
                            <span class="text-danger">@error('price') {{$message}} @enderror</span>
                        </div>
                        <button class="w-100 btn btn-outline-primary btn-lg" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div style="overflow-x: auto;" class="p-3 my-3 border rounded">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h5">Schedules for train {{$train->train_no}}</h1>
        </div>
        <table id="task-table" class="table table-r">
            <thead>
            <tr>
                <th scope="col" style="text-align: center">ID</th>
                <th scope="col" style="text-align: center">source station</th>
                <th scope="col" style="text-align: center">destination station</th>
                <th scope="col" style="text-align: center">scheduled arrival time</th>
                <th scope="col" style="text-align: center">scheduled departure time</th>
                <th scope="col" style="text-align: center">date</th>
                <th scope="col" style="text-align: center">price</th>
                <th scope="col" style="text-align: center">edit</th>
            </tr>
            </thead>

            <tbody>

            <tbody>
            @foreach($query as $record)
                <tr>
                    <td style="text-align: center">
                        <div style="max-width: 500px;max-height: 100px;overflow-y: auto;">
                            <input type="type"
                                   style="max-width: 50px; max-height: 100px;overflow-y: auto; text-align: center;"
                                   name="train_id" value="{{$record->id}}" disabled>
                        </div>
                    </td>
                    <td style="text-align: center">
                        <div style="max-width: 500px;max-height: 100px;overflow-y: auto;">
                            @if(!is_null($record->source_station))
                                {{$record->source_station}}
                            @else
                                {{"not assigned"}}
                            @endif
                        </div>
                    </td>
                    <td style="text-align: center">
                        <div style="max-width: 500px;max-height: 100px;overflow-y: auto;">
                            @if(!is_null($record->destination_station))
                                {{$record->destination_station}}
                            @else
                                {{"not assigned"}}
                            @endif
                        </div>
                    </td>
                    <td style="text-align: center">
                        <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                            {{date('h:i:s A', strtotime($record->scheduled_arrival_time))}}
                        </div>
                    </td>
                    <td style="text-align: center">
                        <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                            {{date('h:i:s A', strtotime($record->scheduled_departure_time))}}
                        </div>
                    </td>
                    <td style="text-align: center">
                        <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                            {{$record->date}}
                        </div>
                    </td>
                    <td style="text-align: center">
                        <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                            {{$record->price}}
                        </div>
                    </td>
                    <td style="text-align: center">
                        <a href="{{route('edit_train_schedule_index',  ['line_id'=>($line_id), 'train_id'=>($train->id),'record_id'=>($record->id)])}}">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</main>
<script>
    var td_1 = new tempusDominus.TempusDominus(
        document.getElementById('datetimepicker1'),
        {
            display: {
                viewMode: 'clock',
                components: {
                    decades: false,
                    year: false,
                    month: false,
                    date: false,
                    hours: true,
                    minutes: true,
                    seconds: false
                }
            }
        }
    );
    var td_2 = new tempusDominus.TempusDominus(
        document.getElementById('datetimepicker2'),
        {
            display: {
                viewMode: 'clock',
                components: {
                    decades: false,
                    year: false,
                    month: false,
                    date: false,
                    hours: true,
                    minutes: true,
                    seconds: false
                }
            }
        }
    );
    var td_3 = new tempusDominus.TempusDominus(
        document.getElementById('datetimepicker3'),
        {
            display: {
                components: {
                    decades: false,
                    year: true,
                    month: true,
                    date: true,
                    hours: false,
                    minutes: false,
                    seconds: false
                }
            }
        }
    );
</script>
</body>

<script src="{{ url('/scripts/admin/jquery.min.js') }}"></script>
<script src="{{ url('/scripts/admin/bootstrap.min.js') }}"></script>
<script src="{{ url('/scripts/admin/feather.min.js') }}"></script>
<script src="{{ url('/scripts/admin/dashboard.js') }}"></script>
</html>
