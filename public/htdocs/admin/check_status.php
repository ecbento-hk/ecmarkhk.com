<?php
if (isset($_SESSION['user_email']) && isset($_SESSION['user_role'])){
	
}else{
	header("Location:login.php");
}

?>