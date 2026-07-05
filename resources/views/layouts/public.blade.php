@php
    use App\Models\FooterSetting;
    use App\Models\NavigationItem;

    $navigationItems = NavigationItem::query()
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->orderBy('label')
        ->get();

    $footerSetting = FooterSetting::query()->first();

    $defaultNavigationItems = [
        ['label' => 'Inicio', 'route' => 'home'],
        ['label' => 'Nosotros', 'route' => 'about'],
        ['label' => 'Autoridades', 'route' => 'authorities'],
        ['label' => 'Galería', 'route' => 'gallery'],
        ['label' => 'Investigación', 'route' => 'research'],
        ['label' => 'Documentos', 'route' => 'documents'],
        ['label' => 'Contacto', 'route' => 'contact'],
    ];
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BND | BioBanco Nacional de Demencias</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900">
    <header class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between gap-6">
            <a href="{{ route('home') }}" class="font-bold text-xl text-blue-700">
                BND
            </a>

            <nav class="hidden md:flex items-center gap-5 text-sm font-medium">
                @if($navigationItems->isNotEmpty())
                    @foreach($navigationItems as $item)
                        @if(! empty($item->route_name) && Route::has($item->route_name))
                            <a href="{{ route($item->route_name) }}" class="text-slate-700 hover:text-blue-700">
                                {{ $item->label }}
                            </a>
                        @elseif(! empty($item->url))
                            <a href="{{ $item->url }}" class="text-slate-700 hover:text-blue-700">
                                {{ $item->label }}
                            </a>
                        @endif
                    @endforeach
                @else
                    @foreach($defaultNavigationItems as $item)
                        <a href="{{ route($item['route']) }}" class="text-slate-700 hover:text-blue-700">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                @endif
            </nav>
        </div>
    </header>

    <main class="m-0 p-0">
        @yield('content')
    </main>

    <footer class="bg-slate-900 text-white mt-0">
        <div class="max-w-7xl mx-auto px-6 py-10">
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-xl font-bold">
                        {{ $footerSetting->title ?? 'BioBanco Nacional de Demencia' }}
                    </h2>

                    <p class="text-slate-300 mt-3">
                        {{ $footerSetting->description ?? 'Sitio público del BioBanco Nacional de Demencia.' }}
                    </p>
                </div>

                <div class="md:text-right text-slate-300">
                    @if(! empty($footerSetting?->email))
                        <p>{{ $footerSetting->email }}</p>
                    @endif

                    @if(! empty($footerSetting?->phone))
                        <p>{{ $footerSetting->phone }}</p>
                    @endif

                    @if(! empty($footerSetting?->address))
                        <p>{{ $footerSetting->address }}</p>
                    @endif
                </div>
            </div>

            <div class="border-t border-slate-700 mt-8 pt-6 text-sm text-slate-400">
                {{ $footerSetting->copyright ?? '© ' . date('Y') . ' BioBanco Nacional de Demencia. Todos los derechos reservados.' }}
            </div>
        </div>
    </footer>
</body>
</html>