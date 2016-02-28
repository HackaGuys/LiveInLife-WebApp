<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Post;
use App\Image;
use App\User;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    protected $post;
    private   $api_key = "AIzaSyAVsh8KMoQWxdqOYtU-Ft47Bw_ba-9nnFk";

    public function __construct(Post $post) {
        $this->post = $post;
    }

    public function index() {
            $posts = Post::all();

            foreach ($posts as $post) {
                // Format the price
                $post->price = $this->asDollars($post->price);

                // Get the images
                $image = Image::where('post_id', $post->id)->first();

                if ($image) {
                    $post->thumbnail = $image->thumbnail_filename;
                }
            }

            return view('posts.index', array('posts' => $posts));

    }

    public function show($id) {
        if (Auth::check()) {
            $post = Post::where('id', $id)->first();

            // Format the price
            $post->price = $this->asDollars($post->price);

            if (!$post) {
                return Redirect::to('post');
            }

            $main_image = Image::where('post_id', $id)->first();
            $images     = Image::where('post_id', $id)->get();
            $email      = User::where('id', $post->user_id)->first()->email;
            $location   = $this->getCoordinates($post->address, $post->city, $post->province);

            // Get foursquare data
            $json = file_get_contents('https://api.foursquare.com/v2/venues/search?ll=' . $location['lat'] . ',' . $location['lng'] . '&client_id=UDNOKJGW1TZDLVCU5UELS33ERA3MCXCM2U4U2513P3CDJM2K&client_secret=T1NIPNFJZCOFVXEDNXQFE2HZNXJCAG50VWE40AIUP0RKTNPA&v=20160217&limit=5');
            $obj  = json_decode($json);

            $post->venues = $obj->response->venues;

            if($main_image) {
                $post->main_image = $main_image;
                $post->images     = $images;
                $post->email      = $email;
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

    private function asDollars($value) {
        return '$' . number_format($value, 2);
    }

    private function getCoordinates($address, $city, $province) {
        $service_url = 'https://maps.googleapis.com/maps/api/geocode/json?address='
                       . urlencode($address)
                       . ',' . urlencode($city)
                       . ',' . urlencode($province)
                       . '&key=' . $this->api_key;
        $curl = curl_init($service_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        //execute the session
        $curl_response = curl_exec($curl);
        //finish off the session
        curl_close($curl);
        $curl_jason = json_decode($curl_response, true);

        $location = $curl_jason['results'][0]['geometry']['location'];
        return $location;
    }
}
