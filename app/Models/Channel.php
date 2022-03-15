<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = [
        'user_id', 'name', 'description,'
    ];
    public function chats() {
        return $this->hasMany(Chat::class);
    }
    public function scopeSearch($query)
    {
        $query->orderBy('name');
    }
    
}
