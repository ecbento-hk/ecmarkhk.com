<?php

namespace App\Providers;

use App\Models\Product\Menu;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Support\Facades\Auth;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Factory $cache)
    {
        $type = 'normal';
        if($type == 'normal'){
            $menu = Menu::with('products')->where('menu_date', '>=', date('Y-m-d'))->whereIn('period_id', [2])->active()
            ->whereHas('locations', function ($query) {
                $query->whereNotNull('stock')->where([
                    'store_id' => 54
                ]);
            })->get();
        } else {
            $menu = Menu::with('products')->where('menu_date', '>=', date('Y-m-d'))->where('menu_date', '<=', date('Y-m-d',strtotime('last day of this month')))->whereIn('period_id', [2])
            ->whereHas('locations', function ($query) {
                $query->whereNotNull('stock')->where([
                    'store_id' => 54
                ]);
            })->get();
        }

        $menu_date = $cache->remember('menu_date', 60, function() use ($menu){
            // Laravel >= 5.2, use 'lists' instead of 'pluck' for Laravel <= 5.1
            return $menu->pluck('menu_date')->all();
        });
        config()->set('menu.date', $menu_date);
    }
}
