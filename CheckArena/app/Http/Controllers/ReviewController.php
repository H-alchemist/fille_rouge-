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
        return view('review/review'  , compact('partie'));
    }
    
}
