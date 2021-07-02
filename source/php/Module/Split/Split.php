<?php

namespace ModularitySections\Module\Split;

class Split extends \Modularity\Module
{
    public $slug = 'section-split';
    public $supports = array();
    private $imageSize = [960, 540]; 

    public function init()
    {
        $this->nameSingular = __("Section split", 'modularity-sections');
        $this->namePlural = __("Section split", 'modularity-sections');
        $this->description = __("Outputs a section.", 'modularity-sections');
    }

    public function data() : array
    {
        $data = get_fields($this->ID);

        //Fetch image data
        if(isset($data['image']) && is_array($data['image'])) {
            $data['image']['url'] = wp_get_attachment_image_src($data['image']['id'], $this->imageSize)[0];
        } elseif(isset($data['image']) && is_numeric($data['image'])) {
            $imageId = $data['image']; 
            $data['image'] = []; 
            $data['image']['url']   = wp_get_attachment_image_src($imageId, $this->imageSize)[0];
            $data['image']['top']   = false;
            $data['image']['left']  = false;
        }

        //Transform to object
        $data['image'] = (object) $data['image']; 
        
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
