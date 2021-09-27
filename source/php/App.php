<?php

namespace ModularitySections;

class App
{
    public function __construct()
    {
        //Add template dirs
        add_filter('Modularity/Module/TemplatePath', function ($paths) {
            foreach (array('full', 'featured', 'split') as $module) {
                $paths[] = MODULARITYSECTIONS_MODULE_PATH . '/' . ucfirst($module) . '/views/';
            }
            return $paths;
        });

        //Add classes to mod element
        add_filter('Modularity/Display/BeforeModule', array($this, 'addClass'), 10, 4);

        //Add css to fields
        add_filter('acf/load_field/name=reverse_columns', array($this, 'renderCss'), 10, 1);

        //Add full-width capabilty to blocks
        add_filter('Modularity/Block/Settings', array($this, 'blockSettings'), 10, 2); 

        //Add full width data to view
        add_filter('Modularity/Block/Data', array($this, 'blockData'), 10, 3); 
        
    }

    /**
     * Add full width setting to frontend. 
     *
     * @param [array] $viewData
     * @param [array] $block
     * @param [object] $module
     * @return array
     */
    public function blockData($viewData, $block, $module) {

        $classList[] = 'municipio-block-container';

        if(isset($block['align']) && !empty($block['align'])) {
            $classList[] = "municipio-block-align-" . $block['align'];
        }

        $viewData['classList'] = implode(' ', $classList);

        return $viewData;
    }

    /**
     * Allow full-width alignment on section blocks
     *
     * @param array $data
     * @param string $slug
     * @return array
     */
    public function blockSettings($data, $slug) {
        if(strpos($slug, 'section') === 0 && isset($data['supports'])) {
            $data['supports']['align'] = ['full']; 
        }
        return $data; 
    }

    /**
     * Add class to modules to prevent builtin margins
     * @return string
     */
    public function addClass($markup, $args, $moduleType, $moduleId)
    {
        if (in_array(str_replace("mod-section-", "", $moduleType), array('full', 'featured', 'split'))) {
            $markup = str_replace($moduleType . " ", $moduleType . " u-margin--0 ", $markup);
        }

        return $markup;
    }

    /**
     * Hide position selector if section full is edited.
     * This enshures that we can use the same filed definition
     * for all section types. 
     *
     * @param array $field
     * @return array
     */
    public function renderCss($field) {
        if($this->getCurrentPostType() == 'mod-section-full') {
            $field['instructions'] = '<style>[data-name="reverse_columns"] { display: none !important; }</style>'; 
        }
        return $field; 
    }

    /**
     * Get the current post type
     *
     * @return string|bool
     */
    private function getCurrentPostType() {

        global $pagenow;
    
        if ('post.php' === $pagenow && isset($_GET['post'])){
            $postId = $_GET['post'];

            return get_post_type($postId);    
        }

        return false; 
    }
}
