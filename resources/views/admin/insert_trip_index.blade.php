<?php
    use App\Train;
    use App\Captain;
    $trains = Train::all();
    $captains = Captain::all();
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

                <div class="col-sm-6">
                    <label for="name" class="form-label">Trip name<span class="text-muted">(Required)</span></label>
                    <input type="text" class="form-control" id="name" name="name">
                    <span class="text-danger">@error('name') {{$message}} @enderror</span>
                </div>

                <div class="col-sm-7">
                    <label for="train" class="form-label">Train<span class="text-muted">(Required)</span></label>
                    <select class="form-select" id="train" name="train">
                        @foreach($trains as $train)
                            <option value="{{$train->id}}">{{$train->number}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">@error('$train') {{$message}} @enderror</span>
                </div>

                <div class="col-sm-7 pb-3">
                    <label for="captain" class="form-label">Captain<span class="text-muted">(Required)</span></label>
                    <select class="form-select" id="captain" name="captain">
                        @foreach($captains as $captain)
                            <option value="{{$captain->id}}">{{$captain->name}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">@error('captain') {{$message}} @enderror</span>
                </div>

                <div class="row">
                    <div class="col-sm-5">
                        <label for="departure_date" class="form-label">Departure date<span class="text-muted">(Required)</span></label>
                        <div
                            class="input-group"
                            id="datetimepicker2"
                            data-td-target-input="nearest"
                            data-td-target-toggle="nearest"
                        >
                            <input
                                name="departure_date"
                                type="text"
                                class="form-control"
                                data-td-target="#datetimepicker2"
                            />
                            <span
                                class="input-group-text"
                                data-td-target="#datetimepicker2"
                                data-td-toggle="datetimepicker"
                            >
                                <span class="fa-solid fa-calendar"></span>
                            </span>
                        </div>
                        <span class="text-danger">@error('departure_date') {{$message}} @enderror</span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-5">
                        <label for="arrival_date" class="form-label">Arrival date<span class="text-muted">(Required)</span></label>
                        <div
                            class="input-group"
                            id="datetimepicker1"
                            data-td-target-input="nearest"
                            data-td-target-toggle="nearest"
                        >
                            <input
                                name="arrival_date"
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
                        <span class="text-danger">@error('arrival_date') {{$message}} @enderror</span>
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
    var td_2 = new tempusDominus.TempusDominus(
        document.getElementById('datetimepicker2')
    );
</script>
