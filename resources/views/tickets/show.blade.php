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
<div>
  @foreach($replies as $reply)
  <div>
    <h5>Author: {{$reply->user->name}}</h5>
    <strong>{{$reply->created_at->format('D m M Y')}}</strong>
    <p>{{$reply->reply}}</p>
  </div>
  @endforeach
  {{$replies->links()}}
</div>
@endsection