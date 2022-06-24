<?php
/**
 * Main Loader.
 *
 * @package dynamic_discount_plugin
 */

if ( ! defined( 'ABSPATH' ) ) 
{
	exit;
}

if ( ! class_exists( 'SA_Loader' ) ) 
{
	/** Class SA_Loader. */

	class DDP_Loader 
    {
        /** Constructor. */

		public function __construct() 
        {
            $this->includes();
            add_action( 'admin_enqueue_scripts', array( $this, 'ddp_scripts'));
        }

		/** Include Files depend on platform. */
        
		public function includes() 
        {
            include_once 'class-ddp-metabox.php';
		}

        /** Include Scripts. */

        public function ddp_scripts() 
        {
            wp_enqueue_script('manual_js',  plugin_dir_url( __DIR__ ). 'assets/js/manual.js',   array('jquery') , wp_rand() );
            wp_localize_script('manual_js', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ));
        }
    }
}

new DDP_Loader();