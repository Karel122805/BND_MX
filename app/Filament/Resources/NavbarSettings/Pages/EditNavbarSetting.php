<?php

namespace App\Filament\Resources\NavbarSettings\Pages;

use App\Filament\Resources\NavbarSettings\NavbarSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditNavbarSetting extends EditRecord
{
    protected static string $resource = NavbarSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
