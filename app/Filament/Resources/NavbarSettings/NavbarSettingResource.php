<?php

namespace App\Filament\Resources\NavbarSettings;

use App\Filament\Resources\NavbarSettings\Pages\CreateNavbarSetting;
use App\Filament\Resources\NavbarSettings\Pages\EditNavbarSetting;
use App\Filament\Resources\NavbarSettings\Pages\ListNavbarSettings;
use App\Filament\Resources\NavbarSettings\Schemas\NavbarSettingForm;
use App\Filament\Resources\NavbarSettings\Tables\NavbarSettingsTable;
use App\Models\NavbarSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class NavbarSettingResource extends Resource
{
    protected static ?string $model = NavbarSetting::class;

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'id';

    protected static string | \UnitEnum | null $navigationGroup = 'General';

    protected static ?string $navigationLabel = 'Configuración de barra';

    protected static ?string $modelLabel = 'configuración de barra';

    protected static ?string $pluralModelLabel = 'configuración de barra';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return NavbarSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NavbarSettingsTable::configure($table);
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
            'index' => ListNavbarSettings::route('/'),
            'create' => CreateNavbarSetting::route('/create'),
            'edit' => EditNavbarSetting::route('/{record}/edit'),
        ];
    }

    /**
     * Solo superadmin puede ver Configuración de barra.
     */
    public static function canViewAny(): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }

    /**
     * Solo superadmin puede crear Configuración de barra.
     */
    public static function canCreate(): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }

    /**
     * Solo superadmin puede editar Configuración de barra.
     */
    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }

    /**
     * Solo superadmin puede eliminar Configuración de barra.
     */
    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }

    /**
     * Solo superadmin puede eliminar Configuración de barra en lote.
     */
    public static function canDeleteAny(): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }
}