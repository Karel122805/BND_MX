<?php

namespace App\Filament\Resources\ThemeColors\Pages;

use App\Filament\Resources\ThemeColors\ThemeColorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListThemeColors extends ListRecords
{
    protected static string $resource = ThemeColorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
