<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class AuthController extends Controller
{
    

    public function index(){
        return view('auth.index');
    }

    public function logIn(Request $request){

        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(auth()->attempt($validated)){
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Account created successfully.');

        }

        return back()->withErrors(['email' => 'Login Failed'])->onlyInput('email');


    }

    public function register(Request  $request){

        // return $request ;
        
         $validated = $request->validate([
            'userName' => 'required|min:4|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:255'
        ]);
      
        $validated['password'] = bcrypt($validated['password']);
        
        User::create([
            'userName' => $validated['userName'],
            'email' => $validated['email'],
            'password' => $validated['password']
        ]);
        return redirect('/');


    
    }
}
