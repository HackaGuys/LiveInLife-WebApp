<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Post;
use App\Image;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;

class ApiController extends Controller
{
    protected $post;

    public function getPosts()
    {
        $city = Input::get('city');

        $posts = Post::where('city', $city)->get();
        $posts->load('images');
        return response()->json($posts);
    }

    public function storePost(Request $request)
    {
        $this->post = new Post();
        $this->post->fill($request);
        $this->post->user_id = 1;

        $this->post->save();
    }
}
