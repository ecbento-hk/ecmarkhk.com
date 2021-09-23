<?php
require_once('../conn/db.php');
header("Content-Type: text/html;charset=utf-8"); 

function chkContArray($str, $arr){
	foreach ($arr as $url) {
		if (strpos($str, $url) !== FALSE) {
			return true;
		}
	}
	return false;
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
<link rel="stylesheet" href="../css/main.css?v=20190817"><link href="https://fonts.googleapis.com/css?family=Noto+Sans+SC|Noto+Sans+TC&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/fdd.css">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i" rel="stylesheet">


</head>
<body>

<?php


if (isset($_GET['pc'])){
	$pc = $_GET['pc'];
	$sfhd = $conn->prepare("SELECT * FROM `ba_programmes_dfs` WHERE Programme_Code = :programCode ");
	$sfhd->bindValue(':programCode', xss_chk($pc), PDO::PARAM_STR);
	$sfhd->execute();
	$totalRows = $sfhd -> rowCount();
	$row = $sfhd -> fetch(PDO::FETCH_ASSOC);
	
	if ($totalRows == 0){
		header("Location:index.php");
	}else{
		
		
		
		
		
		
		
	}
}else{
	header("Location:index.php");
}

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
						<img src="../images/bg1.jpg" />
					</div>
				
				
				</div>
				
				<div class="col container mainBodyContainer">
					<div class="bodyTitle" >
					Diploma of Foundation Studies
					</div>
					<div class="bodyBreadcrumbs" >
					Home Study  >  Higher Diploma  >  <?php echo xss_chk($row['Programme_Code']); ?> - <?php echo xss_chk($row['Programme_Title_EN']); ?>
					</div>
					
					<div class="bodyContext">
						<div class="bodyContextMain col-sm-8" >
							<div class="mainTitle red" >
								<?php echo xss_chk($row['Programme_Code']); ?>
							</div>
							
							<div class="mainTitle" >
								<?php echo xss_chk($row['Programme_Title_EN']); ?>
							</div>
							
							<?php
								$programmeImage = "../images/diplomaBg.jpg";
								if ($row['ImageURL'] != "" && $row['ImageURL'] !=null ){
									$programmeImage = xss_chk($row['ImageURL']);
									?>
									<img class="mainImage" src="<?php echo $programmeImage ?>">
									<?php
								}
							?>
							
							<div class="mainSubTitle">
								Programme Features
							</div>
							
							<?php echo xss_chk($row['Programme_Features_EN']); ?>
							
							<div class="mainSubTitle">
								Professional Core Modules
							</div>
								
							<?php echo nl2br(xss_chk($row['Professional_Core_Modules_EN'])); ?>
							
						</div>
						
						<div class="bodyContextSides col-sm-4">
							<div class="sideLinkBox" >
								<a href="http://www.vtc.edu.hk/admission/en/s6/application-information/degree-higher-diploma-foundation-diploma/general-entrance-requirements/">
									General Entrance Requirements
								</a>
							</div>
							<div class="sideLinkBox type2" >
								<a href="https://admission.vtc.edu.hk/vtcsas/faces/login.jspx?sysCode=VET">
									APPLY NOW!
								</a>
							</div>
							<div class="sideLinkBox type4" >
								<a href="../Downloads/BAprogrammeGuideAY21-22.pdf">
									DOWNLOAD BROCHURE
								</a>
							</div>
							<div class="sideBox" >
								<div class="sideBoxTitle">
									Programme Information
								</div>
								<div class="sideBoxSubTitle">
									Enquiry
								</div>
								
								
								Email: 
								<?php 
								
								$emaillist = xss_chk($row['Contact_Email_Tel']);
								preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $emaillist, $matches);
								foreach($matches[0] as $email){
									
									?>
									<a href="mailto:<?php echo xss_chk($email) . "123"; ?>"><?php echo xss_chk($email); ?></a>
									<?php
								}
								?>
								
								
								Enquiry Phone: <br>
								<?php 
								
								$phonelist = xss_chk($row['Contact_Email_Tel']);
								preg_match_all("/\s*\d{4}\s*-?\s*\d{4}/i", $phonelist, $phone_matches);
								$numItems = count($phone_matches);
								$i = 0;
								
								foreach($phone_matches[0] as $phone){
									
									
									 echo xss_chk($phone);
									 if(++$i === $numItems) {
										 
									 }else{
										 echo " / ";
									 }
									
								}
								?>
								
								<div class="sideBoxSubTitle">
									Programme Code
								</div>
								<?php echo xss_chk($row['Programme_Code']); ?>
								<div class="sideBoxSubTitle">
									Level
								</div>
								Full-time Higher Diploma
								
								
								<div class="sideBoxSubTitle">
									Offering Campus
								</div>								<ol>
								<?php
									$campus = explode(" ", xss_chk($row['Campuses']));
									
									foreach($campuses_info as $key=>$ci){
										if (chkContArray(xss_chk($row['Campuses']),[$key])){
											
											?>
											
											<li><a href="ourCampuses.php"><?php echo $ci[0]; ?></a></li>
											
											<?php
										}
									}
									
								?>
								</ol>

									
								
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

