<section id="{{ $sectionID }}" class="section section-featured {{ $classes }}" style="background-color: {{ $backgroundColor }}; background-image: url({{ $backgroundImage }});">
  @if(isset($effectOverlayColor) && $effectOverlayColor)
    <div class="overlay" style="background-color: {{$effectOverlayColor}};"></div>
  @endif

  <div class="container" {{ $animation['classes'] }}" data-animation="{!! $animation['attribute'] !!}">
     <div class="grid">
        <div class="section-image grid-xs-12 grid-lg-5">
          @if(is_numeric($foregroundImage))
                <img style="border-color: {{ $foregroundImageFrameColor }}" src="{!! wp_get_attachment_image_src($foregroundImage, array(900, null))[0] !!}" class="hidden-xs hidden-sm hidden-md"/>
                <img style="border-color: {{ $foregroundImageFrameColor }}" src="{!! wp_get_attachment_image_src($foregroundImage, array(800,null))[0] !!}" class="hidden-xs hidden-sm hidden-lg"/>
                <img style="border-color: {{ $foregroundImageFrameColor }}" src="{!! wp_get_attachment_image_src($foregroundImage, array(640, null))[0] !!}" class="hidden-md hidden-lg"/>
                @if (! empty($foregroundImageCaption))
                    <div class="section-image-caption">
                        <p>{!! $foregroundImageCaption !!}</p>
                    </div>
                @endif
            @endif
        </div>
        <div class="section-content grid-xs-12 grid-lg-7">
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
    @if(is_array($submodules) && !empty($submodules))
      <div class="grid section-submodules">
        <div class="grid-xs-12">
        {!! $submoduleRendered !!}
        </div>
      </div>
    @endif
  </div>
  <div class="section-divider"></div>
</section>

