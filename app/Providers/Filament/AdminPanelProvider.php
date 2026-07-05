<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Profile;
use App\Filament\Resources\AboutSections\AboutSectionResource;
use App\Filament\Resources\Authorities\AuthorityResource;
use App\Filament\Resources\ContactMessages\ContactMessageResource;
use App\Filament\Resources\ContactSettings\ContactSettingResource;
use App\Filament\Resources\Documents\DocumentResource;
use App\Filament\Resources\FooterSettings\FooterSettingResource;
use App\Filament\Resources\GalleryItems\GalleryItemResource;
use App\Filament\Resources\HomeSections\HomeSectionResource;
use App\Filament\Resources\MediaAssets\MediaAssetResource;
use App\Filament\Resources\NavbarSettings\NavbarSettingResource;
use App\Filament\Resources\NavigationItems\NavigationItemResource;
use App\Filament\Resources\ResearchSections\ResearchSectionResource;
use App\Filament\Resources\ThemeColors\ThemeColorResource;
use App\Filament\Resources\ThemeFonts\ThemeFontResource;
use App\Filament\Resources\Users\UserResource;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->sidebarCollapsibleOnDesktop()
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                $user = auth()->user();

                $isSuperAdmin = $user?->isSuperAdmin() ?? false;
                $canManagePublicContent = $user?->canManagePublicContent() ?? false;

                $groups = [];

                $groups[] = NavigationGroup::make()
                    ->items([
                        NavigationItem::make('Dashboard')
                            ->icon(Heroicon::OutlinedHome)
                            ->url(fn (): string => Dashboard::getUrl())
                            ->isActiveWhen(fn (): bool => request()->routeIs('filament.admin.pages.dashboard')),
                    ]);

                if ($isSuperAdmin) {
                    $groups[] = NavigationGroup::make('General')
                        ->items([
                            NavigationItem::make('Colores')
                                ->icon(Heroicon::OutlinedRectangleStack)
                                ->url(fn (): string => ThemeColorResource::getUrl('index'))
                                ->isActiveWhen(fn (): bool => request()->is('admin/theme-colors*')),

                            NavigationItem::make('Tipografías')
                                ->icon(Heroicon::OutlinedRectangleStack)
                                ->url(fn (): string => ThemeFontResource::getUrl('index'))
                                ->isActiveWhen(fn (): bool => request()->is('admin/theme-fonts*')),

                            NavigationItem::make('Imágenes globales')
                                ->icon(Heroicon::OutlinedRectangleStack)
                                ->url(fn (): string => MediaAssetResource::getUrl('index'))
                                ->isActiveWhen(fn (): bool => request()->is('admin/media-assets*')),

                            NavigationItem::make('Configuración de barra')
                                ->icon(Heroicon::OutlinedRectangleStack)
                                ->url(fn (): string => NavbarSettingResource::getUrl('index'))
                                ->isActiveWhen(fn (): bool => request()->is('admin/navbar-settings*')),

                            NavigationItem::make('Enlaces de navegación')
                                ->icon(Heroicon::OutlinedRectangleStack)
                                ->url(fn (): string => NavigationItemResource::getUrl('index'))
                                ->isActiveWhen(fn (): bool => request()->is('admin/navigation-items*')),

                            NavigationItem::make('Configuración de footer')
                                ->icon(Heroicon::OutlinedRectangleStack)
                                ->url(fn (): string => FooterSettingResource::getUrl('index'))
                                ->isActiveWhen(fn (): bool => request()->is('admin/footer-settings*')),
                        ]);
                }

                if ($canManagePublicContent) {
                    $groups[] = NavigationGroup::make('Inicio')
                        ->items([
                            NavigationItem::make('Secciones de inicio')
                                ->icon(Heroicon::OutlinedRectangleStack)
                                ->url(fn (): string => HomeSectionResource::getUrl('index'))
                                ->isActiveWhen(fn (): bool => request()->is('admin/home-sections*')),
                        ]);

                    $groups[] = NavigationGroup::make('Nosotros')
                        ->items([
                            NavigationItem::make('Secciones de nosotros')
                                ->icon(Heroicon::OutlinedRectangleStack)
                                ->url(fn (): string => AboutSectionResource::getUrl('index'))
                                ->isActiveWhen(fn (): bool => request()->is('admin/about-sections*')),
                        ]);

                    $groups[] = NavigationGroup::make('Autoridades')
                        ->items([
                            NavigationItem::make('Autoridades')
                                ->icon(Heroicon::OutlinedRectangleStack)
                                ->url(fn (): string => AuthorityResource::getUrl('index'))
                                ->isActiveWhen(fn (): bool => request()->is('admin/authorities*')),
                        ]);

                    $groups[] = NavigationGroup::make('Galería')
                        ->items([
                            NavigationItem::make('Imágenes de galería')
                                ->icon(Heroicon::OutlinedRectangleStack)
                                ->url(fn (): string => GalleryItemResource::getUrl('index'))
                                ->isActiveWhen(fn (): bool => request()->is('admin/gallery-items*')),
                        ]);

                    $groups[] = NavigationGroup::make('Investigación')
                        ->items([
                            NavigationItem::make('Secciones de investigación')
                                ->icon(Heroicon::OutlinedRectangleStack)
                                ->url(fn (): string => ResearchSectionResource::getUrl('index'))
                                ->isActiveWhen(fn (): bool => request()->is('admin/research-sections*')),
                        ]);

                    $groups[] = NavigationGroup::make('Documentos')
                        ->items([
                            NavigationItem::make('Documentos')
                                ->icon(Heroicon::OutlinedRectangleStack)
                                ->url(fn (): string => DocumentResource::getUrl('index'))
                                ->isActiveWhen(fn (): bool => request()->is('admin/documents*')),
                        ]);

                    $groups[] = NavigationGroup::make('Contacto')
                        ->items([
                            NavigationItem::make('Configuración de contacto')
                                ->icon(Heroicon::OutlinedRectangleStack)
                                ->url(fn (): string => ContactSettingResource::getUrl('index'))
                                ->isActiveWhen(fn (): bool => request()->is('admin/contact-settings*')),

                            NavigationItem::make('Mensajes recibidos')
                                ->icon(Heroicon::OutlinedRectangleStack)
                                ->url(fn (): string => ContactMessageResource::getUrl('index'))
                                ->isActiveWhen(fn (): bool => request()->is('admin/contact-messages*')),
                        ]);
                }

                if ($isSuperAdmin) {
                    $groups[] = NavigationGroup::make('Usuarios')
                        ->items([
                            NavigationItem::make('Usuarios del sistema')
                                ->icon(Heroicon::OutlinedUsers)
                                ->url(fn (): string => UserResource::getUrl('index'))
                                ->isActiveWhen(fn (): bool => request()->is('admin/users*')),
                        ]);
                }

                $groups[] = NavigationGroup::make('Mi cuenta')
                    ->items([
                        NavigationItem::make('Mi perfil')
                            ->icon(Heroicon::OutlinedUserCircle)
                            ->url(fn (): string => Profile::getUrl())
                            ->isActiveWhen(fn (): bool => request()->is('admin/mi-perfil')),
                    ]);

                return $builder->groups($groups);
            })
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
                Profile::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}