@segment([
    'id' => isset($blockData['anchor']) ? $blockData['anchor'] : $fallbackId,
    'title' => !$hideTitle && !empty($postTitle) ? $postTitle : null,
    'content' => $text,
    'layout' => 'card',
    'containerAware' => true,
    'image' => $image,
    'height' => $height,
    'reverseColumns' => $reverse_columns,
    'paddingTop' => $spacing_top,
    'paddingBottom' => $spacing_bottom,
    'stretch' => !is_admin() && isset($blockData) ? (bool) $blockData['align'] == 'full' : $stretch,
    'context' => ['sectionsCard', 'sections', 'sections.card', 'module.sections.card'],
    'buttons' => !empty($buttons) ? $buttons : [],
    'hasPlaceholder' => true,
])
    @if (!empty($submodules) && is_array($submodules))
        {!! $submoduleRendered !!}
    @endif
@endsegment
