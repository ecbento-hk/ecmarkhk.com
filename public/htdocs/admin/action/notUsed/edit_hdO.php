<?php
require_once('db.php');
require_once('check_access.php');

if (isset($_POST['ID']) && !empty($_POST['ID'])){
	$ID = $_POST['ID'];
	
	$aes_check = $conn->prepare("SELECT * FROM `ba_programmes_hd` WHERE ID = :ID ");
	$aes_check->bindValue(':ID', xss_chk($ID), PDO::PARAM_STR);
	$aes_check->execute();
	$totalRows = $aes_check -> rowCount();
	if ($totalRows == 1){
		$Programme_Board_EN = $_POST['Programme_Board_EN'];
		$Programme_Board_TC = $_POST['Programme_Board_TC'];
		$Programme_Board_SC = $_POST['Programme_Board_SC'];
		$Programme_Name_EN = $_POST['Programme_Name_EN'];
		$Programme_Name_TC = $_POST['Programme_Name_TC'];
		$Programme_Name_SC = $_POST['Programme_Name_SC'];
		
		$StreamElective_EN = $_POST['StreamElective_EN'];
		$StreamElective_TC = $_POST['StreamElective_TC'];
		$StreamElective_SC = $_POST['StreamElective_SC'];
		$Programme_Code = $_POST['Programme_Code'];
		$Offering_Campus = $_POST['Offering_Campus'];
		$Programme_Features_EN = $_POST['Programme_Features_EN'];
		$Programme_Features_TC = $_POST['Programme_Features_TC'];
		$Programme_Features_SC = $_POST['Programme_Features_SC'];
		$Career_Prospects_EN = $_POST['Career_Prospects_EN'];
		$Career_Prospects_TC = $_POST['Career_Prospects_TC'];
		$Career_Prospects_SC = $_POST['Career_Prospects_SC'];
		$Professional_Core_Modules_EN = $_POST['Professional_Core_Modules_EN'];
		$Professional_Core_Modules_TC = $_POST['Professional_Core_Modules_TC'];
		$Professional_Core_Modules_SC = $_POST['Professional_Core_Modules_SC'];
		$Professional_Recognition_EN = $_POST['Professional_Recognition_EN'];
		$Professional_Recognition_TC = $_POST['Professional_Recognition_TC'];
		$Professional_Recognition_SC = $_POST['Professional_Recognition_SC'];
		$Contact_Email_Tel = $_POST['Contact_Email_Tel'];
		$Keyword_EN = $_POST['Keyword_EN'];
		$Keyword_TC = $_POST['Keyword_TC'];
		$Keyword_SC = $_POST['Keyword_SC'];
		$Articulation_EN = $_POST['Articulation_EN'];
		$Articulation2_EN = $_POST['Articulation2_EN'];
		$Articulation_TC = $_POST['Articulation_TC'];
		$Articulation_SC = $_POST['Articulation_SC'];
		$Articulation2_TC = $_POST['Articulation2_TC'];
		$Articulation2_SC = $_POST['Articulation2_SC'];
		
		$Programmes_Category_ID = $_POST['Programmes_Category_ID'];
		
		
		
		
		
		
		
		
		$sql = "UPDATE `ba_programmes_hd` SET `Programme_Board_EN` = ?, `Programme_Board_TC` = ?, `Programme_Board_SC` = ?, `Programme_Name_EN` = ?, `Programme_Name_TC` = ?, `Programme_Name_SC` = ?, `StreamElective_EN` = ?, `StreamElective_TC` = ?, `StreamElective_SC` = ?, `Programme_Code` = ?, `Offering_Campus` = ?, `Programme_Features_EN` = ?, `Programme_Features_TC` = ?, `Programme_Features_SC` = ?, `Career_Prospects_EN` = ?, `Career_Prospects_TC` = ?, `Career_Prospects_SC` = ?, `Professional_Core_Modules_EN` = ?, `Professional_Core_Modules_TC` = ?, `Professional_Core_Modules_SC` = ?, `Professional_Recognition_EN` = ?, `Professional_Recognition_TC` = ?, `Professional_Recognition_SC` = ?, `Contact_Email_Tel` = ?, `Keyword_EN` = ?, `Keyword_TC` = ?, `Keyword_SC` = ?, `Articulation_EN` = ?, `Articulation2_EN` = ?, `Articulation_TC` = ?, `Articulation_SC` = ?, `Articulation2_TC` = ?, `Articulation2_SC` = ?, `Programmes_Category_ID` = ? WHERE ID = ?";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$Programme_Board_EN, $Programme_Board_TC, $Programme_Board_SC, $Programme_Name_EN, $Programme_Name_TC, $Programme_Name_SC, $StreamElective_EN, $StreamElective_TC, $StreamElective_SC, $Programme_Code, $Offering_Campus, $Programme_Features_EN, $Programme_Features_TC, $Programme_Features_SC, $Career_Prospects_EN, $Career_Prospects_TC, $Career_Prospects_SC, $Professional_Core_Modules_EN, $Professional_Core_Modules_TC, $Professional_Core_Modules_SC, $Professional_Recognition_EN, $Professional_Recognition_TC, $Professional_Recognition_SC, $Contact_Email_Tel, $Keyword_EN, $Keyword_TC, $Keyword_SC, $Articulation_EN, $Articulation2_EN, $Articulation_TC, $Articulation_SC, $Articulation2_TC, $Articulation2_SC, $Programmes_Category_ID, $ID]);
	}
	$msg = "Successfully edit hd record";
	echo json_encode(['code'=>200, 'msg'=>$msg]);
	exit;
		
}else{
$errorMSG = "Data not found";
echo json_encode(['code'=>404, 'msg'=>$errorMSG]);

}
?>