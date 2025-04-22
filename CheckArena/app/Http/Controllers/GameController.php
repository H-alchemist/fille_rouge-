<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    
    public function index(){


        return view('gamePage.game' , [
            'playerName' =>  $username  , 
            'playerElo' => Auth::user()->profile->elo ,
            'playerId' => Auth::user()->id ,

        ]);

    }
    
}
