@extends('site.blog.layout.main')

@section('title', 'Blog::Error')



@section('content')
<article>
    <header>
        <br />
        <h1>Oops!</h1>
        <h2>The page you requested wasn't found.</h2>
        @if(config('app.debug'))
            <h3>{{ $exception->getMessage() }}</h3>
        @endif
    </header>
</article>
@endsection
