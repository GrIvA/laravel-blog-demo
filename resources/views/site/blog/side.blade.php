<!-- Sidebar -->
<div id="sidebar">
    <div class="inner">
        <!-- Languages -->
        @if (request()->routeIs('home'))
            <div class="tags" style="line-height: 2rem;">
                @foreach($languages as $key => $lang)
                    <a href="{{ route('home') }}/{{ $key }}" class="button primary small">{{ $lang }}</a>
                @endforeach
            </div>
        @endif

        <!-- Search -->
        <section id="search" class="alt">
            <form method="post" action="#">
                <input type="text" name="query" id="query" placeholder="Search" />
            </form>
        </section>

        <!-- Menu -->
        <nav id="menu">
            <header class="major">
                <h2>{{ trans('test.BLG00001') }}</h2>
            </header>
            <ul>

                @auth
                    <h3>{{ trans('test.BLG00003') }} {{ Auth::user()->name }}</h3>
                    <li><a href="{{ route('logout') }}">{{ trans('test.BLG00007') }}</a></li>
                    <li><a href="#">{{ trans('test.BLG00009') }}</a></li>
                @endauth

                @guest
                    <li><a href="{{ route('login.create', ['lang' => $current_language]) }}">{{ trans('test.BLG00008') }}</a></li>
                    <li><a href="{{ route('register.create', ['lang' => $current_language]) }}">{{ trans('test.BLG00020') }}</a></li>
                @endguest


                <li><a href="{{ route('login', ['lang' => $current_language]) }}">Homepage</a></li>

                <li>
                    <span class="opener">Tools</span>
                    <ul>
                        <li><a href="/elements.html">Elements</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Articles -->
        <section>
            <header class="major"><h2>{{ trans('test.BLG00002') }}</h2></header>
            @foreach($popular_articles as $article)
                <ul class="actions">
                    <li><a href="{{ route('posts.article', ['lang' => $current_language, 'slug' => $article->slug]) }}" class="">{{ $article->header }}</a></li>
                </ul>
            @endforeach
        </section>

        <!-- Categories -->
        <section>
            <header class="major"><h2>{{ trans('test.BLG00023') }}</h2></header>
            @foreach($category_infos as $slug => $cat)
                <ul class="actions">
                    <li><a href="{{ route('site.categories', ['lang' => $current_language, 'slug' => $slug]) }}" class="">{{ $cat }}</a></li>
                </ul>
            @endforeach
        </section>

        <!-- Section Tags -->
        <section>
            <header class="major"><h2>{{ trans('test.BLG00004') }}</h2></header>
            <div class="tags">
            @foreach($tag_infos as $slug => $tag)
                <span class="box"><a href="{{ route('site.tags', ['lang' => $current_language, 'slug' => $slug]) }}">{{ $tag }}</a></span>
            @endforeach
            <span class="box"><a href="{{ route('home', $current_language) }}">{{ trans('test.BLG00022') }}</a></span>
            </div>
        </section>

        <!-- Section -->
        <section>
            <header class="major">
                <h2>{{ trans('test.BLG00005') }}</h2>
            </header>
            <p>{{ trans('test.BLG00006') }}</p>
            <ul class="contact">
                <li class="icon solid fa-envelope"><a href="mailto:griva99ptc@gmail.com">griva99ptc@gmail.com</a></li>
                <li class="svg_icon"><div>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="13 30 425 512"><path d="M433 179.11c0-97.2-63.71-125.7-63.71-125.7-62.52-28.7-228.56-28.4-290.48 0 0 0-63.72 28.5-63.72 125.7 0 115.7-6.6 259.4 105.63 289.1 40.51 10.7 75.32 13 103.33 11.4 50.81-2.8 79.32-18.1 79.32-18.1l-1.7-36.9s-36.31 11.4-77.12 10.1c-40.41-1.4-83-4.4-89.63-54a102.54 102.54 0 0 1-.9-13.9c85.63 20.9 158.65 9.1 178.75 6.7 56.12-6.7 105-41.3 111.23-72.9 9.8-49.8 9-121.5 9-121.5zm-75.12 125.2h-46.63v-114.2c0-49.7-64-51.6-64 6.9v62.5h-46.33V197c0-58.5-64-56.6-64-6.9v114.2H90.19c0-122.1-5.2-147.9 18.41-175 25.9-28.9 79.82-30.8 103.83 6.1l11.6 19.5 11.6-19.5c24.11-37.1 78.12-34.8 103.83-6.1 23.71 27.3 18.4 53 18.4 175z"/></svg>
                    </div>
                    <span>@griva99@mastodon.social</span>
                </li>
                <li class="icon solid fa-phone">(000) 000-0000</li>
                <li class="icon solid fa-home">1234 Somewhere Road #8254<br />
                Nashville, TN 00000-0000</li>
            </ul>
        </section>

        @include('site.blog.footer')
    </div>
</div>
