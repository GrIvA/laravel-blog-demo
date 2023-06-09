<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Language;
use Illuminate\Support\ServiceProvider;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    private $list = [
        'site.blog.side',
        'site.category',
        'site.tag',
        'site.home',
        'site.article',
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Last article list
        if (Cache::has('pop_posts')) {
            $posts = Cache::get('pop_posts') ;
        } else {
            $posts = Post::orderBy('id', 'desc')->limit(6)->get();
            Cache::put('pop_posts', $posts, 3 * 60 * 60);
        }

        // Categories
        if (Cache::has('all_categories')) {
            $cats = Cache::get('all_categories') ;
        } else {
//            $cats = Category::pluck('title', 'slug')->all();
            $cats = Category::withCount('posts')->orderBy('posts_count', 'desc')->get();
            Cache::put('all_categories', $cats, 3 * 60 * 60);
        }

        // Tags
        if (Cache::has('all_tags')) {
            $tags = Cache::get('all_tags') ;
        } else {
            $tags = Tag::pluck('title', 'slug')->all();
            Cache::put('all_tags', $tags, 3 * 60 * 60);
        }

        // Languages
        if (Cache::has('languages')) {
            $languages = Cache::get('languages') ;
        } else {
            $languages = Language::where('available', 1)->pluck('locale', 'abr')->all();
            Cache::put('languages', $languages, 12 * 60 * 60);
        }


        View::composer('site.blog.side', function ($view) use ($posts, $tags, $cats, $languages) {
            $view->with('popular_articles', $posts);
            $view->with('tag_infos', $tags);
            $view->with('category_infos', $cats);
            $view->with('languages', $languages);
        });

        View::composer($this->list, function ($view) {
            $view->with('current_language', $this->getCurrentLanguage());
        });
    }

    // PRIVATE

    /**
     * return session's current language
     *
     * @return string
     */
    private function getCurrentLanguage()
    {
        return Session::get('current_language') ?? config('app.locale');
    }

}
