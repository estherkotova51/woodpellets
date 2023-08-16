$(document).ready( function(){
	$('#notifications').load('extrabox/notifications/notifications.php');
	refresh();

	// Notifications added code
	setInterval(function(){ $(".custom-social-proof").stop().slideToggle('slow'); }, 10000);
	$(".custom-close").click(function() {
	  $(".custom-social-proof").stop().slideToggle('slow');
	});

});

function refresh()
{
	setTimeout( function() {
	$('#notifications').fadeOut('slow').load('extrabox/notifications/notifications.php').fadeIn('slow');
	refresh();
	}, 15000);
}