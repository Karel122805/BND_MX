<?php

namespace App\Filament\Resources\ThemeColors\Pages;

use App\Filament\Resources\ThemeColors\ThemeColorResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditThemeColor extends EditRecord
{
    protected static string $resource = ThemeColorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
