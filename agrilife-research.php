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

//$ext_widget_areas = new \AgriLife\Research\WidgetAreas();
/*
if ( class_exists( 'Acf' ) ) {
    // Add new ACF json load point
    add_filter('acf/settings/load_json', 'extension_acf_json_load_point');
} else {
    add_action( 'admin_notices', 'agrilife_acf_notice' );
}

function extension_acf_json_load_point( $paths ) {
    $paths[] =  AG_COL_DIR_PATH . 'fields' ;
    return $paths;
}
*/
