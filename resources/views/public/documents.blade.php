@extends('layouts.public')

@section('content')
<section class="max-w-7xl mx-auto px-6 py-16">
    <h1 class="text-4xl font-bold mb-6">Documentos</h1>

    @if($documents->isEmpty())
        <p class="text-lg text-slate-600">
            Próximamente se publicarán documentos oficiales del proyecto.
        </p>
    @else
        <div class="space-y-4">
            @foreach($documents as $document)
                <article class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">
                                {{ $document->title }}
                            </h2>

                            @if($document->category)
                                <p class="text-sm text-blue-700 font-semibold mt-1">
                                    {{ $document->category }}
                                </p>
                            @endif

                            @if($document->description)
                                <p class="text-slate-600 mt-3">
                                    {{ $document->description }}
                                </p>
                            @endif

                            @if($document->published_at)
                                <p class="text-sm text-slate-500 mt-3">
                                    Publicado: {{ \Carbon\Carbon::parse($document->published_at)->format('d/m/Y') }}
                                </p>
                            @endif
                        </div>

                        @if($document->file_path)
                            <a
                                href="{{ asset('storage/' . $document->file_path) }}"
                                target="_blank"
                                class="inline-flex justify-center bg-blue-700 text-white px-5 py-3 rounded-lg font-semibold hover:bg-blue-800"
                            >
                                Ver documento
                            </a>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</section>
@endsection