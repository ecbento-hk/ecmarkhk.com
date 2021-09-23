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
		$Programme_Title_EN = $_POST['Programme_Title_EN'];
		$Programme_Title_TC = $_POST['Programme_Title_TC'];
		$Programme_Title_SC = $_POST['Programme_Title_SC'];
		$Programme_Code = $_POST['Programme_Code'];
		$Campuses = $_POST['Campuses'];
		$Programme_Features_EN = $_POST['Programme_Features_EN'];
		$Programme_Features_TC = $_POST['Programme_Features_TC'];
		$tel_no = $_POST['Programme_Features_SC'];
		$Professional_Core_Modules_EN = $_POST['Professional_Core_Modules_EN'];
		$recruit_title = $_POST['Professional_Core_Modules_TC'];
		$Professional_Core_Modules_SC = $_POST['Professional_Core_Modules_SC'];
		$Hashtag = $_POST['Hashtag'];
		
		$Contact_Email_Tel = $_POST['Contact_Email_Tel'];
		
		$sql = "UPDATE `ba_programmes_dfs` SET Programme_Title_EN = ?, Programme_Title_TC = ?, Programme_Title_SC = ?, Programme_Code = ?, Campuses = ?, Programme_Features_EN = ?, Programme_Features_TC = ?, Programme_Features_SC = ?, Professional_Core_Modules_EN = ?, Professional_Core_Modules_TC = ?, Professional_Core_Modules_SC = ?, Hashtag = ?, Contact_Email_Tel = ? WHERE ID = ?";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$Programme_Title_TC, $Programme_Title_SC, $Programme_Code, $Campuses, $Programme_Features_EN, $Programme_Features_TC, $tel_no, $Professional_Core_Modules_EN, $recruit_title, $Professional_Core_Modules_SC, $Hashtag, $Contact_Email_Tel, $ID]);
	}
	$msg = "Successfully update dfs record";
	echo json_encode(['code'=>200, 'msg'=>$msg]);
	exit;
		
}else{
$errorMSG = "Data not found";
echo json_encode(['code'=>404, 'msg'=>$errorMSG]);

}
?>