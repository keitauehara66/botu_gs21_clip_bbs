@extends('app')

@section('title', 'スレッド作成')

@include('nav')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3">
          <div class="card-body pt-0">
            @include('error_card_list')
            <div class="card-text">
              <form method="POST" action="{{ route('threads.store') }}">
                @include('threads.form')
                <button type="submit" class="btn btn-block" style="background-color:#26b297; color:#ffffff;">スレッド作成</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
