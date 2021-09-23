<?php
require_once('db.php');
require_once('check_access.php');

if (isset($_POST['ID']) && !empty($_POST['ID'])){
	$ID = $_POST['ID'];
	
	$aes_check = $conn->prepare("SELECT * FROM `ba_programmes_dfs` WHERE Programme_Title_EN = :Programme_Title_EN ");
	$aes_check->bindValue(':Programme_Title_EN', xss_chk($programme_title_en), PDO::PARAM_STR);
	$aes_check->execute();
	$totalRows = $aes_check -> rowCount();
	if ($totalRows == 1){
		
		$sql = "Delete from `ba_programmes_dfs` WHERE ID = ?";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$ID]);
	}
	$msg = "Successfully delete dfs record";
	echo json_encode(['code'=>200, 'msg'=>$msg]);
	exit;
		
}else{
$errorMSG = "Data not found";
echo json_encode(['code'=>404, 'msg'=>$errorMSG]);

}
?>