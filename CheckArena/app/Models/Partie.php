<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partie extends Model
{


    protected $table = 'parties';

    protected $fillable = [
        'white_player',
        'black_player',
        'winner',
        'loser',
        'partie_status',
        'timeControl',
    ];

    public function whitePlayer()
{
    return $this->belongsTo(User::class, 'white_player');
}

public function blackPlayer()
{
    return $this->belongsTo(User::class, 'black_player');
}

public function moves()
{
    return $this->hasMany(Move::class);
}



}
