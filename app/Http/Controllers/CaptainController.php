<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Captain;
use App\Captain_reports;
use Hash;


class CaptainController extends Controller
{
    //
    public function captain_login_index(){
        return view("captain/login");
    }

    public function captain_login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|max:12|min:8'
        ]);
        $captain = Captain::where('email','=',$request->email)->first();
        if($captain && Hash::check($request->password, $captain->password)){
            $request->session()->put('captainloginID', $captain->id);
            return redirect("captain/home");
        }else{
            return back()->with('fail', 'Email or Password is incorrect');
        }
    }

    public function captain_report (Request $request){
           $this->validate($request, [
                'date' => 'required',
                'train no'=> 'required',
                'report name' => 'required',
                'technician name' => 'required',
                'writingReport' => 'required',
               
                
           ]);
           $report = new Captain_reports([
            'date'=> $request->get('date'),
            'train no' => $request->get('train no'),
            'report name' => $request->get('report name'),
            'technician name' => $request->get('technician name'),
            'writingReport' =>$request->get('writingReport'),
              ]);
              $report->save();
              return redirect()->route('captainReport')->with('success');
    }

    
}
