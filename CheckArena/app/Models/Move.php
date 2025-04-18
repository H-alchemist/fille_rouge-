<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    protected $table = 'moves';

    protected $fillable = [
        'partie_id',
        'fromPosition',
        'toPosition',
        'pieceNumber',
        'timestamp',
    ];

    public function partie()
{
    return $this->belongsTo(Partie::class);
}

}
