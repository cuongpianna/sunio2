jQuery(document).ready(function($){var d=jQuery(".ced").attr("data-rows"),r=3.8/d*4,u=2.992/d*4,c=76/d;jQuery("div.ced ul.products li.product").css("width",c+"%"),jQuery("div.ced ul.products li.product").css("margin","0 "+r+"% "+u+"em 0")
jQuery('#wramvp_img_send_email').click(function(e) {
			e.preventDefault();
			jQuery(".wramvp_img_email_image p").removeClass("wramvp_email_image_error");
			jQuery(".wramvp_img_email_image p").removeClass("wramvp_email_image_success");

			jQuery(".wramvp_img_email_image p").html("");
			var email = jQuery('.wramvp_img_email_field').val();
			jQuery("#wramvp_loader").removeClass("hide");
			jQuery("#wramvp_loader").addClass("dislay");
			$.ajax({
		        type:'POST',
		        url :ajax_url,
		        data:{action:'wramvp_send_mail',flag:true,emailid:email},
		        success:function(data)
		        {
					var new_data = JSON.parse(data);
					jQuery("#wramvp_loader").removeClass("dislay");
					jQuery("#wramvp_loader").addClass("hide");
					if(new_data['status']==true)
			        {
						jQuery(".wramvp_img_email_image p").addClass("wramvp_email_image_success");
						jQuery(".wramvp_img_email_image p").html(new_data['msg']);
			        }
			        else
			        {
			        	jQuery(".wramvp_img_email_image p").addClass("wramvp_email_image_error");
						jQuery(".wramvp_img_email_image p").html(new_data['msg']);
			        }
		        }
	    	});
		});
});