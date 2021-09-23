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

		<?php
				$sfes = $conn->prepare("SELECT * FROM `ba_page_content`");
				$sfes->execute();
				$results = $sfes->fetchAll(PDO::FETCH_ASSOC);
				$json = json_encode($results, JSON_NUMERIC_CHECK );
		?>
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            List</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <!--<thead>
                  <tr>
					<th>ID </th>
                    <th>Company Name</th>
                    <th>Nature of Business</th>
                    <th>Web Url</th>
                    <th>Contact Person</th>
					<th>Position</th>
					<th>Phone</th>
					<th>Email</th>
					<th>Recruitment Title</th>
					<th>No of Post</th>
					<th>Job Duties</th>
					<th>Academic Requirement</th>
					<th>Other Requirement</th>
					<th>Status</th>
					<th>Apply Time</th>
					
                  </tr>
                </thead>
                
                <tbody>
				
				
                </tbody>
				-->
				
				<thead>
                  <tr>
                    <th>Page Content</th>
                    <th>Link</th>
                    
                  </tr>
                </thead>
				<tbody>
				<tr>
<td>Home > Home Content</td><td>
<a href="home.php">Edit</a>
</td>
</tr>
<tr>
<td>Home > Home Slide</td><td>
<a href="homeslide.php">Edit</a>
</td>
</tr>
<tr>
<td>Home > Home Slide Text</td><td>
<a href="hometext.php">Edit</a>
</td>
</tr>
<tr>
<td>Study > VTC Earn & Learn</td><td>
<a href="VTC_EarnLearn.php">Edit</a>
</td>
</tr>
<tr>
<td>Study > Fees and Scholarship >Fee & Scholarships</td><td>
<a href="fee&scholarships.php">Edit</a>
</td>
</tr>
<tr>
<td>Study > Fees and Scholarship > Student Scholarships</td><td>
<a href="studentScholarships.php">Edit</a>
</td>
</tr>
<tr>
<td>Study > Study at IVE Business > Student Life</td><td>
<a href="studentLife.php">Edit</a>
</td>
</tr>
<tr>
<td>Study > Study at IVE Business > Progression Ladder</td><td>
<a href="progressionLadder.php">Edit</a>
</td>
</tr>
<tr>
<td>Study > Study at IVE Business > CareerProspects</td><td>
<a href="careerProspects.php">Edit</a>
</td>
</tr>
<tr>
<td>Study > Study at IVE Business > Industrial Attachment</td><td>
<a href="industrialAttachment.php">Edit</a>
</td>
</tr>
<tr>
<td>Study > Study at IVE Business > Programme Facilities</td><td>
<a href="programmeFacilities.php">Edit</a>
</td>
</tr>

<tr>
<td>Study > Study at IVE Business > Professional Recognition</td><td>
<a href="professionalRecognition.php">Edit</a>
</td>
</tr>

<tr>
<td>Study > Study at IVE Business > Accommodation</td><td>
<a href="accommodation.php">Edit</a>
</td>
</tr>
<tr>
<td>Continuing Education > About Continuing Education</td><td>
<a href="continuingEducation.php">Edit</a>
</td>
</tr>

<tr>
<td>Continuing Education > Award Bearing Programme</td><td>
<a href="awardBearingProgramme.php">Edit</a>
</td>
</tr>
<tr>
<td>Continuing Education > Short Course</td><td>
<a href="shortCourse.php">Edit</a>
</td>
</tr>
<tr>
<td>Continuing Education > Tailor Made Training Programme</td><td>
<a href="tailorMadeTrainingProgramme.php">Edit</a>
</td>
</tr>
<tr>
<td>Continuing Education > Workshop</td><td>
<a href="workshop.php">Edit</a>
</td>
</tr>
<tr>
<td>Continuing Education > Contact Us</td><td>
<a href="continuingEducationContactUs.php">Edit</a>
</td>
</tr>

<tr>
<td>Continuing Education > News</td><td>
<a href="news.php">Edit</a>
</td>
</tr>
<tr>

<tr>
<td>International > Postgraduate</td><td>
<a href="postgraduate.php">Edit</a>
</td>
</tr>

<tr>
<td>International > Exchange Activities</td><td>
<a href="exchangeActivities.php">Edit</a>
</td>
</tr>


<tr>
<td>International > International Conference</td><td>
<a href="internationalConference.php">Edit</a>
</td>
</tr>

<tr>
<td>Business > Develop your People > Continuing Professional Development</td><td>
<a href="continuingProfessionalDevelopment.php">Edit</a>
</td>
</tr>

<td>Business > Access Our Students > Recruitment</td><td>
<a href="accessOurStudents.php">Edit</a>
</td>
</tr>

<tr>
<td>Business > Access Our Students > Work Placement</td><td>
<a href="workPlacement.php">Edit</a>
</td>
</tr>

<tr>
<td>Business > Access Our Students > Donation Scholarship</td><td>
<a href="donationScholarship.php">Edit</a>
</td>
</tr>

<tr>
<td>Business > Partnership > Collaboration</td><td>
<a href="partnership.php">Edit</a>
</td>
</tr>

<tr>
<td>Business > Partnership > CConsultancy</td><td>
<a href="consultancy.php">Edit</a>
</td>
</tr>

<tr>
<td>Business > Partnership > CResearch</td><td>
<a href="research.php">Edit</a>
</td>
</tr>


<tr>
<td>Alumni > Graduate Success Stories</td><td>
<a href="alumniSharing.php">Edit</a>
</td>
</tr>

<tr>
<td>About Us > Our Campuses</td><td>
<a href="ourCampuses.php">Edit</a>
</td>
</tr>

<tr>
<td>About Us > Our Staff</td><td>
<a href="ourStaff.php">Edit</a>
</td>
</tr>
<tr>
<td>About Us > Our Vision</td><td>
<a href="ourVision.php">Edit</a>
</td>
</tr>

<tr>
<td>About Us > Contact Us</td><td>
<a href="contactUs.php">Edit</a>
</td>
</tr>

<tr>
<td>
News > Our News</td><td>
<a href="ourNews.php">Edit</a>
</td>
</tr>

















<!--<tr>
<td>Training Programmes</td><td>
<a href="trainingProgrammes.php">Edit</a>
</td>
</tr>-->



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
  
  
  <script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js" ></script>
<script src="https://cdn.datatables.net/select/1.1.2/js/dataTables.select.min.js" ></script>

<script src="https://cdn.datatables.net/responsive/2.0.2/js/dataTables.responsive.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.js" ></script>>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js" ></script>
  <script src="../plugin/dataTables.altEditor.free.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  
  
  
  
  
	

</body>

</html>
