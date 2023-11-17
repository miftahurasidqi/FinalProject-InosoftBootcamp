<?php

namespace App\Providers;

use App\Repositories\ThirdPartyInstructionRepository;
use App\Services\ThirdPartyInstructionService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        // $this->app->singleton(ThirdPartyInstructionRepository::class, function ($app) {
        //     return new ThirdPartyInstructionRepository();
        // });

        // $this->app->singleton(ThirdPartyInstructionService::class, function ($app) {
        //     return new ThirdPartyInstructionService(
        //         $app->make(ThirdPartyInstructionRepository::class)
        //     );
        // });
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
