jQuery(document).ready(function ($) {
	$("#ced_wrvp_roles").select2(); 
	$("#ced_wmvp_roles").select2(); 

	$( document.body ).on( "click", function() {
		$("#ced_wrvp_roles").select2();
		$("#ced_wmvp_roles").select2();
	});
});