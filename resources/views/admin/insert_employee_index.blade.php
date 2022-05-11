<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Choose profession</h1>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <form method="POST" action="{{route('insert_employee_index')}}">
            @csrf
            <div class="col-md-9 py-4 w-100">
                <label for="type" class="form-label">Employee's profession<span class="text-muted">(Required)</span></label>
                <select class="form-select" id="type" name="type">
                    <option value="captain">Captain</option>
                    <option value="technician">Technician</option>
                    <option value="reservation">Reservation Employee</option>
                </select>
                <span class="text-danger">@error('type') {{$message}} @enderror</span>
            </div>
            <button class="w-100 btn btn-outline-primary btn-sm" type="submit">Submit</button>
        </form>
    </div>
</main>
