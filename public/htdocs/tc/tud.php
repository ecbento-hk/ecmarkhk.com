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
<link rel="stylesheet" href="../css/hdd.css">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i" rel="stylesheet">


</head>
<body>

<?php


if (isset($_GET['rn'])){
	$rn = $_GET['rn'];
	$sfhd = $conn->prepare("SELECT * FROM `ba_programmes_topup` WHERE RegNo = :regNo ");
	$sfhd->bindValue(':regNo', xss_chk($rn), PDO::PARAM_STR);
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
						<img src="../images/topupDegree.jpg" />
					</div>
				
				
				</div>
				
				<div class="col container mainBodyContainer">
					<div class="bodyTitle" >
					學士學位銜接課程
					</div>
					<div class="bodyBreadcrumbs" >
					主頁 > 入讀學科  >  學士學位銜接課程  >  <?php echo xss_chk($row['RegNo']); ?> - <?php 
						if ($row['Programme_Name_TC'] != "" && $row['Programme_Name_TC'] != null){
							echo xss_chk($row['Programme_Name_TC']);
						}else{
							echo xss_chk($row['Programme_Name_EN']);
						}
					?>
					</div>
					
					<div class="bodyContext">
						<div class="bodyContextMain col-sm-8" >
							<div class="mainTitle red" >
								<?php echo xss_chk($row['RegNo']); ?>
							</div>
							
							<div class="mainTitle" >
								<?php 
									if ($row['Programme_Name_TC'] != "" && $row['Programme_Name_TC'] != null){
										echo xss_chk($row['Programme_Name_TC']);
									}else{
										echo xss_chk($row['Programme_Name_EN']);
									}
								?>
							</div>
							
							<div class="mainTitle grey" >
								<?php 
									if ($row['Programme_University_TC'] != "" && $row['Programme_University_TC'] != null){
										echo xss_chk($row['Programme_University_TC']);
									}else{
										echo xss_chk($row['Programme_University_EN']);
									}
								?>
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
								大學概覽
							</div>
							
							<?php 
								if ($row['Programme_University_Overview_TC'] != "" && $row['Programme_University_Overview_TC'] != null){
									echo (nl2br(no2ol(xss_chk($row['Programme_University_Overview_TC'])))); 
								}else{
									echo (nl2br(no2ol(xss_chk($row['Programme_University_Overview_EN'])))); 
								}
							?>
							
							<?php
							if ($row['Programme_Overview_TC'] != '' && $row['Programme_Overview_TC'] != null){
							?>
							<div class="mainSubTitle">
								課程概覽
							</div>
							<?php
								echo nl2br(no2ol(xss_chk($row['Programme_Overview_TC'])));
							}else{
								if ($row['Programme_Overview_EN'] != '' && $row['Programme_Overview_EN'] != null){
									?>
									<div class="mainSubTitle">
										課程概覽
									</div>
									<?php
									echo nl2br(no2ol(xss_chk($row['Programme_Overview_EN'])));
								}
							}
							?>
							
							
							
							<?php
							if ($row['Programme_Structure_TC'] != '' && $row['Programme_Structure_TC'] != null){
							?>
							<div class="mainSubTitle">
								課程架構
							</div>
							<?php
								echo nl2br(no2ol(xss_chk($row['Programme_Structure_TC'])));
							}else{
								if ($row['Programme_Structure_EN'] != '' && $row['Programme_Structure_EN'] != null){
									?>
									<div class="mainSubTitle">
										課程架構
									</div>
									<?php
									echo nl2br(no2ol(xss_chk($row['Programme_Structure_EN'])));
								}
							}
							?>
							
							<?php
							if ($row['Module_TC'] != '' && $row['Module_TC'] != null){
							?>
							<div class="mainSubTitle">
								單元
							</div>
							<?php
								echo nl2br(no2ol(xss_chk($row['Module_TC'])));
							}else{
								if ($row['Module_EN'] != '' && $row['Module_EN'] != null){
									?>
									<div class="mainSubTitle">
										單元
									</div>
									<?php
									echo nl2br(no2ol(xss_chk($row['Module_EN'])));
								}
							}
							?>
							
							
							<?php
							if ($row['Assessment'] != '' && $row['Assessment'] != null){
							?>
							<div class="mainSubTitle">
								評定
							</div>
							<?php
								echo nl2br(no2ol(xss_chk($row['Assessment'])));
							}
							?>
							
							<!--<table> 
								<tr><th>Institution</th><th>Programmes</th></tr>
								<tr><td><?php echo xss_chk($row['Articulation2_TC']); ?></td><td><?php echo xss_chk($row['Articulation_TC']); ?></td></tr>
							</table>
								-->
						</div>
						
						<div class="bodyContextSides col-sm-4">
							<div class="sideLinkBox" >
								<a target="_blank" href="<?php 
								if ($row['Hyperlink_TC']!= "" && $row['Hyperlink_TC'] != null){
								echo xss_chk($row['Hyperlink_TC']); 
								}else{
									echo xss_chk($row['Hyperlink_EN']);
								}
								?>">
									一般入學要求
								</a>
							</div>
							
							<div class="sideLinkBox type4" >
								<a target="_blank" href="<?php echo xss_chk($row['Download_URL']); ?>">
									下載宣傳冊
								</a>
							</div>
							
							<div class="sideBox" >
								<div class="sideBoxTitle">
									課程資訊
								</div>
								<div class="sideBoxSubTitle">
									註冊編號
								</div>
								<?php echo xss_chk($row['RegNo']); ?>
								
								<?php
									if ($row['Mode_TC'] != '' && $row['Mode_TC'] != null){
								?>
								<div class="sideBoxSubTitle">
									學習方式
								</div>
								<?php echo xss_chk($row['Mode_TC']); 
									}else{
										if ($row['Mode_EN'] != '' && $row['Mode_EN'] != null){
										?>
										<div class="sideBoxSubTitle">
											學習方式
										</div>
										<?php
										echo xss_chk($row['Mode_EN']); 
										}
									}
								?>
								
								<?php
									if ($row['Duration'] != '' && $row['Duration'] != null){
								?>
								<div class="sideBoxSubTitle">
									修讀時間
								</div>
								<?php echo xss_chk($row['Duration']); 
									}
								?>
								
								<?php
									if ($row['Study_Location_TC'] != '' && $row['Study_Location_TC'] != null){
								?>
								<div class="sideBoxSubTitle">
									學習地點
								</div>
								<?php echo xss_chk($row['Study_Location_TC']); 
									}else{
										if ($row['Study_Location_EN'] != '' && $row['Study_Location_EN'] != null){
											?>
											<div class="sideBoxSubTitle">
												學習地點
											</div>
											<?php
											echo xss_chk($row['Study_Location_EN']); 
										}
										
									}
								?>
								
								<?php
									if ($row['Commencement'] != '' && $row['Commencement'] != null){
								?>
								<div class="sideBoxSubTitle">
									畢業典禮
								</div>
								<?php echo xss_chk($row['Commencement']); 
									}
								?>
								
							</div>
							
							<div class="sideBox" >
								<div class="sideBoxTitle">
									費用
								</div>
								<?php
									if ($row['Fee_TC'] != '' && $row['Fee_TC'] != null){
								?>
								
								<?php echo nl2br(xss_filter($row['Fee_TC'])); 
									}else{
										if ($row['Fee_EN'] != '' && $row['Fee_EN'] != null){
											echo nl2br(xss_filter($row['Fee_EN'])); 
										}
									}
								?>
								
								<?php
									if ($row['Remark1'] != '' && $row['Remark1'] != null){
								?>
								<span class="noticed">
									<?php echo nl2br(xss_chk($row['Remark1'])); ?>
									<br>
									<a target="_blank" href="http://www.shape.edu.hk/admission_page.php?id=692346">Click here</a> for details.
								</span>
								<?php
									}
								?>
							</div>
							
							<div class="sideBox type1" >
								<div class="sideBoxTitle">
									資格框架
								</div>
								<div class="sideBoxSubTitle">
									QR註冊號碼
								</div>
								<?php echo xss_chk($row['QR_RegNo']); ?>
								
								<?php
									if ($row['QF_Level_TC'] != '' && $row['QF_Level_TC'] != null){
								?>
								<div class="sideBoxSubTitle">
									資歷級別
								</div>
								<?php echo xss_chk($row['QF_Level_TC']); 
									}else{
										if ($row['QF_Level_EN'] != '' && $row['QF_Level_EN'] != null){
											?>
											<div class="sideBoxSubTitle">
												資歷級別
											</div>
											<?php
											echo xss_chk($row['QF_Level_EN']); 
										}
									}
								?>
								
								<?php
									if ($row['Validity_Period'] != '' && $row['Validity_Period'] != null){
								?>
								<div class="sideBoxSubTitle">
									有效期
								</div>
								<?php echo xss_chk($row['Validity_Period']); 
									}
								?>
								
								
							</div>
							<?php echo xss_chk($row['Remark2']); ?>
						</div>
					</div>
					<div class="bodyContextAdditional col-sm-12" >
						
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

