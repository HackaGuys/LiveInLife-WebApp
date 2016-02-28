<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Post;
use App\Image;

use App\Http\Requests;

class ApiController extends Controller
{
    public function index()
    {
    }

    public function getPosts()
    {
        $posts = Post::all();
        $posts->load('images');
        return response()->json($posts);
    }

    public function storePost(Request $request)
    {
        $post = new Post();

        $post->user_id = 1;
        $post->address = $request->input('address');
        $post->city = $request->input('city');
        $post->province = $request->input('province');
        $post->zip = $request->input('zip');
        $post->bedrooms = $request->input('bedrooms');
        $post->sqfeet = $request->input('sqfeet');
        $post->price = $request->input('price');
        $post->description = $request->input('description');

        $post->save();
    }
}
