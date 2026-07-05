<?php

namespace App\Filament\Resources\ResearchSections\Pages;

use App\Filament\Resources\ResearchSections\ResearchSectionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditResearchSection extends EditRecord
{
    protected static string $resource = ResearchSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
