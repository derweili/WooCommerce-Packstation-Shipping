//(function(jQuery) {
	
	// jQuery Works! You can test it with next line if you like
	// console.log(jQuery);

    var sendToPackstationCheckbox = jQuery('#send_to_packstation'),
        sendToPackstation = false,
        packstationCustomerNumberWrapper = jQuery('#packstation_customer_number_field'),
        packstationCustomerNumber = jQuery('#packstation_customer_number'),
        packstationNumberWrapper = jQuery('#packstation_packstation_number_field');
        packstationNumber = jQuery('#packstation_packstation_number'),
        
        shippingZip = jQuery('#shipping_postcode'),
        shippingCity = jQuery('#shipping_city'),
        
        packstationFinderWrapper = jQuery('#packstation_finder_placeholder_field'),
        
        
        shippingAddress1FieldWrapper = jQuery('#shipping_address_1_field'),
        shippingAddress1Field = jQuery('#shipping_address_1'),
        
        shippingAddress2FieldWrapper = jQuery('#shipping_address_2_field'),
        shippingAddress2Field = jQuery('#shipping_address_2');

    /*
     * function to check if packstation checkbox is checked
     * show / hide fields
     */
    var sendToPackstationCheck = function() {
        
        if (jQuery(sendToPackstationCheckbox).is(':checked')) {
            sendToPackstation = true
            showPackstationFields();
            packstationClearAddressFields();


        }else{
            sendToPackstation = false;
            hidePackstationFields();
        }
        console.log('send to packstation check : ' + sendToPackstation);


    }

    var showPackstationFields = function() {
        jQuery(packstationCustomerNumberWrapper).removeClass('packstation-hidden');
        jQuery(packstationNumberWrapper).removeClass('packstation-hidden');
        jQuery(packstationFinderWrapper).removeClass('packstation-hidden');
        jQuery(packstationCustomerNumberWrapper).addClass('validate-required');
        jQuery(packstationNumberWrapper).addClass('validate-required');
        
        jQuery(shippingAddress1FieldWrapper).addClass('packstation-hidden');
        jQuery(shippingAddress2FieldWrapper).addClass('packstation-hidden');
    };


    var hidePackstationFields = function() {
        jQuery(packstationCustomerNumberWrapper).addClass('packstation-hidden');
        jQuery(packstationNumberWrapper).addClass('packstation-hidden');
        jQuery(packstationFinderWrapper).addClass('packstation-hidden');
        jQuery(packstationCustomerNumberWrapper).removeClass('validate-required');
        jQuery(packstationNumberWrapper).removeClass('validate-required');

        jQuery(shippingAddress1FieldWrapper).removeClass('packstation-hidden');
        jQuery(shippingAddress2FieldWrapper).removeClass('packstation-hidden');
    };


    var syncPackstationFields = function(){

        var packstationCustomerNumberValue = jQuery(packstationCustomerNumber).val();
        if( packstationCustomerNumberValue ) {
            jQuery(shippingAddress1Field).val( packstationCustomerNumberValue );
        }else{
            jQuery(shippingAddress1Field).val( '' );
        }
        var packstationNumberValue = jQuery(packstationNumber).val();
        if( packstationNumberValue ) {
            jQuery(shippingAddress2Field).val( 'Packstation ' + packstationNumberValue );
        }else{
            jQuery(shippingAddress2Field).val( '' );
        }

    }

    var packstationClearAddressFields = function() {
        jQuery(shippingAddress1Field).val( '' );
        jQuery(shippingAddress2Field).val( '' );
    }


    sendToPackstationCheck();

    // checkbox status change
    jQuery(sendToPackstationCheckbox).change(sendToPackstationCheck);

    // number changes
    jQuery(packstationCustomerNumber).change(syncPackstationFields);
    jQuery(packstationNumber).change(syncPackstationFields);






	
//})( jQuery );