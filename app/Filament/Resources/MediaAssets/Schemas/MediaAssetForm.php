<?php

namespace App\Filament\Resources\MediaAssets\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MediaAssetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información de la imagen')
                    ->description('Sube imágenes reutilizables para banners, fondos, logos y secciones del sitio público.')
                    ->components([
                        TextInput::make('name')
                            ->label('Nombre')
                            ->placeholder('Ejemplo: Fondo principal de inicio')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('key')
                            ->label('Clave')
                            ->placeholder('Ejemplo: home_hero_background')
                            ->helperText('Usa una clave corta sin espacios. Ejemplo: home_hero_background, logo_header.')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        FileUpload::make('file')
                            ->label('Imagen')
                            ->image()
                            ->imageEditor()
                            ->directory('media-assets')
                            ->disk('public')
                            ->visibility('public')
                            ->maxSize(4096)
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('alt')
                            ->label('Texto alternativo')
                            ->placeholder('Ejemplo: Imagen de fondo del BioBanco Nacional de Demencia')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Toggle::make('is_active')
                            ->label('Activo')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}