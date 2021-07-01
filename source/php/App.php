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
}
