<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'user_id', 'content'
    ];
    protected $appends = [
        'content_html', 'is_edited'
    ];
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getContentHtmlAttribute()
    {
        return \Str::markdown($this->content ?? '',[
            'html_input' => 'escape',
        ]);
    }
    public function getIsEditedAttribute()
    {
        return $this->created_at != $this->updated_at;
    }
    public function scopeSearch($query)
    {
        $query->with('user')->latest();
    }
}
