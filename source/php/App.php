<?php

declare(strict_types=1);

namespace ModularitySections;

class App
{
    public function __construct()
    {
        //Add template dirs
        add_filter('Modularity/Module/TemplatePath', static function ($paths) {
            foreach (['full', 'featured', 'split', 'card'] as $module) {
                $paths[] = MODULARITYSECTIONS_MODULE_PATH . '/' . ucfirst($module) . '/views/';
            }
            return $paths;
        });

        //Add classes to mod element
        add_filter('Modularity/Display/BeforeModule', [$this, 'addClass'], 10, 4);

        //Add full width data to view
        add_filter('Modularity/Block/Data', [$this, 'blockData'], 20, 3);

        // The theme provides the optional palette selector and role resolver.
        foreach (['field_61543393334bf', 'field_60d1a9295551b'] as $key) {
            add_filter('acf/load_value/key=' . $key, [$this, 'normalizePaletteValue']);
            add_filter('acf/load_field/key=' . $key, [$this, 'describePaletteField']);
        }
        foreach (['field_61543393334b0', 'field_60d1a9555551c'] as $key) {
            add_filter('acf/load_field/key=' . $key, [$this, 'describeLegacyTextField']);
        }
        add_filter('ComponentLibrary/Component/Segment/Data', [$this, 'applyPalettePair']);
    }

    public function describePaletteField(array $field): array
    {
        if (class_exists(\Municipio\Admin\Acf\PaletteColorChoices::class)) {
            $field['label'] = __('Color scheme', 'modularity-sections');
            $field['instructions'] = __('A color scheme sets both background and text color.', 'modularity-sections');
        }
        return $field;
    }

    public function describeLegacyTextField(array $field): array
    {
        if (class_exists(\Municipio\Admin\Acf\PaletteColorChoices::class)) {
            $field['instructions'] = __('Used only when no color scheme is selected.', 'modularity-sections');
        }
        return $field;
    }

    public function normalizePaletteValue($value)
    {
        if (!is_string($value) || $value === '' || !is_callable([\Municipio\Helper\ColorSwatches::class, 'normalizeColorPairRole'])) {
            return $value;
        }

        return \Municipio\Helper\ColorSwatches::normalizeColorPairRole($value) ?? $value;
    }

    public function applyPalettePair(array $data): array
    {
        $context = $data['context'] ?? [];
        $context = is_array($context) ? $context : [$context];
        if (!in_array('sections', $context, true) || !is_string($data['background'] ?? null)
            || !is_callable([\Municipio\Helper\ColorSwatches::class, 'normalizeColorPairRole'])) {
            return $data;
        }

        $role = \Municipio\Helper\ColorSwatches::normalizeColorPairRole($data['background']);
        if ($role !== null) {
            $data['background'] = $role;
            $data['textColor'] = '';
        }

        return $data;
    }

    /**
     * Add full width setting to frontend.
     *
     * @param [array] $viewData
     * @param [array] $block
     * @param [object] $module
     * @return array
     */
    public function blockData($viewData, $block, $module)
    {
        if (str_starts_with($block['name'], 'acf/section') && $block['align'] == 'full' && !is_admin()) {
            $viewData['stretch'] = true;
        } else {
            $viewData['stretch'] = false;
        }
        return $viewData;
    }

    /**
     * Add class to modules to prevent builtin margins
     * @return string
     */
    public function addClass($markup, $args, $moduleType, $moduleId)
    {
        if (in_array(str_replace('mod-section-', '', $moduleType), ['full', 'featured', 'split'])) {
            $markup = str_replace($moduleType . ' ', $moduleType . ' u-margin--0 ', $markup);
        }

        return $markup;
    }

    /**
     * Get the current post type
     *
     * @return string|bool
     */
    private function getCurrentPostType()
    {
        global $pagenow;

        if ('post.php' === $pagenow && isset($_GET['post'])) {
            return get_post_type($_GET['post']);
        }

        return false;
    }
}
