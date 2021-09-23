<?php
require_once('../conn/db.php');
header("Content-Type: text/html;charset=utf-8");   

$type_id = 7;
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
<link rel="stylesheet" href="../css/vtcearnlearn.css">
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
						<img src="../images/Study_VTC_Earn_and_Learn_P1.jpg" />
					</div>
				
				
				</div>
				
				<div class="col container mainBodyContainer">
					<div class="bodyTitle" >
					VTC Earn & Learn Scheme for Retail
					</div>
					<div class="bodyBreadcrumbs" >
					<a href="index.php">Home</a> > Study > VTC Earn & Learn Scheme for Retail
					</div>
					
					<div class="bodyContext">
						<div class="bodyContextMain col-sm-12" >
							
							<div class="row" >
								<div class="col-sm-12 " >
									<!--<div class="mainTitle" >
									Scheme Details
									</div>
									
									<p>
									VTC Earn & Learn Scheme for Retail Industry offers Higher Diploma and Diploma of Foundation Studies programme options:
									</p>
									<div class="earnLearnTitle" >Higher Diploma in Retail and e-Tail Management</div>
									<table class="earnLearnTable" cellspacing="10">
										<tr><th>Duration of Study</th><th>30 months</th></tr>
										<tr>
											<td>Scheme Arrangement</td>
											<td>Students will spend 3 days per week at IVE for Classroom learning, and 3 days for on-the-job training with the employer (27 working hours per week on average)</td>
										</tr>
										<tr>
											<td>Allowance and Salary</td>
											<td>Students will receive from the employer an average of $5,820 monthly salary and $2,000 government allowance totaling $7,820 a month</td>
										</tr>
										<tr>
											<td>Tuition Fee</td>
											<td>The employer will sponsor a tuition subsidy equivalent to $2,800 a month, students will only need to pay an average of $1,409 monthly tuition</td>
										</tr>
										<tr>
											<td>Entry Requirement</td>
											<td>Five HKDSE Subjects at Level 2 or above, including Chinese Language and English Language; or<br>
											VTC Foundation Diploma (Level 3)/ Diploma of Foundation Studies; or<br>
											VTC Diploma in Vocational Education/ Diploma of Vocational Education; or<br> 
											Yi Jin Diploma/ Diploma Yi Jin; or <br>
											Equivalent<br><br>

											Applicants will be required to attend job interviews</td>
										</tr>
									</table>
									
									<div class="earnLearnTitle" >Diploma of Foundation Studies (Retail)</div>
									<table class="earnLearnTable">
										<tr><th>Duration of Study</th><th>18 months</th></tr>
										<tr>
											<td>Scheme Arrangement</td>
											<td>Students will spend 3 days per week at IVE for Classroom learning, and 3 days for on-the-job training with the employer (27 working hours per week on average)</td>
										</tr>
										<tr>
											<td>Allowance and Salary</td>
											<td>Students will receive from the employer an average of $5,200 monthly salary and $2,000 government allowance totaling $7,200 a month</td>
										</tr>
										<tr>
											<td>Tuition Fee</td>
											<td>The employer will sponsor a tuition subsidy equivalent to $1,250 a month, students will only need to pay an average of $592 monthly tuition</td>
										</tr>
										<tr>
											<td>Entry Requirement</td>
											<td>Completion of Secondary 6 or above.
												<br><BR>
												Applicants will be required to attend job interviews</td>
										</tr>
									</table>
									<p>
									<div class="earnLearnTitle" >Offering Institute:</div>
									<a href="http://www.ive.edu.hk/ivesite/html/tc/index.html">http://www.ive.edu.hk/ivesite/html/tc/index.html</a>
									</p>
									-->
									
									<div class="mainTitle" >
									The Retail Industry
									</div>
									<p>
									The retail industry is one of the major pillars in the Hong Kong economy. Professionals from frontline to management positions possessing expert knowledge and hands-on experience are required to meet with the diversified development of the industry.
									</p>
									
									<div class="earnLearnTitle" ></div>
									<table class="earnLearnTable" cellspacing="10">
										<tr>
											<th>5 Major Advantages</th>
										</tr>
										<tr>
											<td>
											<ol>
											<li>
												Earn & Learn – Work 3 Days, Study 3 Days
											</li>
											<li>Recognised Qualification</li>
											<li>Professional Career after Scheme Completion</li>
											<li>Flexible Articulation Pathways</li>
											<li>Progressive Career Path</li>
											</td>
										</tr>
										
									</table>
									
									<div class="earnLearnTitle" ></div>
									<table class="earnLearnTable" cellspacing="10">
										<tr>
											<th>Programmes</th>
										</tr>
										<tr>
											<td>
											Higher Diploma in Retail and e-Tail Management<br>
											Diploma of Foundation Studies (Retail)
											</td>
										</tr>
										
									</table>
									
									<div class="earnLearnTitle" ></div>
									<table class="earnLearnTable" cellspacing="10">
										<tr>
											<td>Programme Leaflet (Download)</td>
										</tr>
									</table>
									
									<p style="font-style:italic">Note:
									<ul style="font-style:italic">
										<li>The Civil Service Bureau has accepted VTC Foundation Diploma (Level 3)/Diploma of Foundation Studies as a qualification eligible to apply for positions in the civil service that require five HKDSE subjects at Level 2 or above including English Language and Chinese Language as entry requirement.
										</li>
										<li>Graduates of Higher Diploma can undertake local or overseas top-up degree programmes recognized by the Government to obtain higher academic qualification.
										</li>
									</ul>
									</p>
									
									<p>
									For more information about the Scheme, please visit <a href="http://www.vtc.edu.hk/earnlearn/html/en/industry/s6/retail.html" target="_blank" >
									http://www.vtc.edu.hk/earnlearn/html/en/industry/s6/retail.html
									</a>
									</p>
									
									<p>
									<div class="earnLearnTitle" >For enquires:</div>
									Hong Kong Institute of Vocational Education (Haking Wong)<br>
									Department of Business Administration<br>
									Phone: 2708 6402/ 2708 5325<br>
									<div>Email: <a href="mailto:hwenl@vtc.edu.hk">hwenl@vtc.edu.hk</a></div>
									<br><br>
									Information as of March 2018. VTC reserves the right to update programme information.
									</p>
									<div class="earnLearnVideoList">
										<div class="earnLearnVideoListItem">
											<div class="earnLearnVideoListItemBtn">
												<a target="_blank" href="https://www.youtube.com/watch?time_continue=2&v=wBC-dXyKaEw">&nbsp;</a>
											</div>
											<div class="earnLearnVideoListItemImg">
												<img src="../images/earnlearn/Study_VTC_Earn_and_Learn_V4.jpg" />
											</div>
										</div>
										
										<div class="earnLearnVideoListItem">
											<div class="earnLearnVideoListItemBtn">
												<a target="_blank" href="https://www.youtube.com/watch?time_continue=71&v=pF2QTpUt4bU">&nbsp;</a>
											</div>
											
											<div class="earnLearnVideoListItemImg">
												<img src="../images/earnlearn/Study_VTC_Earn_and_Learn_V5.jpg" />
											</div>
											
											
										</div>
										
										<div class="earnLearnVideoListItem">
											<div class="earnLearnVideoListItemBtn">
												<a target="_blank" href="https://www.youtube.com/watch?time_continue=1&v=dHgWWOgn7UI">&nbsp;</a>
											</div>
											<div class="earnLearnVideoListItemImg">
												<img src="../images/earnlearn/Study_VTC_Earn_and_Learn_V6.jpg" />
											</div>
											
											
										
										</div>
									
									</div>
									
									<div class="mainTitle" >
									Student Sharing
									</div>
									<div class="earnLearnSharing" >
										<div class="earnLearnSharingImg">
											<img src="../images/earnlearn/Study_VTC_Earn_and_Learn_P2.jpg" />
										</div>
										<div class="earnLearnSharingContent">
											<div class="earnLearnSharingContentPara">
											‘ The all-around and structured on-the-job training in different positions enhance my skillset and knowledge in retail management and prepare myself for further career development.’
											</div>
											<div class="earnLearnSharingContentDetails">
											LU Jua Yi<br>
Diploma of Foundation Studies (Retail), IVE<br>
Sales Trainee at i.t. apparels Limited
											</div>
										</div>
									</div>
									<div class="mainTitle" >
									Participating Employers
									</div>
									
									<div class="earnLearnEmployers">
										<div class="earnLearnEmployersList">
											<div class="earnLearnEmployersListItemTitle">
											Beauty & Cosmetics
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/1.3_Study_VTC_Earn_and_Learn_L1.png"/>
											</div>
											
										</div>
										
										<div class="earnLearnEmployersList">
											<div class="earnLearnEmployersListItemTitle">
											Convenience Stores
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/1.3_Study_VTC_Earn_and_Learn_L2.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/1.3_Study_VTC_Earn_and_Learn_L3.png"/>
											</div>
											
										</div>
										
										<div class="earnLearnEmployersList">
											<div class="earnLearnEmployersListItemTitle">
											Department Stores
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/1.3_Study_VTC_Earn_and_Learn_L4.png"/>
											</div>
											
										</div>
										
										<div class="earnLearnEmployersList">
											<div class="earnLearnEmployersListItemTitle">
											Electronic & Electrical Appliances
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/1.3_Study_VTC_Earn_and_Learn_L5.png"/>
											</div>
											
										</div>
										
										<div class="earnLearnEmployersList">
											<div class="earnLearnEmployersListItemTitle">
											Fashion & Accessories
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/1.3_Study_VTC_Earn_and_Learn_L6.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/1.3_Study_VTC_Earn_and_Learn_L7.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/1.3_Study_VTC_Earn_and_Learn_L8.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/1.3_Study_VTC_Earn_and_Learn_L9.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/1.3_Study_VTC_Earn_and_Learn_L10.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/1.3_Study_VTC_Earn_and_Learn_L11.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/1.3_Study_VTC_Earn_and_Learn_L12.png"/>
											</div>
										</div>
										
										<div class="earnLearnEmployersList">
											<div class="earnLearnEmployersListItemTitle">
											Furniture & Home Accessories
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/1.3_Study_VTC_Earn_and_Learn_L13.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/1.3_Study_VTC_Earn_and_Learn_L14.png"/>
											</div>
											
										</div>
										
										<div class="earnLearnEmployersList">
											<div class="earnLearnEmployersListItemTitle">
											Health Care Products
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/1.3_Study_VTC_Earn_and_Learn_L15.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/1.3_Study_VTC_Earn_and_Learn_L16.png"/>
											</div>
											
										</div>
										
										<div class="earnLearnEmployersList">
											<div class="earnLearnEmployersListItemTitle">
											Personal Care Products
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/1.3_Study_VTC_Earn_and_Learn_L17.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/1.3_Study_VTC_Earn_and_Learn_L18.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/1.3_Study_VTC_Earn_and_Learn_L19.png"/>
											</div>
											
										</div>
										
										<div class="earnLearnEmployersList">
											<div class="earnLearnEmployersListItemTitle">
											Sports & Outdoor Products
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/Study_VTC_Earn_and_Learn_L20.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/Study_VTC_Earn_and_Learn_L21.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/Study_VTC_Earn_and_Learn_L22.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/Study_VTC_Earn_and_Learn_L23.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/Study_VTC_Earn_and_Learn_L24.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/Study_VTC_Earn_and_Learn_L25.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/Study_VTC_Earn_and_Learn_L26.png"/>
											</div>
										</div>
										
										<div class="earnLearnEmployersList">
											<div class="earnLearnEmployersListItemTitle">
											Supermarkets
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/Study_VTC_Earn_and_Learn_L27.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/Study_VTC_Earn_and_Learn_L28.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/Study_VTC_Earn_and_Learn_L29.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/Study_VTC_Earn_and_Learn_L30.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/Study_VTC_Earn_and_Learn_L31.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/Study_VTC_Earn_and_Learn_L32.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/Study_VTC_Earn_and_Learn_L33.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/Study_VTC_Earn_and_Learn_L34.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/Study_VTC_Earn_and_Learn_L35.png"/>
											</div>
										</div>
										
										<div class="earnLearnEmployersList">
											<div class="earnLearnEmployersListItemTitle">
											Telecommunications
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/Study_VTC_Earn_and_Learn_L36.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/Study_VTC_Earn_and_Learn_L37.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/Study_VTC_Earn_and_Learn_L38.png"/>
											</div>
										</div>
										
										<div class="earnLearnEmployersList">
											<div class="earnLearnEmployersListItemTitle">
											Watch & jewellery
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/Study_VTC_Earn_and_Learn_L39.png"/>
											</div>
											<div class="earnLearnEmployersListItem">
												<img src="../images/earnlearn/Study_VTC_Earn_and_Learn_L40.png"/>
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

