<?php

// Display Fields
add_action( 'woocommerce_product_options_shipping', 'woo_add_custom_general_fields' );

// Save Fields
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );



function woo_add_custom_general_fields() {

  global $woocommerce, $post;
  echo '<div class="options_group">';
  
  // Custom fields will be created here...
    // Checkbox
    woocommerce_wp_checkbox( 
        array( 
            'id'            => '_disable_packstation', 
            'wrapper_class' => '', 
            'label'         => __('Packstation', 'woocommerce' ), 
            'description'   => __( 'Versand an Packstationen für dieses Produkt deaktivieren', 'woocommerce' ) 
        )
    );
  echo '</div>';
	
}

function woo_add_custom_general_fields_save( $post_id ){
		
	// Checkbox
	$woocommerce_checkbox = isset( $_POST['_disable_packstation'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, '_disable_packstation', $woocommerce_checkbox );
	
}


/**
 * Variation fields
 */


// Add Variation Settings
add_action( 'woocommerce_product_after_variable_attributes', 'variation_settings_fields', 1, 3 );
// Save Variation Settings
add_action( 'woocommerce_save_product_variation', 'save_variation_settings_fields', 10, 2 );


/**
 * Create new fields for variations
 *
*/
function variation_settings_fields( $loop, $variation_data, $variation ) {
	// Checkbox
	woocommerce_wp_checkbox( 
	array( 
		'id'            => '_disable_packstation[' . $variation->ID . ']', 
		'label'         => __('Packstation: ', 'woocommerce' ), 
		'description'   => __( 'Versand an Packstationen für dieses Produkt deaktivieren', 'woocommerce' ),
		'value'         => get_post_meta( $variation->ID, '_disable_packstation', true ), 
		)
	);
}
/**
 * Save new fields for variations
 *
*/
function save_variation_settings_fields( $post_id ) {

	// Checkbox
	$checkbox = isset( $_POST['_disable_packstation'][ $post_id ] ) ? 'yes' : 'no';
	update_post_meta( $post_id, '_disable_packstation', $checkbox );
	

}




function derweili_packstation_is_packstation_available() {
	/**
    * Loop through all products and check if packstation is disabled
    */
    foreach( WC()->cart->get_cart() as $cart_item ){
        /*echo '<pre>';
        var_dump($cart_item);*/
        if( empty( $cart_item["variation_id"] ) ){
            // if single product use single product id for packstation check
            $product_id = $cart_item['product_id'];
            $disable_packstation = get_post_meta( $product_id, '_disable_packstation', true );
        }else{
            // if variable product use variable product id for packstation check
            $product_id = $cart_item['variation_id'];
            $disable_packstation = get_post_meta( $product_id, '_disable_packstation', true );
        }

        if( $disable_packstation == 'yes' ){
			return false;
		}
    }
	return true;
}