<?php

  // require_once('models/libro/Libro.php');
  // require_once('models/autor/Autor.php');
  // require_once('models/editorial/Editorial.php');

  class LibrosController extends Controller {
    
    public function index() {      

      $libro_arr = DB::table('libros')->get();

      return view('Libros/Libros', ['libros_arr' => $libro_arr]); 
    }
    public function create() { 
      $authores_arr = DB::table('autores')->get();
      $editoriales_arr = DB::table('editoriales')->get();

      return view('Libros/Create', ['authores_arr' => $authores_arr, 'editoriales_arr' => $editoriales_arr]);
    }
    public function show($id) { 
      $libro_arr = DB::table('libros')->where('id',$id)->first();
      $autor_arr = DB::table('autores')->where('id',$libro_arr[0]['author_id'])->get();
      $editorial_arr = DB::table('editoriales')->where('id',$libro_arr[0]["publisher_id"])->get();
      
      return view('Libros/Show', ['Libro_arr' => $libro_arr, 'Autor_arr' => $autor_arr, 'Editorial_arr' => $editorial_arr, 'edit' => false, 'disabled' => 'disabled']);
    }

    public function edit($id) {
      $libro_arr = DB::table('libros')->where('id',$id)->first();
      $authores_arr = DB::table('autores')->get();
      $editorials_arr = DB::table('editoriales')->get();
            
      return view('Libros/Edit', ['Libro_arr' => $libro_arr, 'authores_arr' => $authores_arr, 'editorials_arr' => $editorials_arr]);
    }

    public function update($_,$id) {

      $title = Input::get('title');
      $edition = Input::get('edition');
      $copyright = Input::get('copyright');
      $language = Input::get('language');
      $pages = Input::get('pages');
      $author_id = Input::get('author_id');
      $publisher_id = Input::get('publisher_id');

      $item = ['title' => $title, 'edition' => $edition, 'copyright' => $copyright, 'language' => $language, 
              'pages' => $pages, 'author_id' => $author_id, 'publisher_id' => $publisher_id];

      DB::table('libros')->update($id,$item);
     
      return redirect('/libros');

    }

    public function destroy($libro_id) {  
      DB::table('libros')->delete($libro_id);
      return redirect('/libros');
    }

    public function store()
    {
      $title = Input::get('title');
      $edition = Input::get('edition');
      $copyright = Input::get('copyright');
      $language = Input::get('language');
      $pages = Input::get('pages');
      $author_id = Input::get('author_id');
      $publisher_id = Input::get('publisher_id');

      $item = ['title' => $title, 'edition' => $edition, 'copyright' => $copyright, 'language' => $language, 
              'pages' => $pages, 'author_id' => $author_id, 'publisher_id' => $publisher_id];

      DB::table('libros')->insert($item);
     
      return redirect('/libros');      
    }

  }

?>