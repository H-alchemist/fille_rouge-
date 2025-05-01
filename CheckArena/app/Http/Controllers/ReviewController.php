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

      
        // dd($partie->moves, json_last_error_msg());  



        return view('review/review'  , compact('partie' , 'messages' , 'moves'));
    }
    
}
