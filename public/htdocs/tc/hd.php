<?php
require_once('../conn/db.php');
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
	
    $( "#programme_tabs" ).tabs({
		activate: function( event, ui ) {
			resizeBox();
		}
	});
	$('.translate a, .mobileTranslate a').click(function(e){
		e.preventDefault();
		var loc = encodeURI(window.location.href.toLowerCase());
		var lang = $(this).data("lang");
		var targetLoc = loc.replace(/(\/)(en|tc|sc)(\/)/ig,'/' + lang + '/');
		window.location = lang ? targetLoc : this.href;
	});
	
	//additonal box handle
	$(window).on("load", function() {
		resizeBox();
	});
	function resizedw(){
		resizeBox();
	}
	var doit;
	window.onresize = function(){
	  clearTimeout(doit);
	  doit = setTimeout(resizedw, 100);
	};
	
});



</script>
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/main.css?v=20190817"><link href="https://fonts.googleapis.com/css?family=Noto+Sans+SC|Noto+Sans+TC&display=swap" rel="stylesheet">

<link rel="stylesheet" href="../plugin/jquery-ui-1.12.1/jquery-ui.min.css">
<link rel="stylesheet" href="../css/hd.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i" rel="stylesheet">


</head>
<body>

<?php

function chkContArray($str, $arr){
	foreach ($arr as $url) {
		if (strpos($str, $url) !== FALSE) {
			return true;
		}
	}
	return false;
}


require_once("menu_mobile.php");

$sfhd = $conn->prepare("SELECT * FROM `ba_programmes_hd` a LEFT JOIN ba_programmes_category b On a.`Programmes_Category_ID` = b.ID ORDER BY a.Programme_Code");
$sfhd->execute();
$rows = $sfhd->fetchAll(PDO::FETCH_ASSOC);
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
						<img src="../images/higherDiplomaProgramme.jpg" />
					</div>
				
				
				</div>
				
				<div class="col container mainBodyContainer">
					<div class="bodyTitle" >
					高級文憑
					</div>
					<div class="bodyBreadcrumbs" >
					<a href="index.php">主頁</a> > 入讀學科  >  高級文憑
					</div>
					
					<div class="bodyContext">
						<div class="bodyContextMain col-sm-12" >
							
							<!--<div class="mainTitle" >
							</div>
							<p>
							</p>
							-->
							
							<div class="programme_tabs" id="programme_tabs">
			  <ul>
				<li><a href="#category">課程類別</a></li>
				<li><a href="#location">上課地點</a></li>
				
			  </ul>
			  
			  <div id="category">
			  <div class="tab_intro">以課程類別排列</div>
				<?php
				$sfpc = $conn->prepare("SELECT * FROM ba_programmes_category");
				$sfpc->execute();
				$sfpc_rows = $sfpc->fetchAll(PDO::FETCH_ASSOC);
				
				
				
				foreach($sfpc_rows as $sfpc_row){
				?>
				<div class="programmeList" >
					<div class="programmeTitle" >
					<?php
						echo xss_chk($sfpc_row['Programme_Category_Name_TC']);
					?>
					</div>
					
					<?php
						foreach($rows as $row){
							if ($row['Programmes_Category_ID'] == $sfpc_row['ID']){
					?>
					
							<div class="programmeItem" >
								<div class="programmeItemImg">
									<img src="<?php echo xss_chk($row['ImageURL_s']) ?>" />
								</div>
								<div class="programmeItemDetails">
									<div class="programmeItemTitle">
										<?php echo xss_chk($row['Programme_Code']); ?> <span class="programmeItemCampus"> <span class="programmeItemCampusSymbol">|</span> <?php 
										$campusArr = nl2arr(xss_chk($row['Offering_Campus'])); 
										
										$campus = "";
										foreach ($campusArr as &$cam) {
											$campus = $campus . "<span>" . $cam . "</span>";
										}
										echo $campus;
										?></span>
									</div>
									<div class="programmeItemSubTitle">
										<?php echo xss_chk($row['Programme_Name_TC']);
										?>
									</div>
									<div class="programmeItemContent">
										<?php echo xss_chk($row['Programme_Features_TC']);
										?>
									</div>
									<div class="programmeItemButton">
										<a href="hdd.php?pc=<?php echo xss_chk($row['Programme_Code']); ?>">更多詳情</a>
									</div>
								</div>
							</div>
					<?php
							}
						}
					?>
					
				</div>
				<?php
				}
				
				?>
			  </div>
			  <div id="location">
			  <div class="tab_intro">以地區排列</div>
				<div class="programmeList" >
					<?php 
					
					foreach($location_type as $key=>$lt){
						?>
						<div class="programmeTitle" >
							<?php echo $location_type_name[$key][0]; ?>
						</div>
						<?php
						foreach($rows as $row){
							
							if (chkContArray($row['Offering_Campus'],$lt)){
						?>
							<div class="programmeItem" >
								<div class="programmeItemImg">
									<img src="<?php echo xss_chk($row['ImageURL_s']) ?>" />
								</div>
								<div class="programmeItemDetails">
									<div class="programmeItemTitle">
										<?php echo xss_chk($row['Programme_Code']); ?> <span class="programmeItemCampus"> <span class="programmeItemCampusSymbol">|</span>
										
										<?php 
										$campusArr = nl2arr(xss_chk($row['Offering_Campus'])); 
										
										$campus = "";
										foreach ($campusArr as &$cam) {
											$campus = $campus . "<span>" . $cam . "</span>";
										}
										echo $campus;
										?>
									</div>
									<div class="programmeItemSubTitle">
										<?php echo xss_chk($row['Programme_Name_TC']); ?>
									</div>
									<div class="programmeItemContent">
										<?php echo xss_chk($row['Programme_Features_TC']); ?>
									</div>
									<div class="programmeItemButton">
										<a href="hdd.php?pc=<?php echo xss_chk($row['Programme_Code']); ?>">更多詳情</a>
									</div>
								</div>
							</div>
						<?php
							}
						}
						?>
						
						<?php
					}
					?>
						
					

					
					
					
					
				</div>
				
			  </div>
			  
			</div>
								
						</div>
						<div class="bodyContextAdditional col-sm-12">
							<div class="additionalAddress">
								<?php
								
									foreach ($location_type as $key => $value) {
										?>
										<div class="additionalAddressList">
										<div class="additionalAddressTitle">
											<?php echo $location_type_name[$key][0]; ?>
										</div>
										<div class="additionalAddressContent">
											<table>
											<?php
												foreach($value as $value2){
											?>
											<tr><td><?php echo $value2; ?></td><td>
											<?php 
											echo $campuses_info[$value2][2];
											?></td></tr>
											<?php
												}
											?>
											</table>
										</div>
										
										</div>
										<?php
									}
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

