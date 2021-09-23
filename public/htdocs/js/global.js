var config_mobile = false;
$(document).ready(function(){
	if ($(window).width() < 768){
		config_mobile = true;
	}else{
		config_mobile = false;
	}
	title_Height();
	 $(window).resize(function() {
		 if ($(window).width() < 768){
			config_mobile = true;
		}else{
			config_mobile = false;
		}
       title_Height();
    });
	
	
	//image slide controllers
	if ($('.imageSlide').length>0){
		if ($('.imageSlide img').length > 1){
			
			$('.imageSlide img:first').addClass("active").fadeIn(500);
			
			//$('.imageSlide img:not(:first)').addClass("notactive");
			
			
			var $imgs = $(".imageSlide").find("img"),
				i = 0;

			function changeImage(){
				var next = (++i % $imgs.length);
				//$($imgs.get(next - 1)).fadeOut(500);
				//$($imgs.get(next)).fadeIn(500);
				$($imgs.get(next - 1)).removeClass("active").fadeOut(0);
				$($imgs.get(next)).addClass("active").fadeIn(500);
			}
			var interval = setInterval(changeImage, 5000);
			
		}else if ($('.imageSlide img').length == 1){
			$('.imageSlide img:first').addClass("active").fadeIn(500);
		}
			
	}
	
	if ( $('.mainTitle').length > 0){
		var maintitle = $('.mainTitle').text().trim();
		if (maintitle == ""){
			$('.mainTitle').css('display', 'none');
		}
		
	}
});

function title_Height(){
	if (config_mobile){
		var titleHeight = $('.bodyTitle').height();
		var heightCss = "-" + titleHeight + "px";
		$('.bodyTitle').css("margin-top",  heightCss);
	}else{
		$('.bodyTitle').css("margin-top",  "auto");
	}
}

function resizeBox(){
	let linesDefault = 3;
	if ($(window).width() <= 480){
		$('.programmeItemContent').css({'-webkit-line-clamp': `${linesDefault}`});
		$('.programmeItem').each(function(){
			let imgH = $(this).find('.programmeItemImg').height();
			let contentH = $(this).find('.programmeItemContent').height();
			$(this).find('.programmeItemContent').css('margin-top', `${imgH}px`);
			let tarH = 60 + contentH; 
			$(this).find('.programmeItemImg').css('bottom', tarH);
		});
		
	}else{
		$('.programmeItemContent').css('margin-top', 'inherit');
		$('.programmeItemDetails').each(function(){
			let boxH = $(this).height();
			let titleH = $(this).find('.programmeItemTitle').height();
			let subTitleH = $(this).find('.programmeItemSubTitle').height();
			let contentH = $(this).find('.programmeItemContent').height();
			let btnH = 50;
			let linesDefault = 3;
			let spaceH = (boxH - titleH - subTitleH - btnH);
			if (spaceH < contentH){
				let lines = Math.round(spaceH / 20);
				$(this).find('.programmeItemContent').css({'-webkit-line-clamp': `${lines}`});
			}else{
				$(this).find('.programmeItemContent').css({'-webkit-line-clamp': `${linesDefault}`});
			}
		});
	}
	
}