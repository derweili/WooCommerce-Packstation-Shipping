<?php

// Hook in
add_filter( 'woocommerce_checkout_fields' , 'packstation_add_fields' );

// Our hooked in function - $address_fields is passed via the filter!
function packstation_add_fields( $fields ) {

    /*
     * Add Checkbox
     */
    $send_to_packstation_element = array(
        'type' => 'checkbox',
        'class' => array('number'),
        'label' => __('An Packstation senden', 'packstation'),
        //'placeholder' => _x('Notes about your order, e.g. special notes for delivery.', 'placeholder', 'woocommerce')
    );

    $fields['shipping'] = add_array_element_before_index($fields['shipping'], $send_to_packstation_element, 'send_to_packstation', 3 );

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
        'class' => array('col2-set', 'form-row-last', 'packstation-hidden'),
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
            wc_add_notice( __( '<strong>Packstation customer number: </strong> Please enter the Packstation customer number' ), 'error' );
        if ( ! isset ( $_POST['packstation_packstation_number'] ) || empty( $_POST['packstation_packstation_number'] ) )
            wc_add_notice( __( '<strong>Packstation number: </strong> Please enter the Packstation number' ), 'error' );

        if ( isset ( $_POST['shipping_country'] ) && 'DE' != $_POST['shipping_country'] )
            wc_add_notice( __( '<strong>Packstation: </strong> You can use Packstation only in Germany. Please select a differnt country or change your address.' ), 'error' );

        

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