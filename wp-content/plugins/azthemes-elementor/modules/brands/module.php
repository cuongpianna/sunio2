<?php
namespace AztElementor\Modules\Brands;

use AztElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_widgets() {
        return [
            'Brands'
        ];
    }

    public function get_name() {
        return 'azt-brands';
    }
}
