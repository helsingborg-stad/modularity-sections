{{-- <section id="{{ $sectionID }}" class="section section-split background-4 {{ $classes }} {{ $animation['classes'] }}" style="background-color: {{ $backgroundColor }};" data-animation="{!! $animation['attribute'] !!}">
  <div class="section-image-mobile hidden-md hidden-lg ratio-16-9" style="background-image: url({{ $backgroundImage }}"></div>
  <div class="container container-fullwidth">
    <div class="grid">
      <div class="section-image hidden-xs hidden-sm grid-xs-12 grid-md-5 grid-lg-6" style="background-image: url({{ $backgroundImage }});" data-equal-item></div>
      <div class="section-content grid-xs-12 grid-md-7 grid-lg-6">
          <article class="section-article">
                 <div class="section-text">
                    @if (!$hideTitle && !empty($post_title))
                      <h2 class="section-title">{!! apply_filters('the_title', $post_title) !!}</h2>
                    @endif
                   {!! $content !!}
                </div>
          </article>
      </div>
    </div>
    @if(is_array($submodules) && !empty($submodules))
      <div class="section-submodules margin-top">
        {!! $submoduleRendered !!}
      </div>
    @endif
  </div>
</section>
 --}}

@segment([
    'id'                => $sectionID,
    'title'             => apply_filters('the_title', $post_title),
    'content'           => $text,
    'layout'            => 'split',
    'background'        => $background_color,
    'image'             => $image,
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