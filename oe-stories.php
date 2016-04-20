<?php
/*
  Plugin Name: Stories
  Plugin URI: http://open-ecommerce.org/
  Description: Declares a plugin that will create a custom post type stories.
  Version: 1.0
  Author: Eduardo G. Silva
  Author URI: http://open-ecommerce.org/
  License: GPLv2
 */

add_action('init', 'create_stories');

function create_stories() {
    register_post_type('stories', array(
        'labels' => array(
            'name' => 'Stories',
            'singular_name' => 'Story',
            'add_new' => 'Add New Story',
            'add_new_item' => 'Add New Story',
            'edit' => 'Edit',
            'edit_item' => 'Edit Members',
            'new_item' => 'New Story',
            'view' => 'View',
            'view_item' => 'View Story',
            'search_items' => 'Search Story',
            'not_found' => 'No Story found',
            'not_found_in_trash' => 'No Story found in Trash',
            'parent' => 'Parent Story'
        ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => plugins_url('images/oe-stories.png', __FILE__),
        'query_var' => true,
        'rewrite' => array('slug' => 'member'),
        'has_archive' => true,
        'captability_type' => 'post',
        'hierarchical' => 'false'
            )
    );
}


add_filter('template_include', 'include_template_function', 1);

function include_template_story($template_path) {
    if (get_post_type() == 'stories') {
        if (is_single()) {
            if ($theme_file = locate_template(array
                ('single-stories.php'))) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path(__FILE__) . '/single-story.php';
            }
        }
    }
    return $template_path;
}

function stories_rewrite_flush() {
    create_stories();
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'stories_rewrite_flush')
?>
