(function($) {
	
	// $ Works! You can test it with next line if you like
	// console.log($);

    var sendToPackstationCheckbox = $('#send_to_packstation'),
        sendToPackstation = false,
        packstationCustomerNumberWrapper = $('#packstation_customer_number_field'),
        packstationCustomerNumber = $('#packstation_customer_number'),
        packstationNumberWrapper = $('#packstation_packstation_number_field');
        packstationNumber = $('#packstation_packstation_number'),
        
        
        shippingAddress1FieldWrapper = $('#shipping_address_1_field'),
        shippingAddress1Field = $('#shipping_address_1'),
        
        shippingAddress2FieldWrapper = $('#shipping_address_2_field'),
        shippingAddress2Field = $('#shipping_address_2');

    /*
     * function to check if packstation checkbox is checked
     * show / hide fields
     */
    var sendToPackstationCheck = function() {
        
        if ($(sendToPackstationCheckbox).is(':checked')) {
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
        $(packstationCustomerNumberWrapper).removeClass('packstation-hidden');
        $(packstationNumberWrapper).removeClass('packstation-hidden');
        $(packstationCustomerNumberWrapper).addClass('validate-required');
        $(packstationNumberWrapper).addClass('validate-required');
        
        $(shippingAddress1FieldWrapper).addClass('packstation-hidden');
        $(shippingAddress2FieldWrapper).addClass('packstation-hidden');
    };


    var hidePackstationFields = function() {
        $(packstationCustomerNumberWrapper).addClass('packstation-hidden');
        $(packstationNumberWrapper).addClass('packstation-hidden');
        $(packstationCustomerNumberWrapper).removeClass('validate-required');
        $(packstationNumberWrapper).removeClass('validate-required');

        $(shippingAddress1FieldWrapper).removeClass('packstation-hidden');
        $(shippingAddress2FieldWrapper).removeClass('packstation-hidden');
    };


    var syncPackstationFields = function(){

        var packstationCustomerNumberValue = $(packstationCustomerNumber).val();
        if( packstationCustomerNumberValue ) {
            $(shippingAddress1Field).val( packstationCustomerNumberValue );
        }else{
            $(shippingAddress1Field).val( '' );
        }
        var packstationNumberValue = $(packstationNumber).val();
        if( packstationNumberValue ) {
            $(shippingAddress2Field).val( 'Packstation ' + packstationNumberValue );
        }else{
            $(shippingAddress2Field).val( '' );
        }

    }

    var packstationClearAddressFields = function() {
        $(shippingAddress1Field).val( '' );
        $(shippingAddress2Field).val( '' );
    }


    sendToPackstationCheck();

    // checkbox status change
    $(sendToPackstationCheckbox).change(sendToPackstationCheck);

    // number changes
    $(packstationCustomerNumber).change(syncPackstationFields);
    $(packstationNumber).change(syncPackstationFields);

	
})( jQuery );