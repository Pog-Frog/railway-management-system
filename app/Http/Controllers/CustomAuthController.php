<?php

namespace App\Http\Controllers;

use App\Lines;
use App\Station;
use App\Train;
use App\Train_type;
use Illuminate\Http\Request;
use App\Admin;
use Hash;

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
        if($request->captain != "null"){
            $train->captain = $request->captain;
        }
        if($request->line != "null"){
            $train->line = $request->line;
        }
        $result = $train->save();
        if ($result) {
            return back()->with('success', 'Train Saved');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
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
        if($tmp){
            if ($tmp->id != $train->id) {
                return back()->with('fail', 'This number is already registered for another train');
            }
        }
        $train->number = $request->number;
        $train->no_of_cars = $request->no_of_cars;
        $train->type = $request->type;
        $train->status = $request->status;
        $train->line = $request->line;
        if($request->captain != "null"){
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

    public function delete_train_type(Request $request){
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

    public function edit_station_index(Request $request){
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        $station_id = $request->station_id;
        $station = Station::where('id', '=', $station_id)->first();
        return view('admin/edit_station', compact('data', 'station'));
    }

    public function edit_station(Request $request){
        $request->validate([
            'name' => 'required',
            'city' => 'required'
        ]);
        $station = Station::where('id', '=', $request->station_id)->first();
        $tmp = Station::where('name', '=', $request->name)->first();
        if($tmp){
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

    public function delete_station(Request $request){
        $data = Admin::where('id', '=', session()->get("adminID"))->first(); ############
        $station = Station::where('id', '=', $request->station_id)->first();
        $result = $station->delete();
        if ($result) {
            return redirect('admin/stations/view_stations')->with('success', 'Station Deleted');
        }
        return redirect('admin/stations/view_stations')->with('fail', 'Something went wrong');
    }

    public function search_stations(Request $request){
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        $user_query = $request->search_query;
        $result = Station::query()
            ->where('name', 'LIKE', "%{$user_query}%")
            ->orWhere('city', 'LIKE', "%{$user_query}%")
            ->get();
        return view("admin/view_stations", compact('data', 'result'));
    }

    public function view_stations(Request $request){
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        return view("admin/view_stations", compact('data'));
    }

    public function lines_index()
    {
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        return view("admin/lines_managment_index", compact('data'));
    }

    public function view_lines(Request $request){
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        return view("admin/view_lines", compact('data'));
    }

    public function insert_line(Request $request){
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

    public function edit_line_index (Request $request){
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        $line_id = $request->line_id;
        $line = Lines::where('id', '=', $line_id)->first();
        return view('admin/edit_line', compact('data', 'line'));
    }

    public function edit_line(Request $request){
        $request->validate([
            'name' => 'required',
            'stations' => 'required'
        ]);
        $line = Lines::where('id', '=', $request->line_id)->first();
        $tmp = Station::where('name', '=', $request->name)->first();
        if($tmp){
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

    public function delete_line(Request $request){
        $line = Lines::where('id', '=', $request->line_id)->first();
        $result = $line->delete();
        if ($result) {
            return redirect('admin/lines/view_lines')->with('success', 'Line Deleted');
        }
        return redirect('admin/lines/view_lines')->with('fail', 'Something went wrong');
    }

    public function search_lines(Request $request){
        $data = Admin::where('id', '=', session()->get("adminID"))->first();
        $user_query = $request->search_query;
        $result = Lines::query()
            ->where('name', 'LIKE', "%{$user_query}%")
            ->orWhere('stations', 'LIKE', "%{$user_query}%")
            ->get();
        return view("admin/view_lines", compact('data', 'result'));
    }
}
