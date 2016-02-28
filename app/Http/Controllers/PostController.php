<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();
        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $post = new Post();

        $post->address = $request->input('address');
        $post->city = $request->input('city');
        $post->province = $request->input('province');
        $post->zip = $request->input('zip');
        $post->bedrooms = $request->input('bedrooms');
        $post->sqfeet = $request->input('sqfeet');
        $post->price = $request->input('price');

        $post->save();
    }

    public function create(){
        return view('posts/create');
    }
}
