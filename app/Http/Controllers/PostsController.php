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
//        var_dump($posts);
        return response()->json($posts);
    }

    public function getPosts(){
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

        

//
//        INSERT INTO posts (address, city, province, zip, bedrooms, sqfeet, price, created_at, updated_at)
//VALUES ('1234 Something Street','Vancouver', 'BC','V1V1V1',2,10000,9999, NULL, NULL );

//        DB::insert('INSERT INTO posts (address, city, province, zip, bedrooms, sqfeet, price, created_at, updated_at)
//                    values (?, ?, ?, ?, ?, ?, ?, ?, ?)',
//                                [
//                                    $address,
//                                    $city,
//                                    $province,
//                                    $zip,
//                                    $bedrooms,
//                                    $sqfeet,
//                                    $price,
//                                    NULL,
//                                    NULL
//                                ]);

    }
}
