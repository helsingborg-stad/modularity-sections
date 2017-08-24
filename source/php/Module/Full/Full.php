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
        $data = array();


        $data['content'] = get_field('mod_section_content');

        $data['embed'] = get_post_meta($this->ID, 'embed_code', true);
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
