<?php
namespace App\Providers;

use App\Question;
use App\Services\Contracts\CustomServiceInterface;
use App\Services\DateCheck;
use App\Services\DateCheckNew;
use Illuminate\Support\ServiceProvider;

class DateCheckServiceProvider extends ServiceProvider{

    public function boot()
    {
    }

    public function register()
    {
         $this->app->bind('App\Services\Contracts\CustomServiceInterface', function ($app) {
            return new DateCheckNew();
        });

    }

}