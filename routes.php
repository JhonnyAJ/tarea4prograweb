<?php
    Route::resource('/', 'HomeController');
    Route::resource('libros', 'LibrosController');
    Route::resource('autores', 'AutoresController');
    Route::resource('editoriales', 'EditorialesController');
    Route::get('/autores/(:number)/delete','AutoresController@destroy');
    Route::get('/editoriales/(:number)/delete','EditorialesController@destroy');
    Route::get('/libros/(:number)/delete','LibrosController@destroy');
    
    Route::dispatch();
?>
