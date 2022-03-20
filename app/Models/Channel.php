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
        'description_html',
    ];
    public function chats() {
        return $this->hasMany(Chat::class);
    }
    // チャンネル作成者（管理者）
    public function owner() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function users() 
    {
        return $this->belongsToMany(User::class, 'channel_user', 'channel_id', 'user_id');
    }
    // チャンネルアクセス情報
    public function user()
    {
        return $this->hasOne(ChannelUser::class)->where('user_id', auth()->id());
    }
    // 最新の投稿
    public function latestChat()
    {
        return $this->hasOne(Chat::class)->latest();
    }
    // 説明文Markdown
    public function getDescriptionHtmlAttribute()
    {
        return \Str::markdown($this->description ?? '',[
            'html_input' => 'escape',
        ]);
    }
    
    // チャンネル検索
    public function scopeSearch($query)
    { 
        // dd($query->with('user')->get()->toArray());
        $query->with('user')->with('latestChat')->orderBy('name');
    }

    // チャンネルアクセス
    public function access()
    {
        if (!$this->user()->exists()) {
            $this->users()->attach(auth()->id(), ['access_at' => now()]);
        } else {
            $this->user()->update(['access_at' => now()]);
        }
        
    }
    
}
