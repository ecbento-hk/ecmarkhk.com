<?php
require_once('db.php');
require_once('check_access.php');

if (isset($_POST['ID']) && !empty($_POST['ID'])){
	$id = $_POST['ID'];
	
	$aes_check = $conn->prepare("SELECT * FROM `ba_recruitment_form` WHERE ID = :ID ");
	$aes_check->bindValue(':ID', xss_chk($id), PDO::PARAM_STR);
	$aes_check->execute();
	$totalRows = $aes_check -> rowCount();
	
	if ($totalRows == 1){
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
		
		$sql = "UPDATE `ba_recruitment_form` SET Company_Name = ?, Nature_Business = ?, Web_URL = ?, Contact_Person_Title = ?, Contact_Person_Name = ?, Position = ?, Phone = ?, Email = ?, Recruitment_Title = ?, No_Post = ?, Job_Duties = ?, Academic_Requirement = ?, Other_Requirement = ? WHERE ID = ?";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$company_name, $nature_business, $web_url, $contact_person_title, $contact_person_name, $position, $tel_no, $email, $recruit_title, $no_post, $job_duties, $academic_requirement, $other_requirement, $id]);
	}
	$msg = "Successfully add recruit record";
	echo json_encode(['code'=>200, 'msg'=>$msg]);
	exit;
	
}else{
$errorMSG = "Data not found";
echo json_encode(['code'=>404, 'msg'=>$errorMSG]);

}
?>