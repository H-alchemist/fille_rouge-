<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    


    public function partie()
{
    return $this->belongsTo(Partie::class);
}

}
