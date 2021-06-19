<?php 
include('layouts/header.php'); 
include("../db_config/db_config.php");
include('../functions/db_functions.php'); 
include('admin_functions/db_functions.php'); 
?>


<section>
	
	<h1 class="section-title">Visitors Monitor</h1>

	<div class="visitor-monitor-card-container">
		
		<div class="visitor-monitor-card">
			<div class="total-visitor"><?=getTodaysVisitors();?></div>
			<div class="visitor-card-footer">Today</div>
		</div>
		
		<div class="visitor-monitor-card">
			<div class="total-visitor"><?=getYesterdaysVisitors();?></div>
			<div class="visitor-card-footer">Yesterday</div>
		</div>
		
		<div class="visitor-monitor-card">
			<div class="total-visitor"><?=getThisMonthVisitors();?></div>
			<div class="visitor-card-footer">This Month</div>
		</div>
		
		<div class="visitor-monitor-card">
			<div class="total-visitor"><?=getLastMonthVisitors();?></div>
			<div class="visitor-card-footer">Last Month</div>
		</div>
		
		<div class="visitor-monitor-card">
			<div class="total-visitor"><?=getThisYearVisitors();?></div>
			<div class="visitor-card-footer">This Year</div>
		</div>
		
		<div class="visitor-monitor-card">
			<div class="total-visitor"><?=getLastYearVisitors();?></div>
			<div class="visitor-card-footer">Last Year</div>
		</div>

	</div>

</section>


<section>
	
	<h1 class="section-title">Change Logos</h1>

	<div class="change-logo-container">
		
		<div class="logo-changer-div">
			<div class="logo-img-div">
				<img src="../assets/logo/logo-main.png" />
			</div>
			<div class="logo-change-btn-container">
				<button type="button" id="change-home-logo" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#change-home-page-logo">Change Home Page Logo</button>
			</div>
		</div>	
		<div class="logo-changer-div">
			<div class="logo-img-div">
				<img src="../assets/logo/logo-side.png" />
			</div>
			<div class="logo-change-btn-container">
				<button type="button" id="change-search-logo" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#change-search-page-logo">Change Search Page Logo</button>
			</div>
		</div>	

	</div>

</section>


<section>
	
	<h1 class="section-title">Change Site Icon</h1>

	<form method="post" action="controllers/login-action" enctype="multipart/form-data" id="icon-change-form">
		<div class="mb-3">
		  <label class="form-label">Change Icon (Only .ico accepted):</label>
			<input type="file" id="icon-input" accept="image/x-icon" name="search-box-placeholder" class="form-control" >
			<div id="upload-notification-div3"></div>
		</div>
		<div class="mb-3">
		  <button type="submit" id="icon-logo-upload-btn" class="form-control-lg btn btn-primary">Submit</button>
		</div>
	</form>

</section>


<section>
	
	<h1 class="section-title">Meta Info</h1>

	<form method="post" action="controllers/login-action" id="meta-info-change-form">
		<div class="mb-3">
		  <label class="form-label">Wesite Title:</label>
			<input type="text" placeholder="Type your search engine meta title" name="site_title" class="form-control" value="<?php if(isset(getSiteMetaInfo()['site_title'])){echo getSiteMetaInfo()['site_title'];}?>" />
		</div>
		<div class="mb-3">
		  <label class="form-label">Meta Description:</label>
		  <textarea placeholder="Type your search engine meta description" name="site_description" class="form-control" rows="3"><?php if(isset(getSiteMetaInfo()['site_description'])){echo getSiteMetaInfo()['site_description'];}?></textarea>
		</div>
		<div class="mb-3">
		  <label class="form-label">Meta Keywords:</label>
		  <textarea placeholder="Type your search engine meta keywords" name="site_keywords" class="form-control" rows="3"><?php if(isset(getSiteMetaInfo()['site_keywords'])){echo getSiteMetaInfo()['site_keywords'];}?></textarea>
		</div>
		<div id="meta-notifiaction-div"></div>
		<div class="mb-3">
		  <button type="submit" id="meta-submit-btn" class="form-control-lg btn btn-primary">Submit</button>
		</div>
	</form>

</section>


<section>
	
	<h1 class="section-title">Placeholder</h1>

	<form method="post" action="controllers/login-action" id="placeholder-change-form">
		<div class="mb-3">
			<label class="form-label">Change Search Bar Placeholder:</label>
			<input type="text" placeholder="Type a placeholder that you like to show into the search field..." name="search-box-placeholder" class="form-control" value="<?php getSiteSearchBarPlaceholder();?>" />
		</div>
		<div id="placeholder-notifiaction-div"></div>
		<div class="mb-3">
		  	<button type="submit" id="placeholder-submit-btn" class="form-control-lg btn btn-primary">Submit</button>
		</div>
	</form>

</section>


<section>
	
	<h1 class="section-title">Footer Social Links</h1>

	<form method="post" action="controllers/login-action" id="social-link-change-form">
		<div class="mb-3">
		  <label class="form-label">Facebook:</label>
		  <div class="input-group mb-3">
			  <span class="input-group-text" id="basic-addon3">https://facebook.com/</span>
			  <input type="text" placeholder="TeamHiddenPirates" name="facebook_user_id" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="<?php if(getSocialLinks()['facebook'] !== "no link"){echo getSocialLinks()['facebook'];}?>">
		  </div>
		</div>
		<div class="mb-3">
		  <label class="form-label">Instagram:</label>
		  <div class="input-group mb-3">
			  <span class="input-group-text" id="basic-addon3">https://instagram.com/</span>
			  <input type="text" placeholder="" name="instagram_user_id" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="<?php if(getSocialLinks()['instagram'] !== "no link"){echo getSocialLinks()['instagram'];}?>">
		  </div>
		</div>
		<div class="mb-3">
		  <label class="form-label">YouTube:</label>
		  <div class="input-group mb-3">
			  <span class="input-group-text" id="basic-addon3">https://youtube.com/</span>
			  <input type="text" name="youtube_user_id" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="<?php if(getSocialLinks()['youtube'] !== "no link"){echo getSocialLinks()['youtube'];}?>">
		  </div>
		</div>
		<div class="mb-3">
		  <label class="form-label">GitHub:</label>
		  <div class="input-group mb-3">
			  <span class="input-group-text" id="basic-addon3">https://github.com/</span>
			  <input type="text" placeholder="HiddenPirates" name="github_user_id" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="<?php if(getSocialLinks()['github'] !== "no link"){echo getSocialLinks()['github'];}?>">
		  </div>
		</div>
		<div id="social-link-change-notification-div"></div>
		<div class="mb-3">
		  <button type="submit" id="social-link-change-submit-btn" class="form-control-lg btn btn-primary">Update</button>
		</div>
	</form>

</section>


<section>
	
	<h1 class="section-title">Update Username And Password</h1>

	<form method="post" action="controls/update_admin_login_data" id="password-change-form">
		<div class="mb-3">
		  <div class="input-group mb-3">
			  <span class="input-group-text" id="basic-addon3">Current Username:</span>
			  <input type="text" name="old_username" class="form-control" id="basic-url" aria-describedby="basic-addon3">
		  </div>
		</div>
		<div class="mb-3">
		  <div class="input-group mb-3">
			  <span class="input-group-text" id="basic-addon3">Current Password:</span>
			  <input type="text" name="old_password" class="form-control" id="basic-url" aria-describedby="basic-addon3">
		  </div>
		</div>
		<div class="mb-3">
		  <div class="input-group mb-3">
			  <span class="input-group-text" id="basic-addon3">New Username:</span>
			  <input type="text" name="new_username" class="form-control" id="basic-url" aria-describedby="basic-addon3">
		  </div>
		</div>
		<div class="mb-3">
		  <div class="input-group mb-3">
			  <span class="input-group-text" id="basic-addon3">New Paswword:</span>
			  <input type="text" name="new_password" class="form-control" id="basic-url" aria-describedby="basic-addon3">
		  </div>
		</div>
		<div id="password-change-notification-div"></div>
		<div class="mb-3">
		  <button type="submit" id="password-change-submit-btn" class="form-control-lg btn btn-primary">Update</button>
		</div>
	</form>

</section>



<section>
	
	<h1 class="section-title">Update Pages</h1>

	<form method="post" action="controls/update_pages" id="page-update-form">
		<div class="mb-3">
		  <label class="form-label" id="basic-addon3">Select Page:</label>
		  <select class="form-select" id="page-selection" name="page_name" aria-label="Default select example">
			  <option value="about" selected>About</option>
			  <option value="contact">Contact</option>
			  <option value="privacy">Privacy</option>
		  </select>
		</div>
		<div class="mb-3">
			<label class="form-label" id="basic-addon3">Type Contents:</label>
			<textarea placeholder="" id="page_editor_textarea" name="page_contents" class="form-control" rows="20" placeholder=""></textarea>
		</div>
		<div id="page-update-notification-div"></div>
		<div class="mb-3">
		  <button type="submit" id="page-update-submit-btn" class="form-control-lg btn btn-primary">Update</button>
		</div>
	</form>

</section>



<div class="mt-4"></div>	

<script src="assets/js/ajax-requests.js"></script>
<script src="assets/js/rich-text-editor.js"></script>
<script src="assets/js/dashboard.js"></script>


<?php include('layouts/footer.php'); ?>