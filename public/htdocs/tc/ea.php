<?php
//require_once('conn/db.php');
header("Content-Type: text/html;charset=utf-8");   
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
	
});



</script>
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/main.css?v=20190817"><link href="https://fonts.googleapis.com/css?family=Noto+Sans+SC|Noto+Sans+TC&display=swap" rel="stylesheet">

<link rel="stylesheet" href="../plugin/jquery-ui-1.12.1/jquery-ui.min.css">
<link rel="stylesheet" href="../css/studyativebusiness.css">
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

	<div class="row">
		<div class="mainContent">
			<div class="row">
				<div class="col mainBg">
					<div class="imageSlide">
						<img src="../images/study_at_IVE_BusinessAccommodation.jpg" />
					</div>
				
				
				</div>
				
				<div class="col container mainBodyContainer">
					<div class="bodyTitle" >
					入讀商業學科
					</div>
					<div class="bodyBreadcrumbs" >
					<a href="index.php">主頁</a> > 入讀學科 > 入讀商業學科 > Accommodation
					</div>
					
					<div class="bodyContext">
						<div class="bodyContextMain col-sm-12" >
							
							<div class="row" >
								<div class="col-sm-12 shortCourse" >
									<div class="mainTitle" >
									Accommodation
									</div>
									
									<p>
									There are two student residential halls in VTC which are located in Pokfulam Road, Hong Kong Island and Tsing Yi Island, New Territories. The Tsing Yi hall was opened in 2016. The halls provide around 1000 residence places for Full-time students of Degree programmes and Higher Diploma programmes. Hall life provides opportunities for students to learn and grow together through the cross cultural environment, as well as enriches their study life and adds value to their whole person development.
									</p>
									
									<div class="programmeFacilitiesList">
										<table>
											<tr>
												<td><img src="../images/study_at_IVE_BusinessAccommodation2.jpg" /></td>
												<td><img src="../images/study_at_IVE_BusinessAccommodation3.jpg" /></td>
												<td class="programmeFacilitiesListItem type1 textleft">
													<div  >
														VTC Halls of Residence<br>
														Tsing Yi
													</div>
												</td>
											</tr>
											<tr>
												<td colspan="2"><img src="../images/study_at_IVE_BusinessAccommodation4.jpg" /></td>
												<td><img src="../images/study_at_IVE_BusinessAccommodation5.jpg" /></td>
											</tr>
											<tr>
												<td class="programmeFacilitiesListItem type6 textright">
													<div  >
														VTC Halls of Residence<br>
														Pokfulam
													</div>
												</td>
												<td colspan="2"><img src="../images/study_at_IVE_BusinessAccommodation6.jpg" /></td>
											</tr>
											<tr>
												<td><img src="../images/study_at_IVE_BusinessAccommodation7.jpg" /></td>
												<td><img src="../images/study_at_IVE_BusinessAccommodation8.jpg" /></td>
												<td><img src="../images/study_at_IVE_BusinessAccommodation9.jpg" /></td>
											</tr>
											
										</table>
									</div>
									
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

