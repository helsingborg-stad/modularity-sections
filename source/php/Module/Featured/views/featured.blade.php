<section id="{{ $sectionID }}" class="section section-featured background-4 {{ $classes }}" style="background-color: {{ $backgroundColor }}; background-image: url({{ $backgroundImage }}); ">
    <div class="container">
     <div class="grid">
         <div class="grid-xs-12">
                 <article class="section-article">
                     <div class="grid content-grid">
                         <div class="section-image grid-xs-12 grid-lg-4 text-center">
                            @if(is_numeric($foregroundImage))
                                <img src="{!! wp_get_attachment_image_src($foregroundImage, 'large', "")[0] !!}"/>
                            @endif
                         </div>
                         <div class="section-text grid-xs-12 grid-lg-8">
                            @if (!$hideTitle && !empty($post_title))
                                <h2 class="section-title">{!! apply_filters('the_title', $post_title) !!}</h2>
                            @endif

                            {!! $content !!}
                         </div>
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
