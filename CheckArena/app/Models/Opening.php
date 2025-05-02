<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Opening extends Model
{
    
    protected $table = 'openings';

    protected $fillable = ['title', 'color', 'commentary'];

    public function openingMoves()
    {
        return $this->hasMany(OpeningMove::class);
    }

    public function openingCharacteristics()
    {
        return $this->hasMany(OpeningCharacteristic::class);
    }
}
