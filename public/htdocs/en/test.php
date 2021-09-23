<?php
require_once('../conn/db.php');
header("Content-Type: text/html;charset=utf-8");
$type_id = 35;
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


$type_id = 36;
$slide_query_websitecontent = "SELECT * FROM ba_page_content where ID=:ID";
$slide_websitecontent = $conn->prepare($slide_query_websitecontent);
$slide_websitecontent -> bindParam(':ID', $type_id, PDO::PARAM_STR);
$slide_websitecontent->execute();
$slide_totalRows_websitecontent = $slide_websitecontent -> rowCount();
$slide_row_websitecontent = $slide_websitecontent -> fetch(PDO::FETCH_ASSOC);
if ($slide_totalRows_websitecontent != 0){
	$slide_title_en = $slide_row_websitecontent['Page_Title_EN'];
	$slide_content_en = $slide_row_websitecontent['Page_Content_EN'];
	$slide_title_tc = $slide_row_websitecontent['Page_Title_TC'];
	$slide_content_tc = $slide_row_websitecontent['Page_Content_TC'];
	$slide_title_sc = $slide_row_websitecontent['Page_Title_SC'];
	$slide_content_sc = $slide_row_websitecontent['Page_Content_SC'];
}

$type_id = 37;
$slideText_query_websitecontent = "SELECT * FROM ba_page_content where ID=:ID";
$slideText_websitecontent = $conn->prepare($slideText_query_websitecontent);
$slideText_websitecontent -> bindParam(':ID', $type_id, PDO::PARAM_STR);
$slideText_websitecontent->execute();
$slideText_totalRows_websitecontent = $slideText_websitecontent -> rowCount();
$slideText_row_websitecontent = $slideText_websitecontent -> fetch(PDO::FETCH_ASSOC);
if ($slideText_totalRows_websitecontent != 0){
	$slideText_title_en = $slideText_row_websitecontent['Page_Title_EN'];
	$slideText_content_en = $slideText_row_websitecontent['Page_Content_EN'];
	$slideText_title_tc = $slideText_row_websitecontent['Page_Title_TC'];
	$slideText_content_tc = $slideText_row_websitecontent['Page_Content_TC'];
	$slideText_title_sc = $slideText_row_websitecontent['Page_Title_SC'];
	$slideText_content_sc = $slideText_row_websitecontent['Page_Content_SC'];
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
	
});


/*
function openNav() {
    //document.getElementById("mySidenav").style.width = "350px";
	document.getElementById("mySidenav").style.marginLeft = "0px";
    document.getElementById("main").style.marginLeft = "350px";
	document.getElementById("main").style.marginRight = "-350px";
    
}
*/

/* Set the width of the side navigation to 0 */
/*
function closeNav() {
    //document.getElementById("mySidenav").style.width = "350px";
	document.getElementById("mySidenav").style.marginLeft = "-350px";
    document.getElementById("main").style.marginLeft = "0";
	document.getElementById("main").style.marginRight = "0";
    
}
*/

</script>
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/main.css?v=20200812"><link href="https://fonts.googleapis.com/css?family=Noto+Sans+SC|Noto+Sans+TC&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i" rel="stylesheet">


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
	<!-- Home Slide / Image -->
	<div class="row">
		<div class="container">
			<div class="row">
				<div class="col mainSlide">
					
					<div class="imageSlide">
						<?php
								echo xss_htmlpurifier($slide_content_en);
							?>
						<div class="imageSlideText">
							<?php
								echo xss_htmlpurifier($slideText_content_en);
							?>
						</div>
					</div>
					
					<div class="additionLink">
						<div class="additionLinkItem">
							<a href="../Downloads/Design Thinking Business Casebook 2020.pdf">
							DESIGN THINKING BUSINESS CASEBOOK
							</a>
						</div>
						<div class="additionLinkItem">
							<a href="../Downloads/BAprogrammeGuideAY21-22.pdf">
							Programme Information Guide
							</a>
						</div>
						<div class="additionLinkItem">
							<a target="_blank" href="https://admission.vtc.edu.hk/vtcsas/faces/login.jspx?sysCode=VET">
							Apply Now
							</a>
						</div>
						
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<?php
			echo xss_htmlpurifier($content_en);
		?>
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

