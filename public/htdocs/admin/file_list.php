<?php
require_once('../conn/db.php');
require_once('check_status.php');
header("Content-Type: text/html;charset=utf-8");   

$token = md5(rand(1000,9999)); //you can use any encryption
$_SESSION['token'] = $token; //store it as session variable
$sub_folder = '/ba';
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin - Tables</title>

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
           Download Folder Path</div>
          <div class="card-body">
            <div class="table-responsive">
              
			  <table id="" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Type</th>
											<th>File Name </th>
											<th>File Path</th>
											<th>File Full Path</th>
										</tr>
									</thead>
									
									<?php
									
									if (isset($_GET['ext_dir']) && $_GET['ext_dir'] != "" ){
										
										$dir = "../Downloads/" . xss_htmlpurifier($_GET['ext_dir']) . "/";
										
										if (is_dir($dir)){
											if ($dh = opendir($dir)){
												while (($file = readdir($dh)) !== false){
												
													if ($file != "." && $file != ".."){
														
														
														
														if (is_dir($dir . $file)){
															$file=iconv("BIG5", "UTF-8",$file);
															?>
															
															<tr>
																<td><?php echo "Folder" ?></td>
																<td><a href="file_list.php?ext_dir=<?php echo xss_htmlpurifier($_GET['ext_dir']) . "/" . $file; ?>"><?php echo $file; ?></a></td>
																<td></td>
																
															</tr>
															
															
															<?php
															
															
														}else{
													?>
													<tr>
														<td><?php echo "File"; ?></td>
														<td><?php echo $file; ?></td>
														<td><input style="width:100%;" type="text" value="../Downloads/<?php echo xss_htmlpurifier($_GET['ext_dir']) . "/" . $file; ?>" /></td>
														<td>
													<input style="width:100%;" type="text" value="<?php echo 'http://'.xss_htmlpurifier($_SERVER['HTTP_HOST']) . $sub_folder .  '/Downloads/'. $file; ?>" /></td>
													</tr>
														
												
													<?php
														}
													
														
													}
												}
											closedir($dh);
											}
											
										}
										
									}else{
									
									
									?>
									
									
									
									
									
									
									
									<tbody>
									<?php
									$dir = "../Downloads/";
									$count = 1;
									if (is_dir($dir)){
										if ($dh = opendir($dir)){
											while (($file = readdir($dh)) !== false){
											
												if ($file != "." && $file != ".."){
													
													
													
													if (is_dir($dir . $file)){
														$file=iconv("BIG5", "UTF-8",$file);
														?>
														
														<tr>
															<td><?php echo "Folder" ?></td>
															<td><a href="file_list.php?ext_dir=<?php echo $file; ?>"><?php echo $file; ?></a></td>
															<td></td>
															
														</tr>
														
														
														<?php
														
														
													}else{
												?>
												<tr>
													<td><?php echo "File"; ?></td>
													<td><?php echo $file; ?></td>
													<td><input style="width:100%;" type="text" value="../Downloads/<?php echo $file; ?>" /></td>
													<td>
													<input style="width:100%;" type="text" value="<?php echo 'http://'.xss_htmlpurifier($_SERVER['HTTP_HOST']) . $sub_folder .  '/Downloads/'. $file; ?>" /></td>
												</tr>
													
											
												<?php
													}
												$count++;
													
												}
											}
										closedir($dh);
										}
										
									}
									
									
									}
									?>
                                    	
									
									</tbody>
								</table>
			  
			  
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
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
  
  
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/select/1.1.2/js/dataTables.select.min.js" ></script>

<script src="https://cdn.datatables.net/responsive/2.0.2/js/dataTables.responsive.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.js" ></script>>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js" ></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.19/sorting/natural.js" ></script>

  <script src="../plugin/dataTables.altEditor.free.js"></script>
  
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  
	

</body>

</html>
