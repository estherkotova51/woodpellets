(function($){
	"use strict";
	// jQuery(document).on('ready', function () {
/* --------------------------------------------------------
  payment-accordion
* -------------------------------------------------------*/ 
  $(".payment-accordion").collapse({
    accordion:true,
    open: function() {
    this.slideDown(550);
    },
    close: function() {
    this.slideUp(550);
    }		
  });

}(jQuery));