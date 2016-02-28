<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Image;

use App\Http\Requests;

class SearchController extends Controller {
    public function search(Request $request) {
        $city = ucwords($request->input('city'));
        $province = ucwords($request->input('province'));

        $posts = Post::where('city', $city)->get();

        if (count($posts) == 0) {
            return view('search.error', array('message' => 'There are currently no postings for ' . $city . ', ' . $province));
        }

        foreach ($posts as $post) {
            // Format the price
            $post->price = $this->asDollars($post->price);

            // Get the images
            $image = Image::where('post_id', $post->id)->first();

            if ($image) {
                $post->thumbnail = $image->thumbnail_filename;
            }
        }

        return view('search.search', array('posts' => $posts, 'city' => $city, 'province' => $province));
    }

    private function asDollars($value) {
        return '$' . number_format($value, 2);
    }
}
