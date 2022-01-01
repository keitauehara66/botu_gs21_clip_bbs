@extends('app')

@section('title', '掲示板一覧')

@section('content')
  @include('nav')
  <div class="container">
    <!-- 検索バー -->
    <form class="form-inline d-flex justify-content-center md-form form-sm mt-3 mb-0" action="{{ route('threads.search') }}" method="get">
        @csrf
        <input class="form-control form-control-sm mt-1 py-1 w-75" type="text" placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-default btn-sm mt-1" type="submit">
            <i class="fas fa-search fa-lg" aria-hidden="true"></i>
        </button>
    </form>
    
    @isset($search_result)
      <h6 class="form-inline d-flex justify-content-center md-form form-sm my-2"><font size="2">{{ $search_result }}</font></h6>
    @endisset
    
    @foreach($threads as $thread)
      @include('threads.card') 
    @endforeach
    
    @if(isset($search_query))
      {{ $threads->appends(['search' => $search_query ])->links('vendor.pagination.clip-bbs') }}
    @else
      {{ $threads->links('vendor.pagination.clip-bbs') }}
    @endif
  </div>
@endsection
