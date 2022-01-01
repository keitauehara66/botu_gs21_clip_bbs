<ul class="nav nav-tabs nav-justified mt-3">
  <li class="nav-item">
    <a class="nav-link text-muted {{ $hasThreads ? 'active' : '' }}"
       href="{{ route('users.show', ['name' => $user->name]) }}">
       <font size="2">作成した掲示板</font>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-muted {{ $hasBookmarks ? 'active' : '' }}"
       href="{{ route('users.bookmarks', ['name' => $user->name]) }}">
       <font size="2">お気に入り掲示板</font>
    </a>
  </li>
</ul>