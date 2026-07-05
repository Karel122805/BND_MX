<?php

namespace App\Filament\Resources\ThemeFonts;

use App\Filament\Resources\ThemeFonts\Pages\CreateThemeFont;
use App\Filament\Resources\ThemeFonts\Pages\EditThemeFont;
use App\Filament\Resources\ThemeFonts\Pages\ListThemeFonts;
use App\Filament\Resources\ThemeFonts\Schemas\ThemeFontForm;
use App\Filament\Resources\ThemeFonts\Tables\ThemeFontsTable;
use App\Models\ThemeFont;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ThemeFontResource extends Resource
{
    protected static ?string $model = ThemeFont::class;

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static string | \UnitEnum | null $navigationGroup = 'General';

    protected static ?string $navigationLabel = 'Tipografías';

    protected static ?string $modelLabel = 'tipografía';

    protected static ?string $pluralModelLabel = 'tipografías';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return ThemeFontForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ThemeFontsTable::configure($table);
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
            'index' => ListThemeFonts::route('/'),
            'create' => CreateThemeFont::route('/create'),
            'edit' => EditThemeFont::route('/{record}/edit'),
        ];
    }

    /**
     * Solo superadmin puede ver Tipografías.
     */
    public static function canViewAny(): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }

    /**
     * Solo superadmin puede crear Tipografías.
     */
    public static function canCreate(): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }

    /**
     * Solo superadmin puede editar Tipografías.
     */
    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }

    /**
     * Solo superadmin puede eliminar Tipografías.
     */
    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }

    /**
     * Solo superadmin puede eliminar Tipografías en lote.
     */
    public static function canDeleteAny(): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }
}