<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use App\Employee;
use Hash;
use App\Ticket;
use App\Train;
use App\Line;
use App\Stops_stations;
use App\Seat;
use App\Booked_tickets;
use PDF;
use Carbon\Carbon;
use App\Trip;
use App\User;


class EmployeeController extends Controller
{
    public function employee_login_index()
    {
        return view("employee/login");
    }

    public function employee_login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|max:12|min:8'
        ]);
        $employee = Employee::where('email', '=', $request->email)->first();
        if ($employee && Hash::check($request->password, $employee->password)) {
            $request->session()->put('employeeID', $employee->id);
            return redirect("employee/dashboard");
        } else {
            return back()->with('fail', 'Email or Password is incorrect');
        }
    }

    public function employee_index()
    {
        $data = array();
        if (session()->has('employeeID')) {
            $data = Employee::where('id', '=', session()->get("employeeID"))->first();
        }
        return view("employee/dashboard", compact('data'));
    }

    public function employee_logout()
    {
        if (session()->has('employeeID')) {
            session()->pull('employeeID');
            return redirect("employee/");
        }
    }

    public function search_trips(Request $request){
        $data = Employee::query()->where('id', '=', session()->get("employeeID"))->first();
        $user_query = $request->search_query;
        if (!$user_query) {
            return view("employee/dashboard", compact('data'));
        }
        $result = Stops_stations::query()
            ->where('source_station', '=', $user_query)
            ->orWhere('destination_station', '=', $user_query)
            ->orWhere('date', 'LIKE', "%{$user_query}%")
            ->get();
        return view("employee/dashboard", compact('data', 'result'));
    }

    public function book_trips(Request $request){
        $stop_station = Stops_stations::query()->where('id', '=', $request->trip_id)->first();
        $train = Train::where('train_no', '=', $stop_station->train_no)->first();
        $seat = Seat::where('train', '=', $train->id)->where('seat_availability', '=', 'true')->first();
        $booked_ticket = new Booked_tickets();
        $booked_ticket->stops_station = $stop_station->id;
        $booked_ticket->seat = $seat->id;
        $booked_ticket->user_id = null;
        $seat->seat_availability = "false";
        $booked_ticket->save();
        $pdf = PDF::loadView('user/ticket', compact('booked_ticket', 'seat'));
        return $pdf->download('Ticket.pdf');
    }




























    ## 5ra

    public function employee_book_index()
    {
        return view("employee/book");
    }

    public function show_available_trips(Request $req)
    {
        $filter = $req->validate([
            'source' => 'string',
            'dest' => 'string',
        ]);
        if ($req->isMethod('post')) {
            $source_station = $req->get('source');
            $destination_station = $req->get('dest');
            $query = Stops_stations::where('source_station', 'like', '%' . $source_station . '%')
                ->where('destination_station', 'like', '%' . $destination_station . '%')
                ->get();
            $employee = Booked_tickets::where('employee_id', '=', session()->get("employeeID"))->first();
        }
        return view('employee/view_available_trips', compact('query', 'employee'));
    }

    public function employee_checkout(Request $request)
    {

        $stops_id = $request->stops_id;
        $stops_station = Stops_stations::where('id', '=', $stops_id)->first();
        return view('user/checkout', compact('stops_id', 'stops_station'));
        return view("employee/checkout");
    }


    public function generate_ticket_employee()
    {

        $employeeId = session()->get('employeeID');

        $data = [
            'heading' => 'Welcome to Funda of Web IT',
            'description' => 'This description of Funda of Web IT'
        ];
        $pdf = PDF::loadView('employee/ticket', $data);

        return $pdf->download('Ticket.pdf');

        return view("employee/ticket");
    }
}
