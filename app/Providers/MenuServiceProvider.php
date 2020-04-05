<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;

class MenuServiceProvider extends ServiceProvider
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
        View()->composer('header', function ($view){
            $food = Category::where('type', 'Đồ Ăn')->get();  
            $drink = Category::where('type', 'Đồ Uống')->get();  
            $view->with(['food'=>$food, 'drink'=>$drink]);
        });
    }
}
