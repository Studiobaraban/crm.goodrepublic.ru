$(document).ready(function() {
	$('nav li a').each(function(){
		$(this).click(function(event){
			event.preventDefault();
			var itemId = $(this).attr('href');
			$(this).addClass('active');
			$('html,body').stop().animate({ scrollTop: $(itemId).offset().top }, 1000);
			event.preventDefault();
		});
	});
	
});
jQuery(document).ready(function(){
	$objWindow = $(window);
	$('section[data-type="background"]').each(function(){
		var $bgObj = $(this);
		$(window).scroll(function() {
			var yPos = -($objWindow.scrollTop() / $bgObj.data('speed'));
			var coords = '50% '+ yPos + 'px';
			$bgObj.css({ backgroundPosition: coords });
		});
	});
});