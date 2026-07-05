@php
    use App\Models\NavigationItem;
    use App\Models\SiteSetting;

    $siteSetting = SiteSetting::latest()->first();

    $navigationItems = NavigationItem::where('is_active', true)
        ->orderBy('sort_order')
        ->orderBy('label')
        ->get();

    $defaultNavigationItems = [
        ['label' => 'Inicio', 'route' => 'home'],
        ['label' => 'Nosotros', 'route' => 'about'],
        ['label' => 'Autoridades', 'route' => 'authorities'],
        ['label' => 'Documentos', 'route' => 'documents'],
        ['label' => 'Investigación', 'route' => 'research'],
        ['label' => 'Contacto', 'route' => 'contact'],
    ];
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $siteSetting?->site_name ?? 'BioBanco Nacional de Demencia' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-900 min-h-screen flex flex-col">

    {{-- HEADER --}}
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center">
                @if($siteSetting?->logo)
                    <img
                        src="{{ asset('storage/' . $siteSetting->logo) }}"
                        alt="{{ $siteSetting->site_name }}"
                        class="h-12 w-auto"
                    >
                @else
                    <div class="h-12 w-16 rounded-full border-2 border-purple-700 flex items-center justify-center">
                        <span class="font-black text-orange-500 text-xl">BND</span>
                    </div>
                @endif
            </a>

            <nav class="hidden md:flex items-center gap-2 text-sm font-bold">
                @if($navigationItems->isNotEmpty())
                    @foreach($navigationItems as $item)
                        @php
                            $href = $item->route_name ? route($item->route_name) : $item->url;
                            $isActive = $item->route_name ? request()->routeIs($item->route_name) : false;
                        @endphp

                        @if($href)
                            <a
                                href="{{ $href }}"
                                @if($item->opens_new_tab) target="_blank" rel="noopener noreferrer" @endif
                                class="px-5 py-2 rounded-xl transition
                                    {{ $isActive
                                        ? 'bg-purple-800 text-white'
                                        : 'text-slate-700 hover:bg-purple-50 hover:text-purple-800'
                                    }}"
                            >
                                {{ $item->label }}
                            </a>
                        @endif
                    @endforeach
                @else
                    @foreach($defaultNavigationItems as $item)
                        @php
                            $isActive = request()->routeIs($item['route']);
                        @endphp

                        <a
                            href="{{ route($item['route']) }}"
                            class="px-5 py-2 rounded-xl transition
                                {{ $isActive
                                    ? 'bg-purple-800 text-white'
                                    : 'text-slate-700 hover:bg-purple-50 hover:text-purple-800'
                                }}"
                        >
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                @endif
            </nav>
        </div>
    </header>

    {{-- CONTENIDO --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-[#030716] text-white mt-16">
        <div class="max-w-7xl mx-auto px-6 py-14">
            <div class="grid gap-10 md:grid-cols-4">

                {{-- LOGO / DESCRIPCIÓN --}}
                <div>
                    <a href="{{ route('home') }}" class="inline-flex mb-5">
                        @if($siteSetting?->logo)
                            <img
                                src="{{ asset('storage/' . $siteSetting->logo) }}"
                                alt="{{ $siteSetting->site_name }}"
                                class="h-16 w-auto"
                            >
                        @else
                            <div class="h-16 w-20 rounded-full border-2 border-purple-700 flex items-center justify-center">
                                <span class="font-black text-orange-500 text-2xl">BND</span>
                            </div>
                        @endif
                    </a>

                    <p class="text-slate-300 text-sm leading-relaxed max-w-xs">
                        {{ $siteSetting?->footer_text ?? 'Comprometidos con la investigación neurocientífica en México y Latinoamérica para un futuro sin demencias.' }}
                    </p>

                    <div class="flex gap-3 mt-5">
                        @if($siteSetting?->instagram_url)
                            <a href="{{ $siteSetting->instagram_url }}" target="_blank" class="h-10 w-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-purple-800">
                                IG
                            </a>
                        @endif

                        @if($siteSetting?->facebook_url)
                            <a href="{{ $siteSetting->facebook_url }}" target="_blank" class="h-10 w-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-purple-800">
                                f
                            </a>
                        @endif

                        @if($siteSetting?->linkedin_url)
                            <a href="{{ $siteSetting->linkedin_url }}" target="_blank" class="h-10 w-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-purple-800">
                                in
                            </a>
                        @endif
                    </div>
                </div>

                {{-- ENLACES --}}
                <div>
                    <h3 class="text-sm font-black tracking-widest uppercase mb-2">Enlaces rápidos</h3>
                    <div class="w-10 h-0.5 bg-orange-500 mb-5"></div>

                    <ul class="space-y-2 text-sm text-slate-300">
                        @if($navigationItems->isNotEmpty())
                            @foreach($navigationItems as $item)
                                @php
                                    $href = $item->route_name ? route($item->route_name) : $item->url;
                                @endphp

                                @if($href)
                                    <li>
                                        <a
                                            href="{{ $href }}"
                                            @if($item->opens_new_tab) target="_blank" rel="noopener noreferrer" @endif
                                            class="hover:text-white"
                                        >
                                            {{ $item->label }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @else
                            @foreach($defaultNavigationItems as $item)
                                <li>
                                    <a href="{{ route($item['route']) }}" class="hover:text-white">
                                        {{ $item['label'] }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                {{-- CONTACTO --}}
                <div>
                    <h3 class="text-sm font-black tracking-widest uppercase mb-2">Contacto</h3>
                    <div class="w-10 h-0.5 bg-orange-500 mb-5"></div>

                    <div class="space-y-5 text-sm text-slate-300">
                        @if($siteSetting?->address)
                            <div class="flex gap-3">
                                <span class="text-purple-500 text-xl">⌖</span>
                                <p>{{ $siteSetting->address }}</p>
                            </div>
                        @endif

                        @if($siteSetting?->phone)
                            <div class="flex gap-3">
                                <span class="text-purple-500 text-xl">☎</span>
                                <p>{{ $siteSetting->phone }}</p>
                            </div>
                        @endif

                        @if($siteSetting?->email)
                            <div class="flex gap-3">
                                <span class="text-purple-500 text-xl">✉</span>
                                <p>{{ $siteSetting->email }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- HORARIOS --}}
                <div>
                    <h3 class="text-sm font-black tracking-widest uppercase mb-2">Horarios</h3>
                    <div class="w-10 h-0.5 bg-orange-500 mb-5"></div>

                    <div class="space-y-4 text-sm">
                        <div class="flex justify-between gap-4 text-slate-300">
                            <span>Lunes - Viernes:</span>
                            <span class="font-black text-white">9:00 AM - 6:00 PM</span>
                        </div>

                        <div class="flex justify-between gap-4 text-slate-300">
                            <span>Sábado:</span>
                            <span class="font-black text-white">9:00 AM - 2:00 PM</span>
                        </div>

                        <div class="flex justify-between gap-4">
                            <span class="font-bold text-orange-500">Domingo:</span>
                            <span class="font-black text-orange-500">Cerrado</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PARTE BAJA --}}
            <div class="border-t border-slate-800 mt-12 pt-6 flex flex-col md:flex-row justify-between gap-4 text-xs text-slate-500">
                <p>
                    © {{ date('Y') }} {{ $siteSetting?->site_name ?? 'BioBanco Nacional de Demencia' }}. Todos los derechos reservados.
                </p>

                <div class="flex gap-6">
                    <a href="#" class="hover:text-white">Aviso de Privacidad</a>
                    <a href="#" class="hover:text-white">Términos de Uso</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>