@segment([
    'id'            => isset( $blockData['anchor'] ) ? $blockData['anchor'] : $fallbackId,
    'title'         => !$hideTitle && !empty($postTitle) ? $postTitle: null,
    'content'       => $text,
    'layout'        => 'full-width',
    'background'    => $background_color,
    'image'         => $image ? $image->url: false,
    'imageFocus'    => $image ? ['top' => $image->top, 'left' => $image->left]: false,
    'height'        => $height,
    'textColor'     => $text_color,
    'textAlignment' => $text_alignment,
    'textSize'      => $text_size,
    'paddingTop'    => $spacing_top,
    'paddingBottom' => $spacing_bottom,
    'stretch'       => !is_admin() && isset($blockData) ? (bool) $blockData['align'] == 'full' : $stretch,
    'context'       => ['sectionsFull', 'sections', 'sections.full', 'module.sections.full'],
    'buttons'       => $buttons
])
    @if (!empty($submodules) && is_array($submodules))
        {!! $submoduleRendered !!}
    @endif
@endsegment
