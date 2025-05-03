<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EndgameTacticsMove extends Model
{

    protected $table = 'endgame_tactics_moves';
    
    protected $fillable = ['tactic_id', 'from_position', 'to_position', 'piece_number'];

    public function tactic()
    {
        return $this->belongsTo(EndgameTactic::class, 'tactic_id');
    }
}
