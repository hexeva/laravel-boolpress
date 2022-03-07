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

        // PATH IMMAGINI per ogni post modifichiamo l'attributo 'cover' trasformandolo in un path assoluto con il metodo url()
        // dd($posts[0]->cover);
        foreach($posts as $post){
            // questa operazione la facciamo solo se post->cover non è null
            if($post->cover){
                $post->cover = url('storage/' . $post->cover);
            }
        }
        // dd($post->cover);
            

        $response_array = [
        'success' => true,
        'results' => $posts
        ];

        return response()->json($response_array);
    }

    // Funzione per richiamare il singolo post per slug

    public function show($slug){
        // con il metodo with posso prendermi anche le relazioni collegate a Post 
        $post = Post::where('slug', '=' , $slug)->with(['category','tags'])->first();

        // PATH IMAGINI solo se post->cover non è null
         if($post->cover) {
            $post->cover = url('storage/' . $post->cover);
        }

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
