<div class="container-fluid footer">
	<div class="row">
		<div class="container footerContext">
		
			<div class="row">
				<div class="col-sm-8">
				  <script>
					$(document).ready(function(){
						$('#alertSubscription').on('submit', function(e) {
							const data = $("#alertSubscription :input").serializeArray();
							let valid = true;
							data.forEach(function(item){
								if (item['name'] == "email"){
									const is_email = isEmail(item['value']);
									if (is_email){
										$('input[name="email"]').removeClass("error");
										$('.emailAlertErrorMsg').removeClass("active");
									}else{
										$('input[name="email"]').addClass("error");
										$('.emailAlertErrorMsg').addClass("active");
										valid = false;
									}
								}
							});
							if (valid){
								return true;
							}else{
								return false;
							}
						});
					});
					
					function isEmail(email) {
					  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					  return regex.test(email);
					}
				  </script>
				  <div class="footerItem email">
					<div class="footerItemTitle">
						Email Alert Subscription
					</div>
					<div class="footerItemContext">
						<form id="alertSubscription" action="status.php" method="post">
						<input name="email" id="emailAlertSubscription" class="footerInput" type="text" placeholder="Enter your email address" />
						<input name="submit" id="emailAlertSubmit" class="footerBtn" value="Submit" type="submit" />
						<div class="emailAlertErrorMsg ">
							Please enter a valid email address.
						</div>
						<div class="emailAlertDetail">
							Sign up our newsletter and learn more about IVE Business programme Information.
						</div>
						</form>
					</div>
				  </div>
				  
				  
				</div>
				<div class="col-sm-4">
				  <div class="footerItem socialMedia">
					<div class="footerItemTitle">
Social Media
					</div>
					<div class="footerItemContext">
						<a href="https://www.facebook.com/IVEBusiness/" >
							<img src="../images/socialMedia_facebook.png" />
						</a>
						<a href="https://www.instagram.com/ivebusiness/" >
							<img src="../images/socialMedia_instragram.png" />
						</a>
						<a href="https://www.youtube.com/channel/UCB-0PUZK0vNjqzXJvOSKYCw/" >
							<img src="../images/socialMedia_youtube.png" />
						</a>
					</div>
				  </div>
				</div>
				
			</div>
			
			<div class="row footerBottom">
				
				
				<div class="col-sm-12 footerMenu">
					<div class="footerMenuItem">
						<div class="footerMenuItemTitle">Study</div>
						<ul>
							<li><a href="hd.php">Higher Diploma</a></li>
							<li><a href="fd.php">Diploma of Foundation Studies</a></li>
							<li><a href="topup.php">Top-up Degrees</a></li>
							<li><a href="fee&scholarships.php">Fees and Scholarship</a></li>
							<li><a href="studentLife.php">Study at IVE Business</a></li>

						</ul>
					</div>
					
					<div class="footerMenuItem">
						<div class="footerMenuItemTitle">Continuing Education</div>
						<ul>
							<li><a href="continuingEducation.php">About Us</a></li>
							<li><a href="trainingProgrammes.php">Training Programmes</a></li>
							<li><a href="workshop.php">Workshop</a></li>
							<li><a href="continuingEducationContactUs">Contact us</a></li>
							<li><a href="news.php">News</a></li>
							
						</ul>
					</div>
					
					<div class="footerMenuItem">
						<div class="footerMenuItemTitle">International</div>
						<ul>
							<li><a href="postgraduate.php">Postgraduate</a></li>
							<li><a href="exchangeActivities.php">Exchange Activities</a></li>
							<li><a href="internationalConference.php">International Conference</a></li>
						</ul>
					</div>
					
					<div class="footerMenuItem">
						<div class="footerMenuItemTitle">Business</div>
						<ul>
							<li><a href="continuingProfessionalDevelopment.php">Develop your People</a></li>
							<li><a href="accessOurStudents.php">Access our Students</a></li>
							<li><a href="partnership.php">Partnership</a></li>
						</ul>
					</div>
					
					
				</div>
				<div class="col-sm-12 footerMenu">
					<div class="footerMenuItem">
						<div class="footerMenuItemTitle">Alumni</div>
						<ul>
							<li><a href="alumniSharing.php">Graduate Success Stories</a></li>
						</ul>
					</div>
					
					<div class="footerMenuItem">
						<div class="footerMenuItemTitle">About Us</div>
						<ul>
							<li><a href="ourVision.php">Our Vision</a></li>
							<li><a href="ourStaff.php">Our Staff</a></li>
							<li><a href="ourCampuses.php">Our Campuses</a></li>
							<li><a href="contactUs.php">Contact Us</a></li>
						</ul>
					</div>
					
					<div class="footerMenuItem">
						<div class="footerMenuItemTitle">News</div>
						<ul>
							<li><a href="ourNews.php">Newsletter</a></li>
							
						</ul>
					</div>
					
					<div class="footerMenuItem">
					
					</div>
				</div>
				
				
				<div class="col-sm-12 footerLogoCopyRight">
					<img src="../images/logo_BA.png" />
					
					© Copyright 2019 IVE Business. All material provided subject to copyright permission.
				</div>
				
				
			</div>
		
		
		
		
		
		</div>
	</div>
</div>