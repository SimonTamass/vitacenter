<?php
/**
 * Plugin Name: VitaCenter Elementor Widgets
 * Description: Elementor widgets for the VitaCenter header, navigation, and landing page content.
 * Version: 1.4.24
 * Author: VitaCenter
 * Text Domain: vitacenter-elementor-header
 * Requires Plugins: elementor
 * Elementor tested up to: 3.29.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'VC_ELEMENTOR_HEADER_VERSION', '1.4.24' );
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
		add_action( 'admin_init', array( $this, 'migrate_partners_widget_data' ) );
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
		require_once VC_ELEMENTOR_HEADER_PATH . 'includes/class-vc-elementor-mobile-specialist-widget.php';
		require_once VC_ELEMENTOR_HEADER_PATH . 'includes/class-vc-elementor-mobile-specialist-v2-widget.php';
		require_once VC_ELEMENTOR_HEADER_PATH . 'includes/class-vc-elementor-mobile-screening-widget.php';
		require_once VC_ELEMENTOR_HEADER_PATH . 'includes/class-vc-elementor-ciklusoktatas-widget.php';
		require_once VC_ELEMENTOR_HEADER_PATH . 'includes/class-vc-elementor-egeszsegfejlesztesi-iroda-widget.php';
		require_once VC_ELEMENTOR_HEADER_PATH . 'includes/class-vc-elementor-eletmodtanacsadas-widget.php';
		require_once VC_ELEMENTOR_HEADER_PATH . 'includes/class-vc-elementor-iskolaerettseg-widget.php';

		$widgets_manager->register( new VitaCenter_Elementor_Header_Widget() );
		$widgets_manager->register( new VitaCenter_Elementor_Landing_Widget() );
		$widgets_manager->register( new VitaCenter_Header_Top_Widget() );
		$widgets_manager->register( new VitaCenter_Header_Menu_Widget() );
		$widgets_manager->register( new VitaCenter_Landing_Hero_Widget() );
		$widgets_manager->register( new VitaCenter_Landing_Project_Widget() );
		$widgets_manager->register( new VitaCenter_Landing_Programs_Widget() );
		$widgets_manager->register( new VitaCenter_Landing_Events_Widget() );
		$widgets_manager->register( new VitaCenter_Upcoming_Events_Widget() );
		$widgets_manager->register( new VitaCenter_All_Events_Widget() );
		$widgets_manager->register( new VitaCenter_Landing_Cta_Widget() );
		$widgets_manager->register( new VitaCenter_Landing_Knowledge_Widget() );
		$widgets_manager->register( new VitaCenter_Knowledge_Widget() );
		$widgets_manager->register( new VitaCenter_Video_Gallery_Widget() );
		$widgets_manager->register( new VitaCenter_Partners_Widget() );
		$widgets_manager->register( new VitaCenter_Contact_Widget() );
		$widgets_manager->register( new VitaCenter_Landing_Contact_Widget() );
		$widgets_manager->register( new VitaCenter_Legal_Footer_Widget() );
		$widgets_manager->register( new VitaCenter_Project_Content_Widget() );
		$widgets_manager->register( new VitaCenter_Program_Content_Widget() );
		$widgets_manager->register( new VitaCenter_Mobile_Specialist_Widget() );
		$widgets_manager->register( new VitaCenter_Mobile_Specialist_V2_Widget() );
		$widgets_manager->register( new VitaCenter_Mobile_Screening_Widget() );
		$widgets_manager->register( new VitaCenter_Ciklusoktatas_Widget() );
		$widgets_manager->register( new VitaCenter_Egeszsegfejlesztesi_Iroda_Widget() );
		$widgets_manager->register( new VitaCenter_Eletmodtanacsadas_Widget() );
		$widgets_manager->register( new VitaCenter_Iskolaerettseg_Widget() );
		$widgets_manager->register( new VitaCenter_Info_Section_Widget() );
		$widgets_manager->register( new VitaCenter_Registration_Info_Widget() );
	}

	public function migrate_partners_widget_data() {
		if ( ! current_user_can( 'edit_posts' ) ) {
			return;
		}

		$migration_version = '1.4.23';

		if ( $migration_version === get_option( 'vc_partners_widget_data_version' ) ) {
			return;
		}

		$post_ids = get_posts(
			array(
				'post_type'        => 'any',
				'post_status'      => 'any',
				'posts_per_page'   => -1,
				'fields'           => 'ids',
				'meta_key'         => '_elementor_data',
				'suppress_filters' => true,
			)
		);

		foreach ( $post_ids as $post_id ) {
			$raw_data = get_post_meta( $post_id, '_elementor_data', true );
			$data     = $this->decode_elementor_data( $raw_data );

			if ( ! is_array( $data ) ) {
				continue;
			}

			$changed = false;
			$data    = $this->migrate_partners_elements( $data, $changed );

			if ( ! $changed ) {
				continue;
			}

			update_post_meta( $post_id, '_elementor_data', wp_slash( wp_json_encode( $data ) ) );
			clean_post_cache( $post_id );
		}

		update_option( 'vc_partners_widget_data_version', $migration_version, false );
	}

	private function decode_elementor_data( $raw_data ) {
		if ( ! is_string( $raw_data ) || '' === $raw_data ) {
			return null;
		}

		$data = json_decode( $raw_data, true );

		if ( is_array( $data ) ) {
			return $data;
		}

		$data = json_decode( wp_unslash( $raw_data ), true );

		return is_array( $data ) ? $data : null;
	}

	private function migrate_partners_elements( $elements, &$changed ) {
		if ( ! is_array( $elements ) ) {
			return $elements;
		}

		foreach ( $elements as $index => $element ) {
			if ( ! is_array( $element ) ) {
				continue;
			}

			if ( isset( $element['widgetType'] ) && 'vitacenter_partners' === $element['widgetType'] ) {
				$settings = isset( $element['settings'] ) && is_array( $element['settings'] ) ? $element['settings'] : array();
				$partners = isset( $settings['partners'] ) && is_array( $settings['partners'] ) ? $settings['partners'] : array();
				$migrated = $this->merge_partners_for_editing( $partners );

				if ( $migrated !== $partners ) {
					$settings['partners']             = $migrated;
					$elements[ $index ]['settings']   = $settings;
					$changed                          = true;
				}
			}

			if ( isset( $elements[ $index ]['elements'] ) && is_array( $elements[ $index ]['elements'] ) ) {
				$elements[ $index ]['elements'] = $this->migrate_partners_elements( $elements[ $index ]['elements'], $changed );
			}
		}

		return $elements;
	}

	private function merge_partners_for_editing( $saved_items ) {
		$defaults    = $this->default_partners_for_editing();
		$items       = array();
		$extra_items = array();

		foreach ( $saved_items as $item ) {
			if ( ! is_array( $item ) ) {
				continue;
			}

			$key = $this->partner_key_for_editing( $item );

			if ( '' === $key || ! isset( $defaults[ $key ] ) ) {
				$extra_items[] = $item;
				continue;
			}

			$merged = array_merge( $defaults[ $key ], $item );
			$merged['_id'] = $defaults[ $key ]['_id'];

			if ( empty( $merged['logo']['url'] ) ) {
				$merged['logo'] = $defaults[ $key ]['logo'];
			}

			if ( empty( $merged['logo_text'] ) ) {
				$merged['logo_text'] = $defaults[ $key ]['logo_text'];
			}

			if ( empty( $merged['type'] ) ) {
				$merged['type'] = $defaults[ $key ]['type'];
			}

			if ( empty( $merged['name'] ) ) {
				$merged['name'] = $defaults[ $key ]['name'];
			}

			$items[ $key ] = $merged;
		}

		foreach ( $defaults as $key => $item ) {
			if ( ! isset( $items[ $key ] ) ) {
				$items[ $key ] = $item;
			}
		}

		return array_merge(
			array(
				$items['leader'],
				$items['scheffler'],
				$items['hodmezovasarhely'],
			),
			$extra_items
		);
	}

	private function default_partners_for_editing() {
		return array(
			'leader' => array(
				'_id'         => 'vclead1',
				'logo'        => array( 'url' => $this->source_asset_url( 'Logo-Szatmari-Szent-Vincarol-nevezett-1030x159.png' ) ),
				'logo_text'   => 'PSV',
				'type'        => 'Vezető partner',
				'name'        => 'Páli Szent Vincéről Nevezett Szatmári Irgalmas Nővérek Egyesülete',
				'description' => '',
				'featured'    => 'yes',
			),
			'scheffler' => array(
				'_id'         => 'vcsche1',
				'logo'        => array( 'url' => $this->source_asset_url( 'Scheffler_logo-200x120.png' ) ),
				'logo_text'   => 'BSJ',
				'type'        => 'Projektpartner',
				'name'        => 'Boldog Scheffler János Központ',
				'description' => '',
				'featured'    => '',
			),
			'hodmezovasarhely' => array(
				'_id'         => 'vchodm1',
				'logo'        => array( 'url' => $this->source_asset_url( 'fekvo_logo.png' ) ),
				'logo_text'   => 'HM',
				'type'        => 'Projektpartner',
				'name'        => 'Hódmezővásárhelyi-Makói Egészségellátó Központ',
				'description' => '',
				'featured'    => '',
			),
		);
	}

	private function partner_key_for_editing( $item ) {
		if ( isset( $item['_id'] ) ) {
			if ( 'vclead1' === $item['_id'] ) {
				return 'leader';
			}

			if ( 'vcsche1' === $item['_id'] ) {
				return 'scheffler';
			}

			if ( 'vchodm1' === $item['_id'] ) {
				return 'hodmezovasarhely';
			}
		}

		$name       = isset( $item['name'] ) ? (string) $item['name'] : '';
		$normalized = strtolower( remove_accents( $name ) );

		if ( false !== strpos( $normalized, 'pali szent vincerol' ) || false !== strpos( $normalized, 'szatmari irgalmas noverek' ) ) {
			return 'leader';
		}

		if ( false !== strpos( $normalized, 'scheffler' ) ) {
			return 'scheffler';
		}

		if ( false !== strpos( $normalized, 'hodmezovasarhelyi' ) || false !== strpos( $normalized, 'makoi' ) ) {
			return 'hodmezovasarhely';
		}

		return '';
	}

	private function source_asset_url( $file_name ) {
		return VC_ELEMENTOR_HEADER_URL . 'source/' . rawurlencode( $file_name );
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
