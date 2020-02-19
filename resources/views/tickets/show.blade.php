@extends('layouts.app')

@section('content')
<h3>{{$ticket->title}}</h3>
@can('update', $ticket)
<a href="{{action('TicketsController@edit', ['ticket' => $ticket->id])}}">Edit ticket</a>
@endcan
@can('delete', $ticket)
<form method="POST" action="{{action('TicketsController@destroy', ['ticket' => $ticket->id])}}">
  @csrf
  @method('DELETE')
  <input type="submit" value="Delete">
</form>
@endcan
<p>
  {{$ticket->content}}
</p>
<form method="POST" action="{{action('RepliesController@store', ['ticket' => $ticket->id])}}">
  @csrf
  <textarea class="" name="reply" cols="30" rows="10">{{old('reply', '')}}</textarea>
  <input type="submit" value="Reply">
</form>
<div>
  @foreach($replies as $reply)
  <div>
    @can('delete', $reply)
    <form method="POST" action="{{action('RepliesController@destroy', ['ticket' => $ticket->id, 'reply' => $reply->id])}}">
      @csrf
      @method('DELETE')
      <input type="submit" value="Delete">
    </form>
    @endcan
    <h5>Author: {{$reply->user->name}}</h5>
    <strong>{{$reply->created_at->format('D m M Y')}}</strong>
    <p>{{$reply->reply}}</p>
  </div>
  @endforeach
  {{$replies->links()}}
</div>
@endsection