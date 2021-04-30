<?php

  class EditorialesController extends Controller {
       
    public function index() {      
      return view('Editoriales/Editoriales', ['editoriales_arr' => DB::table('editoriales')->get()]); 
    }
    public function create() { 
      return view('Editoriales/Create');
    }
    public function show($id) { 
      $editorial_arr = DB::table('editoriales')->where('id',$id)->first();
      $libros_edit = DB::table('libros')->where('id',$editorial_arr[0]['publisher_id'])->get();
      
      return view('Editoriales/Show', ['editorial_arr' => $editorial_arr, 'libros_arr' => $libros_edit]);
    }

    public function edit($id) {
      $editorial_arr = DB::table('editoriales')->where('id',$id)->first();
      
      return view('Editoriales/Edit', ['Editorial_arr' => $editorial_arr]);
    }

    public function update($_,$id) {

      $publisher = Input::get('publisher');
      $country = Input::get('country');
      $founded = Input::get('founded');
      $genere = Input::get('genere');

      $item = ['publisher' => $publisher, 'country' => $country, 'founded' => $founded, 'genere' => $genere];

      DB::table('editoriales')->update($id,$item);
     
      return redirect('/editoriales');

    }

    public function destroy($editorial_id) {  
      DB::table('editoriales')->delete($editorial_id);
      return redirect('/editoriales');
    }

    public function store()
    {
      $publisher = Input::get('publisher');
      $country = Input::get('country');
      $founded = Input::get('founded');
      $genere = Input::get('genere');

      $item = ['publisher' => $publisher, 'country' => $country, 'founded' => $founded, 'genere' => $genere];

      DB::table('editoriales')->insert($item);
     
      return redirect('/editoriales');      
    }
    
  }

?>