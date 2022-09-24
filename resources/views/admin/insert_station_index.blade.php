<?php

use Illuminate\Support\Facades\DB;

$admins = DB::table('admins')->get()
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Insert Station</h1>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <form method="POST" action="{{route('insert_station')}}">
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
                    <label for="name" class="form-label">Station name<span class="text-muted">(Required)</span></label>
                    <input type="text" class="form-control" id="name" name="name">
                    <span class="text-danger">@error('name') {{$message}} @enderror</span>
                </div>

                <div class="col-8">
                    <label for="city" class="form-label">Station city<span class="text-muted">(Required)</span></label>
                    <input type="text" class="form-control" id="city" placeholder="" name="city">
                    <span class="text-danger">@error('city') {{$message}} @enderror</span>
                </div>

                <div class="col-md-7">
                    <label for="admin" class="form-label">Assign admin<span class="text-muted">(Required)</span></label>
                    <select class="form-select" id="admin" name="admin">
                        <option value="null">--None--</option>
                        @foreach($admins as $admin)
                            <option value="{{$admin->id}}">{{$admin->name}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">@error('admin') {{$message}} @enderror</span>
                </div>

                <button class="w-100 btn btn-outline-primary btn-lg" type="submit">Submit</button>
        </form>
    </div>
</main>
