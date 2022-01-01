<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Thread;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment');
    }
    
    public function index()
    {
        //
    }

    public function create(Thread $thread, Comment $comment)
    {
        $q = \Request::query();
        return view('comments.create', [
            'thread_id' => $q['thread_id'],
            'thread' => $thread,
            'comment' => $comment,
        ]);
    }

    public function store(CommentRequest $request, Comment $comment)
    {
        if(is_null($request->image)){
            $comment->fill($request->all());
            // allメソッドを使うことでPOSTリクエストのパラメータを配列で取得し、
            // モデルファイル（Comment.php）のfillableプロパティで指定したパラメータのみが$commentに代入される
            $comment->user_id = $request->user_id;
            $comment->thread_id = $request->thread_id;
            $comment->save();

        }elseif($request->file('image')->isValid()){
            $comment->fill($request->all());
            // allメソッドを使うことでPOSTリクエストのパラメータを配列で取得し、
            // モデルファイル（Comment.php）のfillableプロパティで指定したパラメータのみが$commentに代入される
            $comment->user_id = $request->user_id;
            $comment->thread_id = $request->thread_id;

            $filename = $request->file('image')->store('public/image');
            $file = $request->file('image');
            //アスペクト比を維持、画像サイズを横幅360pxにして保存する。
            // InterventionImage::make($file)->resize(360, null, function ($constraint) {$constraint->aspectRatio();})->save(storage_path('app/'.$filename));

            $comment->image = basename($filename);
            $comment->save();
        }
        
        return redirect('/threads/'.$comment->thread_id);
    }

    public function edit(Comment $comment)
    {
        return view('comments.edit', [
            'comment' => $comment,
        ]);
    }

    public function update(CommentRequest $request, Comment $comment)
    {
        $comment->fill($request->all())->save();
        
        return redirect('/threads/'.$comment->thread_id);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect('/threads/'.$comment->thread_id);
    }

    public function show(Thread $thread, Comment $comment)
    {
        //
    }
    
    public function like(Request $request, Comment $comment)
    {
        $comment->likes()->detach($request->user()->id);
        $comment->likes()->attach($request->user()->id);

        return [
            'id' => $comment->id,
            'countLikes' => $comment->count_likes,
        ];
    }

    public function unlike(Request $request, Comment $comment)
    {
        $comment->likes()->detach($request->user()->id);

        return [
            'id' => $comment->id,
            'countLikes' => $comment->count_likes,
        ];
    }
}
