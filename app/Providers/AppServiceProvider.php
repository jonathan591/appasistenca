<?php

namespace App\Providers;

use BezhanSalleh\PanelSwitch\PanelSwitch;
use Filament\Facades\Filament as FacadesFilament;
use Illuminate\Support\ServiceProvider;
use Filament\Filament;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        PanelSwitch::configureUsing(function (PanelSwitch $panelSwitch) {
            $panelSwitch
                ->simple()
                ->visible(fn (): bool => auth()->user()?->hasAnyRole([
                    'super_admin',
                ]));
        });

        // Registrar recursos manualmente
        $this->registerFilamentResources();
    }

    protected function registerFilamentResources()
    {
        $resources = [
            \App\Filament\Resources\HolidyResource::class,
            \App\Filament\Resources\TimesheedResource::class,
            \App\Filament\Resources\UserResource::class,
            // Agrega aquí otros recursos de filament/resources
        ];

        foreach ($resources as $resource) {
            FacadesFilament::registerResources([$resource]);
        }
    }
}
