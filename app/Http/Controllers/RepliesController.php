<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Reply::class, 'reply');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Ticket $ticket)
    {
        $validatedData = $request->validate([
            'reply' => 'required|max:255'
        ]);

        Reply::create([
            'reply' => $validatedData['reply'],
            'user_id' => Auth::user()->id,
            'ticket_id' => $ticket->id
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket, Reply $reply)
    {
        $reply->delete();
        return back();
    }
}
