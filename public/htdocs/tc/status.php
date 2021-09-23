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
if (isset($_POST['submit']) && isset($_POST['email'])){
	
}else{
	header("Location: index.php");
	die();
}

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
						Subscription
					</div>
					<div class="mainContextContent">
					
						<?php
							if (isset($_POST['submit']) && isset($_POST['email'])){
								$email = $_POST['email'];
								if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
									
									$aes_check = $conn->prepare("SELECT * FROM `ba_email_subscription` WHERE Email = :email ");
									$aes_check->bindValue(':email', xss_chk($email), PDO::PARAM_STR);
									$aes_check->execute();
									$totalRows = $aes_check -> rowCount();
									
									if ($totalRows == 0){
										
										$sql = "INSERT INTO `ba_email_subscription` (Email) VALUES(?)";
										$stmt = $conn->prepare($sql);
										$stmt->execute([$email]);
										
									?>
									電郵 <?php echo xss_chk($email); ?> 已成功訂閱。
									<br><br><a href="index.php">返回</a>
									<?php
									}else{
										?>
										電郵 <?php echo xss_chk($email); ?> 已訂閱。
										<br><br><a href="index.php">返回</a>
										<?php
									}
									
									?>
									<script>
										setTimeout(function() {
										  window.location.href = "index.php";
										}, 15000);
									</script>
									<?php
								}else{
									?>
									请输入有效的电邮地址。
									<?php
								}
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

