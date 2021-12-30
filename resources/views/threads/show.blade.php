@extends('app')

@section('title', 'スレッド詳細')

@section('content')
  @include('nav')
  <div class="container">
    @include('threads.card')
  </div>
@endsection
