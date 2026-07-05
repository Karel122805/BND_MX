<?php

namespace App\Filament\Resources\HomeSections\Schemas;

use App\Models\MediaAsset;
use App\Models\ThemeColor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class HomeSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        $colorLabel = fn (ThemeColor $color): string => Blade::render(
            '<div style="display:flex; align-items:center; gap:10px;">
                <span style="display:inline-block; width:22px; height:22px; border-radius:6px; border:1px solid rgba(148,163,184,.65); background: {{ $hex }}; box-shadow: 0 0 0 1px rgba(255,255,255,.08) inset;"></span>
                <span>{{ $name }}</span>
            </div>',
            [
                'hex' => $color->hex ?: '#FFFFFF',
                'name' => $color->name,
            ]
        );

        $colorSearchResults = fn (?string $search = null): array => ThemeColor::query()
            ->where('is_active', true)
            ->when(
                filled($search),
                fn ($query) => $query->where(function ($query) use ($search) {
                    $query
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('key', 'like', "%{$search}%")
                        ->orWhere('hex', 'like', "%{$search}%");
                })
            )
            ->orderBy('name')
            ->limit(50)
            ->get()
            ->mapWithKeys(fn (ThemeColor $color) => [
                $color->id => $colorLabel($color),
            ])
            ->toArray();

        $colorOptionLabel = fn ($value): ?string => $value
            ? ThemeColor::query()
                ->whereKey($value)
                ->get()
                ->map(fn (ThemeColor $color) => $colorLabel($color))
                ->first()
            : null;

        $colorOptions = fn () => $colorSearchResults(null);

        $iconLabel = fn (string $icon, string $label): string => Blade::render(
            '<div class="flex items-center gap-2">
                <x-filament::icon :icon="$icon" class="h-5 w-5 text-gray-500" />
                <span>{{ $label }}</span>
            </div>',
            [
                'icon' => $icon,
                'label' => $label,
            ]
        );

        $iconOptions = [
            'heroicon-o-hand-thumb-up' => $iconLabel('heroicon-o-hand-thumb-up', 'Me gusta'),
            'heroicon-o-hand-thumb-down' => $iconLabel('heroicon-o-hand-thumb-down', 'No me gusta'),
            'heroicon-o-heart' => $iconLabel('heroicon-o-heart', 'Corazón'),
            'heroicon-o-star' => $iconLabel('heroicon-o-star', 'Estrella'),
            'heroicon-o-sparkles' => $iconLabel('heroicon-o-sparkles', 'Brillo'),
            'heroicon-o-fire' => $iconLabel('heroicon-o-fire', 'Fuego'),
            'heroicon-o-check' => $iconLabel('heroicon-o-check', 'Palomita'),
            'heroicon-o-check-circle' => $iconLabel('heroicon-o-check-circle', 'Palomita circular'),
            'heroicon-o-x-mark' => $iconLabel('heroicon-o-x-mark', 'Cerrar'),
            'heroicon-o-exclamation-triangle' => $iconLabel('heroicon-o-exclamation-triangle', 'Advertencia'),
            'heroicon-o-information-circle' => $iconLabel('heroicon-o-information-circle', 'Información'),

            'heroicon-o-document' => $iconLabel('heroicon-o-document', 'Documento'),
            'heroicon-o-document-text' => $iconLabel('heroicon-o-document-text', 'Documento con texto'),
            'heroicon-o-document-duplicate' => $iconLabel('heroicon-o-document-duplicate', 'Documentos'),
            'heroicon-o-clipboard-document' => $iconLabel('heroicon-o-clipboard-document', 'Portapapeles'),
            'heroicon-o-clipboard-document-list' => $iconLabel('heroicon-o-clipboard-document-list', 'Lista de documentos'),
            'heroicon-o-folder' => $iconLabel('heroicon-o-folder', 'Carpeta'),
            'heroicon-o-folder-open' => $iconLabel('heroicon-o-folder-open', 'Carpeta abierta'),
            'heroicon-o-archive-box' => $iconLabel('heroicon-o-archive-box', 'Archivo'),
            'heroicon-o-arrow-down-tray' => $iconLabel('heroicon-o-arrow-down-tray', 'Descargar'),
            'heroicon-o-arrow-up-tray' => $iconLabel('heroicon-o-arrow-up-tray', 'Subir'),

            'heroicon-o-arrow-right' => $iconLabel('heroicon-o-arrow-right', 'Flecha derecha'),
            'heroicon-o-arrow-long-right' => $iconLabel('heroicon-o-arrow-long-right', 'Flecha larga derecha'),
            'heroicon-o-chevron-right' => $iconLabel('heroicon-o-chevron-right', 'Chevron derecha'),
            'heroicon-o-arrow-top-right-on-square' => $iconLabel('heroicon-o-arrow-top-right-on-square', 'Abrir enlace'),
            'heroicon-o-link' => $iconLabel('heroicon-o-link', 'Enlace'),
            'heroicon-o-globe-alt' => $iconLabel('heroicon-o-globe-alt', 'Web'),
            'heroicon-o-magnifying-glass' => $iconLabel('heroicon-o-magnifying-glass', 'Buscar'),
            'heroicon-o-eye' => $iconLabel('heroicon-o-eye', 'Ver'),
            'heroicon-o-eye-slash' => $iconLabel('heroicon-o-eye-slash', 'Ocultar'),

            'heroicon-o-beaker' => $iconLabel('heroicon-o-beaker', 'Laboratorio'),
            'heroicon-o-academic-cap' => $iconLabel('heroicon-o-academic-cap', 'Investigación'),
            'heroicon-o-building-office-2' => $iconLabel('heroicon-o-building-office-2', 'Institución'),
            'heroicon-o-building-library' => $iconLabel('heroicon-o-building-library', 'Biblioteca'),
            'heroicon-o-user' => $iconLabel('heroicon-o-user', 'Usuario'),
            'heroicon-o-users' => $iconLabel('heroicon-o-users', 'Usuarios'),
            'heroicon-o-user-group' => $iconLabel('heroicon-o-user-group', 'Grupo de usuarios'),
            'heroicon-o-identification' => $iconLabel('heroicon-o-identification', 'Identificación'),

            'heroicon-o-chart-bar' => $iconLabel('heroicon-o-chart-bar', 'Gráfica barras'),
            'heroicon-o-chart-pie' => $iconLabel('heroicon-o-chart-pie', 'Gráfica pastel'),
            'heroicon-o-presentation-chart-line' => $iconLabel('heroicon-o-presentation-chart-line', 'Gráfica línea'),
            'heroicon-o-presentation-chart-bar' => $iconLabel('heroicon-o-presentation-chart-bar', 'Presentación'),
            'heroicon-o-trophy' => $iconLabel('heroicon-o-trophy', 'Logro'),
            'heroicon-o-rocket-launch' => $iconLabel('heroicon-o-rocket-launch', 'Avance'),
            'heroicon-o-light-bulb' => $iconLabel('heroicon-o-light-bulb', 'Idea'),
            'heroicon-o-bolt' => $iconLabel('heroicon-o-bolt', 'Rápido'),

            'heroicon-o-map-pin' => $iconLabel('heroicon-o-map-pin', 'Ubicación'),
            'heroicon-o-map' => $iconLabel('heroicon-o-map', 'Mapa'),
            'heroicon-o-phone' => $iconLabel('heroicon-o-phone', 'Teléfono'),
            'heroicon-o-envelope' => $iconLabel('heroicon-o-envelope', 'Correo'),
            'heroicon-o-chat-bubble-left-right' => $iconLabel('heroicon-o-chat-bubble-left-right', 'Mensaje'),
            'heroicon-o-chat-bubble-oval-left' => $iconLabel('heroicon-o-chat-bubble-oval-left', 'Comentario'),

            'heroicon-o-bell' => $iconLabel('heroicon-o-bell', 'Notificación'),
            'heroicon-o-lock-closed' => $iconLabel('heroicon-o-lock-closed', 'Seguridad'),
            'heroicon-o-lock-open' => $iconLabel('heroicon-o-lock-open', 'Acceso'),
            'heroicon-o-cog-6-tooth' => $iconLabel('heroicon-o-cog-6-tooth', 'Configuración'),
            'heroicon-o-wrench-screwdriver' => $iconLabel('heroicon-o-wrench-screwdriver', 'Herramientas'),

            'heroicon-o-camera' => $iconLabel('heroicon-o-camera', 'Cámara'),
            'heroicon-o-photo' => $iconLabel('heroicon-o-photo', 'Imagen'),
            'heroicon-o-video-camera' => $iconLabel('heroicon-o-video-camera', 'Video'),
            'heroicon-o-calendar-days' => $iconLabel('heroicon-o-calendar-days', 'Calendario'),
            'heroicon-o-clock' => $iconLabel('heroicon-o-clock', 'Tiempo'),
            'heroicon-o-tag' => $iconLabel('heroicon-o-tag', 'Etiqueta'),
            'heroicon-o-book-open' => $iconLabel('heroicon-o-book-open', 'Libro'),
            'heroicon-o-newspaper' => $iconLabel('heroicon-o-newspaper', 'Noticias'),

            'heroicon-o-home' => $iconLabel('heroicon-o-home', 'Inicio'),
            'heroicon-o-banknotes' => $iconLabel('heroicon-o-banknotes', 'Dinero'),
            'heroicon-o-credit-card' => $iconLabel('heroicon-o-credit-card', 'Tarjeta'),
            'heroicon-o-shield-check' => $iconLabel('heroicon-o-shield-check', 'Protección'),
            'heroicon-o-server' => $iconLabel('heroicon-o-server', 'Servidor'),
            'heroicon-o-cloud' => $iconLabel('heroicon-o-cloud', 'Nube'),
            'heroicon-o-computer-desktop' => $iconLabel('heroicon-o-computer-desktop', 'Computadora'),
            'heroicon-o-device-phone-mobile' => $iconLabel('heroicon-o-device-phone-mobile', 'Teléfono móvil'),
            'heroicon-o-printer' => $iconLabel('heroicon-o-printer', 'Impresora'),
            'heroicon-o-qr-code' => $iconLabel('heroicon-o-qr-code', 'Código QR'),
            'heroicon-o-key' => $iconLabel('heroicon-o-key', 'Llave'),
            'heroicon-o-finger-print' => $iconLabel('heroicon-o-finger-print', 'Huella'),
            'heroicon-o-lifebuoy' => $iconLabel('heroicon-o-lifebuoy', 'Ayuda'),
            'heroicon-o-megaphone' => $iconLabel('heroicon-o-megaphone', 'Anuncio'),
            'heroicon-o-speaker-wave' => $iconLabel('heroicon-o-speaker-wave', 'Sonido'),
            'heroicon-o-wifi' => $iconLabel('heroicon-o-wifi', 'Wifi'),
            'heroicon-o-power' => $iconLabel('heroicon-o-power', 'Encendido'),
            'heroicon-o-trash' => $iconLabel('heroicon-o-trash', 'Eliminar'),
            'heroicon-o-pencil-square' => $iconLabel('heroicon-o-pencil-square', 'Editar'),
            'heroicon-o-plus' => $iconLabel('heroicon-o-plus', 'Más'),
            'heroicon-o-minus' => $iconLabel('heroicon-o-minus', 'Menos'),
            'heroicon-o-bars-3' => $iconLabel('heroicon-o-bars-3', 'Menú'),
            'heroicon-o-ellipsis-horizontal' => $iconLabel('heroicon-o-ellipsis-horizontal', 'Más opciones'),
            'heroicon-o-adjustments-horizontal' => $iconLabel('heroicon-o-adjustments-horizontal', 'Ajustes'),
            'heroicon-o-funnel' => $iconLabel('heroicon-o-funnel', 'Filtro'),
            'heroicon-o-inbox' => $iconLabel('heroicon-o-inbox', 'Bandeja'),
            'heroicon-o-paper-airplane' => $iconLabel('heroicon-o-paper-airplane', 'Enviar'),
        ];

        return $schema
            ->components([
                Section::make('1. Título principal del banner')
                    ->description('Divide el título en partes para elegir qué texto va de cada color.')
                    ->components([
                        TextInput::make('title')
                            ->label('Título completo de respaldo')
                            ->helperText('Se usa solo si no llenas las partes del título.')
                            ->placeholder('La donación de cerebro es una esperanza para el futuro')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('title_part_1')
                            ->label('Título parte 1')
                            ->placeholder('La donación de cerebro es una')
                            ->helperText('Primera parte del título.')
                            ->maxLength(255),

                        Select::make('title_part_1_color_id')
                            ->label('Color parte 1')
                            ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                            ->searchable()
                            ->searchPrompt('Buscar color...')
                            ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                            ->native(false),

                        TextInput::make('title_part_2')
                            ->label('Título parte 2')
                            ->placeholder('esperanza para')
                            ->helperText('Segunda parte del título.')
                            ->maxLength(255),

                        Select::make('title_part_2_color_id')
                            ->label('Color parte 2')
                            ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                            ->searchable()
                            ->searchPrompt('Buscar color...')
                            ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                            ->native(false),

                        TextInput::make('title_part_3')
                            ->label('Título parte 3')
                            ->placeholder('el futuro')
                            ->helperText('Todo lo que escribas aquí tendrá el color elegido.')
                            ->maxLength(255),

                        Select::make('title_part_3_color_id')
                            ->label('Color parte 3')
                            ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                            ->searchable()
                            ->searchPrompt('Buscar color...')
                            ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                            ->native(false),
                    ])
                    ->columns(2),

                Section::make('2. Etiqueta superior')
                    ->description('Controla el texto, color de letra, contorno y fondo de la etiqueta que aparece arriba del título.')
                    ->components([
                        TextInput::make('subtitle')
                            ->label('Texto de la etiqueta superior')
                            ->placeholder('Unidad de Diagnóstico e Investigación')
                            ->helperText('Se mostrará exactamente como lo escribas, respetando mayúsculas y minúsculas.')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Select::make('subtitle_text_color_id')
                            ->label('Color de la letra')
                            ->helperText('Este color se aplica al texto de la etiqueta superior.')
                            ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                            ->searchable()
                            ->searchPrompt('Buscar color...')
                            ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                            ->native(false),

                        Select::make('subtitle_border_color_id')
                            ->label('Color del contorno / borde')
                            ->helperText('Este color se aplica al borde de la cajita.')
                            ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                            ->searchable()
                            ->searchPrompt('Buscar color...')
                            ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                            ->native(false),

                        Select::make('subtitle_background_color_id')
                            ->label('Color del fondo')
                            ->helperText('Este color se aplica al fondo de la cajita.')
                            ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                            ->searchable()
                            ->searchPrompt('Buscar color...')
                            ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                            ->native(false),

                        TextInput::make('subtitle_background_opacity')
                            ->label('Opacidad del fondo')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->default(20)
                            ->suffix('%')
                            ->helperText('0 = transparente, 20 = suave, 100 = sólido.'),
                    ])
                    ->columns(2),

                Section::make('3. Descripción del banner')
                    ->description('Aquí solo va el texto descriptivo del banner. No pegues código Blade, @extends, @section, @php ni scripts.')
                    ->components([
                        RichEditor::make('content')
                            ->label('Descripción')
                            ->helperText('Escribe solo texto normal del banner.')
                            ->columnSpanFull(),
                    ]),

                Section::make('4. Diseño general del banner')
                    ->description('Imagen de fondo, opacidad y colores generales.')
                    ->components([
                        Select::make('background_media_asset_id')
                            ->label('Imagen de fondo')
                            ->options(fn () => MediaAsset::query()
                                ->where('is_active', true)
                                ->orderBy('name')
                                ->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->native(false),

                        TextInput::make('background_opacity')
                            ->label('Opacidad de imagen')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->default(80)
                            ->suffix('%')
                            ->helperText('0 = invisible, 80 = fuerte, 100 = completa.'),

                        Select::make('text_color_id')
                            ->label('Color principal / respaldo')
                            ->helperText('Se usa como color general si alguna parte no tiene color.')
                            ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                            ->searchable()
                            ->searchPrompt('Buscar color...')
                            ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                            ->native(false),

                        Select::make('accent_color_id')
                            ->label('Color secundario / respaldo')
                            ->helperText('Respaldo para diseños anteriores.')
                            ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                            ->searchable()
                            ->searchPrompt('Buscar color...')
                            ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                            ->native(false),

                        Select::make('tertiary_color_id')
                            ->label('Color terciario / respaldo')
                            ->helperText('Respaldo para diseños anteriores.')
                            ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                            ->searchable()
                            ->searchPrompt('Buscar color...')
                            ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                            ->native(false),
                    ])
                    ->columns(2),

                Section::make('5. Estadísticas del banner')
                    ->description('Números animados que aparecen debajo del banner.')
                    ->components([
                        TextInput::make('stat_1_number')
                            ->label('Número 1')
                            ->numeric()
                            ->default(2433),

                        TextInput::make('stat_1_label')
                            ->label('Texto 1')
                            ->default('Pacientes')
                            ->maxLength(255),

                        Select::make('stat_1_color_id')
                            ->label('Color del número 1')
                            ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                            ->searchable()
                            ->searchPrompt('Buscar color...')
                            ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                            ->native(false),

                        Select::make('stat_1_label_color_id')
                            ->label('Color del texto 1')
                            ->helperText('Color de la palabra “Pacientes”.')
                            ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                            ->searchable()
                            ->searchPrompt('Buscar color...')
                            ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                            ->native(false),

                        TextInput::make('stat_2_number')
                            ->label('Número 2')
                            ->numeric()
                            ->default(149),

                        TextInput::make('stat_2_label')
                            ->label('Texto 2')
                            ->default('Estudios')
                            ->maxLength(255),

                        Select::make('stat_2_color_id')
                            ->label('Color del número 2')
                            ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                            ->searchable()
                            ->searchPrompt('Buscar color...')
                            ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                            ->native(false),

                        Select::make('stat_2_label_color_id')
                            ->label('Color del texto 2')
                            ->helperText('Color de la palabra “Estudios”.')
                            ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                            ->searchable()
                            ->searchPrompt('Buscar color...')
                            ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                            ->native(false),

                        TextInput::make('stat_3_number')
                            ->label('Número 3')
                            ->numeric()
                            ->default(102),

                        TextInput::make('stat_3_label')
                            ->label('Texto 3')
                            ->default('Materiales')
                            ->maxLength(255),

                        Select::make('stat_3_color_id')
                            ->label('Color del número 3')
                            ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                            ->searchable()
                            ->searchPrompt('Buscar color...')
                            ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                            ->native(false),

                        Select::make('stat_3_label_color_id')
                            ->label('Color del texto 3')
                            ->helperText('Color de la palabra “Materiales”.')
                            ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                            ->searchable()
                            ->searchPrompt('Buscar color...')
                            ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                            ->native(false),

                        TextInput::make('stat_4_number')
                            ->label('Número 4')
                            ->numeric()
                            ->default(15),

                        TextInput::make('stat_4_label')
                            ->label('Texto 4')
                            ->default('Donaciones')
                            ->maxLength(255),

                        Select::make('stat_4_color_id')
                            ->label('Color del número 4')
                            ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                            ->searchable()
                            ->searchPrompt('Buscar color...')
                            ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                            ->native(false),

                        Select::make('stat_4_label_color_id')
                            ->label('Color del texto 4')
                            ->helperText('Color de la palabra “Donaciones”.')
                            ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                            ->searchable()
                            ->searchPrompt('Buscar color...')
                            ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                            ->native(false),
                    ])
                    ->columns(3),

                Section::make('6. Botón principal')
                    ->description('Configura todo lo relacionado con el primer botón del banner: texto, enlace, icono, colores, redondeo y efecto al pasar el mouse.')
                    ->components([
                        Section::make('6.1 Contenido del botón principal')
                            ->components([
                                TextInput::make('primary_button_text')
                                    ->label('Texto del botón')
                                    ->default('Contáctanos')
                                    ->maxLength(255),

                                TextInput::make('primary_button_url')
                                    ->label('URL / enlace')
                                    ->default('/contacto')
                                    ->maxLength(255),

                                Select::make('primary_button_icon')
                                    ->label('Icono')
                                    ->options($iconOptions)
                                    ->allowHtml()
                                    ->searchable()
                                    ->searchPrompt('Buscar icono...')
                                    ->noSearchResultsMessage('No se encontró ningún icono.')
                                    ->native(false)
                                    ->helperText(new HtmlString('Ejemplo: busca <strong>documento</strong>, <strong>like</strong>, <strong>descargar</strong>, <strong>buscar</strong>.')),
                            ])
                            ->columns(3),

                        Section::make('6.2 Diseño normal del botón principal')
                            ->description('Así se verá el botón cuando el mouse no esté encima.')
                            ->components([
                                Select::make('primary_button_color_id')
                                    ->label('Color de fondo')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                TextInput::make('primary_button_opacity')
                                    ->label('Opacidad del fondo')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(100)
                                    ->default(100)
                                    ->suffix('%')
                                    ->helperText('100 = sólido, 15 = transparente.'),

                                TextInput::make('primary_button_radius')
                                    ->label('Redondeo del botón')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(50)
                                    ->default(6)
                                    ->suffix('px'),

                                Select::make('primary_button_text_color_id')
                                    ->label('Color del texto')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('primary_button_icon_color_id')
                                    ->label('Color del icono')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),
                            ])
                            ->columns(3),

                        Section::make('6.3 Diseño del botón principal al pasar el mouse')
                            ->description('Estos colores se aplican cuando el usuario pasa el mouse encima del botón.')
                            ->components([
                                Select::make('primary_button_hover_color_id')
                                    ->label('Color de fondo al pasar el mouse')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('primary_button_hover_text_color_id')
                                    ->label('Color del texto al pasar el mouse')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('primary_button_hover_icon_color_id')
                                    ->label('Color del icono al pasar el mouse')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),
                            ])
                            ->columns(3),
                    ])
                    ->columns(1),

                Section::make('7. Botón secundario')
                    ->description('Configura todo lo relacionado con el segundo botón del banner: texto, enlace, icono, colores, redondeo y efecto al pasar el mouse.')
                    ->components([
                        Section::make('7.1 Contenido del botón secundario')
                            ->components([
                                TextInput::make('secondary_button_text')
                                    ->label('Texto del botón')
                                    ->default('Documentos')
                                    ->maxLength(255),

                                TextInput::make('secondary_button_url')
                                    ->label('URL / enlace')
                                    ->default('/documentos')
                                    ->maxLength(255),

                                Select::make('secondary_button_icon')
                                    ->label('Icono')
                                    ->options($iconOptions)
                                    ->allowHtml()
                                    ->searchable()
                                    ->searchPrompt('Buscar icono...')
                                    ->noSearchResultsMessage('No se encontró ningún icono.')
                                    ->native(false)
                                    ->helperText(new HtmlString('Ejemplo: busca <strong>documento</strong>, <strong>like</strong>, <strong>descargar</strong>, <strong>buscar</strong>.')),
                            ])
                            ->columns(3),

                        Section::make('7.2 Diseño normal del botón secundario')
                            ->description('Así se verá el botón cuando el mouse no esté encima. Para hacerlo blanco transparente: Fondo Blanco + opacidad 10% a 20%.')
                            ->components([
                                Select::make('secondary_button_color_id')
                                    ->label('Color de fondo')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                TextInput::make('secondary_button_opacity')
                                    ->label('Opacidad del fondo')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(100)
                                    ->default(15)
                                    ->suffix('%'),

                                TextInput::make('secondary_button_radius')
                                    ->label('Redondeo del botón')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(50)
                                    ->default(6)
                                    ->suffix('px'),

                                Select::make('secondary_button_text_color_id')
                                    ->label('Color del texto')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('secondary_button_icon_color_id')
                                    ->label('Color del icono')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),
                            ])
                            ->columns(3),

                        Section::make('7.3 Diseño del botón secundario al pasar el mouse')
                            ->description('Estos colores se aplican cuando el usuario pasa el mouse encima del botón.')
                            ->components([
                                Select::make('secondary_button_hover_color_id')
                                    ->label('Color de fondo al pasar el mouse')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('secondary_button_hover_text_color_id')
                                    ->label('Color del texto al pasar el mouse')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('secondary_button_hover_icon_color_id')
                                    ->label('Color del icono al pasar el mouse')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),
                            ])
                            ->columns(3),
                    ])
                    ->columns(1),

                Section::make('8. Bloque: ¿Qué hacemos?')
                    ->description('Configura el bloque corto que resume el trabajo principal del BND en la página de Inicio.')
                    ->components([
                        Section::make('8.1 Encabezado del bloque')
                            ->description('Texto principal que aparece arriba de las tres tarjetas.')
                            ->components([
                                TextInput::make('what_we_do_label')
                                    ->label('Texto pequeño superior')
                                    ->default('¿Qué hacemos?')
                                    ->helperText('Este texto aparece arriba del título principal del bloque.')
                                    ->maxLength(255),

                                Select::make('what_we_do_label_color_id')
                                    ->label('Color del texto pequeño superior')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                TextInput::make('what_we_do_title')
                                    ->label('Título')
                                    ->default('Diagnóstico, investigación y preservación al servicio de la salud')
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                Select::make('what_we_do_title_color_id')
                                    ->label('Color del título')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                RichEditor::make('what_we_do_content')
                                    ->label('Texto corto')
                                    ->default('En el BND apoyamos el estudio de Alzheimer y otras demencias mediante diagnóstico especializado, investigación científica y preservación de muestras biológicas.')
                                    ->helperText('Este texto aparece debajo del título del bloque.')
                                    ->columnSpanFull(),

                                Select::make('what_we_do_content_color_id')
                                    ->label('Color del texto corto')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),
                            ])
                            ->columns(2),

                        Section::make('8.2 Fondo de la sección')
                            ->description('Configura el fondo completo del bloque ¿Qué hacemos?, con color sólido o degradado.')
                            ->components([
                                Toggle::make('what_we_do_use_gradient')
                                    ->label('Usar degradado')
                                    ->helperText('Si está activado, se usarán los colores “Degradado desde” y “Degradado hasta”.')
                                    ->live()
                                    ->default(false),

                                Select::make('what_we_do_background_color_id')
                                    ->label('Color de fondo sólido')
                                    ->helperText('Se usa cuando el degradado está apagado.')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false)
                                    ->visible(fn ($get) => ! (bool) $get('what_we_do_use_gradient')),

                                Select::make('what_we_do_gradient_from_color_id')
                                    ->label('Degradado desde')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false)
                                    ->visible(fn ($get) => (bool) $get('what_we_do_use_gradient')),

                                Select::make('what_we_do_gradient_to_color_id')
                                    ->label('Degradado hasta')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false)
                                    ->visible(fn ($get) => (bool) $get('what_we_do_use_gradient')),
                            ])
                            ->columns(2),

                        Section::make('8.3 Tarjeta 1: Diagnóstico especializado')
                            ->description('Configura el contenido y los colores de la primera tarjeta.')
                            ->components([
                                TextInput::make('what_card_1_title')
                                    ->label('Título')
                                    ->default('Diagnóstico especializado')
                                    ->maxLength(255),

                                Select::make('what_card_1_icon')
                                    ->label('Icono')
                                    ->options($iconOptions)
                                    ->allowHtml()
                                    ->default('heroicon-o-beaker')
                                    ->searchable()
                                    ->preload()
                                    ->searchPrompt('Buscar icono...')
                                    ->noSearchResultsMessage('No se encontró ningún icono.')
                                    ->native(false),

                                RichEditor::make('what_card_1_content')
                                    ->label('Texto')
                                    ->default('Apoyo al diagnóstico histopatológico post-mortem en enfermedades neurodegenerativas.')
                                    ->columnSpanFull(),

                                TextInput::make('what_card_1_button_text')
                                    ->label('Texto del enlace')
                                    ->default('Ver más en Investigación')
                                    ->maxLength(255),

                                TextInput::make('what_card_1_button_url')
                                    ->label('URL del enlace')
                                    ->default('/investigacion')
                                    ->maxLength(255),

                                Select::make('what_card_1_background_color_id')
                                    ->label('Fondo de la tarjeta')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('what_card_1_title_color_id')
                                    ->label('Color del título')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('what_card_1_content_color_id')
                                    ->label('Color de la descripción')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('what_card_1_icon_color_id')
                                    ->label('Color del icono')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('what_card_1_icon_background_color_id')
                                    ->label('Fondo del icono')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('what_card_1_link_color_id')
                                    ->label('Color del enlace')
                                    ->helperText('Color del enlace “Ver más en Investigación”.')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),
                            ])
                            ->columns(2),

                        Section::make('8.4 Tarjeta 2: Investigación científica')
                            ->description('Configura el contenido y los colores de la segunda tarjeta.')
                            ->components([
                                TextInput::make('what_card_2_title')
                                    ->label('Título')
                                    ->default('Investigación científica')
                                    ->maxLength(255),

                                Select::make('what_card_2_icon')
                                    ->label('Icono')
                                    ->options($iconOptions)
                                    ->allowHtml()
                                    ->default('heroicon-o-academic-cap')
                                    ->searchable()
                                    ->preload()
                                    ->searchPrompt('Buscar icono...')
                                    ->noSearchResultsMessage('No se encontró ningún icono.')
                                    ->native(false),

                                RichEditor::make('what_card_2_content')
                                    ->label('Texto')
                                    ->default('Búsqueda de biomarcadores para mejorar la detección y comprensión de las demencias.')
                                    ->columnSpanFull(),

                                TextInput::make('what_card_2_button_text')
                                    ->label('Texto del enlace')
                                    ->default('Ver más en Investigación')
                                    ->maxLength(255),

                                TextInput::make('what_card_2_button_url')
                                    ->label('URL del enlace')
                                    ->default('/investigacion')
                                    ->maxLength(255),

                                Select::make('what_card_2_background_color_id')
                                    ->label('Fondo de la tarjeta')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('what_card_2_title_color_id')
                                    ->label('Color del título')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('what_card_2_content_color_id')
                                    ->label('Color de la descripción')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('what_card_2_icon_color_id')
                                    ->label('Color del icono')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('what_card_2_icon_background_color_id')
                                    ->label('Fondo del icono')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('what_card_2_link_color_id')
                                    ->label('Color del enlace')
                                    ->helperText('Color del enlace “Ver más en Investigación”.')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),
                            ])
                            ->columns(2),

                        Section::make('8.5 Tarjeta 3: Donación y preservación')
                            ->description('Configura el contenido y los colores de la tercera tarjeta.')
                            ->components([
                                TextInput::make('what_card_3_title')
                                    ->label('Título')
                                    ->default('Donación y preservación')
                                    ->maxLength(255),

                                Select::make('what_card_3_icon')
                                    ->label('Icono')
                                    ->options($iconOptions)
                                    ->allowHtml()
                                    ->default('heroicon-o-heart')
                                    ->searchable()
                                    ->preload()
                                    ->searchPrompt('Buscar icono...')
                                    ->noSearchResultsMessage('No se encontró ningún icono.')
                                    ->native(false),

                                RichEditor::make('what_card_3_content')
                                    ->label('Texto')
                                    ->default('Procesamiento y resguardo de tejidos y fluidos con fines científicos y bioéticos.')
                                    ->columnSpanFull(),

                                TextInput::make('what_card_3_button_text')
                                    ->label('Texto del enlace')
                                    ->default('Conocer proceso')
                                    ->maxLength(255),

                                TextInput::make('what_card_3_button_url')
                                    ->label('URL del enlace')
                                    ->default('/investigacion')
                                    ->maxLength(255),

                                Select::make('what_card_3_background_color_id')
                                    ->label('Fondo de la tarjeta')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('what_card_3_title_color_id')
                                    ->label('Color del título')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('what_card_3_content_color_id')
                                    ->label('Color de la descripción')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('what_card_3_icon_color_id')
                                    ->label('Color del icono')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('what_card_3_icon_background_color_id')
                                    ->label('Fondo del icono')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('what_card_3_link_color_id')
                                    ->label('Color del enlace')
                                    ->helperText('Color del enlace “Conocer proceso”.')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),
                            ])
                            ->columns(2),
                    ])
                    ->columns(1),

                Section::make('9. Cierre corto de contacto')
                    ->description('Configura el llamado a la acción final del Inicio.')
                    ->components([
                        Section::make('10.1 Contenido del cierre de contacto')
                            ->description('Texto principal del bloque final.')
                            ->components([
                                TextInput::make('contact_cta_title')
                                    ->label('Título')
                                    ->default('¿Necesitas orientación?')
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                RichEditor::make('contact_cta_content')
                                    ->label('Texto')
                                    ->default('Contáctanos para recibir información sobre donación, investigación, documentos o servicios del BND.')
                                    ->columnSpanFull(),

                                Select::make('contact_cta_title_color_id')
                                    ->label('Color del título')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('contact_cta_content_color_id')
                                    ->label('Color del texto')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),
                            ])
                            ->columns(2),

                        Section::make('10.2 Fondo del cierre de contacto')
                            ->description('Elige un fondo sólido o un degradado para el bloque.')
                            ->components([
                                Toggle::make('contact_cta_use_gradient')
                                    ->label('Usar degradado')
                                    ->helperText('Si está activado, se usarán los colores “Degradado desde” y “Degradado hasta”.')
                                    ->live()
                                    ->default(false),

                                Select::make('contact_cta_background_color_id')
                                    ->label('Color de fondo sólido')
                                    ->helperText('Se usa cuando el degradado está apagado.')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false)
                                    ->visible(fn ($get) => ! (bool) $get('contact_cta_use_gradient')),

                                Select::make('contact_cta_gradient_from_color_id')
                                    ->label('Degradado desde')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false)
                                    ->visible(fn ($get) => (bool) $get('contact_cta_use_gradient')),

                                Select::make('contact_cta_gradient_to_color_id')
                                    ->label('Degradado hasta')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false)
                                    ->visible(fn ($get) => (bool) $get('contact_cta_use_gradient')),
                            ])
                            ->columns(2),

                        Section::make('10.3 Botón del cierre de contacto')
                            ->description('Configura el texto, enlace, icono, colores del botón normal y al pasar el mouse.')
                            ->components([
                                TextInput::make('contact_cta_button_text')
                                    ->label('Texto del botón')
                                    ->default('Contactar al BND')
                                    ->maxLength(255),

                                TextInput::make('contact_cta_button_url')
                                    ->label('URL del botón')
                                    ->default('/contacto')
                                    ->maxLength(255),

                                Select::make('contact_cta_button_icon')
                                    ->label('Icono del botón')
                                    ->options($iconOptions)
                                    ->allowHtml()
                                    ->searchable()
                                    ->preload()
                                    ->searchPrompt('Buscar icono...')
                                    ->noSearchResultsMessage('No se encontró ningún icono.')
                                    ->native(false)
                                    ->default('heroicon-o-arrow-right'),

                                TextInput::make('contact_cta_button_radius')
                                    ->label('Redondeo del botón')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(50)
                                    ->default(12)
                                    ->suffix('px'),

                                Select::make('contact_cta_button_color_id')
                                    ->label('Color del botón')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('contact_cta_button_text_color_id')
                                    ->label('Color del texto del botón')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('contact_cta_button_icon_color_id')
                                    ->label('Color del icono')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('contact_cta_button_hover_color_id')
                                    ->label('Color de fondo al pasar el mouse')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('contact_cta_button_hover_text_color_id')
                                    ->label('Color del texto al pasar el mouse')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),

                                Select::make('contact_cta_button_hover_icon_color_id')
                                    ->label('Color del icono al pasar el mouse')
                                    ->options($colorOptions)
                            ->allowHtml()
                            ->getSearchResultsUsing($colorSearchResults)
                            ->getOptionLabelUsing($colorOptionLabel)
                                    ->searchable()
                            ->searchPrompt('Buscar color...')
                                    ->preload()
                            ->noSearchResultsMessage('No se encontró ningún color.')
                                    ->native(false),
                            ])
                            ->columns(3),
                    ])
                    ->columns(1),

                Section::make('10. Configuración')
                    ->description('Orden y estado de publicación.')
                    ->components([
                        TextInput::make('sort_order')
                            ->label('Orden')
                            ->numeric()
                            ->default(1)
                            ->minValue(0),

                        Toggle::make('is_active')
                            ->label('Activo')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
