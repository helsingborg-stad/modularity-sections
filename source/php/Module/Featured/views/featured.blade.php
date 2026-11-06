@segment([
    'id' => isset($blockData['anchor']) ? $blockData['anchor'] : $fallbackId,
    'title' => !$hideTitle && !empty($postTitle) ? $postTitle : null,
    'content' => $text,
    'layout' => 'featured',
    'background' => $background_color,
    'image' => $image,
    'height' => $height,
    'textColor' => $text_color,
    'textAlignment' => $text_alignment ?? 'center',
    'textSize' => $text_size,
    'reverseColumns' => $reverse_columns,
    'paddingTop' => $spacing_top,
    'paddingBottom' => $spacing_bottom,
    'stretch' => !is_admin() && isset($blockData) ? (($blockData['align'] ?? '') === 'full') : (bool) ($stretch ?? false),
    'context' => ['sectionsFeatured', 'sections', 'sections.featured', 'module.sections.featured']
])
    @if (!empty($submodules) && is_array($submodules))
        {!! $submoduleRendered !!}
    @endif
@endsegment
