<?php

namespace App\Filament\Resources\NavigationItems\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class NavigationItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('label')
                    ->label('Texto del enlace')
                    ->required()
                    ->maxLength(255),

                Select::make('route_name')
                    ->label('Ruta interna')
                    ->options([
                        'home' => 'Inicio',
                        'about' => 'Nosotros',
                        'authorities' => 'Autoridades',
                        'documents' => 'Documentos',
                        'research' => 'Investigación',
                        'contact' => 'Contacto',
                    ])
                    ->searchable()
                    ->nullable(),

                TextInput::make('url')
                    ->label('URL externa')
                    ->url()
                    ->maxLength(255)
                    ->helperText('Úsalo solo si el enlace va a una página externa.'),

                TextInput::make('sort_order')
                    ->label('Orden')
                    ->required()
                    ->numeric()
                    ->default(0),

                Toggle::make('opens_new_tab')
                    ->label('Abrir en nueva pestaña')
                    ->required()
                    ->default(false),

                Toggle::make('is_active')
                    ->label('Activo')
                    ->required()
                    ->default(true),
            ]);
    }
}