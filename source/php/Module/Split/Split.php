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
        $data = get_fields($this->ID);
        
        // //Get common data
        // $data = new \ModularitySections\ModuleData($this);

        // if (isset($data->data) && is_array($data->data)) {
        //     $data = $data->data;
        // } else {
        //     $data = array();
        // }

        // //Implode classes (filterable)
        // $data['classes'] = implode(' ', apply_filters('Modularity/Module/Classes', $data['classes'], $this->post_type, $this->args, $data));

        
        //Send to view
        return $data;
    }

    public function template() : string
    {
        return "split.blade.php";
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
