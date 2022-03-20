<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = [
        'user_id', 'name', 'description'
    ];
    protected $appends = [
        'description_html'
    ];
    public function chats() {
        return $this->hasMany(Chat::class);
    }
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
    public function users() 
    {
        return $this->belongsToMany(User::class, 'channel_user', 'channel_id', 'user_id');
    }
    public function getDescriptionHtmlAttribute()
    {
        return \Str::markdown($this->description ?? '',[
            'html_input' => 'escape',
        ]);
    }
    public function scopeSearch($query)
    {
        $query->orderBy('name');
    }
    
}
