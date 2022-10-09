<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\View\Composers\SettingComposer;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\CategoryComposer;

class ViewServiceProvider extends ServiceProvider
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
    public function boot()
    {
        View::composer('*', SettingComposer::class);
        View::composer('*', CategoryComposer::class);
    }
}