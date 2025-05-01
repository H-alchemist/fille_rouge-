<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Partie;

class ReviewController extends Controller
{
    public function index()
    {
        $partie = Partie::find(1);
        return view('review/review' );
    }
    
}
