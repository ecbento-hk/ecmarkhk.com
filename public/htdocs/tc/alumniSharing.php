<?php
require_once('../conn/db.php');
header("Content-Type: text/html;charset=utf-8");   

$type_id = 31;
$query_websitecontent = "SELECT * FROM ba_page_content where ID=:ID";
$websitecontent = $conn->prepare($query_websitecontent);
$websitecontent -> bindParam(':ID', $type_id, PDO::PARAM_STR);
$websitecontent->execute();
$totalRows_websitecontent = $websitecontent -> rowCount();
$row_websitecontent = $websitecontent -> fetch(PDO::FETCH_ASSOC);
if ($totalRows_websitecontent != 0){
	$title_en = $row_websitecontent['Page_Title_EN'];
	$content_en = $row_websitecontent['Page_Content_EN'];
	$title_tc = $row_websitecontent['Page_Title_TC'];
	$content_tc = $row_websitecontent['Page_Content_TC'];
	$title_sc = $row_websitecontent['Page_Title_SC'];
	$content_sc = $row_websitecontent['Page_Content_SC'];
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>BA VTC</title>
<link href="../images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

	  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/solid.css" integrity="sha384-osqezT+30O6N/vsMqwW8Ch6wKlMofqueuia2H7fePy42uC05rm1G+BUPSd2iBSJL" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/fontawesome.css" integrity="sha384-BzCy2fixOYd0HObpx3GMefNqdbA7Qjcc91RgYeDjrHTIEXqiF00jKvgQG0+zY/7I" crossorigin="anonymous">




<script src="../js/jquery-3.3.1.js" ></script>
<script src="../plugin/jquery-ui-1.12.1/jquery-ui.min.js" ></script>

<script src="../js/bootstrap.min.js"></script><script src="../js/global.js"></script>
<script>
$(document).ready(function(){
	$('.nav.navbar-nav a').click(function(){
		
		$('.nav.navbar-nav a').each(function(){
			$(this).removeClass("active");
		});
		
		let menu_select = $(this).data('menu');
		$(this).addClass( "active" );
		
		if ($('#' + menu_select).hasClass("active")){
			$('#' + menu_select).removeClass("active");

		}else{		
			$('.menuDetails').each(function(){
				$(this).removeClass("active");
			});
			$('#' + menu_select).addClass("active");
		}
	});
	
	$('#mobileMenu').click(function(){
		if ($('body').hasClass('openNav')){
			$('body').removeClass('openNav');
		}else{
			$('body').addClass('openNav');
		}
	});
	$('#closebtn').click(function(){
		if ($('body').hasClass('openNav')){
			$('body').removeClass('openNav');
		}
	});
	
	
	//add sub icon
	
	$('.menu-item').each(function(){
		if ($(this).find('.menu-item').length>1){
			$(this).addClass('has_sub');
		}
		
	});
	
	
	$('.menu-item a').click(function(){
		if ($(this).parent().find('.menu-item').length>0){
			
			
			
			if ($(this).parent().hasClass('open')){
				$(this).parent().removeClass('open');
			}else{
				
				$(this).parent().parent().children(".menu-item").each(function(){
					$(this).removeClass('open');
					$(this).find(".menu-item").each(function(){
						$(this).removeClass('open');
					});
				});
				
				
				
				$(this).parent().addClass('open');
			
			}
		}
	});
	
	$('.translate a, .mobileTranslate a').click(function(e){
		e.preventDefault();
		var loc = encodeURI(window.location.href.toLowerCase());
		var lang = $(this).data("lang");
		var targetLoc = loc.replace(/(\/)(en|tc|sc)(\/)/ig,'/' + lang + '/');
		window.location = lang ? targetLoc : this.href;
	});
	
	$('.alumniSharingSlider').bxSlider({
		slideWidth: 400,
		minSlides: 1,
		maxSlides: 3
	  });
	  
	var $owl = $('.owl-carousel');
	  $owl.on('initialized.owl.carousel', function(event){
			$('.businessCommentDetails .businessCommentItemDetails').css('display','block');
		});
	  $owl.children().each( function( index ) {
		  $(this).attr( 'data-position', index );
		});
	var owl = $('.owl-carousel').owlCarousel({
   center: true,
    items:3,
    loop:true,
    margin:10,
    responsive:{
        600:{
            items:5
        }
    }
});

$(document).on('click', '.owl-item>div', function() {
  owl.trigger('to.owl.carousel', $(this).data( 'position' ) ); 
});

owl.on('changed.owl.carousel', function(event) {
   setTimeout(function(){  
	   var comment = $('.owl-item.active.center .businessCommentItemDetailsComment').html();
	   var name = $('.owl-item.active.center .businessCommentItemDetailsName').html();
	   var program = $('.owl-item.active.center .businessCommentItemDetailsProgram').html();
	   
	   $('.businessCommentDetails').find('.businessCommentItemDetailsComment').html(comment);
	   $('.businessCommentDetails').find('.businessCommentItemDetailsProgram').html(program);
	   $('.businessCommentDetails').find('.businessCommentItemDetailsName').html(name);
	   
   }, 500); 
   
})
	
	
	
    $('.translate a, .mobileTranslate a').click(function(e){
		e.preventDefault();
		var loc = encodeURI(window.location.href.toLowerCase());
		var lang = $(this).data("lang");
		var targetLoc = loc.replace(/(\/)(en|tc|sc)(\/)/ig,'/' + lang + '/');
		window.location = lang ? targetLoc : this.href;
	});
	
});



</script>
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/main.css?v=20190817"><link href="https://fonts.googleapis.com/css?family=Noto+Sans+SC|Noto+Sans+TC&display=swap" rel="stylesheet">

<link rel="stylesheet" href="../plugin/jquery-ui-1.12.1/jquery-ui.min.css">
<link rel="stylesheet" href="../css/alumni.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

  

<link rel="stylesheet" href="../plugin/OwlCarousel2/docs/assets/owlcarousel/assets/owl.carousel.min.css">
<link rel="stylesheet" href="../plugin/OwlCarousel2/docs/assets/owlcarousel/assets/owl.theme.default.min.css">
  <script src="../plugin/OwlCarousel2/docs/assets/owlcarousel/owl.carousel.min.js"></script>

  
</head>
<body>

<?php
require_once("menu_mobile.php");
?>

<div id="main">
<?php
require_once("header.php");
?>
<div class="container-fluid main">

	<div class="row">
		<div class="mainContent">
			<div class="row">
				<div class="col mainBg">
					<div class="imageSlide">
						<img src="../images/alumniSharing.jpg" />
					</div>
				
				
				</div>
				
				<div class="col container mainBodyContainer">
					<div class="bodyTitle" >
						校友
					</div>
					<div class="bodyBreadcrumbs" >
					<a href="index.php">主頁</a> > 企業發展 > 校友 > <?php echo xss_htmlpurifier($title_tc); ?>
					</div>
					
					<div class="bodyContext">
						<div class="bodyContextMain col-sm-12" >
							
							<div class="row" >
								<div class="col-sm-12 " >
									
									<?php
										echo xss_htmlpurifier($content_tc);
									?>
									
									
									
									
									
								</div>
								
							
								
						</div>
						
					</div>
				
				</div>
			</div>
		</div>
		
	
	</div>
</div>
<?php
require_once("footer.php");
?>


</div>


</body>
</html>

</body>
</html>

