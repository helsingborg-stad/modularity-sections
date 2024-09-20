<?php

namespace ModularitySections\Module\Split;

use Modularity\Integrations\Component\ImageResolver;
use Modularity\Integrations\Component\ImageFocusResolver;
use ComponentLibrary\Integrations\Image\Image as ImageComponentContract;

class Split extends \Modularity\Module
{
    public $slug = 'section-split';
    public $supports = array();
    public $blockSupports = array(
        'align' => ['full']
    );

    public function init()
    {
        $this->nameSingular = __("Section split", 'modularity-sections');
        $this->namePlural = __("Section split", 'modularity-sections');
        $this->description = __("Outputs a section.", 'modularity-sections');
    }

    public function data(): array
    {
        $data = $this->getFields();
        $data['fallbackId'] = $this->slug . '-' . uniqid();




        //Get image 
        $imageId = $this->getImageId($data['image']);

      

        if($imageId) {
            $data['image'] = [
                'image' => ImageComponentContract::factory(
                    (int) $fields['mod_hero_background_image']['id'],
                    [1024, false],
                    new ImageResolver(),
                    new ImageFocusResolver($data['image'])
                )
            ];
        }

        var_dump($data['image']);
        die;

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
