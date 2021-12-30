@extends('app')

@section('title', 'スレッド一覧')

@section('content')
  @include('nav')
  <div class="container">
    @foreach($threads as $thread)
      @include('threads.card') 
    @endforeach
  </div>
@endsection
