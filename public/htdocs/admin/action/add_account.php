<?php
require_once('db.php');
require_once('check_access.php');

if (isset($_POST['Account_Name']) && !empty($_POST['Account_Name'])){

	
		$account_name = $_POST['Account_Name'];
		$account_password = md5($_POST['Account_Password']);
		$account_role = '1';
		$datetime = date_create()->format('Y-m-d H:i:s');
		
		$sql = "INSERT INTO `ba_account` (Account_Name, Account_Password, Account_Role, Create_Date) VALUES(?,?,?,?)";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$account_name, $account_password, $account_role, $datetime]);

	$msg = "Successfully add account record";
	echo json_encode(['code'=>200, 'msg'=>$msg]);
	exit;
		
}else{
$errorMSG = "Data not found";
echo json_encode(['code'=>404, 'msg'=>$errorMSG]);

}
?>