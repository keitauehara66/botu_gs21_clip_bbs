@extends('app')

@section('title', 'コメント作成')

@include('nav')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3">
          <div class="card-header d-flex flex-row align-items-center py-2">
            <h5 class="card-title m-0">
              コメント作成
            </h5>
          </div>
          <div class="card-body pt-0">
            @include('error_card_list')
            <div class="card-text">
              <form method="POST" action="{{ route('comments.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label></label>
                  <textarea name="comment" required class="form-control" rows="10" placeholder="コメント本文">{{ $comment->comment ?? old('comment') }}</textarea>
                  <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                  <input type="hidden" name="thread_id" value="{{ $thread_id }}">
                </div>
                <button type="submit" class="btn btn-block" style="background-color:#26b297; color:#ffffff;">コメント投稿</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection