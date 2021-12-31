<div class="card mt-3">
  <div class="card-header d-flex flex-row align-items-center py-2">
    <h6 class="card-title m-0">
      <a class="text-dark" href="{{ route('threads.show', ['thread' => $thread]) }}">
        {{ $thread->title }}
      </a>
    </h6>
    
    @if( Auth::id() === $thread->user_id )
      <!-- dropdown -->
        <div class="ml-auto card-text">
          <div class="dropdown">
            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="{{ route("threads.edit", ['thread' => $thread]) }}">
                <i class="fas fa-pen mr-1"></i>スレッドを更新する
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $thread->id }}">
                <i class="fas fa-trash-alt mr-1"></i>スレッドを削除する
              </a>
            </div>
          </div>
        </div>
      <!-- dropdown -->
      <!-- modal -->
        <div id="modal-delete-{{ $thread->id }}" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form method="POST" action="{{ route('threads.destroy', ['thread' => $thread]) }}">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                  {{ $thread->title }}を削除します。よろしいですか？
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

  <div class="card-body py-2">
    <div class="card-text text-truncate">
      {{ $thread->body }}
    </div>
  </div>

  <div class="card-body d-flex flex-row py-1 my-0 align-items-end">
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
  
  <div class="card-body pt-0 py-2 pl-3">
    <div class="card-text">
      <thread-bookmark
        :initial-is-bookmarked-by='@json($thread->isBookmarkedBy(Auth::user()))'
        :initial-count-bookmarks='@json($thread->count_bookmarks)'
        :authorized='@json(Auth::check())'
        endpoint="{{ route('threads.bookmark', ['thread' => $thread]) }}"
      >
      </thread-bookmark>
    </div>
  </div>

</div>
