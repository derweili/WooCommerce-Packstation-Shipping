<?php

// Hook in
add_filter( 'woocommerce_checkout_fields' , 'packstation_add_fields' );

// Our hooked in function - $address_fields is passed via the filter!
function packstation_add_fields( $fields ) {

    /**
    * Loop through all products and check if packstation is disabled
    */
    /*foreach( WC()->cart->get_cart() as $cart_item ){

        if( empty( $cart_item["variation_id"] ) ){
            // if single product use single product id for packstation check
            $product_id = $cart_item['product_id'];
            $disable_packstation = get_post_meta( $product_id, '_disable_packstation', true );
        }else{
            // if variable product use variable product id for packstation check
            $product_id = $cart_item['variation_id'];
            $disable_packstation = get_post_meta( $product_id, '_disable_packstation', true );
        }

        if($disable_packstation == 'yes') return $fields;
    }*/

    if ( false == derweili_packstation_is_packstation_available() ) return $fields;

    /*
     * Add Checkbox
     */
    $send_to_packstation_element = array(
        'type' => 'checkbox',
        'class' => array(''),
        'label' => __('An <i class="packstation-label"><span>Packstation</span></i> senden ', 'packstation'),
        //'placeholder' => _x('Notes about your order, e.g. special notes for delivery.', 'placeholder', 'woocommerce')
    );

    $fields['shipping'] = add_array_element_before_index($fields['shipping'], $send_to_packstation_element, 'send_to_packstation', 2 );

    // Add customer number
    $packstation_finder_placeholder = array(
        'type' => 'text',
        'class' => array('packstation-hidden' ),
        'label' => __('<a id="packstation-finder" class="button"><i class="fa fa-location-arrow" aria-hidden="true"></i> Packstation finden</a>', 'packstation'),
        //'required' => true
        //'placeholder' => _x('Notes about your order, e.g. special notes for delivery.', 'placeholder', 'woocommerce')
    );
    $fields['shipping'] = add_array_element_before_index($fields['shipping'], $packstation_finder_placeholder, 'packstation_finder_placeholder', 3 );


    // Add customer number
    $packstation_customer_number = array(
        'type' => 'number',
        'class' => array('col4-set', 'form-row-first', 'packstation-hidden'),
        'label' => __('Postnummer', 'packstation'),
        //'required' => true
        //'placeholder' => _x('Notes about your order, e.g. special notes for delivery.', 'placeholder', 'woocommerce')
    );
    $fields['shipping'] = add_array_element_before_index($fields['shipping'], $packstation_customer_number, 'packstation_customer_number', 4 );

    // Add customer number
    $packstation_packstation_number = array(
        'type' => 'number',
        'class' => array('col4-set', 'form-row-last', 'packstation-hidden'),
        'label' => __('Packstation Nummer', 'packstation'),
        //'required' => true,
        'clear' => true,
        //'placeholder' => _x('Notes about your order, e.g. special notes for delivery.', 'placeholder', 'woocommerce')
    );
    $fields['shipping'] = add_array_element_before_index($fields['shipping'], $packstation_packstation_number, 'packstation_packstation_number', 5 );



    return $fields;

}




/**
 * Process the checkout
 */
add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');

function my_custom_checkout_field_process() {
    // Check if set, if its not set add an error.
    if ( isset ( $_POST['send_to_packstation'] ) && 1 == $_POST['send_to_packstation'] ){

        if ( ! isset ( $_POST['packstation_customer_number'] ) || empty( $_POST['packstation_customer_number'] ) )
            wc_add_notice( __( '<strong>Postnummer: </strong> Bitte gib deine Postnummer ein' ), 'error' );
        if ( ! isset ( $_POST['packstation_packstation_number'] ) || empty( $_POST['packstation_packstation_number'] ) )
            wc_add_notice( __( '<strong>Packstation Nummer: </strong> Bitte gib eine Packstation Nummer ein oder wähle eine Packstation über die Packstation Suche aus.' ), 'error' );

        if ( isset ( $_POST['shipping_country'] ) && 'DE' != $_POST['shipping_country'] )
            wc_add_notice( __( '<strong>Packstation: </strong> Der Versand an Packstationen kann nur innerhalb Deutschlands erfolgen. Bitte wähle eine andere Adresse oder anderes Land.' ), 'error' );

    }
        
}





function add_array_element_before_index( $array, $new_element, $new_key, $index ) {

    $new_array = array();

    $x = 0;
    foreach ($array as $key => $value) {
        
        if( $index == $x ){
            $new_array[$new_key] = $new_element;
        }
        $new_array[$key] = $value;

        $x++;
    }

    return $new_array;

}