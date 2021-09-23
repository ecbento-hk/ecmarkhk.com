<?php
require_once('db.php');
require_once('check_access.php');

if (isset($_POST['ID']) && !empty($_POST['ID'])){
	$id = $_POST['ID'];
	$aes_check = $conn->prepare("SELECT * FROM `ba_email_subscription` WHERE ID = :ID ");
	$aes_check->bindValue(':ID', xss_chk($id), PDO::PARAM_STR);
	$aes_check->execute();
	$totalRows = $aes_check -> rowCount();
	
	if ($totalRows == 1){
		$email = $_POST['Email'];
		$status = $_POST['Status'];
		
		$sql = "UPDATE `ba_email_subscription` SET Email = ?, Status = ? WHERE ID = ?";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$email, $status, $id]);
	}
	$msg = "Successfully update subscription record";
	echo json_encode(['code'=>200, 'msg'=>$msg]);
	exit;
	
}else{
$errorMSG = "Data not found";
echo json_encode(['code'=>404, 'msg'=>$errorMSG]);

}
?>