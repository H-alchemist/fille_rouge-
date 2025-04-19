<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    

    public function index(){
        if (auth()->check()) {
            return  redirect('/');
        }
        
        return view('auth.index' , [
            'title' => 'register'
        ]);
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
        
        $rules = [
            'username' => 'required|min:4|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:255'
        ];
    
        // Create a validator instance
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Redirect back with validation errors and old input
            return redirect()->back()
                             ->withErrors($validator)   // Pass the validation errors
                             ->withInput()              // Preserve the old input
                             ->with('title', 'register'); // Pass the title for the view
        }

        $validated = $validator->validated();
        $validated['password'] = bcrypt($validated['password']);

        // return $validated['username'];
       
        $user =User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => $validated['password']
        ]);
  
        auth()->login($user);


        return redirect('/');


    
    }
}
