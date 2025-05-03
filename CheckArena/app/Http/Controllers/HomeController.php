<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Opening;
use App\Models\EndgameTactic;

class HomeController extends Controller
{
    
    

    public function index(){

        $openings = Opening::with(['openingMoves' => function ($query) {
            $query->orderBy('id')->limit(2); 
        }])->get();
       
        

        $endgames = EndgameTactic::where('type', 'endgame')->get();


        


        return view('home.index' , compact('openings' , 'endgames'));
    }


    
}
