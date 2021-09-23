<?php
require_once('db.php');
require_once('check_access.php');

if (isset($_POST['ID']) && !empty($_POST['ID'])){
	$ID = $_POST['ID'];
	
	$aes_check = $conn->prepare("SELECT * FROM `ba_programmes_topup` WHERE ID = :ID ");
	$aes_check->bindValue(':ID', xss_chk($ID), PDO::PARAM_STR);
	$aes_check->execute();
	$totalRows = $aes_check -> rowCount();
	if ($totalRows == 1){
		
		
		$sql = "DELETE FROM `ba_programmes_topup` WHERE ID = ?";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$ID]);
	}
	$msg = "Successfully add topup record";
	echo json_encode(['code'=>200, 'msg'=>$msg]);
	exit;
		
}else{
$errorMSG = "Data not found";
echo json_encode(['code'=>404, 'msg'=>$errorMSG]);

}
?>