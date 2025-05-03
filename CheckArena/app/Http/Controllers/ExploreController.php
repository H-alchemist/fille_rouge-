<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Opening;
use App\Models\OpeningMove;
use App\Models\OpeningCharacteristic;
use App\Models\EndgameTactic;

class ExploreController extends Controller
{
    


    public function index($id){

        $opening = Opening::with(['openingMoves', 'openingCharacteristics'])->find($id);

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


    public function endgame($id){

        $endgame = EndgameTactic::with(['moves', 'comments'])->find($id);

        if (!$endgame) {
            return "Opening not found.";
        }

        // Prepare moves and comments
        $moves = $endgame->moves;
        $comments = $endgame->comments;

        return view('explore.endGame', [
            'opening' => $endgame,
            'moves' => $moves,
            'comments' => $comments,
            'openingName' => $endgame->title
        ]);
    
    
    }


}
