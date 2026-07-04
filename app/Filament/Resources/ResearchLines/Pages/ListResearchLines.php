<?php

namespace App\Filament\Resources\ResearchLines\Pages;

use App\Filament\Resources\ResearchLines\ResearchLineResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListResearchLines extends ListRecords
{
    protected static string $resource = ResearchLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
