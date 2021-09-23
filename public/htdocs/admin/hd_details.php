<?php
require_once('../conn/db.php');
require_once('check_status.php');
header("Content-Type: text/html;charset=utf-8");   

$token = md5(rand(1000,9999)); //you can use any encryption
$_SESSION['token'] = $token; //store it as session variable
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin - Control</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	<!-- Vendor CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.1.2/css/select.dataTables.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.0.2/css/responsive.dataTables.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" />
  
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
	<style>
	td.details-control {
		background: url(../resources/details_open.png) no-repeat center center;
		cursor: pointer;
	}
	</style>
</head>

<body id="page-top">
	
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">IVE BA Admin Dashboard</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      
    </form>

    <?php
    require_once('navbar.php');
	?>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php
	require_once('sideBar.php');
	?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Tables</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            List</div>
          <div class="card-body">
		  
            <?php
			
			
			$Programme_Board_EN = '';
			$Programme_Board_TC = '';
			$Programme_Board_SC = '';
			$Programme_Name_EN = '';
			$Programme_Name_TC = '';
			$Programme_Name_SC = '';
			$StreamElective_EN = '';
			$StreamElective_TC = '';
			$StreamElective_SC = '';
			$Programme_Code = '';
			$Offering_Campus = '';
			
			$Programme_Features_EN = '';
			$Programme_Features_TC = '';
			$Programme_Features_SC = '';
			$Career_Prospects_EN = '';
			$Career_Prospects_TC = '';
			$Career_Prospects_SC = '';
			$Professional_Core_Modules_EN = '';
			$Professional_Core_Modules_TC = '';
			$Professional_Core_Modules_SC = '';
			$Professional_Recognition_EN = '';
			$Professional_Recognition_TC = '';
			$Professional_Recognition_SC = '';
			$Contact_Email_Tel = '';
			
			$Keyword_EN = '';
			$Keyword_TC = '';
			$Keyword_SC = '';
			$Articulation_EN = '';
			$Articulation2_EN = '';
			$Articulation_TC = '';
			$Articulation_SC = '';
			$Articulation2_TC = '';
			$Articulation2_SC = '';
			
			
			
			
			if (isset($_GET['id'])){
				
								if (isset($_POST['update'])){
									if (($_POST['Programme_Board_EN'] != "") && ($_POST['Programme_Name_EN'] != "")){
										
										$type_id = xss_htmlpurifier($_GET['id']);
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
										
										
										
										
										
										$query_webcontent_edit = "UPDATE ba_programmes_hd SET 
										Programme_Board_EN=:Programme_Board_EN,
										Programme_Board_TC=:Programme_Board_TC,
										Programme_Board_SC=:Programme_Board_SC,
										Programme_Name_EN=:Programme_Name_EN,
										Programme_Name_TC=:Programme_Name_TC,
										Programme_Name_SC=:Programme_Name_SC,
										StreamElective_EN=:StreamElective_EN,
										StreamElective_TC=:StreamElective_TC,
										StreamElective_SC=:StreamElective_SC,
										Programme_Code=:Programme_Code,
										Offering_Campus=:Offering_Campus,
										Programme_Features_EN=:Programme_Features_EN,
										Programme_Features_TC=:Programme_Features_TC,
										Programme_Features_SC=:Programme_Features_SC,
										Career_Prospects_EN=:Career_Prospects_EN,
										Career_Prospects_TC=:Career_Prospects_TC,
										Career_Prospects_SC=:Career_Prospects_SC,
										Professional_Core_Modules_EN=:Professional_Core_Modules_EN,
										Professional_Core_Modules_TC=:Professional_Core_Modules_TC,
										Professional_Core_Modules_SC=:Professional_Core_Modules_SC,
										Professional_Recognition_EN=:Professional_Recognition_EN,
										Professional_Recognition_TC=:Professional_Recognition_TC,
										Professional_Recognition_SC=:Professional_Recognition_SC,
										Contact_Email_Tel=:Contact_Email_Tel,
										Keyword_EN=:Keyword_EN,
										Keyword_TC=:Keyword_TC,
										Keyword_SC=:Keyword_SC,
										Articulation_EN=:Articulation_EN,
										Articulation2_EN=:Articulation2_EN,
										Articulation_TC=:Articulation_TC,
										Articulation_SC=:Articulation_SC,
										Articulation2_TC=:Articulation2_TC,
										Articulation2_SC=:Articulation2_SC WHERE ID=:ID";
										
										
										
										$webcontent_edit = $conn->prepare($query_webcontent_edit);
										$webcontent_edit -> bindParam(':Programme_Board_EN', $_POST['Programme_Board_EN'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Programme_Board_TC', $_POST['Programme_Board_TC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Programme_Board_SC', $_POST['Programme_Board_SC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Programme_Name_EN', $_POST['Programme_Name_EN'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Programme_Name_TC', $_POST['Programme_Name_TC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Programme_Name_SC', $_POST['Programme_Name_SC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':StreamElective_EN', $_POST['StreamElective_EN'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':StreamElective_TC', $_POST['StreamElective_TC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':StreamElective_SC', $_POST['StreamElective_SC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Programme_Code', $_POST['Programme_Code'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Offering_Campus', $_POST['Offering_Campus'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Programme_Features_EN', $_POST['Programme_Features_EN'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Programme_Features_TC', $_POST['Programme_Features_TC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Programme_Features_SC', $_POST['Programme_Features_SC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Career_Prospects_EN', $_POST['Career_Prospects_EN'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Career_Prospects_TC', $_POST['Career_Prospects_TC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Career_Prospects_SC', $_POST['Career_Prospects_SC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Professional_Core_Modules_EN', $_POST['Professional_Core_Modules_EN'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Professional_Core_Modules_TC', $_POST['Professional_Core_Modules_TC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Professional_Core_Modules_SC', $_POST['Professional_Core_Modules_SC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Professional_Recognition_EN', $_POST['Professional_Recognition_EN'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Professional_Recognition_TC', $_POST['Professional_Recognition_TC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Professional_Recognition_SC', $_POST['Professional_Recognition_SC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Contact_Email_Tel', $_POST['Contact_Email_Tel'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Keyword_EN', $_POST['Keyword_EN'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Keyword_TC', $_POST['Keyword_TC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Keyword_SC', $_POST['Keyword_SC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Articulation_EN', $_POST['Articulation_EN'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Articulation2_EN', $_POST['Articulation2_EN'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Articulation_TC', $_POST['Articulation_TC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Articulation_SC', $_POST['Articulation_SC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Articulation2_TC', $_POST['Articulation2_TC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Articulation2_SC', $_POST['Articulation2_SC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':ID', $type_id, PDO::PARAM_INT);
										
										$webcontent_edit -> execute();
										
										
										
										
										
										
										
									?>
										<div class="panel panel-success">
											<div class="panel-heading">
												<h3 class="panel-title">Success</h3>
											</div>
											<div class="panel-body">
												You have successfully Save Changes.
											</div>
										</div>
								<?php	
									}else{
										?>
										<div class="panel panel-danger">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Fail</h3>
                                            </div>
                                            <div class="panel-body">
                                                Not Allow Empty in English Version.
                                            </div>
                                        </div>
										<?php
									}
								}
								
				
				
				
				
				
				
				
				
				
			
			$type_id = xss_htmlpurifier($_GET['id']);
			$query_websitecontent = "SELECT * FROM ba_programmes_hd where ID=:ID";
			$websitecontent = $conn->prepare($query_websitecontent);
			
			$websitecontent -> bindParam(':ID', $type_id, PDO::PARAM_STR);
			$websitecontent->execute();
			$totalRows_websitecontent = $websitecontent -> rowCount();
			$row_websitecontent = $websitecontent -> fetch(PDO::FETCH_ASSOC);
			
			
				if ($totalRows_websitecontent != 0){
					$Programme_Board_EN = $row_websitecontent['Programme_Board_EN'];
					$Programme_Board_TC = $row_websitecontent['Programme_Board_TC'];
					$Programme_Board_SC = $row_websitecontent['Programme_Board_SC'];
					$Programme_Name_EN = $row_websitecontent['Programme_Name_EN'];
					$Programme_Name_TC = $row_websitecontent['Programme_Name_TC'];
					$Programme_Name_SC = $row_websitecontent['Programme_Name_SC'];
					$StreamElective_EN = $row_websitecontent['StreamElective_EN'];
					$StreamElective_TC = $row_websitecontent['StreamElective_TC'];
					$StreamElective_SC = $row_websitecontent['StreamElective_SC'];
					$Programme_Code = $row_websitecontent['Programme_Code'];
					$Offering_Campus = $row_websitecontent['Offering_Campus'];
					
					$Programme_Features_EN = $row_websitecontent['Programme_Features_EN'];
					$Programme_Features_TC = $row_websitecontent['Programme_Features_TC'];
					$Programme_Features_SC = $row_websitecontent['Programme_Features_SC'];
					$Career_Prospects_EN = $row_websitecontent['Career_Prospects_EN'];
					$Career_Prospects_TC = $row_websitecontent['Career_Prospects_TC'];
					$Career_Prospects_SC = $row_websitecontent['Career_Prospects_SC'];
					$Professional_Core_Modules_EN = $row_websitecontent['Professional_Core_Modules_EN'];
					$Professional_Core_Modules_TC = $row_websitecontent['Professional_Core_Modules_TC'];
					$Professional_Core_Modules_SC = $row_websitecontent['Professional_Core_Modules_SC'];
					$Professional_Recognition_EN = $row_websitecontent['Professional_Recognition_EN'];
					$Professional_Recognition_TC = $row_websitecontent['Professional_Recognition_TC'];
					$Professional_Recognition_SC = $row_websitecontent['Professional_Recognition_SC'];
					$Contact_Email_Tel = $row_websitecontent['Contact_Email_Tel'];
					
					$Keyword_EN = $row_websitecontent['Keyword_EN'];
					$Keyword_TC = $row_websitecontent['Keyword_TC'];
					$Keyword_SC = $row_websitecontent['Keyword_SC'];
					$Articulation_EN = $row_websitecontent['Articulation_EN'];
					$Articulation2_EN = $row_websitecontent['Articulation2_EN'];
					$Articulation_TC = $row_websitecontent['Articulation_TC'];
					$Articulation_SC = $row_websitecontent['Articulation_SC'];
					$Articulation2_TC = $row_websitecontent['Articulation2_TC'];
					$Articulation2_SC = $row_websitecontent['Articulation2_SC'];
					
				}
			}else{
								if (isset($_POST['update'])){
									if (($_POST['Programme_Board_EN'] != "") && ($_POST['Programme_Name_EN'] != "")){
										
										
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
										
										
										
										
										
										$query_webcontent_edit = "INSERT INTO ba_programmes_hd(Programme_Board_EN,Programme_Board_TC,Programme_Board_SC,Programme_Name_EN,Programme_Name_TC,Programme_Name_SC,StreamElective_EN,StreamElective_TC,StreamElective_SC,Programme_Code,Offering_Campus,Programme_Features_EN,Programme_Features_TC,Programme_Features_SC,Career_Prospects_EN,Career_Prospects_TC,Career_Prospects_SC,Professional_Core_Modules_EN,Professional_Core_Modules_TC,Professional_Core_Modules_SC,Professional_Recognition_EN,Professional_Recognition_TC,Professional_Recognition_SC,Contact_Email_Tel,Keyword_EN,Keyword_TC,Keyword_SC,Articulation_EN,Articulation2_EN,Articulation_TC,Articulation_SC,Articulation2_TC,Articulation2_SC) VALUES (:Programme_Board_EN,:Programme_Board_TC,:Programme_Board_SC,:Programme_Name_EN,:Programme_Name_TC,:Programme_Name_SC,:StreamElective_EN,:StreamElective_TC,:StreamElective_SC,:Programme_Code,:Offering_Campus,:Programme_Features_EN,:Programme_Features_TC,:Programme_Features_SC,:Career_Prospects_EN,:Career_Prospects_TC,:Career_Prospects_SC,:Professional_Core_Modules_EN,:Professional_Core_Modules_TC,:Professional_Core_Modules_SC,:Professional_Recognition_EN,:Professional_Recognition_TC,:Professional_Recognition_SC,:Contact_Email_Tel,:Keyword_EN,:Keyword_TC,:Keyword_SC,:Articulation_EN,:Articulation2_EN,:Articulation_TC,:Articulation_SC,:Articulation2_TC,:Articulation2_SC)"; 
										
										
										
										
										
										$webcontent_edit = $conn->prepare($query_webcontent_edit);
										$webcontent_edit -> bindParam(':Programme_Board_EN', $_POST['Programme_Board_EN'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Programme_Board_TC', $_POST['Programme_Board_TC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Programme_Board_SC', $_POST['Programme_Board_SC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Programme_Name_EN', $_POST['Programme_Name_EN'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Programme_Name_TC', $_POST['Programme_Name_TC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Programme_Name_SC', $_POST['Programme_Name_SC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':StreamElective_EN', $_POST['StreamElective_EN'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':StreamElective_TC', $_POST['StreamElective_TC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':StreamElective_SC', $_POST['StreamElective_SC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Programme_Code', $_POST['Programme_Code'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Offering_Campus', $_POST['Offering_Campus'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Programme_Features_EN', $_POST['Programme_Features_EN'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Programme_Features_TC', $_POST['Programme_Features_TC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Programme_Features_SC', $_POST['Programme_Features_SC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Career_Prospects_EN', $_POST['Career_Prospects_EN'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Career_Prospects_TC', $_POST['Career_Prospects_TC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Career_Prospects_SC', $_POST['Career_Prospects_SC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Professional_Core_Modules_EN', $_POST['Professional_Core_Modules_EN'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Professional_Core_Modules_TC', $_POST['Professional_Core_Modules_TC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Professional_Core_Modules_SC', $_POST['Professional_Core_Modules_SC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Professional_Recognition_EN', $_POST['Professional_Recognition_EN'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Professional_Recognition_TC', $_POST['Professional_Recognition_TC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Professional_Recognition_SC', $_POST['Professional_Recognition_SC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Contact_Email_Tel', $_POST['Contact_Email_Tel'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Keyword_EN', $_POST['Keyword_EN'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Keyword_TC', $_POST['Keyword_TC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Keyword_SC', $_POST['Keyword_SC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Articulation_EN', $_POST['Articulation_EN'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Articulation2_EN', $_POST['Articulation2_EN'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Articulation_TC', $_POST['Articulation_TC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Articulation_SC', $_POST['Articulation_SC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Articulation2_TC', $_POST['Articulation2_TC'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Articulation2_SC', $_POST['Articulation2_SC'], PDO::PARAM_STR);
										
										
										$webcontent_edit -> execute();
										
										
										
										
										
										
										
									?>
										<div class="panel panel-success">
											<div class="panel-heading">
												<h3 class="panel-title">Success</h3>
											</div>
											<div class="panel-body">
												You have successfully Add New Record.
											</div>
										</div>
								<?php	
									}else{
										?>
										<div class="panel panel-danger">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Fail</h3>
                                            </div>
                                            <div class="panel-body">
                                                Not Allow Empty in English Version.
                                            </div>
                                        </div>
										<?php
									}
								}
								
				
				
			}
			?>
			<div class="panel panel-default">
							<div class="panel-heading"> </div>
							<div class="panel-body">
								<form method="post" class="form-horizontal">
                                
								
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Programme Board EN</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="Programme_Board_EN" class="form-control" value="<?php echo xss_htmlpurifier($Programme_Board_EN); ?>">
                                        </div>
									</div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Programme Board TC</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="Programme_Board_TC" class="form-control" value="<?php echo xss_htmlpurifier($Programme_Board_TC); ?>">
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Programme Board SC</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="Programme_Board_SC" class="form-control" value="<?php echo xss_htmlpurifier($Programme_Board_SC); ?>">
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Programme Name EN</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="Programme_Name_EN" class="form-control" value="<?php echo xss_htmlpurifier($Programme_Name_EN); ?>">
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Programme Name TC</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="Programme_Name_TC" class="form-control" value="<?php echo xss_htmlpurifier($Programme_Name_TC); ?>">
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Programme Name SC</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="Programme_Name_SC" class="form-control" value="<?php echo xss_htmlpurifier($Programme_Name_SC); ?>">
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">StreamElective EN</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="StreamElective_EN" class="form-control" value="<?php echo xss_htmlpurifier($StreamElective_EN); ?>">
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">StreamElective TC</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="StreamElective_TC" class="form-control" value="<?php echo xss_htmlpurifier($StreamElective_TC); ?>">
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">StreamElective SC</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="StreamElective_SC" class="form-control" value="<?php echo xss_htmlpurifier($StreamElective_SC); ?>">
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Programme Code</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="Programme_Code" class="form-control" value="<?php echo xss_htmlpurifier($Programme_Code); ?>">
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Offering Campus</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="Offering_Campus" class="form-control" value="<?php echo xss_htmlpurifier($Offering_Campus); ?>">
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Programme Features EN</label>
                                        <div class="col-sm-10">
                                            
											<textarea name="Programme_Features_EN" id="Programme_Features_EN" class="form-control" rows="10"><?php echo xss_htmlpurifier($Programme_Features_EN); ?></textarea>
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Programme Features TC</label>
                                        <div class="col-sm-10">
                                            
											<textarea name="Programme_Features_TC" id="Programme_Features_TC" class="form-control" rows="10"><?php echo xss_htmlpurifier($Programme_Features_TC); ?></textarea>
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Programme Features SC</label>
                                        <div class="col-sm-10">
                                            
											<textarea name="Programme_Features_SC" id="Programme_Features_SC" class="form-control" rows="10"><?php echo xss_htmlpurifier($Programme_Features_SC); ?></textarea>
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Career Prospects EN</label>
                                        <div class="col-sm-10">
                                            
											<textarea name="Career_Prospects_EN" id="Career_Prospects_EN" class="form-control" rows="10"><?php echo xss_htmlpurifier($Career_Prospects_EN); ?></textarea>
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Career Prospects TC</label>
                                        <div class="col-sm-10">
                                            
											<textarea name="Career_Prospects_TC" id="Career_Prospects_TC" class="form-control" rows="10"><?php echo xss_htmlpurifier($Career_Prospects_TC); ?></textarea>
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Career Prospects SC</label>
                                        <div class="col-sm-10">
                                            
											<textarea name="Career_Prospects_SC" id="Career_Prospects_SC" class="form-control" rows="10"><?php echo xss_htmlpurifier($Career_Prospects_SC); ?></textarea>
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Professional Core Modules EN</label>
                                        <div class="col-sm-10">
                                            
											<textarea name="Professional_Core_Modules_EN" id="Professional_Core_Modules_EN" class="form-control" rows="10"><?php echo xss_htmlpurifier($Professional_Core_Modules_EN); ?></textarea>
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Professional Core Modules TC</label>
                                        <div class="col-sm-10">
                                            
											<textarea name="Professional_Core_Modules_TC" id="Professional_Core_Modules_TC" class="form-control" rows="10"><?php echo xss_htmlpurifier($Professional_Core_Modules_TC); ?></textarea>
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Professional Core Modules SC</label>
                                        <div class="col-sm-10">
                                            
											<textarea name="Professional_Core_Modules_SC" id="Professional_Core_Modules_SC" class="form-control" rows="10"><?php echo xss_htmlpurifier($Professional_Core_Modules_SC); ?></textarea>
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Professional Recognition EN</label>
                                        <div class="col-sm-10">
                                            
											<textarea name="Professional_Recognition_EN" id="Professional_Recognition_EN" class="form-control" rows="10"><?php echo xss_htmlpurifier($Professional_Recognition_EN); ?></textarea>
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Professional Recognition TC</label>
                                        <div class="col-sm-10">
                                            
											<textarea name="Professional_Recognition_TC" id="Professional_Recognition_TC" class="form-control" rows="10"><?php echo xss_htmlpurifier($Professional_Recognition_TC); ?></textarea>
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Professional Recognition SC</label>
                                        <div class="col-sm-10">
                                            
											<textarea name="Professional_Recognition_SC" id="Professional_Recognition_SC" class="form-control" rows="10"><?php echo xss_htmlpurifier($Professional_Recognition_SC); ?></textarea>
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Contact Email Tel</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="Contact_Email_Tel" class="form-control" value="<?php echo xss_htmlpurifier($Contact_Email_Tel); ?>">
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Keyword EN</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="Keyword_EN" class="form-control" value="<?php echo xss_htmlpurifier($Keyword_EN); ?>">
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Keyword TC</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="Keyword_TC" class="form-control" value="<?php echo xss_htmlpurifier($Keyword_TC); ?>">
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Keyword SC</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="Keyword_SC" class="form-control" value="<?php echo xss_htmlpurifier($Keyword_SC); ?>">
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Articulation EN</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="Articulation_EN" class="form-control" value="<?php echo xss_htmlpurifier($Articulation_EN); ?>">
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Articulation2 EN</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="Articulation2_EN" class="form-control" value="<?php echo xss_htmlpurifier($Articulation2_EN); ?>">
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Articulation TC</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="Articulation_TC" class="form-control" value="<?php echo xss_htmlpurifier($Articulation_TC); ?>">
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Articulation SC</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="Articulation_SC" class="form-control" value="<?php echo xss_htmlpurifier($Articulation_SC); ?>">
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Articulation2 TC</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="Articulation2_TC" class="form-control" value="<?php echo xss_htmlpurifier($Articulation2_TC); ?>">
                                        </div>
									</div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Articulation2 SC</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="Articulation2_SC" class="form-control" value="<?php echo xss_htmlpurifier($Articulation2_SC); ?>">
                                        </div>
									</div>
					
									<div class="hr-dashed"></div>
									<div class="form-group">
										<div class="col-sm-8 col-sm-offset-2">
											<button name="update" class="btn btn-primary" type="submit">Save changes</button>
											<button name="cancel" class="btn btn-default" type="submit">Cancel</button>
											
										</div>
									</div>
								</form>

							</div>
						</div>
			
			
          </div>
          
        </div>

        

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
  
  
  <script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js" ></script>
<script src="https://cdn.datatables.net/select/1.1.2/js/dataTables.select.min.js" ></script>

<script src="https://cdn.datatables.net/responsive/2.0.2/js/dataTables.responsive.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.js" ></script>>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js" ></script>
  <script src="../plugin/dataTables.altEditor.free.js"></script>

   <script src="vendor/tinymce/js/tinymce/tinymce.dev.js?v="></script>
	<script src="vendor/tinymce/js/tinymce/plugins/table/plugin.dev.js?v="></script>
	<script src="vendor/tinymce/js/tinymce/plugins/paste/plugin.dev.js?v="></script>
	<script src="vendor/tinymce/js/tinymce/plugins/spellchecker/plugin.dev.js?v="></script>
    <script>
	tinymce.init({
		selector: "textarea#content",
		theme: "modern",
		relative_urls: false,convert_urls: false,remove_script_host : false,
		plugins: [
			"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
			"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
			"save table contextmenu directionality emoticons template paste textcolor importcss colorpicker textpattern codesample"
		],
		external_plugins: {
			//"moxiemanager": "/moxiemanager-php/plugin.js?v=20170727"
		},
		content_css: "../css/main.css,../css/business.css",
		add_unload_trigger: false,

		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons table codesample",

		image_advtab: true,
		image_caption: true,

		style_formats: [
			{title: 'Bold text', format: 'h1'},
			{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
			{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
			{title: 'Example 1', inline: 'span', classes: 'example1'},
			{title: 'Example 2', inline: 'span', classes: 'example2'},
			{title: 'Table styles'},
			{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
		],
		
		/*
		template_replace_values : {
			username : "Jack Black"
		},

		template_preview_replace_values : {
			username : "Preview user name"
		},

		link_class_list: [
			{title: 'Example 1', value: 'example1'},
			{title: 'Example 2', value: 'example2'}
		],

		image_class_list: [
			{title: 'Example 1', value: 'example1'},
			{title: 'Example 2', value: 'example2'}
		],

		templates: [
			{title: 'Some title 1', description: 'Some desc 1', content: '<strong class="red">My content: {$username}</strong>'},
			{title: 'Some title 2', description: 'Some desc 2', url: 'development.html'}
		],
		*/
		setup: function(ed) {
			/*ed.on(
				'Init PreInit PostRender PreProcess PostProcess BeforeExecCommand ExecCommand Activate Deactivate ' +
				'NodeChange SetAttrib Load Save BeforeSetContent SetContent BeforeGetContent GetContent Remove Show Hide' +
				'Change Undo Redo AddUndo BeforeAddUndo', function(e) {
				console.log(e.type, e);
			});*/
		},

		spellchecker_callback: function(method, data, success) {
			if (method == "spellcheck") {
				var words = data.match(this.getWordCharPattern());
				var suggestions = {};

				for (var i = 0; i < words.length; i++) {
					suggestions[words[i]] = ["First", "second"];
				}

				success({words: suggestions, dictionary: true});
			}

			if (method == "addToDictionary") {
				success();
			}
		}
	});
	
	if (!window.console) {
		window.console = {
			log: function() {
				tinymce.$('<div></div>').text(tinymce.grep(arguments).join(' ')).appendTo(document.body);
			}
		};
	}
	
	tinymce.execCommand('mceAddEditor', false, 'Programme_Features_EN');
	tinymce.execCommand('mceAddEditor', false, 'Programme_Features_TC');
	tinymce.execCommand('mceAddEditor', false, 'Programme_Features_SC');
	tinymce.execCommand('mceAddEditor', false, 'Career_Prospects_EN');
	tinymce.execCommand('mceAddEditor', false, 'Career_Prospects_TC');
	tinymce.execCommand('mceAddEditor', false, 'Career_Prospects_SC');
	tinymce.execCommand('mceAddEditor', false, 'Professional_Core_Modules_EN');
	tinymce.execCommand('mceAddEditor', false, 'Professional_Core_Modules_TC');
	tinymce.execCommand('mceAddEditor', false, 'Professional_Core_Modules_SC');
	tinymce.execCommand('mceAddEditor', false, 'Professional_Recognition_EN');
	tinymce.execCommand('mceAddEditor', false, 'Professional_Recognition_TC');
	tinymce.execCommand('mceAddEditor', false, 'Professional_Recognition_SC');

	
  </script>
  
  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script>
	
	
	
	function format ( d ) {
		// `d` is the original data object for the row
		return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
			'<tr>'+
				'<td>Company Name:</td>'+
				'<td>'+d.Company_Name+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>Nature Business:</td>'+
				'<td>'+d.Nature_Business+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>Extra info:</td>'+
				'<td>'+ d.Web_URL +'</td>'+
			'</tr>'+
		'</table>';
	}
	
	var categoryOptions = { "1" : "Professional Services", "2" : "Business and Marketing" , "3" : "Interdisciplinary" };
	$(document).ready(function() {
	
	  
	  
	  
	 $('#dataTable tbody').on('click', 'td.details-control', function () {
		var tr = $(this).closest('tr');
		var row = table.row( tr );

		if ( row.child.isShown() ) {
			// This row is already open - close it
			row.child.hide();
			tr.removeClass('shown');
		}
		else {
			// Open this row
			row.child( format(row.data()) ).show();
			tr.addClass('shown');
		}
		} );
	  
	  
	  
	  
	  
	  
	  
	});
  
  </script>
	

</body>

</html>
