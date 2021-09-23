<?php
require_once('db.php');
require_once('check_img_access.php');
require_once('file_valid.php');

//if(isset($_POST["image"]) && isset($_POST['type']) && ($_POST['type'] == "add_img"))
//if(isset($_POST["id"]) && ($_POST["id"] == '' || $_POST["id"] == "undefined") && $_POST["image"] && isset($_POST["image"]) && isset($_POST['type']))
if(isset($_POST["id"]) && ($_POST['type'] != "delete_img") && $_POST["image"] && isset($_POST["image"]) && isset($_POST['type']))
{
	try{
		$data = $_POST["image"];
		$image_array_1 = explode(";", $data);
		$image_array_2 = explode(",", $image_array_1[1]);

		$data = base64_decode($image_array_2[1]);

		$imageName = time() . '.jpg';

		$filePath = "../../uploads/";
		$filePathSaveLink = "../uploads/";
		
		$filePath_thumbnails = "../../uploads/thumbnails/";
		$filePathSaveLink_thumbnails = "../uploads/thumbnails/";
		
		
		
		//echo '<img src="' . $filePath .$imageName.'" class="img-thumbnail" />';
		$ImageURL = '';
		
		/*
		if (isset($_POST['id']) && isset($_POST['db']) && ($_POST['db'] != '') && ($_POST['db'] != null) && isset($_POST['thumb']) && $_POST['thumb'] == "false" ){
			
			file_put_contents($filePath . $imageName, $data);
			
			
			$db = xss_htmlpurifier($_POST['db']);
			$ID = $_POST['id'];
			$ImageURL = $filePathSaveLink . $imageName;
			$sql = "UPDATE `" . $db . "` SET `ImageURL` = ? WHERE ID = ?";
			$stmt = $conn->prepare($sql);
			$stmt->execute([$ImageURL, $ID]);
		}else if (isset($_POST['id']) && isset($_POST['db']) && ($_POST['db'] != '') && ($_POST['db'] != null) && isset($_POST['thumb']) && $_POST['thumb'] == "true" ){
			
			file_put_contents($filePath_thumbnails . $imageName, $data);
			
			$db = xss_htmlpurifier($_POST['db']);
			$ID = $_POST['id'];
			$ImageURL = $filePathSaveLink_thumbnails . $imageName;
			$sql = "UPDATE `" . $db . "` SET `ImageURL_s` = ? WHERE ID = ?";
			$stmt = $conn->prepare($sql);
			$stmt->execute([$ImageURL, $ID]);
		}else if (isset($_POST['path'])){
			$location = $_POST['path'] ? xss_htmlpurifier($_POST['path']) . '/' : '';
			file_put_contents($filePath . $location . $imageName, $data);
			$ImageURL = $filePath . $location . $imageName;
		}
		*/
		
		$ImageURL = '';
		$ImageURL = '';
		if (isset($_POST['db']) && ($_POST['db'] != '') && ($_POST['db'] != null) && isset($_POST['thumb']) && $_POST['thumb'] == "false" ){
			
			file_put_contents($filePath . $imageName, $data);
			
			
			$db = xss_htmlpurifier($_POST['db']);
			//$ID = $_POST['id'];
			$ImageURL = $filePathSaveLink . $imageName;
			//$sql = "UPDATE `" . $db . "` SET `ImageURL` = ? WHERE ID = ?";
			//$stmt = $conn->prepare($sql);
			//$stmt->execute([$ImageURL, $ID]);
		}else if (isset($_POST['db']) && ($_POST['db'] != '') && ($_POST['db'] != null) && isset($_POST['thumb']) && $_POST['thumb'] == "true" ){
			
			file_put_contents($filePath_thumbnails . $imageName, $data);
			
			$db = xss_htmlpurifier($_POST['db']);
			//$ID = $_POST['id'];
			$ImageURL = $filePathSaveLink_thumbnails . $imageName;
			//$sql = "UPDATE `" . $db . "` SET `ImageURL_s` = ? WHERE ID = ?";
			//$stmt = $conn->prepare($sql);
			//$stmt->execute([$ImageURL, $ID]);
		}else if (isset($_POST['path'])){
			$location = $_POST['path'] ? xss_htmlpurifier($_POST['path']) . '/' : '';
			file_put_contents($filePath . $location . $imageName, $data);
			$ImageURL = $filePath . $location . $imageName;
		}
		
		/*
		$ID = "";
		if ($ImageURL != "" || $ImageURL != ""){
			$sql = "INSERT INTO `" . $db . "` (`Programme_University_EN`, `Programme_University_TC`, `Programme_University_SC`, `Programme_University_Abb`, `Programme_Name_EN`, `Programme_Name_TC`, `Programme_Name_SC`, `RegNo`, `QR_RegNo`, `Mode_EN`, `Mode_TC`, `Mode_SC`, `QF_Level_EN`, `QF_Level_TC`, `QF_Level_SC`, `Validity_Period`, `Hyperlink_EN`, `Hyperlink_TC`, `Hyperlink_SC`, `Programme_University_Overview_EN`, `Programme_University_Overview_TC`, `Programme_University_Overview_SC`, `Programme_Overview_EN`, `Programme_Overview_TC`, `Programme_Overview_SC`, `Programme_Structure_EN`, `Programme_Structure_TC`, `Programme_Structure_SC`, `Module_EN`, `Module_TC`, `Module_SC`, `Assessment`, `External_Recognition_EN`, `External_Recognition_TC`, `External_Recognition_SC`, `Study_Mode`, `Duration`, `Study_Location_EN`, `Study_Location_TC`, `Study_Location_SC`, `Commencement`, `Fee_EN`, `Fee_TC`, `Fee_SC`, `Remark1`, `Remark2`, `ImageURL`, `ImageURL_s`, `Download_URL`) VALUES ('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ?, ?, '');";
			$stmt = $conn->prepare($sql);
			$stmt->execute([$ImageURL, $ImageURL_s]);
			$ID = $conn->lastInsertId();
		}
		*/
		if ($_POST["id"] != "" && $_POST["id"] != null && $_POST["id"] != "undefined"){
			$db = xss_htmlpurifier($_POST['db']);
			$ID = $_POST["id"];
			if (isset($_POST['thumb']) && $_POST['thumb'] == "true"){
				$sql = "UPDATE `" . $db . "` SET `ImageURL` = ? WHERE ID = ?";
				$stmt = $conn->prepare($sql);
				$stmt->execute([$ImageURL, $ID]);
			}else{
				$sql = "UPDATE `" . $db . "` SET `ImageURL_s` = ? WHERE ID = ?";
				$stmt = $conn->prepare($sql);
				$stmt->execute([$ImageURL, $ID]);
			}
			
		}
		echo json_encode(['status'=>'success', 'image'=>$ImageURL, ]);
		
		exit;
		
	}catch(Exception $e) {
		$err_msg = 'Caught exception: ' .  $e->getMessage();
		echo json_encode(['status'=>'fail', 'msg'=> $err_msg]);
	}
	
}else if(isset($_POST["image_url"]) && isset($_POST['id']) && ($_POST['id'] != "") && isset($_POST['id']))
{
	try{
		$data = prevent_filepath($_POST["image_url"]);
		$orgPath = "../uploads/";
		$tarPath = "../../uploads/";
		
		$data_t = prevent_filepath($_POST["image_url_thumb"]);
		
		$data1 = str_replace($orgPath, $tarPath, $data);
		$data2 = str_replace($orgPath, $tarPath, $data_t);
		
		if (file_exists($data1)) {
			//unlink($data1);
		}
		
		if (file_exists($data2)) {
			//unlink($data2);
		
		}
		
		if (isset($_POST['id']) && isset($_POST['db']) && ($_POST['db'] != '') && ($_POST['db'] != null) ){
			
			$db = xss_htmlpurifier($_POST['db']);
			$ID = $_POST['id'];
			$ImageURL = '';
			$ImageURL_s = '';
			$sql = "UPDATE `" . $db . "` SET `ImageURL` = ?, `ImageURL_s` = ? WHERE ID = ?";
			$stmt = $conn->prepare($sql);
			$stmt->execute([$ImageURL, $ImageURL_s, $ID]);
		}
		
		
		echo json_encode(['status'=>'success', 'msg'=> '']);
		exit;
	}catch(Exception $e) {
		echo json_encode(['status'=>'fail', 'msg'=> $err_msg]);
	}
	
}


?>