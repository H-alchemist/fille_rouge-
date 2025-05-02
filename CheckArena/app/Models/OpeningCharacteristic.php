<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpeningCharacteristic extends Model
{
    use HasFactory;

    protected $table = 'opening_characteristics';

    protected $fillable = ['opening_id', 'description'];

    public function opening()
    {
        return $this->belongsTo(Opening::class);
    }
}
