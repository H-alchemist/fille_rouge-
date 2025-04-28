<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Partie;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class DashController extends Controller
{
    


    public function index()
    {
        
        $res = Partie::where(function ($query) {
            $query->where('white_player', auth()->id())
                  ->orWhere('black_player', auth()->id());
        })->get();
        
        
        $total = $res->count();
        $wins = $res->where('winner', auth()->id())->count();
        $losses = $res->where('loser', auth()->id())->count();
        $draws = $total - $wins - $losses;
    
        $winPercentage = $total > 0 ? ($wins / $total) * 100 : 0;
        $lossPercentage = $total > 0 ? ($losses / $total) * 100 : 0;
        $drawPercentage = $total > 0 ? ($draws / $total) * 100 : 0;
    
        $winsByResign = $res->where('winner', auth()->id())->where('partie_status', 'resign')->count();
        $winsByTimeout = $res->where('winner', auth()->id())->where('partie_status', 'timeout')->count();
        $winsByCheckmate = $res->where('winner', auth()->id())->where('partie_status', 'checkmate')->count();
    
        $lossesByResign = $res->where('loser', auth()->id())->where('partie_status', 'resign')->count();
        $lossesByTimeout = $res->where('loser', auth()->id())->where('partie_status', 'timeout')->count();
        $lossesByCheckmate = $res->where('loser', auth()->id())->where('partie_status', 'checkmate')->count();
    
        return view('dash/stat', compact('total', 'wins', 'losses', 'draws', 'winPercentage', 'lossPercentage', 'drawPercentage', 
            'winsByResign', 'winsByTimeout', 'winsByCheckmate', 'lossesByResign', 'lossesByTimeout', 'lossesByCheckmate'));
    }
    


    public function history()
    
    {

        $res = DB::select('
       
        SELECT 
    p.* AS partie_id,
    u.username AS opponent_name,
    pr.avatar AS opponent_avatar,
    pr.elo AS opponent_elo,
    COUNT(m.id) AS move_count
FROM parties p
JOIN users u ON (
    (p.white_player = :userID AND u.id = p.black_player) 
    OR 
    (p.black_player = :userID AND u.id = p.white_player)
)
JOIN profiles pr ON pr.user_id = u.id
LEFT JOIN moves m ON m.partie_id = p.id
GROUP BY p.id, u.username, pr.avatar, pr.elo
ORDER BY p.id DESC
limit 5;

        ', 
        ['userID' => 1]
    
    );


     Log::info("message", ['res' => $res]);


        return view('dash/history' , compact('res'));
    }
}
