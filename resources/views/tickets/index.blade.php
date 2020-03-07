@extends('layouts.app')

@section('content')
<h2>Tickets</h2>
<ul>
  @foreach($tickets as $ticket)
  <li><a href={{action('TicketsController@show', ['ticket' => $ticket->id])}}>{{$ticket->title}}</a></li>
  @endforeach
</ul>
{{$tickets->links()}}
@endsection