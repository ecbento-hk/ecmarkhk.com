<?php
if(!defined('recruitment_form')) {
   die('Direct access not permitted');
}
?>
<script>
$(document).ready(function(){
	const errorMsg = '<div class="errorMsg">* This field is required.</div>';
	const errorEmailMsg = '<div class="errorMsg" >Not a valid Email.</div>';
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
	Recruitment Form
	</div>
	
	<div class="recruitmentFormContent">
	<form id="recruitment_form" action="recruitment.php" method="post">
	<table cellspacing="10" >
		<tr>
			<td>Company Name<span class="required">*</span>:</td><td><input name="company_name" type="text" class="input_required"/></td>
		</tr>
		<tr>
			<td>Nature of Business<span class="required">*</span>:</td><td><input name="nature_business" type="text" class="input_required"/></td>
		</tr>
		<tr>
			<td>Web URL:</td><td><input name="web_url" type="text" /></td>
		</tr>
		<tr>
			<td>Contact Person<span class="required">*</span>:</td><td><select  name="contact_person_title"><option value="Mr.">Mr.</option><option value="Ms.">Ms.</option><option value="Mrs.">Mrs.</option></select><div class="contact_person"><input name="contact_person_name"  class="input_required" type="text" /></div></td>
		</tr>
		<tr>
			<td>Position<span class="required">*</span>:</td><td><input name="position" type="text" class="input_required" /></td>
		</tr> 
		<tr>
			<td>Telephone Number<span class="required">*</span>:</td><td><input name="tel_no" type="text" class="input_required" /></td>
		</tr>
		<tr>
			<td>Email Address<span class="required">*</span>:</td><td><input name="email" type="text" class="input_required"/></td>
		</tr>
		<tr><td colspan="2"><hr></td></tr>
		
		<tr>
			<td>Recruitment Title/Post:</td><td><input name="recruit_title" type="text" /></td>
		</tr>
		<tr>
			<td>No. of Post:</td><td><input name="no_post" type="text" /></td>
		</tr>
		<tr>
			<td>Job Duties:</td><td><textarea name="job_duties" type="text" ></textarea></td>
		</tr>
		<tr>
			<td>Academic Requirement</td><td><textarea name="academic_requirement" type="text" /></textarea></td>
		</tr>
		<tr>
			<td>Other Requirement</td><td><textarea name="other_requirement" type="text" /></textarea></td>
		</tr>
		<tr>
			<td><span class="required">* Required</span></td>
			<td></td>
		</tr>
		
		
		<tr>
			<td></td><td><input name="submit" type="submit" value="SUBMIT" /><input class="resetBtn" name="reset" type="reset" value="RESET" /></td>
		</tr>
		
		
	
	</table>
	</form>
	
	
	</div>
</div>