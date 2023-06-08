@extends('site.blog.layout.main')

@section('title', "Blog::Tag::$tag->title")



@section('content')
<section>
    <h1>{{ trans('test.BLG00025', ['tag' => $tag->title]) }}</h1>

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

@section('css')
<style>
.article-body img {
  display: block;
  max-width: 60vw;
}
</style>
@endsection

