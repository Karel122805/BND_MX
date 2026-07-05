@extends('layouts.public')

@section('content')
<section class="max-w-7xl mx-auto px-6 py-16">
    <h1 class="text-4xl font-bold mb-6">Nosotros</h1>

    @if($contents->isEmpty())
        <p class="text-lg text-slate-600 max-w-3xl">
            El BioBanco Nacional de Demencia es una plataforma orientada a organizar información,
            apoyar procesos de investigación y facilitar la administración de datos relacionados con la demencia.
        </p>
    @else
        <div class="space-y-6">
            @foreach($contents as $content)
                <article class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    @if($content->image)
                        <img
                            src="{{ asset('storage/' . $content->image) }}"
                            alt="{{ $content->title }}"
                            class="w-full h-72 object-cover rounded-xl mb-4"
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
    @endif
</section>
@endsection