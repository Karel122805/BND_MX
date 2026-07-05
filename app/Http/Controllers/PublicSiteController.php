<?php

namespace App\Http\Controllers;

use App\Models\HomeSection;

class PublicSiteController extends Controller
{
    public function home()
    {
        $sections = HomeSection::query()
            ->orderBy('id')
            ->get();

        return view('public.home', [
            'sections' => $sections,
        ]);
    }
}