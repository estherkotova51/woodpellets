
// image Slider Loader start here
	$('#sliderTop').cycle({
		fx: 	'scrollHorz',
		next: 	'#nextTop',
		prev: 	'#prevTop',
		timeout: 	1000,
		pause: 		1
	});

	$('#sliderTop2').cycle({
		fx: 	'scrollHorz',
		next: 	'#nextTop2',
		prev: 	'#prevTop2',
		timeout: 	3000,
		pause: 		1
	});

// image Slider Loader end here


$(document).ready(function(){

	var path = window.location.pathname.split("/").pop();

	if ( path == '') {
		path = 'index.php';
	}
	var target = $('div ul li a[href="'+path+'"]');
	target.addClass('active');

	
	var pathCustomer = window.location.pathname.split("/").pop();

	if ( pathCustomer == '') {
		pathCustomer = 'myaccountDetails?view_properties';
	}
	var targetCustomer = $('div ul a[href="'+pathCustomer+'"]');
	targetCustomer.addClass('active');


	$('.sugImg img').hover(function() {
		$('.view').stop().animate({height : '100%'}, 300);
	}, function(){
		$('.view').stop().animate({height : '0%'}, 300);
	});

	


	$('#form').submit(function() {
		var abort = false;
		$("span.error").remove();
		$(':input[required]').each(function() {
			if ($(this).val()==='') {
				$(this).after('<span class="glyphicon glyphicon-remove form-control-feedback error"></span>');
				abort = true;
			}
		}); // go through each required value
		if (abort) { return false; } else { return true; }
	})//on submit
		
	$('input[pattern]').blur(function() {
	$("span.error").remove();
	var myPattern = $(this).attr('pattern');
	var myPlaceholder = $(this).attr('placeholder');
	var isValid = $(this).val().search(myPattern) >= 0;


	if (!isValid) {
		$(this).focus();
		$(this).after('<span class="glyphicon glyphicon-remove form-control-feedback error"></span>');
	} // isValid test

	if (isValid) {
		$(this).before('<span class="glyphicon glyphicon-ok form-control-feedback correct"></span>');

	} // isValid test
}); // onblur




//Jquery time 
//jQuery time for product submission form
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active1");
	
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'transform': 'scale('+scale+')'});
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active1");
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * (0))+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$("#input_field2").focus(function(){
	$(this).css({
		'width' : '130px',
		'transition': 'all 0.7s ease-in-out 0.5s'
	});
			
});

$("#input_field2").blur(function(){
	$(this).css({
		'width' : '70px',
		'transition': 'all 0.7s ease-in-out 0.5s'
	});
			
});

$("#input_field3").focus(function(){
	$(this).css({
		'width' : '70%',
		'transition': 'all 0.7s ease-in-out 0.5s'
	});
			
});

$("#input_field3").blur(function(){
	$(this).css({
		'width' : '70px',
		'transition': 'all 0.7s ease-in-out 0.5s'
	});
			
});




}); 


