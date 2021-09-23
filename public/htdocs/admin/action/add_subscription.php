<?php
require_once('db.php');
require_once('check_access.php');

if (isset($_POST['Email']) && !empty($_POST['Email'])){
	$email = $_POST['Email'];
	
	$aes_check = $conn->prepare("SELECT * FROM `ba_email_subscription` WHERE Email = :email ");
	$aes_check->bindValue(':email', xss_chk($email), PDO::PARAM_STR);
	$aes_check->execute();
	$totalRows = $aes_check -> rowCount();
	
		$email = $_POST['Email'];
		$status = $_POST['Status'];
		
		$sql = "INSERT INTO `ba_email_subscription` (Email, Status, Create_DateTime) VALUES(?,?,NOW())";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$email, $status]);

	$msg = "Successfully add subscription record";
	echo json_encode(['code'=>200, 'msg'=>$msg]);
	exit;
		
}else{
$errorMSG = "Data not found";
echo json_encode(['code'=>404, 'msg'=>$errorMSG]);

}
?>