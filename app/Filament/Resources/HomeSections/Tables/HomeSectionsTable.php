<?php

namespace App\Filament\Resources\HomeSections\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HomeSectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('backgroundMediaAsset.file')
                    ->label('Fondo')
                    ->disk('public')
                    ->height(55)
                    ->width(95)
                    ->extraImgAttributes([
                        'style' => 'object-fit: cover; border-radius: 10px;',
                    ]),

                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->limit(45),

                TextColumn::make('subtitle')
                    ->label('Subtítulo')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->limit(35)
                    ->toggleable(),

                TextColumn::make('background_opacity')
                    ->label('Opacidad fondo')
                    ->suffix('%')
                    ->sortable(),

                TextColumn::make('stat_1_number')
                    ->label('Núm. 1')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('stat_1_label')
                    ->label('Texto 1')
                    ->toggleable(),

                TextColumn::make('stat_2_number')
                    ->label('Núm. 2')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('stat_2_label')
                    ->label('Texto 2')
                    ->toggleable(),

                TextColumn::make('primary_button_text')
                    ->label('Botón 1')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('primary_button_opacity')
                    ->label('Opacidad B1')
                    ->suffix('%')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('secondary_button_text')
                    ->label('Botón 2')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('secondary_button_opacity')
                    ->label('Opacidad B2')
                    ->suffix('%')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('sort_order')
                    ->label('Orden')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Editar'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Eliminar seleccionados'),
                ]),
            ]);
    }
}