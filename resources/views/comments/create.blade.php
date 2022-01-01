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
                  <textarea name="comment" required class="form-control" rows="16" placeholder="コメント本文">{{ $comment->comment ?? old('comment') }}</textarea>
                  
                  <div class="form-group pt-3">
                    <label for="inputFile">動画・写真を添付しますか？（任意）</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="inputFile" name="image" accept="image/*, video/*">
                      <label class="custom-file-label" for="inputFile" data-browse="参照"><font color="#808080">ファイル選択または撮影</font></label>
                    </div>
                  </div>
                  
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
