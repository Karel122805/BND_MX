<?php

namespace App\Filament\Resources\ThemeFonts\Pages;

use App\Filament\Resources\ThemeFonts\ThemeFontResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListThemeFonts extends ListRecords
{
    protected static string $resource = ThemeFontResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
