<?php

namespace ModularitySections\Module\Card;

class Card extends \Modularity\Module
{
    public $slug = 'section-card';
    public $supports = array();
    public $blockSupports = array(
        'align' => ['full']
    );

    public function init()
    {
        $this->nameSingular = __("Section card", 'modularity-sections');
        $this->namePlural = __("Section card", 'modularity-sections');
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

        //Send to view
        return $data;
    }

    public function template(): string
    {
        return "card.blade.php";
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
