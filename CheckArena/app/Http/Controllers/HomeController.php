<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Opening;

class HomeController extends Controller
{
    
    

    public function index(){

        $openings = Opening::with(['openingMoves' => function ($query) {
            $query->orderBy('id')->limit(2); 
        }])->get();

        return view('home.index' , compact('openings'));
    }


    
}
