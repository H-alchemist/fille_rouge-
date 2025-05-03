<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EndgameTacticsComment extends Model
{

    protected $table = 'endgame_tactics_comments';

    protected $fillable = ['tactic_id', 'comment'];

    public function tactic()
    {
        return $this->belongsTo(EndgameTactic::class, 'tactic_id');
    }
}
