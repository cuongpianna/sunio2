<?php
namespace AztElementor\Modules\Navigation;

use AztElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Navigation',
		];
	}

	public function get_name() {
		return 'azt-nav';
	}
}
