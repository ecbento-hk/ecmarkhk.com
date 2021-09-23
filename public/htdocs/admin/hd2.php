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
  
  <link rel="stylesheet" href="../plugin/jquery-ui-1.12.1/jquery-ui.min.css">
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
            Search Course</div>
          <div class="card-body">
            <div class="row">
				<div class="col-xl-8 col-sm-8 mb-8" >
					<select class="form-control" id="course_list">
					<option value="-" disabled selected ></option>
				  </select>
				</div>
				<div class="col-xl-4 col-sm-4 mb-4" >
					<button type="button" class="program_add btn btn-primary">Add New</button>
					<button type="button" class="program_delete btn btn-danger disabled">Delete</button>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-12 col-sm-12 mb-12" >
					
					<form method="post" id="save_post_action" class="form-horizontal">
					
					
					<div class="card mb-12">
					  <div class="card-header">
						<i class="fas fa-table"></i>
						Programme</div>
					  <div class="card-body programme">
					
					<div class="all form-group">
						<div class="form-group">
							<input type="hidden" name="ID" class="form-control" value="">
							<label class="col-sm-12 control-label">Programme Code</label>
							<div class="col-sm-10">
								<input type="text" name="Programme_Code" class="form-control" value="" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-12 control-label">Offering Campus</label>
							<div class="col-sm-10">
								<input type="text" name="Offering_Campus" class="form-control" value="" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-12 control-label">Contact Email Tel</label>
							<div class="col-sm-10">
								<input type="text" name="Contact_Email_Tel" class="form-control" value="" required>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-12 control-label">Programme Category</label>
							<div class="col-sm-10">
								<select class="form-control" name="Programmes_Category_ID">
									<option value="1" >Professional Services</option>
									<option value="2" >Business and Management</option>
									<option value="3" >Marketing and Promotion</option>
								</select>
							</div>
						</div>
						
						<div class="form-group uploadPhoto">
							<label class="col-sm-12 control-label">Upload Photo</label>
							<div class="col-sm-10 uploadDiv" >
							
							</div>
						</div>
					</div>
					<div class="programme_tabs form-group" id="programme_tabs">
					
						
					
						<ul>
							<li><a href="#en">EN</a></li>
							<li><a href="#tc">TC</a></li>
							<li><a href="#sc">SC</a></li>
						</ul>
						
						
							
							<div class="en"  id="en">
								<div class="form-group">
									<label class="col-sm-12 control-label">Programme Board EN</label>
									<div class="col-sm-10">
										<input type="text" name="Programme_Board_EN" class="form-control" value="" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-12 control-label">Programme Name EN</label>
									<div class="col-sm-10">
										<input type="text" name="Programme_Name_EN" class="form-control" value="">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-12 control-label">StreamElective EN</label>
									<div class="col-sm-10">
										<input type="text" name="StreamElective_EN" class="form-control" value="">
									</div>
								</div>
								
								
								
								<div class="form-group">
									<label class="col-sm-12 control-label">Programme Features EN</label>
									<div class="col-sm-10">
										
										<textarea name="Programme_Features_EN" id="Programme_Features_EN" class="form-control" rows="10"></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-12 control-label">Career Prospects EN</label>
									<div class="col-sm-10">
										
										<textarea name="Career_Prospects_EN" id="Career_Prospects_EN" class="form-control" rows="10"></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-12 control-label">Professional Core Modules EN</label>
									<div class="col-sm-10">
										
										<textarea name="Professional_Core_Modules_EN" id="Professional_Core_Modules_EN" class="form-control" rows="10"></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-12 control-label">Professional Recognition EN</label>
									<div class="col-sm-10">
										
										<textarea name="Professional_Recognition_EN" id="Professional_Recognition_EN" class="form-control" rows="10"></textarea>
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="col-sm-12 control-label">Keyword EN</label>
									<div class="col-sm-10">
										<input type="text" name="Keyword_EN" class="form-control" value="">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-12 control-label">Articulation EN</label>
									<div class="col-sm-10">
										<input type="text" name="Articulation_EN" class="form-control" value="">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-12 control-label">Articulation2 EN</label>
									<div class="col-sm-10">
										<input type="text" name="Articulation2_EN" class="form-control" value="">
									</div>
								</div>
								
							</div>
							
							<div class="tc"  id="tc">
								
								<div class="form-group">
									<label class="col-sm-12 control-label">Programme Board TC</label>
									<div class="col-sm-10">
										<input type="text" name="Programme_Board_TC" class="form-control" value="">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-12 control-label">Programme Name TC</label>
									<div class="col-sm-10">
										<input type="text" name="Programme_Name_TC" class="form-control" value="">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-12 control-label">StreamElective TC</label>
									<div class="col-sm-10">
										<input type="text" name="StreamElective_TC" class="form-control" value="">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-12 control-label">Programme Features TC</label>
									<div class="col-sm-10">
										
										<textarea name="Programme_Features_TC" id="Programme_Features_TC" class="form-control" rows="10"></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-12 control-label">Career Prospects TC</label>
									<div class="col-sm-10">
										
										<textarea name="Career_Prospects_TC" id="Career_Prospects_TC" class="form-control" rows="10"></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-12 control-label">Professional Core Modules TC</label>
									<div class="col-sm-10">
										
										<textarea name="Professional_Core_Modules_TC" id="Professional_Core_Modules_TC" class="form-control" rows="10"></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-12 control-label">Professional Recognition TC</label>
									<div class="col-sm-10">
										
										<textarea name="Professional_Recognition_TC" id="Professional_Recognition_TC" class="form-control" rows="10"></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-12 control-label">Keyword TC</label>
									<div class="col-sm-10">
										<input type="text" name="Keyword_TC" class="form-control" value="">
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="col-sm-12 control-label">Articulation TC</label>
									<div class="col-sm-10">
										<input type="text" name="Articulation_TC" class="form-control" value="">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-12 control-label">Articulation2 TC</label>
									<div class="col-sm-10">
										<input type="text" name="Articulation2_TC" class="form-control" value="">
									</div>
								</div>
								
							</div>
							
							<div class="sc"  id="sc">
								
								
								<div class="form-group">
									<label class="col-sm-12 control-label">Programme Board SC</label>
									<div class="col-sm-10">
										<input type="text" name="Programme_Board_SC" class="form-control" value="">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-12 control-label">Programme Name SC</label>
									<div class="col-sm-10">
										<input type="text" name="Programme_Name_SC" class="form-control" value="">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-12 control-label">StreamElective SC</label>
									<div class="col-sm-10">
										<input type="text" name="StreamElective_SC" class="form-control" value="">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-12 control-label">Programme Features SC</label>
									<div class="col-sm-10">
										
										<textarea name="Programme_Features_SC" id="Programme_Features_SC" class="form-control" rows="10"></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-12 control-label">Career Prospects SC</label>
									<div class="col-sm-10">
										
										<textarea name="Career_Prospects_SC" id="Career_Prospects_SC" class="form-control" rows="10"></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-12 control-label">Professional Core Modules SC</label>
									<div class="col-sm-10">
										
										<textarea name="Professional_Core_Modules_SC" id="Professional_Core_Modules_SC" class="form-control" rows="10"></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-12 control-label">Professional Recognition SC</label>
									<div class="col-sm-10">
										
										<textarea name="Professional_Recognition_SC" id="Professional_Recognition_SC" class="form-control" rows="10"></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-12 control-label">Keyword SC</label>
									<div class="col-sm-10">
										<input type="text" name="Keyword_SC" class="form-control" value="">
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="col-sm-12 control-label">Articulation SC</label>
									<div class="col-sm-10">
										<input type="text" name="Articulation_SC" class="form-control" value="">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-12 control-label">Articulation2 SC</label>
									<div class="col-sm-10">
										<input type="text" name="Articulation2_SC" class="form-control" value="">
									</div>
								</div>
							</div>
						
					</div>
					
					<div class="form-group" style="display:none;">
					 <input id="program_save_submit" type="submit">
					</div>
					
					<div class="form-group">
						<button type="button" class="program_save btn btn-success">Save</button>
					</div>
					
					</div>
					</div>
					</form>
				</div>
				
			</div>
			  
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

        <p class="small text-center text-muted my-5">
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
  <script src="../plugin/jquery-ui-1.12.1/jquery-ui.min.js" ></script>
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
	
	for (var i = 0; i < data_field.length; i++){
		
		$('#course_list').append($("<option></option>")
                    .attr("value",data_field[i]['ID'])
                    .text(data_field[i]['Programme_Code'] + '-' + data_field[i]['Programme_Name_EN'])); 
	}
	
	$('.program_add').on('click', function(e) {
		e.preventDefault();
		$('.card-body.programme textarea').val('');
		$('.card-body.programme input').val('');
		$('#course_list').val('');
		$('.program_delete').addClass('disabled');
		$('.uploadDiv').html('');
	});
	
	$('select#course_list').on('change', function() {
	  //alert( this.value );
	  var selected_id = this.value;
	  var selected_data = data_field.filter(function(v){ 
			return selected_id == v['ID'];
		});
	  //console.log(selected_data[0]);
	  if (selected_data.length > 0){
		var iData = selected_data[0];
		for (var k in iData){
			var textareafield = $('textarea[name=' + k + ']');
			if (textareafield.length > 0){
				textareafield.val(iData[k]);
			}
			
			var inputfield = $('input[name=' + k + ']');
			if (inputfield.length > 0){
				inputfield.val(iData[k]);
			}
			
			var selectfield = $('select[name=' + k + ']');
			if (selectfield.length > 0){
				selectfield.val(iData[k]);
			}
			
		}
		
		var returnDate = "<button class='add_img' type='type' data-id='" + iData['ID'] + "'>Upload Photo</button>";	
		var additional_data = "";
		if (iData['ImageURL_s'] != '' && iData['ImageURL_s'] != null){
			additional_data = "<img src='" + iData['ImageURL_s'] + "'>";
			additional_data += "<button class='delete_img' data-url='" + iData['ImageURL'] +"' data-url2='" + iData['ImageURL_s'] +"'  data-id='" + iData['ID'] + "'>Delete Photo</button>";
			
			returnDate = additional_data;
		}
		$('.uploadDiv').html('');
		$('.uploadDiv').append(returnDate);
		
		
		$('.program_delete').removeClass('disabled');
		
	  }
	  
	});
	  
	$( "#programme_tabs" ).tabs();
	
	
	$('body').on('click', 'button.program_save', function(e) {
		e.preventDefault();
		var id = $('input[name=ID]').val();
		if ($('input[name=Programme_Code]').val() != '' && $('input[name=Offering_Campus]').val() != '' && $('input[name=Contact_Email_Tel]').val() != ''){
			let required_warning = false;
			let rowdata = {};
			$('#save_post_action').find('input').each(function(e){
				var key = $(this).attr('name');
				rowdata[key] = $(this).val();
				if ($(this).prop('required') && $(this).val().trim() == ''){
					required_warning = true;
				}
			});
			
			$('#save_post_action').find('textarea').each(function(e){
				var key = $(this).attr('name');
				rowdata[key] = $(this).val();
				if ($(this).prop('required') && $(this).val().trim() == ''){
					required_warning = true;
				}
			});
			
			$('#save_post_action').find('select').each(function(e){
				var key = $(this).attr('name');
				rowdata[key] = $(this).val();
				if ($(this).prop('required') && $(this).val().trim() == ''){
					required_warning = true;
				}
			});
			
			if (required_warning){
				$('#program_save_submit').click();
			}else{
			
			if (id){
				$.ajax({
					url: 'action/edit_hd.php',
					headers: { 'token': '<?php echo $token; ?>' },
					type: 'POST',
					data: rowdata,
					dataType: "json",
					success: function(data){
						if (data.code == "200"){
							alert('Programme Data Updated');
						} else {
							console.log(data);
						}
					},
					error: function(err){
						console.log(err);
					}
				});
				
			}else{
				$.ajax({
					url: 'action/add_hd.php',
					headers: { 'token': '<?php echo $token; ?>' },
					type: 'POST',
					data: rowdata,
					dataType: "json",
					success: function(data){
						if (data.code == "200"){
							alert('Programme Data Updated');
						} else {
							console.log(data);
						}
					},
					error: function(err){
						console.log(err);
					}
				});
				
			}
			
			}
			
			
		}else{
			alert('Insert Required Data.')
		
		}
	});
	
	
	$('body').on('click', 'button.program_delete', function(e) {
		e.preventDefault();
		if (!$('.program_delete').hasClass('disabled') ){
			var id = $('input[name=ID]').val();
			var rowdata = {'ID' : $('#course_list').val()};
			if (id){
				$.ajax({
					url: 'action/delete_hd.php',
					headers: { 'token': '<?php echo $token; ?>' },
					type: 'POST',
					data: rowdata,
					dataType: "json",
					success: function(data){
						if (data.code == "200"){
							alert('Programme Data Delete');
						} else {
							console.log(data);
						}
					},
					error: function(err){
						console.log(err);
					}
				});
				
			}else{
				
				alert('Please select to delete');
				
			}
			
			
		}
	});
	
	
	$('body').on('click', 'button.add_img', function(e) {
		e.preventDefault();
		 var id = $(this).data('id');
		  window.open('upload_img.php?id='+id+'&db=ba_programmes_hd', 'Upload Image', config='height=800,width=1000');
		  
	  });
	  
	  $('body').on('click', 'button.delete_img', function(e) {
		  e.preventDefault();
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
