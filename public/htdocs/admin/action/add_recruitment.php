<?php
require_once('db.php');
require_once('check_access.php');

if (isset($_POST['Email']) && !empty($_POST['Email'])){
	$email = $_POST['Email'];
	
	$aes_check = $conn->prepare("SELECT * FROM `ba_recruitment_form` WHERE Email = :email ");
	$aes_check->bindValue(':email', xss_chk($email), PDO::PARAM_STR);
	$aes_check->execute();
	$totalRows = $aes_check -> rowCount();
	
		$company_name = $_POST['Company_Name'];
		$nature_business = $_POST['Nature_Business'];
		$web_url = $_POST['Web_URL'];
		$contact_person_title = $_POST['Contact_Person_Title'];
		$contact_person_name = $_POST['Contact_Person_Name'];
		$position = $_POST['Position'];
		$tel_no = $_POST['Phone'];
		$email = $_POST['Email'];
		$recruit_title = $_POST['Recruitment_Title'];
		$no_post = $_POST['No_Post'];
		$job_duties = $_POST['Job_Duties'];
		$academic_requirement = $_POST['Academic_Requirement'];
		$other_requirement = $_POST['Other_Requirement'];
		
		$sql = "INSERT INTO `ba_recruitment_form` (Company_Name, Nature_Business, Web_URL, Contact_Person_Title, Contact_Person_Name, Position, Phone, Email, Recruitment_Title, No_Post, Job_Duties, Academic_Requirement, Other_Requirement) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$company_name, $nature_business, $web_url, $contact_person_title, $contact_person_name, $position, $tel_no, $email, $recruit_title, $no_post, $job_duties, $academic_requirement, $other_requirement]);

	$msg = "Successfully add recruit record";
	echo json_encode(['code'=>200, 'msg'=>$msg]);
	exit;
		
}else{
$errorMSG = "Data not found";
echo json_encode(['code'=>404, 'msg'=>$errorMSG]);

}
?>