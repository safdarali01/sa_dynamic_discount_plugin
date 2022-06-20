<?php
/**
 * Plugin Name: SADynamicDiscountPlugin
 * Description: Made for Safdar Ali.
 * Version: 1.0
 * Author: Safdar
 * Author URI: https://muhammadsafdarali.com/
 * Text Domain: sa-dynamic-discount-plugin
 */

if ( ! defined( 'ABSPATH' ) ) 
{
	exit;
}

if ( ! defined( 'DDP_PLUGIN_DIR' ) ) 
{
	define( 'DDP_PLUGIN_DIR', __DIR__ );
}

if ( ! defined( 'DDP_PLUGIN_DIR_URL' ) ) 
{
	define( 'DDP_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'DDP_ABSPATH' ) ) 
{
	define( 'DDP_ABSPATH', dirname( __FILE__ ) );
}
require DDP_PLUGIN_DIR . '/includes/class-ddp-loader.php';

?>