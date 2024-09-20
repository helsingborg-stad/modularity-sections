<?php

namespace ModularitySections\Module\Full;

use Modularity\Integrations\Component\ImageResolver;
use Modularity\Integrations\Component\ImageFocusResolver;
use ComponentLibrary\Integrations\Image\Image as ImageComponentContract;

class Full extends \Modularity\Module
{
    public $slug = 'section-full';
    public $supports = array();
    public $blockSupports = array(
        'align' => ['full']
    );

    public function init()
    {
        $this->nameSingular = __("Section full", 'modularity-sections');
        $this->namePlural = __("Section full", 'modularity-sections');
        $this->description = __("Outputs a section.", 'modularity-sections');
    }

    public function data() : array
    {
        $data = $this->getFields();

        $data['fallbackId'] = $this->slug . '-' . uniqid();

        $imageId = $this->getImageId($data['image']);

        if($imageId) {
            $data['image'] = [
                'image' => ImageComponentContract::factory(
                    (int) $imageId,
                    [1024, false],
                    new ImageResolver(),
                    //new ImageFocusResolver($data['image'])
                )
            ];
        }

        //Send to view
        return $data;
    }

    private function getImageId($image): ?int
    {
        if (is_array($image) && isset($image['id'])) {
            return $image['id'];
        } elseif (is_numeric($image)) {
            return $image;
        }
        return null;
    }

    public function template() : string
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
