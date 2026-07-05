@extends('layouts.public')

@section('content')
<section class="max-w-7xl mx-auto px-6 py-20">
    <div class="max-w-4xl">
        <p class="text-blue-700 font-semibold mb-4">
            BioBanco Nacional de Demencia
        </p>

        <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-6">
            Plataforma para la gestión, investigación y consulta de información sobre demencia.
        </h1>

        <p class="text-lg text-slate-600 mb-8">
            El sitio público del BioBanco Nacional de Demencia presenta información institucional,
            documentos, autoridades e investigación relacionada con el proyecto.
        </p>

        <a href="{{ route('about') }}" class="inline-flex bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800">
            Conocer más
        </a>
    </div>
</section>

@if($contents->isNotEmpty())
<section class="max-w-7xl mx-auto px-6 py-12">
    <div class="grid md:grid-cols-2 gap-6">
        @foreach($contents as $content)
            <article class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                @if($content->image)
                    <img
                        src="{{ asset('storage/' . $content->image) }}"
                        alt="{{ $content->title }}"
                        class="w-full h-56 object-cover rounded-xl mb-4"
                    >
                @endif

                @if($content->title)
                    <h2 class="text-2xl font-bold text-slate-900 mb-3">
                        {{ $content->title }}
                    </h2>
                @endif

                @if($content->subtitle)
                    <p class="text-blue-700 font-semibold mb-3">
                        {{ $content->subtitle }}
                    </p>
                @endif

                @if($content->content)
                    <p class="text-slate-600 leading-relaxed">
                        {{ $content->content }}
                    </p>
                @endif
            </article>
        @endforeach
    </div>
</section>
@endif
@endsection