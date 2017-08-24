<?php

namespace ModularitySections\Module\Split;

class Split extends \Modularity\Module
{
    public $slug = 'section-split';
    public $supports = array();

    public function init()
    {
        $this->nameSingular = __("Section split", 'modularity-sections');
        $this->namePlural = __("Section split", 'modularity-sections');
        $this->description = __("Outputs a section.", 'modularity-sections');
    }

    public function data() : array
    {
        $data = array();
        $data['embed'] = get_post_meta($this->ID, 'embed_code', true);
        return $data;
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
