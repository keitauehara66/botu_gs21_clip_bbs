@extends('app')

@section('title', $user->name)

@section('content')
  @include('nav')
    <div class="container">
      @include('users.user')
      @include('users.tabs', ['hasThreads' => true, 'hasBookmarks' => false])
      @foreach($threads as $thread)
        @include('threads.card')
      @endforeach
    </div>
@endsection
