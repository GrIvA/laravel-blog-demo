<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
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
        if (Cache::has('pop_posts')) {
            $posts = Cache::get('pop_posts') ;
        } else {
            $posts = Post::orderBy('id', 'desc')->limit(6)->get();
            Cache::put('pop_posts', $posts, 3 * 60 * 60);
        }

        View::composer('site.blog.side', function ($view) use ($posts) {
            $view->with('popular_articles', $posts);
            $view->with('tag_infos', Tag::pluck('title', 'id')->all());
        });

    }

}
