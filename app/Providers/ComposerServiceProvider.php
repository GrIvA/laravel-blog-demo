<?php

namespace App\Providers;

use App\Models\Language;
use Illuminate\Support\ServiceProvider;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{

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

        // Tags
        if (Cache::has('all_tags')) {
            $tags = Cache::get('all_tags') ;
        } else {
            $tags = Tag::pluck('title', 'id')->all();
            Cache::put('all_tags', $tags, 3 * 60 * 60);
        }

        // Languages
        if (Cache::has('languages')) {
            $languages = Cache::get('languages') ;
        } else {
            $languages = Language::where('available', 1)->pluck('name', 'abr')->all();
            Cache::put('languages', $languages, 12 * 60 * 60);
        }


        View::composer('site.blog.side', function ($view) use ($posts, $tags, $languages) {
            $view->with('popular_articles', $posts);
            $view->with('tag_infos', $tags);
            $view->with('languages', $languages);
            $view->with('current_language', $this->getCurrentLanguage());
        });

        View::composer('site.home', function ($view) {
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
        return Session::get('current_language') ?? App::config('locale');
    }

}
