<?php

namespace SpondonIt\SchoolService;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use SpondonIt\SchoolService\Middleware\SchoolService;

class SpondonItSchoolServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $kernel = $this->app->make(Kernel::class);
        $kernel->pushMiddleware(SchoolService::class);

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'school');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'school');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }
}
