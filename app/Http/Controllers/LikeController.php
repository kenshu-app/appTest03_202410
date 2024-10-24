<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index()
    {
        $books = \Auth::user()->likeBooks()->orderBy('created_at', 'desc')->get();
        return view('likes.index', ['books' => $books]);
    }

    public function store(Request $request)
    {
        \Auth::user()->likeBooks()->attach($request->book_id);
        return back();
    }

    public function destroy(Request $request)
    {
        \Auth::user()->likeBooks()->detach($request->book_id);
        return back();
    }
}
