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
				$sfes = $conn->prepare("SELECT * FROM `ba_programmes_hd`");
				$sfes->execute();
				$results = $sfes->fetchAll(PDO::FETCH_ASSOC);
				$json = json_encode($results, JSON_NUMERIC_CHECK );
		?>
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Higher Diploma Programme List</div>
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
  
  
  <script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js" ></script>
<script src="https://cdn.datatables.net/select/1.1.2/js/dataTables.select.min.js" ></script>

<script src="https://cdn.datatables.net/responsive/2.0.2/js/dataTables.responsive.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.js" ></script>>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js" ></script>
  <script src="../plugin/dataTables.altEditor.free.js"></script>

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
	
	var categoryOptions = { "1" : "Professional Services", "2" : "Business and Management" , "3" : "Marketing and Promotion" };
	$(document).ready(function() {
	var data_field = JSON.parse($('#data_field').val());
	   var table = $('#dataTable').DataTable({
		  data:data_field,
		  columns: [
			
			  { title:"ID", data: 'ID' ,type: "readonly"},
			  { title:"Console", data: 'ID',type: "hidden" ,render:function(data, type, row, meta) {
					
					var returnDate = "<a href='hd_details.php?id=" + row['ID'] + "'>Edit</a>";
					return returnDate;
				}	 
			  },
			  { title:"Programme Board EN", data: 'Programme_Board_EN' },
			  { title:"Programme_Board_TC", data: 'Programme_Board_TC' },
			  { title:"Programme_Board_SC", data: 'Programme_Board_SC' },
			  { title:"Programme_Name_EN", data: 'Programme_Name_EN' },
			  { title:"Programme_Name_TC", data: 'Programme_Name_TC' },
			  { title:"Programme_Name_SC", data: 'Programme_Name_SC' },
			  { title:"StreamElective_EN", data: 'StreamElective_EN' },
			  { title:"StreamElective_TC", data: 'StreamElective_TC' },
			  { title:"StreamElective_SC", data: 'StreamElective_SC' },
			  { title:"Programme_Code", data: 'Programme_Code' },
			  { title:"Offering_Campus", data: 'Offering_Campus' },
			  { title:"Programme_Features_EN", data: 'Programme_Features_EN' },
			  { title:"Programme_Features_TC", data: 'Programme_Features_TC' },
			  { title:"Programme_Features_SC", data: 'Programme_Features_SC' },
			  { title:"Career_Prospects_EN", data: 'Career_Prospects_EN' },
			  { title:"Career_Prospects_TC", data: 'Career_Prospects_TC' },
			  { title:"Career_Prospects_SC", data: 'Career_Prospects_SC' },
			  { title:"Professional_Core_Modules_EN", data: 'Professional_Core_Modules_EN' },
			  { title:"Professional_Core_Modules_TC", data: 'Professional_Core_Modules_TC' },
			  { title:"Professional_Core_Modules_SC", data: 'Professional_Core_Modules_SC' },
			  { title:"Professional_Recognition_EN", data: 'Professional_Recognition_EN' },
			  { title:"Professional_Recognition_TC", data: 'Professional_Recognition_TC' },
			  { title:"Professional_Recognition_SC", data: 'Professional_Recognition_SC' },
			  { title:"Contact_Email_Tel", data: 'Contact_Email_Tel' },
			  { title:"Keyword_EN", data: 'Keyword_EN' },
			  { title:"Keyword_TC", data: 'Keyword_TC' },
			  { title:"Keyword_SC", data: 'Keyword_SC' },
			  { title:"Articulation_EN", data: 'Articulation_EN' },
			  { title:"Articulation2_EN", data: 'Articulation2_EN' },
			  { title:"Articulation_TC", data: 'Articulation_TC' },
			  { title:"Articulation_SC", data: 'Articulation_SC' },
			  { title:"Articulation2_TC", data: 'Articulation2_TC' },
			  { title:"Articulation2_SC", data: 'Articulation2_SC' },
			  { title:"Image", data: 'ImageURL' ,
				render:function(data, type, row, meta) {
					//return data;
					
					var returnDate = "<button class='add_img' type='type' data-id='" + row['ID'] + "'>Upload Photo</button>";
					
					var additional_data = "";
					if (row['ImageURL_s'] != '' && row['ImageURL_s'] != null){
						additional_data = "<img src='" + row['ImageURL_s'] + "'>";
						additional_data += "<button class='delete_img' data-url='" + data +"' data-url2='" + row['ImageURL_s'] +"'  data-id='" + row['ID'] + "'>Delete Photo</button>";
						
						returnDate = additional_data;
					}
					
					return returnDate;
				}				
			  },
			  { title:"ImageURL_s", data: 'ImageURL_s'  ,type: "hidden"},
			  /*{ title:"ImageURL_s", data: 'ImageURL_s'  ,type: "hidden",
				render:function(data, type, row, meta) {
					//return data;
					if (data == "" || data == null){
						
					}else{
						
					}
					
					return "<button type='type' data-id='" + row.id + "'>Upload Photo</button>";
				}},*/
			  { title:"Programmes_Category_ID", data: 'Programmes_Category_ID', type:"select", options : categoryOptions, select2 : { width: "100%"}, render: function (data, type, row, meta) {
					if (data == null || !(data in categoryOptions)) return null;
					return categoryOptions[data];
				}
			  }
			  
			  /*{
                "className":      'details-control',
                "orderable":      false,
                "data":           'Details',
                "defaultContent": ''
				},*/
			],
			"columnDefs": [
				{ "type": "html", "targets": 0 },
				{ "visible": false, "targets": 36 }
			  ],
			dom:'Bfrtip',
			select:'single',
			altEditor: true,     // Enable altEditor
          buttons: [{
            text: 'Add',
            name: 'add'        // do not change name
          },
          {
            extend: 'selected', // Bind to Selected row
            text: 'Edit',
            name: 'edit'        // do not change name
          },
          {
            extend: 'selected', // Bind to Selected row
            text: 'Delete',
            name: 'delete'      // do not change name
         }],
		 onAddRow: function(datatable, rowdata, success, error) {
            $.ajax({
                url: 'action/add_hd.php',
				//url: 'action/check_access.php',
				headers: { 'token': '<?php echo $token; ?>' },
                type: 'POST',
                data: rowdata,
				dataType: "json",
                success: function(data){
					if (data.code == "200"){
						success(rowdata);
					} else {
						error();
					}
				},
                error: error
            });
        },
        onDeleteRow: function(datatable, rowdata, success, error) {
            $.ajax({
                url: 'action/delete_hd.php',
				headers: { 'token': '<?php echo $token; ?>' },
                type: 'POST',
                data: rowdata,
				dataType: "json",
                success: function(data){
					if (data.code == "200"){
						success(rowdata);
					} else {
						error();
					}
				},
                error: error
            });
        },
        onEditRow: function(datatable, rowdata, success, error) {
            $.ajax({
                url: 'action/edit_hd.php',
				headers: { 'token': '<?php echo $token; ?>' },
                type: 'POST',
                data: rowdata,
				dataType: "json",
                success: function(data){
					if (data.code == "200"){
						success(rowdata);
					} else {
						error();
					}
				},
                error: error
            });
        }
		 
		 
	  });
	  
	  
	  
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
	  
	  
	  
	  $('table').on('click', 'button.add_img', function() {
		 var id = $(this).data('id');
		  window.open('upload_img.php?id='+id+'&db=ba_programmes_hd', 'Upload Image', config='height=800,width=1000');
		  
	  });
	  
	  $('table').on('click', 'button.delete_img', function() {
		  
		  var id = $(this).data('id');
		  var url = $(this).data('url');
		  var url2 = $(this).data('url2');
		  var db = "ba_programmes_hd";
		  
		if (confirm("Are you sure want to delete photo(& thumbnails)?")) {
			$.ajax({
			url:"action/image_handle.php",
			headers: { 'token': '<?php echo $token; ?>' },
			type: "POST",
			data:{"image_url": url, "image_url_thumb": url2, "type": "delete_img", "id":id, "db":db },
			dataType: "json",
			success:function(data)
			{

			  if (data.status == "success"){
					alert('Photo Delete');
					
				} else {
					alert('delete fail');
					someFunctionToCallWhenPopUpCloses();
					
				}
			},
			error: function(err) {
			   console.log(JSON.stringify(err));
			   someFunctionToCallWhenPopUpCloses();
					
			},
		  });
		  
		  } else {
			console.log('Cancel');
		  }
	  });
	  
	});
	function someFunctionToCallWhenPopUpCloses(){
		window.location.reload();
	}
	function getParam(link, key){
	var url_string = link || window.location.href;
	var url = new URL(url_string);
	var c = url.searchParams.get(key);
	return c;
	}
  </script>
	<input type="hidden" id="data_field" name="data_field" value="<?php echo xss_chk($json); ?>">

</body>

</html>
