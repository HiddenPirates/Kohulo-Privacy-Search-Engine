
<!-- Modal -->
<div class="modal fade" id="change-home-page-logo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form action="controls/logo-change.php" method="post" enctype="multipart/form-data" id="index-page-logo-form">
	      <div class="modal-header bg-primary">
	        <h5 class="modal-title" style="color: #fff; font-weight: bold;">Change Home Page Logo (Only PNG)</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	      	<input type="hidden" name="page" value="index" />
	        <input type="file" name="logo" id="index-page-logo" accept="image/png" class="form-control" />
	        <div id="upload-notification-div1"></div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	        <button id="index-logo-upload-btn" type="submit" class="btn btn-primary">Upload</button>
	      </div>
      	</form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="change-search-page-logo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form action="controllers/change-logo-action.php" method="post" enctype="multipart/form-data" id="search-page-logo-form">
	      <div class="modal-header bg-primary">
	        <h5 class="modal-title" style="color: #fff; font-weight: bold;">Change Search Page Logo (Only PNG)</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	      	<input type="hidden" name="page" value="search" />
	        <input type="file" name="logo" id="search-page-logo" accept="image/png" class="form-control" />
	        <div id="upload-notification-div2"></div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	        <button id="search-logo-upload-btn" type="submit" class="btn btn-primary">Upload</button>
	      </div>
      	</form>
    </div>
  </div>
</div>




<script>
	$('#index-page-logo-form').submit(function(e){

		e.preventDefault();
		$('#index-logo-upload-btn').text("Uploading...").prop('disabled', true);

		var file_data = $('#index-page-logo').prop('files')[0];   
	    var form_data = new FormData();                  
	    form_data.append('logo', file_data);
	    form_data.append('page', "index");

	    $.ajax({
	        url: 'controls/logo-change', 
	        dataType: 'text',  // <-- what to expect back from the PHP script, if anything
	        cache: false,
	        contentType: false,
	        processData: false,
	        data: form_data,                         
	        type: 'post',
	        success: function(php_script_response){
	            $('#upload-notification-div1').html(php_script_response);
	        }
	     }).done(function(){
	     	$('#index-logo-upload-btn').text("Upload").prop('disabled', false);
	     });

	});



	$('#search-page-logo-form').submit(function(e){

		e.preventDefault();
		$('#search-logo-upload-btn').text("Uploading...").prop('disabled', true);

		var file_data = $('#search-page-logo').prop('files')[0];   
	    var form_data = new FormData();                  
	    form_data.append('logo', file_data);
	    form_data.append('page', "search");

	    $.ajax({
	        url: 'controls/logo-change', 
	        dataType: 'text',  // <-- what to expect back from the PHP script, if anything
	        cache: false,
	        contentType: false,
	        processData: false,
	        data: form_data,                         
	        type: 'post',
	        success: function(php_script_response){
	            $('#upload-notification-div2').html(php_script_response);
	        }
	     }).done(function(){
	     	$('#search-logo-upload-btn').text("Upload").prop('disabled', false);
	     });

	});

</script>







	</div>
</body>
</html>