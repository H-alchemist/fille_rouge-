<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $table = 'messages';

    protected $fillable = [
        'partie_id',
        'content',
        'sender_id',
        'created_at',
    ];


    public function partie()
{
    return $this->belongsTo(Partie::class);
}

}
