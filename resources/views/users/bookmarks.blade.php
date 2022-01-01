@extends('app')

@section('title', $user->name . 'のお気に入りの掲示板')

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')
    @include('users.tabs', ['hasThreads' => false, 'hasBookmarks' => true])
    @foreach($threads as $thread)
      @include('threads.card')
    @endforeach
  </div>
@endsection
