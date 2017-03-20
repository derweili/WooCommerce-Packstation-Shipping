<?php

add_action( 'wp_ajax_packstation_availability_check', 'derweili_packstation_availability_check' );
add_action( 'wp_ajax_nopriv_packstation_availability_check', 'derweili_packstation_availability_check' );

function derweili_packstation_availability_check() {
	global $wpdb; // this is how you get access to the database

    if ( false == derweili_packstation_is_packstation_available() ){
        $available = false;
    }else{
        $available = true;
    }
    
    $return = array(
        "available" => $available,
    );

    echo json_encode($return);


	wp_die(); 
}