<?php
header("Content-Type: text/html;charset=utf-8");   
require_once('../conn/db.php');
require_once('check_status.php');

$token = md5(rand(1000,9999)); //you can use any encryption
$_SESSION['page_token'] = $token; //store it as session variable

?>
<html>  
    <head>  
        <title>Upload Image</title>  
		
		<script src="vendor/upload-and-crop-image/jquery.min.js"></script>  
		<script src="vendor/upload-and-crop-image/bootstrap.min.js"></script>
		<script src="vendor/upload-and-crop-image/croppie.js"></script>
		<link rel="stylesheet" href="vendor/upload-and-crop-image/bootstrap.min.css" />
		<link rel="stylesheet" href="vendor/upload-and-crop-image/croppie.css" />
    </head>  
    <body>  
        <div class="container">
          <br />
      <h3 align="center">Image Crop & Upload</h3>
      <br />
      <br />
			<div class="panel panel-default">
  				<div class="panel-heading">Select Image</div>
  				<div class="panel-body" align="center">
  					<input type="file" name="upload_image" id="upload_image" />
  					<br />
  					<div id="uploaded_image"></div>
  				</div>
  			</div>
  		</div>
    </body>  
</html>


<div id="uploadimageModal" class="modal" role="dialog">
	<div class="modal-dialog" style="width:1200px; height:1100px;">
		<div class="modal-content">
      		<div class="modal-header">
        		
        		<h4 class="modal-title">Upload & Crop Image</h4>
      		</div>
      		<div class="modal-body">
        		<div class="row">
  					<div class="col-md-12 text-center">
						  <div id="image_demo" style="width:800px; margin-top:30px"></div>
  					</div>
  					<div class="col-md-12" style="padding-top:30px;">
  						<br />
  						<br />
  						<br/>
						  <button class="btn btn-success crop_image">Crop & Upload Image</button>
					</div>
				</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      		</div>
    	</div>
    </div>
</div>

<div id="uploadimageThumbnailsModal" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
      		<div class="modal-header">
        		
        		<h4 class="modal-title">Upload & Crop Thumbnails Image</h4>
      		</div>
      		<div class="modal-body">
        		<div class="row">
  					<div class="col-md-12 text-center">
						  <div id="image_demo_thumbnail" style="width:350px; margin-top:30px"></div>
  					</div>
  					<div class="col-md-12" style="padding-top:30px;">
  						<br />
  						<br />
  						<br/>
						  <button class="btn btn-success crop_image2">Crop & Upload Image</button>
					</div>
				</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      		</div>
    	</div>
    </div>
</div>

<script>  
$(document).ready(function(){
	var id = getParam(null,'id');
	var db = getParam(null,'db');
	
  
  $image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:1040,
      height:580,
      type:'square' //circle
    },
    boundary:{
      width:1100,
      height:1100,
    },
	showZoomer: true,
    //enableResize: true,
    enableOrientation: true,
    //mouseWheelZoom: 'ctrl'
  });
  
  $image_crop2 = $('#image_demo_thumbnail').croppie({
    enableExif: true,
    viewport: {
      width:373,
      height:373,
      type:'square' //circle
    },
    boundary:{
      width:500,
      height:500,
    },
	showZoomer: true,
    //enableResize: true,
    enableOrientation: true,
    //mouseWheelZoom: 'ctrl'
  });
  

  $('#upload_image').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
	  
	  $image_crop2.croppie('bind', {
        url: event.target.result
      }).then(function(){
		  $('#uploadimageThumbnailsModal').css('display','none');
        console.log('jQuery 2 bind complete');
      });
	  
	  
	  
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal').modal('show');
	$('#uploadimageThumbnailsModal').modal('show');
  });

  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport',
	  format: 'jpeg'
    }).then(function(response){
      $.ajax({
        url:"action/image_handle.php",
		headers: { 'token': '<?php echo $token; ?>' },
        type: "POST",
        data:{"image": response, "type": "add_img", "id":id, "db":db, "thumb": "false"  },
		dataType: "json",
        success:function(data)
        {
          //$('#uploadimageModal').modal('hide');
          //$('#uploaded_image').html(data);
		  if (data.status == "success"){
				alert('Image Uploaded, please also upload select thumbnail');
				
				$('#uploadimageModal').css('display','none');
				$('#uploadimageThumbnailsModal').css('display','block');
				//self.close();
				window.opener.setAddImg(data.image);
			} else {
				alert('upload fail');
				self.close();
			}
        },
		error: function() {
           alert(err);
				self.close();
        },
      });
    })
  });
  
  
  $('.crop_image2').click(function(event){
    $image_crop2.croppie('result', {
      type: 'canvas',
      size: 'viewport',
	  format: 'jpeg'
    }).then(function(response){
      $.ajax({
        url:"action/image_handle.php",
		headers: { 'token': '<?php echo $token; ?>' },
        type: "POST",
        data:{"image": response, "type": "add_img", "id":id, "db":db, "thumb": "true" },
		dataType: "json",
        success:function(data)
        {
          //$('#uploadimageModal').modal('hide');
          //$('#uploaded_image').html(data);
		  if (data.status == "success"){
				alert('Image Uploaded.');
				window.opener.setAddThumbImg(data.image);
				self.close();
			} else {
				alert('upload fail');
				self.close();
			}
        },
		error: function() {
           alert(err);
				self.close();
        },
      });
    })
  });

});  
window.onunload = function() {
var win = window.opener;
if (!win.closed) {
	//win.someFunctionToCallWhenPopUpCloses();
}
};
function getParam(link, key){
var url_string = link || window.location.href;
var url = new URL(url_string);
var c = url.searchParams.get(key);
return c;
}
</script>