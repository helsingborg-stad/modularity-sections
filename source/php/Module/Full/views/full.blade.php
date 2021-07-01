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
    'paddingTop'        => $spacing_top,
    'paddingBottom'     => $spacing_bottom
])

    @if(is_array($submodules) && !empty($submodules))
    {!! $submoduleRendered !!}
    @endif

@endsegment