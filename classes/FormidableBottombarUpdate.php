<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'You are not allowed to call this page directly.' );
}

class FormidableBottombarUpdate extends FrmAddon {

	public $plugin_file;
	public $plugin_name = 'Formidable Bottombar';
	public $version = '0.0.1';

	public function __construct() {
		$this->plugin_file = dirname( dirname( __FILE__ ) ) . '/FormidableBottombar.php';
		parent::__construct();
	}

	public static function load_hooks() {
		add_filter( 'frm_include_addon_page', '__return_true' );
		new FormidableBottombarUpdate();
	}

}
