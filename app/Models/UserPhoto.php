<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPhoto extends Model
{
    public function users() {
        return $this->belongsToMany(User::class);
    }
}
