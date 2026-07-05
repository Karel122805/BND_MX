@extends('layouts.public')

@section('content')
<section class="max-w-7xl mx-auto px-6 py-16">
    <h1 class="text-4xl font-bold mb-6">Autoridades</h1>

    @if($authorities->isEmpty())
        <p class="text-lg text-slate-600">
            Próximamente se publicará la información de las autoridades del proyecto.
        </p>
    @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($authorities as $authority)
                <article class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    @if($authority->photo)
                        <img
                            src="{{ asset('storage/' . $authority->photo) }}"
                            alt="{{ $authority->name }}"
                            class="w-full h-56 object-cover rounded-xl mb-4"
                        >
                    @endif

                    <h2 class="text-xl font-bold text-slate-900">
                        {{ $authority->name }}
                    </h2>

                    @if($authority->position)
                        <p class="text-blue-700 font-semibold mt-1">
                            {{ $authority->position }}
                        </p>
                    @endif

                    @if($authority->institution)
                        <p class="text-sm text-slate-500 mt-1">
                            {{ $authority->institution }}
                        </p>
                    @endif

                    @if($authority->description)
                        <p class="text-slate-600 mt-4">
                            {{ $authority->description }}
                        </p>
                    @endif
                </article>
            @endforeach
        </div>
    @endif
</section>
@endsection