<?php
/**
 * Genericons
 *
 */
class AZT_Icon_Picker_Type_Genericons extends AZT_Icon_Picker_Type_Font {

	/**
	 * Icon type ID
	 *
	 */
	protected $id = 'genericon';

	/**
	 * Icon type name
	 *
	 */
	protected $name = 'Genericons';

	/**
	 * Icon type version
	 *
	 */
	protected $version = '3.4';

	/**
	 * Stylesheet ID
	 *
	 */
	protected $stylesheet_id = 'genericons';


	/**
	 * Get icon groups
	 *
	 */
	public function get_groups() {
		$groups = array(
			array(
				'id'   => 'actions',
				'name' => __( 'Actions', 'sunio-extra' ),
			),
			array(
				'id'   => 'media-player',
				'name' => __( 'Media Player', 'sunio-extra' ),
			),
			array(
				'id'   => 'meta',
				'name' => __( 'Meta', 'sunio-extra' ),
			),
			array(
				'id'   => 'misc',
				'name' => __( 'Misc.', 'sunio-extra' ),
			),
			array(
				'id'   => 'places',
				'name' => __( 'Places', 'sunio-extra' ),
			),
			array(
				'id'   => 'post-formats',
				'name' => __( 'Post Formats', 'sunio-extra' ),
			),
			array(
				'id'   => 'text-editor',
				'name' => __( 'Text Editor', 'sunio-extra' ),
			),
			array(
				'id'   => 'social',
				'name' => __( 'Social', 'sunio-extra' ),
			),
		);

		/**
		 * Filter genericon groups
		 *
		 */
		$groups = apply_filters( 'oe_icon_picker_genericon_groups', $groups );

		return $groups;
	}

	/**
	 * Get icon names
	 *
	 */
	public function get_items() {
		$items = array(
			array(
				'group' => 'actions',
				'id'    => 'genericon-checkmark',
				'name'  => __( 'Checkmark', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-close',
				'name'  => __( 'Close', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-close-alt',
				'name'  => __( 'Close', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-dropdown',
				'name'  => __( 'Dropdown', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-dropdown-left',
				'name'  => __( 'Dropdown left', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-collapse',
				'name'  => __( 'Collapse', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-expand',
				'name'  => __( 'Expand', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-help',
				'name'  => __( 'Help', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-info',
				'name'  => __( 'Info', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-lock',
				'name'  => __( 'Lock', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-maximize',
				'name'  => __( 'Maximize', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-minimize',
				'name'  => __( 'Minimize', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-plus',
				'name'  => __( 'Plus', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-minus',
				'name'  => __( 'Minus', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-previous',
				'name'  => __( 'Previous', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-next',
				'name'  => __( 'Next', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-move',
				'name'  => __( 'Move', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-hide',
				'name'  => __( 'Hide', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-show',
				'name'  => __( 'Show', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-print',
				'name'  => __( 'Print', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-rating-empty',
				'name'  => __( 'Rating: Empty', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-rating-half',
				'name'  => __( 'Rating: Half', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-rating-full',
				'name'  => __( 'Rating: Full', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-refresh',
				'name'  => __( 'Refresh', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-reply',
				'name'  => __( 'Reply', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-reply-alt',
				'name'  => __( 'Reply alt', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-reply-single',
				'name'  => __( 'Reply single', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-search',
				'name'  => __( 'Search', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-send-to-phone',
				'name'  => __( 'Send to', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-send-to-tablet',
				'name'  => __( 'Send to', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-share',
				'name'  => __( 'Share', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-shuffle',
				'name'  => __( 'Shuffle', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-spam',
				'name'  => __( 'Spam', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-subscribe',
				'name'  => __( 'Subscribe', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-subscribed',
				'name'  => __( 'Subscribed', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-unsubscribe',
				'name'  => __( 'Unsubscribe', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-top',
				'name'  => __( 'Top', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-unapprove',
				'name'  => __( 'Unapprove', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-zoom',
				'name'  => __( 'Zoom', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-unzoom',
				'name'  => __( 'Unzoom', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-xpost',
				'name'  => __( 'X-Post', 'sunio-extra' ),
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-skip-back',
				'name'  => __( 'Skip back', 'sunio-extra' ),
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-rewind',
				'name'  => __( 'Rewind', 'sunio-extra' ),
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-play',
				'name'  => __( 'Play', 'sunio-extra' ),
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-pause',
				'name'  => __( 'Pause', 'sunio-extra' ),
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-stop',
				'name'  => __( 'Stop', 'sunio-extra' ),
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-fastforward',
				'name'  => __( 'Fast Forward', 'sunio-extra' ),
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-skip-ahead',
				'name'  => __( 'Skip ahead', 'sunio-extra' ),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-comment',
				'name'  => __( 'Comment', 'sunio-extra' ),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-category',
				'name'  => __( 'Category', 'sunio-extra' ),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-hierarchy',
				'name'  => __( 'Hierarchy', 'sunio-extra' ),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-tag',
				'name'  => __( 'Tag', 'sunio-extra' ),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-time',
				'name'  => __( 'Time', 'sunio-extra' ),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-user',
				'name'  => __( 'User', 'sunio-extra' ),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-day',
				'name'  => __( 'Day', 'sunio-extra' ),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-week',
				'name'  => __( 'Week', 'sunio-extra' ),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-month',
				'name'  => __( 'Month', 'sunio-extra' ),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-pinned',
				'name'  => __( 'Pinned', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-uparrow',
				'name'  => __( 'Arrow Up', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-downarrow',
				'name'  => __( 'Arrow Down', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-leftarrow',
				'name'  => __( 'Arrow Left', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-rightarrow',
				'name'  => __( 'Arrow Right', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-activity',
				'name'  => __( 'Activity', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-bug',
				'name'  => __( 'Bug', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-book',
				'name'  => __( 'Book', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-cart',
				'name'  => __( 'Cart', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-cloud-download',
				'name'  => __( 'Cloud Download', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-cloud-upload',
				'name'  => __( 'Cloud Upload', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-cog',
				'name'  => __( 'Cog', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-document',
				'name'  => __( 'Document', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-dot',
				'name'  => __( 'Dot', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-download',
				'name'  => __( 'Download', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-draggable',
				'name'  => __( 'Draggable', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-ellipsis',
				'name'  => __( 'Ellipsis', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-external',
				'name'  => __( 'External', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-feed',
				'name'  => __( 'Feed', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-flag',
				'name'  => __( 'Flag', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-fullscreen',
				'name'  => __( 'Fullscreen', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-handset',
				'name'  => __( 'Handset', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-heart',
				'name'  => __( 'Heart', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-key',
				'name'  => __( 'Key', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-mail',
				'name'  => __( 'Mail', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-menu',
				'name'  => __( 'Menu', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-microphone',
				'name'  => __( 'Microphone', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-notice',
				'name'  => __( 'Notice', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-paintbrush',
				'name'  => __( 'Paint Brush', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-phone',
				'name'  => __( 'Phone', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-picture',
				'name'  => __( 'Picture', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-plugin',
				'name'  => __( 'Plugin', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-portfolio',
				'name'  => __( 'Portfolio', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-star',
				'name'  => __( 'Star', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-summary',
				'name'  => __( 'Summary', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-tablet',
				'name'  => __( 'Tablet', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-videocamera',
				'name'  => __( 'Video Camera', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-warning',
				'name'  => __( 'Warning', 'sunio-extra' ),
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-404',
				'name'  => __( '404', 'sunio-extra' ),
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-trash',
				'name'  => __( 'Trash', 'sunio-extra' ),
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-cloud',
				'name'  => __( 'Cloud', 'sunio-extra' ),
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-home',
				'name'  => __( 'Home', 'sunio-extra' ),
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-location',
				'name'  => __( 'Location', 'sunio-extra' ),
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-sitemap',
				'name'  => __( 'Sitemap', 'sunio-extra' ),
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-website',
				'name'  => __( 'Website', 'sunio-extra' ),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-standard',
				'name'  => __( 'Standard', 'sunio-extra' ),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-aside',
				'name'  => __( 'Aside', 'sunio-extra' ),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-image',
				'name'  => __( 'Image', 'sunio-extra' ),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-gallery',
				'name'  => __( 'Gallery', 'sunio-extra' ),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-video',
				'name'  => __( 'Video', 'sunio-extra' ),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-status',
				'name'  => __( 'Status', 'sunio-extra' ),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-quote',
				'name'  => __( 'Quote', 'sunio-extra' ),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-link',
				'name'  => __( 'Link', 'sunio-extra' ),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-chat',
				'name'  => __( 'Chat', 'sunio-extra' ),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-audio',
				'name'  => __( 'Audio', 'sunio-extra' ),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'genericon-anchor',
				'name'  => __( 'Anchor', 'sunio-extra' ),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'genericon-attachment',
				'name'  => __( 'Attachment', 'sunio-extra' ),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'genericon-edit',
				'name'  => __( 'Edit', 'sunio-extra' ),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'genericon-code',
				'name'  => __( 'Code', 'sunio-extra' ),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'genericon-bold',
				'name'  => __( 'Bold', 'sunio-extra' ),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'genericon-italic',
				'name'  => __( 'Italic', 'sunio-extra' ),
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-codepen',
				'name'  => 'CodePen',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-digg',
				'name'  => 'Digg',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-dribbble',
				'name'  => 'Dribbble',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-dropbox',
				'name'  => 'DropBox',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-facebook',
				'name'  => 'Facebook',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-facebook-alt',
				'name'  => 'Facebook',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-flickr',
				'name'  => 'Flickr',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-foursquare',
				'name'  => 'Foursquare',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-github',
				'name'  => 'GitHub',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-googleplus',
				'name'  => 'Google+',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-googleplus-alt',
				'name'  => 'Google+',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-instagram',
				'name'  => 'Instagram',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-linkedin',
				'name'  => 'LinkedIn',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-linkedin-alt',
				'name'  => 'LinkedIn',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-path',
				'name'  => 'Path',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-pinterest',
				'name'  => 'Pinterest',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-pinterest-alt',
				'name'  => 'Pinterest',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-pocket',
				'name'  => 'Pocket',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-polldaddy',
				'name'  => 'PollDaddy',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-reddit',
				'name'  => 'Reddit',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-skype',
				'name'  => 'Skype',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-spotify',
				'name'  => 'Spotify',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-stumbleupon',
				'name'  => 'StumbleUpon',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-tumblr',
				'name'  => 'Tumblr',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-twitch',
				'name'  => 'Twitch',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-twitter',
				'name'  => 'Twitter',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-vimeo',
				'name'  => 'Vimeo',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-wordpress',
				'name'  => 'WordPress',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-youtube',
				'name'  => 'Youtube',
			),
		);

		/**
		 * Filter genericon items
		 *
		 */
		$items = apply_filters( 'oe_icon_picker_genericon_items', $items );

		return $items;
	}
}
