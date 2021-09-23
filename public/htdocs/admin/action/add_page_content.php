<?php
require_once('db.php');
require_once('check_access.php');

if (isset($_POST['Page_Title']) && !empty($_POST['Page_Title'])){
	$Page_Title = $_POST['Page_Title'];
	
	$aes_check = $conn->prepare("SELECT * FROM `ba_page_content` WHERE Page_Title = :Page_Title ");
	$aes_check->bindValue(':Page_Title', xss_chk($Page_Title), PDO::PARAM_STR);
	$aes_check->execute();
	$totalRows = $aes_check -> rowCount();
	if ($totalRows == 0){
		$Page_Title_EN = $_POST['Page_Title_EN'];
		$Page_Content_EN = $_POST['Page_Content_EN'];
		$Page_Title_TC = $_POST['Page_Title_TC'];
		$Page_Content_TC = $_POST['Page_Content_TC'];
		$Page_Title_SC = $_POST['Page_Title_SC'];
		$Page_Content_SC = $_POST['Page_Content_SC'];
		$DateTime = $_POST['DateTime'];
		
		$sql = "INSERT INTO `ba_page_content` (`Page_Title_EN`, `Page_Content_EN`,`Page_Title_TC`, `Page_Content_TC`,`Page_Title_SC`, `Page_Content_SC`, `DateTime`) VALUES (?, ?, ?, ?, ?, ?, ?);";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$Page_Title_EN, $Page_Content_EN, $Page_Title_TC, $Page_Content_TC, $Page_Title_SC ,$Page_Content_SC , $DateTime]);
	}
	$msg = "Successfully add page content record";
	echo json_encode(['code'=>200, 'msg'=>$msg]);
	exit;
		
}else{
$errorMSG = "Data not found";
echo json_encode(['code'=>404, 'msg'=>$errorMSG]);

}
?>