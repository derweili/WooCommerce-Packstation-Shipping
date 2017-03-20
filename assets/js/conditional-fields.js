//(function(jQuery) {
	
	// jQuery Works! You can test it with next line if you like
	// console.log(jQuery);

    var sendToPackstationCheckbox = jQuery('#send_to_packstation'),
        sendToPackstation = false,
        packstationCustomerNumberWrapper = jQuery('#packstation_customer_number_field'),
        packstationCustomerNumber = jQuery('#packstation_customer_number'),
        packstationNumberWrapper = jQuery('#packstation_packstation_number_field'),
        packstationNumber = jQuery('#packstation_packstation_number'),
        
        packstationPackstationFieldWrappers = jQuery('#packstation_customer_number_field, #packstation_packstation_number_field, #packstation_finder_placeholder_field'),
        packstationStandardAddressFieldWrappers = jQuery('#shipping_company_field, #shipping_address_1_field, #shipping_address_2_field' ),

        shippingZip = jQuery('#shipping_postcode'),
        shippingCity = jQuery('#shipping_city'),        
        shippingCompany = jQuery('#shipping_company'),        
        
        shippingAddress1Field = jQuery('#shipping_address_1'),
        
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
        // hide/show fields
        jQuery(packstationPackstationFieldWrappers).removeClass('packstation-hidden');
        jQuery(packstationStandardAddressFieldWrappers).addClass('packstation-hidden');

        // add requirements
        jQuery(packstationCustomerNumberWrapper).addClass('validate-required');
        jQuery(packstationNumberWrapper).addClass('validate-required');
        
    };


    var hidePackstationFields = function() {
        // hide/show fields
        jQuery(packstationPackstationFieldWrappers).addClass('packstation-hidden');
        jQuery(packstationStandardAddressFieldWrappers).removeClass('packstation-hidden');

        //remove requirements
        jQuery(packstationCustomerNumberWrapper).removeClass('validate-required');
        jQuery(packstationNumberWrapper).removeClass('validate-required');
    };


    /*
     * Function to copy packstation fields content to standard address fields
     */
    var syncPackstationFields = function(){

        var packstationCustomerNumberValue = jQuery(packstationCustomerNumber).val();

        if( packstationCustomerNumberValue ) {
            jQuery(shippingCompany).val( packstationCustomerNumberValue );
        }else{
            jQuery(shippingCompany).val( '' );
        }
        var packstationNumberValue = jQuery(packstationNumber).val();
        if( packstationNumberValue ) {
            jQuery(shippingAddress1Field).val( 'Pack station ' + packstationNumberValue );
        }else{
            jQuery(shippingAddress1Field).val( '' );
        }

    }

    var packstationClearAddressFields = function() {
        jQuery(shippingAddress1Field).val( '' );
        jQuery(shippingCompany).val( '' );
    }


    sendToPackstationCheck();

    // checkbox status change
    jQuery(sendToPackstationCheckbox).change(sendToPackstationCheck);

    // number changes
    jQuery(packstationCustomerNumber).change(syncPackstationFields);
    jQuery(packstationNumber).change(syncPackstationFields);






	
//})( jQuery );