<?php


function packstation_shipping_method_form_fields($defaults){
    /*echo "defaults";
    var_dump($defaults);
    echo "form fields";
    var_dump($instance_form_fields);
    echo '<hr>';*/
    $defaults['packstation'] = array(
				'title'       => __( 'Packstation', 'woocommerce' ),
				'type'        => 'checkbox',
				'placeholder' => wc_format_localized_price( 0 ),
				'description' => __( 'Users will need to spend this amount to get free shipping (if enabled above).', 'woocommerce' ),
				'default'     => '0',
				'desc_tip'    => true,
                'label' => __('Versand an Packstationen für diese Versandart deaktivieren', 'packstation'),
			);
    return $defaults;
}


add_action('admin_init', 'packstation_admin_init_test');

function packstation_admin_init_test() {
    $shipping_methods = WC()->shipping->get_shipping_methods();

    foreach ($shipping_methods as $id => $shipping_method) {
       add_filter('woocommerce_shipping_instance_form_fields_' . $id, 'packstation_shipping_method_form_fields', 10, 1);
    }

 
}


function derweili_packstation_hide_shipping_if_for_packstation_if_not_available_for_packstation( $rates ) {
	$free = array();

    //var_dump($_POST);
    $shippingAddress = $_POST["s_address"];
    if( strpos($shippingAddress, 'Pack station') !== false || strpos($shippingAddress, 'Packstation') !== false ){
        
        foreach ( $rates as $rate_id => $rate ) {
            
            $shippingMethodTitle = explode(":", $rate_id);
            //echo 'woocommerce_' . $shippingMethodTitle[0] . '_' . $shippingMethodTitle[1] . '_settings';
            $shippingMethodOptions = get_option( 'woocommerce_' . $shippingMethodTitle[0] . '_' . $shippingMethodTitle[1] . '_settings', false );
            //$shippingMethodOptions = unserialize($shippingMethodOptions);
            $disablePackstation = $shippingMethodOptions['packstation'];
            if( 'yes' == $disablePackstation ){
               unset($rates[$rate_id]);
            }
            //$free[ $rate_id ] = $rate;

        }
    }

    return $rates;
}
add_filter( 'woocommerce_package_rates', 'derweili_packstation_hide_shipping_if_for_packstation_if_not_available_for_packstation', 100 );