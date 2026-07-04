<?php

namespace App\Filament\Resources\ResearchLines;

use App\Filament\Resources\ResearchLines\Pages\CreateResearchLine;
use App\Filament\Resources\ResearchLines\Pages\EditResearchLine;
use App\Filament\Resources\ResearchLines\Pages\ListResearchLines;
use App\Filament\Resources\ResearchLines\Schemas\ResearchLineForm;
use App\Filament\Resources\ResearchLines\Tables\ResearchLinesTable;
use App\Models\ResearchLine;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ResearchLineResource extends Resource
{
    protected static ?string $model = ResearchLine::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return ResearchLineForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ResearchLinesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListResearchLines::route('/'),
            'create' => CreateResearchLine::route('/create'),
            'edit' => EditResearchLine::route('/{record}/edit'),
        ];
    }
}
