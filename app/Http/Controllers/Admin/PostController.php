<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Exists;
// includo la classe per l'upload delle immagini
use Illuminate\Support\Facades\Storage;
// includo la facades per le MAIL e l'oggetto Mail
use Illuminate\Support\Facades\Mail;
use App\Mail\NewPostAdminNotification;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(9);

        $data = [
            'posts'=>$posts
        ];

        return view('admin.posts.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::all();
        $tags = Tag::all();
        $data =[
            'categories' => $categories,
            'tags' => $tags
        ];
        return view('admin.posts.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_data = $request->all();
        $request->validate($this->getValidate());
        // creo il nuovo post
        $new_post = new Post();
        $new_post->fill($form_data);
        $new_post->slug = $this->getUniqueSlugFromTitle($form_data['title']);

        // GESTISCO IMMAGINI DEL POST (solo se esiste la chiave image in form_data altrimenti la chiave non esisterà proprio e avrà errore)
        if(isset($form_data['image'])){
            // 1 - MEttere immagine caricata nella cartella storage ($img_path sarà una stringa ritornata dal metodo put che contiene il path dell'immagine)
            $img_path = Storage::put('post_covers',$form_data['image']);
            // 2- Salvo nella colonna del database il path dell'immagine
            $new_post->cover = $img_path;
        }
        
        $new_post->save();

        // creo il record della tabella ponte per relazione tra post e tags e verifico che effettivamente form_data['tags] esista
        if(array_key_exists("tags",$form_data)){
        $new_post->tags()->sync($form_data['tags']);
        }
    
        // STRINGA PER L'INVIO DELLA MAIL ALL'ADMIN per notifica di un nuovo post inserito
        Mail::to('editor@boolpress.it')->send(new NewPostAdminNotification($new_post));

        return redirect()->route('admin.posts.show',['post'=>$new_post->id]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        // dd($post->tags);
        $data = [
            'post'=>$post
        ];
        return view('admin.posts.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $post = Post::findOrFail($id);
        $tags = Tag::all();

        $data=[
            'post'=>$post,
            'categories'=>$categories,
            'tags'=>$tags
        ];


        return view('admin.posts.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $form_data = $request->all();
        $request->validate($this->getValidate());

        $post = Post::findOrFail($id);
        
        // FAccio una modifica dello slug solo se l'utente modifica effettivamente il titolo
        if($form_data['title'] != $post->title) {
            $form_data['slug'] = $this->getUniqueSlugFromTitle($form_data['title']);
        }

        // PATH IMMAGINI se esiste la chiave form_data image 
        if($form_data['image']){
            // 1- rimuovo la vecchia immagine 
            if($post->cover){
                Storage::delete($post->cover);
            }
            // 2 - eseguo l'upload del nuovo file
            $img_path = Storage::put('post_covers',$form_data['image']);
            // 3 - salvo nella colonna cover della tabella il nuovo path dell'immagine
            $form_data['cover'] = $img_path;
        }
        
        $post->update($form_data);
        // sincronizzo la collection post->tags con i dati passati dal form. In questo caso i tags
        
        // se esiste la chiave tags di form data allora:
            if(isset($form_data['tags'])){
                $post->tags()->sync($form_data['tags']);
                // altrimenti se l'utente non seleziona alcun tag, la chiave tags sarà null e  sincronizzo un array vuoto
            }else{
                $post->tags()->sync([]);
            }

        return redirect()->route('admin.posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::FindOrFail($id);
        // prima di cancellare devo eliminare tutte le relazioni tra tabelle
        $post->tags()->sync([]);
        // cancello anche i file di storage se ci sono
        if($post->cover){
            Storage::delete($post->cover);
        }
        $post->delete();
        return redirect()->route('admin.posts.index');
    }


    // funzione per la validazione dati 
    protected function getValidate(){
        return [
            'title'=>'required|max:255',
            'content'=>'required|max:60000',
            // validazione per relazione tra category e posts con exists specifico che category_id esiste dentro category e corrisponde all'id
            'category_id'=>'exists:categories,id|nullable',
            // valido anche tags 
            'tags'=>'exists:tags,id',
            // valido anche le immagini con image (specifica che i file devono essere jpeg,svg,png...)
            'image'=>'image|max:800'
        ];
    }

    // funzione per generare uno slug univoco
    protected function getUniqueSlugFromTitle($title) {
        // Controlliamo se esiste già un post con questo slug.
        $slug = Str::slug($title);
        
        $slug_base = $slug;
        
        $post_found = Post::where('slug', '=', $slug)->first();
        $counter = 1;
        while($post_found) {
            // Se esiste, aggiungiamo -1 allo slug
            // ricontrollo che non esista lo slug con -1, se esiste provo con -2
            $slug = $slug_base . '-' . $counter;
            $post_found = Post::where('slug', '=', $slug)->first();
            $counter++;
        }

        return $slug;
    }
}


