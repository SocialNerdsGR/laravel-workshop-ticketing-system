@extends('layouts.app')

@section('content')
<form method="POST" action={{action('TicketsController@store')}}>
  @csrf
  <input type="text" name="title" placeholder="Title">
  <textarea placeholder="Ticket" name="content" cols="30" rows="10"></textarea>
  <input type="submit" value="Create">
</form>
@endsection