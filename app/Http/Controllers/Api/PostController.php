<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index(){
        $posts = Post::paginate(9);
        // dd($posts);

        $response_array = [
        'success' => true,
        'results' => $posts
        ];

        return response()->json($response_array);
    }

    // Funzione per richiamare il singolo post per slug

    public function show($slug){
        $post = Post::where('slug', '=' , $slug)->first();
        // se torna i post con lo slug che richiedo allora...
        if($post){
        return response()->json([
            'success'=> true,
            'results'=> $post
        ]);
        // altrimenti response array vuoto
        }else{
            return response()->json([
            'success'=> false,
            'results'=> []
            ]);
        }

    }
}
