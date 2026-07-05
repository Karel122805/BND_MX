<?php

namespace App\Filament\Resources\ResearchSections\Pages;

use App\Filament\Resources\ResearchSections\ResearchSectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListResearchSections extends ListRecords
{
    protected static string $resource = ResearchSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
