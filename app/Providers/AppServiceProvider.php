<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrap();

        //TODO: Add separete service provider
        // example: https://si-dev.com/uk/blog/laravel-view-composers
        View::composer('site.blog.side', function ($view) {
            $view->with('popular_articles', Post::orderBy('id', 'desc')->limit(6)->get());
            $view->with('tag_infos', Tag::pluck('title', 'id')->all());
        });

    }

}
