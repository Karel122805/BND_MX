<?php

namespace App\Filament\Resources\ThemeColors;

use App\Filament\Resources\ThemeColors\Pages\CreateThemeColor;
use App\Filament\Resources\ThemeColors\Pages\EditThemeColor;
use App\Filament\Resources\ThemeColors\Pages\ListThemeColors;
use App\Filament\Resources\ThemeColors\Schemas\ThemeColorForm;
use App\Filament\Resources\ThemeColors\Tables\ThemeColorsTable;
use App\Models\ThemeColor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ThemeColorResource extends Resource
{
    protected static ?string $model = ThemeColor::class;

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static string | \UnitEnum | null $navigationGroup = 'General';

    protected static ?string $navigationLabel = 'Colores';

    protected static ?string $modelLabel = 'color';

    protected static ?string $pluralModelLabel = 'colores';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return ThemeColorForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ThemeColorsTable::configure($table);
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
            'index' => ListThemeColors::route('/'),
            'create' => CreateThemeColor::route('/create'),
            'edit' => EditThemeColor::route('/{record}/edit'),
        ];
    }

    /**
     * Solo superadmin puede ver Colores.
     */
    public static function canViewAny(): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }

    /**
     * Solo superadmin puede crear Colores.
     */
    public static function canCreate(): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }

    /**
     * Solo superadmin puede editar Colores.
     */
    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }

    /**
     * Solo superadmin puede eliminar Colores.
     */
    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }

    /**
     * Solo superadmin puede eliminar Colores en lote.
     */
    public static function canDeleteAny(): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }
}