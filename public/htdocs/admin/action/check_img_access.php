<?php

$server = ($_SERVER['SERVER_NAME']);

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
	$headers = apache_request_headers();
	
	if ($_SESSION['page_token'] == $headers['token']){
		
		//echo json_encode(['code'=>200, 'msg'=>"" ]);
	}else{
		echo json_encode(['code'=>404, 'msg'=>"No Access Right" . $headers['token'] . " //" . $_SESSION['page_token']]);
		exit();
	}
	
	
}else{
	echo json_encode(['code'=>404, 'msg'=>"No Access Righgt"]);
	exit();
}
?>