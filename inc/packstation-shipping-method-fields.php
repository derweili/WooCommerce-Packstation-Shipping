<?php

//add_filter('woocommerce_shipping_instance_form_fields_');
add_filter('woocommerce_shipping_instance_form_fields_free_shipping', 'packstation_shipping_method_form_fields', 10, 1);

function packstation_shipping_method_form_fields($defaults){
    /*echo "defaults";
    var_dump($defaults);
    echo "form fields";
    var_dump($instance_form_fields);
    echo '<hr>';*/
    $defaults['max_amount'] = array(
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