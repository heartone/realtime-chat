<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Chat;
use Illuminate\Http\Request;
use App\Events\ChatCreated;

use Illuminate\Notifications\Notifiable; //追記
use App\Notifications\SendSlack; //追記
use Illuminate\Notifications\Messages\SlackMessage; //追記

class ChatController extends Controller
{   

    use Notifiable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $channel = Channel::findOrFail($request->channel_id);
        return $channel->chats()->search()->paginate(50)->withQueryString();
        return inertia('Chat/Base')->with([
            'channels' => Channel::search()->paginate(50)->withQueryString(), 
            'channel' => $channel,
            'chats' => $channel->chats()->search()->paginate(10)->withQueryString(),           
        ]);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $channel = Channel::findOrFail($request->channel_id);
        $request->validate([
            'content' => 'required',
        ]);
        $chat = $channel->chats()->create([
            'user_id' => \Auth::id(),
            'content' => $request->content,
        ]);
        // Slack通知
        $slack = $this->notify(new SendSlack($this->generateMessage($chat)));
        // リアルタイム通信
        broadcast(new ChatCreated($chat))->toOthers();
        return back();
    }
    public function routeNotificationForSlack($notification)
    {
        return config('app.slack_url');
    }
    public function generateMessage($chat)
    {
        return sprintf("%sさんの投稿（%s）\n%s", $chat->user->name, $chat->channel->name, $chat->content);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {
        //
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        // todo policy
        $request->validate([
            'content' => 'required',
        ]);
        $chat->update($request->all());
        return $chat;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        // todo policy
        $chat->delete();
        return $chat;
    }
}
