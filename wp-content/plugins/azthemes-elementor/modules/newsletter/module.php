<?php
namespace AztElementor\Modules\Newsletter;

use AztElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Newsletter',
		];
	}

	public function get_name() {
		return 'azt-newsletter';
	}
}
