<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add('MAIN NAVIGATION');
            $event->menu->add([
                'text' => 'Buku',
                'route' => 'buku.index',
                'icon' => 'book'
            ]);
            $event->menu->add([
                'text' => 'Klasifikasi',
                'route' => 'klasifikasi.index',
                'icon' => 'sitemap'
            ]);
            $event->menu->add([
                'text' => 'Penerbit',
                'route' => 'penerbit.index',
                'icon' => 'flag-checkered '
            ]);
            $event->menu->add([
                'text' => 'Pengarang',
                'route' => 'pengarang.index',
                'icon' => 'male'
            ]);
            $event->menu->add([
                'text' => 'Anggota',
                'route' => 'anggota.index',
                'icon' => 'users'
            ]);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
