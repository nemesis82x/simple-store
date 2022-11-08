<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPhoto extends Model
{
    protected $fillable = [
        'name',
        'path',
        'type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
