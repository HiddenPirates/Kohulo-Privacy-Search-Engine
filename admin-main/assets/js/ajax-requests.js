// icon change ajax   |
// --------------------

$('#icon-change-form').submit(function(e){

	e.preventDefault();
	$('#icon-logo-upload-btn').text("Submitting...").prop('disabled', true);

	var file_data = $('#icon-input').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('icon', file_data);

    $.ajax({
        url: 'controls/icon-change', 
        dataType: 'text',  // <-- what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(php_script_response){
            $('#upload-notification-div3').html(php_script_response);
        }
     }).done(function(){
     	$('#icon-logo-upload-btn').text("Submit").prop('disabled', false);
     });
});




// metainfo change
// ---------------------

$('#meta-info-change-form').submit(function(e){

    e.preventDefault();
    $('#meta-submit-btn').text("Submitting...").prop('disabled', true);

    $.ajax({
        dataType: 'text',
        type : 'POST',
        url : 'controls/meta_info_update',
        data : $('#meta-info-change-form').serialize(),
        success: function(php_script_response){
            $('#meta-notifiaction-div').html(php_script_response);
        }
    }).done(function(){
        $('#meta-submit-btn').text("Submit").prop('disabled', false);
     });

});




// placeholder change
// ---------------------

$('#placeholder-change-form').submit(function(e){

    e.preventDefault();
    $('#placeholder-submit-btn').text("Submitting...").prop('disabled', true);

    $.ajax({
        dataType: 'text',
        type : 'POST',
        url : 'controls/placeholder_update',
        data : $(this).serialize(),
        success: function(php_script_response){
            $('#placeholder-notifiaction-div').html(php_script_response);
        }
    }).done(function(){
        $('#placeholder-submit-btn').text("Submit").prop('disabled', false);
     });

});




// password change
// ---------------------

$('#password-change-form').submit(function(e){

    e.preventDefault();
    $('#password-change-submit-btn').text("Updating...").prop('disabled', true);

    $.ajax({
        dataType: 'text',
        type : 'POST',
        url : 'controls/update_admin_login_data',
        data : $(this).serialize(),
        success: function(php_script_response){
            $('#password-change-notification-div').html(php_script_response);
        }
    }).done(function(){
        $('#password-change-submit-btn').text("Update").prop('disabled', false);
     });

});




// social link change
// ---------------------

$('#social-link-change-form').submit(function(e){

    e.preventDefault();
    $('#social-link-change-submit-btn').text("Updating...").prop('disabled', true);

    $.ajax({
        dataType: 'text',
        type : 'POST',
        url : 'controls/update_social_links',
        data : $(this).serialize(),
        success: function(php_script_response){
            $('#social-link-change-notification-div').html(php_script_response);
        }
    }).done(function(){
        $('#social-link-change-submit-btn').text("Update").prop('disabled', false);
     });

});




// page-add/update
// ---------------------

$('#page-update-form').submit(function(e){

    e.preventDefault();
    $('#page-update-submit-btn').text("Updating...").prop('disabled', true);

    $.ajax({
        dataType: 'text',
        type : 'POST',
        url : 'controls/update_pages',
        data : $(this).serialize(),
        success: function(php_script_response){
            $('#page-update-notification-div').html(php_script_response);
        }
    }).done(function(){
        $('#page-update-submit-btn').text("Update").prop('disabled', false);
     });

});