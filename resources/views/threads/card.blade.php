<div class="card mt-3">
  <div class="card-body d-flex flex-row">
    <i class="fas fa-user-circle fa-3x mr-1"></i>
    <div>
      <div class="font-weight-bold">{{ $thread->user->name }}</div>
      <div class="font-weight-lighter">{{ $thread->created_at->format('Y/m/d H:i') }}</div>
    </div>

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
  <div class="card-body pt-0">
    <h3 class="h4 card-title">
      <a class="text-dark" href="{{ route('threads.show', ['thread' => $thread]) }}">
        {{ $thread->title }}
      </a>
    </h3>
    <div class="card-text">
      {{ $thread->body }}
    </div>
  </div>
  <div class="card-body pt-0 pb-2 pl-3">
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
  @foreach($thread->tags as $tag)
    @if($loop->first)
      <div class="card-body pt-0 pb-4 pl-3">
        <div class="card-text line-height">
    @endif
          <a href="{{ route('tags.show', ['tagname' => $tag->tagname]) }}" class="border p-1 mr-1 mt-1 text-muted">
            {{ $tag->hashtag }}
          </a>
    @if($loop->last)
        </div>
      </div>
    @endif
  @endforeach
</div>
