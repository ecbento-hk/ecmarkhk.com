<?php

//upload.php

if(isset($_POST["image"]))
{
	$data = $_POST["image"];

	

	$image_array_1 = explode(";", $data);
	$image_array_2 = explode(",", $image_array_1[1]);

	$data = base64_decode($image_array_2[1]);

	$imageName = time() . '.png';
	$filePath = "../";
	file_put_contents($filePath . $imageName, $data);
	
	echo '<img src="' . $filePath .$imageName.'" class="img-thumbnail" />';

}

?>