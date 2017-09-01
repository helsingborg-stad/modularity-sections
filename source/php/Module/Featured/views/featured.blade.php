<section id="{{ $sectionID }}" class="section section-featured {{ $classes }}" style="background-color: {{ $backgroundColor }}; background-image: url({{ $backgroundImage }}); ">
  <div class="container">
    <div class="grid">
      <div class="grid-xs-12">
        <article class="section-article">
           <div class="grid content-grid">
              <div class="section-image grid-xs-12 grid-lg-4">
                @if(is_numeric($foregroundImage))
                <img src="{!! wp_get_attachment_image_src($foregroundImage, 'large')[0] !!}" class="hidden-xs hidden-sm hidden-md"/>
                @endif
                @if(is_numeric($foregroundImage))
                <img src="{!! wp_get_attachment_image_src($foregroundImage, array(800,450))[0] !!}" class="hidden-xs hidden-sm hidden-lg"/>
                @endif
                @if(is_numeric($foregroundImage))
                <img src="{!! wp_get_attachment_image_src($foregroundImage, array(640,360))[0] !!}" class="hidden-md hidden-lg"/>
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
    @if(is_array($submodules) && !empty($submodules))
      <div class="grid section-submodules">
        <div class="grid-xs-12">
        {!! $submoduleRendered !!}
        </div>
      </div>
    @endif
  </div>
</section>

