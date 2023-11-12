<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\CategoryComposer;
use App\Http\ViewComposers\CommentComposer;
use App\Http\ViewComposers\RoleComposer;
use Illuminate\Support\Facades\Schema;



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
        //Schema::defaultStringLength(191);
        View::composer(['partials.sidebar', 'lists.categories'], CategoryComposer::class);

        view::composer('lists.roles', RoleComposer::class);

        view::composer('partials.sidebar' , CommentComposer::class);
    }
}
