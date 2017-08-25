<section class="section section-full background-4 {{ $classes }}" style="background-color: {{ $backgroundColor }}; background-image: url({{ $backgroundImage }}); ">
    <div class="container">
        <div class="grid">
            <div class="grid-xs-12">
                <article class="section-article">
                    @if (!$hideTitle && !empty($post_title))
                        <h2 class="section-title">{!! apply_filters('the_title', $post_title) !!}</h2>
                    @endif

                    <div class="section-text">
                        {!! $content !!}
                    </div>
                </article>
            </div>
        </div>
    </div>

    @if(is_array($submodules) && !empty($submodules))
        <div class="container section-submodules">
            {!! $submoduleRendered !!}
        </div>
    @endif
</section>
