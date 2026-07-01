<?php

namespace Elementor {
	class Widget_Base {
		public $settings = array();

		public function get_settings_for_display( $setting_key = null ) {
			if ( null === $setting_key ) {
				return $this->settings;
			}

			return is_array( $this->settings ) && array_key_exists( $setting_key, $this->settings ) ? $this->settings[ $setting_key ] : null;
		}
	}

	class Controls_Manager {
		const TEXT = 'text';
		const TEXTAREA = 'textarea';
		const URL = 'url';
		const MEDIA = 'media';
		const GALLERY = 'gallery';
		const NUMBER = 'number';
		const COLOR = 'color';
		const SWITCHER = 'switcher';
		const SELECT = 'select';
		const CHOOSE = 'choose';
		const TAB_STYLE = 'style';
	}

	class Repeater {
		public function add_control( $id, $args = array() ) {}
		public function get_controls() { return array(); }
	}
}

namespace {
	define( 'ABSPATH', true );
	define( 'VC_ELEMENTOR_HEADER_URL', '/' );

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
				'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ö' => 'o', 'ő' => 'o', 'ú' => 'u', 'ü' => 'u', 'ű' => 'u',
				'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ö' => 'O', 'Ő' => 'O', 'Ú' => 'U', 'Ü' => 'U', 'Ű' => 'U',
			)
		);
	}

	require __DIR__ . '/../includes/class-vc-elementor-structured-widgets.php';

	$widget = new VitaCenter_Knowledge_Widget();
	$render = new ReflectionMethod( 'VitaCenter_Knowledge_Widget', 'render' );
	$render->setAccessible( true );

	ob_start();
	$render->invoke( $widget );
	$content = ob_get_clean();
	?>
	<!doctype html>
	<html lang="hu">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>VitaCenter Tudástár Preview</title>
		<link rel="stylesheet" href="/assets/css/vc-landing.css">
		<style>
			body {
				margin: 0;
				background: #eef8f7;
				font-family: Arial, Helvetica, sans-serif;
			}

			.preview-topbar {
				position: sticky;
				z-index: 20;
				top: 0;
				padding: 12px 18px;
				background: #ffffff;
				border-bottom: 1px solid rgba(12, 143, 132, 0.16);
				color: #154f4b;
				font-size: 14px;
				font-weight: 800;
			}
		</style>
	</head>
	<body>
		<div class="preview-topbar">Lokális előnézet: VitaCenter Tudástár</div>
		<?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<script src="/assets/js/vc-landing.js"></script>
	</body>
	</html>
	<?php
}
