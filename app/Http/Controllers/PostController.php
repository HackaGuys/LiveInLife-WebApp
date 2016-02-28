<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Post;
use App\Image;
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

            foreach ($posts as $post) {
                $image = Image::where('post_id', $post->id)->first();

                if ($image) {
                    $post->thumbnail = $image->thumbnail_filename;
                }
            }

            return view('posts.index', array('posts' => $posts));
        }
        return Redirect::to('login');
    }

    public function show($id) {
        if (Auth::check()) {
            $post = Post::where('id', $id)->first();

            if (!$post) {
                return Redirect::to('post');
            }

            $main_image = Image::where('post_id', $id)->first();
            $images     = Image::where('post_id', $id)->get();

            if($main_image) {
                $post->main_image = $main_image;
                $post->images     = $images;
            }

            return view('posts.show', array('post' => $post));
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
