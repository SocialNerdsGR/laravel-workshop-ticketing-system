@extends('layouts.app')

@section('content')
<h3>{{$ticket->title}}</h3>
<form method="POST" action="{{action('TicketsController@destroy', ['ticket' => $ticket->id])}}">
  @csrf
  @method('DELETE')
  <input type="submit" value="Delete">
</form>
<p>
  {{$ticket->content}}
</p>
@endsection