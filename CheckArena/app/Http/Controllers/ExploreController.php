<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Opening;
use App\Models\OpeningMove;
use App\Models\OpeningCharacteristic;

class ExploreController extends Controller
{
    


    public function index(){

        $opening = Opening::with(['openingMoves', 'openingCharacteristics'])->find(2);

        if (!$opening) {
            return "Opening not found.";
        }
    
        // Prepare moves and comments
        $moves = $opening->openingMoves;
        $comments = $opening->openingCharacteristics->pluck('description')->toArray(); 
        
        return view('explore.explore', [
            'opening' => $opening,
            'moves' => $moves,
            'comments' => $comments,
            'openingName' => $opening->title
        ]);

    }



}
