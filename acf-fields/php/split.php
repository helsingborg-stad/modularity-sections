<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_599fddb1da69a',
    'title' => __('Split section', 'modularity-sections'),
    'fields' => array(
        0 => array(
            'key' => 'field_599fddb1de654',
            'label' => __('General', 'modularity-sections'),
            'name' => '',
            'type' => 'tab',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'placement' => 'top',
            'endpoint' => 0,
        ),
        1 => array(
            'key' => 'field_599fddb1de678',
            'label' => '',
            'name' => '',
            'type' => 'clone',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'clone' => array(
                0 => 'field_599eaa6a6c354',
            ),
            'display' => 'seamless',
            'layout' => 'block',
            'prefix_label' => 0,
            'prefix_name' => 0,
        ),
        2 => array(
            'key' => 'field_59aeb511b83cd',
            'label' => __('Text & font settings', 'modularity-sections'),
            'name' => 'font',
            'type' => 'group',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => 'modularity-ui-header modularity-ui-highlight',
                'id' => '',
            ),
            'layout' => 'block',
            'sub_fields' => array(
                0 => array(
                    'key' => 'field_59aeb538b83ce',
                    'label' => '',
                    'name' => '',
                    'type' => 'clone',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'clone' => array(
                        0 => 'field_59a02632ed6f6',
                        1 => 'field_59a6861f61302',
                        2 => 'field_59a955123431a',
                    ),
                    'display' => 'seamless',
                    'layout' => 'block',
                    'prefix_label' => 0,
                    'prefix_name' => 0,
                ),
            ),
        ),
        3 => array(
            'key' => 'field_599fddb1de713',
            'label' => __('Background', 'modularity-sections'),
            'name' => '',
            'type' => 'tab',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'placement' => 'top',
            'endpoint' => 0,
        ),
        4 => array(
            'key' => 'field_59aeb58f585fe',
            'label' => __('Basic background details', 'modularity-sections'),
            'name' => 'bgimg',
            'type' => 'group',
            'instructions' => __('Set a background image and/or color for this section.', 'modularity-sections'),
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => 'modularity-ui-header modularity-ui-highlight',
                'id' => '',
            ),
            'layout' => 'block',
            'sub_fields' => array(
                0 => array(
                    'key' => 'field_59aeb598585ff',
                    'label' => '',
                    'name' => '',
                    'type' => 'clone',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'clone' => array(
                        0 => 'field_599fce6fc2c2c',
                        1 => 'field_599ed8d854523',
                    ),
                    'display' => 'seamless',
                    'layout' => 'block',
                    'prefix_label' => 0,
                    'prefix_name' => 0,
                ),
            ),
        ),
        5 => array(
            'key' => 'field_59aeb5e17ffe4',
            'label' => __('Background focus', 'modularity-sections'),
            'name' => 'bgfoc',
            'type' => 'group',
            'instructions' => __('Some part of your image are often more important than others. A person or fourground image for example. Set the focal point in the image below.', 'modularity-sections'),
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => 'modularity-ui-header modularity-ui-highlight',
                'id' => '',
            ),
            'layout' => 'block',
            'sub_fields' => array(
                0 => array(
                    'key' => 'field_59aeb5f87ffe5',
                    'label' => '',
                    'name' => '',
                    'type' => 'clone',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'clone' => array(
                        0 => 'field_599eabaeaad08',
                        1 => 'field_599eac93ead36',
                    ),
                    'display' => 'seamless',
                    'layout' => 'block',
                    'prefix_label' => 0,
                    'prefix_name' => 0,
                ),
            ),
        ),
        6 => array(
            'key' => 'field_599fddb1de8f6',
            'label' => __('Margins', 'modularity-sections'),
            'name' => '',
            'type' => 'tab',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'placement' => 'top',
            'endpoint' => 0,
        ),
        7 => array(
            'key' => 'field_599fddb1de987',
            'label' => '',
            'name' => '',
            'type' => 'clone',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'clone' => array(
                0 => 'field_599eab01559ea',
            ),
            'display' => 'seamless',
            'layout' => 'block',
            'prefix_label' => 0,
            'prefix_name' => 0,
        ),
        8 => array(
            'key' => 'field_599fddb1deb21',
            'label' => '',
            'name' => '',
            'type' => 'clone',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'clone' => array(
                0 => 'field_599ecc223a4f6',
            ),
            'display' => 'seamless',
            'layout' => 'block',
            'prefix_label' => 0,
            'prefix_name' => 0,
        ),
        9 => array(
            'key' => 'field_599fddb1de9e5',
            'label' => '',
            'name' => '',
            'type' => 'clone',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'clone' => array(
                0 => 'field_599ec93c4b4b7',
            ),
            'display' => 'seamless',
            'layout' => 'block',
            'prefix_label' => 0,
            'prefix_name' => 0,
        ),
        10 => array(
            'key' => 'field_599fddb1dea90',
            'label' => '',
            'name' => '',
            'type' => 'clone',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'clone' => array(
                0 => 'field_599ecb18ef407',
            ),
            'display' => 'seamless',
            'layout' => 'block',
            'prefix_label' => 0,
            'prefix_name' => 0,
        ),
        11 => array(
            'key' => 'field_599fddb1decc3',
            'label' => __('Submodules', 'modularity-sections'),
            'name' => '',
            'type' => 'tab',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'placement' => 'top',
            'endpoint' => 0,
        ),
        12 => array(
            'key' => 'field_599fddb1ded24',
            'label' => '',
            'name' => '',
            'type' => 'clone',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'clone' => array(
                0 => 'field_599edec7a0587',
            ),
            'display' => 'seamless',
            'layout' => 'block',
            'prefix_label' => 0,
            'prefix_name' => 0,
        ),
    ),
    'location' => array(
        0 => array(
            0 => array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'mod-section-split',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
));
}