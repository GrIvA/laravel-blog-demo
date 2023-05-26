@extends('site.blog.layout.main')

@section('title', 'Blog::Error')



@section('content')
<article>
    <header>
        <br />
        <h1>Oops!</h1>
        <h2>The page you requested wasn't found.</h2>
        <h3>U:230526</h3>
        @if(config('app.debug'))
            <h4>{{ $exception->getMessage() }}</h4>
        @endif
    </header>
</article>
@endsection
