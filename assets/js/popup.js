//(function(jQuery) {

var packstationFinderTrigger = jQuery('#packstation-finder');
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

jQuery(packstationFinderAddressInput).change(function(){

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


});

var setPackstationNumber = function(number){
    jQuery(packstationNumber).val(number);
    syncPackstationFields();
    tooglePackstationFinderPopup();
}

jQuery("#packstation-finder-results").on("click", ".set-packstation-button", function(){
    console.log('click');
    console.log(this);
    var packstationNumber = jQuery(this).data('packstationnumber');
    console.log(packstationNumber);
    setPackstationNumber(packstationNumber);
});






//})( jQuery );