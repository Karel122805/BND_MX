<?php

namespace App\Filament\Resources\ResearchSections;

use App\Filament\Resources\ResearchSections\Pages\CreateResearchSection;
use App\Filament\Resources\ResearchSections\Pages\EditResearchSection;
use App\Filament\Resources\ResearchSections\Pages\ListResearchSections;
use App\Filament\Resources\ResearchSections\Schemas\ResearchSectionForm;
use App\Filament\Resources\ResearchSections\Tables\ResearchSectionsTable;
use App\Models\ResearchSection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ResearchSectionResource extends Resource
{
    protected static ?string $model = ResearchSection::class;

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    protected static string | \UnitEnum | null $navigationGroup = 'Investigación';

    protected static ?string $navigationLabel = 'Secciones de investigación';

    protected static ?string $modelLabel = 'sección de investigación';

    protected static ?string $pluralModelLabel = 'secciones de investigación';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return ResearchSectionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ResearchSectionsTable::configure($table);
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
            'index' => ListResearchSections::route('/'),
            'create' => CreateResearchSection::route('/create'),
            'edit' => EditResearchSection::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->canManagePublicContent() ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->canManagePublicContent() ?? false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->canManagePublicContent() ?? false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->canManagePublicContent() ?? false;
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()?->canManagePublicContent() ?? false;
    }
}