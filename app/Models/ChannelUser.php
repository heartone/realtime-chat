<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelUser extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function channels()
    {
        return $this->hasMany(Channel::class);
    }
}
