<?php
require_once('db.php');
require_once('check_access.php');

if (isset($_POST['Programme_Code']) && !empty($_POST['Programme_Code'])){
	$Programme_Code = $_POST['Programme_Code'];
	
	$aes_check = $conn->prepare("SELECT * FROM `ba_programmes_dfs` WHERE Programme_Code = :Programme_Code ");
	$aes_check->bindValue(':Programme_Code', xss_chk($Programme_Code), PDO::PARAM_STR);
	$aes_check->execute();
	$totalRows = $aes_check -> rowCount();
	if ($totalRows == 0){
		$Programme_Title_TC = $_POST['Programme_Title_TC'];
		$Programme_Title_SC = $_POST['Programme_Title_SC'];
		$Programme_Code = $_POST['Programme_Code'];
		$Campuses = $_POST['Campuses'];
		$Programme_Features_EN = $_POST['Programme_Features_EN'];
		$Programme_Features_TC = $_POST['Programme_Features_TC'];
		$Programme_Features_SC = $_POST['Programme_Features_SC'];
		$Professional_Core_Modules_EN = $_POST['Professional_Core_Modules_EN'];
		$Professional_Core_Modules_TC = $_POST['Professional_Core_Modules_TC'];
		$Professional_Core_Modules_SC = $_POST['Professional_Core_Modules_SC'];
		$Hashtag = $_POST['Hashtag'];
		//$ImageURL = ($_POST['ImageURL']) ? $_POST['ImageURL'] : '' ;
		//$ImageURL_s = ($_POST['ImageURL_s']) ? $_POST['ImageURL_s'] : '' ;
		$ImageURL = ($_POST['ImageURL']);
		$ImageURL_s = ($_POST['ImageURL_s']);
		$Contact_Email_Tel = $_POST['Contact_Email_Tel'];
		
		$sql = "INSERT INTO `ba_programmes_dfs` (Programme_Title_EN, Programme_Title_TC, Programme_Title_SC, Programme_Code, Campuses, Programme_Features_EN, Programme_Features_TC, Programme_Features_SC, Professional_Core_Modules_EN, Professional_Core_Modules_TC, Professional_Core_Modules_SC, Hashtag, ImageURL, ImageURL_s, Contact_Email_Tel) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$Programme_Title_EN, $Programme_Title_TC, $Programme_Title_SC, $Programme_Code, $Campuses, $Programme_Features_EN, $Programme_Features_TC, $Programme_Features_SC, $Professional_Core_Modules_EN, $Professional_Core_Modules_TC, $Professional_Core_Modules_SC, $Hashtag, $ImageURL, $ImageURL_s, $Contact_Email_Tel]);
	}
	$msg = "Successfully add dfs record";
	echo json_encode(['code'=>200, 'msg'=>$msg]);
	exit;
		
}else{
$errorMSG = "Data not found";
echo json_encode(['code'=>404, 'msg'=>$errorMSG]);

}
?>