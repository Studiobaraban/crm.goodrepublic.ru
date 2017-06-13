$(document).ready(function(){



	$( ".videoblock" ).click(function() {
		$( ".video" ).fadeIn(0).animate({top: '25%', opacity: '1'}, 1000);
		$( ".overlay" ).fadeIn(1000); 
	});

	$( ".a_pop" ).click(function() {
		$( ".popup1" ).fadeIn(0).animate({top: '15%', opacity: '1'}, 1000);
		$( ".overlay" ).fadeIn(1000); 
	});

	$( ".a_pop2" ).click(function() {
		$( ".popup2" ).fadeIn(0).animate({top: '15%', opacity: '1'}, 1000);
		$( ".overlay" ).fadeIn(1000); 
	});

	$( ".fclose, .overlay" ).click(function() {
		$( ".popup1" ).animate({top: '-450px', opacity: '0'}, 1000);
		$( ".popup2" ).animate({top: '-450px', opacity: '0'}, 1000);
		$( ".video" ).animate({top: '-450px', opacity: '0'}, 1000);
		$( ".overlay" ).fadeOut(1000);
	});








	$('.anim').css({'transform': 'rotateY(0deg)', opacity: '1'}); // вращение плашек


	$('.logo2').delay(500).animate({opacity: '1'}, 1000); // 1 заголовок
	$('.logo').delay(1000).animate({marginTop: '150px'}, 1000); //
	$('.topmenu').delay(2000).animate({marginTop: '0px', opacity: '1'}, 1000); //
	$('.topfon h1').delay(1000).animate({marginTop: '+=50px', opacity: '1'}, 1000); //
	$('.topfon h2').delay(1000).animate({marginTop: '+=50px', opacity: '1'}, 1000); //
	$('.topfon h3').delay(1500).animate({marginTop: '+=10px', opacity: '1'}, 1000); //
	$('.topfon .top_btn').delay(2000).animate({marginTop: '+=10px', opacity: '1'}, 1000); //
	$('.topfon p.tac').delay(1750).animate({marginTop: '+=10px', opacity: '1'}, 1000); //
	$('.formone input').delay(2000).animate({marginTop: '+=10px', opacity: '1'}, 1000); //
	$('.lite_line').delay(1000).animate({marginTop: '+=70px', opacity: '1'}, 1000); //
	$('.go').delay(1500).animate({opacity: '1'}, 1000); // 



	$( ".fclose" ).click(function() {
		$( "#messageok" ).animate({top: '-=50px', opacity: '0'}, 1000); //
	});

    $('.goto, .menu').click(function(){
    	var idscroll = $(this).attr('href');//получаем значение атрибута href
    	$.scrollTo(idscroll, 1000);// перематываем до блока(1000 - это длительность 1 сек.)
    	return false;
    });//end click

	$( ".showother" ).click(function() {
		$( ".other" ).slideToggle(1000); //
	});



	$('#formone').submit(function(e){
		var error= false;
		var txt = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!txt.test($('#mail').val())){
			$('#mail').css('border','red solid 1px');
			error = true;
		}

		/*if ($('#phone').lenght < 7){
			$('#phone').css('border','red solid 1px');
			error = true;
		}*/

		$('#formone input[type=text]').each(function(index, element) {
            if($(element).length==0){
				$(element).css('border','red solid 1px');
				error = true;
			}
        });

		if(error) return false;

		var m_data=$("#connect").serialize();
		$.ajax({
			type: 'POST',
			url: 'send.php',
			data: m_data,
			success: function(result){
				$('#message').html(result);
				$('#message').fadeIn(500);
				setTimeout (function(){
					$('#message').fadeOut(500);
				}, 3000)
			}
		});
		return false;
	});


});