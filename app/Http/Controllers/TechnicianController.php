<?php

namespace App\Http\Controllers;
use Hash;
use App\Captain;
use App\Train;
use App\Captain_reports;
use Illuminate\Http\Request;
use App\Technician;
class TechnicianController extends Controller
{
    
    public function tech_login_index(){
        return view("tech/login");
    }
    public function tech_login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|max:12|min:8'
        ]);
        $tech = Technician::where('email','=',$request->email)->first();
        if($tech && Hash::check($request->password, $tech->password)){
            $request->session()->put('techloginID', $tech->id);
            return redirect("tech/home");
        }else{
            return back()->with('fail', 'Email or Password is incorrect');
        }
    }

    public function tech_index(){
        $report = Captain_reports::all();
        $techId=session()->get('tech_loginID');
        $tech= Technician::where('id','=',$techId->id);
        $captain=Captain::where('id','=',$report->captain)->first();
        $train=Train::where('id','=',$report->train)->first();
        return view("technician/tech",compact('tech','report','captain','train'));
    }

    public function tech_logout(){
        if(session()->has('techloginID')){
            session()->pull('techloginID');
            return redirect("/");
        }
    }

    public function view_Report(){
        
        ##if(session()->has('loginID'))
        #{
         
        $techId=session()->get('tech_loginID');
        $report= Captain_reports::all();
        $captain=Captain::where('id','=',$report)->get();
        return view("tech/home",compact('report','captain'));
        #}
        
       # else
        #{
            return redirect()->back();
        #}
 }

     public function Report(Request $request){
        $report_id = $request->report_id;
        dd($report_id);
        $report = new Captain_reports();            
        $report->status="false";
        $report->save();


    }
       
}