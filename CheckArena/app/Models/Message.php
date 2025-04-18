<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $table = 'messages';

    protected $fillable = [
        'chat_id',
        'content',
        'sender_id',
        'created_at',
    ];


    public function chat()
{
    return $this->belongsTo(Chat::class);
}

}
