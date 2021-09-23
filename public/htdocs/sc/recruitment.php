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
				
			</div>
		</div>
	</div>
	<div class="row">
		<div class="container mainContext">
			<div class="row">
				<div class="col-sm-12">
				<div class="mainContextItem">
					<div class="mainContextTitle">
						Recruitment
					</div>
					<div class="mainContextContent">
					
						<?php
							if (isset($_POST['submit']) && isset($_POST['email'])){
								$email = $_POST['email'];
								
								$aes_check = $conn->prepare("SELECT * FROM `ba_recruitment_form` WHERE Email = :email ");
								$aes_check->bindValue(':email', xss_chk($email), PDO::PARAM_STR);
								$aes_check->execute();
								$totalRows = $aes_check -> rowCount();
								
									$company_name = $_POST['company_name'];
									$nature_business = $_POST['nature_business'];
									$web_url = $_POST['web_url'];
									$contact_person_title = $_POST['contact_person_title'];
									$contact_person_name = $_POST['contact_person_name'];
									$position = $_POST['position'];
									$tel_no = $_POST['tel_no'];
									$email = $_POST['email'];
									$recruit_title = $_POST['recruit_title'];
									$no_post = $_POST['no_post'];
									$job_duties = $_POST['job_duties'];
									$academic_requirement = $_POST['academic_requirement'];
									$other_requirement = $_POST['other_requirement'];
									
									$sql = "INSERT INTO `ba_recruitment_form` (Company_Name, Nature_Business, Web_URL, Contact_Person_Title, Contact_Person_Name, Position, Phone, Email, Recruitment_Title, No_Post, Job_Duties, Academic_Requirement, Other_Requirement) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
									$stmt = $conn->prepare($sql);
									$stmt->execute([$company_name, $nature_business, $web_url, $contact_person_title, $contact_person_name, $position, $tel_no, $email, $recruit_title, $no_post, $job_duties, $academic_requirement, $other_requirement]);
									
								?>
								我们已经收到您的招聘信息。 我们将于稍后与您联系。
								<br><br><a href="index.php">返回</a>
								<?php
							}else{
								?>
								请先完成填写再提交。
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

<?php
require_once("footer.php");
?>


</div>


</body>
</html>

</body>
</html>

