@extends('layouts.app')

@section('content')
<ul>
  @foreach($errors->all() as $error)
  <li>{{$error}}</li>
  @endforeach
</ul>
<form method="POST" action="{{action('TicketsController@update', ['ticket' => $ticket->id])}}">
  @csrf
  @method('PATCH')
  <input name="title" value="{{old('title', $ticket->title)}}" type="text">
  <textarea name="content" cols="30" rows="10">{{old('content', $ticket->content)}}</textarea>
  <input type="submit" value="Save">
</form>
@endsection