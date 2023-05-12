@extends('site.blog.layout.main')

@section('banner_content')
    {set $tag_selected = $user_info.tags ?: []}
    <div class="content">
        <header>
            <h1>{$banner.header !? ''}</h1>
            <p>{$banner.epilog !? ''}</p>
        </header>
        <p>{$banner.anons|markdown !? ''}</p>
        <ul class="actions">
            <li><a href="/{7|getPageURL}/{$banner.id}" class="button big">Learn More</a></li>
        </ul>
        <div class="tags">
            {foreach $banner.tags as $tag}
                <span class="{($tag in list $tag_selected) ? 'selected' : ''}" data-tag="{$tags[$tag]['tag_id']}">{$tags[$tag]['name']}</span>
            {/foreach}
        </div>
    </div>
    {if $banner.image?}
        <span class="image object">
            <img src="{$banner.image}" alt="Banner logo" />
        </span>
    {/if}
@endsection


@section('content')
<!-- Section -->
<section>
    <header class="major">
        <h2>Latest articles</h2>
    </header>
    <div class="features">
        {foreach $last_articles as $las}
            <article>
                <span class="icon fa-newspaper"></span>
                <div class="content">
                    <h3>{$las.header}</h3>
                    <p>{$las.epilog} <a href="/{7|getPageURL}/{$las.id}">More...</a></p>
                    <div class="tags">
                        {foreach $las.tags as $tag}
                            <span class="{($tag in list $tag_selected) ? 'selected' : ''}" data-tag="{$tags[$tag]['tag_id']}">{$tags[$tag]['name']}</span>
                        {/foreach}
                    </div>
                </div>
            </article>
        {/foreach}
    </div>
</section>
@endsection
