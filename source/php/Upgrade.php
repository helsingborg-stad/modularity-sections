<?php

namespace ModularitySections;

/**
 * Class Upgrade
 *
 * @package Modularity
 */
class Upgrade
{
    private $dbVersion = 1; //The db version we want to achive
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

        if (!isset($_GET['sectupd'])) {
            return false;
        }

        $posts = get_posts([
            'post_type' => [
                'mod-section-full',
                'mod-section-split',
                'mod-section-featured'
            ],
            'numberposts' => -1
        ]);

        //key = from, value = to
        $keysToMove = array(
            'mod_section_content' => 'text',
            'bgimg_mod_section_background_image' => 'image',
            'font_mod_section_fontsize' => 'text_size',
            'font_mod_section_fontcolor' => 'text_color',
            'mod_section_height' => 'height',
            'mod_section_padding' => 'spacing_top',
            'bgimg_mod_section_background_color' => 'background_color',
            'mod_section_image_position' => 'reverse_columns'
        );

        $fieldIDsSplitFeature = [
            'image' => 'field_60d1a90e5551a',
            'text' => 'field_60d1a8040b829',
            'reverse_columns' => 'field_60d1f51ff8692',
            'text_color' => 'field_60d1a9555551c',
            'text_size' => 'field_60d1a84a0b82a',
            'text_alignment' => 'field_60d1a9d55551e',
            'background_color' => 'field_60d1a9295551b',
            'height' => 'field_60d1a9935551d',
            'spacing_top' => 'field_60d2f7b110b0b',
            'spacing_bottom' => 'field_60d2f7cc10b0c'
        ];

        $fieldIDsFull = [
            'image' => 'field_6154339333491',
            'text' => 'field_6154339333497',
            'reverse_columns' => 'field_60d1f51ff8692',
            'text_color' => 'field_61543393334b0',
            'text_size' => 'field_61543393334b6',
            'text_alignment' => 'field_61543393334bb',
            'background_color' => 'field_61543393334bf',
            'height' => 'field_61543393334c3',
            'spacing_top' => 'field_61543393334c7',
            'spacing_bottom' => 'field_61543393334cc'
        ];

        if (is_array($posts) && !empty($posts)) {
            foreach ($posts as $post) {

                //Set field id scheme
                if ($post->post_type == 'mod-section-full') {
                    $fieldIDs = $fieldIDsFull;
                } else {
                    $fieldIDs = $fieldIDsSplitFeature;
                }

                foreach ($keysToMove as $from => $to) {

                    //Old meta & defaults
                    $oldMeta    = get_post_meta($post->ID, $from, true);
                    $meta       = null;

                    //Translate image
                    if ($to == 'image' && is_numeric($oldMeta)) {
                        $meta = [
                            'top' => 50,
                            'left' => 50,
                            'id' => $oldMeta
                        ];
                    }

                    //Translate position
                    if ($to == 'reverse_columns') {
                        $meta = ($oldMeta == 'left') ? '0' : '1';
                    }

                    //Translate font-size
                    if ($to == 'text_size') {
                        $meta = ($oldMeta == 'normal') ? 'default' : 'large';
                    }

                    //Translate font-color
                    if ($to == 'text_color') {
                        $meta = ($oldMeta == 'text-color-dark') ? 'dark' : 'light';
                    }

                    //Translate height
                    if ($to == 'height') {
                        $meta = ($oldMeta == 'lg')  ? 'full-screen' : 'content';
                    }

                    //Translate padding
                    if ($to == 'spacing_top') {
                        if ($thisMeta = 'lg') {
                            add_post_meta($post->ID, "spacing_bottom", 1, true);
                            add_post_meta($post->ID, "_spacing_bottom", $fieldIDs['spacing_bottom'], true);
                            $meta = 1;
                        } else {
                            $meta = 0;
                        }
                    }

                    //No translate, just move
                    if (is_null($meta)) {
                        $meta = get_post_meta($post->ID, $from, true);
                    }

                    //Add new post meta, if not exist
                    add_post_meta($post->ID, $to, $meta, true);
                    update_post_meta($post->ID, '_' . $to, $fieldIDs[$to]);

                    //Cleanup
                    delete_post_meta($post->ID, $from);
                }
            }
        }

        return true; //Return false to keep running this each time!
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
new Upgrade();
