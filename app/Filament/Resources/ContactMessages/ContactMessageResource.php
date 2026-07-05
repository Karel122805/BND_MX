<?php

namespace App\Filament\Resources\ContactMessages;

use App\Filament\Resources\ContactMessages\Pages\CreateContactMessage;
use App\Filament\Resources\ContactMessages\Pages\EditContactMessage;
use App\Filament\Resources\ContactMessages\Pages\ListContactMessages;
use App\Filament\Resources\ContactMessages\Schemas\ContactMessageForm;
use App\Filament\Resources\ContactMessages\Tables\ContactMessagesTable;
use App\Models\ContactMessage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'subject';

    protected static string | \UnitEnum | null $navigationGroup = 'Contacto';

    protected static ?string $navigationLabel = 'Mensajes recibidos';

    protected static ?string $modelLabel = 'mensaje recibido';

    protected static ?string $pluralModelLabel = 'mensajes recibidos';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return ContactMessageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContactMessagesTable::configure($table);
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
            'index' => ListContactMessages::route('/'),
            'create' => CreateContactMessage::route('/create'),
            'edit' => EditContactMessage::route('/{record}/edit'),
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