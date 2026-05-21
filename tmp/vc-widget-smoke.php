<?php

namespace Elementor {
	class Widget_Base {
		public $settings = array();

		public function get_settings_for_display() {
			return $this->settings;
		}
	}

	class Controls_Manager {
		const TEXT = 'text';
		const TEXTAREA = 'textarea';
		const URL = 'url';
		const MEDIA = 'media';
		const NUMBER = 'number';
		const COLOR = 'color';
		const SWITCHER = 'switcher';
		const SELECT = 'select';
		const CHOOSE = 'choose';
		const TAB_STYLE = 'style';
	}

	class Repeater {}
}

namespace {
	define( 'ABSPATH', true );
	define( 'VC_ELEMENTOR_HEADER_URL', 'https://example.test/wp-content/plugins/vitacenter-elementor-header/' );

	function esc_html__( $text, $domain = null ) { return $text; }
	function esc_attr__( $text, $domain = null ) { return $text; }
	function esc_html( $text ) { return htmlspecialchars( (string) $text, ENT_QUOTES, 'UTF-8' ); }
	function esc_attr( $text ) { return htmlspecialchars( (string) $text, ENT_QUOTES, 'UTF-8' ); }
	function esc_url( $url ) { return htmlspecialchars( (string) $url, ENT_QUOTES, 'UTF-8' ); }
	function wp_parse_args( $args, $defaults = array() ) {
		if ( is_object( $args ) ) {
			$args = get_object_vars( $args );
		} elseif ( ! is_array( $args ) ) {
			parse_str( (string) $args, $args );
		}

		return array_merge( $defaults, $args );
	}
	function sanitize_email( $email ) { return filter_var( (string) $email, FILTER_SANITIZE_EMAIL ); }
	function is_email( $email ) { return false !== filter_var( $email, FILTER_VALIDATE_EMAIL ); }
	function post_type_exists( $post_type ) { return false; }
	function remove_accents( $text ) {
		return strtr(
			(string) $text,
			array(
				'á' => 'a',
				'é' => 'e',
				'í' => 'i',
				'ó' => 'o',
				'ö' => 'o',
				'ő' => 'o',
				'ú' => 'u',
				'ü' => 'u',
				'ű' => 'u',
				'Á' => 'A',
				'É' => 'E',
				'Í' => 'I',
				'Ó' => 'O',
				'Ö' => 'O',
				'Ő' => 'O',
				'Ú' => 'U',
				'Ü' => 'U',
				'Ű' => 'U',
			)
		);
	}

	require __DIR__ . '/../includes/class-vc-elementor-structured-widgets.php';

	function render_widget( $class_name, $settings ) {
		$widget           = new $class_name();
		$widget->settings = $settings;
		$render           = new \ReflectionMethod( $class_name, 'render' );
		$render->setAccessible( true );
		ob_start();
		$render->invoke( $widget );
		ob_end_clean();
	}

	render_widget( 'VitaCenter_Legal_Footer_Widget', array() );
	render_widget(
		'VitaCenter_Legal_Footer_Widget',
		array(
			'website_link' => '',
			'address_link' => '',
			'phone'        => array( '+40 261 713 775' ),
			'email'        => array( 'efi@szatmar.ro' ),
		)
	);
	render_widget( 'VitaCenter_Landing_Contact_Widget', array() );
	render_widget( 'VitaCenter_Upcoming_Events_Widget', array() );
	render_widget( 'VitaCenter_All_Events_Widget', array() );

	echo "ok\n";
}
