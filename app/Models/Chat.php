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
        // 同一時刻に登録されるテストデータ用にidでも並べ替え
        $query->with('user')->latest()->orderBy('id', 'desc');
        // 本来は以下でOK
        // $query->with('user')->latest();
    }
}
