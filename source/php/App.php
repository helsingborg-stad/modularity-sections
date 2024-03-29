<?php

namespace ModularitySections;

class App
{
    public function __construct()
    {

        //Add template dirs
        add_filter('Modularity/Module/TemplatePath', function ($paths) {
            foreach (array('full', 'featured', 'split', 'card') as $module) {
                $paths[] = MODULARITYSECTIONS_MODULE_PATH . '/' . ucfirst($module) . '/views/';
            }
            return $paths;
        });

        //Add classes to mod element
        add_filter('Modularity/Display/BeforeModule', array($this, 'addClass'), 10, 4);

        //Add full width data to view
        add_filter('Modularity/Block/Data', array($this, 'blockData'), 20, 3);
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
        if (strpos($block['name'], "acf/section") === 0 && $block['align'] == 'full' && !is_admin()) {
            $viewData['stretch'] = true;
        } else {
            $viewData['stretch'] = false;
        }
        return $viewData;
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
     * Get the current post type
     *
     * @return string|bool
     */
    private function getCurrentPostType()
    {
        global $pagenow;

        if ('post.php' === $pagenow && isset($_GET['post'])) {
            return get_post_type($_GET['post']);
        }

        return false;
    }
}
