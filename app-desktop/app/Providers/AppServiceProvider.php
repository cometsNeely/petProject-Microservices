<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Queue;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;

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
        $this->app->bind('iviParser', 'App\Services\IviService');
        $this->app->bind('iviJob', 'App\Jobs\IviParseJob');
  
        Queue::before(function (JobProcessing $event) {
           // echo 'before';
        });

        Queue::after(function (JobProcessed $event) {

            //echo 'after';
            //после того как джоб отработал, нужно создать событие чтобы были показаны все результаты и сделать броадкаст во фронтенд
            //print_r(response()->json(['shows' => Show::all()])); 

        });
    }
}
