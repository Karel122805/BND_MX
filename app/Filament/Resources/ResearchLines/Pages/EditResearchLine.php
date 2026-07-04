<?php

namespace App\Filament\Resources\ResearchLines\Pages;

use App\Filament\Resources\ResearchLines\ResearchLineResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditResearchLine extends EditRecord
{
    protected static string $resource = ResearchLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
