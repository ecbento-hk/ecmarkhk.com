<?php
require_once('../conn/db.php');
require_once('check_status.php');
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

  <title>SB Admin - Tables</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

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
    <!--<ul class="sidebar navbar-nav">
      
      <li class="nav-item active">
        <a class="nav-link" href="subscription_status.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Subscription Status</span></a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="recruitment_status.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Recruitment Status</span></a>
      </li>
    </ul>-->
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

		<?php
				$sfes = $conn->prepare("SELECT * FROM ba_email_subscription");
				$sfes->execute();
				$sfes_rows = $sfes->fetchAll(PDO::FETCH_ASSOC);
		?>
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Subscription Status List</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Create Datetime</th>
                  </tr>
                </thead>
                
                <tbody>
				
				<?php
				
				foreach($sfes_rows as $sfes_row){
				?>
				
                  <tr>
                    <td><?php echo xss_chk($sfes_row['ID']); ?></td>
                    <td><?php echo xss_chk($sfes_row['Email']); ?></td>
                    <td><?php echo xss_chk($sfes_row['Status']); ?></td>
                    <td><?php echo xss_chk($sfes_row['Create_DateTime']); ?></td>
                  </tr>
                 <?php
				 }
				 ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

        <p class="small text-center text-muted my-5">
          <em>More table examples coming soon...</em>
        </p>

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

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script>
	$(document).ready(function() {
	  $('#dataTable').DataTable({
		  columns:[
			{"width":"20%"},
			null,
			{"width":"20%"},
			{"width":"20%"},
		  ],
		  columnDefs: [{
                "targets": 2,
                "render": function(data, type, row, meta) {
                    if (data){
						return '<i class="fas fa-check"></i>';
					}else{
						return '<i class="fas fa-times"></i>';
					}
                }
            }],
	  });
	});
  
  </script>

</body>

</html>
