<?php

namespace App\Filament\Resources\ThemeColors\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ThemeColorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información del color')
                    ->description('Define colores reutilizables para botones, textos, fondos y acentos del sitio público.')
                    ->components([
                        TextInput::make('name')
                            ->label('Nombre')
                            ->placeholder('Ejemplo: Naranja principal')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('key')
                            ->label('Clave')
                            ->placeholder('Ejemplo: primary_orange')
                            ->helperText('Usa una clave corta sin espacios. Ejemplo: primary_orange, dark_blue, text_white.')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        ColorPicker::make('hex')
                            ->label('Color')
                            ->required(),

                        Toggle::make('is_active')
                            ->label('Activo')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}