<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    protected $table = 'moves';

    protected $fillable = [
        'partie_id',
        'from_position',
        'to_position',
        'piece_number',
        'timestamp',
    ];

    public function partie()
{
    return $this->belongsTo(Partie::class);
}

}
