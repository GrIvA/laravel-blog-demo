@extends('site.blog.layout.main')

@section('title', 'Blog::Error')



@section('content')
<article>
    <header>
        <br />
        <h1>Oops!</h1>
        <h2>The page you requested wasn't found.</h2>
    </header>

    <p>Status of IP: {{ $ip }} is {{ $status }}</p>

    @if(config('app.debug'))
        <h3>Message: {{ $message }}</h3>
    @endif
</article>
@endsection
