@extends('site.blog.layout.main')

@section('title', 'Blog::Article')



@section('content')
    <h1>{{ $post->header }}</h1>
    <p><b>{{ trans("test.BLG00026") }} <a href="{{ route('site.categories', ['lang' => $current_language, 'slug' => $post->category->slug]) }}" class="">{{ $post->category->title }}</a></b></p>
    <div class="info box">
        <div>{{ $post->description }}</div>
        <br />

        <div class="tags" style="margin-bottom:1rem;">
            @foreach($post->tags as $tag)
                <span class="box"><a href="{{ route('site.tags', ['lang' => $current_language, 'slug' => $tag->slug]) }}">{{ $tag->title }}</a></span>
            @endforeach
        </div>
        <div class="row">
            <b class="col-3">{{ trans("test.BLG00027") }}: {{ $post->getPostDate() }}</b>
            <small class="to-right"><i class="fa fa-eye"> {{ $post->views }}</i></small>
        </div>
    </div>

    <div class="article-body">
        @if($post->thumbnails)
            <span class="image right">
                <img src="{{ $post->getImage() }}" alt="article image" />
            </span>
        @endif
        {!! $post->getHtmlContent() !!}
    </div>
@endsection

@section('css')
<style>
.article-body img {
  display: block;
  max-width: 60vw;
}
</style>
@endsection

