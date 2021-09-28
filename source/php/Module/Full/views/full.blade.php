<div class="{!! $class !!}">
@segment([
    'id'                => $sectionID,
    'title'             => apply_filters('the_title', $post_title),
    'content'           => $text,
    'layout'            => 'full-width',
    'background'        => $background_color,
    'image'             => $image ? $image->url : false,
    'imageFocus'        => $image ? ['top' => $image->top, 'left' => $image->left] : false,
    'height'            => $height,
    'textColor'         => $text_color,
    'textAlignment'     => $text_alignment,
    'textSize'          => $text_size,
    'reverseColumns'    => $reverse_columns,
    'paddingTop'        => $spacing_top,
    'paddingBottom'     => $spacing_bottom,
    'stretch'           => $stretch
])

    @if(is_array($submodules) && !empty($submodules))
    {!! $submoduleRendered !!}
    @endif

@endsegment
</div>