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
            $markup = str_replace($moduleType . " ", $moduleType . " u-margin--0 ", $markup);
        }

        return $markup;
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
