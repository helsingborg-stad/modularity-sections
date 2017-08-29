<?php

namespace ModularitySections;

class ModuleData
{

    public $module;
    public $data = array();
    public $imageSize = array(
        'mod-section-split' => array(650, 365),
        'mod-section-full' => array(1300, 731),
        'mod-section-featured' => array(1300, 731),
    );

    public function __construct($module)
    {
        if (!is_subclass_of($module, "Modularity\Module")) {
            wp_die("Could not implement class as module" . get_parent_class($module));
        }

        $this->module = $module;

        //Create data structure
        $data = array('classes' => array());

        //Get data
        $this->data = $this->init($this->data);

        //Format data
        $this->data = $this->createEffectProperties($this->data);
        $this->data = $this->createLayoutProperties($this->data);
        $this->data = $this->createBackgroundProperties($this->data);
        $this->data = $this->createTextLayoutProperties($this->data);
        $this->data = $this->renderShortCodes($this->data);
    }

    /**
     * Init data
     * @return array
     */
    public function init($data) : array
    {
        //Mapping table
        $metaMapper = array(
            'mod_section_content' => 'content',

            'mod_section_justify_text' => 'justifyText',

            'mod_section_image' => 'foregroundImage',

            'mod_section_height' => 'height',
            'mod_section_padding' => 'padding',

            'mod_section_image_position' => 'imagePosition',
            'mod_section_content_position' => 'contentPosition',

            'mod_section_bg_position_vertical' => 'backgroundVertical',
            'mod_section_bg_position_horizontal' => 'backgroundHorizontal',

            'mod_section_effect_parallax' => 'effectParallax',
            'mod_section_effect_multiply' => 'effectMultiply',
            'mod_section_effect_blur' => 'effectBlur',
            'mod_section_effect_inset' => 'effectInsetShadow',

            'mod_section_background_image' => 'backgroundImage',
            'mod_section_background_color' => 'backgroundColor',

            'mod_section_submodules' => 'submodules',
        );

        //Id
        $data['sectionID'] = sanitize_title($this->module->post_title);

        //Get meta fields & remap
        foreach ($metaMapper as $meta => $variable) {
            $data[$variable] = get_field($meta, $this->module->ID, true);
        }

        return $data;
    }

    /**
     * Create effect classes
     * @return array
     */
    public function createEffectProperties($data) : array
    {
        //Add parallax effect
        if ($data['effectParallax']) {
            $data['classes']['section-parallax'] = "effect-parallax";
        }

        //Add multiply effect
        if ($data['effectMultiply']) {
            $data['classes']['section-multiply'] = "effect-multiply";
        }

        //Add blur effect
        if ($data['effectBlur']) {
            $data['classes']['section-blur'] = "effect-blur";
        }

        //Add inset shadow effect
        if ($data['effectInsetShadow']) {
            $data['classes']['section-shadow'] = "effect-inner-shadow";
        }

        return $data;
    }

    /**
     * Create layout classes
     * @return array
     */
    public function createLayoutProperties($data) : array
    {

        //Create section size
        $data['classes']['section-height'] = "section-" . $data['height'];

        //Create section padding class
        $data['classes']['section-padding'] = "padding-" . $data['padding'];

        //Create section disposition class
        $data['classes']['section-image'] = "image-" . $data['imagePosition'];

        //Create section vertical-position class
        $data['classes']['section-content'] = "text-" . $data['contentPosition'];

        return $data;
    }

    /**
     * Create background classes
     * @return array
     */
    public function createBackgroundProperties($data) : array
    {

        //Create background position
        $data['backgroundHorizontal'] = empty($data['backgroundHorizontal']) ? "center" : $data['backgroundHorizontal'];
        $data['backgroundVertical'] = empty($data['backgroundVertical']) ? "center" : $data['backgroundVertical'];

        $data['classes']['image-focus'] = "image-focus-". $data['backgroundHorizontal'] . "-" . $data['backgroundVertical'];

        //Get background image
        if (is_numeric($data['backgroundImage'])) {
            $data['backgroundImage'] = wp_get_attachment_image_src($data['backgroundImage'], $this->calculateBackgroundSize($this->module, $data), false);
            $data['backgroundImage'] = $data['backgroundImage'][0];
        }

        return $data;
    }

    /**
     * Create text classes
     * @return array
     */
    public function createTextLayoutProperties($data) : array
    {
        //Add justify text
        if ($data['justifyText']) {
            $data['classes']['section-justify'] = "justify-text";
        }

        //Create section text columns
        $data['classes']['section-columns'] = !empty($data['numberOfColumns']) ? "columnize-" .$data['numberOfColumns'] : "";

        //Add justify text
        if ($this->calculateContrastColor($data['backgroundColor']) == "dark") {
            $data['classes']['section-text-color'] = "text-color-dark";
        } else {
            $data['classes']['section-text-color'] = "text-color-light";
        }

        return $data;
    }

    /**
     * Render shortcodes
     * @return array
     */
    public function renderShortCodes($data) : array
    {

        //Run shortcodes
        $data['submoduleRendered'] = "";
        if (is_array($data['submodules']) && !empty($data['submodules'])) {
            foreach ($data['submodules'] as $submodule) {
                $data['submoduleRendered'] .= do_shortcode('[modularity id="' . $submodule . '"]');
            }
        }

        return $data;
    }

    /**
     * Calulate the size of the background image
     * @return array
     */
    public function calculateBackgroundSize($module, $data) : array
    {
        $imageSize = $this->imageSize[$this->module->post_type];

        //Make image "tall"
        if ($this->module->post_type == "mod-section-split" && ($data['height'] == "lg"||strlen($data['content']) > 1000)) {
            $imageSize[1] = $imageSize[1]*2;
        }

        if (in_array($this->module->post_type, array('mod-section-full', 'mod-section-featured')) && ($data['height'] == "sm"||strlen($data['content']) < 1000) && !$data['effectParallax']) {
            $imageSize[1] = $imageSize[1]/2;
        }

        //Normalize
        if (is_array($imageSize) && !empty($imageSize)) {
            foreach ($imageSize as $key => $value) {
                $imageSize[$key] = floor($value);
            }
        }

        return $imageSize;
    }

    /**
     * Calulate contrast color depending on background solid color
     * @return string
     */
    public function calculateContrastColor($hexColor) : string
    {
        $hexColor = str_replace("#", "", $hexColor);

        $R1 = hexdec(substr($hexColor, 0, 2));
        $G1 = hexdec(substr($hexColor, 2, 2));
        $B1 = hexdec(substr($hexColor, 4, 2));

        $blackColor = "#000000";
        $R2BlackColor = hexdec(substr($blackColor, 0, 2));
        $G2BlackColor = hexdec(substr($blackColor, 2, 2));
        $B2BlackColor = hexdec(substr($blackColor, 4, 2));

        $L1 = 0.2126 * pow($R1 / 255, 2.2) +
               0.7152 * pow($G1 / 255, 2.2) +
               0.0722 * pow($B1 / 255, 2.2);

        $L2 = 0.2126 * pow($R2BlackColor / 255, 2.2) +
              0.7152 * pow($G2BlackColor / 255, 2.2) +
              0.0722 * pow($B2BlackColor / 255, 2.2);

        $contrastRatio = 0;
        if ($L1 > $L2) {
            $contrastRatio = (int)(($L1 + 0.05) / ($L2 + 0.05));
        } else {
            $contrastRatio = (int)(($L2 + 0.05) / ($L1 + 0.05));
        }

        if ($contrastRatio > 11) {
            return 'dark';
        } else {
            return 'light';
        }
    }
}
