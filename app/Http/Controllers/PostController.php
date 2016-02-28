<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Post;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    protected $post;

    public function __construct(Post $post) {
        $this->post = $post;
    }

    public function index() {
        if (Auth::check()) {
            $posts = Post::all();
            return response()->json($posts);
        }
        return Redirect::to('login');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $this->post->fill($input);
        $this->post->user_id = Auth::user()->id;
        $this->post->images  = $request->file('images');

        if (!$this->post->isValid()) {
            return redirect()->back()->withErrors($this->post->messages);
        }

        $this->post->save();
        $this->post->finalize($this->post->id);

        return redirect('post');
    }

    public function create(){
        if (Auth::check()) {
            return view('posts.create');
        }
        return Redirect::to('login');;
    }
}
