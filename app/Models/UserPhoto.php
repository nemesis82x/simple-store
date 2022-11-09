<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPhoto extends Model
{
    protected $fillable = [
        'user_id',
        'name_avatar',
        'path_avatar',
        'name_hero',
        'path_hero',
        'name_pic01',
        'path_pic01',
        'name_pic02',
        'path_pic02',
        'name_pic03',
        'path_pic03',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
