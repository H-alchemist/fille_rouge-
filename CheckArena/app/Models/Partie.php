<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partie extends Model
{




















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

public function chat()
{
    return $this->hasOne(Chat::class);
}

}
