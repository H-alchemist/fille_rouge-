<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Partie;

use Illuminate\Support\Facades\Auth;

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
        

       
            $playerName =  Auth::user()->username  ; 
            $playerElo = Auth::user()->profile->elo ;
            $playerAvatar = Auth::user()->profile->avatar ;
            $playerId = Auth::user()->id ;


     
        
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
            'winsByResign', 'winsByTimeout', 'winsByCheckmate', 'lossesByResign', 'lossesByTimeout', 'lossesByCheckmate' , 'playerName' , 'playerElo' , 'playerId' , 'playerAvatar' ));
    }
    


    public function history()
    
    {

        

    

        return view('dash/history');
    }



    public function fetchingData($id , $num ){
        $userId = $id;

        $res = Partie::where(function ($query) {
            $query->where('white_player', auth()->id())
                  ->orWhere('black_player', auth()->id());
        })->get();
        
        
        $total = DB::select('select  count(p.id) as num  from parties p where white_player = :id or black_player = :id' , [':id' => $userId ]);
        $pagesNumber =$total[0]->num/2 ;




        

        $res = DB::select('
            SELECT 
                p.*,
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
            LIMIT 2
            OFFSET :offset

        ', ['userID' => $userId , 'offset' => $num*2]);

         $all = ['res' => $res ,'num' => ceil($pagesNumber)];
    
        return response()->json($all);
    }


    public function filterdData(Request $request)
    {

        
        $userID = (int) $request->input('time', ); 
        $timePeriod = (int) $request->input('time', 0);
        $type = (int) $request->input('type', 0);
        $result = $request->input('result', 'all');
        
    
        $baseQuery = "
            SELECT 
                p.*,
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
        ";
    
        $conditions = [];
        $params = ['userID' => $userID];
        Log::info("timePeriod" , [$timePeriod]);
        if ($timePeriod > 0) {
            $conditions[] = "p.created_at > NOW() - INTERVAL '$timePeriod days'";
        }
    
        if ($result === 'winner') {
            $conditions[] = "p.winner = :userID ";
        } elseif ($result === 'losser') {
            $conditions[] = "p.winner != :userID";
        } elseif ($result === 'draw') {
            $conditions[] = "p.partie_status = 'draw'";
        }
    
        if ($type > 0) {
            $conditions[] = "p.time_control = :type";
            $params['type'] = $type;
        }
    
        if (!empty($conditions)) {
            $baseQuery .= " WHERE " . implode(' AND ', $conditions);
        }
    
        $baseQuery .= " GROUP BY p.id, u.username, pr.avatar, pr.elo
                        ORDER BY p.id DESC
                        ";
    
       
    
        $results = DB::select($baseQuery, $params);
    
        return response()->json($results);
    }
    





public function showProfile()
{
    return view('/dash/profile');
}



public function updateProfile(Request $request)
{
    $user = Auth::user();

    
    $request->validate([
        'avatar' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048', 
        'username' => 'nullable|string|max:255',
    ]);

    
    if ($request->hasFile('avatar')) {
        $path = $request->file('avatar')->store('avatars', 'public'); 
        $user->profile->avatar = $path; 
    }

    
    if ($request->filled('username')) {
        $user->username = $request->input('username');
    }

    
    $user->save();

    
    return redirect('/profile');
}




}