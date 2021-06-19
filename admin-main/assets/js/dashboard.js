$('#page-selection').on('change', function() {
	getPagedataAjaxCall(this.value);
});

// +++++++++++++++++++++++++++++++++++++++++++++

$(document).ready(function(){
	getPagedataAjaxCall($('#page-selection').val());
});

// +++++++++++++++++++++++++++++++++++++++++++++

function getPagedataAjaxCall(page_name){

	$.post("controls/get_page_contents",
	{
		page_name: page_name,
	},

	function(data, status){
	    
		if (data !== "") {
			$('.richText-editor').first().html(data);
		}
		else{
			 $('.richText-editor').first().html('<b><center>Ajax request failed.</center></b>')
		}
	});
}

// 000000000000000000000000000000000000000000000000000000000000000000000000000