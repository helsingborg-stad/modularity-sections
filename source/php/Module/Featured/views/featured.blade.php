@segment([
    'title'             => !$hideTitle && !empty($postTitle) ? $postTitle : null,
    'content'           => $text,
    'layout'            => 'featured',
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
    'stretch'           => (!is_admin() && isset($blockData) ? ((bool) $blockData['align'] == 'full') : $stretch),
    'context'           => ['sectionsFeatured', 'sections',  'sections.featured', 'module.sections.featured']
])

    @if(!empty($submodules) && is_array($submodules))
    {!! $submoduleRendered !!}
    @endif

@endsegment