@extends('layouts.public')

@section('content')
<section class="max-w-7xl mx-auto px-6 py-16">
    <h1 class="text-4xl font-bold mb-6">Investigación</h1>

    @if($researchLines->isEmpty())
        <p class="text-lg text-slate-600">
            Próximamente se publicarán las líneas de investigación del proyecto.
        </p>
    @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($researchLines as $line)
                <article class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    @if($line->image)
                        <img
                            src="{{ asset('storage/' . $line->image) }}"
                            alt="{{ $line->title }}"
                            class="w-full h-56 object-cover"
                        >
                    @endif

                    <div class="p-6">
                        <h2 class="text-xl font-bold text-slate-900">
                            {{ $line->title }}
                        </h2>

                        @if($line->description)
                            <p class="text-slate-600 mt-3">
                                {{ $line->description }}
                            </p>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</section>
@endsection