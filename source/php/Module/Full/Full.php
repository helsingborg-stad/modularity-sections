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

        //Get image id
        $imageId = $this->getImageId($data);

        //Get image
        if($imageId) {
            $data['image'] = ImageComponentContract::factory(
                    $imageId,
                    [1920, false],
                    new ImageResolver(),
                    new ImageFocusResolver(
                        isset($data['image']) && is_array($data['image']) ? $data['image']: null
                    )
            );
        } else {
            $data['image'] = false;
        }

        //Send to view
        return $data;
    }

    /**
     * Get image id from data array
     * 
     * @param array $data
     * 
     * @return int
     */
    private function getImageId(array $data): ?int {
        if($data['image'] && is_array($data['image'])) {
            return $data['image']['id'];
        } elseif($data['image'] && is_numeric($data['image'])) {
            return $data['image'];
        }
        return null;
    }

    /**
     * Set template
     * 
     * @return string
     */
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
