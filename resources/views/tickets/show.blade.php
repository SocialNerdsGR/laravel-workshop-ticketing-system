@extends('layouts.app')

@section('content')
<h3>{{$ticket->title}}</h3>
<a href="{{action('TicketsController@edit', ['ticket' => $ticket->id])}}">Edit ticket</a>
<p>
  {{$ticket->content}}
</p>
@endsection