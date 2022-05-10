<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Insert
            @if(Session::get('profession') == 'captain')
                Captain
            @elseif(Session::get('profession') == 'technician')
                Technician
            @else
                Reservation Employee
            @endif
        </h1>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        @if(Session::get('profession') == 'captain')
            <form method="POST" action="{{route('insert_captain', ['profession' => (Session::get('profession'))])}}">
        @elseif(Session::get('profession') == 'technician')
            <form method="POST" action="{{route('insert_technician', ['profession' => (Session::get('profession'))])}}">
        @else
            <form method="POST" action="{{route('insert_reservation_employee', ['profession' => (Session::get('profession'))])}}">
        @endif
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
                    <label for="name" class="form-label">Name<span class="text-muted">(Required)</span></label>
                    <input type="text" class="form-control" id="name" placeholder="" name="name">
                    <span class="text-danger">@error('name') {{$message}} @enderror</span>
                </div>

                <div class="col-md-7">
                    <label for="email" class="form-label">Email<span class="text-muted">(Required)</span></label>
                    <input type="text" class="form-control" id="email" placeholder="" name="email">
                    <span class="text-danger">@error('email') {{$message}} @enderror</span>
                </div>

                <button class="w-100 btn btn-primary btn-lg" type="submit">Submit</button>
        </form>
    </div>
</main>
