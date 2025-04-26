<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partie extends Model
{


    protected $table = 'parties';

    protected $fillable = [
        'whitePlayer',
        'blackPlayer',
        'winner',
        'loser',
        'partieStatus',
        'timeControl',
    ];

    public function whitePlayer()
{
    return $this->belongsTo(User::class, 'whitePlayer');
}

public function blackPlayer()
{
    return $this->belongsTo(User::class, 'blackPlayer');
}

public function moves()
{
    return $this->hasMany(Move::class);
}



}
