<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $channel = Channel::findOrFail($request->channel_id);
        return $channel->chats()->search()->paginate(5)->withQueryString();
        return inertia('Chat/Base')->with([
            'channels' => Channel::search()->paginate(50)->withQueryString(), 
            'channel' => $channel,
            'chats' => $channel->chats()->search()->paginate(5)->withQueryString(),           
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
        return back();
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
