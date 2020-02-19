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
@endsection