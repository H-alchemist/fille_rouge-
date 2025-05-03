<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EndgameTactic extends Model
{

    protected $table = 'endgame_tactics';

    protected $fillable = ['title', 'type', 'starting_position', 'commentary'];

    public function moves()
    {
        return $this->hasMany(EndgameTacticsMove::class, 'tactic_id');
    }

    public function comments()
    {
        return $this->hasMany(EndgameTacticsComment::class, 'tactic_id');
    }
}
