<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

    public $settings;

    /**
     * Register any application services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        Paginator::useBootstrap();
        if (Schema::hasTable('settings')) {
            foreach (Setting::get(['key', 'value']) as $setting) {
                $this->settings[$setting->key] = $setting->value;
            }
            $this->settings = json_decode(json_encode($this->settings), false);
        }

        view()->composer('*', function ($view) {
            $view->with([
                'settings' => $this->settings
            ]);
        });
    }
}
