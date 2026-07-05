@extends('layouts.public')

@section('content')
<section class="max-w-7xl mx-auto px-6 py-16">
    <h1 class="text-4xl font-bold mb-6">Contacto</h1>

    <p class="text-lg text-slate-600 max-w-3xl mb-8">
        Envíanos un mensaje para solicitar información sobre el BioBanco Nacional de Demencia.
    </p>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 border border-green-200 rounded-lg px-4 py-3 mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-800 border border-red-200 rounded-lg px-4 py-3 mb-6">
            Revisa los campos del formulario.
        </div>
    @endif

    <form action="{{ route('contact.send') }}" method="POST" class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 max-w-3xl">
        @csrf

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-2">Nombre</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full rounded-lg border-slate-300"
                    required
                >
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Correo electrónico</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full rounded-lg border-slate-300"
                    required
                >
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Teléfono</label>
                <input
                    type="text"
                    name="phone"
                    value="{{ old('phone') }}"
                    class="w-full rounded-lg border-slate-300"
                >
                @error('phone')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Asunto</label>
                <input
                    type="text"
                    name="subject"
                    value="{{ old('subject') }}"
                    class="w-full rounded-lg border-slate-300"
                >
                @error('subject')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-4">
            <label class="block text-sm font-semibold mb-2">Mensaje</label>
            <textarea
                name="message"
                rows="5"
                class="w-full rounded-lg border-slate-300"
                required
            >{{ old('message') }}</textarea>
            @error('message')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="mt-6 bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800">
            Enviar mensaje
        </button>
    </form>
</section>
@endsection