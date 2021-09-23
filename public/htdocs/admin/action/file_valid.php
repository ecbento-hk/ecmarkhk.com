<?php
function prevent_filepath($filePath){
	$filePath = str_replace("../../", "../", $filePath);
	return xss_htmlpurifier($filePath);
}
?>