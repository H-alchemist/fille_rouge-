<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use  App\Services\ReviewService;

class ReviewController extends Controller
{

    protected $reviewService;


    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }


    public function index($id)
    {

       

        $partie = $this->reviewService->getPartieData($id);

        $messages = json_decode($partie->messages);

        $moves = json_decode($partie->moves);

        $matchInfo = [
            'white_player' => $partie->white_player,
            'black_player' => $partie->black_player,
            'winner' => $partie->winner,
            'loser' => $partie->loser,
            'partie_status' => $partie->partie_status,
            'time_control' => $partie->time_control,
            'created_at' => $partie->created_at,
            
            'white_username' => $partie->white_username,
            'black_username' => $partie->black_username,
            'white_avatar' => $partie->white_avatar,
            'black_avatar' => $partie->black_avatar,
            'white_elo' => $partie->white_elo,
            'black_elo' => $partie->black_elo
        ];
        
        // dd($partie->moves, json_last_error_msg());  



        return view('review/review'  , compact('partie','matchInfo' , 'messages' , 'moves'));
    }
    
}
