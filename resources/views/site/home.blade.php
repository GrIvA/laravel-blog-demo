@extends('site.blog.layout.main')

@section('title', 'Blog::Home')


@section('banner_content')
<section id="banner">
    <div class="content">
        <header>
            <h1>{{ $banner->header }}</h1>
            <p>{{ $banner->epilog }}</p>
        </header>
        <!-- <p>{$banner.anons|markdown !? ''}</p> -->
        <p>{{ $banner->annons }}</p>
        <ul class="actions">
            <li><a href="{{ route('posts.article', ['lang' => $current_language, 'slug' => $banner->slug]) }}" class="button big">Learn More</a></li>
        </ul>
        <div class="tags">
            @foreach($banner->tags as $tag)
                <span data-tag="{{ $tag->id }}">{{ $tag->title }}</span>
            @endforeach
        </div>
        <small>{{ $banner->getPostDate() }}</small>
        <small><i class="fa fa-eye">{{ $banner->views }}</i></small>
    </div>
    @if($banner->thumbnails)
        <span class="image object">
            <img src="{{ $banner->getImage() }}" alt="Banner logo" />
        </span>
    @endif
</section>
@endsection


@section('content')
<!-- Section -->
<section>
    <header class="major">
        <h2>{{ trans("test.BLG00002") }}</h2>
    </header>
    <div class="features">
        @foreach($posts as $post)
            <article>
                <span class="icon fa-newspaper"></span>
                <div class="content">
                    <h3>{{ $post->header }}</h3>
                    <p>{{ $post->epilog }} <a href="{{ route('posts.article', ['lang' => $current_language, 'slug' => $post->slug]) }}">More...</a></p>
                    <div class="tags">
                        @foreach($post->tags as $tag)
                            <span data-tag="{{ $tag->id }}">{{ $tag->title }}</span>
                            <!--<span class="{($tag in list $tag_selected) ? 'selected' : ''}" data-tag="{$tags[$tag]['tag_id']}">{$tags[$tag]['name']}</span>-->
                        @endforeach
                    </div>
                </div>
            </article>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="Page navigation">{{ $posts->links() }}</nav>
        </div>
    </div>
</section>
@endsection
