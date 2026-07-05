<?php

namespace App\Filament\Resources\NavbarSettings\Pages;

use App\Filament\Resources\NavbarSettings\NavbarSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListNavbarSettings extends ListRecords
{
    protected static string $resource = NavbarSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
