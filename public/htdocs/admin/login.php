<?php
require_once('../conn/db.php');

header("Content-Type: text/html;charset=utf-8");   



?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin - Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
	   <?php
		if (isset($_POST['submit'])){
			$acc = $_POST['iEmail'];
			$pass = md5($_POST['iPassword']);
			$query_loginAcc = "SELECT * FROM ba_account where Account_Name=:Account_Name AND Account_Password=:Account_Password";
			$loginAcc = $conn->prepare($query_loginAcc);
			$loginAcc -> bindParam(':Account_Name', $acc, PDO::PARAM_STR);
			$loginAcc -> bindParam(':Account_Password', $pass, PDO::PARAM_STR);
			$loginAcc->execute();
			$totalRows_loginAcc = $loginAcc -> rowCount();
			if ($totalRows_loginAcc == 1){
				$_SESSION['user_email'] = $acc;
				$_SESSION['user_role'] = 1;
			?>
			<div class="text-center">
					<label >You have successfully login.</label>
			</div>
			<?php
				header("Location:index.php");
			}else{
				?>
				<div class="text-center">
						<label style="color:red">Login Fail</label>
				</div>
				<?php
			}
			
		}else{
			session_destroy ();
		}
	   ?>
	   
		
		
        <form method="post" autocomplete="off" >
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" class="form-control"  name="iEmail" placeholder="Email address" required="required" autofocus="autofocus">
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" class="form-control" name="iPassword" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <!--<div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Remember Password
              </label>
            </div>
          </div>-->
          <!--<a class="btn btn-primary btn-block" href="index.html">Login</a>-->
		  
		  <input class="btn btn-primary btn-block" type="submit" name="submit" value="Login" formmethod="post" />
        </form>
		
		<?php
		
		?>
        <!--<div class="text-center">
          <a class="d-block small mt-3" href="register.html">Register an Account</a>
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
        </div>-->
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
