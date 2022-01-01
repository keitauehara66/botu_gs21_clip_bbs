@extends('app')

@section('title', 'スレッド詳細')

@section('content')
  @include('nav-comment')
  <div class="container">

    <div class="card mt-3">
      <div class="card-header d-flex flex-row align-items-center py-2">
        <h6 class="card-title flex-grow-1 m-0">
          <a class="text-dark" href="{{ route('threads.show', ['thread' => $thread]) }}">
            {{ $thread->title }}
          </a>
        </h6>

        <div class="ml-auto card-text p-0">
          <thread-bookmark
            :initial-is-bookmarked-by='@json($thread->isBookmarkedBy(Auth::user()))'
            :initial-count-bookmarks='@json($thread->count_bookmarks)'
            :authorized='@json(Auth::check())'
            endpoint="{{ route('threads.bookmark', ['thread' => $thread]) }}"
          >
          </thread-bookmark>
        </div>
      </div>

      <div class="card-body d-flex flex-row pt-1 pb-1 my-0 align-items-end">
        <h6 class="font-weight-bold my-0"><font size="1">作成者：</font></h6>
        <i class="fas fa-user-circle"></i>
        <h6 class="font-weight-bold ml-2 my-0"><font size="1">{{ $thread->user->name }}</font></h6>
        <h6 class="font-weight-lighter ml-2 my-0"><font size="1">{{ $thread->created_at->format('Y/m/d H:i') }}</font></h6>
      </div>

      @foreach($thread->tags as $tag)
        @if($loop->first)
          <div class="card-body pt-0 py-1 pl-3">
            <div class="card-text line-height">
        @endif
              <a href="{{ route('tags.show', ['tagname' => $tag->tagname]) }}" class="border px-1 mr-1 mt-1 text-muted">
                <font size="2">{{ $tag->hashtag }}</font>
              </a>
        @if($loop->last)
            </div>
          </div>
        @endif
      @endforeach
      
      <div class="card-body pt-2 pb-2">
        <div class="card-text">
          {{ $thread->body }}
        </div>
      </div>
      
      <div class="p-3">
        <h6 class="card-title">コメント一覧</h6>

        @foreach($thread->comments as $comment)
          <div class="card m-1">
            <div class="card-header d-flex flex-row align-items-center py-2 pl-3">
              <h6 class="card-title m-0">
                  <i class="fas fa-user-circle"></i>
                  <h6 class="font-weight-bold ml-2 my-0"><font size="2">{{ $comment->user->name }}</font></h6>
                  <h6 class="font-weight-lighter ml-2 my-0"><font size="1">{{ $comment->created_at->format('Y/m/d H:i') }}</font></h6>
              </h6>
              
              <div class="card-body py-0 pr-3">
                <div class="card-text text-right">
                  <comment-like
                    :initial-is-liked-by='@json($comment->isLikedBy(Auth::user()))'
                    :initial-count-likes='@json($comment->count_likes)'
                    :authorized='@json(Auth::check())'
                    endpoint="{{ route('comments.like', ['comment' => $comment]) }}"
                  >
                  </comment-like>
                </div>
              </div>
              
              @if( Auth::id() === $comment->user_id )
                <!-- dropdown -->
                  <div class="ml-auto card-text">
                    <div class="dropdown">
                      <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route("comments.edit", ['comment' => $comment]) }}">
                          <i class="fas fa-pen mr-1"></i>コメントを更新する
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $comment->id }}">
                          <i class="fas fa-trash-alt mr-1"></i>コメントを削除する
                        </a>
                      </div>
                    </div>
                  </div>
                <!-- dropdown -->
                <!-- modal -->
                  <div id="modal-delete-{{ $comment->id }}" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="POST" action="{{ route('comments.destroy', ['comment' => $comment]) }}">
                          @csrf
                          @method('DELETE')
                          <div class="modal-body">
                            コメントを削除します。よろしいですか？
                          </div>
                          <div class="modal-footer justify-content-between">
                            <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                            <button type="submit" class="btn btn-danger">削除する</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                <!-- modal -->
              @endif
            </div>
            <div class="card-body">
              <div class="card-text">
                {{ $comment->comment }}
              </div>
              @if(isset($comment->image))
              <div class="p-0">
                <iframe width="265" src="{{ asset('storage/image/'.$comment->image) }}" frameborder="0" allowfullscreen></iframe>
              </div>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    </div>
    <a href="{{ route('comments.create', ['thread_id' => $thread->id]) }}" class="btn btn-block mt-3" style="background-color:#26b297; color:#ffffff;">コメント作成</a>
  </div>
@endsection
