<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Potrzebne do dostania się do storage gdzie jest obrazek:
use Illuminate\Support\Facades\Storage;

//aby używać funkcji w modelu Posts musimy go dodać:
use App\Post;

//Aby używać zapytań SQL
use DB;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //blokowanie jeżeli użytkownik nie przejdzie autoryzacji wtedy wysyla go do strony z logowaniem
        //wyjątkami są strony index, gdzie wysiwetlane są posty, oraz show gdzie po kliknięciu przechodzi się do posta
        $this->middleware('auth', ['except'=>['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dostarcza wszystkich danych do Kontrolera

        // $posts = Post::all(); //wstawia wszystko do zmiennej posts
        //$posts = Post::where('title','Post Two')->get(); //pobiera z bazy post w którym tytuł = Post Two
       // $posts = DB::select('SELECT * FROM posts'); //dodatkowo należy dodać klasę bazy //use DB;
       // $posts = Post::orderBy('title','desc')->take(1)->get(); //pobiera z bazy 1 element posortowane po tytule malejąco
        //$posts = Post::orderBy('title','desc')->get(); //pobiera z bazy posortowane po tytule malejąco

        //PAGINATION
        $posts = Post::orderBy('created_at','desc')->paginate(10); //pobiera z bazy posortowane po tytule malejąco i spaginowany po 10 element na stronę




        //wyswietlenie kontentu strony /posts ktory znajduje sie w resources/posts/index
        //razem ze zmienną $posts, w której znajdują się wszystkie rzeczy z modelu Post(tabela posts)
        return view('posts.index')->with('posts', $posts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',   //jest wymagane
            'cover_image' => 'image|nullable|max:1999' //ustawienie że mają to być obrazki, może być puste, max 2mb

        ]);

        //jezeli jest wrzucane zdjęcie
        if($request->hasFile('cover_image')){
//Pobrani nazwy z rozszerzeniem:

            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();

            //Pobierz rozszerzenie obrazka
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Pobierz nazwe obrazka bez rozszerzenia
            $extension = $request->file('cover_image')->GetClientOriginalExtension();

            //nazwa do zapisania:
            $fileNameToStore=$filename."_".time().'.'.$extension;             //nazwa_czas.rozszerzenie

            //ścieżka do zapisania to: public/cover_image/nazwapliku
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);

        }else{
            $fileNameToStore='noimage.jpg'; //ustawini basicowej grafiki
        }

        //Tworzymy nowy post:
        $post = new Post;
        $post->title=$request->input('title');
        $post->body=$request->input('body');

        $post->cover_image = $fileNameToStore; //dodawanie do bazy danych


        $post->user_id = auth()->user()->id; //pobieramy user-id poczym dodajemy go do kolumny

        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //wyswitla rzeczy zwiazane z konkretnym postem o i $id
        $post = Post::find($id);
        return view ('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        //Check for correct user:
        if(auth()->user()->id !=$post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized page');
        }

        return view ('posts.edit')->with('post', $post);

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
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required'   //jest wymagane
        ]);


        //jezeli jest wrzucane zdjęcie
        if($request->hasFile('cover_image')){
//Pobrani nazwy z rozszerzeniem:

            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();

            //Pobierz rozszerzenie obrazka
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Pobierz nazwe obrazka bez rozszerzenia
            $extension = $request->file('cover_image')->GetClientOriginalExtension();

            //nazwa do zapisania:
            $fileNameToStore=$filename."_".time().'.'.$extension;             //nazwa_czas.rozszerzenie

            //ścieżka do zapisania to: public/cover_image/nazwapliku
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);

        }

        //Edytujemy istniejący post:
        $post = Post::find($id); //należy wyszukać po id dany post.
        $post->title=$request->input('title');
        $post->body=$request->input('body');

        //jezeli jest obrazek to dodaj jak nie to nie.
        if($request->hasFile('cover_image')) {
            $post->cover_image=$fileNameToStore;
        }

        $post->save();

        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $post = Post::find($id); //należy wyszukać po id dany post.

        if(auth()->user()->id !=$post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized page');
        }

        if($post->cover_image!='noimage.jpg'){ //jezeli obrazek nie jest template obrazkiem
//usun obrazek wrzucony przez użytkownika

            Storage::delete('public/cover_images/'.$post->cover_image); //usun plik.
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Post Remove');

    }
}
