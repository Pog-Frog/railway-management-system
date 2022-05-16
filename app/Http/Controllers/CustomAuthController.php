<?php

namespace App\Http\Controllers;

use App\Captain;
use App\Lines;
use App\Mail\AdminEmail;
use App\Reservation_emp;
use App\Station;
use App\Technician;
use App\Train;
use App\Train_type;
use App\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Admin;
use Hash;
use Illuminate\Support\Str;

class CustomAuthController extends Controller
{
    public function admin_login_index()
    {
        return view("admin/login");
    }

    public function admin_login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|max:12|min:8'
        ]);
        $user = Admin::where('email', '=', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $request->session()->put('adminID', $user->id);
            return redirect('admin/dashboard');
        } else {
            return back()->with('fail', 'Email or Password is incorrect');
        }
    }

    public function admin_register_index()
    {
        return view("admin/register");
    }

    public function admin_register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|max:12|min:8'
        ]);
        $user = new Admin();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $result = $user->save();
        if ($result) {
            return back()->with('success', 'Admin Registered');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    public function admin_index()
    {
        $data = array();
        if (session()->has('adminID')) {
            $data = Admin::where('id', '=', session()->get("adminID"))->first();
        }
        return view('admin/dashboard', compact('data'));
    }

    public function admin_logout()
    {
        if (session()->has('adminID')) {
            session()->pull('adminID');
            return redirect('admin/');
        }
    }

    public function employees_index()
    {
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        return view("admin/employees_management_index", compact('data'));
    }

    public function trains_index()
    {
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        return view("admin/trains_management_index", compact('data'));
    }

    public function insert_train(Request $request)
    {
        $request->validate([
            'number' => 'required|unique:trains',
            'type' => 'required',
            'no_of_cars' => 'required',
            'line' => 'required',
            'captain' => 'required',
            'status' => 'required'
        ]);
        $train = new Train();
        $train->number = $request->number;
        $train->no_of_cars = $request->no_of_cars;
        $train->status = $request->status;
        $train->type = $request->type;
        if ($request->captain != "null") {
            $train->captain = $request->captain;
        }
        if ($request->line != "null") {
            $train->line = $request->line;
        }
        $result = $train->save();
        if ($result) {
            return back()->with('success', 'Train Saved');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    public function view_trains(Request $request)
    {
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        return view("admin/view_trains", compact('data'));
    }

    public function search_trains(Request $request)
    {
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        $user_query = $request->search_query;
        $result = Train::query()
            ->where('number', 'LIKE', "%{$user_query}%")
            ->orWhere('id', 'LIKE', "%{$user_query}%")
            ->orWhere('status', 'LIKE', "%{$user_query}%")
            ->orWhere('no_of_cars', 'LIKE', "%{$user_query}%")
            ->get();
        if ($result->isEmpty()) {
            $line = Lines::where('name', '=', $user_query)->first();
            if ($line) {
                $result = Train::query()
                    ->where('line', 'LIKE', "%{$line->id}%")
                    ->get();
            } else {
                $captain = Captain::where('name', '=', $user_query)->first();
                if ($captain) {
                    $result = Train::query()
                        ->where('captain', 'LIKE', "%{$captain->id}%")
                        ->get();
                } else {
                    $type = Train_type::where('name', '=', $user_query)->first();
                    if ($type) {
                        $result = Train::query()
                            ->where('type', 'LIKE', "%{$type->id}%")
                            ->get();
                    }
                }

            }
        }
        return view("admin/view_trains", compact('data', 'result'));
    }

    public function insert_train_type(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:train_types',
        ]);
        $train_type = new Train_type();
        $train_type->name = $request->name;
        $result = $train_type->save();
        if ($result) {
            return back()->with('success', 'Train Type Saved');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    public function edit_train_index(Request $request)
    {
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        $train_id = $request->train_id;
        $train = Train::where('id', '=', $train_id)->first();
        return view('admin/edit_train', compact('data', 'train'));
    }

    public function edit_train(Request $request)
    {
        $request->validate([
            'number' => 'required|min:3',
            'type' => 'required',
            'no_of_cars' => 'required',
            'line' => 'required',
            'captain' => 'required',
            'status' => 'required'
        ]);
        $train = Train::where('id', '=', $request->train_id)->first();
        $tmp = Train::where('number', '=', $request->number)->first();
        if ($tmp) {
            if ($tmp->id != $train->id) {
                return back()->with('fail', 'This number is already registered for another train');
            }
        }
        $train->number = $request->number;
        $train->no_of_cars = $request->no_of_cars;
        $train->type = $request->type;
        $train->status = $request->status;
        $train->line = $request->line;
        if ($request->captain != "null") {
            $train->captain = $request->captain;
        }
        $result = $train->save();
        if ($result) {
            return back()->with('success', 'Train Updated');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    public function delete_train(Request $request)
    {
        $train = Train::where('id', '=', $request->train_id)->first();
        $result = $train->delete();
        if ($result) {
            return redirect('admin/trains?view_all_trains')->with('success', 'Train Deleted');
        } else {
            return redirect('admin/trains?view_all_trains')->with('fail', 'Something went wrong');
        }
    }

    public function edit_train_type_index(Request $request)
    {
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        $train_type_id = $request->train_type_id;
        $train_type = Train_type::where('id', '=', $train_type_id)->first();
        return view('admin/edit_train_type', compact('data', 'train_type'));
    }

    public function edit_train_type(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $train_type = Train_type::where('id', '=', $request->train_type_id)->first();
        $tmp = Train_type::where('name', '=', $request->name)->first();
        if ($tmp) {
            if ($tmp->id != $train_type->id) {
                return back()->with('fail', 'This name is already registered for another train type');
            }
        }
        $train_type->name = $request->name;
        $result = $train_type->save();
        if ($result) {
            return back()->with('success', 'Train type Updated');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    public function delete_train_type(Request $request)
    {
        $train_type = Train_type::where('id', '=', $request->type_id)->first();
        $result = $train_type->delete();
        if ($result) {
            return redirect('admin/trains?view_train_types')->with('success', 'Train type Deleted');
        }
        return redirect('admin/trains?view_train_types')->with('fail', 'Something went wrong');
    }

    public function stations_index()
    {
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        return view("admin/stations_managment_index", compact('data'));
    }

    public function insert_station(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:stations',
            'city' => 'required'
        ]);
        $station = new Station();
        $station->name = $request->name;
        $station->city = $request->city;
        $result = $station->save();
        if ($result) {
            return back()->with('success', 'Station Saved');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    public function edit_station_index(Request $request)
    {
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        $station_id = $request->station_id;
        $station = Station::where('id', '=', $station_id)->first();
        return view('admin/edit_station', compact('data', 'station'));
    }

    public function edit_station(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'city' => 'required'
        ]);
        $station = Station::where('id', '=', $request->station_id)->first();
        $tmp = Station::where('name', '=', $request->name)->first();
        if ($tmp) {
            if ($tmp->id != $station->id) {
                return back()->with('fail', 'This number is already registered for another station');
            }
        }
        $station->name = $request->name;
        $station->city = $request->city;
        $result = $station->save();
        if ($result) {
            return back()->with('success', 'Station Updated');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    public function delete_station(Request $request)
    {
        $data = Admin::where('id', '=', session()->get("adminID"))->first(); ############
        $station = Station::where('id', '=', $request->station_id)->first();
        $result = $station->delete();
        if ($result) {
            return redirect('admin/stations/view_stations')->with('success', 'Station Deleted');
        }
        return redirect('admin/stations/view_stations')->with('fail', 'Something went wrong');
    }

    public function search_stations(Request $request)
    {
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        $user_query = $request->search_query;
        $result = Station::query()
            ->where('name', 'LIKE', "%{$user_query}%")
            ->orWhere('city', 'LIKE', "%{$user_query}%")
            ->get();
        return view("admin/view_stations", compact('data', 'result'));
    }

    public function view_stations(Request $request)
    {
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        return view("admin/view_stations", compact('data'));
    }

    public function lines_index()
    {
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        return view("admin/lines_managment_index", compact('data'));
    }

    public function view_lines(Request $request)
    {
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        return view("admin/view_lines", compact('data'));
    }

    public function insert_line(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:lines',
            'stations' => 'required'
        ]);
        $line = new Lines();
        $line->name = $request->name;
        $line->stations = $request->stations;
        $result = $line->save();
        if ($result) {
            return back()->with('success', 'Line Saved');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    public function edit_line_index(Request $request)
    {
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        $line_id = $request->line_id;
        $line = Lines::where('id', '=', $line_id)->first();
        return view('admin/edit_line', compact('data', 'line'));
    }

    public function edit_line(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'stations' => 'required'
        ]);
        $line = Lines::where('id', '=', $request->line_id)->first();
        $tmp = Station::where('name', '=', $request->name)->first();
        if ($tmp) {
            if ($tmp->id != $line->id) {
                return back()->with('fail', 'This name is already registered for another line');
            }
        }
        $line->name = $request->name;
        $line->stations = $request->stations;
        $result = $line->save();
        if ($result) {
            return back()->with('success', 'Line Updated');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    public function delete_line(Request $request)
    {
        $line = Lines::where('id', '=', $request->line_id)->first();
        $result = $line->delete();
        if ($result) {
            return redirect('admin/lines/view_lines')->with('success', 'Line Deleted');
        }
        return redirect('admin/lines/view_lines')->with('fail', 'Something went wrong');
    }

    public function search_lines(Request $request)
    {
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        $user_query = $request->search_query;
        $result = Lines::query()
            ->where('name', 'LIKE', "%{$user_query}%")
            ->orWhere('stations', 'LIKE', "%{$user_query}%")
            ->get();
        return view("admin/view_lines", compact('data', 'result'));
    }

    public function insert_employee_index(Request $request)
    {
        $choice = $request->type;
        if ($choice == "captain") {
            return redirect('admin/employees?insert_captain_index');
        } elseif ($choice == "technician") {
            return redirect('admin/employees?insert_technician_index');
        } else {
            return redirect('admin/employees?insert_reservation_employee_index');
        }
    }

    public function insert_captain(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:captains'
        ]);
        $captain = new Captain();
        $captain->name = $request->name;
        $captain->email = $request->email;
        $rand_pass = Str::random(12);
        $captain->password = Hash::make($rand_pass);
        $result = $captain->save();
        $details = ['title' => 'Admin notification @railway MS', 'name' => $captain->name, 'body' => 'This email contains your password for your work account', 'content' => $rand_pass];
        $subject = "Password Notification";
        \Mail::to($captain->email)->send(new AdminEmail($details, $subject));
        if ($result) {
            return back()->with('success', 'Employee registered and an email has been sent with the user password')->with('profession', $request->profession);
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    public function insert_technician(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:technicians'
        ]);
        $technician = new Technician();
        $technician->name = $request->name;
        $technician->email = $request->email;
        $rand_pass = Str::random(12);
        $technician->password = Hash::make($rand_pass);
        $result = $technician->save();
        $details = ['title' => 'Admin notification @railway MS', 'name' => $technician->name, 'body' => 'This email contains your password for your work account', 'content' => $rand_pass];
        $subject = "Password Notification";
        \Mail::to($technician->email)->send(new AdminEmail($details, $subject));
        if ($result) {
            return back()->with('success', 'Employee registered and an email has been sent with the user password')->with('profession', $request->profession);
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    public function insert_reservation_employee(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:reservation_emps'
        ]);
        $emp = new Reservation_emp();
        $emp->name = $request->name;
        $emp->email = $request->email;
        $rand_pass = Str::random(12);
        $emp->password = Hash::make($rand_pass);
        $result = $emp->save();
        $details = ['title' => 'Admin notification @railway MS', 'name' => $emp->name, 'body' => 'This email contains your password for your work account', 'content' => $rand_pass];
        $subject = "Password Notification";
        \Mail::to($emp->email)->send(new AdminEmail($details, $subject));
        if ($result) {
            return back()->with('success', 'Employee registered and an email has been sent with the user password')->with('profession', $request->profession);
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    public function view_employees()
    {
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        return view("admin/view_employees", compact('data'));
    }

    public function search_employees(Request $request)
    {
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        if ($request->profession == "captain") {
            $user_query = $request->search_query;
            $result = Captain::query()
                ->where('name', 'LIKE', "%{$user_query}%")
                ->orWhere('email', 'LIKE', "%{$user_query}%")
                ->get();
            $index = 1;
        } elseif ($request->profession == "technician") {
            $user_query = $request->search_query;
            $result = Technician::query()
                ->where('name', 'LIKE', "%{$user_query}%")
                ->orWhere('email', 'LIKE', "%{$user_query}%")
                ->get();
            $index = 2;
        } else {
            $user_query = $request->search_query;
            $result = Reservation_emp::query()
                ->where('name', 'LIKE', "%{$user_query}%")
                ->orWhere('email', 'LIKE', "%{$user_query}%")
                ->get();
            $index = 3;
        }
        return view("admin/view_employees", compact('data', 'result', 'index'));
    }

    public function edit_captain_index(Request $request)
    {
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        $emp = Captain::where('id', '=', $request->emp_id)->first();
        $profession = "captain";
        return view('admin/edit_employee', compact('data', 'profession', 'emp'));

    }

    public function edit_technician_index(Request $request)
    {
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        $emp = Technician::where('id', '=', $request->emp_id)->first();
        $profession = "technician";
        return view('admin/edit_employee', compact('data', 'profession', 'emp'));
    }

    public function edit_reservation_employee_index(Request $request)
    {
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        $emp = Reservation_emp::where('id', '=', $request->emp_id)->first();
        $profession = "reservation";
        return view('admin/edit_employee', compact('data', 'profession', 'emp'));
    }

    public function edit_employee(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        if ($request->profession == "captain") {
            $captain = Captain::where('id', '=', $request->emp_id)->first();
            $tmp = Captain::where('name', '=', $request->name)->first();
            if ($tmp) {
                if ($tmp->id != $captain->id) {
                    return back()->with('fail', 'This name is already registered for another employee');
                }
            }
            $captain->name = $request->name;
            $captain->email = $request->email;
            $result = $captain->save();
            if ($result) {
                return back()->with('success', 'Employee Updated');
            } else {
                return back()->with('fail', 'Something went wrong');
            }
        } elseif ($request->profession == "technician") {
            $technician = Technician::where('id', '=', $request->emp_id)->first();
            $tmp = Technician::where('name', '=', $request->name)->first();
            if ($tmp) {
                if ($tmp->id != $technician->id) {
                    return back()->with('fail', 'This name is already registered for another employee');
                }
            }
            $technician->name = $request->name;
            $technician->email = $request->email;
            $result = $technician->save();
            if ($result) {
                return back()->with('success', 'Employee Updated');
            } else {
                return back()->with('fail', 'Something went wrong');
            }
        } else {
            $reservation_emp = Reservation_emp::where('id', '=', $request->emp_id)->first();
            $tmp = Reservation_emp::where('name', '=', $request->name)->first();
            if ($tmp) {
                if ($tmp->id != $reservation_emp->id) {
                    return back()->with('fail', 'This name is already registered for another employee');
                }
            }
            $reservation_emp->name = $request->name;
            $reservation_emp->email = $request->email;
            $result = $reservation_emp->save();
            if ($result) {
                return back()->with('success', 'Employee Updated');
            } else {
                return back()->with('fail', 'Something went wrong');
            }
        }
    }

    public function send_emp_password(Request $request)
    {
        $rand_pass = Str::random(12);
        $subject = "Password Notification";
        if ($request->profession == "captain") {
            $captain = Captain::where('id', '=', $request->emp_id)->first();
            $captain->password = Hash::make($rand_pass);
            $result = $captain->save();
            $details = ['title' => 'Admin notification @railway MS', 'name' => $captain->name, 'body' => 'This email contains your newly generated password for your work account', 'content' => $rand_pass];
            \Mail::to($captain->email)->send(new AdminEmail($details, $subject));
        } elseif ($request->profession == "technician") {
            $technician = Technician::where('id', '=', $request->emp_id)->first();
            $technician->password = Hash::make($rand_pass);
            $result = $technician->save();
            $details = ['title' => 'Admin notification @railway MS', 'name' => $technician->name, 'body' => 'This email contains your newly generated password for your work account', 'content' => $rand_pass];
            \Mail::to($technician->email)->send(new AdminEmail($details, $subject));
        } else {
            $reservation_emp = Reservation_emp::where('id', '=', $request->emp_id)->first();
            $reservation_emp->password = Hash::make($rand_pass);
            $result = $reservation_emp->save();
            $details = ['title' => 'Admin notification @railway MS', 'name' => $reservation_emp->name, 'body' => 'This email contains your newly generated password for your work account', 'content' => $rand_pass];
            \Mail::to($reservation_emp->email)->send(new AdminEmail($details, $subject));
        }
        if ($result) {
            return back()->with('success', 'An email has been sent with the user password');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    public function delete_employee(Request $request)
    {
        if ($request->profession == "captain") {
            $captain = Captain::where('id', '=', $request->emp_id)->first();
            $result = $captain->delete();
        } elseif ($request->profession == "technician") {
            $technician = Technician::where('id', '=', $request->emp_id)->first();
            $result = $technician->delete();
        } else {
            $reservation_emp = Reservation_emp::where('id', '=', $request->emp_id)->first();
            $result = $reservation_emp->delete();
        }
        if ($result) {
            return redirect('admin/employees/view_employees')->with('success', 'Employee Deleted');
        }
        return redirect('admin/employees/view_employees')->with('fail', 'Something went wrong');
    }

    public function trips_index(Request $request)
    {
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        return view("admin/trips_management_index", compact('data'));
    }

    public function insert_trip(Request $request)
    {
        $arrival = " ";
        $departure = " ";
        if ($request->departure_date && $request->arrival_date) {
            $departure = str_replace(",", "", $request->departure_date);
            $arrival = str_replace(",", "", $request->arrival_date);
        }
        $now = Carbon::now()->timezone('Africa/Cairo');
        $request->validate([
            'name' => 'required|unique:trips',
            'train' => 'required|exists:trains,id',
            'captain' => 'required|exists:captains,id',
            'departure_date' => 'required|before:' . $arrival,
            'departure_date' => 'after:' . $now,
            'arrival_date' => 'required|after:' . $departure
        ]);
        $trip = new Trip();
        $trip->name = $request->name;
        $trip->train = $request->train;
        $trip->captain = $request->captain;
        $trip->departure_time = Carbon::parse($request->departure_date)->format('Y-m-d H:i:s');
        $trip->arrival_time = Carbon::parse($request->arrival_date)->format('Y-m-d H:i:s');
        $result = $trip->save();
        if ($result) {
            return back()->with('success', 'Trip Saved');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }
}

