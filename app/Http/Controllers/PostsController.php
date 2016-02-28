<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Http\Requests;

class PostsController extends Controller
{
    public function index()
    {
        $posts = DB::select('select * from posts');
        return response()->json($posts);
    }


    public function store(Request $request)
    {
        $address = $request->input('address');
        $city = $request->input('city');
        $province = $request->input('province');
        $zip = $request->input('zip');
        $bedrooms = $request->input('bedrooms');
        $sqfeet = $request->input('sqfeet');
        $price = $request->input('price');


        DB::insert('INSERT INTO posts (address, city, province, zip, bedrooms, sqfeet, price, created_at, updated_at)
                    values (?, ?, ?, ?, ?, ?, ?, ?, ?)',
                                [
                                    $address,
                                    $city,
                                    $province,
                                    $zip,
                                    $bedrooms,
                                    $sqfeet,
                                    $price,
                                    NULL,
                                    NULL
                                ]);

    }

    public function create(){
        return view('posts/create');
    }
}
