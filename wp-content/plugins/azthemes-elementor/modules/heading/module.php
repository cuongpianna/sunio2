<?php
namespace AztElementor\Modules\Heading;

use AztElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'heading',
		];
	}

	public function get_name() {
		return 'azt-heading';
	}
}
