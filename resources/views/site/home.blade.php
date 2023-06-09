@extends('site.blog.layout.main')

@section('title', 'Blog::Home')


@section('banner_content')
<section id="banner">
    @if (empty($banner))
        <p>No articles available...</p>
    @else
        <div class="content">
            <header>
                <h1>{{ $banner->header }}</h1>
                <p>{{ $banner->epilog }}</p>
            </header>
            <p>{{ $banner->description }}</p>
            <ul class="actions">
                <li><a href="{{ route('posts.article', ['lang' => $current_language, 'slug' => $banner->slug]) }}" class="button big">Learn More</a></li>
            </ul>
            <div class="tags">
                @foreach($banner->tags as $tag)
                    <span class="box"><a href="{{ route('site.tags', ['lang' => $current_language, 'slug' => $tag->slug]) }}">{{ $tag->title }}</a></span>
                @endforeach
            </div>
            <div class="row">
                <small class="col-3">{{ trans("test.BLG00027") }}: {{ $banner->getPostDate() }}</small>
                <small class="col-1 to-right"><i class="fa fa-eye"> {{ $banner->views }}</i></small>
            </div>
        </div>
        @if($banner->thumbnails)
            <span class="image object">
                <img src="{{ $banner->getImage() }}" alt="Banner logo" />
            </span>
        @endif
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
                            <span class="box"><a href="{{ route('site.tags', ['lang' => $current_language, 'slug' => $tag->slug]) }}">{{ $tag->title }}</a></span>
                        @endforeach
                    </div>
                </div>
            </article>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="Page navigation">@if(!empty($posts)) {{ $posts->links() }} @endif</nav>
        </div>
    </div>
</section>
@endsection
