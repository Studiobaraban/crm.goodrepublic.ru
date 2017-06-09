jQuery(document).ready(function(){

	// Popups
	$('.js_buy').click(function(){
		var myscrollpop = $(window).scrollTop();
		$('.popup.buy').animate({'top': myscrollpop + 100, 'opacity': 1}, 500);
		$('.overlay').fadeIn();
	});

	$('.js_end').click(function(){
		var myscrollpop = $(window).scrollTop();
		$('.popup.end').animate({'top': myscrollpop + 100, 'opacity': 1}, 500);
		$('.overlay').fadeIn();
	});

	$('.overlay, .clo').click(function(){
		$('.popup').animate({'top': - 1000, 'opacity': 0}, 500);
		$('.overlay').fadeOut();
		$('.search_result').fadeOut(); // прячем результат поиска
		$(".form_lite").css({'zIndex': 1000});
	});



	$(function(){
		$('.blocks').css({'minHeight':($('.blocks').width()+30)}); 

		$(window).resize(function(){
			$('.blocks').css({'minHeight':($('.blocks').width()+30)}); 
		});
	});


	$('.stacktable').stacktable();


});