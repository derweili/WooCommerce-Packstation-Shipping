//(function(jQuery) {

var packstationFinderTrigger = jQuery('#packstation-finder');
var packstationFinderForm = jQuery('#packstation-finder-address');
var packstationFinderPopup = jQuery('#derweili-packstation-popup');
var packstationFinderPopupBg = jQuery('#derweili-packstation-popup-bg');


var tooglePackstationFinderPopup = function() {
    jQuery(packstationFinderPopup).toggleClass('visible')
    jQuery(packstationFinderPopupBg).toggleClass('visible');
}

jQuery(packstationFinderTrigger).click(function(event){
    event.preventDefault();
    console.log('trigger');
    tooglePackstationFinderPopup();
});

jQuery(packstationFinderPopupBg).click(function(event){
    tooglePackstationFinderPopup();
});



var packstationFinderAddressInput = jQuery('#packstation-finder-address-input');
var packstationFinderResultsWrapper = jQuery('#packstation-finder-results');

var setPackstationButtons = jQuery('.set-packstation-button');

var triggerAjaxSearch = function(){

    jQuery(packstationFinderResultsWrapper).html('<div class="loader-wrapper"><div class="loader"><i class="fa fa-spinner" aria-hidden="true"></i></div></div>');

    var packstationZipCode = jQuery(packstationFinderAddressInput).val();

    var data = {
        'action': 'packstation_finder',
        'zip': packstationZipCode
    };

    // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
    jQuery.post(ajaxurl, data, function(response) {
        console.log(response);
        var obj = jQuery.parseJSON( response );
        jQuery(packstationFinderResultsWrapper).html(obj.code);

        setPackstationButtons = jQuery('.set-packstation-button');
        console.log(setPackstationButtons);
    });


};

jQuery(packstationFinderAddressInput).change(triggerAjaxSearch);
jQuery(packstationFinderForm).submit(function( event ) {
  event.preventDefault();
  triggerAjaxSearch();
});


var setPackstationNumber = function(number, zip, city){
    jQuery(packstationNumber).val(number);
    jQuery(shippingZip).val(zip);
    jQuery(shippingCity).val(city);
    syncPackstationFields();
    tooglePackstationFinderPopup();
}

jQuery("#packstation-finder-results").on("click", ".set-packstation-button", function(){
    console.log('click');
    console.log(this);
    var packstationNumber = jQuery(this).data('packstationnumber');
    var packstationZip = jQuery(this).data('zip');
    var packstationCity = jQuery(this).data('city');
    console.log(packstationNumber);
    setPackstationNumber(packstationNumber,packstationZip, packstationCity);
    jQuery( 'body' ).trigger( 'update_checkout' );
});






//})( jQuery );