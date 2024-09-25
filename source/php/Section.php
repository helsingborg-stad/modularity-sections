<?php

namespace ModularitySections;

use Modularity\Integrations\Component\ImageResolver;
use Modularity\Integrations\Component\ImageFocusResolver;
use ComponentLibrary\Integrations\Image\Image as ImageComponentContract;

class Section extends \Modularity\Module
{

  /**
   * Creates a unique id for the module
   * 
   * @param string $slug
   * @param array $data
   * 
   * @return array
   */
  public function addFallbackId(string $slug, array $data) {
      $data['fallbackId'] = $slug . '-' . uniqid();
      return $data;
  }

  /** 
   * Replaces image array with image contract
   * 
   * @param array $data
   */
  public function getImageContract(array $data) {
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
   * Available "magic" methods for modules:
   * init()            What to do on initialization
   * data()            Use to send data to view (return array)
   * style()           Enqueue style only when module is used on page
   * script            Enqueue script only when module is used on page
   * adminEnqueue()    Enqueue scripts for the module edit/add page in admin
   * template()        Return the view template (blade) the module should use when displayed
   */
}
