<?php
use App\Line;
use App\Captain;
use App\Employee;

$captains = Captain::all();
$lines = Line::all();
$employees = Employee::all();
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Insert new Trip</h1>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <form method="POST" action="{{route('insert_trip')}}">
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
                            <option value="{{$captain->id}}">{{$captain->name}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">@error('captain') {{$message}} @enderror</span>
                </div>

                <div class="col-sm-5">
                    <label for="line" class="form-label">Assign Line<span class="text-muted">(Required)</span></label>
                    <select class="form-select" id="line" name="line">
                        <option value="null">--None--</option>
                        @foreach($lines as $line)
                            <option value="{{$line->id}}">No. {{$line->id}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">@error('line') {{$message}} @enderror</span>
                </div>

                <div class="col-md-8 pb-3">
                    <label for="employee" class="form-label">Assign Employee<span class="text-muted">(Required)</span></label>
                    <select class="form-select" id="employee" name="employee">
                        <option value="null">--None--</option>
                        @foreach($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->name}}</option>
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
    </div>
</main>
<script>
    var td_1 = new tempusDominus.TempusDominus(
        document.getElementById('datetimepicker1')
    );
</script>
