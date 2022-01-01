@csrf
<div class="form-group">
  <label></label>
  <textarea name="comment" required class="form-control" rows="10" placeholder="投稿内容を書いてください">{{ $comment->comment ?? old('comment') }}</textarea>
  <input type="hidden" name="user_id" value="{{ Auth::id() }}">
  <input type="hidden" name="thread_id" value="{{ $thread_id }}">
</div>
