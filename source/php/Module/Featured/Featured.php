<?php

namespace ModularitySections\Module\Featured;

class Featured extends \Modularity\Module
{
    public $slug = 'section-featured';
    public $supports = array();

    public function init()
    {
        $this->nameSingular = __("Section featured", 'modularity-sections');
        $this->namePlural = __("Section featured", 'modularity-sections');
        $this->description = __("Outputs a module.", 'modularity-sections');
    }

    public function data() : array
    {

        //Mapping table
        $metaMapper = array(
            'mod_section_content' => 'content',
            'mod_section_height' => 'height',
            'mod_section_padding' => 'padding',
            'mod_section_image_position' => 'imagePosition',
            'mod_section_content_position' => 'contentPosition',
            'mod_section_bg_position_vertical' => 'backgroundVertical',
            'mod_section_bg_position_horizontal' => 'backgroundHorizontal',
            'mod_section_effect' => 'effects'
        );

        //Create data structure
        $data = array('classes' => array());

        //Get meta fields & remap
        foreach ($metaMapper as $meta => $variable) {
            $data[$variable] = get_field($meta, $this->ID, true);
        }

        //Create efx class
        if (is_array($data['effects'])) {
            $data['classes']['effect'] = implode(" ", array_map(function ($item) {
                return 'effect-' . $item;
            }, $data['effects']));
        } else {
            $data['effects'] = array();
        }

        //Create background position
        $data['classes']['image-focus'] = "image-focus-". $data['backgroundHorizontal'] . "-" . $data['backgroundVertical'];

        //Create section size
        $data['classes']['section-height'] = "section-" . $data['height'];

        //Create section padding class
        $data['classes']['section-padding'] = "padding-" . $data['padding'];

        //Create section padding class
        $data['classes']['section-image'] = "image-" . $data['imagePosition'];

        //Create section padding class
        $data['classes']['section-content'] = "text-" . $data['contentPosition'];

        //Implode classes (filterable)
        $data['classes'] = implode(' ', apply_filters('Modularity/Module/Classes', $data['classes'], $this->post_type, $this->args));

        //Send to view
        return $data;
    }

    public function template()
    {
        return "featured.blade.php";
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
