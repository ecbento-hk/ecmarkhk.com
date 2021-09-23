<?php
require_once('db.php');
require_once('check_access.php');

if (isset($_POST['ID']) && !empty($_POST['ID'])){
	$id = $_POST['ID'];
	
	$aes_check = $conn->prepare("SELECT * FROM `ba_account` WHERE ID = :ID ");
	$aes_check->bindValue(':ID', xss_chk($id), PDO::PARAM_STR);
	$aes_check->execute();
	$totalRows = $aes_check -> rowCount();
	
	if ($totalRows == 1){
		$account_name = $_POST['Account_Name'];
		$account_password = md5($_POST['Account_Password']);
		$account_role = '1';
		$datetime = date_create()->format('Y-m-d H:i:s');
		
		$sql = "UPDATE `ba_account` SET Account_Name = ?, Account_Password = ?, Account_Role = ?, Create_Date = ? WHERE ID = ?";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$account_name, $account_password, $account_role, $datetime, $id]);
	}
	$msg = "Successfully add account record";
	echo json_encode(['code'=>200, 'msg'=>$msg]);
	exit;
	
}else{
$errorMSG = "Data not found";
echo json_encode(['code'=>404, 'msg'=>$errorMSG]);

}
?>