<?php

namespace ModularitySections\Module\Featured;

class Featured extends \Modularity\Module
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
        $data = get_fields($this->ID);

        //Fetch image data
        if (isset($data['image']) && is_array($data['image']) && isset($data['image']['id'])) {
            $data['image']['url'] = wp_get_attachment_image_src(
                $data['image']['id'],
                [960, false]
            )[0];
            $data['image'] = (object) $data['image'];
        } elseif (isset($data['image']) && is_numeric($data['image'])) {
            $data['image'] = (object) [
                'url'   => wp_get_attachment_image_src($data['image'], [960, false])[0],
                'top'   => false,
                'left' => false
            ];
        } else {
            $data['image'] = (object) [
                'url'   => false,
                'top'   => false,
                'left' => false
            ];
        }

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
