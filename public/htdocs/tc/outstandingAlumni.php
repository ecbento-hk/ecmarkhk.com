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
						校友分享
					</div>
					<div class="bodyBreadcrumbs" >
					<a href="index.php">主頁</a> > 企業發展 > 校友分享 > Outstanding Alumni
					</div>
					
					<div class="bodyContext">
						<div class="bodyContextMain col-sm-12" >
							
							<div class="row" >
								<div class="col-sm-12 " >
									<div class="mainTitle" >
									Outstanding Alumni
									</div>
									
									<p>
									校友的分享帶出他們的學習經歷和挑戰，從他們的成功故事中獲得更多啟發。
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
														郭嘉顯
													</div>
													<div class="outstandingAlumniListItemContentTitle">
														銷售專家
													<br>
														阿里巴巴香港有限公司
													</div>
													<div class="outstandingAlumniListItemContentProgramme">
														市場管理學高級文憑
													<span>
													（前稱銷售及市場學高級文憑）
													</span>
													</div>
													<div class="outstandingAlumniListItemContentDetails">
													2008畢業
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
														梁智勇
													</div>
													<div class="outstandingAlumniListItemContentTitle">
														聯席董事 – 企業傳訊及客戶關係
													<br>
													Vigers Asia Property Ltd
													</div>
													<div class="outstandingAlumniListItemContentProgramme">
														商業高級文憑
													
													</div>
													<div class="outstandingAlumniListItemContentDetails">
													 2004畢業
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
														梁頌恩
													</div>
													<div class="outstandingAlumniListItemContentTitle">
														業務合規經理（企業信貸管理中心）
													<br>
														中國銀行（香港）有限公司
													</div>
													<div class="outstandingAlumniListItemContentProgramme">
														商業高級文憑
													
													</div>
													<div class="outstandingAlumniListItemContentDetails">
													 2009畢業
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
														廖君進
													</div>
													<div class="outstandingAlumniListItemContentTitle">
														港澳區業務經理
													<br>
														周生生珠寶金行有限公司
													</div>
													<div class="outstandingAlumniListItemContentProgramme">
														國際商業管理及語言高級文憑
													<span>
													（前稱國際商貿高級文憑）
													</span>
													</div>
													<div class="outstandingAlumniListItemContentDetails">
													2008畢業
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
														孫文鑾
													</div>
													<div class="outstandingAlumniListItemContentTitle">
														稅務顧問
													<br>
														德勤諮詢（香港）有限公司
													</div>
													<div class="outstandingAlumniListItemContentProgramme">
														會計學高級文憑
													
													</div>
													<div class="outstandingAlumniListItemContentDetails">
													2013畢業
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
														曾健榕
													</div>
													<div class="outstandingAlumniListItemContentTitle">
														品牌產品經理
													<br>
														跨國美妝品公司
													</div>
													<div class="outstandingAlumniListItemContentProgramme">
														商業高級文憑
													</div>
													<div class="outstandingAlumniListItemContentDetails">
													2007畢業
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
														黃偉基
													</div>
													<div class="outstandingAlumniListItemContentTitle">
													Head of E-Commerce
													<br>
													Computime Ltd
													</div>
													<div class="outstandingAlumniListItemContentProgramme">
														市場管理學高級文憑
													<span>
													（前稱銷售及市場學高級文憑）
													</span>
													</div>
													<div class="outstandingAlumniListItemContentDetails">
													2003畢業
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

