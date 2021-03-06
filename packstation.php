<?php

/*
Plugin Name: Packstation
Description: DHL Packstation Support for WooCommerce
Version: 1.4
Author: derweili
Text Domain: packstation
Domain Path: /languages/
*/


/**
* Packstation Plugin Class
*/
class Packstation_Plugin
{
	
	/**
	* Load dependencies
	* Load init functions
	*/

	function __construct()
	{

		add_action( 'init', array(&$this, 'load_textdomain' ) );

		
		define('PACKSTATION_DIR_URI', plugin_dir_url( __FILE__ ) );

		$this->load_other_dependencies();

		$this->enqueue_scripts();


	}




	private function load_other_dependencies(){

		include "inc/additional-fields.php";
		include "inc/popup.php";
		include "inc/packstation-finder.php";
		include "inc/packstation-product-field.php";
		include "inc/packstation-shipping-method-fields.php";
		include "inc/packstation-availability-check.php";
		include "inc/packstation-payment-method-admin.php";
		//include "inc/additional-fields.php";

	}

	public function load_textdomain() {

		load_plugin_textdomain( 'packstation', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 

	}

	public function enqueue_scripts() {
		add_action( 'wp_enqueue_scripts', function(){
    		//wp_register_script('packstation-conditional-fields', plugins_url('assets/js/conditional-fields.js', __FILE__), array('jquery'));
            wp_enqueue_script( 'packstation-conditional-fields', plugins_url('assets/js/conditional-fields.js', __FILE__), array('jquery'), '1.0.0', true );
            wp_enqueue_script( 'popup', plugins_url('assets/js/popup.js', __FILE__), array('jquery'), '1.0.0', true );
            wp_enqueue_script( 'init-load', plugins_url('assets/js/initial-load.js', __FILE__), array('jquery'), '1.0.0', true );
            
			wp_enqueue_style( 'packstation-style', plugins_url('assets/css/packstation.css', __FILE__), array(), '1.0.0', 'all' );
			wp_enqueue_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css', array(), '4.7.0', 'all' );
		} );

	}


}


new Packstation_Plugin();