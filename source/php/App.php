<?php

namespace ModularitySections;

class App
{
    public function __construct()
    {
        //Backend styles & scripts
        add_action('admin_enqueue_scripts', array($this, 'enqueueStyles'));
        add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'));

        //Add template dirs
        add_filter('Modularity/Module/TemplatePath', function ($paths) {
            foreach (array('full', 'featured', 'split') as $module) {
                $paths[] = MODULARITYSECTIONS_MODULE_PATH . '/' . ucfirst($module) . '/views/';
            }
            return $paths;
        });

        //Add sections menu to municipio
        add_filter('Municipio/Menu/Vertical/Items', array($this, 'renderSectionsMenu'));

        //Add classes to mod element
        add_filter('Modularity/Display/BeforeModule', array($this, 'addClass'), 10, 4);
    }

    /**
     * Add class to divided sections
     * @return string
     */
    public function addClass($markup, $args, $moduleType, $moduleId)
    {
        if (in_array(str_replace("mod-section-", "", $moduleType), array('full', 'featured', 'split'))) {
            if (function_exists('get_field') && get_field('efx_mod_section_divider', $moduleId)) {
                $markup = str_replace($moduleType . " ", $moduleType . " has-divider ", $markup);
            }
        }

        return $markup;
    }

    /**
     * Render the sections menu
     * @return array
     */

    public function renderSectionsMenu($items)
    {
        global $post;

        //Create array if it isen't
        if (!is_array($items)) {
            $items = array();
        }

        //Get modules
        if ($archiveSlug = \Modularity\Helper\Wp::getArchiveSlug()) {
            $modules = \Modularity\Editor::getPostModules($archiveSlug);
        } else {
            $modules = \Modularity\Editor::getPostModules($post->ID);
        }

        //Add all modules to array
        foreach (array('top-sidebar', 'bottom-sidebar') as $sidebar) {
            if (isset($modules[$sidebar]) && is_array($modules[$sidebar]) && !empty($modules[$sidebar])) {
                foreach ($modules[$sidebar]['modules'] as $module) {
                    $items[] = array('title' => $module->post_title, 'link' => '#' . sanitize_title($module->post_title));
                }
            }
        }

        return $items;
    }

    /**
     * Enqueue required style
     * @return void
     */
    public function enqueueStyles()
    {
    }

    /**
     * Enqueue required scripts
     * @return void
     */
    public function enqueueScripts()
    {
    }
}
