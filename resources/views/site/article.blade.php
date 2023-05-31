@extends('site.blog.layout.main')

@section('title', 'Blog::Article')



@section('content')
<article>
    <header>
        <br />
        <h1>{{ $post->header }}</h1>
        <h4>{{ $post->category->title }}</h4>
        <div class="info box">
            <div>{{ $post->description }}</div>
            <div>{'BLG00005'|translate}: {{ $post->getPostDate() }}</div>
            <br />

            <div class="tags" style="margin-bottom:1rem;">
                @foreach($post->tags as $tag)
                    <span>{{ $tag->title }}</span>
                @endforeach
            </div>
        </div>
    </header>
    <div class="article-body">
        @if($post->thumbnails)
            <span class="image right">
                <img src="{{ $post->getImage() }}" alt="article image" />
            </span>
        @endif
        {!! $post->content !!}
    </div>
</article>
@endsection

@section('css')
<style>
.article-body img {
  display: block;
  max-width: 60vw;
}
style>
@endsection

