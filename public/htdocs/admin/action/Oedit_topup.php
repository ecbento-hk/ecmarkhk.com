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
		$Programme_University_EN = $_POST['Programme_University_EN'];
		$Programme_University_TC = $_POST['Programme_University_TC'];
		$Programme_University_SC = $_POST['Programme_University_SC'];
		$Programme_University_Abb = $_POST['Programme_University_Abb'];
		$Programme_Name_EN = $_POST['Programme_Name_EN'];
		$Programme_Name_TC = $_POST['Programme_Name_TC'];
		
		$Programme_Name_SC = $_POST['Programme_Name_SC'];
		$RegNo = $_POST['RegNo'];
		$QR_RegNo = $_POST['QR_RegNo'];
		$Mode_EN = $_POST['Mode_EN'];
		$Mode_TC = $_POST['Mode_TC'];
		$Mode_SC = $_POST['Mode_SC'];
		$QF_Level_EN = $_POST['QF_Level_EN'];
		$QF_Level_TC = $_POST['QF_Level_TC'];
		$QF_Level_SC = $_POST['QF_Level_SC'];
		$Validity_Period = $_POST['Validity_Period'];
		$Hyperlink_EN = $_POST['Hyperlink_EN'];
		$Hyperlink_TC = $_POST['Hyperlink_TC'];
		$Hyperlink_SC = $_POST['Hyperlink_SC'];
		$Programme_University_Overview_EN = $_POST['Programme_University_Overview_EN'];
		$Programme_University_Overview_TC = $_POST['Programme_University_Overview_TC'];
		$Programme_University_Overview_SC = $_POST['Programme_University_Overview_SC'];
		$Programme_Overview_EN = $_POST['Programme_Overview_EN'];
		$Programme_Overview_TC = $_POST['Programme_Overview_TC'];
		$Programme_Overview_SC = $_POST['Programme_Overview_SC'];
		$Programme_Structure_EN = $_POST['Programme_Structure_EN'];
		$Programme_Structure_TC = $_POST['Programme_Structure_TC'];
		$Programme_Structure_SC = $_POST['Programme_Structure_SC'];
		$Module_EN = $_POST['Module_EN'];
		$Module_TC = $_POST['Module_TC'];
		$Module_SC = $_POST['Module_SC'];
		$Assessment = $_POST['Assessment'];
		$External_Recognition_EN = $_POST['External_Recognition_EN'];
		$External_Recognition_TC = $_POST['External_Recognition_TC'];
		$External_Recognition_SC = $_POST['External_Recognition_SC'];
		$Study_Mode = $_POST['Study_Mode'];
		
		$Duration = $_POST['Duration'];
		$Study_Location_EN = $_POST['Study_Location_EN'];
		$Study_Location_TC = $_POST['Study_Location_TC'];
		$Study_Location_SC = $_POST['Study_Location_SC'];
		$Commencement = $_POST['Commencement'];
		$Fee_EN = $_POST['Fee_EN'];
		$Fee_TC = $_POST['Fee_TC'];
		$Fee_SC = $_POST['Fee_SC'];
		$Remark1 = $_POST['Remark1'];
		$Remark2 = $_POST['Remark2'];

		$Download_URL = $_POST['Download_URL'];
		
		
		
		$sql = "UPDATE `ba_programmes_topup` SET `Programme_University_EN` = ?, `Programme_University_TC` = ?, `Programme_University_SC` = ?, `Programme_University_Abb` = ?, `Programme_Name_EN` = ?, `Programme_Name_TC` = ?, `Programme_Name_SC` = ?, `RegNo` = ?, `QR_RegNo` = ?, `Mode_EN` = ?, `Mode_TC` = ?, `Mode_SC` = ?, `QF_Level_EN` = ?, `QF_Level_TC` = ?, `QF_Level_SC` = ?, `Validity_Period` = ?, `Hyperlink_EN` = ?, `Hyperlink_TC` = ?, `Hyperlink_SC` = ?, `Programme_University_Overview_EN` = ?, `Programme_University_Overview_TC` = ?, `Programme_University_Overview_SC` = ?, `Programme_Overview_EN` = ?, `Programme_Overview_TC` = ?, `Programme_Overview_SC` = ?, `Programme_Structure_EN` = ?, `Programme_Structure_TC` = ?, `Programme_Structure_SC` = ?, `Module_EN` = ?, `Module_TC` = ?, `Module_SC` = ?, `Assessment` = ?, `External_Recognition_EN` = ?, `External_Recognition_TC` = ?, `External_Recognition_SC` = ?, `Study_Mode` = ?, `Duration` = ?, `Study_Location_EN` = ?, `Study_Location_TC` = ?, `Study_Location_SC` = ?, `Commencement` = ?, `Fee_EN` = ?, `Fee_TC` = ?, `Fee_SC` = ?, `Remark1` = ?, `Remark2` = ?, `Download_URL` = ? WHERE ID = ?";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$Programme_University_EN, $Programme_University_TC, $Programme_University_SC, $Programme_University_Abb, $Programme_Name_EN, $Programme_Name_TC, $Programme_Name_SC, $RegNo, $QR_RegNo, $Mode_EN, $Mode_TC, $Mode_SC, $QF_Level_EN, $QF_Level_TC, $QF_Level_SC, $Validity_Period, $Hyperlink_EN, $Hyperlink_TC, $Hyperlink_SC, $Programme_University_Overview_EN, $Programme_University_Overview_TC, $Programme_University_Overview_SC, $Programme_Overview_EN, $Programme_Overview_TC, $Programme_Overview_SC, $Programme_Structure_EN, $Programme_Structure_TC, $Programme_Structure_SC, $Module_EN, $Module_TC, $Module_SC, $Assessment, $External_Recognition_EN, $External_Recognition_TC, $External_Recognition_SC, $Study_Mode, ,$Duration, $Study_Location_EN, $Study_Location_TC, $Study_Location_SC, $Commencement, $Fee_EN, $Fee_TC, $Fee_SC, $Remark1, $Remark2,  $ID]);
	}
	$msg = "Successfully add topup record";
	echo json_encode(['code'=>200, 'msg'=>$msg]);
	exit;
		
}else{
$errorMSG = "Data not found";
echo json_encode(['code'=>404, 'msg'=>$errorMSG]);

}
?>