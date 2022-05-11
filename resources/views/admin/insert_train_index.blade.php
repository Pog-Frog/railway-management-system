<?php
    use Illuminate\Support\Facades\DB;
    $train_types = DB::table('train_types')->get();
    $lines = DB::table('lines')->get();
    $captains = DB::table('captains')->get();
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Insert Train</h1>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <form method="POST" action="{{route('insert_train')}}">
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
                    <label for="number" class="form-label">Train number<span class="text-muted">(Required)</span></label>
                    <input type="text" class="form-control" id="number" placeholder="" name="number">
                    <span class="text-danger">@error('number') {{$message}} @enderror</span>
                </div>


                <div class="col-md-7">
                    <label for="type" class="form-label">Type<span class="text-muted">(Required)</span></label>
                    <select class="form-select" id="type" name="type">
                        @foreach($train_types as $tain_type)
                            <option value="{{$tain_type->id}}">{{$tain_type->name}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">@error('type') {{$message}} @enderror</span>
                </div>

                <div class="col-md-8">
                    <label for="line" class="form-label">Line<span class="text-muted">(Required)</span></label>
                    <select class="form-select" id="type" name="line">
                        <option value="null">--None--</option>
                        @foreach($lines as $line)
                            <option value="{{$line->id}}">{{$line->name}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">@error('line') {{$message}} @enderror</span>
                </div>

                <div class="col-9">
                    <label for="no_of_cars" class="form-label">Number of cars<span class="text-muted">(Required)</span></label>
                    <input type="type" class="form-control" id="no_of_cars" placeholder="" name="no_of_cars">
                    <span class="text-danger">@error('no_of_cars') {{$message}} @enderror</span>
                </div>

                <div class="col-md-8">
                    <label for="captain" class="form-label">Assign captain<span class="text-muted">(Required)</span></label>
                    <select class="form-select" id="captain" name="captain">
                        <option value="null">--None--</option>
                        @foreach($captains as $captain)
                            <option value="{{$captain->id}}">{{$captain->name}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">@error('captain') {{$message}} @enderror</span>
                </div>

                <div style="margin-top: 15px;" class="row ">
                    <label style="margin-left: -10px;" class="form-label">Trian status</label>
                    <div class="form-check col-auto">
                        <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" checked value="true">
                        <label class="form-check-label" for="flexRadioDefault1">
                            true
                        </label>
                    </div>
                    <div class="form-check col-auto">
                        <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="false">
                        <label class="form-check-label" for="flexRadioDefault2">
                            false
                        </label>
                    </div>
                </div>

            <button class="w-100 btn btn-outline-primary btn-lg" type="submit">Submit</button>
        </form>
    </div>
</main>
