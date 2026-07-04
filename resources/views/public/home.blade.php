@extends('layouts.public')

@section('content')
<section class="max-w-7xl mx-auto px-6 py-20">
    <div class="max-w-3xl">
        <p class="text-blue-700 font-semibold mb-4">BioBanco Nacional de Demencia</p>

        <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-6">
            Plataforma para la gestión, investigación y consulta de información sobre demencia.
        </h1>

        <p class="text-lg text-slate-600 mb-8">
            Este sitio será la página pública del proyecto BND. Desde aquí se mostrará información general,
            objetivos, secciones informativas y acceso al panel administrativo BND Control.
        </p>

        <div class="flex gap-4">
            <a href="{{ route('about') }}" class="bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800">
                Conocer más
            </a>

        </div>
    </div>
</section>
@endsection