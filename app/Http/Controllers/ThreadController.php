<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Tag;
use App\Comment;
use App\Http\Requests\ThreadRequest;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Thread::class, 'thread');
    }
    
    public function index()
    {
        $q = \Request::query();
        $threads = Thread::latest()->paginate(20);
        $threads->load('user');        
 
        return view('threads.index', [
            'threads' => $threads,
        ]);
    }

    public function create()
    {
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->tagname];
        });

        return view('threads.create', [
            'allTagNames' => $allTagNames,
        ]);
    }

    public function store(ThreadRequest $request, Thread $thread)
    {
        $thread->fill($request->all());
        // allメソッドを使うことでPOSTリクエストのパラメータを配列で取得し、
        // モデルファイル（Thread.php）のfillableプロパティで指定したパラメータのみが$threadに代入される
        $thread->user_id = $request->user()->id;
        $thread->save();
        
        $request->tags->each(function ($tagName) use ($thread) {
            $tag = Tag::firstOrCreate(['tagname' => $tagName]);
            $thread->tags()->attach($tag);
        });
        
        return redirect()->route('threads.index');
    }

    public function edit(Thread $thread)
    {
        $tagNames = $thread->tags->map(function ($tag) {
            return ['text' => $tag->tagname];
        });
        
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->tagname];
        });
        
        return view('threads.edit', [
            'thread' => $thread,
            'tagNames' => $tagNames,
            'allTagNames' => $allTagNames,
        ]);
    }

    public function update(ThreadRequest $request, Thread $thread)
    {
        $thread->fill($request->all())->save();
        
        $thread->tags()->detach();
        $request->tags->each(function ($tagName) use ($thread) {
            $tag = Tag::firstOrCreate(['tagname' => $tagName]);
            $thread->tags()->attach($tag);
        });
        
        return redirect()->route('threads.index');
    }

    public function destroy(Thread $thread)
    {
        $thread->delete();
        return redirect()->route('threads.index');
    }

    public function show(Thread $thread, Comment $comment)
    {
        return view('threads.show', [
            'thread' => $thread,
            'comment' => $comment,
        ]);
    }
    
    public function bookmark(Request $request, Thread $thread)
    {
        $thread->bookmarks()->detach($request->user()->id);
        $thread->bookmarks()->attach($request->user()->id);

        return [
            'id' => $thread->id,
            'countBookmarks' => $thread->count_bookmarks,
        ];
    }

    public function unbookmark(Request $request, Thread $thread)
    {
        $thread->bookmarks()->detach($request->user()->id);

        return [
            'id' => $thread->id,
            'countBookmarks' => $thread->count_bookmarks,
        ];
    }
    
    public function search(Request $request)
    {
        $threads = Thread::where('title', 'like', "%{$request->search}%")
                    ->orwhere('body', 'like', "%{$request->search}%")
                    ->paginate(20);

        $search_result = $request->search.'　の検索結果'.$threads->total().'件';

        return view('threads.index', [
            'threads' => $threads,
            'search_result' => $search_result,
            'search_query' => $request->search,
        ]);
    }
}
