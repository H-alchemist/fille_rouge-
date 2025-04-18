<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';

    protected $fillable = [
        'partie_id',
    ];


    public function partie()
{
    return $this->belongsTo(Partie::class);
}

public function messages()
{
    return $this->hasMany(Message::class);
}

}
