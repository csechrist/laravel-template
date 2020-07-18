<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Menu;
use Spatie\Menu\Laravel\Link;

class MenuServiceProvider extends ServiceProvider {
    /**
    * Register services.
    *
    * @return void
    */

    public function register() {
        //
    }

    /**
    * Bootstrap services.
    *
    * @return void
    */

    public function boot() {
        $this->createSidebarMenu();
    }

    /**
    * Create main menu macro
    *
    * @return void
    */
    protected function createSidebarMenu() {
        Menu::macro('sidebar', function() {
            return Menu::new()
                ->addClass('nav flex-column')
                ->addItemParentClass('nav-item')
                ->addItemClass('nav-link')
                ->setActiveClass('active')
                ->route('dashboard.index', 'Dashboard')
                ->setActiveFromRequest();
        });
    }
}
