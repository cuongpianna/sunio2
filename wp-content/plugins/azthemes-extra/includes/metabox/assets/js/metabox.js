( function( $ ) {
	"use strict";

	$( document ).on( 'ready', function() {

		// Show/hide both sidebars options
		var bothSidebarsField       = $( '#butterbean-control-sunio_post_layout select' ),
			bothSidebarsFieldVal  	= bothSidebarsField.val(),
			bothSidebarsSetting 	= $( '#butterbean-control-sunio_both_sidebars_style, #butterbean-control-sunio_both_sidebars_content_width, #butterbean-control-sunio_both_sidebars_sidebars_width, #butterbean-control-sunio_second_sidebar' );

		bothSidebarsSetting.hide();

		if ( bothSidebarsFieldVal === 'both-sidebars' ) {
			bothSidebarsSetting.show();
		}

		bothSidebarsField.change( function () {

			bothSidebarsSetting.hide();

			if ( $( this ).val() == 'both-sidebars' ) {
				bothSidebarsSetting.show();
			}

		} );

		// Show/hide header options
		var headerField          	= $( '#butterbean-control-sunio_display_header .buttonset-input' ),
			headerMainSettings   	= $( '#butterbean-control-sunio_header_style' );

		if ( $( '#butterbean-control-sunio_display_header #butterbean_sunio_mb_settings_setting_sunio_display_header_off' ).is( ':checked' ) ) {
			headerMainSettings.hide();
		} else {
			headerMainSettings.show();
		}

		headerField.change( function () {

			if ( $( this ).val() === 'off' ) {
				headerMainSettings.hide();
			} else {
				headerMainSettings.show();
			}

		} );

		// Show/hide custom header template field
		var headerStyleField        = $( '#butterbean-control-sunio_header_style select' ),
			headerStyleFieldVal  	= headerStyleField.val(),
			customHeaderSetting 	= $( '#butterbean-control-sunio_custom_header_template' );

		customHeaderSetting.hide();

		if ( headerStyleFieldVal === 'custom' ) {
			customHeaderSetting.show();
		}

		if ( $( '#butterbean-control-sunio_display_header #butterbean_sunio_mb_settings_setting_sunio_display_header_off' ).is( ':checked' ) ) {
			customHeaderSetting.hide();
		}

		headerField.change( function () {

			if ( $( this ).val() === 'off' ) {
				customHeaderSetting.hide();
			} else {
				var headerStyleFieldVal = headerStyleField.val();

				if ( headerStyleFieldVal === 'custom' ) {
					customHeaderSetting.show();
				}
			}

		} );

		headerStyleField.change( function () {

			customHeaderSetting.hide();

			if ( $( this ).val() == 'custom' ) {
				customHeaderSetting.show();
			}

		} );

		// Show/hide left menu for center header style
		var leftMenuSetting = $( '#butterbean-control-sunio_center_header_left_menu' );

		leftMenuSetting.hide();

		if ( headerStyleFieldVal === 'center' ) {
			leftMenuSetting.show();
		}

		if ( $( '#butterbean-control-sunio_display_header #butterbean_sunio_mb_settings_setting_sunio_display_header_off' ).is( ':checked' ) ) {
			leftMenuSetting.hide();
		}

		headerField.change( function () {

			if ( $( this ).val() === 'off' ) {
				leftMenuSetting.hide();
			} else {
				var headerStyleFieldVal = headerStyleField.val();

				if ( headerStyleFieldVal === 'center' ) {
					leftMenuSetting.show();
				}
			}

		} );

		headerStyleField.change( function () {

			leftMenuSetting.hide();

			if ( $( this ).val() == 'center' ) {
				leftMenuSetting.show();
			}

		} );

		// Show/hide title options
		var titleField          	= $( '#butterbean-control-sunio_disable_title .buttonset-input' ),
			titleMainSettings   	= $( '#butterbean-control-sunio_disable_heading, #butterbean-control-sunio_post_title, #butterbean-control-sunio_post_subheading, #butterbean-control-sunio_post_title_style' ),
			titleStyleField     	= $( '#butterbean-control-sunio_post_title_style select' ),
			titleStyleFieldVal  	= titleStyleField.val(),
			pageTitleBgSettings 	= $( '#butterbean-control-sunio_post_title_background, #butterbean-control-sunio_post_title_bg_image_position, #butterbean-control-sunio_post_title_bg_image_attachment, #butterbean-control-sunio_post_title_bg_image_repeat, #butterbean-control-sunio_post_title_bg_image_size, #butterbean-control-sunio_post_title_height, #butterbean-control-sunio_post_title_bg_overlay, #butterbean-control-sunio_post_title_bg_overlay_color' ),
			solidColorElements  	= $( '#butterbean-control-sunio_post_title_background_color' );

		pageTitleBgSettings.hide();
		solidColorElements.hide();

		if ( titleStyleFieldVal === 'background-image' ) {
			pageTitleBgSettings.show();
		} else if ( titleStyleFieldVal === 'solid-color' ) {
			solidColorElements.show();
		}

		if ( $( '#butterbean-control-sunio_disable_title #butterbean_sunio_mb_settings_setting_sunio_disable_title_on' ).is( ':checked' ) ) {
			titleMainSettings.hide();
			pageTitleBgSettings.hide();
			solidColorElements.hide();
		} else {
			titleMainSettings.show();
		}

		titleField.change( function () {

			if ( $( this ).val() === 'on' ) {
				titleMainSettings.hide();
				pageTitleBgSettings.hide();
				solidColorElements.hide();
			} else {
				titleMainSettings.show();
				var titleStyleFieldVal = titleStyleField.val();

				if ( titleStyleFieldVal === 'background-image' ) {
					pageTitleBgSettings.show();
				} else if ( titleStyleFieldVal === 'solid-color' ) {
					solidColorElements.show();
				}
			}

		} );

		titleStyleField.change( function () {

			pageTitleBgSettings.hide();
			solidColorElements.hide();

			if ( $( this ).val() == 'background-image' ) {
				pageTitleBgSettings.show();
			} else if ( $( this ).val() === 'solid-color' ) {
				solidColorElements.show();
			}

		} );

		// Show/hide breadcrumbs options
		var breadcrumbsField        = $( '#butterbean-control-sunio_disable_breadcrumbs .buttonset-input' ),
			breadcrumbsSettings   	= $( '#butterbean-control-sunio_breadcrumbs_color, #butterbean-control-sunio_breadcrumbs_separator_color, #butterbean-control-sunio_breadcrumbs_links_color, #butterbean-control-sunio_breadcrumbs_links_hover_color' );

		if ( $( '#butterbean-control-sunio_disable_breadcrumbs #butterbean_sunio_mb_settings_setting_sunio_disable_breadcrumbs_off' ).is( ':checked' ) ) {
			breadcrumbsSettings.hide();
		} else {
			breadcrumbsSettings.show();
		}

		breadcrumbsField.change( function () {

			if ( $( this ).val() === 'off' ) {
				breadcrumbsSettings.hide();
			} else {
				breadcrumbsSettings.show();
			}

		} );

	} );

} ) ( jQuery );