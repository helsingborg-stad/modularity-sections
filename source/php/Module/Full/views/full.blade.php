{{-- <section id="{{ $sectionID }}" class="section section-full {{ $classes }}" style="background-color: {{ $backgroundColor }}; background-image: url({{ $backgroundImage }}); ">
  @if(isset($effectOverlayColor) && $effectOverlayColor)
    <div class="overlay" style="background-color: {{$effectOverlayColor}};"></div>
  @endif
  <div class="container {{ $animation['classes'] }}" data-animation="{!! $animation['attribute'] !!}">
    <div class="grid">
      <div class="grid-xs-12 section-content">
        <article class="section-article full">
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
</section> --}}



@segment([
    'id'                => $sectionID,
    'title'             => apply_filters('the_title', $post_title),
    'content'           => $text,
    'layout'            => 'full-width',
    'background'        => $background_color,
    'image'             => $image,
    'overlay'           => $image_overlay,
    'height'            => $height,
    'textColor'         => $text_color,
    'textAlignment'     => $text_alignment,
    'textSize'          => $text_size,
    'reverseColumns'    => $reverse_columns,
])

    @if(is_array($submodules) && !empty($submodules))
    {!! $submoduleRendered !!}
    @endif

@endsegment