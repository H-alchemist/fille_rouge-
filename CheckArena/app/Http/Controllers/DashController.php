<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Partie;


class DashController extends Controller
{
    


    public function index()
    {
        
        $res = Partie::where(function ($query) {
            $query->where('whitePlayer', auth()->id())
                  ->orWhere('blackPlayer', auth()->id());
        })->get();
        
        
        $total = $res->count();
        $wins = $res->where('winner', auth()->id())->count();
        $losses = $res->where('loser', auth()->id())->count();
        $draws = $total - $wins - $losses;
    
        $winPercentage = $total > 0 ? ($wins / $total) * 100 : 0;
        $lossPercentage = $total > 0 ? ($losses / $total) * 100 : 0;
        $drawPercentage = $total > 0 ? ($draws / $total) * 100 : 0;
    
        $winsByResign = $res->where('winner', auth()->id())->where('partieStatus', 'resign')->count();
        $winsByTimeout = $res->where('winner', auth()->id())->where('partieStatus', 'timeout')->count();
        $winsByCheckmate = $res->where('winner', auth()->id())->where('partieStatus', 'checkmate')->count();
    
        $lossesByResign = $res->where('loser', auth()->id())->where('partieStatus', 'resign')->count();
        $lossesByTimeout = $res->where('loser', auth()->id())->where('partieStatus', 'timeout')->count();
        $lossesByCheckmate = $res->where('loser', auth()->id())->where('partieStatus', 'checkmate')->count();
    
        return view('dash/stat', compact('total', 'wins', 'losses', 'draws', 'winPercentage', 'lossPercentage', 'drawPercentage', 
            'winsByResign', 'winsByTimeout', 'winsByCheckmate', 'lossesByResign', 'lossesByTimeout', 'lossesByCheckmate'));
    }
    


    public function history()
    
    {
        return view('dash/history');
    }
}
