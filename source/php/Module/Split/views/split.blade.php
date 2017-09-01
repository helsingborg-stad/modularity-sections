<section id="{{ $sectionID }}" class="section section-split {{ $classes }}" style="background-color: {{ $backgroundColor }};">
  <div class="section-image-mobile hidden-md hidden-lg ratio-16-9" style="background-image: url({{ $backgroundImage }}"></div>
  <div class="container">
    <div class="grid">
       <div class="grid-xs-12 grid-md-7 grid-lg-6">
          <article class="section-article">
             <div class="grid content-grid">
                <div class="section-text">
                   @if (!$hideTitle && !empty($post_title))
                   <h2 class="section-title">{!! apply_filters('the_title', $post_title) !!}</h2>
                   @endif
                   {!! $content !!}

                    @if(is_array($submodules) && !empty($submodules))
                      <div class="section-submodules margin-top">
                        {!! $submoduleRendered !!}
                      </div>
                    @endif
                </div>
             </div>
          </article>
       </div>
    </div>
  </div>
  <div class="section-image hidden-xs hidden-sm" style="background-image: url({{ $backgroundImage }});" data-equal-item></div>
</section>
