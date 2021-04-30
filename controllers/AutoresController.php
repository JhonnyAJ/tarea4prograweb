<?php

  // require_once('models/autor/Autor.php');
  // require_once('models/libro/Libro.php');

  class AutoresController extends Controller {   
        
    public function index() {      
      return view('Autores/Autores', ['autores_arr' => DB::table('autores')->get()]);
      //echo 'Hello, World!';
    }
    public function create() { 
      return view('Autores/Create');
    }
    public function show($id) { 
        $autor_arr = DB::table('autores')->where('id',$id)->first();
        $libros_aut = DB::table('libros')->where('author_id',$autor_arr[0]['id'])->get();

        return view('Autores/Show', ['autor_arr' => $autor_arr, 'libros_arr' => $libros_aut]);
    }

    public function edit($id) { 
      $autor_arr =  DB::table('autores')->where('id',$id)->first();
      
      return view('Autores/Edit', ['autor_arr' => $autor_arr]);
    }

    public function update($_,$id)
    {
      $author = Input::get('author');
      $nationality = Input::get('nationality');
      $birth_year = Input::get('birth_year');
      $fields = Input::get('fields');;

      $item = ['author' => $author, 'nationality' => $nationality, 'birth_year' => $birth_year, 'fields' => $fields];
      
      DB::table('autores')->update($id,$item);
     
      return redirect('/autores');
    }

    public function destroy($autor_id) {  
      DB::table('autores')->delete($autor_id);
      return redirect('/autores');
    }

    public function store()
    {
      $author = Input::get('author');
      $nationality = Input::get('nationality');
      $birth_year = Input::get('birth_year');
      $fields = Input::get('fields');;

      $item = ['author' => $author, 'nationality' => $nationality, 'birth_year' => $birth_year, 'fields' => $fields];

      DB::table('autores')->insert($item);
     
      return redirect('/autores');      
    }
    
  }
?>