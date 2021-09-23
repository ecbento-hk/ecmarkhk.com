<div class="container-fluid footer">
	<div class="row">
		<div class="container footerContext sc">
		
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
						订阅最新课程资讯
					</div>
					<div class="footerItemContext">
						<form id="alertSubscription" action="status.php" method="post">
						<input name="email" id="emailAlertSubscription" class="footerInput" type="text" placeholder="输入电邮地址" />
						<input name="submit" id="emailAlertSubmit" class="footerBtn" value="提交" type="submit" />
						<div class="emailAlertErrorMsg ">
							请输入有效的电邮地址。
						</div>
						<div class="emailAlertDetail">
							想掌握更多商业课程资讯，请提供电邮地址
						</div>
						</form>
					</div>
				  </div>
				  
				  
				</div>
				<div class="col-sm-4">
				  <div class="footerItem socialMedia">
					<div class="footerItemTitle">
社交媒体
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
						<div class="footerMenuItemTitle">入读学科
</div>
						<ul>
							<li><a href="hd.php">高级文凭</a></li>
							<li><a href="fd.php">基础课程文凭</a></li>
							<li><a href="topup.php">学士学位衔接课程</a></li>
							<li><a href="fee&scholarships.php">学费及奖学金</a></li>
							<li><a href="studentScholarships.php">入读商业学科</a></li>

						</ul>
					</div>
					
					<div class="footerMenuItem">
						<div class="footerMenuItemTitle">持续进修</div>
						<ul>
							<li><a href="continuingEducation.php">认识我们</a></li>
							<li><a href="trainingProgrammes.php">培训课程</a></li>
							<li><a href="workshop.php">工作坊</a></li>
							<li><a href="continuingEducationContactUs">联络我们</a></li>
							<li><a href="news.php">最新动向</a></li>
							
						</ul>
					</div>
					
					<div class="footerMenuItem">
						<div class="footerMenuItemTitle">国际化</div>
						<ul>
							<li><a href="postgraduate.php">硕士课程</a></li>
							<li><a href="exchangeActivities.php">交流活动</a></li>
							<li><a href="internationalConference.php">国际会议</a></li>
						</ul>
					</div>
					
					<div class="footerMenuItem">
						<div class="footerMenuItemTitle">企业发展</div>
						<ul>
							<li><a href="continuingProfessionalDevelopment.php">培育人才</a></li>
							<li><a href="accessOurStudents.php">联络学生</a></li>
							<li><a href="partnership.php">企业合作</a></li>
						</ul>
					</div>
					
					
				</div>
				<div class="col-sm-12 footerMenu">
					<div class="footerMenuItem">
						<div class="footerMenuItemTitle">校友</div>
						<ul>
							<li><a href="alumniSharing.php">校友分享</a></li>
						</ul>
					</div>
					
					<div class="footerMenuItem">
						<div class="footerMenuItemTitle">有用连结</div>
						<ul>
							<li><a href="ourVision.php">学科愿景</a></li>
							<li><a href="ourStaff.php">教学团队</a></li>
							<li><a href="ourCampuses.php">院校网络</a></li>
							<li><a href="contactUs.php">联络我们</a></li>
						</ul>
					</div>
					
					<div class="footerMenuItem">
						<div class="footerMenuItemTitle">最新动向</div>
						<ul>
							<li><a href="ourNews.php">通讯</a></li>
							
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