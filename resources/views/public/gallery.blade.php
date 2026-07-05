@extends('layouts.public')

@section('content')
<section class="max-w-7xl mx-auto px-6 py-16">
    <div class="max-w-3xl mb-10">
        <p class="text-sm font-bold uppercase tracking-wide text-orange-500 mb-3">
            BioBanco Nacional de Demencia
        </p>

        <h1 class="text-4xl md:text-5xl font-black text-slate-950 mb-5">
            Galería
        </h1>

        <p class="text-lg text-slate-600 leading-relaxed">
            Explora imágenes relacionadas con las actividades, espacios, investigación y trabajo institucional del BioBanco.
        </p>
    </div>

    @if($items->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-3">
                Próximamente
            </h2>

            <p class="text-slate-600 leading-relaxed">
                Aún no hay imágenes registradas desde BND Control para esta sección.
            </p>
        </div>
    @else
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($items as $item)
                <article class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    @if(! empty($item->image))
                        <img
                            src="{{ asset('storage/' . $item->image) }}"
                            alt="{{ $item->title ?? 'Imagen de galería' }}"
                            class="w-full h-56 object-cover"
                        >
                    @endif

                    <div class="p-6">
                        @if(! empty($item->title))
                            <h2 class="text-xl font-black text-slate-950">
                                {{ $item->title }}
                            </h2>
                        @endif

                        @if(! empty($item->subtitle))
                            <p class="text-orange-500 text-sm font-bold uppercase tracking-wide mt-2">
                                {{ $item->subtitle }}
                            </p>
                        @endif

                        @if(! empty($item->description))
                            <p class="text-slate-600 mt-3 leading-relaxed">
                                {{ $item->description }}
                            </p>
                        @endif

                        @if(! empty($item->content))
                            <div class="text-slate-600 mt-3 leading-relaxed">
                                {!! $item->content !!}
                            </div>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</section>
@endsection