@segment([
    'title'             => $postTitle,
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
    'stretch'           => $stretch,
    'context'           => ['sectionsFull', 'sections',  'sections.full', 'module.sections.full']
])

    @if(!empty($submodules) && is_array($submodules))
    {!! $submoduleRendered !!}
    @endif

@endsegment