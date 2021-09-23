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
		  
		  <?php 
								if (isset($_POST['update'])){
									if (($_POST['title_en'] != "") && ($_POST['content_en'] != "")){
										
										$type_id = 1;
										$query_webcontent_edit = "UPDATE ba_page_content SET Page_Title_EN=:Page_Title_EN, Page_Content_EN=:Page_Content_EN, Page_Title_TC=:Page_Title_TC, Page_Content_TC=:Page_Content_TC, Page_Title_SC=:Page_Title_SC, Page_Content_SC=:Page_Content_SC  WHERE ID=:ID";
										$webcontent_edit = $conn->prepare($query_webcontent_edit);
										$webcontent_edit -> bindParam(':Page_Title_EN', $_POST['title_en'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Page_Content_EN', $_POST['content_en'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Page_Title_TC', $_POST['title_tc'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Page_Content_TC', $_POST['content_tc'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Page_Title_SC', $_POST['title_sc'], PDO::PARAM_STR);
										$webcontent_edit -> bindParam(':Page_Content_SC', $_POST['content_sc'], PDO::PARAM_STR);
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
								?>
		  
		  
            <?php
			
			$title_en = "";
			$content_en = "";
			$title_tc = "";
			$content_tc = "";
			$title_sc = "";
			$content_sc = "";
			
			$type_id = 1;
			$query_websitecontent = "SELECT * FROM ba_page_content where ID=:ID";
			$websitecontent = $conn->prepare($query_websitecontent);
			
			$websitecontent -> bindParam(':ID', $type_id, PDO::PARAM_STR);
			$websitecontent->execute();
			$totalRows_websitecontent = $websitecontent -> rowCount();
			$row_websitecontent = $websitecontent -> fetch(PDO::FETCH_ASSOC);
			
			
			
			
			
			
			if ($totalRows_websitecontent != 0){
				$title_en = $row_websitecontent['Page_Title_EN'];
				$content_en = $row_websitecontent['Page_Content_EN'];
				$title_tc = $row_websitecontent['Page_Title_TC'];
				$content_tc = $row_websitecontent['Page_Content_TC'];
				$title_sc = $row_websitecontent['Page_Title_SC'];
				$content_sc = $row_websitecontent['Page_Content_SC'];
			}
			
			?>
			<div class="panel panel-default">
							<div class="panel-heading"> </div>
							<div class="panel-body">
								<form method="post" class="form-horizontal">
                                
								
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="title_en" class="form-control" value="<?php echo xss_htmlpurifier($title_en); ?>">
                                        </div>
									</div>
                                    
                                    <div class="hr-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">標題</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="title_tc" class="form-control" value="<?php echo xss_htmlpurifier($title_tc); ?>">
                                        </div>
									</div>
                                    
									
                                    <div class="hr-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">标题</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="title_sc" class="form-control" value="<?php echo xss_htmlpurifier($title_sc); ?>">
                                        </div>
									</div>
                                    
									
									
									<div class="hr-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Content</label>
										<div class="col-sm-10">
											<textarea name="content_en" id="content_en" class="form-control" rows="10"><?php echo xss_htmlpurifier($content_en); ?></textarea>
										</div>
									</div>
                                    
                                    
									<div class="hr-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">內容</label>
										<div class="col-sm-10">
											<textarea name="content_tc" id="content_tc" class="form-control" rows="10"><?php echo xss_htmlpurifier($content_tc); ?></textarea>
										</div>
									</div>
                                    
                                    
									<div class="hr-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">内容</label>
										<div class="col-sm-10">
											<textarea name="content_sc" id="content_sc" class="form-control" rows="10"><?php echo xss_htmlpurifier($content_sc); ?></textarea>
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
		selector: "textarea#content_en",
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
		content_css: "../css/main.css,../css/ourvision.css",
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
	
	tinymce.execCommand('mceAddEditor', false, 'content_tc');
	tinymce.execCommand('mceAddEditor', false, 'content_sc');
	
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
	
	var categoryOptions = { "1" : "Professional Services", "2" : "Business and Management" , "3" : "Marketing and Promotion" };
	$(document).ready(function() {
	var data_field = JSON.parse($('#data_field').val());
	   var table = $('#dataTable').DataTable({
		  data:data_field,
		  columns: [
			
			  { title:"ID", data: 'ID' ,type: "readonly"},
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
			  { title:"ImageURL", data: 'ImageURL' },
			  { title:"ImageURL_s", data: 'ImageURL_s' },
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
				{ "type": "html", "targets": 0 }
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
	  
	  
	  
	  
	  
	  
	  
	});
  
  </script>
	<input type="hidden" id="data_field" name="data_field" value="<?php echo xss_chk($json); ?>">

</body>

</html>
