<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser, HasName, HasAvatar
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_photo',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Normaliza el rol para evitar problemas con mayúsculas o espacios.
     */
    public function normalizedRole(): string
    {
        return strtolower(trim((string) $this->role));
    }

    /**
     * Permite entrar al panel BND Control.
     *
     * superadmin: acceso completo.
     * admin: acceso al contenido público y a su perfil.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->is_active === true
            && in_array($this->normalizedRole(), ['superadmin', 'admin'], true);
    }

    /**
     * Nombre que se muestra en Filament.
     */
    public function getFilamentName(): string
    {
        return $this->name ?: $this->email;
    }

    /**
     * Foto/avatar que se muestra en Filament.
     */
    public function getFilamentAvatarUrl(): ?string
    {
        if (! $this->profile_photo) {
            return null;
        }

        return asset('storage/' . $this->profile_photo);
    }

    /**
     * Rol superadmin: puede acceder a todo.
     */
    public function isSuperAdmin(): bool
    {
        return $this->normalizedRole() === 'superadmin';
    }

    /**
     * Rol admin: puede acceder al contenido público y a su perfil.
     */
    public function isAdmin(): bool
    {
        return $this->normalizedRole() === 'admin';
    }

    /**
     * Acceso a configuración general del sistema.
     * Solo superadmin.
     */
    public function canAccessGeneral(): bool
    {
        return $this->isSuperAdmin();
    }

    /**
     * Acceso a gestión de usuarios.
     * Solo superadmin.
     */
    public function canManageUsers(): bool
    {
        return $this->isSuperAdmin();
    }

    /**
     * Acceso a secciones públicas del sitio.
     * superadmin y admin.
     */
    public function canManagePublicContent(): bool
    {
        return $this->isSuperAdmin() || $this->isAdmin();
    }
}