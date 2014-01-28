<?php
/**
 * @package GA_Campaign
 * @version 1.2
 */
/*
Plugin Name: Google Analytics Campaign
Plugin URI: http://wordpress.org/plugins/ga-campaign/
Description: Create Google Analytics custom campaign urls for each post.
Author: Jason M. Kalawe
Version: 1.0
Author URI: http://makea.kalawe.com

# CHANGELOG

## 1.2

* Correctly use $post->post_name by referencing $post as a global variable
*/

// MetaBox Plugin
// http://www.farinspace.com/wpalchemy-metabox
include_once dirname( __FILE__ ) . '/WPAlchemy/MetaBox.php';

// Admin Code
if ( is_admin() )
	include_once dirname( __FILE__ ) . '/admin.php';

if (!defined('MYPLUGIN_PLUGIN_NAME'))
    define('MYPLUGIN_PLUGIN_NAME', trim(dirname(plugin_basename(__FILE__)), '/'));

if (!defined('MYPLUGIN_PLUGIN_DIR'))
    define('MYPLUGIN_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . MYPLUGIN_PLUGIN_NAME);

if (!defined('MYPLUGIN_PLUGIN_URL'))
    define('MYPLUGIN_PLUGIN_URL', WP_PLUGIN_URL . '/' . MYPLUGIN_PLUGIN_NAME);
 
// // include css to help style our custom meta boxes
// add_action( 'init', 'my_metabox_styles' );
 
// function my_metabox_styles()
// {
//     if ( is_admin() ) 
//     { 
//         wp_enqueue_style( 'wpalchemy-metabox', get_stylesheet_directory_uri() . '/metaboxes/meta.css' );
//     }
// }
 
$metabox = new WPAlchemy_MetaBox(array
(
    'id' => '_fp_ga_campaign_urls',
    'title' => 'Google Analytics Campaign URLs',
    'template' => WP_PLUGIN_DIR . '/ga-campaign/template.php',
    'context' => 'side',
));



?>