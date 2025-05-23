<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    
    protected $table = 'profiles';

    protected $fillable = [
        'elo',
        'avatar',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
