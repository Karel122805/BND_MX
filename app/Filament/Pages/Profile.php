<?php

namespace App\Filament\Pages;

use BackedEnum;
use UnitEnum;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class Profile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-user-circle';

    protected static string | UnitEnum | null $navigationGroup = 'Mi cuenta';

    protected static ?string $navigationLabel = 'Mi perfil';

    protected static ?string $title = 'Mi perfil';

    protected static ?string $slug = 'mi-perfil';

    protected static ?int $navigationSort = 1;

    protected static bool $shouldRegisterNavigation = true;

    protected string $view = 'filament.pages.profile';

    public ?array $data = [];

    public ?string $currentPhotoUrl = null;

    public function mount(): void
    {
        $user = Auth::user();

        $this->currentPhotoUrl = $user->profile_photo
            ? asset('storage/' . $user->profile_photo)
            : null;

        $this->form->fill([
            'name' => $user->name,
            'email' => $user->email,
            'new_profile_photo' => null,
            'password' => null,
            'password_confirmation' => null,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información personal')
                    ->description('Actualiza tu nombre, correo, contraseña y foto de perfil.')
                    ->components([
                        FileUpload::make('new_profile_photo')
                            ->label('Nueva foto de perfil')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '1:1',
                            ])
                            ->imageCropAspectRatio('1:1')
                            ->directory('profile-photos')
                            ->disk('public')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'image/webp',
                            ])
                            ->columnSpanFull(),

                        TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('Correo electrónico')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->rule(fn () => Rule::unique('users', 'email')->ignore(Auth::id())),

                        TextInput::make('password')
                            ->label('Nueva contraseña')
                            ->password()
                            ->revealable()
                            ->dehydrated(fn ($state) => filled($state))
                            ->rule(Password::default())
                            ->same('password_confirmation'),

                        TextInput::make('password_confirmation')
                            ->label('Confirmar nueva contraseña')
                            ->password()
                            ->revealable()
                            ->dehydrated(false),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $user = Auth::user();

        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];

        if (! empty($data['new_profile_photo'])) {
            $updateData['profile_photo'] = $data['new_profile_photo'];
        }

        if (! empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        $user->update($updateData);

        $user->refresh();

        $this->currentPhotoUrl = $user->profile_photo
            ? asset('storage/' . $user->profile_photo)
            : null;

        $this->form->fill([
            'name' => $user->name,
            'email' => $user->email,
            'new_profile_photo' => null,
            'password' => null,
            'password_confirmation' => null,
        ]);

        Notification::make()
            ->title('Perfil actualizado correctamente')
            ->success()
            ->send();
    }
}