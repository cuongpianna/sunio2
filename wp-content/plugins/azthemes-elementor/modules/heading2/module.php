<?php
namespace AztElementor\Modules\heading2;

use AztElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_widgets() {
        return [
            'heading2',
        ];
    }

    public function get_name() {
        return 'azt-heading2';
    }
}

