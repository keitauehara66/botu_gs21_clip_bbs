<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(string $tagname)
    {
        $tag = Tag::where('tagname', $tagname)->first();

        return view('tags.show', ['tag' => $tag]);
    }
}
