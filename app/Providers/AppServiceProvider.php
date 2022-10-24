<?php

namespace App\Providers;

use App\Entities\Scientist;
use Illuminate\Support\ServiceProvider;
use App\Repositories\DoctrineScientistRepository;
use App\Repositories\Interfaces\ScientistRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ScientistRepository::class, function($app) {
            // This is what Doctrine's EntityRepository needs in its constructor.
            return new DoctrineScientistRepository(
                $app['em'],
                $app['em']->getClassMetaData(Scientist::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
