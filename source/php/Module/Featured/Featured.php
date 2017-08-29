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
        //Get common data
        $data = new \ModularitySections\ModuleData($this);
        $data = $data->data;

        //Implode classes (filterable)
        $data['classes'] = implode(' ', apply_filters('Modularity/Module/Classes', $data['classes'], $this->post_type, $this->args));

        //Send to view
        return $data;
    }

    public function template() : string
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
