<?php

class FormidableBottombarApp {

	public function __construct() {
		add_shortcode( 'frmbottombar', 'FormidableBottombarApp::output_bottombar' );
		add_action( 'admin_init', 'FormidableBottombarApp::load_autoupdater' );
	}

	public static function output_bottombar( $atts ) {
		$defaults = array(
			'id'    => '',
			'description' => 'true'
		);
		$atts = array_merge( $defaults, $atts );

		global $frm_vars;
		if ( ! isset( $frm_vars['bottombar'] ) ) {
			$frm_vars['bottombar'] = array();
		}
		$frm_vars['bottombar'][] = $atts;

		self::enqueue_scripts();
		add_action( 'wp_footer', 'FormidableBottombarApp::generate_bottombar' );
	}

	public static function load_autoupdater() {
		if ( class_exists( 'FrmAddon' ) ) {
			FormidableBottombarUpdate::load_hooks();
		}
	}

	public static function enqueue_scripts() {
		$plugin_url = plugins_url() .'/'. basename( dirname( dirname( __FILE__ ) ) );
	  wp_enqueue_style( 'fontawesome', $plugin_url .'/css/font-awesome.min.css' );
	  wp_enqueue_style( 'frm-bottombar', $plugin_url .'/css/frm-bottombar.css' );
		wp_enqueue_script( 'frm-bottombar', $plugin_url .'/js/frm-bottombar.js', array( 'jquery' ) );
	}

	public static function generate_bottombar() {
		global $frm_vars;

		if ( isset( $frm_vars['bottombar'] ) && is_array ( $frm_vars['bottombar'] ) ) {
			foreach ( $frm_vars['bottombar'] as $i => $form_atts ) {
				$modal = '<div id="frm-bottombar-' . esc_attr( $i ) . '" class="frmbottombar">';
				$modal .= '<div class="frmbottombar-wrapper">';
				$modal .= FrmFormsController::get_form_shortcode( $form_atts );
				$modal .= '</div>';
				$modal .= '</div>';
				echo $modal;
			}
		}
	}

}