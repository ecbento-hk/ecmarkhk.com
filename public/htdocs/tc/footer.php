<div class="container-fluid footer">
	<div class="row">
		<div class="container footerContext tc">
		
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
						訂閱最新課程資訊
					</div>
					<div class="footerItemContext">
						<form id="alertSubscription" action="status.php" method="post">
						<input name="email" id="emailAlertSubscription" class="footerInput" type="text" placeholder="輸入電郵地址" />
						<input name="submit" id="emailAlertSubmit" class="footerBtn" value="提交" type="submit" />
						<div class="emailAlertErrorMsg ">
							請輸入有效的電郵地址。
						</div>
						<div class="emailAlertDetail">
							想掌握更多商業課程資訊，請提供電郵地址
						</div>
						</form>
					</div>
				  </div>
				  
				  
				</div>
				<div class="col-sm-4">
				  <div class="footerItem socialMedia">
					<div class="footerItemTitle">
社交媒體
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
						<div class="footerMenuItemTitle">入讀學科
</div>
						<ul>
							<li><a href="hd.php">高級文憑</a></li>
							<li><a href="fd.php">基礎課程文憑</a></li>
							<li><a href="topup.php">學士學位銜接課程</a></li>
							<li><a href="fee&scholarships.php">學費及獎學金</a></li>
							<li><a href="studentScholarships.php">入讀商業學科</a></li>

						</ul>
					</div>
					
					<div class="footerMenuItem">
						<div class="footerMenuItemTitle">持續進修</div>
						<ul>
							<li><a href="continuingEducation.php">認識我們</a></li>
							<li><a href="trainingProgrammes.php">培訓課程</a></li>
							<li><a href="workshop.php">工作坊</a></li>
							<li><a href="continuingEducationContactUs">聯絡我們</a></li>
							<li><a href="news.php">最新動向</a></li>
							
						</ul>
					</div>
					
					<div class="footerMenuItem">
						<div class="footerMenuItemTitle">國際化</div>
						<ul>
							<li><a href="postgraduate.php">碩士課程</a></li>
							<li><a href="exchangeActivities.php">交流活動</a></li>
							<li><a href="internationalConference.php">國際會議</a></li>
						</ul>
					</div>
					
					<div class="footerMenuItem">
						<div class="footerMenuItemTitle">企業發展</div>
						<ul>
							<li><a href="continuingProfessionalDevelopment.php">培育人才</a></li>
							<li><a href="accessOurStudents.php">聯絡學生</a></li>
							<li><a href="partnership.php">企業合作</a></li>
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
						<div class="footerMenuItemTitle">有用連結</div>
						<ul>
							<li><a href="ourVision.php">學科願景</a></li>
							<li><a href="ourStaff.php">教學團隊</a></li>
							<li><a href="ourCampuses.php">院校網絡</a></li>
							<li><a href="contactUs.php">聯絡我們</a></li>
						</ul>
					</div>
					
					<div class="footerMenuItem">
						<div class="footerMenuItemTitle">最新動向</div>
						<ul>
							<li><a href="ourNews.php">通訊</a></li>
							
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