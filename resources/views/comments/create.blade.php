@extends('app')

@section('title', '投稿作成')

@include('nav')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3">
          <div class="card-header d-flex flex-row align-items-center py-2">
            <h5 class="card-title m-0">
              投稿作成
            </h5>
          </div>
          <div class="card-body pt-0">
            @include('error_card_list')
            <div class="card-text">
              <form method="POST" action="{{ route('comments.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label></label>
                  <textarea name="comment" required class="form-control" rows="16" placeholder="投稿内容を書いてください">{{ $comment->comment ?? old('comment') }}</textarea>
                  
                  <div class="form-group pt-3 m-0">
                    <label for="inputFile" class="py-1 m-0">動画・写真を添付しますか？（任意）</label>
                    <div class="d-flex justyify-content-center">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="videoUpload" name="video" accept="video/*" capture="camera" style="display:none">
                        <button class="btn-light btn-block p-2" id="videoUploadButton"><span class="ed-btn-text"><i class="fas fa-video mr-1"></i>動画を添付</span></button>
                      </div>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="imageUpload" name="image" accept="image/*" capture="camera" style="display:none">
                        <button class="btn-light btn-block p-2" id="imageUploadButton"><span class="ed-btn-text"><i class="fas fa-camera mr-1"></i>写真を添付</span></button>
                      </div>
                    </div>
                  </div>
                  <div class="form-group pt-1 m-0">
                    <div class="d-flex justyify-content-center">
                      <div class="custom-file py-1 h-50">
                        <p class="m-0" id="videoUploadfile"><font size="1">ファイルが選択されていません</font></p>
                      </div>
                      <div class="custom-file py-1 h-50">
                        <p class="m-0" id="imageUploadfile"><font size="1">ファイルが選択されていません</font></p>
                      </div>
                    </div>
                  </div>
                  
                  <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                  <input type="hidden" name="thread_id" value="{{ $thread_id }}">
                </div>
                <button type="submit" class="btn btn-block" style="background-color:#26b297; color:#ffffff;">投稿する</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
