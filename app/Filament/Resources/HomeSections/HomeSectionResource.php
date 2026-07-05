<?php

namespace App\Filament\Resources\HomeSections;

use App\Filament\Resources\HomeSections\Pages\CreateHomeSection;
use App\Filament\Resources\HomeSections\Pages\EditHomeSection;
use App\Filament\Resources\HomeSections\Pages\ListHomeSections;
use App\Filament\Resources\HomeSections\Schemas\HomeSectionForm;
use App\Filament\Resources\HomeSections\Tables\HomeSectionsTable;
use App\Models\HomeSection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;

class HomeSectionResource extends Resource
{
    protected static ?string $model = HomeSection::class;

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    protected static string | UnitEnum | null $navigationGroup = 'Inicio';

    protected static ?string $navigationLabel = 'Secciones de inicio';

    protected static ?string $modelLabel = 'sección de inicio';

    protected static ?string $pluralModelLabel = 'secciones de inicio';

    protected static ?int $navigationSort = 1;

    protected static bool $shouldRegisterNavigation = true;

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->canManagePublicContent() ?? false;
    }

    public static function getNavigationLabel(): string
    {
        return 'Secciones de inicio';
    }

    public static function getNavigationGroup(): string | UnitEnum | null
    {
        return 'Inicio';
    }

    public static function form(Schema $schema): Schema
    {
        return HomeSectionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HomeSectionsTable::configure($table);
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
            'index' => ListHomeSections::route('/'),
            'create' => CreateHomeSection::route('/create'),
            'edit' => EditHomeSection::route('/{record}/edit'),
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