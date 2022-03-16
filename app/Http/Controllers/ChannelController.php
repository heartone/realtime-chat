<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return inertia('Chat/Base')->with([
            'channels' => Channel::search()->paginate(20)->withQueryString(),            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'description' => 'nullable|string',
        ]);
        $channel = \Auth::user()->channels()->create($request->all());
        return redirect()->route('channels.show', $channel);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {
        return inertia('Chat/Base')->with([
            'channels' => Channel::search()->paginate(50)->withQueryString(), 
            'channel' => $channel,
            'chats' => $channel->chats()->search()->paginate(20)->withQueryString(),           
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function edit(Channel $channel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Channel $channel)
    {
        // todo policy
        $request->validate([
            'name' => 'required|max:50',
            'description' => 'nullable|string',
        ]);
        // dd($request->all(), $channel->toArray());
        $channel->update($request->all());
        return redirect()->route('channels.show', $channel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel)
    {
        //
    }
}
