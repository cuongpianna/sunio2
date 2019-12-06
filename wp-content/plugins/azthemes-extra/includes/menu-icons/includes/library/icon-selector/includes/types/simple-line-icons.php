<?php
/**
 * Simple Line Icons
 *
 */

require_once dirname( __FILE__ ) . '/font.php';

/**
 * Icon type: Simple Line Icons
 *
 */

class AZT_Icon_Picker_Type_Simple_Line_Icons extends AZT_Icon_Picker_Type_Font {

	/**
	 * Icon type ID
	 *
	 */
	protected $id = 'line-icon';

	/**
	 * Icon type name
	 *
	 */
	protected $name = 'Simple Line Icons';

	/**
	 * Icon type version
	 *
	 */
	protected $version = '2.4.0';

	/**
	 * Stylesheet ID
	 *
	 */
	protected $stylesheet_id = 'simple-line-icons';

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
				'id'   => 'media',
				'name' => __( 'Media', 'sunio-extra' ),
			),
			array(
				'id'   => 'misc',
				'name' => __( 'Misc.', 'sunio-extra' ),
			),
			array(
				'id'   => 'social',
				'name' => __( 'Social', 'sunio-extra' ),
			),
		);

		/**
		 * Filter simple line icons groups
		 *
		 */
		$groups = apply_filters( 'oe_icon_picker_simple_line_icons_groups', $groups );

		return $groups;
	}

	/**
	 * Get icon names
	 *
	 */
	public function get_items() {
		$items = array(
			array(
				'group' => 'misc',
				'id'    => 'icon-user',
				'name'  => __( 'User', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-people',
				'name'  => __( 'People', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-user-female',
				'name'  => __( 'User Female', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-user-follow',
				'name'  => __( 'User Follow', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-user-following',
				'name'  => __( 'User Following', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-user-unfollow',
				'name'  => __( 'User Unfollow', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-login',
				'name'  => __( 'Login', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-logout',
				'name'  => __( 'Logout', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-emotsmile',
				'name'  => __( 'Emotsmile', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-phone',
				'name'  => __( 'Phone', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-call-end',
				'name'  => __( 'Call End', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-call-in',
				'name'  => __( 'Call In', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-call-out',
				'name'  => __( 'Call Out', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-map',
				'name'  => __( 'Map', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-location-pin',
				'name'  => __( 'Location Pin', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-direction',
				'name'  => __( 'Direction', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-directions',
				'name'  => __( 'Directions', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-compass',
				'name'  => __( 'Compass', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-layers',
				'name'  => __( 'Layers', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-menu',
				'name'  => __( 'Menu', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-list',
				'name'  => __( 'List', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-options-vertical',
				'name'  => __( 'Options Vertical', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-options',
				'name'  => __( 'Options', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-arrow-down',
				'name'  => __( 'Arrow Down', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-arrow-left',
				'name'  => __( 'Arrow Left', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-arrow-right',
				'name'  => __( 'Arrow Right', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-arrow-up',
				'name'  => __( 'Arrow Up', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-arrow-up-circle',
				'name'  => __( 'Arrow Up Circle', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-arrow-left-circle',
				'name'  => __( 'Arrow Left Circle', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-arrow-right-circle',
				'name'  => __( 'Arrow Right Circle', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-arrow-down-circle',
				'name'  => __( 'Arrow Down Circle', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-check',
				'name'  => __( 'Check', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-clock',
				'name'  => __( 'Clock', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-plus',
				'name'  => __( 'Plus', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-minus',
				'name'  => __( 'Minus', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-close',
				'name'  => __( 'Close', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-exclamation',
				'name'  => __( 'Exclamation', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-organization',
				'name'  => __( 'Organization', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-trophy',
				'name'  => __( 'Trophy', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-screen-smartphone',
				'name'  => __( 'Screen Smartphone', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-screen-desktop',
				'name'  => __( 'Screen Desktop', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-plane',
				'name'  => __( 'Plane', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-notebook',
				'name'  => __( 'Notebook', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-mustache',
				'name'  => __( 'Mustache', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-mouse',
				'name'  => __( 'Mouse', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-magnet',
				'name'  => __( 'Magnet', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-energy',
				'name'  => __( 'Energy', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-disc',
				'name'  => __( 'Disc', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-cursor',
				'name'  => __( 'Cursor', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-cursor-move',
				'name'  => __( 'Cursor Move', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-crop',
				'name'  => __( 'Crop', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-chemistry',
				'name'  => __( 'Chemistry', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-speedometer',
				'name'  => __( 'Speedometer', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-shield',
				'name'  => __( 'Shield', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-screen-tablet',
				'name'  => __( 'Screen Tablet', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-magic-wand',
				'name'  => __( 'Magic Wand', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-hourglass',
				'name'  => __( 'Hourglass', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-graduation',
				'name'  => __( 'Graduation', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-ghost',
				'name'  => __( 'Ghost', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-game-controller',
				'name'  => __( 'Game Controller', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-fire',
				'name'  => __( 'Fire', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-eyeglass',
				'name'  => __( 'Eyeglass', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-envelope-open',
				'name'  => __( 'Envelope Open', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-envelope-letter',
				'name'  => __( 'Envelope Letter', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-bell',
				'name'  => __( 'Bell', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-badge',
				'name'  => __( 'Badge', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-anchor',
				'name'  => __( 'Anchor', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-wallet',
				'name'  => __( 'Wallet', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-vector',
				'name'  => __( 'Vector', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-speech',
				'name'  => __( 'Speech', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-puzzle',
				'name'  => __( 'Puzzle', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-printer',
				'name'  => __( 'Printer', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-present',
				'name'  => __( 'Present', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-playlist',
				'name'  => __( 'Playlist', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-pin',
				'name'  => __( 'Pin', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-picture',
				'name'  => __( 'Picture', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-handbag',
				'name'  => __( 'Handbag', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-globe-alt',
				'name'  => __( 'Globe Alt', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-globe',
				'name'  => __( 'Globe', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-folder-alt',
				'name'  => __( 'Folder Alt', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-folder',
				'name'  => __( 'Folder', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-film',
				'name'  => __( 'Film', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-feed',
				'name'  => __( 'Feed', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-drop',
				'name'  => __( 'Drop', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-drawer',
				'name'  => __( 'Drawer', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-docs',
				'name'  => __( 'Docs', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-doc',
				'name'  => __( 'Doc', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-diamond',
				'name'  => __( 'Diamond', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-cup',
				'name'  => __( 'Cup', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-calculator',
				'name'  => __( 'Calculator', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-bubbles',
				'name'  => __( 'Bubbles', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-briefcase',
				'name'  => __( 'Briefcase', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-book-open',
				'name'  => __( 'Book Open', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-basket-loaded',
				'name'  => __( 'Basket Loaded', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-basket',
				'name'  => __( 'Basket', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-bag',
				'name'  => __( 'Bag', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-action-undo',
				'name'  => __( 'Action Undo', 'sunio-extra' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-action-redo',
				'name'  => __( 'Action Redo', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-wrench',
				'name'  => __( 'Wrench', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-umbrella',
				'name'  => __( 'Umbrella', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-trash',
				'name'  => __( 'Trash', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-tag',
				'name'  => __( 'Tag', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-support',
				'name'  => __( 'Support', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-frame',
				'name'  => __( 'Frame', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-size-fullscreen',
				'name'  => __( 'Size Fullscreen', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-size-actual',
				'name'  => __( 'Size Actual', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-shuffle',
				'name'  => __( 'Shuffle', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-share-alt',
				'name'  => __( 'Share Alt', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-share',
				'name'  => __( 'Share', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-rocket',
				'name'  => __( 'Rocket', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-question',
				'name'  => __( 'Question', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-pie-chart',
				'name'  => __( 'Pie Chart', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-pencil',
				'name'  => __( 'Pencil', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-note',
				'name'  => __( 'Note', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-loop',
				'name'  => __( 'Loop', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-home',
				'name'  => __( 'Home', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-grid',
				'name'  => __( 'Grid', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-graph',
				'name'  => __( 'Graph', 'sunio-extra' ),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-microphone',
				'name'  => __( 'Microphone', 'sunio-extra' ),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-music-tone-alt',
				'name'  => __( 'Music Tone Alt', 'sunio-extra' ),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-music-tone',
				'name'  => __( 'Music Tone', 'sunio-extra' ),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-earphones-alt',
				'name'  => __( 'Earphones Alt', 'sunio-extra' ),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-earphones',
				'name'  => __( 'Earphones', 'sunio-extra' ),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-equalizer',
				'name'  => __( 'Equalizer', 'sunio-extra' ),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-like',
				'name'  => __( 'Like', 'sunio-extra' ),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-dislike',
				'name'  => __( 'Dislike', 'sunio-extra' ),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-control-start',
				'name'  => __( 'Control Start', 'sunio-extra' ),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-control-rewind',
				'name'  => __( 'Control Rewind', 'sunio-extra' ),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-control-play',
				'name'  => __( 'Control Play', 'sunio-extra' ),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-control-pause',
				'name'  => __( 'Control Pause', 'sunio-extra' ),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-control-forward',
				'name'  => __( 'Control Forward', 'sunio-extra' ),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-control-end',
				'name'  => __( 'Control End', 'sunio-extra' ),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-volume-1',
				'name'  => __( 'Volume 1', 'sunio-extra' ),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-volume-2',
				'name'  => __( 'Volume 2', 'sunio-extra' ),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-volume-off',
				'name'  => __( 'Volume Off', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-calendar',
				'name'  => __( 'Calendar', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-bulb',
				'name'  => __( 'Bulb', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-chart',
				'name'  => __( 'Chart', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-ban',
				'name'  => __( 'Ban', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-bubble',
				'name'  => __( 'Bubble', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-camrecorder',
				'name'  => __( 'Camrecorder', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-camera',
				'name'  => __( 'Camera', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-cloud-download',
				'name'  => __( 'Cloud Download', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-cloud-upload',
				'name'  => __( 'Cloud Upload', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-envelope',
				'name'  => __( 'Envelope', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-eye',
				'name'  => __( 'Eye', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-flag',
				'name'  => __( 'Flag', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-heart',
				'name'  => __( 'Heart', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-info',
				'name'  => __( 'Info', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-key',
				'name'  => __( 'Key', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-link',
				'name'  => __( 'Link', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-lock',
				'name'  => __( 'Lock', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-lock-open',
				'name'  => __( 'Lock Open', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-magnifier',
				'name'  => __( 'Magnifier', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-magnifier-add',
				'name'  => __( 'Magnifier Add', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-magnifier-remove',
				'name'  => __( 'Magnifier Remove', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-paper-clip',
				'name'  => __( 'Paper Clip', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-paper-plane',
				'name'  => __( 'Paper Plane', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-power',
				'name'  => __( 'Power', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-refresh',
				'name'  => __( 'Refresh', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-reload',
				'name'  => __( 'Reload', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-settings',
				'name'  => __( 'Settings', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-star',
				'name'  => __( 'Star', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-symbol-female',
				'name'  => __( 'Symbol Female', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-symbol-male',
				'name'  => __( 'Symbol Male', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-target',
				'name'  => __( 'Target', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-credit-card',
				'name'  => __( 'Credit Card', 'sunio-extra' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-paypal',
				'name'  => __( 'Paypal', 'sunio-extra' ),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-tumblr',
				'name'  => __( 'Social Tumblr', 'sunio-extra' ),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-twitter',
				'name'  => __( 'Social Twitter', 'sunio-extra' ),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-facebook',
				'name'  => __( 'Social Facebook', 'sunio-extra' ),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-instagram',
				'name'  => __( 'Social Instagram', 'sunio-extra' ),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-linkedin',
				'name'  => __( 'Social Linkedin', 'sunio-extra' ),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-pinterest',
				'name'  => __( 'Social Pinterest', 'sunio-extra' ),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-github',
				'name'  => __( 'Social Github', 'sunio-extra' ),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-google',
				'name'  => __( 'Social Google', 'sunio-extra' ),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-reddit',
				'name'  => __( 'Social Reddit', 'sunio-extra' ),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-skype',
				'name'  => __( 'Social Skype', 'sunio-extra' ),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-dribbble',
				'name'  => __( 'Social Dribbble', 'sunio-extra' ),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-behance',
				'name'  => __( 'Social Behance', 'sunio-extra' ),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-foursqare',
				'name'  => __( 'Social Foursqare', 'sunio-extra' ),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-soundcloud',
				'name'  => __( 'Social Soundcloud', 'sunio-extra' ),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-spotify',
				'name'  => __( 'Social Spotify', 'sunio-extra' ),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-stumbleupon',
				'name'  => __( 'Social Stumbleupon', 'sunio-extra' ),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-youtube',
				'name'  => __( 'Social Youtube', 'sunio-extra' ),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-dropbox',
				'name'  => __( 'Social Dropbox', 'sunio-extra' ),
			),
		);

		/**
		 * Filter simple line icons items
		 *
		 */
		$items = apply_filters( 'oe_icon_picker_simple_line_icons_items', $items );

		return $items;
	}
}
