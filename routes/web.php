<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'public.home')->name('home');

Route::view('/nosotros', 'public.about')->name('about');

Route::view('/autoridades', 'public.authorities')->name('authorities');

Route::view('/documentos', 'public.documents')->name('documents');

Route::view('/investigacion', 'public.research')->name('research');

Route::view('/contacto', 'public.contact')->name('contact');