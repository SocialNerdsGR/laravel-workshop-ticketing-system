@extends('layouts.app')

@section('content')
<ul>
  @foreach($errors->all() as $error)
  <li>{{$error}}</li>
  @endforeach
</ul>
<form method="POST" action={{action('TicketsController@store')}}>
  @csrf
  <input value="{{old('title', '')}}" type="text" name="title" placeholder="Title">
  <textarea placeholder="Ticket" name="content" cols="30" rows="10">{{old('content', '')}}</textarea>
  <input type="submit" value="Create">
</form>
@endsection