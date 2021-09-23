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


if (isset($_GET['pc'])){
	$pc = $_GET['pc'];
	$sfhd = $conn->prepare("SELECT * FROM `ba_programmes_hd` WHERE Programme_Code = :programCode ");
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
					高级文凭
					</div>
					<div class="bodyBreadcrumbs" >
					<a href="index.php">主页</a> > 入读学科  >  高级文凭  >  <?php echo xss_chk($row['Programme_Code']); ?> - <?php echo xss_chk($row['Programme_Name_SC']); ?>
					</div>
					
					<div class="bodyContext">
						<div class="bodyContextMain col-sm-8" >
							<div class="mainTitle red" >
								<?php echo xss_chk($row['Programme_Code']); ?>
							</div>
							
							<div class="mainTitle" >
								<?php echo xss_chk($row['Programme_Name_SC']); ?>
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
								课程特色
							</div>
							
							<?php echo addRemarks(nl2br(no2ol(xss_chk($row['Programme_Features_SC'])))); ?>
							<?php
							if ($row['StreamElective_SC'] != '' && $row['StreamElective_SC'] != null){
							?>
							<br><br>
							<?php
								echo nl2br(xss_chk($row['StreamElective_SC']));
							}
							?>
							<div class="mainSubTitle">
								专业核心单元
							</div>
								
							<?php echo nl2br(xss_chk($row['Professional_Core_Modules_SC'])); ?>
							
							
							<div class="mainSubTitle">
								职业前景
							</div>
							<?php 
							echo nl2br(xss_chk($row['Career_Prospects_SC']));
							?>
							
							<div class="mainSubTitle">
							专业认可
							</div>
							<?php
							echo nl2br(xss_chk($row['Professional_Recognition_SC']));
							?>
							
							
							<div class="mainSubTitle">
								升读学位课程<span class="additional">*</span>
							</div>
							
							<table> 
								<tr><th>大学</th><th>课程</th></tr>
								<tr><td><?php echo xss_chk($row['Articulation2_SC']); ?></td><td><?php echo xss_chk($row['Articulation_SC']); ?></td></tr>
								<?php
								if (isset($row['Articulation4_SC']) && isset($row['Articulation4_SC'])){
								?>
									<tr><td><?php echo xss_chk($row['Articulation4_SC']); ?></td><td><?php echo xss_chk($row['Articulation3_SC']); ?></td></tr>
		
								<?php
								}
								?>
							</table>
								
						</div>
						
						<div class="bodyContextSides col-sm-4">
							<div class="sideLinkBox" >
								<a href="http://www.vtc.edu.hk/admission/sc/s6/application-information/degree-higher-diploma-foundation-diploma/general-entrance-requirements/">
									一般入学要求
								</a>
							</div>
							<div class="sideLinkBox type2" >
								<a href="https://admission.vtc.edu.hk/vtcsas/faces/login.jspx?sysCode=VET">
									入学申请
								</a>
							</div>
							<div class="sideLinkBox type3" >
								<?php 
									function keywordAction($n){
										return("#" . $n);
									};
									$keywordArr = explode( ',', xss_chk($row['Keyword_SC']));
									$keywordArr2 = array_map("keywordAction", $keywordArr);
									
									$keywordStr = implode(" ",$keywordArr2);
									echo $keywordStr;
								?>
							</div>
							<div class="sideLinkBox type4" >
								<a href="../Downloads/BAprogrammeGuideAY21-22.pdf">
									下载宣传册
								</a>
							</div>
							<div class="sideBox" >
								<div class="sideBoxTitle">
									课程资料
								</div>
								<div class="sideBoxSubTitle">
									查询
								</div>
								
								
								电邮: 
								<?php 
								
								$emaillist = $row['Contact_Email_Tel'];
								preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $emaillist, $matches);
								foreach($matches[0] as $email){
									
									?>
									<a href="mailto:<?php echo xss_chk($email); ?>"><?php echo xss_chk($email); ?></a>
									<?php
								}
								?>
								<div class="sideBoxSubTitle">
									课程编号
								</div>
								<?php echo xss_chk($row['Programme_Code']); ?>
								<div class="sideBoxSubTitle">
									级别
								</div>
								全日制高级文凭
								<div class="sideBoxSubTitle">
									上课形式
								</div>
								2 年全日制
								<div class="sideBoxSubTitle">
									开办分校
								</div>								<ol>
								<?php
									$campus = explode(" ", xss_chk($row['Offering_Campus']));
									
									foreach($campuses_info as $key=>$ci){
										if (chkContArray(xss_chk($row['Offering_Campus']),[$key])){
											
											?>
											
											<li><a href="<?php echo $ci[1]; ?>"><?php echo $ci[0]; ?></a></li>
											
											<?php
										}
									}
								?>
								</ol>

									
								
							</div>
							<div class="sideBox" >
								<div class="sideBoxTitle">
									高级文凭升学位
								</div>
								<div class="sideBoxTitleSubTitle2">直接入读课程
								</div><br><br>
								<img src="../images/dap.png">
								<br><br>
								<div class="sideBoxLearMore" >
									<a href="progressionLadder.php">Learn more</a>
								</div>
								
						</div>
					</div>
					<div class="bodyContextAdditional col-sm-12" >
						<span>*</span>毕业生可升读本地或海外院校提供之学位课程 ，详情可<a href="">按此</a><br>
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

