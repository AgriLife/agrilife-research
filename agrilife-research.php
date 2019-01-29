<?php
/**
 * Plugin Name: AgriLife Research
 * Plugin URI: https://github.com/AgriLife/AgriLife-Research
 * Description: Functionality for AgriLife Research sites using AgriFlex 3
 * Version: 1.0
 * Author: Zach Watkins
 * Author URI: http://github.com/ZachWatkins
 * Author Email: zachary.watkins@ag.tamu.edu
 * License: GPL2+
 */

require 'vendor/autoload.php';

define( 'AG_RESEARCH_DIRNAME', 'agrilife-research' );
define( 'AG_RESEARCH_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'AG_RESEARCH_DIR_FILE', __FILE__ );
define( 'AG_RESEARCH_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'AG_RESEARCH_TEMPLATE_PATH', AG_RESEARCH_DIR_PATH . 'view' );

// Register plugin activation functions
//$activate = new \AgriLife\Core\Activate;
//register_activation_hook( __FILE__, array( $activate, 'run') );

// Register plugin deactivation functions
//$deactivate = new \AgriLife\Core\Deactivate;
//register_deactivation_hook( __FILE__, array( $deactivate, 'run' ) );

$extension_required_dom = new \AgriLife\Research\RequiredDOM();

$extension_asset = new \AgriLife\Research\Asset();

$extension_custom_fields = new \AgriLife\Research\CustomFields();

$extension_templates = new \AgriLife\Research\Templates();

$extension_widget_areas = new \AgriLife\Research\WidgetAreas();

add_action( 'agrilife_core_init', function() {
    $ext_landing_1_template = new \AgriLife\Core\PageTemplate();
    $ext_landing_1_template->with_path( AG_RESEARCH_TEMPLATE_PATH )->with_file( 'landing1' )->with_name( 'Landing Page 1' );
    $ext_landing_1_template->register();
});


// Add custom header support and options to Theme Customizer page in admin
add_action( 'plugins_loaded', 'agp_add_theme_support' );
function agp_add_theme_support(){

  add_theme_support( 'custom-header', array(
    'header-text' => true,
    'height' => 100,
    'width' => 340,
    'flex-height' => true,
    'flex-width' => true,
  ));

}

// Add class to identify header content configuration
add_filter( 'body_class', 'agp_body_class' );
function agp_body_class($classes = ''){

  if( empty( get_header_image() ) ){
    // No header image
    $classes[] = 'agp-header-noimage';
  } else {
    $classes[] = 'agp-header-image';
  }
  if( get_theme_mod( 'header_textcolor' ) == 'blank' ){
    // No header text
    $classes[] = 'agp-header-notitle';
  }
  if( defined( 'CHILD_THEME_NAME' ) ){
    $classes[] = strtolower( 'agp-header-' . str_replace( ' ', '-', CHILD_THEME_NAME ) );
  }

  return $classes;
}

// Replace Genesis function with modified version to suit our needs
add_action( 'init', 'agp_replace_genesis_custom_header_style', 99 );
function agp_replace_genesis_custom_header_style(){

  remove_action( 'wp_head', 'genesis_custom_header_style' );

}
