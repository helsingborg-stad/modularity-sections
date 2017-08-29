<?php

namespace ModularitySections;

class ModuleData
{

    private $module;
    public $data = array();

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

        return $this->data;
    }

    /**
     * Init data
     * @return array
     */
    public function init($data)
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
    public function createEffectProperties($data)
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
    public function createLayoutProperties($data)
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


    public function createBackgroundProperties($data)
    {

        //Create background position
        $data['classes']['image-focus'] = "image-focus-". $data['backgroundHorizontal'] . "-" . $data['backgroundVertical'];

        //Get background image
        if (is_numeric($data['backgroundImage'])) {
            $data['backgroundImage'] = wp_get_attachment_image_src($data['backgroundImage'], array(1300, 731), false);
            $data['backgroundImage'] = $data['backgroundImage'][0];
        }

        return $data;
    }

    public function createTextLayoutProperties($data)
    {
        //Add justify text
        if ($data['justifyText']) {
            $data['classes']['section-justify'] = "justify-text";
        }

        //Create section text columns
        $data['classes']['section-columns'] = "columnize-" . $data['numberOfColumns'];

        return $data;
    }

    public function renderShortCodes($data)
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
}
