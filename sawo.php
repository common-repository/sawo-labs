<?php
/*
Plugin Name: SAWO Passwordless Authentication
Plugin URI: https://sawolabs.com/
Description: Checks the health of your WordPress install (sawo.php desc)
Version: 3.0.0
Author: sawolabs
*/
define( 'SAWO_API_HOST', 'https://api.sawolabs.com/api/v1' );
// Exit if accessed directly
if(!defined('ABSPATH')){
    exit;
  }

// Load Scripts
require_once(plugin_dir_path(__FILE__).'/sawo_add.php');
require_once(plugin_dir_path(__FILE__).'/includes/sawo-scripts.php');

include_once(ABSPATH . 'wp-includes/pluggable.php');


// Load Class
require_once(plugin_dir_path(__FILE__).'/includes/sawo-class.php');


// Register Widget
function register_sawo(){
    register_widget('SAWO_Widget');
}

// Hook in function
add_action('widgets_init', 'register_sawo');

add_action( 'rest_api_init', function() {
  register_rest_route( 'sawo/v1', '/user', [
    'methods'             => 'GET',
    'callback'            => 'get_user_existence',
    'permission_callback' => '__return_true',
  ] );
} );

// Load function
require_once(plugin_dir_path(__FILE__).'/get_cust.php');
