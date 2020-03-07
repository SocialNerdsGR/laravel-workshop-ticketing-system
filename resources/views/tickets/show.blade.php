@extends('layouts.app')

@section('content')
<h3>{{$ticket->title}}</h3>
<p>
  {{$ticket->content}}
</p>
@endsection