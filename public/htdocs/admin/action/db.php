<?php
session_start();
require("../../conn/setting.php");
require_once '../../plugin/htmlpurifier-4.11.0/HTMLPurifier.standalone.php';
$dsn = "mysql:host=localhost;dbname=".$db;
$local = "http://localhost/";
$local_admin_directories = "";

$conn = new PDO($dsn, $acc, $pass, 
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") ); 


/*$admin_location =  xss_chk($_SERVER["PHP_SELF"]);
$admin_path = substr($admin_location, 0 , strpos($admin_location, '/admin/' ));
$admin_uploadPath = $_SERVER['DOCUMENT_ROOT'] . $admin_path . "/uploads/";
*/

$admin_location = "../";
$admin_uploadPath = "../uploads/";

function xss_chk($value){
	$val = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
	return $val;
}

function xss_filter($value){
	//$val = strip_tags($value, '<b><p><a><span>');
	$val = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');	
	return preg_replace('#&lt;(/?(?:pre|b|em|u|ul|li|ol))&gt;#', '<\1>', $val);
}

function xss_htmlpurifier($value){
	$purifier = new HTMLPurifier();
    $clean_html = $purifier->purify($value);
	return $clean_html;
}

function path_chk($value){
	$val = basename($value);
	$val = str_replace("..\\", "", $val);
	$val = str_replace("\\\\\\", "", $val);
	$val = str_replace("\\\\", "", $val);
	$val = str_replace("../", "", $val);
	$val = str_replace("///", "", $val);
	$val = str_replace("//", "", $val);
	return $val;
}


function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function removeList($para){
	$para = preg_replace( '/[0-9](\.)?(\))?( )+/',' ',$para);
	return $para;
}

function nl2arr($para){
	$arr = explode("\n", $para);
	return $arr;
}

function no2ol($para){
	/*
	if (preg_match_all( '/[0-9].[^\r\n]+((\r|\n|\r\n)* /)',$para) > 0){
		$para = preg_replace( '/[0-9].[^\r\n]+((\r|\n|\r\n)* /)','<li>' . '$0' . '</li>',$para);
		$para = preg_replace( '/[0-9](\.)?(\))?( )+/',' ',$para);
		return "<ol>" . $para . "</ol>";
	}else{
		return $para;
	}
	*/
	if (preg_match_all( '/^[0-9]\.[^\r\n]+((\r|\n|\r\n))*/im',$para) > 0){
		$para = preg_replace( '/^[0-9]\.[^\r\n]+((\r|\n|\r\n))*/im','<li>' . '$0' . '</li>',$para);
		$para = preg_replace( '/[0-9](\.)+(\))?( )+/im',' ',$para);
		return "<ol>" . $para . "</ol>";
	}else{
		return $para;
	}
}

function addRemarks($para){
	$para = preg_replace('/#[^\r\n]+((\r|\n|\r\n)[^\r\n]+)*/', '<span class="remarks">' . '$0' . '</span>', $para);
	return $para;
}

$visit1Quota = 27;
$visit2Quota = 40;
$visit3Quota = 20;


$route1Quota = 35;
$route2Quota = 35;
$route3Quota = 35;




$location_type = [
  'East' => [
	'CW','KT'
  ],
  'West' => [
	'HW','TY'
  ],
  'North' => [
	'ST','TM'
  ],
];

$location_type_name = [
	'East' => ['東區', '东区'],
	'West' => ['西區', '西区'],
	'North' => ['北區', '北区']
];

$location_type2 = [
  'East' => [
	'CW','LW','KT'
  ],
  'West' => [
	'KC','HW','TY','MH'
  ],
  'North' => [
	'ST','TM'
  ],
];


$campuses_info = [
  'CW' => [
	'Chai Wan','#CW','柴灣','柴湾'
  ],
  'LW' => [
	'Lee Wai Lee','#LWL','李惠利','李惠利'
  ],
  'KT' => [
	'Kwun Tong','#KT','觀塘','观塘'
  ],
  'KC' => [
	'Kung Chung','#KC','葵涌','葵涌'
  ],
  'HW' => [
	'Haking Wong','#HW','黃克競','黄克竞'
  ],
  'TY' => [
	'Tsing Yi','#TY','青衣','青衣'
  ],
  'ST' => [
	'Sha Tin','#ST','沙田','沙田'
  ],
  'TM' => [
	'Tuen Mun','#TM','屯門','屯门'
  ],
  'MH' => [
	'Morrison Hill', '#MH','摩理臣山','摩理臣山'
  ]
];

$campusesInfoObject = new ArrayObject($campuses_info);
$campusesInfoObject->ksort();
$campuses_info = $campusesInfoObject;


?>