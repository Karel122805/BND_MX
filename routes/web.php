<?php

use App\Models\Authority;
use App\Models\ContactMessage;
use App\Models\Document;
use App\Models\PageContent;
use App\Models\ResearchLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $contents = PageContent::where('page_key', 'inicio')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    return view('public.home', compact('contents'));
})->name('home');

Route::get('/nosotros', function () {
    $contents = PageContent::where('page_key', 'nosotros')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    return view('public.about', compact('contents'));
})->name('about');

Route::get('/autoridades', function () {
    $authorities = Authority::where('is_active', true)
        ->orderBy('sort_order')
        ->orderBy('name')
        ->get();

    return view('public.authorities', compact('authorities'));
})->name('authorities');

Route::get('/documentos', function () {
    $documents = Document::where('is_active', true)
        ->orderByDesc('published_at')
        ->orderBy('title')
        ->get();

    return view('public.documents', compact('documents'));
})->name('documents');

Route::get('/investigacion', function () {
    $researchLines = ResearchLine::where('is_active', true)
        ->orderBy('sort_order')
        ->orderBy('title')
        ->get();

    return view('public.research', compact('researchLines'));
})->name('research');

Route::get('/contacto', function () {
    return view('public.contact');
})->name('contact');

Route::post('/contacto', function (Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'phone' => ['nullable', 'string', 'max:50'],
        'subject' => ['nullable', 'string', 'max:255'],
        'message' => ['required', 'string'],
    ]);

    ContactMessage::create($validated);

    return back()->with('success', 'Tu mensaje fue enviado correctamente.');
})->name('contact.send');