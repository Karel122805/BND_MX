@extends('layouts.public')

@section('content')
@php
    $sections = $sections ?? collect();

    $hero = $sections->first();
    $otherSections = $sections->skip(1);

    $hexToRgba = function ($hex, $opacity = 100) {
        if (! $hex || $hex === 'transparent') {
            return 'transparent';
        }

        $hex = str_replace('#', '', trim($hex));

        if (strlen($hex) === 3) {
            $r = hexdec(str_repeat($hex[0], 2));
            $g = hexdec(str_repeat($hex[1], 2));
            $b = hexdec(str_repeat($hex[2], 2));
        } elseif (strlen($hex) === 6) {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        } else {
            return 'transparent';
        }

        $alpha = min(max((int) $opacity, 0), 100) / 100;

        return "rgba({$r}, {$g}, {$b}, {$alpha})";
    };

    /*
    |--------------------------------------------------------------------------
    | Fondo del banner
    |--------------------------------------------------------------------------
    */
    $backgroundImage = $hero?->backgroundMediaAsset?->file
        ? asset('storage/' . $hero->backgroundMediaAsset->file)
        : null;

    $backgroundOpacity = min(max(($hero?->background_opacity ?? 85), 0), 100) / 100;

    /*
    |--------------------------------------------------------------------------
    | Colores generales
    |--------------------------------------------------------------------------
    */
    $textColor = $hero?->textColor?->hex ?? '#FFFFFF';
    $secondaryColor = $hero?->accentColor?->hex ?? '#F97316';
    $tertiaryColor = $hero?->tertiaryColor?->hex ?? '#7C3AED';

    $textColorSoft = $hexToRgba($textColor, 87);

    /*
    |--------------------------------------------------------------------------
    | Título por partes
    |--------------------------------------------------------------------------
    */
    $titleParts = [
        [
            'text' => $hero?->title_part_1,
            'color' => $hero?->titlePart1Color?->hex ?? $textColor,
        ],
        [
            'text' => $hero?->title_part_2,
            'color' => $hero?->titlePart2Color?->hex ?? $secondaryColor,
        ],
        [
            'text' => $hero?->title_part_3,
            'color' => $hero?->titlePart3Color?->hex ?? $tertiaryColor,
        ],
    ];

    $hasTitleParts = collect($titleParts)
        ->filter(fn ($part) => ! empty($part['text']))
        ->isNotEmpty();

    $fallbackTitle = $hero?->title ?? 'La donación de cerebro es una esperanza para el futuro';

    /*
    |--------------------------------------------------------------------------
    | Etiqueta superior
    |--------------------------------------------------------------------------
    */
    $subtitleTextColor = $hero?->subtitleTextColor?->hex ?? $secondaryColor;
    $subtitleBorderColor = $hero?->subtitleBorderColor?->hex ?? $secondaryColor;
    $subtitleBackgroundColor = $hero?->subtitleBackgroundColor?->hex ?? '#000000';

    $subtitleBackgroundOpacity = $hero?->subtitle_background_opacity ?? 20;

    $subtitleBackground = $hexToRgba($subtitleBackgroundColor, $subtitleBackgroundOpacity);
    $subtitleBorder = $hexToRgba($subtitleBorderColor, 75);

    /*
    |--------------------------------------------------------------------------
    | Estadísticas
    |--------------------------------------------------------------------------
    */
    $stat1Number = (int) ($hero?->stat_1_number ?? 2433);
    $stat1Label = $hero?->stat_1_label ?? 'Pacientes';
    $stat1Color = $hero?->stat1Color?->hex ?? '#7C3AED';
    $stat1LabelColor = $hero?->stat1LabelColor?->hex ?? '#94A3B8';

    $stat2Number = (int) ($hero?->stat_2_number ?? 149);
    $stat2Label = $hero?->stat_2_label ?? 'Estudios';
    $stat2Color = $hero?->stat2Color?->hex ?? '#F97316';
    $stat2LabelColor = $hero?->stat2LabelColor?->hex ?? '#94A3B8';

    $stat3Number = (int) ($hero?->stat_3_number ?? 102);
    $stat3Label = $hero?->stat_3_label ?? 'Materiales';
    $stat3Color = $hero?->stat3Color?->hex ?? '#7C3AED';
    $stat3LabelColor = $hero?->stat3LabelColor?->hex ?? '#94A3B8';

    $stat4Number = (int) ($hero?->stat_4_number ?? 15);
    $stat4Label = $hero?->stat_4_label ?? 'Donaciones';
    $stat4Color = $hero?->stat4Color?->hex ?? '#F97316';
    $stat4LabelColor = $hero?->stat4LabelColor?->hex ?? '#94A3B8';

    /*
    |--------------------------------------------------------------------------
    | Botón principal
    |--------------------------------------------------------------------------
    */
    $primaryButtonText = $hero?->primary_button_text ?? 'Contáctanos';
    $primaryButtonUrl = $hero?->primary_button_url ?? '/contacto';
    $primaryButtonIcon = $hero?->primary_button_icon ?? 'heroicon-o-arrow-right';

    $primaryButtonColor = $hero?->primaryButtonColor?->hex ?? '#F97316';
    $primaryButtonOpacity = $hero?->primary_button_opacity ?? 100;
    $primaryButtonBackground = $hexToRgba($primaryButtonColor, $primaryButtonOpacity);

    $primaryButtonRadius = min(max(($hero?->primary_button_radius ?? 6), 0), 50);

    $primaryButtonTextColor = $hero?->primaryButtonTextColor?->hex ?? '#FFFFFF';
    $primaryButtonIconColor = $hero?->primaryButtonIconColor?->hex ?? $primaryButtonTextColor;

    $primaryButtonHoverColor = $hero?->primaryButtonHoverColor?->hex ?? '#FFFFFF';
    $primaryButtonHoverTextColor = $hero?->primaryButtonHoverTextColor?->hex ?? '#111827';
    $primaryButtonHoverIconColor = $hero?->primaryButtonHoverIconColor?->hex ?? $primaryButtonHoverTextColor;

    /*
    |--------------------------------------------------------------------------
    | Botón secundario
    |--------------------------------------------------------------------------
    */
    $secondaryButtonText = $hero?->secondary_button_text ?? 'Documentos';
    $secondaryButtonUrl = $hero?->secondary_button_url ?? '/documentos';
    $secondaryButtonIcon = $hero?->secondary_button_icon ?? 'heroicon-o-document-text';

    $secondaryButtonColor = $hero?->secondaryButtonColor?->hex ?? '#FFFFFF';
    $secondaryButtonOpacity = $hero?->secondary_button_opacity ?? 15;
    $secondaryButtonBackground = $hexToRgba($secondaryButtonColor, $secondaryButtonOpacity);

    $secondaryButtonRadius = min(max(($hero?->secondary_button_radius ?? 6), 0), 50);

    $secondaryButtonTextColor = $hero?->secondaryButtonTextColor?->hex ?? $textColor;
    $secondaryButtonIconColor = $hero?->secondaryButtonIconColor?->hex ?? $secondaryButtonTextColor;

    $secondaryButtonHoverColor = $hero?->secondaryButtonHoverColor?->hex ?? '#FFFFFF';
    $secondaryButtonHoverTextColor = $hero?->secondaryButtonHoverTextColor?->hex ?? '#111827';
    $secondaryButtonHoverIconColor = $hero?->secondaryButtonHoverIconColor?->hex ?? $secondaryButtonHoverTextColor;

    $secondaryButtonBorder = $hexToRgba($secondaryButtonTextColor, 65);

    $primaryIconIsHeroicon = is_string($primaryButtonIcon) && str_starts_with($primaryButtonIcon, 'heroicon-');
    $secondaryIconIsHeroicon = is_string($secondaryButtonIcon) && str_starts_with($secondaryButtonIcon, 'heroicon-');

    /*
    |--------------------------------------------------------------------------
    | Bloque: ¿Qué hacemos?
    |--------------------------------------------------------------------------
    */
    $whatWeDoLabel = $hero?->what_we_do_label ?? '¿Qué hacemos?';
    $whatWeDoLabelColor = $hero?->whatWeDoLabelColor?->hex ?? $secondaryColor;

    $whatWeDoTitle = $hero?->what_we_do_title
        ?? 'Diagnóstico, investigación y preservación al servicio de la salud';

    $whatWeDoContent = $hero?->what_we_do_content
        ?? 'En el BND apoyamos el estudio de Alzheimer y otras demencias mediante diagnóstico especializado, investigación científica y preservación de muestras biológicas.';

    $whatWeDoTitleColor = $hero?->whatWeDoTitleColor?->hex ?? '#020617';
    $whatWeDoContentColor = $hero?->whatWeDoContentColor?->hex ?? '#475569';

    $whatWeDoUseGradient = (bool) ($hero?->what_we_do_use_gradient ?? false);

    $whatWeDoBackgroundColor = $hero?->whatWeDoBackgroundColor?->hex ?? '#F8FAFC';
    $whatWeDoGradientFromColor = $hero?->whatWeDoGradientFromColor?->hex ?? '#F8FAFC';
    $whatWeDoGradientToColor = $hero?->whatWeDoGradientToColor?->hex ?? '#FFFFFF';

    $whatWeDoBackgroundStyle = $whatWeDoUseGradient
        ? "linear-gradient(135deg, {$whatWeDoGradientFromColor}, {$whatWeDoGradientToColor})"
        : $whatWeDoBackgroundColor;

    $whatCards = [
        [
            'title' => $hero?->what_card_1_title ?? 'Diagnóstico especializado',
            'content' => $hero?->what_card_1_content ?? 'Apoyo al diagnóstico histopatológico post-mortem en enfermedades neurodegenerativas.',
            'icon' => $hero?->what_card_1_icon ?? 'heroicon-o-beaker',
            'button_text' => $hero?->what_card_1_button_text ?? 'Ver más en Investigación',
            'button_url' => $hero?->what_card_1_button_url ?? '/investigacion',

            'card_background' => $hero?->whatCard1BackgroundColor?->hex ?? '#FFFFFF',
            'title_color' => $hero?->whatCard1TitleColor?->hex ?? '#020617',
            'content_color' => $hero?->whatCard1ContentColor?->hex ?? '#475569',
            'icon_color' => $hero?->whatCard1IconColor?->hex ?? $tertiaryColor,
            'icon_background' => $hero?->whatCard1IconBackgroundColor?->hex ?? $hexToRgba($tertiaryColor, 10),
            'link_color' => $hero?->whatCard1LinkColor?->hex ?? ($hero?->whatCard1IconColor?->hex ?? $tertiaryColor),
        ],
        [
            'title' => $hero?->what_card_2_title ?? 'Investigación científica',
            'content' => $hero?->what_card_2_content ?? 'Búsqueda de biomarcadores para mejorar la detección y comprensión de las demencias.',
            'icon' => $hero?->what_card_2_icon ?? 'heroicon-o-academic-cap',
            'button_text' => $hero?->what_card_2_button_text ?? 'Ver más en Investigación',
            'button_url' => $hero?->what_card_2_button_url ?? '/investigacion',

            'card_background' => $hero?->whatCard2BackgroundColor?->hex ?? '#FFFFFF',
            'title_color' => $hero?->whatCard2TitleColor?->hex ?? '#020617',
            'content_color' => $hero?->whatCard2ContentColor?->hex ?? '#475569',
            'icon_color' => $hero?->whatCard2IconColor?->hex ?? $secondaryColor,
            'icon_background' => $hero?->whatCard2IconBackgroundColor?->hex ?? $hexToRgba($secondaryColor, 10),
            'link_color' => $hero?->whatCard2LinkColor?->hex ?? ($hero?->whatCard2IconColor?->hex ?? $secondaryColor),
        ],
        [
            'title' => $hero?->what_card_3_title ?? 'Donación y preservación',
            'content' => $hero?->what_card_3_content ?? 'Procesamiento y resguardo de tejidos y fluidos con fines científicos y bioéticos.',
            'icon' => $hero?->what_card_3_icon ?? 'heroicon-o-heart',
            'button_text' => $hero?->what_card_3_button_text ?? 'Conocer proceso',
            'button_url' => $hero?->what_card_3_button_url ?? '/investigacion',

            'card_background' => $hero?->whatCard3BackgroundColor?->hex ?? '#FFFFFF',
            'title_color' => $hero?->whatCard3TitleColor?->hex ?? '#020617',
            'content_color' => $hero?->whatCard3ContentColor?->hex ?? '#475569',
            'icon_color' => $hero?->whatCard3IconColor?->hex ?? '#FACC15',
            'icon_background' => $hero?->whatCard3IconBackgroundColor?->hex ?? $hexToRgba('#FACC15', 16),
            'link_color' => $hero?->whatCard3LinkColor?->hex ?? ($hero?->whatCard3IconColor?->hex ?? '#FACC15'),
        ],
    ];

    /*
    |--------------------------------------------------------------------------
    | Cierre corto de contacto
    |--------------------------------------------------------------------------
    */
    $contactCtaTitle = $hero?->contact_cta_title ?? '¿Necesitas orientación?';

    $contactCtaContent = $hero?->contact_cta_content
        ?? 'Contáctanos para recibir información sobre donación, investigación, documentos o servicios del BND.';

    $contactCtaButtonText = $hero?->contact_cta_button_text ?? 'Contactar al BND';
    $contactCtaButtonUrl = $hero?->contact_cta_button_url ?? '/contacto';

    $contactCtaUseGradient = (bool) ($hero?->contact_cta_use_gradient ?? false);

    $contactCtaBackgroundColor = $hero?->contactCtaBackgroundColor?->hex ?? '#020617';
    $contactCtaGradientFromColor = $hero?->contactCtaGradientFromColor?->hex ?? $tertiaryColor;
    $contactCtaGradientToColor = $hero?->contactCtaGradientToColor?->hex ?? $secondaryColor;

    $contactCtaBackgroundStyle = $contactCtaUseGradient
        ? "linear-gradient(135deg, {$contactCtaGradientFromColor}, {$contactCtaGradientToColor})"
        : $contactCtaBackgroundColor;

    $contactCtaTitleColor = $hero?->contactCtaTitleColor?->hex ?? '#FFFFFF';
    $contactCtaContentColor = $hero?->contactCtaContentColor?->hex ?? '#CBD5E1';

    $contactCtaButtonColor = $hero?->contactCtaButtonColor?->hex ?? '#FFFFFF';
    $contactCtaButtonTextColor = $hero?->contactCtaButtonTextColor?->hex ?? '#020617';
    $contactCtaButtonIcon = $hero?->contact_cta_button_icon ?? 'heroicon-o-arrow-right';
    $contactCtaButtonIconColor = $hero?->contactCtaButtonIconColor?->hex ?? $contactCtaButtonTextColor;

    $contactCtaButtonHoverColor = $hero?->contactCtaButtonHoverColor?->hex ?? $secondaryColor;
    $contactCtaButtonHoverTextColor = $hero?->contactCtaButtonHoverTextColor?->hex ?? '#FFFFFF';
    $contactCtaButtonHoverIconColor = $hero?->contactCtaButtonHoverIconColor?->hex ?? $contactCtaButtonHoverTextColor;

    $contactCtaButtonRadius = min(max(($hero?->contact_cta_button_radius ?? 12), 0), 50);

    $contactCtaButtonIconIsHeroicon = is_string($contactCtaButtonIcon)
        && str_starts_with($contactCtaButtonIcon, 'heroicon-');
@endphp

<section class="relative overflow-hidden bg-[#020617]">
    @if($backgroundImage)
        <img
            src="{{ $backgroundImage }}"
            alt="{{ $hero?->backgroundMediaAsset?->alt ?? 'Fondo principal' }}"
            class="absolute inset-0 w-full h-full object-cover"
            style="opacity: {{ $backgroundOpacity }};"
        >
    @endif

    <div class="absolute inset-0 bg-black/35"></div>

    <div class="relative max-w-7xl mx-auto px-6 md:px-24 pt-20 md:pt-24 pb-36 md:pb-40">
        <div class="max-w-4xl">
            @if(! empty($hero?->subtitle))
                <p
                    class="inline-flex items-center rounded-md border px-3 py-1 text-[11px] font-black tracking-[0.12em] mb-6"
                    style="
                        color: {{ $subtitleTextColor }};
                        border-color: {{ $subtitleBorder }};
                        background-color: {{ $subtitleBackground }};
                    "
                >
                    · {{ $hero->subtitle }}
                </p>
            @endif

            <h1
                class="font-black leading-[1.15] tracking-wide text-[42px] md:text-[56px] mb-6 max-w-4xl"
                style="color: {{ $textColor }};"
            >
                @if($hasTitleParts)
                    @foreach($titleParts as $part)
                        @if(! empty($part['text']))
                            @if(! $loop->first)
                                {{ ' ' }}
                            @endif

                            <span style="color: {{ $part['color'] }};">
                                {{ $part['text'] }}
                            </span>
                        @endif
                    @endforeach
                @else
                    {{ $fallbackTitle }}
                @endif
            </h1>

            <div
                class="text-[16px] md:text-[17px] leading-8 max-w-2xl mb-8"
                style="color: {{ $textColorSoft }};"
            >
                @if(! empty($hero?->content))
                    {!! $hero->content !!}
                @else
                    <p>
                        Actualmente la población mexicana se encuentra en franca transición demográfica.
                        En el BND impulsamos el estudio y búsqueda de biomarcadores para identificar
                        oportunamente el Alzheimer y otras demencias.
                    </p>
                @endif
            </div>

            <div class="flex flex-wrap gap-5">
                @if(! empty($primaryButtonText))
                    <a
                        href="{{ $primaryButtonUrl }}"
                        class="bnd-dynamic-button inline-flex items-center justify-center px-7 py-3 text-sm font-black shadow-lg border transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                        style="
                            background-color: {{ $primaryButtonBackground }};
                            color: {{ $primaryButtonTextColor }};
                            border-color: {{ $primaryButtonColor }};
                            border-radius: {{ $primaryButtonRadius }}px;
                        "
                        data-bg="{{ $primaryButtonBackground }}"
                        data-text="{{ $primaryButtonTextColor }}"
                        data-icon="{{ $primaryButtonIconColor }}"
                        data-border="{{ $primaryButtonColor }}"
                        data-radius="{{ $primaryButtonRadius }}px"
                        data-hover-bg="{{ $primaryButtonHoverColor }}"
                        data-hover-text="{{ $primaryButtonHoverTextColor }}"
                        data-hover-icon="{{ $primaryButtonHoverIconColor }}"
                        data-hover-border="{{ $primaryButtonHoverColor }}"
                    >
                        <span class="button-text">{{ $primaryButtonText }}</span>

                        @if(! empty($primaryButtonIcon))
                            @if($primaryIconIsHeroicon)
                                <x-filament::icon
                                    :icon="$primaryButtonIcon"
                                    class="button-icon ml-2 w-5 h-5 transition-colors duration-300"
                                    style="color: {{ $primaryButtonIconColor }};"
                                />
                            @else
                                <span
                                    class="button-icon ml-2 transition-colors duration-300"
                                    style="color: {{ $primaryButtonIconColor }};"
                                >
                                    {{ $primaryButtonIcon }}
                                </span>
                            @endif
                        @endif
                    </a>
                @endif

                @if(! empty($secondaryButtonText))
                    <a
                        href="{{ $secondaryButtonUrl }}"
                        class="bnd-dynamic-button inline-flex items-center justify-center px-7 py-3 text-sm font-black border transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                        style="
                            background-color: {{ $secondaryButtonBackground }};
                            color: {{ $secondaryButtonTextColor }};
                            border-color: {{ $secondaryButtonBorder }};
                            border-radius: {{ $secondaryButtonRadius }}px;
                        "
                        data-bg="{{ $secondaryButtonBackground }}"
                        data-text="{{ $secondaryButtonTextColor }}"
                        data-icon="{{ $secondaryButtonIconColor }}"
                        data-border="{{ $secondaryButtonBorder }}"
                        data-radius="{{ $secondaryButtonRadius }}px"
                        data-hover-bg="{{ $secondaryButtonHoverColor }}"
                        data-hover-text="{{ $secondaryButtonHoverTextColor }}"
                        data-hover-icon="{{ $secondaryButtonHoverIconColor }}"
                        data-hover-border="{{ $secondaryButtonHoverColor }}"
                    >
                        <span class="button-text">{{ $secondaryButtonText }}</span>

                        @if(! empty($secondaryButtonIcon))
                            @if($secondaryIconIsHeroicon)
                                <x-filament::icon
                                    :icon="$secondaryButtonIcon"
                                    class="button-icon ml-2 w-5 h-5 transition-colors duration-300"
                                    style="color: {{ $secondaryButtonIconColor }};"
                                />
                            @else
                                <span
                                    class="button-icon ml-2 transition-colors duration-300"
                                    style="color: {{ $secondaryButtonIconColor }};"
                                >
                                    {{ $secondaryButtonIcon }}
                                </span>
                            @endif
                        @endif
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="max-w-5xl mx-auto px-6 -mt-14 relative z-10">
    <div
        class="bg-white rounded-xl shadow-xl border border-slate-200 grid grid-cols-2 md:grid-cols-4 divide-x divide-slate-200 overflow-hidden border-b-4"
        style="border-bottom-color: {{ $stat1Color }};"
    >
        <div class="p-6 text-center">
            <p
                class="counter-number text-4xl font-black"
                data-target="{{ $stat1Number }}"
                style="color: {{ $stat1Color }};"
            >
                0
            </p>
            <p
                class="text-[11px] uppercase font-black tracking-wide"
                style="color: {{ $stat1LabelColor }};"
            >
                {{ $stat1Label }}
            </p>
        </div>

        <div class="p-6 text-center">
            <p
                class="counter-number text-4xl font-black"
                data-target="{{ $stat2Number }}"
                style="color: {{ $stat2Color }};"
            >
                0
            </p>
            <p
                class="text-[11px] uppercase font-black tracking-wide"
                style="color: {{ $stat2LabelColor }};"
            >
                {{ $stat2Label }}
            </p>
        </div>

        <div class="p-6 text-center">
            <p
                class="counter-number text-4xl font-black"
                data-target="{{ $stat3Number }}"
                style="color: {{ $stat3Color }};"
            >
                0
            </p>
            <p
                class="text-[11px] uppercase font-black tracking-wide"
                style="color: {{ $stat3LabelColor }};"
            >
                {{ $stat3Label }}
            </p>
        </div>

        <div class="p-6 text-center">
            <p
                class="counter-number text-4xl font-black"
                data-target="{{ $stat4Number }}"
                style="color: {{ $stat4Color }};"
            >
                0
            </p>
            <p
                class="text-[11px] uppercase font-black tracking-wide"
                style="color: {{ $stat4LabelColor }};"
            >
                {{ $stat4Label }}
            </p>
        </div>
    </div>
</section>

<section
    class="pt-28 pb-24"
    style="background: {{ $whatWeDoBackgroundStyle }};"
>
    <div class="max-w-7xl mx-auto px-6">
        <div class="max-w-3xl mx-auto text-center mb-14">
            @if(! empty($whatWeDoLabel))
                <p
                    class="text-sm font-black tracking-[0.18em] uppercase mb-4"
                    style="color: {{ $whatWeDoLabelColor }};"
                >
                    {{ $whatWeDoLabel }}
                </p>
            @endif

            <h2
                class="text-3xl md:text-5xl font-black leading-tight"
                style="color: {{ $whatWeDoTitleColor }};"
            >
                {{ $whatWeDoTitle }}
            </h2>

            <div
                class="mt-6 text-base md:text-lg leading-8"
                style="color: {{ $whatWeDoContentColor }};"
            >
                {!! $whatWeDoContent !!}
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-7">
            @foreach($whatCards as $card)
                @php
                    $cardIcon = $card['icon'];
                    $cardIconIsHeroicon = is_string($cardIcon) && str_starts_with($cardIcon, 'heroicon-');
                @endphp

                <article
                    class="group rounded-3xl border border-slate-200 p-8 shadow-sm hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 flex flex-col h-full"
                    style="background-color: {{ $card['card_background'] }};"
                >
                    <div
                        class="w-16 h-16 rounded-2xl flex items-center justify-center mb-7 transition-transform duration-300 group-hover:scale-110"
                        style="background-color: {{ $card['icon_background'] }}; color: {{ $card['icon_color'] }};"
                    >
                        @if(! empty($cardIcon))
                            @if($cardIconIsHeroicon)
                                <x-filament::icon
                                    :icon="$cardIcon"
                                    class="w-8 h-8"
                                    style="color: {{ $card['icon_color'] }};"
                                />
                            @else
                                <span class="text-2xl font-black" style="color: {{ $card['icon_color'] }};">
                                    {{ $cardIcon }}
                                </span>
                            @endif
                        @else
                            <span class="text-2xl font-black" style="color: {{ $card['icon_color'] }};">
                                ✦
                            </span>
                        @endif
                    </div>

                    <h3
                        class="text-xl font-black mb-4"
                        style="color: {{ $card['title_color'] }};"
                    >
                        {{ $card['title'] }}
                    </h3>

                    <div
                        class="leading-7 mb-7"
                        style="color: {{ $card['content_color'] }};"
                    >
                        {!! $card['content'] !!}
                    </div>

                    @if(! empty($card['button_text']) && ! empty($card['button_url']))
                        <a
                            href="{{ $card['button_url'] }}"
                            class="inline-flex items-center gap-2 text-sm font-black transition-colors duration-300 mt-auto"
                            style="color: {{ $card['link_color'] }};"
                        >
                            {{ $card['button_text'] }}
                            <span aria-hidden="true">→</span>
                        </a>
                    @endif
                </article>
            @endforeach
        </div>
    </div>
</section>

<section
    class="relative overflow-hidden py-20"
    style="background: {{ $contactCtaBackgroundStyle }};"
>
    <div class="relative max-w-5xl mx-auto px-6 text-center">
        <h2
            class="text-3xl md:text-5xl font-black leading-tight"
            style="color: {{ $contactCtaTitleColor }};"
        >
            {{ $contactCtaTitle }}
        </h2>

        <div
            class="mt-6 text-base md:text-lg leading-8 max-w-3xl mx-auto"
            style="color: {{ $contactCtaContentColor }};"
        >
            {!! $contactCtaContent !!}
        </div>

        @if(! empty($contactCtaButtonText) && ! empty($contactCtaButtonUrl))
            <a
                href="{{ $contactCtaButtonUrl }}"
                class="bnd-dynamic-button inline-flex items-center justify-center mt-9 px-8 py-4 text-sm font-black border transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                style="
                    background-color: {{ $contactCtaButtonColor }};
                    color: {{ $contactCtaButtonTextColor }};
                    border-color: {{ $contactCtaButtonColor }};
                    border-radius: {{ $contactCtaButtonRadius }}px;
                "
                data-bg="{{ $contactCtaButtonColor }}"
                data-text="{{ $contactCtaButtonTextColor }}"
                data-icon="{{ $contactCtaButtonIconColor }}"
                data-border="{{ $contactCtaButtonColor }}"
                data-radius="{{ $contactCtaButtonRadius }}px"
                data-hover-bg="{{ $contactCtaButtonHoverColor }}"
                data-hover-text="{{ $contactCtaButtonHoverTextColor }}"
                data-hover-icon="{{ $contactCtaButtonHoverIconColor }}"
                data-hover-border="{{ $contactCtaButtonHoverColor }}"
            >
                <span class="button-text">
                    {{ $contactCtaButtonText }}
                </span>

                @if(! empty($contactCtaButtonIcon))
                    @if($contactCtaButtonIconIsHeroicon)
                        <x-filament::icon
                            :icon="$contactCtaButtonIcon"
                            class="button-icon ml-2 w-5 h-5 transition-colors duration-300"
                            style="color: {{ $contactCtaButtonIconColor }};"
                        />
                    @else
                        <span
                            class="button-icon ml-2 transition-colors duration-300"
                            style="color: {{ $contactCtaButtonIconColor }};"
                        >
                            {{ $contactCtaButtonIcon }}
                        </span>
                    @endif
                @endif
            </a>
        @endif
    </div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const counters = document.querySelectorAll('.counter-number');

        counters.forEach((counter) => {
            const target = Number(counter.dataset.target || 0);

            if (!Number.isFinite(target)) {
                counter.textContent = '0';
                return;
            }

            const duration = 1600;
            const startTime = performance.now();

            function updateCounter(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const value = Math.floor(progress * target);

                counter.textContent = value.toLocaleString('es-MX');

                if (progress < 1) {
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target.toLocaleString('es-MX');
                }
            }

            requestAnimationFrame(updateCounter);
        });

        const buttons = document.querySelectorAll('.bnd-dynamic-button');

        buttons.forEach((button) => {
            const icon = button.querySelector('.button-icon');

            button.addEventListener('mouseenter', () => {
                button.style.backgroundColor = button.dataset.hoverBg;
                button.style.color = button.dataset.hoverText;
                button.style.borderColor = button.dataset.hoverBorder;
                button.style.borderRadius = button.dataset.radius;

                if (icon) {
                    icon.style.color = button.dataset.hoverIcon;
                }
            });

            button.addEventListener('mouseleave', () => {
                button.style.backgroundColor = button.dataset.bg;
                button.style.color = button.dataset.text;
                button.style.borderColor = button.dataset.border;
                button.style.borderRadius = button.dataset.radius;

                if (icon) {
                    icon.style.color = button.dataset.icon;
                }
            });
        });
    });
</script>
@endsection