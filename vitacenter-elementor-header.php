<?php
/**
 * Plugin Name: VitaCenter Elementor Widgets
 * Description: Elementor widgets for the VitaCenter header, navigation, and landing page content.
 * Version: 1.4.1
 * Author: VitaCenter
 * Text Domain: vitacenter-elementor-header
 * Requires Plugins: elementor
 * Elementor tested up to: 3.29.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'VC_ELEMENTOR_HEADER_VERSION', '1.4.1' );
define( 'VC_ELEMENTOR_HEADER_FILE', __FILE__ );
define( 'VC_ELEMENTOR_HEADER_PATH', plugin_dir_path( __FILE__ ) );
define( 'VC_ELEMENTOR_HEADER_URL', plugin_dir_url( __FILE__ ) );

final class VitaCenter_Elementor_Header_Plugin {
	const MINIMUM_ELEMENTOR_VERSION = '3.5.0';

	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	public function init() {
		load_plugin_textdomain( 'vitacenter-elementor-header', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_elementor' ) );
			return;
		}

		if ( defined( 'ELEMENTOR_VERSION' ) && ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ) );
		add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'register_assets' ) );
		add_action( 'elementor/frontend/after_register_styles', array( $this, 'register_assets' ) );
		add_action( 'elementor/frontend/after_register_scripts', array( $this, 'register_assets' ) );
		add_action( 'elementor/elements/categories_registered', array( $this, 'register_category' ) );
		add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );
		add_action( 'template_redirect', array( $this, 'disable_broken_cookieadmin_banner' ), 0 );
		add_action( 'wp_footer', array( $this, 'disable_broken_cookieadmin_banner' ), -9999 );
	}

	public function register_assets() {
		wp_register_style(
			'vc-header',
			VC_ELEMENTOR_HEADER_URL . 'assets/css/vc-header.css',
			array(),
			VC_ELEMENTOR_HEADER_VERSION
		);

		wp_register_script(
			'vc-header',
			VC_ELEMENTOR_HEADER_URL . 'assets/js/vc-header.js',
			array(),
			VC_ELEMENTOR_HEADER_VERSION,
			true
		);

		wp_register_style(
			'vc-landing',
			VC_ELEMENTOR_HEADER_URL . 'assets/css/vc-landing.css',
			array(),
			VC_ELEMENTOR_HEADER_VERSION
		);

		wp_register_script(
			'vc-landing',
			VC_ELEMENTOR_HEADER_URL . 'assets/js/vc-landing.js',
			array(),
			VC_ELEMENTOR_HEADER_VERSION,
			true
		);
	}

	public function register_category( $elements_manager ) {
		$elements_manager->add_category(
			'vitacenter',
			array(
				'title' => esc_html__( 'VitaCenter', 'vitacenter-elementor-header' ),
				'icon'  => 'fa fa-plug',
			)
		);
	}

	public function register_widgets( $widgets_manager ) {
		require_once VC_ELEMENTOR_HEADER_PATH . 'includes/class-vc-elementor-header-widget.php';
		require_once VC_ELEMENTOR_HEADER_PATH . 'includes/class-vc-elementor-landing-widget.php';
		require_once VC_ELEMENTOR_HEADER_PATH . 'includes/class-vc-elementor-structured-widgets.php';
		require_once VC_ELEMENTOR_HEADER_PATH . 'includes/class-vc-elementor-content-widgets.php';

		$widgets_manager->register( new VitaCenter_Elementor_Header_Widget() );
		$widgets_manager->register( new VitaCenter_Elementor_Landing_Widget() );
		$widgets_manager->register( new VitaCenter_Header_Top_Widget() );
		$widgets_manager->register( new VitaCenter_Header_Menu_Widget() );
		$widgets_manager->register( new VitaCenter_Landing_Hero_Widget() );
		$widgets_manager->register( new VitaCenter_Landing_Project_Widget() );
		$widgets_manager->register( new VitaCenter_Landing_Programs_Widget() );
		$widgets_manager->register( new VitaCenter_Landing_Events_Widget() );
		$widgets_manager->register( new VitaCenter_Landing_Cta_Widget() );
		$widgets_manager->register( new VitaCenter_Landing_Knowledge_Widget() );
		$widgets_manager->register( new VitaCenter_Landing_Contact_Widget() );
		$widgets_manager->register( new VitaCenter_Legal_Footer_Widget() );
		$widgets_manager->register( new VitaCenter_Project_Content_Widget() );
		$widgets_manager->register( new VitaCenter_Program_Content_Widget() );
		$widgets_manager->register( new VitaCenter_Info_Section_Widget() );
		$widgets_manager->register( new VitaCenter_Registration_Info_Widget() );
	}

	public function disable_broken_cookieadmin_banner() {
		global $wp_filter;

		if ( empty( $wp_filter['wp_footer'] ) || ! is_object( $wp_filter['wp_footer'] ) || empty( $wp_filter['wp_footer']->callbacks ) ) {
			return;
		}

		foreach ( $wp_filter['wp_footer']->callbacks as $priority => $callbacks ) {
			foreach ( $callbacks as $callback ) {
				if ( empty( $callback['function'] ) ) {
					continue;
				}

				$callable = $callback['function'];

				if ( is_string( $callable ) && 'CookieAdmin\\Enduser::cookieadmin_show_banner' === ltrim( $callable, '\\' ) ) {
					remove_action( 'wp_footer', $callable, $priority );
					continue;
				}

				if ( ! is_array( $callable ) ) {
					continue;
				}

				if ( empty( $callable[0] ) || empty( $callable[1] ) || 'cookieadmin_show_banner' !== $callable[1] ) {
					continue;
				}

				$class_name = is_object( $callable[0] ) ? get_class( $callable[0] ) : ltrim( (string) $callable[0], '\\' );

				if ( 'CookieAdmin\\Enduser' === $class_name ) {
					remove_action( 'wp_footer', $callable, $priority );
				}
			}
		}
	}

	public function admin_notice_missing_elementor() {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		echo '<div class="notice notice-warning"><p>';
		echo esc_html__( 'VitaCenter Elementor Header requires Elementor to be installed and activated.', 'vitacenter-elementor-header' );
		echo '</p></div>';
	}

	public function admin_notice_minimum_elementor_version() {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		echo '<div class="notice notice-warning"><p>';
		printf(
			/* translators: %s: Elementor version. */
			esc_html__( 'VitaCenter Elementor Header requires Elementor version %s or newer.', 'vitacenter-elementor-header' ),
			esc_html( self::MINIMUM_ELEMENTOR_VERSION )
		);
		echo '</p></div>';
	}
}

new VitaCenter_Elementor_Header_Plugin();
