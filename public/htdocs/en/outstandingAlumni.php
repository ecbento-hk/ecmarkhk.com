<?php
require_once('../conn/db.php');
header("Content-Type: text/html;charset=utf-8");   

$type_id = 19;
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
	
});



</script>
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/main.css?v=20190817"><link href="https://fonts.googleapis.com/css?family=Noto+Sans+SC|Noto+Sans+TC&display=swap" rel="stylesheet">

<link rel="stylesheet" href="../plugin/jquery-ui-1.12.1/jquery-ui.min.css">
<link rel="stylesheet" href="../css/alumni.css">
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
						<img src="../images/alumni_OutstandingAlumni.jpg" />
					</div>
				
				
				</div>
				
				<div class="col container mainBodyContainer">
					<div class="bodyTitle" >
					Graduate Success Stories
					</div>
					<div class="bodyBreadcrumbs" >
					<a href="index.php">Home</a> > Business > Graduate Success Stories > Outstanding Alumni
					</div>
					
					<div class="bodyContext">
						<div class="bodyContextMain col-sm-12" >
							
							<div class="row" >
								<div class="col-sm-12 " >
									<div class="mainTitle" >
									Outstanding Alumni
									</div>
									
									<p>
									To get inspired with words of advice from graduate success stories, learn about the interesting journeys of IVE Business graduates.
									</p>
									
									<div class="outstandingAlumniList">
										<div class="outstandingAlumniListItem">
											<div class="outstandingAlumniListItemContext">
												<div class="outstandingAlumniListItemImg">
													<img src="../images/alumni_OutstandingAlumni2.jpg" />
													<div class="outstandingAlumniListItemImgBottomText">
													01
													</div>
												</div>
												<div class="outstandingAlumniListItemContent">
													<div class="outstandingAlumniListItemContentName">
													KWOK Ka Hin, Terry
													</div>
													<div class="outstandingAlumniListItemContentTitle">
													Sales Advisor
													<br>
													Alibaba.com Hong Kong Limited
													</div>
													<div class="outstandingAlumniListItemContentProgramme">
													HD in Marketing
													<span>
													(Formerly known as HD in Sales and Marketing)
													</span>
													</div>
													<div class="outstandingAlumniListItemContentDetails">
													Graduated in 2008
													</div>
												</div>
											</div>
										</div>
										
										<div class="outstandingAlumniListItem">
											<div class="outstandingAlumniListItemContext">
												<div class="outstandingAlumniListItemImg">
													<img src="../images/alumni_OutstandingAlumni3.jpg" />
													<div class="outstandingAlumniListItemImgBottomText">
													02
													</div>
												</div>
												<div class="outstandingAlumniListItemContent">
													<div class="outstandingAlumniListItemContentName">
													LEUNG Chi Yung, Kris
													</div>
													<div class="outstandingAlumniListItemContentTitle">
													Associate Director
													<br>
													Vigers Asia Property Ltd
													</div>
													<div class="outstandingAlumniListItemContentProgramme">
													HD in Business Administration
													
													</div>
													<div class="outstandingAlumniListItemContentDetails">
													Graduated in 2004
													</div>
												</div>
											</div>
										</div>
										
										<div class="outstandingAlumniListItem">
											<div class="outstandingAlumniListItemContext">
												<div class="outstandingAlumniListItemImg">
													<img src="../images/alumni_OutstandingAlumni4.jpg" />
													<div class="outstandingAlumniListItemImgBottomText">
													03
													</div>
												</div>
												<div class="outstandingAlumniListItemContent">
													<div class="outstandingAlumniListItemContentName">
													LEUNG Chung Yan
													</div>
													<div class="outstandingAlumniListItemContentTitle">
													Operation Manager (Loans Division, Bank-wide Operation Department)
													<br>
													Bank of China (Hong Kong) Limited
													</div>
													<div class="outstandingAlumniListItemContentProgramme">
													HD in Business Administration
													
													</div>
													<div class="outstandingAlumniListItemContentDetails">
													Graduated in 2009
													</div>
												</div>
											</div>
										</div>
										
										<div class="outstandingAlumniListItem">
											<div class="outstandingAlumniListItemContext">
												<div class="outstandingAlumniListItemImg">
													<img src="../images/alumni_OutstandingAlumni5.jpg" />
													<div class="outstandingAlumniListItemImgBottomText">
													04
													</div>
												</div>
												<div class="outstandingAlumniListItemContent">
													<div class="outstandingAlumniListItemContentName">
													LIU Kwan Chun, Andrew
													</div>
													<div class="outstandingAlumniListItemContentTitle">
													Business Manager
	(Hong Kong & Macau)
													<br>
													Chow Sang Sang Jewellery Company Limited
													</div>
													<div class="outstandingAlumniListItemContentProgramme">
													HD in International Business Management with Languages
													<span>
													(Formerly known as HD in International Business)
													</span>
													</div>
													<div class="outstandingAlumniListItemContentDetails">
													Graduated in 2008
													</div>
												</div>
											</div>
										</div>
										
										<div class="outstandingAlumniListItem">
											<div class="outstandingAlumniListItemContext">
												<div class="outstandingAlumniListItemImg">
													<img src="../images/alumni_OutstandingAlumni6.jpg" />
													<div class="outstandingAlumniListItemImgBottomText">
													05
													</div>
												</div>
												<div class="outstandingAlumniListItemContent">
													<div class="outstandingAlumniListItemContentName">
													SUEN Man Luen
													</div>
													<div class="outstandingAlumniListItemContentTitle">
													Tax Consultant
													<br>
													Deloitte Touche Tohmatsu
													</div>
													<div class="outstandingAlumniListItemContentProgramme">
													HD in Accountancy
													
													</div>
													<div class="outstandingAlumniListItemContentDetails">
													Graduated in 2013
													</div>
												</div>
											</div>
										</div>
										
										<div class="outstandingAlumniListItem">
											<div class="outstandingAlumniListItemContext">
												<div class="outstandingAlumniListItemImg">
													<img src="../images/alumni_OutstandingAlumni7.jpg" />
													<div class="outstandingAlumniListItemImgBottomText">
													06
													</div>
												</div>
												<div class="outstandingAlumniListItemContent">
													<div class="outstandingAlumniListItemContentName">
													Tsang Kin Yung, Ken
													</div>
													<div class="outstandingAlumniListItemContentTitle">
													Group Product Manager
													<br>
													International Cosmetics Company
													</div>
													<div class="outstandingAlumniListItemContentProgramme">
													HD in Business Administration
													<span>
													(Formerly known as HD in Sales and Marketing)
													</span>
													</div>
													<div class="outstandingAlumniListItemContentDetails">
													Graduated in 2007
													</div>
												</div>
											</div>
										</div>
										
										<div class="outstandingAlumniListItem">
											<div class="outstandingAlumniListItemContext">
												<div class="outstandingAlumniListItemImg">
													<img src="../images/alumni_OutstandingAlumni8.jpg" />
													<div class="outstandingAlumniListItemImgBottomText">
													07
													</div>
												</div>
												<div class="outstandingAlumniListItemContent">
													<div class="outstandingAlumniListItemContentName">
													Ricky WONG
													</div>
													<div class="outstandingAlumniListItemContentTitle">
													Head of E-Commerce
													<br>
													Computime Ltd
													</div>
													<div class="outstandingAlumniListItemContentProgramme">
													HD in Marketing
													<span>
													(Formerly known as HD in Sales and Marketing)
													</span>
													</div>
													<div class="outstandingAlumniListItemContentDetails">
													Graduated in 2003
													</div>
												</div>
											</div>
										</div>
									
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

