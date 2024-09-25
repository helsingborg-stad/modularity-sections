<?php

namespace ModularitySections\Module\Featured;

use ModularitySections\Section;
class Featured extends Section
{
    public $slug = 'section-featured';
    public $supports = array();
    public $blockSupports = array(
        'align' => ['full']
    );

    public function init()
    {
        $this->nameSingular = __("Section featured", 'modularity-sections');
        $this->namePlural = __("Section featured", 'modularity-sections');
        $this->description = __("Outputs a module.", 'modularity-sections');
    }
    public function data(): array
    {
        $data = $this->getFields();
    
        //Add fallback id
        $data = $this->addFallbackId($this->slug, $data);

        //Get image contract
        $data = $this->getImageContract($data);

        //Send to view
        return $data;
    }

    public function template(): string
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
