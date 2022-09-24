<?php

use App\Station;

$stations = Station::all();
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Insert Line</h1>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <form method="POST" action="{{route('insert_line')}}">
            @if(Session::has('success'))
                <div class="alert-success">{{Session::get('success')}}

                </div>
            @else
                <div class="alert-danger">{{Session::get('fail')}}

                </div>
            @endif
            @csrf
            <div class="row g-3">
                <div class="col-md-7">
                    <label for="source_station" class="form-label">Choose Source station<span class="text-muted">(Required)</span></label>
                    <select class="form-select" id="source_station" name="source_station">
                        <option value="null">--None--</option>
                        @foreach($stations as $station)
                            <option value="{{$station->name}}">{{$station->name}} - {{$station->city}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">@error('source_station') {{$message}} @enderror</span>
                </div>

                <div class="col-md-7">
                    <label for="destination_station" class="form-label">Choose Destination station<span class="text-muted">(Required)</span></label>
                    <select class="form-select" id="destination_station" name="destination_station">
                        <option value="null">--None--</option>
                        @foreach($stations as $station)
                            <option value="{{$station->name}}">{{$station->name}} - {{$station->city}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">@error('destination_station') {{$message}} @enderror</span>
                </div>

                <button class="w-100 btn btn-outline-primary btn-lg" type="submit">Submit</button>
        </form>
    </div>
</main>
