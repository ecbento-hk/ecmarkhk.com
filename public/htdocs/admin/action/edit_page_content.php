<?php
require_once('db.php');
require_once('check_access.php');

if (isset($_POST['ID']) && !empty($_POST['ID'])){
	$ID = $_POST['ID'];
	
	$aes_check = $conn->prepare("SELECT * FROM `ba_page_content` WHERE ID = :ID ");
	$aes_check->bindValue(':ID', xss_chk($ID), PDO::PARAM_STR);
	$aes_check->execute();
	$totalRows = $aes_check -> rowCount();
	if ($totalRows == 1){
		$Page_Title_EN = $_POST['Page_Title_EN'];
		$Page_Content_EN = $_POST['Page_Content_EN'];
		$Page_Title_TC = $_POST['Page_Title_TC'];
		$Page_Content_TC = $_POST['Page_Content_TC'];
		$Page_Title_SC = $_POST['Page_Title_SC'];
		$Page_Content_SC = $_POST['Page_Content_SC'];
		$DateTime = $_POST['DateTime'];
		
		$sql = "UPDATE `ba_page_content` SET `Page_Title_EN` = ?, `Page_Content_EN` = ?, `Page_Title_TC` = ?, `Page_Content_TC` = ?, `Page_Title_SC` = ?, `Page_Content_SC` = ?, `DateTime` = ? WHERE ID = ?";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$Page_Title, $Page_Content, $DateTime, $ID]);
	}
	$msg = "Successfully edit page content record";
	echo json_encode(['code'=>200, 'msg'=>$msg]);
	exit;
		
}else{
$errorMSG = "Data not found";
echo json_encode(['code'=>404, 'msg'=>$errorMSG]);

}
?>