<?php

namespace App\Providers\Filament;

use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;

class AkademikPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('akademik')
            ->path('adm')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->login(false)
            ->spa()
            ->passwordReset()
            ->registration()
            ->profile(\App\Filament\Pages\Auth\EditProfile::class, isSimple: false)
            ->defaultThemeMode(ThemeMode::Light)
            ->font('Montserrat')
            ->maxContentWidth(MaxWidth::SevenExtraLarge)
            ->sidebarCollapsibleOnDesktop()
            ->navigationGroups([
                NavigationGroup::make()->label('Data Pengguna'),
                NavigationGroup::make()->label('Master Data'),
                NavigationGroup::make()->label('Kurikulum & Pembelajaran'),
                NavigationGroup::make()->label('Administration'),
            ])
            ->discoverResources(in: app_path('Filament/Akademik/Resources'), for: 'App\\Filament\\Akademik\\Resources')
            ->discoverPages(in: app_path('Filament/Akademik/Pages'), for: 'App\\Filament\\Akademik\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Akademik/Widgets'), for: 'App\\Filament\\Akademik\\Widgets')
            ->widgets([
                \Awcodes\Overlook\Widgets\OverlookWidget::class,
                \App\Filament\Widgets\BackToModulWidget::class,
            ])
            ->plugins([
                \Hasnayeen\Themes\ThemesPlugin::make(),
                \Njxqlus\FilamentProgressbar\FilamentProgressbarPlugin::make()->color('#29b'),
                \DiogoGPinto\AuthUIEnhancer\AuthUIEnhancerPlugin::make()
                    ->showEmptyPanelOnMobile(false)
                    ->formPanelPosition('right')
                    ->formPanelWidth('40%')
                    ->emptyPanelBackgroundImageOpacity('70%')
                    ->emptyPanelBackgroundImageUrl('https://picsum.photos/seed/akademik/1260/750.webp/?blur=1'),
                \Awcodes\LightSwitch\LightSwitchPlugin::make()
                    ->position(\Awcodes\LightSwitch\Enums\Alignment::BottomCenter)
                    ->enabledOn([
                        'auth.login',
                        'auth.password',
                    ]),
                \Awcodes\Overlook\OverlookPlugin::make()
                    ->columns([
                        'default' => 2,
                        'sm' => 2,
                        'md' => 4,
                        'lg' => 4,
                        'xl' => 4,
                    ])
                    ->includes([
                        \App\Filament\Akademik\Resources\GuruResource::class,
                        \App\Filament\Akademik\Resources\SiswaResource::class,
                        \App\Filament\Akademik\Resources\OrtuResource::class,
                        \App\Filament\Akademik\Resources\AkademikStaffResource::class,
                        \App\Filament\Akademik\Resources\KelasResource::class,
                        \App\Filament\Akademik\Resources\TahunAjaranResource::class,
                        \App\Filament\Akademik\Resources\MataPelajaranResource::class,
                        \App\Filament\Akademik\Resources\StreamResource::class,
                    ]),
                \Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin::make()
                    ->slug('my-profile')
                    ->setTitle('My Profile')
                    ->shouldRegisterNavigation(false)
                    ->shouldShowDeleteAccountForm(false)
                    ->shouldShowSanctumTokens(false)
                    ->shouldShowBrowserSessionsForm()
                    ->shouldShowAvatarForm(),
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
                \Hasnayeen\Themes\Http\Middleware\SetTheme::class,
            ])
            ->userMenuItems([
                'profile' => MenuItem::make()
                    ->label(fn () => auth()->user()?->name)
                    ->url(fn (): string => EditProfilePage::getUrl())
                    ->icon('heroicon-m-user-circle'),
                MenuItem::make()
                    ->label('Pilihan Modul')
                    ->url(fn () => route('dashboard'))
                    ->icon('heroicon-m-squares-2x2'),
            ])
            ->viteTheme('resources/css/filament/akademik/theme.css')
            ->authMiddleware([
                \App\Http\Middleware\FilamentAuthenticate::class,
            ]);
    }
}