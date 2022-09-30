<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class ApiAdmin extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|max:12|min:8',
            "name" => "required"
        ]);
        Admin::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name
        ]);
        $file = $request->file('image');
        if($file != null){
            $extension = $file->getClientOriginalExtension();
            $fullFileName = time(). '.'. $extension;
            print($fullFileName);
            $file->move('uploads', $fullFileName,  ['disk' => 'local']);
        }
        return response()->json(['message' => 'done', 'code' => 200]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|max:12|min:8'
        ]);
        if (Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            $user = Admin::where('email', $request->email)->first();
            return $user->createToken($user->name)->plainTextToken;
        } else {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        Auth::guard('admin')->logout();
        return response()->json(['message' => 'logged out', 'code' => 200]);
    }
}
