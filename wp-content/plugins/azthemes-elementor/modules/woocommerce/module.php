<?php
namespace AztElementor\Modules\Woocommerce;

use AztElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Woo_Products',
			'Woo_Products_Tabs',
            'Woo_Category',
            'Woo_Single_Product'
		];
	}

	public function get_name() {
		return 'azt-woocommece';
	}
}
