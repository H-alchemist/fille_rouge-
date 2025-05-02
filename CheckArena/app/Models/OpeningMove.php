<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpeningMove extends Model
{
    use HasFactory;

    protected $table = 'opening_moves';

    protected $fillable = ['opening_id', 'from_position', 'to_position', 'piece_number'];

    public function opening()
    {
        return $this->belongsTo(Opening::class);
    }
}
