@csrf
<div class="md-form">
  <label>タイトル</label>
  <input type="text" name="title" class="form-control" required value="{{ $thread->title ?? old('title') }}">
</div>
<div class="form-group">
  <thread-tags-input
    :initial-tags='@json($tagNames ?? [])'
    :autocomplete-items='@json($allTagNames ?? [])'
  >
  </thread-tags-input>
</div>
<div class="form-group">
  <label></label>
  <textarea name="body" required class="form-control" rows="16" placeholder="掲示板の説明を書いてください">{{ $thread->body ?? old('body') }}</textarea>
</div>
