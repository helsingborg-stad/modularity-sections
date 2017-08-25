<section class="section section-split background-4 {{ $classes }}" style="background-color: {{ $backgroundColor }};">
    <div class="section-image-mobile hidden-md hidden-lg ratio-16-9" style="background-image: url({{ $backgroundImage }}"></div>
    <div class="container">
    <div class="grid">
     <div class="grid-xs-12 grid-md-7 grid-lg-6">
         <div class="vertical-alignment-wrapper">
             <article class="section-article">
                  @if (!$hideTitle && !empty($post_title))
                    <h2 class="section-title">{!! apply_filters('the_title', $post_title) !!}</h2>
                  @endif
                 <div class="section-text">
                    {!! $content !!}
                 </div>

                @if(is_array($submodules) && !empty($submodules))
                    <div class="section-submodules">
                        {!! $submoduleRendered !!}
                    </div>
                @endif
             </article>
         </div>
     </div>
    </div>
    </div>
    <div class="section-image hidden-xs hidden-sm" style="background-image: url({{ $backgroundImage }});" data-equal-item></div>
</section>
