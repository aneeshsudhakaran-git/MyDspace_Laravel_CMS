<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
        Paginator::useBootstrapFive();

        Schema::defaultStringLength(191);

        if (Schema::hasTable('site_configurations')) {
            // Try-catch to be extra safe
            try {

                // Aded new component for admin
                Blade::component('guestadmin-layout', \App\View\Components\GuestAdminLayout::class);
                Blade::component('appadmin-layout', \App\View\Components\AppAdminLayout::class);

                $Site_Name = loadSiteConfiguration('Site_Name');
                view::share('Site_Name', $Site_Name);

                $site_config = getSiteConfiguration();
                view::share('site_config', $site_config);

                $menulist = loadSiteMainMenus();
                view::share('menulist', $menulist);

                $Site_Menu_Style_Name = loadMainMenuStyleName();
                view::share('Site_Menu_Style_Name', $Site_Menu_Style_Name);

                $Site_Content_Style_Name = loadContentStyleName();
                view::share('Site_Content_Style_Name', $Site_Content_Style_Name);
            } catch (\Exception $e) {
                // Optional: Log error if needed
                // \Log::error('Failed loading site_configurations: ' . $e->getMessage());
            }
        }
    }
}
