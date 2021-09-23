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
	
	
	
	
	  $('.alumniSharingSlider').bxSlider({
		slideWidth: 5000,
		minSlides: 3,
		maxSlides: 3
	  });
});



</script>
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/main.css?v=20190817"><link href="https://fonts.googleapis.com/css?family=Noto+Sans+SC|Noto+Sans+TC&display=swap" rel="stylesheet">

<link rel="stylesheet" href="../plugin/jquery-ui-1.12.1/jquery-ui.min.css">
<link rel="stylesheet" href="../css/alumni.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i" rel="stylesheet">


<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

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
						<img src="../images/alumniSharing.jpg" />
					</div>
				
				
				</div>
				
				<div class="col container mainBodyContainer">
					<div class="bodyTitle" >
					Graduate Success Stories
					</div>
					<div class="bodyBreadcrumbs" >
					<a href="index.php">Home</a> > Business > Graduate Success Stories > Alumni Sharing
					</div>
					
					<div class="bodyContext">
						<div class="bodyContextMain col-sm-12" >
							
							<div class="row" >
								<div class="col-sm-12 " >
									<div class="mainTitle" >
									Alumni Sharing
									</div>
									
									<p>
									To get inspired with words of advice from graduate success stories, learn about the interesting journeys of IVE Business graduates.
									</p>
									
									<div class="businessComment">
										<div class="businessCommentItem">
											<div class="businessCommentItemInfo">
												<img src="../images/as1.png" />
											</div>
											<div class="businessCommentItemDetails">
												I had an opportunity to work in the Bank of China (Hong Kong) Limited through the Industrial Attachment Program and this was a valuable experience which could not be learnt from books.
												<div class="businessCommentItemDetailsItem"><span class="businessCommentItemDetailsName">
												KWAN Shun Yan
												</span>
												<span class="businessCommentItemDetailsProgram">
												HD in Banking and Finance<br>
												Customer Relationship Manager, Bank of China (Hong Kong) Limited
												</span>
												</div>
											</div>
										</div>
										
										<div class="businessCommentItem reverse">
											<div class="businessCommentItemInfo">
												<img src="../images/as2.png" />
											</div>
											<div class="businessCommentItemDetails">
												I treasure the Higher Diploma studies very much.  I have learnt the concept and practical design skills that set me apart from other co-workers.
												<div class="businessCommentItemDetailsItem"><span class="businessCommentItemDetailsName">
												Wong Tsz Yeung, Jason</span>
												<span class="businessCommentItemDetailsProgram">
												HD in Advertising and Marketing Communications<br>
												Associate Search & Social Platform Director, OMD
												</span>
												</div>
											</div>
										</div>
										
										<div class="businessCommentItem">
											<div class="businessCommentItemInfo">
												<img src="../images/as3.png" />
											</div>
											<div class="businessCommentItemDetails">
												Through a wide range of activities like industrial attachment, seminar and study tour during my Higher Diploma study, I gained much up-to-date industry knowledge and such experience helped me to build a solid foundation for my career.
												<div class="businessCommentItemDetailsItem"><span class="businessCommentItemDetailsName">
												Wong Wai Lung
												</span>
												<span class="businessCommentItemDetailsProgram">
												HD in Real Estate & Property Management <br>
												Assistant Property Manager, Discovery Park Commercial Services Limited (Member of New World Group)
												</span>
												</div>
											</div>
										</div>
										
										
										<div class="businessCommentItem reverse">
											<div class="businessCommentItemInfo">
												<img src="../images/as4.png" />
											</div>
											<div class="businessCommentItemDetails">
												During my learning in IVE, I gained many valuable industrial attachment experiences and worked in different mega events, like Standard Chartered Marathon Carnival. I was awarded a scholarship from Edinburgh Napier University and studied in the UK with full tuition fee sponsored.
												<div class="businessCommentItemDetailsItem">
												<span class="businessCommentItemDetailsName">
												Chan Wei Yan Charmaine

												</span>
												<span class="businessCommentItemDetailsProgram">
												HD in Event Marketing & Promotion<Br>
												Sales & Marketing Executive, iGears Technology Limited
												</span>
												</div>
											</div>
										</div>
										
										<div class="businessCommentItem">
											<div class="businessCommentItemInfo">
												<img src="../images/as5.png" />
											</div>
											<div class="businessCommentItemDetails">
												This programme offers a rich and broad understanding in both law and business aspects. Many of the subjects provide not only theoretical knowledge but also practical training which equipped me with extensive skills and understanding for achievements in different job positions.
												<div class="businessCommentItemDetailsItem">
												<span class="businessCommentItemDetailsName">
												Luk Chun Hong Norris

												</span>
												<span class="businessCommentItemDetailsProgram">
												HD in Law and Administration<Br>
												Senior Legal Manager, Luxury Retail
												</span>
												</div>
											</div>
										</div>
										
										<div class="businessCommentItem reverse">
											<div class="businessCommentItemInfo">
												<img src="../images/as6.png" />
											</div>
											<div class="businessCommentItemDetails">
												I am glad that my performance in is being highly recognized by my organization. I am thankful that IVE leads me to a career that greatly fulfilled my interest and career goal.
												<div class="businessCommentItemDetailsItem">
												<span class="businessCommentItemDetailsName">
												CHAU Wing Shun, Raymond

												</span>
												<span class="businessCommentItemDetailsProgram">
												HD in Human Resource Management<Br>
												Deputy Liaison Manager
Personnel Department 
China National Aviation Corporation (Group) Limited
												</span>
												</div>
											</div>
										</div>
										
										<!--
										<div class="businessCommentItem">
											<div class="businessCommentItemInfo">
												<img src="../images/as7.png" />
											</div>
											<div class="businessCommentItemDetails">
												
												<div class="businessCommentItemDetailsItem">
												<span class="businessCommentItemDetailsName">
												KWOK Ka Hin, Terry

												</span>
												<span class="businessCommentItemDetailsProgram">
												HD in Marketing (Formerly known as HD in Sales and Marketing)<Br>
												Sales Advisor, Alibaba.com Hong Kong Limited
												</span>
												</div>
											</div>
										</div>
										
										
										<div class="businessCommentItem reverse">
											<div class="businessCommentItemInfo">
												<img src="../images/as8.png" />
											</div>
											<div class="businessCommentItemDetails">
												
												<div class="businessCommentItemDetailsItem">
												<span class="businessCommentItemDetailsName">
												LEUNG Chi Yung, Kris

												</span>
												<span class="businessCommentItemDetailsProgram">
												HD in Business Administration<Br>
												Associate Director, Vigers Asia Property Ltd
												</span>
												</div>
											</div>
										</div>
										
										<div class="businessCommentItem">
											<div class="businessCommentItemInfo">
												<img src="../images/as9.png" />
											</div>
											<div class="businessCommentItemDetails">
												
												<div class="businessCommentItemDetailsItem">
												<span class="businessCommentItemDetailsName">
												LEUNG Chung Yan

												</span>
												<span class="businessCommentItemDetailsProgram">
												HD in Business Administration<Br>
												Operation Manager (Loans Division, Bank-wide Operation Department), Bank of China (Hong Kong) Limited
												</span>
												</div>
											</div>
										</div>
										-->
										<!--
										<div class="businessCommentItem reverse">
											<div class="businessCommentItemInfo">
												<img src="../images/as10.png" />
											</div>
											<div class="businessCommentItemDetails">
												
												<div class="businessCommentItemDetailsItem">
												<span class="businessCommentItemDetailsName">
												LIU Kwan Chun, Andrew

												</span>
												<span class="businessCommentItemDetailsProgram">
												HD in International Business Management with Languages (Formerly know as HD in International Business), Business Manager (Hong Kong & Macau), Chow Sang Sang Jewellery Company Limited
												</span>
												</div>
											</div>
										</div>
										
										<div class="businessCommentItem">
											<div class="businessCommentItemInfo">
												<img src="../images/as11.png" />
											</div>
											<div class="businessCommentItemDetails">
												
												<div class="businessCommentItemDetailsItem">
												<span class="businessCommentItemDetailsName">
												SUEN Man Luen

												</span>
												<span class="businessCommentItemDetailsProgram">
												HD in Accountancy<Br>
												Tax Consultant, Deloitte Touche Tohmatsu
												</span>
												</div>
											</div>
										</div>
										
										
										<div class="businessCommentItem reverse">
											<div class="businessCommentItemInfo">
												<img src="../images/as12.png" />
											</div>
											<div class="businessCommentItemDetails">
												
												<div class="businessCommentItemDetailsItem">
												<span class="businessCommentItemDetailsName">
												Tsang Kin Yung, Ken

												</span>
												<span class="businessCommentItemDetailsProgram">
												HD in Business Administration<Br>
												Group Product Manager, International Cosmetics Company
												</span>
												</div>
											</div>
										</div>
										
										<div class="businessCommentItem">
											<div class="businessCommentItemInfo">
												<img src="../images/as13.png" />
											</div>
											<div class="businessCommentItemDetails">
												
												<div class="businessCommentItemDetailsItem">
												<span class="businessCommentItemDetailsName">
												Ricky WONG

												</span>
												<span class="businessCommentItemDetailsProgram">
												HD in Marketing (Formerly known as HD in Sales and Marketing) Head of E-Commerce, Computime Ltd
												</span>
												</div>
											</div>
										</div>
										-->
										
									</div>
									
									<div class="alumniSharingSlide"> 
										<div class="alumniSharingSlideTitle">
										Alumni Sharing
										</div>
										<div class="alumniSharingSlider">
											<div class="alumniSharingSlideItem">
												<div class="alumniSharingSlideItemInfo">
													<img src="../images/as7.png" />
												</div>
												<div class="alumniSharingSlideItemDetails">
													
													<div class="alumniSharingSlideItemDetailsItem">
													<span class="alumniSharingSlideItemDetailsName">
													KWOK Ka Hin, Terry

													</span>
													<span class="alumniSharingSlideItemDetailsProgram">
													HD in Marketing (Formerly known as HD in Sales and Marketing)
													</span>
													<span class="alumniSharingSlideItemDetailsWork">
													Sales Advisor, Alibaba.com Hong Kong Limited
													</span>
													</div>
												</div>
											</div>
											
											
											<div class="alumniSharingSlideItem reverse">
												<div class="alumniSharingSlideItemInfo">
													<img src="../images/as8.png" />
												</div>
												<div class="alumniSharingSlideItemDetails">
													
													<div class="alumniSharingSlideItemDetailsItem">
													<span class="alumniSharingSlideItemDetailsName">
													LEUNG Chi Yung, Kris

													</span>
													<span class="alumniSharingSlideItemDetailsProgram">
													HD in Business Administration</span>
													<span class="alumniSharingSlideItemDetailsWork">
													Associate Director, Vigers Asia Property Ltd
													</span>
													</div>
												</div>
											</div>
											
											<div class="alumniSharingSlideItem">
												<div class="alumniSharingSlideItemInfo">
													<img src="../images/as9.png" />
												</div>
												<div class="alumniSharingSlideItemDetails">
													
													<div class="alumniSharingSlideItemDetailsItem">
													<span class="alumniSharingSlideItemDetailsName">
													LEUNG Chung Yan

													</span>
													<span class="alumniSharingSlideItemDetailsProgram">
													HD in Business Administration</span>
													<span class="alumniSharingSlideItemDetailsWork">
													Operation Manager (Loans Division, Bank-wide Operation Department), Bank of China (Hong Kong) Limited
													</span>
													</div>
												</div>
											</div>
											
											
										</div>
									
										
									</div>
									
									<!--
									<div class="alumniSharingList">
										<div class="alumniSharingListItem" >
											<table>
												<tr>
													<td class="alumniSharingListItemDetails">
														<div class="alumniSharingListItemImg" >
															<img src="../images/alumniSharing1.jpg" />
														</div>
														<div class="alumniSharingListItemIntro" >
															<div class="alumniSharingListItemIntroName" >
															KWAN Shun Yan
															</div>
															<div class="alumniSharingListItemIntroTitle" >
															Customer Relationship Manager
															<br>
															Bank of China (Hong Kong) Limited
															</div>
															
														</div>
													</td>
													<td class="alumniSharingListItemContent">
														<div class="alumniSharingListItemContentProgramme" >
														HD in Banking and Finance
														</div>
														<div class="alumniSharingListItemContentProgramme type1" >
														BA (Hons) International Business Management
														</div>
														<div class="alumniSharingListItemContentSharing" >
														I had an opportunity to work in the Bank of China (Hong Kong) Limited through the Industrial Attachment Program and this was a valuable experience which could not be learnt from books.

														</div>
														
													</td>
												</tr>
											</table>
										
										
										</div>
										
										<div class="alumniSharingListItem" >
											<table>
												<tr>
													<td class="alumniSharingListItemDetails">
														<div class="alumniSharingListItemImg" >
															<img src="../images/alumniSharing2.jpg" />
														</div>
														<div class="alumniSharingListItemIntro" >
															<div class="alumniSharingListItemIntroName" >
															Wong Tsz Yeung, Jason 
															</div>
															<div class="alumniSharingListItemIntroTitle" >
															Associate Search & Social Platform Director,
															<br>
															OMD
															</div>
															
														</div>
													</td>
													<td class="alumniSharingListItemContent type1">
														<div class="alumniSharingListItemContentProgramme" >
															<div class="alumniSharingListItemContentProgrammeDetail" >
														HD in Advertising and Marketing Communications
<span>(Formerly known as HD in Advertising and Global Brand Management)</span>
															</div>
														</div>
														<div class="alumniSharingListItemContentProgramme type2" >
														Bachelor of Social Sciences (Hons) in Integrated Communication Management 
														</div>
														<div class="alumniSharingListItemContentSharing" >
														I treasure the Higher Diploma studies very much.  I have learnt the concept and practical design skills that set me apart from other co-workers.  I would recommend this programme to those who want to develop their career in advertising and marketing communication field.W
														</div>
														
													</td>
												</tr>
											</table>
										
										
										</div>
										
										<div class="alumniSharingListItem" >
											<table>
												<tr>
													<td class="alumniSharingListItemDetails">
														<div class="alumniSharingListItemImg" >
															<img src="../images/alumniSharing3.jpg" />
														</div>
														<div class="alumniSharingListItemIntro" >
															<div class="alumniSharingListItemIntroName" >
															Wong Wai Lung
															</div>
															<div class="alumniSharingListItemIntroTitle" >
															Assistant Property Manager,
															<br
															>Discovery Park Commercial Services Limited
															(Member of New World Group)
															</div>
															
														</div>
													</td>
													<td class="alumniSharingListItemContent type2">
														<div class="alumniSharingListItemContentProgramme" >
														<div class="alumniSharingListItemContentProgrammeDetail" >
														HD in Real Estate & Property Management 
<span>(Formerly known as HD in Real Estate Management)</span>
														</div>
														</div>
														<div class="alumniSharingListItemContentProgramme type1" >
														MSc in Construction & Real Estate 
BA in Housing Management 
														</div>
														<div class="alumniSharingListItemContentProgramme type2" >
														RPHM, MCIH, AISCM
														</div>
														<div class="alumniSharingListItemContentSharing" >
														I learnt practical and useful knowledge from this programme. Through a wide range of activities like industrial attachment, seminar and study tour during my Higher Diploma study, I gained much up-to-date industry knowledge and such experience helped me to build a solid foundation for my career.
														</div>
														
													</td>
												</tr>
											</table>
										
										
										</div>
										
										<div class="alumniSharingListItem" >
											<table>
												<tr>
													<td class="alumniSharingListItemDetails type1">
														<div class="alumniSharingListItemImg" >
															<img src="../images/alumniSharing4.jpg" />
														</div>
														<div class="alumniSharingListItemIntro" >
															<div class="alumniSharingListItemIntroName" >
															Chan Wei Yan Charmaine
															</div>
															<div class="alumniSharingListItemIntroTitle" >
															Sales & Marketing Executive
<br>iGears Technology Limited
															</div>
															
														</div>
													</td>
													<td class="alumniSharingListItemContent type3">
														<div class="alumniSharingListItemContentProgramme type3" >
														HD in Event Marketing & Promotion 
														</div>
														<div class="alumniSharingListItemContentProgramme type2" >
														BA (Hons) Marketing Management with Consumer Studies
														</div>
														<div class="alumniSharingListItemContentSharing" >
														During my learning in IVE, I gained many valuable industrial attachment experiences and worked in different mega events, like Standard Chartered Marathon Carnival. I was awarded a scholarship from Edinburgh Napier University and studied in the UK with full tuition fee sponsored. After completing my studies, I start my career in a sales and marketing field.
														</div>
														
													</td>
												</tr>
											</table>
										
										
										</div>
										
										<div class="alumniSharingListItem" >
											<table>
												<tr>
													<td class="alumniSharingListItemDetails">
														<div class="alumniSharingListItemImg" >
															<img src="../images/alumniSharing5.jpg" />
														</div>
														<div class="alumniSharingListItemIntro" >
															<div class="alumniSharingListItemIntroName" >
															Luk Chun Hong Norris
															</div>
															<div class="alumniSharingListItemIntroTitle" >
															Senior Legal Manager<br>
Luxury Retail 
															</div>
															
														</div>
													</td>
													<td class="alumniSharingListItemContent">
														<div class="alumniSharingListItemContentProgramme" >
															<div class="alumniSharingListItemContentProgrammeDetail" >
														HD in Law and Administration 
														<span>(Formerly known as HD in Legal and Administrative Studies)<span>
															</div>
														</div>
														<div class="alumniSharingListItemContentProgramme type1" >
														BA in Business Management
														<br>
														Bachelor of Laws
														<br>
														Master of Laws 
														</div>
														<div class="alumniSharingListItemContentSharing" >
														This programme offers a rich and broad understanding in both law and business aspects. Many of the subjects provide not only theoretical knowledge but also practical training which equipped me with extensive skills and understanding for achievements in different job positions. The program also aroused my interests in law and encouraged my further studies. 
														</div>
														
													</td>
												</tr>
											</table>
										
										
										</div>
										
										<div class="alumniSharingListItem" >
											<table>
												<tr>
													<td class="alumniSharingListItemDetails">
														<div class="alumniSharingListItemImg" >
															<img src="../images/alumniSharing6.jpg" />
														</div>
														<div class="alumniSharingListItemIntro" >
															<div class="alumniSharingListItemIntroName" >
															CHAU Wing Shun, Raymond
															</div>
															<div class="alumniSharingListItemIntroTitle" >
															Deputy Liaison Manager<br>
Personnel Department <br>
China National Aviation Corporation (Group) Limited<br><br>

Secretary <br>
Committee on Aviation, the Hong Kong Chinese Enterprises Association
															</div>
															
														</div>
													</td>
													<td class="alumniSharingListItemContent type1">
														<div class="alumniSharingListItemContentProgramme type1" >
														HD in Human Resource Management 
														</div>
														<div class="alumniSharingListItemContentProgramme type2" >
														Bachelor of Arts (Hons) Business Administration and Management 
														</div>
														<div class="alumniSharingListItemContentProgramme" >
														Associate Member<Br>
Hong Kong Institute of Human Resource Management
														</div>
														<div class="alumniSharingListItemContentSharing" >
														The programme has prepared me for every challenge in my human resource career.  I am glad that my performance in is being highly recognized by my organization.  I am thankful that IVE leads me to a career that greatly fulfilled my interest and career goal. 
														</div>
														
													</td>
												</tr>
											</table>
										
										
										</div>
									
									</div>
									-->
									
									
									
									
									
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

