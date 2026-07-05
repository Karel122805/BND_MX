<?php

use App\Models\AboutSection;
use App\Models\Authority;
use App\Models\ContactMessage;
use App\Models\ContactSetting;
use App\Models\Document;
use App\Models\GalleryItem;
use App\Models\HomeSection;
use App\Models\ResearchSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $sections = HomeSection::query()
        ->with([
            'backgroundMediaAsset',

            'textColor',
            'accentColor',
            'tertiaryColor',

            'titlePart1Color',
            'titlePart2Color',
            'titlePart3Color',

            'subtitleTextColor',
            'subtitleBorderColor',
            'subtitleBackgroundColor',

            'stat1Color',
            'stat2Color',
            'stat3Color',
            'stat4Color',

            'primaryButtonColor',
            'primaryButtonTextColor',
            'primaryButtonHoverColor',
            'primaryButtonHoverTextColor',
            'primaryButtonIconColor',
            'primaryButtonHoverIconColor',

            'secondaryButtonColor',
            'secondaryButtonTextColor',
            'secondaryButtonHoverColor',
            'secondaryButtonHoverTextColor',
            'secondaryButtonIconColor',
            'secondaryButtonHoverIconColor',
        ])
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->orderBy('id')
        ->get();

    return view('public.home', [
        'sections' => $sections,
    ]);
})->name('home');

Route::get('/nosotros', function () {
    $sections = AboutSection::query()
        ->orderBy('id')
        ->get();

    return view('public.about', [
        'sections' => $sections,
    ]);
})->name('about');

Route::get('/autoridades', function () {
    $authorities = Authority::query()
        ->orderBy('id')
        ->get();

    return view('public.authorities', [
        'authorities' => $authorities,
    ]);
})->name('authorities');

Route::get('/galeria', function () {
    $items = GalleryItem::query()
        ->orderBy('id')
        ->get();

    return view('public.gallery', [
        'items' => $items,
    ]);
})->name('gallery');

Route::get('/investigacion', function () {
    $sections = ResearchSection::query()
        ->orderBy('id')
        ->get();

    return view('public.research', [
        'sections' => $sections,
    ]);
})->name('research');

Route::get('/documentos', function () {
    $documents = Document::query()
        ->orderBy('id')
        ->get();

    return view('public.documents', [
        'documents' => $documents,
    ]);
})->name('documents');

Route::get('/contacto', function () {
    $setting = ContactSetting::query()
        ->first();

    return view('public.contact', [
        'setting' => $setting,
    ]);
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