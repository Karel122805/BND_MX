@extends('layouts.public')

@section('content')
<section class="max-w-7xl mx-auto px-6 py-16">
    <div class="max-w-3xl mb-10">
        <p class="text-sm font-bold uppercase tracking-wide text-orange-500 mb-3">
            BioBanco Nacional de Demencia
        </p>

        <h1 class="text-4xl md:text-5xl font-black text-slate-950 mb-5">
            Nosotros
        </h1>

        <p class="text-lg text-slate-600 leading-relaxed">
            El BioBanco Nacional de Demencia es una plataforma orientada a organizar información,
            apoyar procesos de investigación y facilitar la administración de datos relacionados con
            demencias y donación de tejido cerebral.
        </p>
    </div>

    @if($sections->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-3">
                Información institucional
            </h2>

            <p class="text-slate-600 leading-relaxed">
                Aún no hay secciones registradas desde BND Control para esta página.
            </p>
        </div>
    @else
        <div class="grid md:grid-cols-2 gap-8">
            @foreach($sections as $section)
                <article class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    @if(! empty($section->image))
                        <img
                            src="{{ asset('storage/' . $section->image) }}"
                            alt="{{ $section->title ?? 'Imagen de nosotros' }}"
                            class="w-full h-64 object-cover rounded-xl mb-5"
                        >
                    @endif

                    @if(! empty($section->subtitle))
                        <p class="text-orange-500 text-sm font-bold uppercase tracking-wide mb-2">
                            {{ $section->subtitle }}
                        </p>
                    @endif

                    @if(! empty($section->title))
                        <h2 class="text-2xl font-black text-slate-950 mb-3">
                            {{ $section->title }}
                        </h2>
                    @endif

                    @if(! empty($section->content))
                        <div class="text-slate-600 leading-relaxed">
                            {!! $section->content !!}
                        </div>
                    @endif
                </article>
            @endforeach
        </div>
    @endif
</section>
@endsection