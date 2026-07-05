<?php

namespace App\Filament\Resources\ThemeFonts\Pages;

use App\Filament\Resources\ThemeFonts\ThemeFontResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditThemeFont extends EditRecord
{
    protected static string $resource = ThemeFontResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
