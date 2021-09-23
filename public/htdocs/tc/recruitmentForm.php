<?php
if(!defined('recruitment_form')) {
   die('Direct access not permitted');
}
?>
<script>
$(document).ready(function(){
	const errorMsg = '<div class="errorMsg">* 必需填寫</div>';
	const errorEmailMsg = '<div class="errorMsg" >必需填寫有效電郵</div>';
	$('#recruitment_form').on('submit', function(e) {
		const data = $("#recruitment_form .input_required").serializeArray();
		let valid = true;
		data.forEach(function(item){
			let ele = $('#recruitment_form input[name="' + item['name'] + '"]');
			ele.parent().find('.errorMsg').remove();
			if (item['name'] == "email"){
				const is_email = isEmail(item['value']);
				if (is_email){
					ele.parent().find('.errorMsg').remove();
					ele.removeClass('error');
				}else{
					ele.parent().append(errorEmailMsg);
					ele.addClass('error');
					valid = false;
				}
			}else{
				if (item['value'] == "" || item['value'] == null){
					ele.parent().append(errorMsg);
					ele.addClass('error');
					valid = false;
				}else{
					ele.parent().find('.errorMsg').remove();
					ele.removeClass('error');
				}
			}
			
		});
		if (valid){
			return true;
		}else{
			return false;
		}
	});
	
	$(document).on("keydown", ":input:not(textarea):not(:submit)", function(event) {
		if( (event.keyCode == 13) ) {
		  event.preventDefault();
		  return false;
		}
	});
});

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
</script>
<div class="recruitmentForm">
	<div class="recruitmentFormTitle">
	招聘表格
	</div>
	
	<div class="recruitmentFormContent">
	<form id="recruitment_form" action="recruitment.php" method="post">
	<table cellspacing="10" >
		<tr>
			<td>公司名稱<span class="required">*</span>:</td><td><input name="company_name" type="text" class="input_required" /></td>
		</tr>
		<tr>
			<td>業務性質<span class="required">*</span>:</td><td><input name="nature_business" type="text" class="input_required" /></td>
		</tr>
		<tr>
			<td>公司網址</td><td><input name="web_url" type="text" /></td>
		</tr>
		<tr>
			<td>聯絡人<span class="required">*</span>:</td><td><select name="contact_person_title"><option value="先生">先生</option><option value="女士">女士</option></select><div class="contact_person"><input name="contact_person_name" type="text" class="input_required"/></div></td>
		</tr>
		<tr>
			<td>職位<span class="required">*</span>:</td><td><input name="position" type="text" class="input_required" /></td>
		</tr>
		<tr>
			<td>電話<span class="required">*</span>:</td><td><input name="tel_no" type="text" class="input_required" /></td>
		</tr>
		<tr>
			<td>電郵地址<span class="required">*</span>:</td><td><input name="email" type="text" class="input_required" /></td>
		</tr>
		<tr><td colspan="2"><hr></td></tr>
		
		<tr>
			<td>招聘職位:</td><td><input name="recruit_title" type="text" /></td>
		</tr>
		<tr>
			<td>招聘人數:</td><td><input name="no_post" type="text" /></td>
		</tr>
		<tr>
			<td>主要職務:</td><td><textarea name="job_duties" type="text" ></textarea></td>
		</tr>
		<tr>
			<td>學歷要求</td><td><textarea name="academic_requirement" type="text" /></textarea></td>
		</tr>
		<tr>
			<td>其他要求</td><td><textarea name="other_requirement" type="text" /></textarea></td>
		</tr>
		<tr>
			<td><span class="required">* 必需填寫</span></td>
			<td></td>
		</tr>
		<tr>
			<td></td><td><input name="submit" type="submit" value="提交" /><input class="resetBtn" name="reset" type="reset" value="重設" /></td>
		</tr>
		
		
	
	</table>
	</form>
	
	
	</div>
</div>