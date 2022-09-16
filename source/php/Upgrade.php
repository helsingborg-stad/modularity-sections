<?php

namespace ModularitySections;

/**
 * Class Upgrade
 *
 * @package Modularity
 */
class Upgrade
{
    private $dbVersion = 2; //The db version we want to achive
    private $dbVersionKey = 'mod_sections_db_version';
    private $db;

    /**
     * App constructor.
     */
    public function __construct()
    {
        //Development tools
        //WARNING: Do not use in PROD. This will destroy your db.
        /*add_action('init', array($this, 'reset'), 1);*/

        //Production hook
        add_action('wp', array($this, 'initUpgrade'), 10);
    }

    /**
     * Reset db version, in order to run all scripts from the beginning.
     *
     * @return void
     */
    public function reset()
    {
        delete_option($this->dbVersionKey);
    }

    /**
     * Upgrade database,
     * when you want to upgrade database,
     * create a new function and increase
     * $this->dbVersion.
     *
     * Method inspiration from WordPress Core.
     *
     * @return boolean
     */
    private function v_1($db): bool
    {

        $posts = get_posts([
            'post_type' => 'mod-section-full',
            'numberposts' => -1
        ]);
        //var_dump($posts);

        //key = from, value = to
        $keysToMove = array(
            'mod_section_content' => 'text',
            'bgimg_mod_section_background_image' => 'image',
            'font_mod_section_fontsize' =>'text_size',
            'font_mod_section_fontcolor' => 'text_color',
            'mod_section_height' => 'height',
            'mod_section_padding' => 'spacing_top',
            'bgimg_mod_section_background_color' => 'background_color'

        );

        if (is_array($posts) && !empty($posts)) {
            foreach ($posts as $post) {
                $meta = get_post_meta($post->ID);

                foreach ($keysToMove as $from => $to) {
                    if (!isset($meta[$to])) {

                        //Translate image
                        if ($to == 'image' && is_numeric($meta[$from])) {
                            $meta[$from] = [
                                'top' => 50,
                                'left' => 50,
                                'url' => wp_get_attachment_image_src($meta[$from])
                            ];
                        }

                        //font-size
                        if($to == 'text_size' && $meta[$from] == 'normal') {
                            $meta[$from] = 'normal' ? 'default' : 'large';
                        } 

                        //font-color
                        if($to == 'text_color') {
                            $meta[$from] = 'text-color-dark' ? 'dark' : 'light';
                        }

                        //height 
                        if($to == 'height') {
                            $meta[$from] = 'lg' ? 'full-screen' : 'content';
                            
                        }

                        //padding
                        if($to == 'spacing_top') {
                            if($meta[$from] = 'lg') {
                                update_post_meta($postId, "spacing_bottom", 1);
                                $meta[$from] = 1;
                            } else {
                                $meta[$from] = 0;
                            }
                        }
                        
                        update_post_meta($postId, $to, $meta[$from]);
                    }
                }
            }
        }

        return false; //Return false to keep running this each time!
    }

    /**
     * Run upgrade functions
     *
     * @return void
     */
    public function initUpgrade()
    {
        $currentDbVersion = is_numeric(get_option($this->dbVersionKey)) ? (int) get_option($this->dbVersionKey) : 1;

        if ($this->dbVersion != $currentDbVersion) {
            if (!is_numeric($this->dbVersion)) {
                wp_die(__('To be installed database version must be a number.', 'municipio'));
            }

            if (!is_numeric($currentDbVersion)) {
                error_log(__('Current database version must be a number.', 'municipio'));
            }

            if ($currentDbVersion > $this->dbVersion) {
                error_log(__('Database cannot be lower than currently installed (cannot downgrade).', 'municipio'));
            }

            //Fetch global wpdb object, save to $db
            $this->globalToLocal('wpdb', 'db');

            //Run upgrade(s)
            while ($currentDbVersion <= $this->dbVersion) {
                $funcName = 'v_' . (string) $currentDbVersion;
                if (method_exists($this, $funcName)) {
                    if ($this->{$funcName}($this->db)) {
                        update_option($this->dbVersionKey, (int) $currentDbVersion);
                        wp_cache_flush();
                    }
                }
                $currentDbVersion++;
            }
        }
    }

    /**
     * Creates a local copy of the global instance
     * The target var should be defined in class header as private or public
     * @param string $global The name of global varable that should be made local
     * @param string $local Handle the global with the name of this string locally
     * @return void
     */
    private function globalToLocal($global, $local = null)
    {
        global $$global;

        if (is_null($$global)) {
            return false;
        }

        if (is_null($local)) {
            $this->$global = $$global;
        } else {
            $this->$local = $$global;
        }

        return true;
    }
}
