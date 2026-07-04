<?php

namespace App\Filament\Resources\Authorities\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AuthorityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),

                TextInput::make('position')
                    ->label('Cargo')
                    ->maxLength(255),

                TextInput::make('institution')
                    ->label('Institución')
                    ->maxLength(255),

                FileUpload::make('photo')
                    ->label('Foto')
                    ->image()
                    ->directory('authorities')
                    ->disk('public')
                    ->visibility('public')
                    ->imageEditor()
                    ->maxSize(2048),

                Textarea::make('description')
                    ->label('Descripción')
                    ->columnSpanFull(),

                TextInput::make('sort_order')
                    ->label('Orden')
                    ->required()
                    ->numeric()
                    ->default(0),

                Toggle::make('is_active')
                    ->label('Activo')
                    ->required()
                    ->default(true),
            ]);
    }
}