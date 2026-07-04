<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BioBanco Nacional de Demencia</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900">
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="font-bold text-xl text-blue-700">
                BND
            </a>

            <nav class="flex gap-6 text-sm font-medium">
                <a href="{{ route('home') }}" class="hover:text-blue-700">Inicio</a>
                <a href="{{ route('about') }}" class="hover:text-blue-700">Nosotros</a>
                <a href="{{ route('authorities') }}" class="hover:text-blue-700">Autoridades</a>
                <a href="{{ route('documents') }}" class="hover:text-blue-700">Documentos</a>
                <a href="{{ route('research') }}" class="hover:text-blue-700">Investigación</a>
                <a href="{{ route('contact') }}" class="hover:text-blue-700">Contacto</a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-slate-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-6 py-8 text-sm">
            <p>&copy; {{ date('Y') }} BioBanco Nacional de Demencia. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>