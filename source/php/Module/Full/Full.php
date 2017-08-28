<?php

namespace ModularitySections\Module\Full;

class Full extends \Modularity\Module
{
    public $slug = 'section-full';
    public $supports = array();

    public function init()
    {
        $this->nameSingular = __("Section full", 'modularity-sections');
        $this->namePlural = __("Section full", 'modularity-sections');
        $this->description = __("Outputs a section.", 'modularity-sections');
    }

    public function data() : array
    {

        //Mapping table
        $metaMapper = array(
            'mod_section_content' => 'content',

            'mod_section_columns' => 'numberOfColumns',
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

        //Create data structure
        $data = array('classes' => array());

        //Id
        $data['sectionID'] = sanitize_title($this->post_title);

        //Get meta fields & remap
        foreach ($metaMapper as $meta => $variable) {
            $data[$variable] = get_field($meta, $this->ID, true);
        }

        //Create background position
        $data['classes']['image-focus'] = "image-focus-". $data['backgroundHorizontal'] . "-" . $data['backgroundVertical'];

        //Create section size
        $data['classes']['section-height'] = "section-" . $data['height'];

        //Create section padding class
        $data['classes']['section-padding'] = "padding-" . $data['padding'];

        //Create section vertical-position class
        $data['classes']['section-content'] = "text-" . $data['contentPosition'];

        //Create section text columns
        $data['classes']['section-columns'] = "columnize-" . $data['numberOfColumns'];

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

        //Add justify text
        if ($data['justifyText']) {
            $data['classes']['section-justify'] = "justify-text";
        }

        //Get background image
        if (is_numeric($data['backgroundImage'])) {
            $data['backgroundImage'] = wp_get_attachment_image_src($data['backgroundImage'], array(1300, 731), false);
            $data['backgroundImage'] = $data['backgroundImage'][0];
        }

        //Run shortcodes
        $data['submoduleRendered'] = "";
        if (is_array($data['submodules']) && !empty($data['submodules'])) {
            foreach ($data['submodules'] as $submodule) {
                $data['submoduleRendered'] .= do_shortcode('[modularity id="' . $submodule . '"]');
            }
        }

        //Implode classes (filterable)
        $data['classes'] = implode(' ', apply_filters('Modularity/Module/Classes', $data['classes'], $this->post_type, $this->args));

        //Send to view
        return $data;
    }


    public function template()
    {
        return "full.blade.php";
    }

    /**
     * Available "magic" methods for modules:
     * init()            What to do on initialization
     * data()            Use to send data to view (return array)
     * style()           Enqueue style only when module is used on page
     * script            Enqueue script only when module is used on page
     * adminEnqueue()    Enqueue scripts for the module edit/add page in admin
     * template()        Return the view template (blade) the module should use when displayed
     */
}
