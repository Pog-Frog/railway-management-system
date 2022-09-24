<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Trip;
use Illuminate\Http\Request;
use App\User;
use App\Ticket;
use App\Train;
use App\Line;
use App\Stops_stations;
use App\Seat;
use App\Booked_tickets;
use Illuminate\Support\Facades\Hash;
use PDF;


class UserController extends Controller
{

    public function user_login_index()
    {
        return view("user/login");
    }

    public function user_login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|max:12|min:8'
        ]);
        $user = User::where('email', '=', $request->email)->first();
        if($user && Hash::check($request->password, $user->password)){

            // Return ID To React Native App
            if ($request->has('api')){
                return response()->json([
                    'message' => "{$user->id} "
                ]);
            }
            $request->session()->put('loginID', $user->id);
            return redirect("/");


        }else{
            
            // Return Failed Message To React Native App
            if ($request->has('api')){
                return response()->json([
                    'message' => '-1'
                ]);
            }

            return back()->with('fail', 'Email or Password is incorrect');
        }
    }

    public function user_register_index()
    {
        return view("user/register");
    }

    public function user_register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|max:11|min:11',
            'gender' => 'required',
            'password' => 'required|max:12|min:8'
        ]);

        $existing_user = User::where('email', '=', $request->email)->where('phone','=',$request->phone)->first();
        if($existing_user){
            if ($request->has('api')){
                return response()->json([
                    'message' => '-1'
                ]);
            }
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gendre = $request->gendre;
        $user->password = Hash::make($request->password);
        $result = $user->save();
        if($result){

            // Return Registriation Sucess to user
            if ($request->has('api')){
                return response()->json([
                    'message' => '1'
                ]);
            }

            return back()->with('success','User Registered');
        }
        else{
     
            if ($request->has('api')){
                return response()->json([
                    'message' => ' 0'
                ]);
            }

            return back()->with('fail', 'Something went wrong');
        }
    }

    public function user_index()
    {
        $data = array();
        if (session()->has('loginID')) {
            $data = User::where('id', '=', session()->get("loginID"))->first();
        }
        return view("user/home");
    }


    public function user_logout()
    {
        if (session()->has('loginID')) {
            session()->pull('loginID');
            return redirect("/");
        }
    }

    public function user_book_index()
    {
        return view("user/book");
    }

    public function user_cancel_trip($book_id,Request $req)
    {


        if ($req->has('api')){
            $user = Booked_tickets::where('user_id', '=', $req->loginID)->where('id','=',$book_id)->first();
            $loginID= $req->loginID;

        }
        else{
            $user = Booked_tickets::where('user_id', '=', session()->get("loginID"))->where('id','=',$book_id)->first();
            $loginID= session()->get("loginID");

        }

        $nowDate = Carbon::now();
        if ($user) {
            $stops_station = Stops_stations::where('id', '=', $user->stops_station)->first();


            if ($stops_station->date > $nowDate) {
                $train = Train::where('train_no', '=', $stops_station->train_no)->first();
                $seat = Seat::where('train', '=', $train->id)->where('seat_availability', '=', 'false')
                ->where('id','=',$user->seat)
                ->first();
                // Set avaialbity to false after seat resereverd 
                $seat->seat_availability='true';
                $seat->save();
                $user->delete();
                if ($req->has('api')){
                     return response()->json([
                    'message' => "1",
                     ]);
            }
                return view("user/cancel");
            } else {
                if ($req->has('api')){
                    return response()->json([
                   'message' => "Sorry, You Can Cancel Or Delete A Trip At Leat One Day Before The Departure Date"
                    ]);
                }
                return view("user/date");
            }
        } else {
            if ($req->has('api')){
                return response()->json([
               'message' => "Ticket doesn't exist"
                ]);
            }
            return redirect("user/home");
        }
    }

    public function user_contact()
    {
        return view("user/contact");
    }

    public function user_get_stations(Request $req)
    {
        $query = array( );
        $stations = \DB::select('select * from stations', array());
        foreach($stations as $station){
            array_push($query, 
                $station->city,
        );
        }
        if ($req->has('api')){
            return response()->json([
           'query' => $query
            ]);     
        }
    }

    public function user_reschedule_trip($book_id,Request $req)
    {
        if ($req->has('api')){
            $user = Booked_tickets::where('user_id', '=', $req->loginID)->where('id','=',$book_id)->first();
            $loginID=$req->loginID;

        }
        else{
            $user = Booked_tickets::where('user_id', '=', session()->get("loginID"))->where('id','=',$book_id)->first();
            $loginID=session()->get("loginID");

        }
        $nowDate = Carbon::now();
        // return "$req->all() $book_id  $loginID here";

        if ($user) {
            $book = Booked_tickets::where('user_id', '=', $loginID)->where('id','=',$book_id)->first();
            $stops_station = Stops_stations::where('id', '=', $book->stops_station)->first();
            
            if ($stops_station->date > $nowDate) {
                if ($req->has('api')){
                     return response()->json([
                    'message' => "1",
                     ]);
                
                
            }
             return view("user/reschedule_trip",compact('stops_station','book'));
            } else {
                if ($req->has('api')){
                    return response()->json([
                   'message' => "Sorry, You Can Cancel Or Delete A Trip At Leat One Day Before The Departure Date"
                    ]);
                }
                return view("user/date");
            }
        } else {
            if ($req->has('api')){
                return response()->json([
               'message' => "Ticket doesn't exist"
                ]);
            }
            return redirect("user/home");
        }

    }


    public function user_view_booked_trips(Request $req)
    {
        if ($req->has('api')){
            $user = Booked_tickets::where('user_id', '=', $req->loginID)->first();

        }
        else{
            $user = Booked_tickets::where('user_id', '=', session()->get("loginID"))->first();
        }

        
            if ($req->has('api')){
                $userId = $req->loginID;
            }
            else{
                $userId = session()->get('loginID');
            }


            $query = DB::table('stops_stations')
                ->select('booked_tickets.id AS book_id','source_station','destination_station',
                'scheduled_arrival_time','scheduled_departure_time','stops_stations.id','train_no','date','price','seat')
                ->join('booked_tickets', 'stops_stations.id', '=', 'booked_tickets.stops_station')
                ->where('user_id',$userId)
                ->get();
            

            if ($req->has('api')){
                return response()->json([
                    'query' => $query,
                ]);
            }

            $query= json_decode($query, true);

        
        return view("user/view_booked_trips", compact('query'));

        
    }

    public function today_trips(Request $req)
    {
        $todayDate = Carbon::now()->format('Y-d-m');
        
        $query = Stops_stations::where('date', 'like', '%' . $todayDate . '%')->get();
        if ($req->has('api')){
            return response()->json([
                'query' => $query
            ]);
        }
        $user = Booked_tickets::where('user_id', '=', session()->get("loginID"))->first();
        return view('user/today_trips', compact('query', 'user'));
    }

    public function show_available_trips(Request $req)
    {
        $filter = $req->validate([
            'source' => 'string',
            'dest' => 'string',
        ]);
        $source_station = $req->get('source');
        $destination_station = $req->get('dest');
        $query = Stops_stations::where('source_station', 'like', '%' . $source_station . '%')
            ->where('destination_station', 'like', '%' . $destination_station . '%')
            ->get();
         $user =session()->get("loginID");
        
        if ($req->has('api')){
            return response()->json([
                'message' => "{$query}"
            ]);
        }
        
        return view('user/view_available_trips', compact('query', 'user'));
    }

    public function user_checkout(Request $request)
    {
        $stops_id = $request->stops_id;
        $stops_station = Stops_stations::where('id', '=', $stops_id)->first();
        return view('user/checkout', compact('stops_id', 'stops_station'));
    }

    public function generate_ticket(Request $request)
    {
        if ($request->has('api')){
            $userId = $request->loginID;
            $stops_id = $request->stops_id;
        }
        else{
            $userId = session()->get('loginID');
            $stops_id = $request->stops_id;
        }
        
        
        $booked_ticket = new Booked_tickets();
        $stops_station = Stops_stations::where('id', '=', $stops_id)->first();
        $train = Train::where('train_no', '=', $stops_station->train_no)->first();
        $seat = Seat::where('train', '=', $train->id)->where('seat_availability', '=', 'true')->first();
        // Set avaialbity to false after seat resereverd 
        $seat->seat_availability='false';
        $seat->save();
        
        $booked_ticket->user_id = $userId;
        $booked_ticket->stops_station = $stops_station->id;
        $booked_ticket->seat = $seat->id;
        $booked_ticket->save();
        $seat->seat_availability = "false";
        $seat->save();
        $pdf = PDF::loadView('user/ticket', compact('booked_ticket', 'seat'));
        // if ($request->has('api')){
        //       return response()->download( $pdf);
        // }

        return $pdf->download('Ticket.pdf');
    }

    public function news_1()
    {
        return view('user/news_1');
    }

    public function news_2()
    {
        return view('user/news_2');
    }

    public function news_3()
    {
        return view('user/news_3');
    }

    public function submit()
    {
        return view('user/submit');
    }
}
