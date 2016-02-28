<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Image;

use App\Http\Requests;

class SearchController extends Controller {
    public function search(Request $request) {
        $city = $request->input('city');
    }
}
