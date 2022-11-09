<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPhoto extends Model
{
    protected $fillable = [
        'user_id',
        'avatar',
        'hero',
        'pic01',
        'pic02',
        'pic03',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
