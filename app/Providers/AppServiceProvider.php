<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Answer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(config('app.env') === 'production'){
            \URL::forceScheme('https');
        }

        view()->composer('admin.layout',function($view){
            $view->with('AnswersCount',Answer::all()->count());
        });
    }
}
