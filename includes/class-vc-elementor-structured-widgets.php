<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

abstract class VitaCenter_Structured_Widget_Base extends Widget_Base {
	public function get_categories() {
		return array( 'vitacenter' );
	}

	protected function source_asset_url( $file_name ) {
		return VC_ELEMENTOR_HEADER_URL . 'source/' . rawurlencode( $this->plain_text( $file_name ) );
	}

	protected function media_default( $file_name ) {
		return array( 'url' => $this->source_asset_url( $file_name ) );
	}

	protected function media_url( $media, $fallback_file = '' ) {
		if ( ! is_array( $media ) ) {
			return $fallback_file ? $this->source_asset_url( $fallback_file ) : '';
		}

		if ( ! empty( $media['url'] ) ) {
			return $this->plain_text( $media['url'] );
		}

		return $fallback_file ? $this->source_asset_url( $fallback_file ) : '';
	}

	protected function url_attributes( $url_control ) {
		if ( ! is_array( $url_control ) ) {
			$url_control = array( 'url' => $this->plain_text( $url_control ) );
		}

		$url = isset( $url_control['url'] ) ? $this->plain_text( $url_control['url'] ) : '';
		$url = '' !== $url ? $url : '#';
		$attrs = array( 'href="' . esc_url( $url ) . '"' );
		$rel = array();

		if ( ! empty( $url_control['is_external'] ) ) {
			$attrs[] = 'target="_blank"';
			$rel[] = 'noopener';
		}

		if ( ! empty( $url_control['nofollow'] ) ) {
			$rel[] = 'nofollow';
		}

		if ( $rel ) {
			$attrs[] = 'rel="' . esc_attr( implode( ' ', array_unique( $rel ) ) ) . '"';
		}

		return implode( ' ', $attrs );
	}

	protected function render_button( $text, $link, $class = 'vc-landing__button vc-landing__button--primary' ) {
		$text = $this->plain_text( $text );

		if ( '' === $text ) {
			return;
		}
		?>
		<a class="<?php echo esc_attr( $class ); ?>" <?php echo $this->url_attributes( $link ); ?>>
			<span><?php echo esc_html( $text ); ?></span>
			<i aria-hidden="true">&#8594;</i>
		</a>
		<?php
	}

	protected function render_text_link( $text, $link, $class = 'vc-landing__text-link' ) {
		$text = $this->plain_text( $text );

		if ( '' === $text ) {
			return;
		}
		?>
		<a class="<?php echo esc_attr( $class ); ?>" <?php echo $this->url_attributes( $link ); ?>>
			<span><?php echo esc_html( $text ); ?></span>
			<i aria-hidden="true">&#8594;</i>
		</a>
		<?php
	}

	protected function format_multiline( $text ) {
		return nl2br( esc_html( $this->plain_text( $text ) ) );
	}

	protected function plain_text( $value ) {
		if ( is_scalar( $value ) || null === $value ) {
			return trim( (string) $value );
		}

		return '';
	}

	protected function repeater_items( $items ) {
		if ( ! is_array( $items ) ) {
			return array();
		}

		return array_values(
			array_filter(
				$items,
				static function ( $item ) {
					return is_array( $item );
				}
			)
		);
	}

	protected function normalize_program_cards( $items ) {
		$normalized       = array();
		$has_mobil_szures = false;

		foreach ( $this->repeater_items( $items ) as $item ) {
			$title = isset( $item['title'] ) ? $item['title'] : '';
			$key   = $this->program_key( $title );

			if ( false !== strpos( $key, 'meddosegi' ) || false !== strpos( $key, 'meddoseg' ) ) {
				continue;
			}

			$item = $this->normalize_program_card( $item );

			if ( 'mobil-szures' === $this->program_key( $item['title'] ) ) {
				$has_mobil_szures = true;
			}

			$normalized[] = $item;
		}

		if ( ! $has_mobil_szures ) {
			$normalized[] = $this->mobil_szures_program_card();
		}

		return $normalized;
	}

	protected function normalize_program_card( $item ) {
		if ( ! is_array( $item ) ) {
			$item = array();
		}

		$title = isset( $item['title'] ) ? $item['title'] : '';
		$key   = $this->program_key( $title );

		$updates = array(
			'ciklusoktatas' => array(
				'text' => esc_html__( 'Nőknek szóló termékenységtudatosság.', 'vitacenter-elementor-header' ),
			),
			'egeszsegfejlesztesi-iroda' => array(
				'text' => esc_html__( 'Az egészséges életmódot, a betegségmegelőzést és a szűrővizsgálatok jelentőségét népszerűsítő tevékenységek.', 'vitacenter-elementor-header' ),
			),
			'mobil-szakorvosi-szolgalat' => array(
				'text' => esc_html__( 'Helyben elérhető szakvizsgálatok a könnyebb hozzáférésért.', 'vitacenter-elementor-header' ),
			),
			'eletmodtanacsadas' => array(
				'text' => esc_html__( 'Személyre szabott támogatás az egészséges életvitel kialakításához.', 'vitacenter-elementor-header' ),
			),
			'ovodas-iskolaerettseget-vizsgalo-szuresek' => array(
				'text' => esc_html__( 'Korai felismerés és támogatás a gyermekek fejlődésében.', 'vitacenter-elementor-header' ),
			),
		);

		if ( isset( $updates[ $key ] ) ) {
			$item = array_merge( $item, $updates[ $key ] );
		}

		$item['title']     = isset( $item['title'] ) ? $this->plain_text( $item['title'] ) : '';
		$item['text']      = isset( $item['text'] ) ? $this->plain_text( $item['text'] ) : '';
		$item['icon']      = isset( $item['icon'] ) ? $item['icon'] : array();
		$item['link_text'] = isset( $item['link_text'] ) && '' !== $this->plain_text( $item['link_text'] ) ? $this->plain_text( $item['link_text'] ) : esc_html__( 'Részletek', 'vitacenter-elementor-header' );
		$item['link']      = isset( $item['link'] ) ? $item['link'] : array( 'url' => '#' );

		return $item;
	}

	protected function mobil_szures_program_card() {
		return array(
			'title'     => esc_html__( 'Mobil szűrés', 'vitacenter-elementor-header' ),
			'text'      => esc_html__( 'Helyben elérhető onkológiai szűrések a könnyebb hozzáférésért.', 'vitacenter-elementor-header' ),
			'icon'      => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_20_40 PM (2).png' ),
			'link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ),
			'link'      => array( 'url' => '#mobil-szures' ),
		);
	}

	protected function program_key( $title ) {
		$title = $this->plain_text( $title );
		$title = function_exists( 'remove_accents' ) ? remove_accents( $title ) : $title;
		$key   = strtolower( (string) $title );
		$key   = preg_replace( '/[^a-z0-9]+/', '-', $key );

		return trim( (string) $key, '-' );
	}
}

class VitaCenter_Header_Top_Widget extends VitaCenter_Structured_Widget_Base {
	public function get_name() { return 'vitacenter_header_top'; }
	public function get_title() { return esc_html__( 'VitaCenter Header Top', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-header'; }
	public function get_style_depends() { return array( 'vc-header' ); }

	protected function register_controls() {
		$this->start_controls_section( 'brand_section', array( 'label' => esc_html__( 'EFI / projekt', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'brand_logo', array( 'label' => esc_html__( 'EFI logó', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::MEDIA, 'default' => $this->media_default( 'birodepromovare (1).png' ) ) );
		$this->add_control( 'brand_name', array( 'label' => esc_html__( 'Név', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Egészségfejlesztési Iroda', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'brand_subtitle', array( 'label' => esc_html__( 'Alcím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Szatmár megye', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'brand_link', array( 'label' => esc_html__( 'Logó link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => home_url( '/' ) ) ) );
		$this->add_control( 'project_code', array( 'label' => esc_html__( 'Projektkód', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => 'IPOP ROHU00259' ) );
		$this->add_control( 'project_program', array( 'label' => esc_html__( 'Programnév', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Interreg VI-A Románia-Magyarország Program', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'logos_section', array( 'label' => esc_html__( 'Jobb oldali logók', 'vitacenter-elementor-header' ) ) );
		$logos = new Repeater();
		$logos->add_control( 'logo', array( 'label' => esc_html__( 'Logó', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::MEDIA ) );
		$logos->add_control( 'label', array( 'label' => esc_html__( 'Felirat / alt', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Partner logó', 'vitacenter-elementor-header' ) ) );
		$logos->add_control( 'link', array( 'label' => esc_html__( 'Link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL ) );
		$logos->add_control( 'width', array( 'label' => esc_html__( 'Szélesség', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::NUMBER, 'default' => 120, 'min' => 40, 'max' => 240 ) );
		$this->add_control( 'logos', array(
			'label' => esc_html__( 'Logók', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $logos->get_controls(),
			'title_field' => '{{{ label }}}',
			'default' => array(
				array( 'label' => 'Interreg / EU', 'logo' => $this->media_default( 'Interreg-EU-Logo-HU-relmhvvgxeegg2g0fc635g8ctmtggeutabduarokcg.png' ), 'width' => 170 ),
				array( 'label' => 'Magyarország Kormánya', 'logo' => $this->media_default( 'Guvernul_Romaniei.svg_-relnwuofi05plmjfcibviwk42ouksvlwvsfdgiw4cg.png' ), 'width' => 70 ),
				array( 'label' => 'interreg-rohu.eu', 'width' => 120 ),
			),
		) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$logo = $this->media_url( $s['brand_logo'], 'birodepromovare (1).png' );
		?>
		<div class="vc-header vc-header--structured vc-header--top-only">
			<div class="vc-header__inner">
				<div class="vc-header__top">
					<div class="vc-header__identity">
						<a class="vc-header__brand" <?php echo $this->url_attributes( $s['brand_link'] ); ?>>
							<?php if ( $logo ) : ?><span class="vc-header__brand-logo"><img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( $s['brand_name'] ); ?>"></span><?php endif; ?>
							<span class="vc-header__brand-copy">
								<span class="vc-header__brand-name"><?php echo esc_html( $s['brand_name'] ); ?></span>
								<span class="vc-header__brand-subtitle"><?php echo esc_html( $s['brand_subtitle'] ); ?></span>
							</span>
						</a>
						<div class="vc-header__project">
							<span class="vc-header__project-code"><?php echo esc_html( $s['project_code'] ); ?></span>
							<span class="vc-header__project-program"><?php echo esc_html( $s['project_program'] ); ?></span>
						</div>
					</div>
					<div class="vc-header__partners">
						<?php foreach ( $s['logos'] as $item ) : ?>
							<?php
							$item_logo  = $this->media_url( isset( $item['logo'] ) ? $item['logo'] : array() );
							$item_label = isset( $item['label'] ) ? $item['label'] : '';
							$item_link  = isset( $item['link'] ) ? $item['link'] : array();
							$item_width = ! empty( $item['width'] ) ? absint( $item['width'] ) : 120;
							?>
							<a class="vc-header__partner" <?php echo $this->url_attributes( $item_link ); ?> style="--vc-partner-width: <?php echo esc_attr( $item_width ); ?>px;">
								<?php if ( $item_logo ) : ?><img src="<?php echo esc_url( $item_logo ); ?>" alt="<?php echo esc_attr( $item_label ); ?>"><?php else : ?><span><?php echo esc_html( $item_label ); ?></span><?php endif; ?>
							</a>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class VitaCenter_Header_Menu_Widget extends VitaCenter_Structured_Widget_Base {
	public function get_name() { return 'vitacenter_header_menu'; }
	public function get_title() { return esc_html__( 'VitaCenter Header Menu', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-nav-menu'; }
	public function get_style_depends() { return array( 'vc-header' ); }
	public function get_script_depends() { return array( 'vc-header' ); }

	protected function register_controls() {
		$this->start_controls_section( 'menu_section', array( 'label' => esc_html__( 'Menü', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'menu_source', array(
			'label' => esc_html__( 'Menü forrása', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'wp_menu',
			'options' => array(
				'wp_menu' => esc_html__( 'WordPress menü', 'vitacenter-elementor-header' ),
				'manual' => esc_html__( 'Kézi menüpontok', 'vitacenter-elementor-header' ),
			),
		) );
		$this->add_control( 'menu_id', array( 'label' => esc_html__( 'WordPress menü', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SELECT, 'options' => $this->menus(), 'default' => '0', 'condition' => array( 'menu_source' => 'wp_menu' ) ) );
		$this->add_control( 'mobile_label', array( 'label' => esc_html__( 'Mobil gomb felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Menü', 'vitacenter-elementor-header' ) ) );
		$items = new Repeater();
		$items->add_control( 'label', array( 'label' => esc_html__( 'Felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Menüpont', 'vitacenter-elementor-header' ) ) );
		$items->add_control( 'link', array( 'label' => esc_html__( 'Link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->add_control( 'manual_items', array(
			'label' => esc_html__( 'Kézi menüpontok', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $items->get_controls(),
			'title_field' => '{{{ label }}}',
			'condition' => array( 'menu_source' => 'manual' ),
			'default' => array(
				array( 'label' => esc_html__( 'Főoldal', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ) ),
				array( 'label' => esc_html__( 'Projekt', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#projekt' ) ),
				array( 'label' => esc_html__( 'Programjaink', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#programok' ) ),
				array( 'label' => esc_html__( 'Események', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#esemenyek' ) ),
				array( 'label' => esc_html__( 'Fotó- és videógaléria', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#galeria' ) ),
				array( 'label' => esc_html__( 'Partnerek', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#partnerek' ) ),
				array( 'label' => esc_html__( 'Tudástár', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#tudastar' ) ),
				array( 'label' => esc_html__( 'Kapcsolat', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#kapcsolat' ) ),
			),
		) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$nav_id = 'vc-header-nav-' . esc_attr( $this->get_id() );
		$menu_source = isset( $s['menu_source'] ) ? $s['menu_source'] : 'wp_menu';
		?>
		<div class="vc-header vc-header--structured vc-header--menu-only">
			<div class="vc-header__inner">
				<div class="vc-header__nav-row">
					<button class="vc-header__toggle" type="button" aria-controls="<?php echo esc_attr( $nav_id ); ?>" aria-expanded="false">
						<span class="vc-header__toggle-bars" aria-hidden="true"></span>
						<span class="vc-header__toggle-label"><?php echo esc_html( $s['mobile_label'] ); ?></span>
					</button>
					<nav id="<?php echo esc_attr( $nav_id ); ?>" class="vc-header__nav" aria-label="<?php echo esc_attr__( 'Fő navigáció', 'vitacenter-elementor-header' ); ?>">
						<?php
						if ( 'manual' === $menu_source ) {
							$this->render_manual_menu( isset( $s['manual_items'] ) ? $s['manual_items'] : array() );
						} elseif ( ! empty( $s['menu_id'] ) ) {
							wp_nav_menu( array(
								'menu' => absint( $s['menu_id'] ),
								'menu_class' => 'vc-header__menu',
								'container' => false,
								'fallback_cb' => false,
								'depth' => 3,
								'link_before' => '<span>',
								'link_after' => '</span>',
							) );
						}
						?>
					</nav>
				</div>
			</div>
		</div>
		<?php
	}

	private function render_manual_menu( $items ) {
		if ( empty( $items ) || ! is_array( $items ) ) {
			return;
		}
		?>
		<ul class="vc-header__menu vc-header__menu--manual">
			<?php foreach ( $items as $item ) : ?>
				<?php
				$label = isset( $item['label'] ) ? $item['label'] : '';
				$link  = isset( $item['link'] ) ? $item['link'] : array();
				if ( '' === $label ) {
					continue;
				}
				?>
				<li><a <?php echo $this->url_attributes( $link ); ?>><span><?php echo esc_html( $label ); ?></span></a></li>
			<?php endforeach; ?>
		</ul>
		<?php
	}

	private function menus() {
		$options = array( '0' => esc_html__( 'Válassz menüt', 'vitacenter-elementor-header' ) );
		foreach ( wp_get_nav_menus() as $menu ) {
			$options[ (string) $menu->term_id ] = $menu->name;
		}
		return $options;
	}
}

class VitaCenter_Landing_Hero_Widget extends VitaCenter_Structured_Widget_Base {
	public function get_name() { return 'vitacenter_landing_hero'; }
	public function get_title() { return esc_html__( 'VitaCenter Hero', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-banner'; }
	public function get_style_depends() { return array( 'vc-landing' ); }
	public function get_script_depends() { return array( 'vc-landing' ); }

	protected function register_controls() {
		$this->start_controls_section( 'hero_section', array( 'label' => esc_html__( 'Hero', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'image', array( 'label' => esc_html__( 'Háttérkép', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::MEDIA, 'default' => $this->media_default( 'index_hero_vitacenter.jpg' ) ) );
		$this->add_control( 'title', array( 'label' => esc_html__( 'Címsor', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => "Szűrés. Prevenció. Egészséges életmód.\nEgyütt a hosszabb életért!" ) );
		$this->add_control( 'text', array( 'label' => esc_html__( 'Alcím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Szűrővizsgálatok, tanácsadás és közösségi programok Szatmár megyében - a megelőzés és az egészségtudatos életmód szolgálatában.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'primary_text', array( 'label' => esc_html__( 'Első gomb', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Programok megtekintése', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'primary_link', array( 'label' => esc_html__( 'Első link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#programok' ) ) );
		$this->add_control( 'secondary_text', array( 'label' => esc_html__( 'Második gomb', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Időpontfoglalás', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'secondary_link', array( 'label' => esc_html__( 'Második link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#kapcsolat' ) ) );
		$this->add_control( 'badge', array( 'label' => esc_html__( 'Lebegő ikon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::MEDIA, 'default' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_20_41 PM (5).png' ) ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$hero = $this->media_url( $s['image'], 'index_hero_vitacenter.jpg' );
		$badge = $this->media_url( $s['badge'], 'ChatGPT Image Apr 27, 2026, 02_20_41 PM (5).png' );
		?>
		<div class="vc-landing" style="<?php echo esc_attr( '--vc-landing-hero-image: url("' . esc_url( $hero ) . '");' ); ?>">
			<section class="vc-landing__hero">
				<div class="vc-landing__hero-dots" aria-hidden="true"></div>
				<div class="vc-landing__container vc-landing__hero-inner">
					<div class="vc-landing__hero-copy">
						<h1 class="vc-landing__hero-title"><?php echo $this->format_multiline( $s['title'] ); ?></h1>
						<p><?php echo esc_html( $s['text'] ); ?></p>
						<div class="vc-landing__hero-actions">
							<?php $this->render_button( $s['primary_text'], $s['primary_link'] ); ?>
							<?php $this->render_button( $s['secondary_text'], $s['secondary_link'], 'vc-landing__button vc-landing__button--outline vc-landing__button--calendar' ); ?>
						</div>
					</div>
				</div>
				<?php if ( $badge ) : ?><div class="vc-landing__hero-badge"><img src="<?php echo esc_url( $badge ); ?>" alt=""></div><?php endif; ?>
			</section>
		</div>
		<?php
	}
}

class VitaCenter_Landing_Project_Widget extends VitaCenter_Structured_Widget_Base {
	public function get_name() { return 'vitacenter_landing_project_intro'; }
	public function get_title() { return esc_html__( 'VitaCenter Project Intro', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-info-circle'; }
	public function get_style_depends() { return array( 'vc-landing' ); }
	public function get_script_depends() { return array( 'vc-landing' ); }

	protected function register_controls() {
		$this->start_controls_section( 'about_section', array( 'label' => esc_html__( 'Projekt intro', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'icon', array( 'label' => esc_html__( 'Ikon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::MEDIA, 'default' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_20_40 PM (1).png' ) ) );
		$this->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'A projektről', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'text', array( 'label' => esc_html__( 'Leírás', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A „Népesedési folyamatok javítása helyi szinten egészségfejlesztési módszerekkel” elnevezésű IPOP ROHU00259-es számú projekt célja, hogy hozzájáruljon Szatmár megye lakosságának egészségi állapotának javításához, valamint a demográfiai kihívások kezeléséhez. A kezdeményezés a Szatmárnémeti Egészségfejlesztési Iroda létrehozása mellett a megelőzésre, az egészségtudatosság növelésére és a család- és közösségalapú ellátás erősítésére épül.', 'vitacenter-elementor-header' ) ) );
		$focus = new Repeater();
		$focus->add_control( 'icon', array( 'label' => esc_html__( 'Ikon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::MEDIA ) );
		$focus->add_control( 'title', array( 'label' => esc_html__( 'Felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Fókuszpont', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'items', array(
			'label' => esc_html__( 'Fókuszpontok', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $focus->get_controls(),
			'title_field' => '{{{ title }}}',
			'default' => array(
				array( 'title' => esc_html__( 'Egészségi állapot javítása', 'vitacenter-elementor-header' ), 'icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_20_41 PM (5).png' ) ),
				array( 'title' => esc_html__( 'Demográfiai kihívások kezelése', 'vitacenter-elementor-header' ), 'icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_20_41 PM (4).png' ) ),
				array( 'title' => esc_html__( 'Közösségi alapú ellátás', 'vitacenter-elementor-header' ), 'icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_20_40 PM (3).png' ) ),
				array( 'title' => esc_html__( 'Prevenció és életmódprogramok', 'vitacenter-elementor-header' ), 'icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_20_40 PM (2).png' ) ),
			),
		) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$icon = $this->media_url( $s['icon'] );
		?>
		<div class="vc-landing">
			<section class="vc-landing__about">
				<div class="vc-landing__container vc-landing__about-grid">
					<div class="vc-landing__about-copy">
						<?php if ( $icon ) : ?><div class="vc-landing__round-icon"><img src="<?php echo esc_url( $icon ); ?>" alt=""></div><?php endif; ?>
						<div><h2 class="vc-landing__section-title vc-landing__section-title--left"><?php echo esc_html( $s['title'] ); ?></h2><p><?php echo esc_html( $s['text'] ); ?></p></div>
					</div>
					<div class="vc-landing__focus-list">
						<?php foreach ( $s['items'] as $item ) : ?>
							<?php $item_icon = $this->media_url( $item['icon'] ); ?>
							<div class="vc-landing__focus-item"><?php if ( $item_icon ) : ?><span><img src="<?php echo esc_url( $item_icon ); ?>" alt=""></span><?php endif; ?><strong><?php echo esc_html( $item['title'] ); ?></strong></div>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
		</div>
		<?php
	}
}

class VitaCenter_Landing_Programs_Widget extends VitaCenter_Structured_Widget_Base {
	public function get_name() { return 'vitacenter_landing_programs'; }
	public function get_title() { return esc_html__( 'VitaCenter Programs', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-posts-grid'; }
	public function get_style_depends() { return array( 'vc-landing' ); }
	public function get_script_depends() { return array( 'vc-landing' ); }

	protected function register_controls() {
		$this->start_controls_section( 'programs_section', array( 'label' => esc_html__( 'Programok', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'title', array( 'label' => esc_html__( 'Szekció címe', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kiemelt programok', 'vitacenter-elementor-header' ) ) );
		$r = new Repeater();
		$r->add_control( 'icon', array( 'label' => esc_html__( 'Ikon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::MEDIA ) );
		$r->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Program', 'vitacenter-elementor-header' ) ) );
		$r->add_control( 'text', array( 'label' => esc_html__( 'Leírás', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Rövid programleírás.', 'vitacenter-elementor-header' ) ) );
		$r->add_control( 'link_text', array( 'label' => esc_html__( 'Link felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ) ) );
		$r->add_control( 'link', array( 'label' => esc_html__( 'Link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->add_control( 'items', array(
			'label' => esc_html__( 'Programkártyák', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $r->get_controls(),
			'title_field' => '{{{ title }}}',
			'default' => array(
				array( 'title' => esc_html__( 'Ciklusoktatás', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Nőknek szóló termékenységtudatosság.', 'vitacenter-elementor-header' ), 'icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_00 PM (1).png' ), 'link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#ciklusoktatas' ) ),
				array( 'title' => esc_html__( 'Egészségfejlesztési Iroda', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Az egészséges életmódot, a betegségmegelőzést és a szűrővizsgálatok jelentőségét népszerűsítő tevékenységek.', 'vitacenter-elementor-header' ), 'icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_00 PM (3).png' ), 'link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#efi' ) ),
				array( 'title' => esc_html__( 'Mobil szakorvosi szolgálat', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Helyben elérhető szakvizsgálatok a könnyebb hozzáférésért.', 'vitacenter-elementor-header' ), 'icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_01 PM (4).png' ), 'link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#mobil-szakorvosi' ) ),
				array( 'title' => esc_html__( 'Mobil szűrés', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Helyben elérhető onkológiai szűrések a könnyebb hozzáférésért.', 'vitacenter-elementor-header' ), 'icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_20_40 PM (2).png' ), 'link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#mobil-szures' ) ),
				array( 'title' => esc_html__( 'Életmódtanácsadás', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Személyre szabott támogatás az egészséges életvitel kialakításához.', 'vitacenter-elementor-header' ), 'icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_01 PM (5).png' ), 'link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#eletmodtanacsadas' ) ),
				array( 'title' => esc_html__( 'Óvodás iskolaérettséget vizsgáló szűrések', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Korai felismerés és támogatás a gyermekek fejlődésében.', 'vitacenter-elementor-header' ), 'icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_01 PM (6).png' ), 'link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#ovodas-szuresek' ) ),
			),
		) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$items = $this->normalize_program_cards( isset( $s['items'] ) && is_array( $s['items'] ) ? $s['items'] : array() );
		?>
		<div class="vc-landing">
			<section id="programok" class="vc-landing__section vc-landing__programs">
				<div class="vc-landing__container">
					<h2 class="vc-landing__section-title"><?php echo esc_html( $s['title'] ); ?></h2>
					<div class="vc-landing__program-grid">
						<?php foreach ( $items as $item ) : ?>
							<?php $icon = $this->media_url( $item['icon'] ); ?>
							<article class="vc-landing__program-card"><?php if ( $icon ) : ?><img class="vc-landing__program-icon" src="<?php echo esc_url( $icon ); ?>" alt=""><?php endif; ?><h3><?php echo esc_html( $item['title'] ); ?></h3><p><?php echo esc_html( $item['text'] ); ?></p><?php $this->render_text_link( $item['link_text'], $item['link'] ); ?></article>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
		</div>
		<?php
	}
}

class VitaCenter_Landing_Events_Widget extends VitaCenter_Structured_Widget_Base {
	public function get_name() { return 'vitacenter_landing_events'; }
	public function get_title() { return esc_html__( 'VitaCenter Events', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-calendar'; }
	public function get_style_depends() { return array( 'vc-landing' ); }
	public function get_script_depends() { return array( 'vc-landing' ); }

	protected function register_controls() {
		$this->start_controls_section( 'events_section', array( 'label' => esc_html__( 'The Events Calendar', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'title', array( 'label' => esc_html__( 'Szekció címe', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Közelgő események', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'intro', array( 'label' => esc_html__( 'Bevezető szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Vegyen részt szűréseinken, workshopjainkon és közösségi programjainkon!', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'all_text', array( 'label' => esc_html__( 'Összes link felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Összes esemény megtekintése', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'all_link', array( 'label' => esc_html__( 'Összes link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#esemenyek' ) ) );
		$this->add_control( 'limit', array( 'label' => esc_html__( 'Események száma', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::NUMBER, 'default' => 3, 'min' => 1, 'max' => 12 ) );
		$this->add_control( 'show_empty', array( 'label' => esc_html__( 'Üres állapot mutatása', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$events = $this->get_tribe_events( max( 1, absint( $s['limit'] ) ) );
		?>
		<div class="vc-landing">
			<section id="esemenyek" class="vc-landing__section vc-landing__events">
				<div class="vc-landing__container">
					<div class="vc-landing__section-head">
						<div>
							<h2 class="vc-landing__section-title vc-landing__section-title--left"><?php echo esc_html( $s['title'] ); ?></h2>
							<?php if ( ! empty( $s['intro'] ) ) : ?><p class="vc-landing__section-lead"><?php echo esc_html( $s['intro'] ); ?></p><?php endif; ?>
						</div>
						<?php $this->render_text_link( $s['all_text'], $s['all_link'], 'vc-landing__all-link' ); ?>
					</div>
					<?php if ( $events ) : ?>
						<div class="vc-landing__event-grid">
							<?php foreach ( $events as $event ) : $this->render_event_card( $event ); endforeach; ?>
						</div>
					<?php elseif ( 'yes' === $s['show_empty'] ) : ?>
						<div class="vc-landing__empty"><?php echo esc_html__( 'Jelenleg nincs meghirdetett közelgő esemény.', 'vitacenter-elementor-header' ); ?></div>
					<?php endif; ?>
				</div>
			</section>
		</div>
		<?php
	}

	private function get_tribe_events( $limit ) {
		if ( ! post_type_exists( 'tribe_events' ) ) {
			return array();
		}

		$query = new WP_Query( array(
			'post_type' => 'tribe_events',
			'posts_per_page' => $limit,
			'post_status' => 'publish',
			'meta_key' => '_EventStartDate',
			'orderby' => 'meta_value',
			'order' => 'ASC',
			'meta_query' => array(
				array(
					'key' => '_EventStartDate',
					'value' => current_time( 'Y-m-d H:i:s' ),
					'compare' => '>=',
					'type' => 'DATETIME',
				),
			),
			'no_found_rows' => true,
		) );
		$events = array();
		foreach ( $query->posts as $post ) {
			$events[] = $this->format_tribe_event( $post->ID );
		}
		wp_reset_postdata();
		return $events;
	}

	private function format_tribe_event( $event_id ) {
		$start = get_post_meta( $event_id, '_EventStartDate', true );
		$end = get_post_meta( $event_id, '_EventEndDate', true );
		$ts = $start && strtotime( $start ) ? strtotime( $start ) : 0;
		$end_ts = $end && strtotime( $end ) ? strtotime( $end ) : 0;
		$month = $ts ? date_i18n( 'M', $ts ) : '';
		$date_display = '';
		$venue = '';
		if ( $ts ) {
			$date_display = function_exists( 'tribe_get_start_date' ) ? tribe_get_start_date( $event_id, false, 'Y. F j. H:i' ) : date_i18n( 'Y. F j. H:i', $ts );
			if ( $end_ts && date_i18n( 'Y-m-d', $ts ) !== date_i18n( 'Y-m-d', $end_ts ) ) {
				$date_display = date_i18n( 'Y. F j.', $ts ) . ' - ' . date_i18n( 'j.', $end_ts );
			}
		}
		if ( function_exists( 'tribe_get_venue' ) ) {
			$venue = tribe_get_venue( $event_id );
		}
		if ( ! $venue ) {
			$venue_id = get_post_meta( $event_id, '_EventVenueID', true );
			$venue = $venue_id ? get_the_title( (int) $venue_id ) : '';
		}
		$excerpt = get_the_excerpt( $event_id );
		$excerpt = $excerpt ? wp_trim_words( wp_strip_all_tags( $excerpt ), 14, '...' ) : wp_trim_words( wp_strip_all_tags( get_post_field( 'post_content', $event_id ) ), 14, '...' );
		return array(
			'title' => get_the_title( $event_id ),
			'url' => get_permalink( $event_id ),
			'image' => get_the_post_thumbnail_url( $event_id, 'large' ),
			'month' => $month ? ( function_exists( 'mb_strtoupper' ) ? mb_strtoupper( $month, 'UTF-8' ) : strtoupper( $month ) ) : '',
			'day' => $ts ? date_i18n( 'j', $ts ) : '',
			'date' => $date_display,
			'venue' => $venue,
			'excerpt' => $excerpt,
		);
	}

	private function render_event_card( $event ) {
		?>
		<article class="vc-landing__event-card <?php echo empty( $event['image'] ) ? 'vc-landing__event-card--no-image' : ''; ?>">
			<?php if ( $event['image'] ) : ?><a class="vc-landing__event-image-link" href="<?php echo esc_url( $event['url'] ); ?>" aria-label="<?php echo esc_attr( $event['title'] ); ?>"><img class="vc-landing__event-image" src="<?php echo esc_url( $event['image'] ); ?>" alt="<?php echo esc_attr( $event['title'] ); ?>" loading="lazy"></a><?php endif; ?>
			<div class="vc-landing__event-body">
				<?php if ( $event['month'] || $event['day'] ) : ?><div class="vc-landing__date-badge"><span class="vc-landing__date-month"><?php echo esc_html( $event['month'] ); ?></span><span class="vc-landing__date-day"><?php echo esc_html( $event['day'] ); ?></span></div><?php endif; ?>
				<h3><a href="<?php echo esc_url( $event['url'] ); ?>"><?php echo esc_html( $event['title'] ); ?></a></h3>
				<?php if ( $event['excerpt'] ) : ?><p><?php echo esc_html( $event['excerpt'] ); ?></p><?php endif; ?>
				<ul><?php if ( $event['date'] ) : ?><li><?php echo esc_html( $event['date'] ); ?></li><?php endif; ?><?php if ( $event['venue'] ) : ?><li><?php echo esc_html( $event['venue'] ); ?></li><?php endif; ?></ul>
				<?php $this->render_text_link( esc_html__( 'Részletek', 'vitacenter-elementor-header' ), array( 'url' => $event['url'] ), 'vc-landing__small-button' ); ?>
			</div>
		</article>
		<?php
	}
}

class VitaCenter_Upcoming_Events_Widget extends VitaCenter_Structured_Widget_Base {
	public function get_name() { return 'vitacenter_upcoming_events'; }
	public function get_title() { return esc_html__( 'VitaCenter Upcoming Events', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-calendar'; }
	public function get_style_depends() { return array( 'vc-landing' ); }
	public function get_script_depends() { return array( 'vc-landing' ); }

	protected function register_controls() {
		$this->start_controls_section( 'events_section', array( 'label' => esc_html__( 'Közelgő események', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'limit', array( 'label' => esc_html__( 'Események száma', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::NUMBER, 'default' => 3, 'min' => 1, 'max' => 12 ) );
		$this->add_control( 'show_empty', array( 'label' => esc_html__( 'Üres állapot mutatása', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$this->add_control( 'category_text', array( 'label' => esc_html__( 'Kategória felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Közelgő esemény', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'button_text', array( 'label' => esc_html__( 'Gomb felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'empty_text', array( 'label' => esc_html__( 'Üres állapot szövege', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Jelenleg nincs meghirdetett közelgő esemény.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'unavailable_text', array( 'label' => esc_html__( 'Eseménykezelő hiányzik szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Az eseménykezelő jelenleg nem érhető el.', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = wp_parse_args(
			$this->get_settings_for_display(),
			array(
				'limit'            => 3,
				'show_empty'       => 'yes',
				'category_text'    => esc_html__( 'Közelgő esemény', 'vitacenter-elementor-header' ),
				'button_text'      => esc_html__( 'Részletek', 'vitacenter-elementor-header' ),
				'empty_text'       => esc_html__( 'Jelenleg nincs meghirdetett közelgő esemény.', 'vitacenter-elementor-header' ),
				'unavailable_text' => esc_html__( 'Az eseménykezelő jelenleg nem érhető el.', 'vitacenter-elementor-header' ),
			)
		);

		$limit      = max( 1, min( 12, (int) $this->plain_text( $s['limit'] ) ) );
		$show_empty = 'yes' === $this->plain_text( $s['show_empty'] );
		$events     = $this->get_upcoming_events( $limit );

		if ( false === $events && ! $show_empty ) {
			return;
		}

		if ( is_array( $events ) && empty( $events ) && ! $show_empty ) {
			return;
		}
		?>
		<div class="vc-landing">
			<section class="efi-events-section" aria-label="<?php echo esc_attr__( 'Közelgő események', 'vitacenter-elementor-header' ); ?>">
				<div class="vc-landing__container">
					<?php if ( false === $events ) : ?>
						<div class="efi-events-empty"><?php echo esc_html( $this->plain_text( $s['unavailable_text'] ) ); ?></div>
					<?php elseif ( $events ) : ?>
						<div class="efi-events-grid">
							<?php foreach ( $events as $event ) : ?>
								<?php $this->render_upcoming_event_card( $event, $s ); ?>
							<?php endforeach; ?>
						</div>
					<?php else : ?>
						<div class="efi-events-empty"><?php echo esc_html( $this->plain_text( $s['empty_text'] ) ); ?></div>
					<?php endif; ?>
				</div>
			</section>
		</div>
		<?php
	}

	protected function get_upcoming_events( $limit ) {
		if ( ! post_type_exists( 'tribe_events' ) ) {
			return false;
		}

		$events_query = new WP_Query(
			array(
				'post_type'      => 'tribe_events',
				'posts_per_page' => $limit,
				'post_status'    => 'publish',
				'meta_key'       => '_EventStartDate',
				'orderby'        => 'meta_value',
				'order'          => 'ASC',
				'meta_query'     => array(
					array(
						'key'     => '_EventStartDate',
						'value'   => current_time( 'Y-m-d H:i:s' ),
						'compare' => '>=',
						'type'    => 'DATETIME',
					),
				),
				'no_found_rows'  => true,
			)
		);

		$events = array();

		while ( $events_query->have_posts() ) {
			$events_query->the_post();
			$events[] = $this->format_upcoming_event( get_the_ID() );
		}

		wp_reset_postdata();

		return $events;
	}

	protected function format_upcoming_event( $event_id ) {
		$start_date_raw = get_post_meta( $event_id, '_EventStartDate', true );
		$end_date_raw   = get_post_meta( $event_id, '_EventEndDate', true );
		$start_ts       = ! empty( $start_date_raw ) && strtotime( $start_date_raw ) ? strtotime( $start_date_raw ) : 0;
		$end_ts         = ! empty( $end_date_raw ) && strtotime( $end_date_raw ) ? strtotime( $end_date_raw ) : 0;
		$date_display   = '';

		if ( $start_ts ) {
			$date_display = function_exists( 'tribe_get_start_date' ) ? tribe_get_start_date( $event_id, false, 'Y. F j. H:i' ) : date_i18n( 'Y. F j. H:i', $start_ts );

			if ( $end_ts && date_i18n( 'Y-m-d', $start_ts ) !== date_i18n( 'Y-m-d', $end_ts ) ) {
				$date_display = date_i18n( 'Y. F j.', $start_ts ) . ' – ' . date_i18n( 'j.', $end_ts );
			}
		}

		$venue = '';

		if ( function_exists( 'tribe_get_venue' ) ) {
			$venue = tribe_get_venue( $event_id );
		}

		if ( empty( $venue ) ) {
			$venue_id = get_post_meta( $event_id, '_EventVenueID', true );

			if ( ! empty( $venue_id ) && is_numeric( $venue_id ) ) {
				$venue_post = get_post( (int) $venue_id );

				if ( $venue_post && ! is_wp_error( $venue_post ) ) {
					$venue = $venue_post->post_title;
				}
			}
		}

		$excerpt = get_the_excerpt( $event_id );

		if ( empty( $excerpt ) ) {
			$excerpt = wp_trim_words( wp_strip_all_tags( get_post_field( 'post_content', $event_id ) ), 18, '...' );
		} else {
			$excerpt = wp_trim_words( wp_strip_all_tags( $excerpt ), 18, '...' );
		}

		$month = $start_ts ? date_i18n( 'M', $start_ts ) : '';

		return array(
			'id'      => $event_id,
			'title'   => get_the_title( $event_id ),
			'url'     => get_permalink( $event_id ),
			'image'   => get_the_post_thumbnail_url( $event_id, 'large' ),
			'month'   => $month ? ( function_exists( 'mb_strtoupper' ) ? mb_strtoupper( $month, 'UTF-8' ) : strtoupper( $month ) ) : '',
			'day'     => $start_ts ? date_i18n( 'j', $start_ts ) : '',
			'date'    => $date_display,
			'venue'   => $venue,
			'excerpt' => $excerpt,
			'start_ts' => $start_ts,
		);
	}

	protected function render_upcoming_event_card( $event, $settings ) {
		$has_image      = ! empty( $event['image'] );
		$has_date_badge = ! empty( $event['month'] ) || ! empty( $event['day'] );
		$has_meta       = ! empty( $event['date'] ) || ! empty( $event['venue'] );
		$card_classes   = array( 'efi-event-card' );

		if ( ! $has_image ) {
			$card_classes[] = 'efi-event-card--no-image';
		}

		if ( ! empty( $event['is_past'] ) ) {
			$card_classes[] = 'efi-event-card--past';
		}
		?>
		<article class="<?php echo esc_attr( implode( ' ', $card_classes ) ); ?>">
			<div class="efi-event-media">
				<?php if ( ! empty( $event['url'] ) ) : ?>
					<a class="efi-event-image-link" href="<?php echo esc_url( $event['url'] ); ?>" aria-label="<?php echo esc_attr( $event['title'] ); ?>">
				<?php endif; ?>

				<?php if ( $has_image ) : ?>
					<img class="efi-event-image" src="<?php echo esc_url( $event['image'] ); ?>" alt="<?php echo esc_attr( $event['title'] ); ?>" loading="lazy">
				<?php else : ?>
					<div class="efi-event-placeholder" aria-hidden="true">
						<svg viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg">
							<circle cx="48" cy="48" r="44" fill="#e8f7f6"/>
							<rect x="27" y="31" width="42" height="36" rx="8" fill="#ffffff"/>
							<path d="M34 27v11M62 27v11M34 47h28M34 56h18" stroke="#0c8f84" stroke-width="4" stroke-linecap="round"/>
						</svg>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $event['url'] ) ) : ?>
					</a>
				<?php endif; ?>

				<?php if ( $has_date_badge ) : ?>
					<div class="efi-event-date-badge" aria-label="<?php echo esc_attr__( 'Esemény dátuma', 'vitacenter-elementor-header' ); ?>">
						<?php if ( ! empty( $event['month'] ) ) : ?><span class="efi-event-month"><?php echo esc_html( $event['month'] ); ?></span><?php endif; ?>
						<?php if ( ! empty( $event['day'] ) ) : ?><span class="efi-event-day"><?php echo esc_html( $event['day'] ); ?></span><?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $event['status_label'] ) ) : ?>
					<div class="efi-event-status"><?php echo esc_html( $event['status_label'] ); ?></div>
				<?php endif; ?>
			</div>

			<div class="efi-event-content">
				<?php if ( '' !== $this->plain_text( $settings['category_text'] ) ) : ?><div class="efi-event-category"><?php echo esc_html( $this->plain_text( $settings['category_text'] ) ); ?></div><?php endif; ?>
				<?php if ( ! empty( $event['title'] ) ) : ?>
					<h3 class="efi-event-title">
						<?php if ( ! empty( $event['url'] ) ) : ?><a href="<?php echo esc_url( $event['url'] ); ?>"><?php echo esc_html( $event['title'] ); ?></a><?php else : ?><?php echo esc_html( $event['title'] ); ?><?php endif; ?>
					</h3>
				<?php endif; ?>
				<?php if ( ! empty( $event['excerpt'] ) ) : ?><p class="efi-event-excerpt"><?php echo esc_html( $event['excerpt'] ); ?></p><?php endif; ?>
				<?php if ( $has_meta ) : ?>
					<div class="efi-event-meta">
						<?php if ( ! empty( $event['date'] ) ) : ?>
							<div class="efi-event-meta-row">
								<span class="efi-event-meta-icon" aria-hidden="true"><?php $this->render_upcoming_event_meta_icon( 'time' ); ?></span>
								<span><?php echo esc_html( $event['date'] ); ?></span>
							</div>
						<?php endif; ?>
						<?php if ( ! empty( $event['venue'] ) ) : ?>
							<div class="efi-event-meta-row">
								<span class="efi-event-meta-icon" aria-hidden="true"><?php $this->render_upcoming_event_meta_icon( 'pin' ); ?></span>
								<span><?php echo esc_html( $event['venue'] ); ?></span>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( $event['url'] ) && '' !== $this->plain_text( $settings['button_text'] ) ) : ?>
					<a class="efi-event-button" href="<?php echo esc_url( $event['url'] ); ?>">
						<span><?php echo esc_html( $this->plain_text( $settings['button_text'] ) ); ?></span>
						<span aria-hidden="true">&#8594;</span>
					</a>
				<?php endif; ?>
			</div>
		</article>
		<?php
	}

	protected function render_upcoming_event_meta_icon( $type ) {
		if ( 'pin' === $type ) :
			?>
			<svg viewBox="0 0 24 24">
				<path d="M12 21s7-6.1 7-12a7 7 0 1 0-14 0c0 5.9 7 12 7 12z" fill="none" stroke="currentColor" stroke-width="2"/>
				<circle cx="12" cy="9" r="2.5" fill="none" stroke="currentColor" stroke-width="2"/>
			</svg>
			<?php
			return;
		endif;
		?>
		<svg viewBox="0 0 24 24">
			<circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="2"/>
			<path d="M12 7v5l3.5 2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>
		<?php
	}
}

class VitaCenter_All_Events_Widget extends VitaCenter_Upcoming_Events_Widget {
	public function get_name() { return 'vitacenter_all_events'; }
	public function get_title() { return esc_html__( 'All Events', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-calendar'; }
	public function get_style_depends() { return array( 'vc-landing' ); }
	public function get_script_depends() { return array( 'vc-landing' ); }

	protected function register_controls() {
		$this->start_controls_section( 'events_section', array( 'label' => esc_html__( 'Összes esemény', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'upcoming_title', array( 'label' => esc_html__( 'Jövőbeli blokk címe', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Közelgő események', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'past_title', array( 'label' => esc_html__( 'Elmúlt blokk címe', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Elmúlt események', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'upcoming_category_text', array( 'label' => esc_html__( 'Jövőbeli kártya címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Közelgő esemény', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'past_category_text', array( 'label' => esc_html__( 'Elmúlt kártya címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Elmúlt esemény', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'past_status_text', array( 'label' => esc_html__( 'Elmúlt jelölő felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Elmúlt', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'button_text', array( 'label' => esc_html__( 'Gomb felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'show_empty', array( 'label' => esc_html__( 'Üres állapot mutatása', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$this->add_control( 'empty_text', array( 'label' => esc_html__( 'Üres állapot szövege', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Jelenleg nincs megjeleníthető esemény.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'unavailable_text', array( 'label' => esc_html__( 'Eseménykezelő hiányzik szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Az eseménykezelő jelenleg nem érhető el.', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = wp_parse_args(
			$this->get_settings_for_display(),
			array(
				'upcoming_title'         => esc_html__( 'Közelgő események', 'vitacenter-elementor-header' ),
				'past_title'             => esc_html__( 'Elmúlt események', 'vitacenter-elementor-header' ),
				'upcoming_category_text' => esc_html__( 'Közelgő esemény', 'vitacenter-elementor-header' ),
				'past_category_text'     => esc_html__( 'Elmúlt esemény', 'vitacenter-elementor-header' ),
				'past_status_text'       => esc_html__( 'Elmúlt', 'vitacenter-elementor-header' ),
				'button_text'            => esc_html__( 'Részletek', 'vitacenter-elementor-header' ),
				'show_empty'             => 'yes',
				'empty_text'             => esc_html__( 'Jelenleg nincs megjeleníthető esemény.', 'vitacenter-elementor-header' ),
				'unavailable_text'       => esc_html__( 'Az eseménykezelő jelenleg nem érhető el.', 'vitacenter-elementor-header' ),
			)
		);

		$show_empty = 'yes' === $this->plain_text( $s['show_empty'] );
		$groups     = $this->get_all_events_groups( $s );

		if ( false === $groups && ! $show_empty ) {
			return;
		}

		if ( is_array( $groups ) && empty( $groups['upcoming'] ) && empty( $groups['past'] ) && ! $show_empty ) {
			return;
		}
		?>
		<div class="vc-landing">
			<section class="efi-events-section efi-events-section--all" aria-label="<?php echo esc_attr__( 'Összes esemény', 'vitacenter-elementor-header' ); ?>">
				<div class="vc-landing__container">
					<?php if ( false === $groups ) : ?>
						<div class="efi-events-empty"><?php echo esc_html( $this->plain_text( $s['unavailable_text'] ) ); ?></div>
					<?php elseif ( empty( $groups['upcoming'] ) && empty( $groups['past'] ) ) : ?>
						<div class="efi-events-empty"><?php echo esc_html( $this->plain_text( $s['empty_text'] ) ); ?></div>
					<?php else : ?>
						<div class="efi-events-groups">
							<?php $this->render_all_events_group( 'upcoming', $s['upcoming_title'], $groups['upcoming'], $s['upcoming_category_text'], $s ); ?>
							<?php $this->render_all_events_group( 'past', $s['past_title'], $groups['past'], $s['past_category_text'], $s ); ?>
						</div>
					<?php endif; ?>
				</div>
			</section>
		</div>
		<?php
	}

	private function get_all_events_groups( $settings ) {
		if ( ! post_type_exists( 'tribe_events' ) ) {
			return false;
		}

		$today = current_time( 'Y-m-d H:i:s' );

		return array(
			'upcoming' => $this->query_all_events_group( $today, '>=', 'ASC', false, '' ),
			'past'     => $this->query_all_events_group( $today, '<', 'DESC', true, $settings['past_status_text'] ),
		);
	}

	private function query_all_events_group( $today, $compare, $order, $is_past, $status_label ) {
		$query = new WP_Query(
			array(
				'post_type'      => 'tribe_events',
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'meta_key'       => '_EventStartDate',
				'orderby'        => 'meta_value',
				'order'          => $order,
				'meta_query'     => array(
					array(
						'key'     => '_EventStartDate',
						'value'   => $today,
						'compare' => $compare,
						'type'    => 'DATETIME',
					),
				),
				'no_found_rows'  => true,
			)
		);

		$events = array();

		while ( $query->have_posts() ) {
			$query->the_post();

			$event = $this->format_upcoming_event( get_the_ID() );

			if ( $is_past ) {
				$event['is_past']      = true;
				$event['status_label'] = $this->plain_text( $status_label );
			}

			$events[] = $event;
		}

		wp_reset_postdata();

		return $events;
	}

	private function render_all_events_group( $type, $title, $events, $category_text, $settings ) {
		if ( empty( $events ) ) {
			return;
		}

		$card_settings                  = $settings;
		$card_settings['category_text'] = $category_text;
		?>
		<section class="efi-events-group efi-events-group--<?php echo esc_attr( $type ); ?>" aria-label="<?php echo esc_attr( $this->plain_text( $title ) ); ?>">
			<?php if ( '' !== $this->plain_text( $title ) ) : ?>
				<div class="efi-events-group__head">
					<span><?php echo 'past' === $type ? esc_html__( 'Archívum', 'vitacenter-elementor-header' ) : esc_html__( 'Soron következő', 'vitacenter-elementor-header' ); ?></span>
					<h2><?php echo esc_html( $this->plain_text( $title ) ); ?></h2>
				</div>
			<?php endif; ?>
			<div class="efi-events-grid">
				<?php foreach ( $events as $event ) : ?>
					<?php $this->render_upcoming_event_card( $event, $card_settings ); ?>
				<?php endforeach; ?>
			</div>
		</section>
		<?php
	}
}

class VitaCenter_Landing_Cta_Widget extends VitaCenter_Structured_Widget_Base {
	public function get_name() { return 'vitacenter_landing_cta'; }
	public function get_title() { return esc_html__( 'VitaCenter CTA', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-call-to-action'; }
	public function get_style_depends() { return array( 'vc-landing' ); }
	public function get_script_depends() { return array( 'vc-landing' ); }

	protected function register_controls() {
		$this->start_controls_section( 'cta_section', array( 'label' => esc_html__( 'CTA', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'icon', array( 'label' => esc_html__( 'Ikon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::MEDIA, 'default' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_20_41 PM (5).png' ) ) );
		$this->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Egészsége nem várhat.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'text', array( 'label' => esc_html__( 'Szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Jelentkezzen szűréseinkre, tanácsadásainkra vagy közösségi programjainkra.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'button_text', array( 'label' => esc_html__( 'Gomb', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Jelentkezem', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'button_link', array( 'label' => esc_html__( 'Link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#kapcsolat' ) ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$icon = $this->media_url( $s['icon'] );
		?>
		<div class="vc-landing"><section class="vc-landing__cta-wrap"><div class="vc-landing__container"><div class="vc-landing__cta"><?php if ( $icon ) : ?><img src="<?php echo esc_url( $icon ); ?>" alt=""><?php endif; ?><div><h2><?php echo esc_html( $s['title'] ); ?></h2><p><?php echo esc_html( $s['text'] ); ?></p></div><?php $this->render_button( $s['button_text'], $s['button_link'], 'vc-landing__button vc-landing__button--light' ); ?></div></div></section></div>
		<?php
	}
}

class VitaCenter_Landing_Knowledge_Widget extends VitaCenter_Landing_Programs_Widget {
	public function get_name() { return 'vitacenter_landing_knowledge'; }
	public function get_title() { return esc_html__( 'VitaCenter Knowledge Cards', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-post-list'; }

	protected function register_controls() {
		$this->start_controls_section( 'knowledge_section', array( 'label' => esc_html__( 'Tudástár', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'title', array( 'label' => esc_html__( 'Szekció címe', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Tudástár', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'all_text', array( 'label' => esc_html__( 'Összes link felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Összes cikk megtekintése', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'all_link', array( 'label' => esc_html__( 'Összes link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#tudastar' ) ) );
		$r = new Repeater();
		$r->add_control( 'image', array( 'label' => esc_html__( 'Kép', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::MEDIA ) );
		$r->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Cikk címe', 'vitacenter-elementor-header' ) ) );
		$r->add_control( 'text', array( 'label' => esc_html__( 'Leírás', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Rövid cikkleírás.', 'vitacenter-elementor-header' ) ) );
		$r->add_control( 'link_text', array( 'label' => esc_html__( 'Link felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Tovább olvasom', 'vitacenter-elementor-header' ) ) );
		$r->add_control( 'link', array( 'label' => esc_html__( 'Link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#tudastar' ) ) );
		$this->add_control( 'items', array(
			'label' => esc_html__( 'Kártyák', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $r->get_controls(),
			'title_field' => '{{{ title }}}',
			'default' => array(
				array( 'title' => esc_html__( 'Prevenció fontossága', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Hasznos tartalmak a megelőzésről, a rendszeres szűrések szerepéről és a korai felismerés jelentőségéről.', 'vitacenter-elementor-header' ), 'image' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_20_40 PM (2).png' ), 'link_text' => esc_html__( 'Tovább olvasom', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#tudastar' ) ),
				array( 'title' => esc_html__( 'Demográfiai kihívások', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Ismeretterjesztő anyagok családokról, közösségekről és a helyi egészségfejlesztés szerepéről.', 'vitacenter-elementor-header' ), 'image' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_20_41 PM (4).png' ), 'link_text' => esc_html__( 'Tovább olvasom', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#tudastar' ) ),
				array( 'title' => esc_html__( 'Egészséges életmód útmutató', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Gyakorlati tanácsok, letölthető anyagok és GYIK a tudatosabb mindennapokhoz.', 'vitacenter-elementor-header' ), 'image' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_01 PM (5).png' ), 'link_text' => esc_html__( 'Tovább olvasom', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#tudastar' ) ),
			),
		) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		?>
		<div class="vc-landing"><section id="tudastar" class="vc-landing__section vc-landing__articles"><div class="vc-landing__container"><div class="vc-landing__section-head"><h2 class="vc-landing__section-title vc-landing__section-title--left"><?php echo esc_html( $s['title'] ); ?></h2><?php $this->render_text_link( $s['all_text'], $s['all_link'], 'vc-landing__all-link' ); ?></div><div class="vc-landing__article-grid"><?php foreach ( $s['items'] as $item ) : $image = $this->media_url( $item['image'] ); ?><article class="vc-landing__article-card"><?php if ( $image ) : ?><img src="<?php echo esc_url( $image ); ?>" alt=""><?php endif; ?><div><h3><?php echo esc_html( $item['title'] ); ?></h3><p><?php echo esc_html( $item['text'] ); ?></p><?php $this->render_text_link( $item['link_text'], $item['link'] ); ?></div></article><?php endforeach; ?></div></div></section></div>
		<?php
	}
}

class VitaCenter_Knowledge_Widget extends VitaCenter_Structured_Widget_Base {
	public function get_name() { return 'vitacenter_knowledge'; }
	public function get_title() { return esc_html__( 'VitaCenter Knowledge', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-library-open'; }
	public function get_style_depends() { return array( 'vc-landing' ); }
	public function get_script_depends() { return array( 'vc-landing' ); }

	protected function register_controls() {
		$this->start_controls_section( 'hero_section', array( 'label' => esc_html__( 'Hero', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'show_hero', array( 'label' => esc_html__( 'Hero megjelenítése', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$this->add_control( 'eyebrow', array( 'label' => esc_html__( 'Kis címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Tudástár', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Hasznos információk az egészségesebb mindennapokért', 'vitacenter-elementor-header' ), 'label_block' => true ) );
		$this->add_control( 'intro', array( 'label' => esc_html__( 'Bevezető', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Cikkek, letölthető anyagok és gyakori kérdések a prevenció, az egészséges életmód és a közösségi egészségfejlesztés témáiban.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'show_hero_visual', array( 'label' => esc_html__( 'Vizuális kártya megjelenítése', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$this->add_control( 'visual_title', array( 'label' => esc_html__( 'Vizuális kártya cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Prevenció', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_text', array( 'label' => esc_html__( 'Vizuális kártya szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'útmutatók és anyagok', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'featured_section', array( 'label' => esc_html__( 'Kiemelt tartalom', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'show_featured', array( 'label' => esc_html__( 'Kiemelt blokk megjelenítése', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$this->add_control( 'featured_label', array( 'label' => esc_html__( 'Címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kiemelt téma', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'featured_title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Prevenció fontossága', 'vitacenter-elementor-header' ), 'label_block' => true ) );
		$this->add_control( 'featured_text', array( 'label' => esc_html__( 'Szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A megelőzés segít időben felismerni a kockázatokat, támogatja az egészségtudatos döntéseket és hozzájárulhat a hosszabb, aktívabb élethez.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'featured_button_text', array( 'label' => esc_html__( 'Gomb felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Elolvasom', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'featured_link', array( 'label' => esc_html__( 'Gomb link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->add_control( 'show_mini_cards', array( 'label' => esc_html__( 'Mini kártyák megjelenítése', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );

		$r = new Repeater();
		$r->add_control( 'show_item', array( 'label' => esc_html__( 'Megjelenítés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$r->add_control( 'number', array( 'label' => esc_html__( 'Sorszám', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '01' ) );
		$r->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Mini téma', 'vitacenter-elementor-header' ) ) );
		$r->add_control( 'text', array( 'label' => esc_html__( 'Szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Rövid leírás.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'mini_cards', array(
			'label' => esc_html__( 'Mini kártyák', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $r->get_controls(),
			'title_field' => '{{{ title }}}',
			'default' => $this->default_knowledge_mini_cards(),
		) );
		$this->end_controls_section();

		$this->start_controls_section( 'articles_section', array( 'label' => esc_html__( 'Cikkek', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'show_articles', array( 'label' => esc_html__( 'Cikkek megjelenítése', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$this->add_control( 'articles_label', array( 'label' => esc_html__( 'Szekció címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Cikkek', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'articles_title', array( 'label' => esc_html__( 'Szekció cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Friss tudnivalók', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'articles_intro', array( 'label' => esc_html__( 'Szekció szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Ide érkeznek majd a szakmai és ismeretterjesztő tartalmak.', 'vitacenter-elementor-header' ) ) );

		$articles = new Repeater();
		$articles->add_control( 'show_item', array( 'label' => esc_html__( 'Megjelenítés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$articles->add_control( 'icon', array( 'label' => esc_html__( 'Ikon betű', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => 'P' ) );
		$articles->add_control( 'category', array( 'label' => esc_html__( 'Kategória', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Prevenció', 'vitacenter-elementor-header' ) ) );
		$articles->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Cikk címe', 'vitacenter-elementor-header' ), 'label_block' => true ) );
		$articles->add_control( 'text', array( 'label' => esc_html__( 'Leírás', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Rövid cikkleírás.', 'vitacenter-elementor-header' ) ) );
		$articles->add_control( 'link_text', array( 'label' => esc_html__( 'Link felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Tovább olvasom', 'vitacenter-elementor-header' ) ) );
		$articles->add_control( 'link', array( 'label' => esc_html__( 'Link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->add_control( 'articles', array(
			'label' => esc_html__( 'Cikk kártyák', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $articles->get_controls(),
			'title_field' => '{{{ title }}}',
			'default' => $this->default_knowledge_articles(),
		) );
		$this->end_controls_section();

		$this->start_controls_section( 'downloads_section', array( 'label' => esc_html__( 'Letöltések', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'show_downloads', array( 'label' => esc_html__( 'Letöltések megjelenítése', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$this->add_control( 'downloads_label', array( 'label' => esc_html__( 'Szekció címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Letöltések', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'downloads_title', array( 'label' => esc_html__( 'Szekció cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Letölthető anyagok', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'downloads_intro', array( 'label' => esc_html__( 'Szekció szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Tájékoztatók, útmutatók és programismertetők egy helyen.', 'vitacenter-elementor-header' ) ) );

		$downloads = new Repeater();
		$downloads->add_control( 'show_item', array( 'label' => esc_html__( 'Megjelenítés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$downloads->add_control( 'label', array( 'label' => esc_html__( 'Típus', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => 'PDF' ) );
		$downloads->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Letölthető dokumentum', 'vitacenter-elementor-header' ), 'label_block' => true ) );
		$downloads->add_control( 'text', array( 'label' => esc_html__( 'Alszöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Letölthető dokumentum', 'vitacenter-elementor-header' ) ) );
		$downloads->add_control( 'link', array( 'label' => esc_html__( 'Link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->add_control( 'downloads', array(
			'label' => esc_html__( 'Letölthető anyagok', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $downloads->get_controls(),
			'title_field' => '{{{ title }}}',
			'default' => $this->default_knowledge_downloads(),
		) );
		$this->end_controls_section();

		$this->start_controls_section( 'faq_section', array( 'label' => esc_html__( 'GYIK', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'show_faq', array( 'label' => esc_html__( 'GYIK megjelenítése', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$this->add_control( 'faq_label', array( 'label' => esc_html__( 'Szekció címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'GYIK', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'faq_title', array( 'label' => esc_html__( 'Szekció cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Gyakori kérdések', 'vitacenter-elementor-header' ) ) );

		$faqs = new Repeater();
		$faqs->add_control( 'show_item', array( 'label' => esc_html__( 'Megjelenítés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$faqs->add_control( 'question', array( 'label' => esc_html__( 'Kérdés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kérdés', 'vitacenter-elementor-header' ), 'label_block' => true ) );
		$faqs->add_control( 'answer', array( 'label' => esc_html__( 'Válasz', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Válasz szövege.', 'vitacenter-elementor-header' ) ) );
		$faqs->add_control( 'open', array( 'label' => esc_html__( 'Alapból nyitva', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => '' ) );
		$this->add_control( 'faqs', array(
			'label' => esc_html__( 'Kérdések', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $faqs->get_controls(),
			'title_field' => '{{{ question }}}',
			'default' => $this->default_knowledge_faqs(),
		) );
		$this->end_controls_section();

		$this->start_controls_section( 'sidebar_section', array( 'label' => esc_html__( 'Oldalsáv', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'show_sidebar', array( 'label' => esc_html__( 'Oldalsáv megjelenítése', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$this->add_control( 'show_categories', array( 'label' => esc_html__( 'Kategóriák megjelenítése', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$categories = new Repeater();
		$categories->add_control( 'show_item', array( 'label' => esc_html__( 'Megjelenítés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$categories->add_control( 'title', array( 'label' => esc_html__( 'Kategória', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kategória', 'vitacenter-elementor-header' ) ) );
		$categories->add_control( 'link', array( 'label' => esc_html__( 'Link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->add_control( 'categories', array(
			'label' => esc_html__( 'Kategóriák', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $categories->get_controls(),
			'title_field' => '{{{ title }}}',
			'default' => $this->default_knowledge_categories(),
		) );
		$this->add_control( 'categories_label', array( 'label' => esc_html__( 'Kategória címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kategóriák', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'show_cta', array( 'label' => esc_html__( 'Kapcsolatfelvétel megjelenítése', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$this->add_control( 'cta_label', array( 'label' => esc_html__( 'Kapcsolat címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kapcsolat', 'vitacenter-elementor-header' ), 'condition' => array( 'show_cta' => 'yes' ) ) );
		$this->add_control( 'cta_title', array( 'label' => esc_html__( 'Kapcsolat cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Hasznos anyagot keres?', 'vitacenter-elementor-header' ), 'condition' => array( 'show_cta' => 'yes' ) ) );
		$this->add_control( 'cta_text', array( 'label' => esc_html__( 'Kapcsolat szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Keressen minket, segítünk megtalálni a megfelelő tájékoztatót vagy programot.', 'vitacenter-elementor-header' ), 'condition' => array( 'show_cta' => 'yes' ) ) );
		$this->add_control( 'cta_phone', array( 'label' => esc_html__( 'Telefon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '+40 261 713 775', 'condition' => array( 'show_cta' => 'yes' ) ) );
		$this->add_control( 'cta_email', array( 'label' => esc_html__( 'E-mail', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => 'efi@szatmar.ro', 'condition' => array( 'show_cta' => 'yes' ) ) );
		$this->add_control( 'cta_button_text', array( 'label' => esc_html__( 'Kapcsolat gomb', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kapcsolatfelvétel', 'vitacenter-elementor-header' ), 'condition' => array( 'show_cta' => 'yes' ) ) );
		$this->add_control( 'cta_link', array( 'label' => esc_html__( 'Kapcsolat link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '/kapcsolat' ), 'condition' => array( 'show_cta' => 'yes' ) ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = wp_parse_args( $this->get_settings_for_display(), $this->default_knowledge_settings() );

		$show_hero        = 'yes' === $this->plain_text( $s['show_hero'] );
		$show_hero_visual = 'yes' === $this->plain_text( $s['show_hero_visual'] );
		$show_featured    = 'yes' === $this->plain_text( $s['show_featured'] );
		$show_mini_cards  = $show_featured && 'yes' === $this->plain_text( $s['show_mini_cards'] );
		$show_articles    = 'yes' === $this->plain_text( $s['show_articles'] );
		$show_downloads   = 'yes' === $this->plain_text( $s['show_downloads'] );
		$show_faq         = 'yes' === $this->plain_text( $s['show_faq'] );
		$show_sidebar     = 'yes' === $this->plain_text( $s['show_sidebar'] );
		$show_categories  = $show_sidebar && 'yes' === $this->plain_text( $s['show_categories'] );
		$show_cta         = $show_sidebar && 'yes' === $this->plain_text( $s['show_cta'] );
		$mini_cards       = $show_mini_cards ? $this->normalize_knowledge_mini_cards( isset( $s['mini_cards'] ) ? $s['mini_cards'] : array() ) : array();
		$articles         = $show_articles ? $this->normalize_knowledge_articles( isset( $s['articles'] ) ? $s['articles'] : array() ) : array();
		$downloads        = $show_downloads ? $this->normalize_knowledge_downloads( isset( $s['downloads'] ) ? $s['downloads'] : array() ) : array();
		$faqs             = $show_faq ? $this->normalize_knowledge_faqs( isset( $s['faqs'] ) ? $s['faqs'] : array() ) : array();
		$categories       = $show_categories ? $this->normalize_knowledge_categories( isset( $s['categories'] ) ? $s['categories'] : array() ) : array();
		$has_main_content = $show_articles || $show_downloads || $show_faq;
		$has_sidebar_content = $show_sidebar && ( ( $show_categories && ! empty( $categories ) ) || $show_cta );
		$main_grid_classes   = 'efi-knowledge-main-grid';
		$featured_classes    = 'efi-knowledge-featured';

		if ( empty( $mini_cards ) ) {
			$featured_classes .= ' efi-knowledge-featured--article-only';
		}

		if ( ! $has_sidebar_content ) {
			$main_grid_classes .= ' efi-knowledge-main-grid--no-sidebar';
		} elseif ( ! $has_main_content ) {
			$main_grid_classes .= ' efi-knowledge-main-grid--sidebar-only';
		}
		?>
		<div class="vc-landing">
			<section class="efi-knowledge-page" aria-label="<?php echo esc_attr__( 'Tudástár oldal', 'vitacenter-elementor-header' ); ?>">
				<?php if ( $show_hero ) : ?>
					<div class="efi-knowledge-hero <?php echo $show_hero_visual ? '' : 'efi-knowledge-hero--text-only'; ?>">
						<div class="efi-knowledge-hero__content">
							<?php if ( '' !== $this->plain_text( $s['eyebrow'] ) ) : ?><span class="efi-knowledge-eyebrow"><?php echo esc_html( $this->plain_text( $s['eyebrow'] ) ); ?></span><?php endif; ?>
							<h1><?php echo esc_html( $this->plain_text( $s['title'] ) ); ?></h1>
							<?php if ( '' !== $this->plain_text( $s['intro'] ) ) : ?><p><?php echo esc_html( $this->plain_text( $s['intro'] ) ); ?></p><?php endif; ?>
						</div>

						<?php if ( $show_hero_visual ) : ?>
							<div class="efi-knowledge-hero__visual" aria-hidden="true">
								<div class="efi-knowledge-book-card">
									<span class="efi-knowledge-book-icon"><?php $this->render_knowledge_book_icon(); ?></span>
									<strong><?php echo esc_html( $this->plain_text( $s['visual_title'] ) ); ?></strong>
									<span><?php echo esc_html( $this->plain_text( $s['visual_text'] ) ); ?></span>
								</div>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if ( $show_featured ) : ?>
				<div class="<?php echo esc_attr( $featured_classes ); ?>">
					<article class="efi-featured-article">
						<?php if ( '' !== $this->plain_text( $s['featured_label'] ) ) : ?><span class="efi-card-label"><?php echo esc_html( $this->plain_text( $s['featured_label'] ) ); ?></span><?php endif; ?>
						<h2><?php echo esc_html( $this->plain_text( $s['featured_title'] ) ); ?></h2>
						<?php if ( '' !== $this->plain_text( $s['featured_text'] ) ) : ?><p><?php echo esc_html( $this->plain_text( $s['featured_text'] ) ); ?></p><?php endif; ?>
						<?php $this->render_knowledge_link_button( $s['featured_button_text'], $s['featured_link'], 'efi-link-button' ); ?>
					</article>

					<?php foreach ( $mini_cards as $card ) : ?>
						<article class="efi-featured-mini-card">
							<span><?php echo esc_html( $card['number'] ); ?></span>
							<h3><?php echo esc_html( $card['title'] ); ?></h3>
							<?php if ( '' !== $card['text'] ) : ?><p><?php echo esc_html( $card['text'] ); ?></p><?php endif; ?>
						</article>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>

				<?php if ( $has_main_content || $has_sidebar_content ) : ?>
					<div class="<?php echo esc_attr( $main_grid_classes ); ?>">
						<?php if ( $has_main_content ) : ?>
							<main class="efi-knowledge-content">
								<?php if ( $show_articles ) : ?>
									<section class="efi-knowledge-section" aria-label="<?php echo esc_attr__( 'Cikkek', 'vitacenter-elementor-header' ); ?>">
										<?php $this->render_knowledge_section_heading( $s['articles_label'], $s['articles_title'], $s['articles_intro'] ); ?>
										<?php if ( ! empty( $articles ) ) : ?>
											<div class="efi-article-grid">
												<?php foreach ( $articles as $article ) : ?>
													<article class="efi-article-card">
														<div class="efi-article-icon"><?php echo esc_html( $article['icon'] ); ?></div>
														<?php if ( '' !== $article['category'] ) : ?><span><?php echo esc_html( $article['category'] ); ?></span><?php endif; ?>
														<h3><?php echo esc_html( $article['title'] ); ?></h3>
														<?php if ( '' !== $article['text'] ) : ?><p><?php echo esc_html( $article['text'] ); ?></p><?php endif; ?>
														<?php $this->render_knowledge_text_link( $article['link_text'], $article['link'] ); ?>
													</article>
												<?php endforeach; ?>
											</div>
										<?php endif; ?>
									</section>
								<?php endif; ?>

								<?php if ( $show_downloads ) : ?>
									<section class="efi-knowledge-section" aria-label="<?php echo esc_attr__( 'Letölthető anyagok', 'vitacenter-elementor-header' ); ?>">
										<?php $this->render_knowledge_section_heading( $s['downloads_label'], $s['downloads_title'], $s['downloads_intro'] ); ?>
										<?php if ( ! empty( $downloads ) ) : ?>
											<div class="efi-download-list">
												<?php foreach ( $downloads as $download ) : ?>
													<a class="efi-download-item" <?php echo $this->url_attributes( $download['link'] ); ?>>
														<span class="efi-download-icon"><?php echo esc_html( $download['label'] ); ?></span>
														<div>
															<strong><?php echo esc_html( $download['title'] ); ?></strong>
															<?php if ( '' !== $download['text'] ) : ?><small><?php echo esc_html( $download['text'] ); ?></small><?php endif; ?>
														</div>
														<span class="efi-download-arrow" aria-hidden="true">&#8595;</span>
													</a>
												<?php endforeach; ?>
											</div>
										<?php endif; ?>
									</section>
								<?php endif; ?>

								<?php if ( $show_faq ) : ?>
									<section class="efi-knowledge-section" aria-label="<?php echo esc_attr__( 'Gyakori kérdések', 'vitacenter-elementor-header' ); ?>">
										<?php $this->render_knowledge_section_heading( $s['faq_label'], $s['faq_title'], '' ); ?>
										<?php if ( ! empty( $faqs ) ) : ?>
											<div class="efi-faq-list">
												<?php foreach ( $faqs as $faq ) : ?>
													<details <?php echo $faq['open'] ? 'open' : ''; ?>>
														<summary><?php echo esc_html( $faq['question'] ); ?></summary>
														<?php if ( '' !== $faq['answer'] ) : ?><p><?php echo esc_html( $faq['answer'] ); ?></p><?php endif; ?>
													</details>
												<?php endforeach; ?>
											</div>
										<?php endif; ?>
									</section>
								<?php endif; ?>
							</main>
						<?php endif; ?>

						<?php if ( $has_sidebar_content ) : ?>
							<aside class="efi-knowledge-sidebar" aria-label="<?php echo esc_attr__( 'Tudástár oldalsáv', 'vitacenter-elementor-header' ); ?>">
								<?php if ( $show_categories && ! empty( $categories ) ) : ?>
									<div class="efi-sidebar-card">
										<?php if ( '' !== $this->plain_text( $s['categories_label'] ) ) : ?><span class="efi-card-label"><?php echo esc_html( $this->plain_text( $s['categories_label'] ) ); ?></span><?php endif; ?>
										<nav class="efi-category-list">
											<?php foreach ( $categories as $category ) : ?>
												<a <?php echo $this->url_attributes( $category['link'] ); ?>><?php echo esc_html( $category['title'] ); ?></a>
											<?php endforeach; ?>
										</nav>
									</div>
								<?php endif; ?>

								<?php if ( $show_cta ) : ?>
									<?php $this->render_knowledge_contact_card( $s ); ?>
								<?php endif; ?>
							</aside>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</section>
		</div>
		<?php
	}

	private function default_knowledge_settings() {
		return array(
			'show_hero'            => 'yes',
			'eyebrow'              => esc_html__( 'Tudástár', 'vitacenter-elementor-header' ),
			'title'                => esc_html__( 'Hasznos információk az egészségesebb mindennapokért', 'vitacenter-elementor-header' ),
			'intro'                => esc_html__( 'Cikkek, letölthető anyagok és gyakori kérdések a prevenció, az egészséges életmód és a közösségi egészségfejlesztés témáiban.', 'vitacenter-elementor-header' ),
			'show_hero_visual'     => 'yes',
			'visual_title'         => esc_html__( 'Prevenció', 'vitacenter-elementor-header' ),
			'visual_text'          => esc_html__( 'útmutatók és anyagok', 'vitacenter-elementor-header' ),
			'show_featured'        => 'yes',
			'featured_label'       => esc_html__( 'Kiemelt téma', 'vitacenter-elementor-header' ),
			'featured_title'       => esc_html__( 'Prevenció fontossága', 'vitacenter-elementor-header' ),
			'featured_text'        => esc_html__( 'A megelőzés segít időben felismerni a kockázatokat, támogatja az egészségtudatos döntéseket és hozzájárulhat a hosszabb, aktívabb élethez.', 'vitacenter-elementor-header' ),
			'featured_button_text' => esc_html__( 'Elolvasom', 'vitacenter-elementor-header' ),
			'featured_link'        => array( 'url' => '#' ),
			'show_mini_cards'      => 'yes',
			'mini_cards'           => $this->default_knowledge_mini_cards(),
			'show_articles'        => 'yes',
			'articles_label'       => esc_html__( 'Cikkek', 'vitacenter-elementor-header' ),
			'articles_title'       => esc_html__( 'Friss tudnivalók', 'vitacenter-elementor-header' ),
			'articles_intro'       => esc_html__( 'Ide érkeznek majd a szakmai és ismeretterjesztő tartalmak.', 'vitacenter-elementor-header' ),
			'articles'             => $this->default_knowledge_articles(),
			'show_downloads'       => 'yes',
			'downloads_label'      => esc_html__( 'Letöltések', 'vitacenter-elementor-header' ),
			'downloads_title'      => esc_html__( 'Letölthető anyagok', 'vitacenter-elementor-header' ),
			'downloads_intro'      => esc_html__( 'Tájékoztatók, útmutatók és programismertetők egy helyen.', 'vitacenter-elementor-header' ),
			'downloads'            => $this->default_knowledge_downloads(),
			'show_faq'             => 'yes',
			'faq_label'            => esc_html__( 'GYIK', 'vitacenter-elementor-header' ),
			'faq_title'            => esc_html__( 'Gyakori kérdések', 'vitacenter-elementor-header' ),
			'faqs'                 => $this->default_knowledge_faqs(),
			'show_sidebar'         => 'yes',
			'show_categories'      => 'yes',
			'categories_label'     => esc_html__( 'Kategóriák', 'vitacenter-elementor-header' ),
			'categories'           => $this->default_knowledge_categories(),
			'show_cta'             => 'yes',
			'cta_label'            => esc_html__( 'Kapcsolat', 'vitacenter-elementor-header' ),
			'cta_title'            => esc_html__( 'Hasznos anyagot keres?', 'vitacenter-elementor-header' ),
			'cta_text'             => esc_html__( 'Keressen minket, segítünk megtalálni a megfelelő tájékoztatót vagy programot.', 'vitacenter-elementor-header' ),
			'cta_phone'            => '+40 261 713 775',
			'cta_email'            => 'efi@szatmar.ro',
			'cta_button_text'      => esc_html__( 'Kapcsolatfelvétel', 'vitacenter-elementor-header' ),
			'cta_link'             => array( 'url' => '/kapcsolat' ),
		);
	}

	private function default_knowledge_mini_cards() {
		return array(
			array( 'show_item' => 'yes', 'number' => '01', 'title' => esc_html__( 'Demográfiai kihívások', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Rövid áttekintés közösségi szinten.', 'vitacenter-elementor-header' ) ),
			array( 'show_item' => 'yes', 'number' => '02', 'title' => esc_html__( 'Egészséges életmód útmutató', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Gyakorlati tanácsok a mindennapokra.', 'vitacenter-elementor-header' ) ),
		);
	}

	private function default_knowledge_articles() {
		return array(
			array( 'show_item' => 'yes', 'icon' => 'P', 'category' => esc_html__( 'Prevenció', 'vitacenter-elementor-header' ), 'title' => esc_html__( 'Prevenció fontossága', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'A korai felismerés és a rendszeres szűrés szerepe az egészségmegőrzésben.', 'vitacenter-elementor-header' ), 'link_text' => esc_html__( 'Tovább olvasom', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ) ),
			array( 'show_item' => 'yes', 'icon' => 'D', 'category' => esc_html__( 'Közösség', 'vitacenter-elementor-header' ), 'title' => esc_html__( 'Demográfiai kihívások', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Miért fontos a családok, fiatalok és közösségek egészségének támogatása?', 'vitacenter-elementor-header' ), 'link_text' => esc_html__( 'Tovább olvasom', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ) ),
			array( 'show_item' => 'yes', 'icon' => 'É', 'category' => esc_html__( 'Életmód', 'vitacenter-elementor-header' ), 'title' => esc_html__( 'Egészséges életmód útmutató', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Egyszerű, követhető szokások a mindennapi egészség támogatásához.', 'vitacenter-elementor-header' ), 'link_text' => esc_html__( 'Tovább olvasom', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ) ),
		);
	}

	private function default_knowledge_downloads() {
		return array(
			array( 'show_item' => 'yes', 'label' => 'PDF', 'title' => esc_html__( 'Prevenciós tájékoztató', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Letölthető dokumentum', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ) ),
			array( 'show_item' => 'yes', 'label' => 'PDF', 'title' => esc_html__( 'Egészséges életmód útmutató', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Letölthető dokumentum', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ) ),
			array( 'show_item' => 'yes', 'label' => 'PDF', 'title' => esc_html__( 'Szűrővizsgálati kisokos', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Letölthető dokumentum', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ) ),
		);
	}

	private function default_knowledge_faqs() {
		return array(
			array( 'show_item' => 'yes', 'question' => esc_html__( 'Kik vehetnek részt a programokon?', 'vitacenter-elementor-header' ), 'answer' => esc_html__( 'A programok célcsoportja témánként eltérő, de több szolgáltatás fiataloknak, felnőtteknek és családoknak is szól.', 'vitacenter-elementor-header' ), 'open' => 'yes' ),
			array( 'show_item' => 'yes', 'question' => esc_html__( 'Ingyenesek a szűrések és tanácsadások?', 'vitacenter-elementor-header' ), 'answer' => esc_html__( 'A projekt keretében megvalósuló szolgáltatások részvételi feltételeiről az adott program oldalán található információ.', 'vitacenter-elementor-header' ), 'open' => '' ),
			array( 'show_item' => 'yes', 'question' => esc_html__( 'Hogyan lehet jelentkezni?', 'vitacenter-elementor-header' ), 'answer' => esc_html__( 'Jelentkezéshez vagy további információért a kapcsolati oldalon megadott elérhetőségeken lehet érdeklődni.', 'vitacenter-elementor-header' ), 'open' => '' ),
		);
	}

	private function default_knowledge_categories() {
		return array(
			array( 'show_item' => 'yes', 'title' => esc_html__( 'Prevenció', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ) ),
			array( 'show_item' => 'yes', 'title' => esc_html__( 'Demográfia', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ) ),
			array( 'show_item' => 'yes', 'title' => esc_html__( 'Egészséges életmód', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ) ),
			array( 'show_item' => 'yes', 'title' => esc_html__( 'Szűrővizsgálatok', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ) ),
			array( 'show_item' => 'yes', 'title' => esc_html__( 'Család és közösség', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ) ),
		);
	}

	private function normalize_knowledge_mini_cards( $items ) {
		$cards = array();

		foreach ( $this->repeater_items( $items ) as $item ) {
			if ( isset( $item['show_item'] ) && 'yes' !== $this->plain_text( $item['show_item'] ) ) {
				continue;
			}

			$title = isset( $item['title'] ) ? $this->plain_text( $item['title'] ) : '';

			if ( '' === $title ) {
				continue;
			}

			$cards[] = array(
				'number' => isset( $item['number'] ) && '' !== $this->plain_text( $item['number'] ) ? $this->plain_text( $item['number'] ) : sprintf( '%02d', count( $cards ) + 1 ),
				'title'  => $title,
				'text'   => isset( $item['text'] ) ? $this->plain_text( $item['text'] ) : '',
			);
		}

		return $cards;
	}

	private function normalize_knowledge_articles( $items ) {
		$articles = array();

		foreach ( $this->repeater_items( $items ) as $item ) {
			if ( isset( $item['show_item'] ) && 'yes' !== $this->plain_text( $item['show_item'] ) ) {
				continue;
			}

			$title = isset( $item['title'] ) ? $this->plain_text( $item['title'] ) : '';

			if ( '' === $title ) {
				continue;
			}

			$articles[] = array(
				'icon'      => isset( $item['icon'] ) && '' !== $this->plain_text( $item['icon'] ) ? $this->knowledge_icon_text( $this->plain_text( $item['icon'] ), 2 ) : $this->knowledge_icon_text( $title, 1 ),
				'category'  => isset( $item['category'] ) ? $this->plain_text( $item['category'] ) : '',
				'title'     => $title,
				'text'      => isset( $item['text'] ) ? $this->plain_text( $item['text'] ) : '',
				'link_text' => isset( $item['link_text'] ) && '' !== $this->plain_text( $item['link_text'] ) ? $this->plain_text( $item['link_text'] ) : esc_html__( 'Tovább olvasom', 'vitacenter-elementor-header' ),
				'link'      => isset( $item['link'] ) ? $item['link'] : array( 'url' => '#' ),
			);
		}

		return $articles;
	}

	private function normalize_knowledge_downloads( $items ) {
		$downloads = array();

		foreach ( $this->repeater_items( $items ) as $item ) {
			if ( isset( $item['show_item'] ) && 'yes' !== $this->plain_text( $item['show_item'] ) ) {
				continue;
			}

			$title = isset( $item['title'] ) ? $this->plain_text( $item['title'] ) : '';

			if ( '' === $title ) {
				continue;
			}

			$downloads[] = array(
				'label' => isset( $item['label'] ) && '' !== $this->plain_text( $item['label'] ) ? $this->plain_text( $item['label'] ) : 'PDF',
				'title' => $title,
				'text'  => isset( $item['text'] ) ? $this->plain_text( $item['text'] ) : '',
				'link'  => isset( $item['link'] ) ? $item['link'] : array( 'url' => '#' ),
			);
		}

		return $downloads;
	}

	private function normalize_knowledge_faqs( $items ) {
		$faqs = array();

		foreach ( $this->repeater_items( $items ) as $item ) {
			if ( isset( $item['show_item'] ) && 'yes' !== $this->plain_text( $item['show_item'] ) ) {
				continue;
			}

			$question = isset( $item['question'] ) ? $this->plain_text( $item['question'] ) : '';

			if ( '' === $question ) {
				continue;
			}

			$faqs[] = array(
				'question' => $question,
				'answer'   => isset( $item['answer'] ) ? $this->plain_text( $item['answer'] ) : '',
				'open'     => isset( $item['open'] ) && 'yes' === $this->plain_text( $item['open'] ),
			);
		}

		return $faqs;
	}

	private function normalize_knowledge_categories( $items ) {
		$categories = array();

		foreach ( $this->repeater_items( $items ) as $item ) {
			if ( isset( $item['show_item'] ) && 'yes' !== $this->plain_text( $item['show_item'] ) ) {
				continue;
			}

			$title = isset( $item['title'] ) ? $this->plain_text( $item['title'] ) : '';

			if ( '' === $title ) {
				continue;
			}

			$categories[] = array(
				'title' => $title,
				'link'  => isset( $item['link'] ) ? $item['link'] : array( 'url' => '#' ),
			);
		}

		return $categories;
	}

	private function knowledge_icon_text( $text, $length = 1 ) {
		$text = $this->plain_text( $text );

		if ( function_exists( 'mb_substr' ) ) {
			return mb_substr( $text, 0, $length, 'UTF-8' );
		}

		return substr( $text, 0, $length );
	}

	private function render_knowledge_section_heading( $label, $title, $intro = '' ) {
		?>
		<div class="efi-section-heading">
			<?php if ( '' !== $this->plain_text( $label ) ) : ?><span><?php echo esc_html( $this->plain_text( $label ) ); ?></span><?php endif; ?>
			<h2><?php echo esc_html( $this->plain_text( $title ) ); ?></h2>
			<?php if ( '' !== $this->plain_text( $intro ) ) : ?><p><?php echo esc_html( $this->plain_text( $intro ) ); ?></p><?php endif; ?>
		</div>
		<?php
	}

	private function render_knowledge_text_link( $text, $link ) {
		$text = $this->plain_text( $text );

		if ( '' === $text ) {
			return;
		}
		?>
		<a <?php echo $this->url_attributes( $link ); ?>><?php echo esc_html( $text ); ?></a>
		<?php
	}

	private function render_knowledge_link_button( $text, $link, $class = 'efi-link-button' ) {
		$text = $this->plain_text( $text );

		if ( '' === $text ) {
			return;
		}
		?>
		<a <?php if ( '' !== $class ) : ?>class="<?php echo esc_attr( $class ); ?>"<?php endif; ?> <?php echo $this->url_attributes( $link ); ?>>
			<span><?php echo esc_html( $text ); ?></span>
			<span aria-hidden="true">&#8594;</span>
		</a>
		<?php
	}

	private function render_knowledge_contact_card( $settings ) {
		$label = isset( $settings['cta_label'] ) ? $this->plain_text( $settings['cta_label'] ) : '';
		$title = isset( $settings['cta_title'] ) ? $this->plain_text( $settings['cta_title'] ) : '';
		$text  = isset( $settings['cta_text'] ) ? $this->plain_text( $settings['cta_text'] ) : '';
		$phone = isset( $settings['cta_phone'] ) ? $this->plain_text( $settings['cta_phone'] ) : '';
		$email = isset( $settings['cta_email'] ) ? $this->plain_text( $settings['cta_email'] ) : '';
		$link  = isset( $settings['cta_link'] ) && is_array( $settings['cta_link'] ) ? $settings['cta_link'] : array( 'url' => isset( $settings['cta_link'] ) ? $this->plain_text( $settings['cta_link'] ) : '' );
		$phone_href = $this->knowledge_phone_href( $phone );
		$email_href = $this->knowledge_email_href( $email );

		if ( '' === $label ) {
			$label = esc_html__( 'Kapcsolat', 'vitacenter-elementor-header' );
		}

		if ( '' === $title ) {
			$title = esc_html__( 'Hasznos anyagot keres?', 'vitacenter-elementor-header' );
		}

		if ( '' === $text ) {
			$text = esc_html__( 'Keressen minket, segítünk megtalálni a megfelelő tájékoztatót vagy programot.', 'vitacenter-elementor-header' );
		}

		if ( empty( $link['url'] ) && '' !== $phone_href ) {
			$link['url'] = $phone_href;
		}
		?>
		<div class="efi-sidebar-card efi-sidebar-card--cta efi-knowledge-contact-card">
			<div class="efi-knowledge-contact-card__head">
				<span class="efi-knowledge-contact-icon" aria-hidden="true">&#9993;</span>
				<span class="efi-card-label"><?php echo esc_html( $label ); ?></span>
			</div>

			<h3><?php echo esc_html( $title ); ?></h3>
			<p><?php echo esc_html( $text ); ?></p>

			<?php if ( '' !== $phone || '' !== $email ) : ?>
				<div class="efi-knowledge-contact-list">
					<?php if ( '' !== $phone ) : ?>
						<div class="efi-knowledge-contact-row">
							<span><?php echo esc_html__( 'Telefon', 'vitacenter-elementor-header' ); ?></span>
							<?php if ( '' !== $phone_href ) : ?><a href="<?php echo esc_url( $phone_href ); ?>"><?php echo esc_html( $phone ); ?></a><?php else : ?><strong><?php echo esc_html( $phone ); ?></strong><?php endif; ?>
						</div>
					<?php endif; ?>

					<?php if ( '' !== $email ) : ?>
						<div class="efi-knowledge-contact-row">
							<span><?php echo esc_html__( 'E-mail', 'vitacenter-elementor-header' ); ?></span>
							<?php if ( '' !== $email_href ) : ?><a href="<?php echo esc_url( $email_href ); ?>"><?php echo esc_html( $email ); ?></a><?php else : ?><strong><?php echo esc_html( $email ); ?></strong><?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php $this->render_knowledge_link_button( $settings['cta_button_text'], $link, 'efi-knowledge-contact-button' ); ?>
		</div>
		<?php
	}

	private function knowledge_phone_href( $phone ) {
		$normalized = preg_replace( '/[^0-9+]/', '', $this->plain_text( $phone ) );

		return $normalized ? 'tel:' . $normalized : '';
	}

	private function knowledge_email_href( $email ) {
		$email = sanitize_email( $this->plain_text( $email ) );

		return is_email( $email ) ? 'mailto:' . $email : '';
	}

	private function render_knowledge_book_icon() {
		?>
		<svg viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg">
			<defs>
				<linearGradient id="efiKnowledgeGradient" x1="14" y1="12" x2="84" y2="86" gradientUnits="userSpaceOnUse">
					<stop offset="0%" stop-color="#4FC3EA"/>
					<stop offset="100%" stop-color="#1266B3"/>
				</linearGradient>
			</defs>
			<circle cx="48" cy="48" r="45" fill="url(#efiKnowledgeGradient)"/>
			<path d="M28 28h28c6.6 0 12 5.4 12 12v29H38c-5.5 0-10-4.5-10-10V28Z" fill="#ffffff" opacity="0.95"/>
			<path d="M28 28v31c0 5.5 4.5 10 10 10h30" fill="none" stroke="#2BBFD0" stroke-width="4" stroke-linecap="round"/>
			<path d="M40 41h17M40 50h20M40 59h13" stroke="#2BBFD0" stroke-width="4" stroke-linecap="round"/>
		</svg>
		<?php
	}
}

class VitaCenter_Video_Gallery_Widget extends VitaCenter_Structured_Widget_Base {
	public function get_name() { return 'vitacenter_video_gallery'; }
	public function get_title() { return esc_html__( 'VitaCenter Video Gallery', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-gallery-grid'; }
	public function get_style_depends() { return array( 'vc-landing' ); }
	public function get_script_depends() { return array( 'vc-landing' ); }

	protected function register_controls() {
		$this->start_controls_section( 'hero_section', array( 'label' => esc_html__( 'Hero', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'show_hero', array( 'label' => esc_html__( 'Hero megjelenítése', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$this->add_control( 'eyebrow', array( 'label' => esc_html__( 'Kis címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Galéria', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Fotó- és videógaléria', 'vitacenter-elementor-header' ), 'label_block' => true ) );
		$this->add_control( 'intro', array( 'label' => esc_html__( 'Bevezető', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Fotók és videók egészségügyi eseményeinkről, szűréseinkről és közösségi aktivitásainkról.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'show_hero_visual', array( 'label' => esc_html__( 'Vizuális kártya megjelenítése', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$this->add_control( 'visual_title', array( 'label' => esc_html__( 'Vizuális kártya cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Események képekben', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_text', array( 'label' => esc_html__( 'Vizuális kártya szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'fotók · videók · beszámolók', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'filters_section', array( 'label' => esc_html__( 'Szűrők', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'show_filters', array( 'label' => esc_html__( 'Szűrők megjelenítése', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$filters = new Repeater();
		$filters->add_control( 'show_item', array( 'label' => esc_html__( 'Megjelenítés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$filters->add_control( 'title', array( 'label' => esc_html__( 'Felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Összes', 'vitacenter-elementor-header' ) ) );
		$filters->add_control( 'link', array( 'label' => esc_html__( 'Link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$filters->add_control( 'active', array( 'label' => esc_html__( 'Aktív', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => '' ) );
		$this->add_control( 'filters', array(
			'label' => esc_html__( 'Kategória szűrők', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $filters->get_controls(),
			'title_field' => '{{{ title }}}',
			'default' => $this->default_gallery_filters(),
		) );
		$this->end_controls_section();

		$this->start_controls_section( 'featured_section', array( 'label' => esc_html__( 'Kiemelt galéria', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'show_featured', array( 'label' => esc_html__( 'Kiemelt galéria megjelenítése', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$featured = new Repeater();
		$featured->add_control( 'show_item', array( 'label' => esc_html__( 'Megjelenítés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$featured->add_control( 'label', array( 'label' => esc_html__( 'Címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kiemelt album', 'vitacenter-elementor-header' ) ) );
		$featured->add_control( 'media_type', array( 'label' => esc_html__( 'Média típus', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Fotók', 'vitacenter-elementor-header' ) ) );
		$featured->add_control( 'media_kind', array(
			'label' => esc_html__( 'Média forrása', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'placeholder',
			'options' => array(
				'placeholder' => esc_html__( 'Dekor háttér', 'vitacenter-elementor-header' ),
				'image'       => esc_html__( 'Kép a médiatárból', 'vitacenter-elementor-header' ),
				'gallery'     => esc_html__( 'Több képes galéria', 'vitacenter-elementor-header' ),
				'video'       => esc_html__( 'Videó a médiatárból', 'vitacenter-elementor-header' ),
			),
		) );
		$featured->add_control( 'image', array(
			'label' => esc_html__( 'Kép kiválasztása', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::MEDIA,
			'media_types' => array( 'image' ),
			'condition' => array( 'media_kind' => 'image' ),
		) );
		$featured->add_control( 'gallery', array(
			'label' => esc_html__( 'Galéria képek kiválasztása', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::GALLERY,
			'condition' => array( 'media_kind' => 'gallery' ),
		) );
		$featured->add_control( 'video', array(
			'label' => esc_html__( 'Videó kiválasztása', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::MEDIA,
			'media_types' => array( 'video' ),
			'condition' => array( 'media_kind' => 'video' ),
		) );
		$featured->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Album címe', 'vitacenter-elementor-header' ), 'label_block' => true ) );
		$featured->add_control( 'text', array( 'label' => esc_html__( 'Leírás', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Rövid leírás.', 'vitacenter-elementor-header' ) ) );
		$featured->add_control( 'link', array( 'label' => esc_html__( 'Link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$featured->add_control( 'variant', array(
			'label' => esc_html__( 'Vizuális stílus', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'photo',
			'options' => array(
				'photo'     => esc_html__( 'Fotó', 'vitacenter-elementor-header' ),
				'screening' => esc_html__( 'Szűrés', 'vitacenter-elementor-header' ),
				'video'     => esc_html__( 'Videó', 'vitacenter-elementor-header' ),
			),
		) );
		$featured->add_control( 'large', array( 'label' => esc_html__( 'Nagy kártya', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => '' ) );
		$featured->add_control( 'show_play', array( 'label' => esc_html__( 'Lejátszás ikon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => '' ) );
		$this->add_control( 'featured_items', array(
			'label' => esc_html__( 'Kiemelt elemek', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $featured->get_controls(),
			'title_field' => '{{{ title }}}',
			'default' => $this->default_gallery_featured_items(),
		) );
		$this->end_controls_section();

		$this->start_controls_section( 'gallery_section', array( 'label' => esc_html__( 'Galéria elemek', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'show_gallery', array( 'label' => esc_html__( 'Galéria elemek megjelenítése', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$this->add_control( 'gallery_label', array( 'label' => esc_html__( 'Szekció címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Legutóbbi feltöltések', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'gallery_title', array( 'label' => esc_html__( 'Szekció cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Képek és videók', 'vitacenter-elementor-header' ) ) );

		$items = new Repeater();
		$items->add_control( 'show_item', array( 'label' => esc_html__( 'Megjelenítés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$items->add_control( 'badge', array( 'label' => esc_html__( 'Címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Fotóalbum', 'vitacenter-elementor-header' ) ) );
		$items->add_control( 'media_kind', array(
			'label' => esc_html__( 'Média forrása', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'placeholder',
			'options' => array(
				'placeholder' => esc_html__( 'Dekor háttér', 'vitacenter-elementor-header' ),
				'image'       => esc_html__( 'Kép a médiatárból', 'vitacenter-elementor-header' ),
				'gallery'     => esc_html__( 'Több képes galéria', 'vitacenter-elementor-header' ),
				'video'       => esc_html__( 'Videó a médiatárból', 'vitacenter-elementor-header' ),
			),
		) );
		$items->add_control( 'image', array(
			'label' => esc_html__( 'Kép kiválasztása', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::MEDIA,
			'media_types' => array( 'image' ),
			'condition' => array( 'media_kind' => 'image' ),
		) );
		$items->add_control( 'gallery', array(
			'label' => esc_html__( 'Galéria képek kiválasztása', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::GALLERY,
			'condition' => array( 'media_kind' => 'gallery' ),
		) );
		$items->add_control( 'video', array(
			'label' => esc_html__( 'Videó kiválasztása', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::MEDIA,
			'media_types' => array( 'video' ),
			'condition' => array( 'media_kind' => 'video' ),
		) );
		$items->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Galéria elem', 'vitacenter-elementor-header' ), 'label_block' => true ) );
		$items->add_control( 'text', array( 'label' => esc_html__( 'Leírás', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Rövid leírás.', 'vitacenter-elementor-header' ) ) );
		$items->add_control( 'link', array( 'label' => esc_html__( 'Link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$items->add_control( 'variant', array(
			'label' => esc_html__( 'Vizuális stílus', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'one',
			'options' => array(
				'one'   => '1',
				'two'   => '2',
				'three' => '3',
				'four'  => '4',
				'five'  => '5',
				'six'   => '6',
			),
		) );
		$items->add_control( 'show_play', array( 'label' => esc_html__( 'Lejátszás ikon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => '' ) );
		$this->add_control( 'gallery_items', array(
			'label' => esc_html__( 'Galéria elemek', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $items->get_controls(),
			'title_field' => '{{{ title }}}',
			'default' => $this->default_gallery_items(),
		) );
		$this->end_controls_section();

		$this->start_controls_section( 'sidebar_section', array( 'label' => esc_html__( 'Oldalsáv', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'show_sidebar', array( 'label' => esc_html__( 'Oldalsáv megjelenítése', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$this->add_control( 'show_categories', array( 'label' => esc_html__( 'Kategóriák megjelenítése', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$this->add_control( 'categories_label', array( 'label' => esc_html__( 'Kategória címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kategóriák', 'vitacenter-elementor-header' ) ) );
		$categories = new Repeater();
		$categories->add_control( 'show_item', array( 'label' => esc_html__( 'Megjelenítés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$categories->add_control( 'title', array( 'label' => esc_html__( 'Kategória', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Fotók', 'vitacenter-elementor-header' ) ) );
		$categories->add_control( 'count', array( 'label' => esc_html__( 'Darab', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '24' ) );
		$categories->add_control( 'link', array( 'label' => esc_html__( 'Link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->add_control( 'categories', array(
			'label' => esc_html__( 'Kategóriák', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $categories->get_controls(),
			'title_field' => '{{{ title }}}',
			'default' => $this->default_gallery_categories(),
		) );
		$this->add_control( 'show_cta', array( 'label' => esc_html__( 'Kapcsolatfelvétel megjelenítése', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$this->add_control( 'cta_label', array( 'label' => esc_html__( 'Kapcsolat címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kapcsolat', 'vitacenter-elementor-header' ), 'condition' => array( 'show_cta' => 'yes' ) ) );
		$this->add_control( 'cta_title', array( 'label' => esc_html__( 'Kapcsolat cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Van megosztható fotója?', 'vitacenter-elementor-header' ), 'condition' => array( 'show_cta' => 'yes' ) ) );
		$this->add_control( 'cta_text', array( 'label' => esc_html__( 'Kapcsolat szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Programjainkhoz kapcsolódó képeket vagy videókat a kapcsolat oldalon keresztül is elküldhet.', 'vitacenter-elementor-header' ), 'condition' => array( 'show_cta' => 'yes' ) ) );
		$this->add_control( 'cta_phone', array( 'label' => esc_html__( 'Telefon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '+40 261 713 775', 'condition' => array( 'show_cta' => 'yes' ) ) );
		$this->add_control( 'cta_email', array( 'label' => esc_html__( 'E-mail', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => 'efi@szatmar.ro', 'condition' => array( 'show_cta' => 'yes' ) ) );
		$this->add_control( 'cta_button_text', array( 'label' => esc_html__( 'Kapcsolat gomb', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kapcsolatfelvétel', 'vitacenter-elementor-header' ), 'condition' => array( 'show_cta' => 'yes' ) ) );
		$this->add_control( 'cta_link', array( 'label' => esc_html__( 'Kapcsolat link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '/kapcsolat' ), 'condition' => array( 'show_cta' => 'yes' ) ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = wp_parse_args( $this->get_settings_for_display(), $this->default_gallery_settings() );

		$show_hero       = 'yes' === $this->plain_text( $s['show_hero'] );
		$show_filters    = 'yes' === $this->plain_text( $s['show_filters'] );
		$show_featured   = 'yes' === $this->plain_text( $s['show_featured'] );
		$show_gallery    = 'yes' === $this->plain_text( $s['show_gallery'] );
		$show_sidebar    = 'yes' === $this->plain_text( $s['show_sidebar'] );
		$show_categories = $show_sidebar && 'yes' === $this->plain_text( $s['show_categories'] );
		$show_cta        = $show_sidebar && 'yes' === $this->plain_text( $s['show_cta'] );
		$filter_items    = isset( $s['filters'] ) ? $s['filters'] : array();
		$featured_items  = isset( $s['featured_items'] ) ? $s['featured_items'] : array();
		$gallery_items   = isset( $s['gallery_items'] ) ? $s['gallery_items'] : array();
		$category_items  = isset( $s['categories'] ) ? $s['categories'] : array();
		$filters         = $show_filters ? $this->normalize_gallery_filters( $filter_items ) : array();
		$featured        = $show_featured ? $this->normalize_gallery_featured_items( $featured_items ) : array();
		$items           = $show_gallery ? $this->normalize_gallery_items( $gallery_items ) : array();
		$cats            = $show_categories ? $this->normalize_gallery_categories( $category_items ) : array();

		if ( $show_filters && empty( $filters ) && empty( $filter_items ) ) {
			$filters = $this->normalize_gallery_filters( $this->default_gallery_filters() );
		}

		if ( $show_featured && empty( $featured ) && empty( $featured_items ) ) {
			$featured = $this->normalize_gallery_featured_items( $this->default_gallery_featured_items() );
		}

		if ( $show_gallery && empty( $items ) && empty( $gallery_items ) ) {
			$items = $this->normalize_gallery_items( $this->default_gallery_items() );
		}

		if ( $show_categories && empty( $cats ) && empty( $category_items ) ) {
			$cats = $this->normalize_gallery_categories( $this->default_gallery_categories() );
		}

		$has_sidebar_content = $show_sidebar && ( ( $show_categories && ! empty( $cats ) ) || $show_cta );
		$main_grid_classes   = 'efi-gallery-main-grid';

		if ( ! $has_sidebar_content ) {
			$main_grid_classes .= ' efi-gallery-main-grid--no-sidebar';
		} elseif ( ! $show_gallery ) {
			$main_grid_classes .= ' efi-gallery-main-grid--sidebar-only';
		}
		?>
		<div class="vc-landing">
			<section class="efi-gallery-page" aria-label="<?php echo esc_attr__( 'Fotó- és videógaléria oldal', 'vitacenter-elementor-header' ); ?>">
				<?php if ( $show_hero ) : ?>
					<div class="efi-gallery-hero <?php echo 'yes' === $this->plain_text( $s['show_hero_visual'] ) ? '' : 'efi-gallery-hero--text-only'; ?>">
						<div class="efi-gallery-hero__content">
							<?php if ( '' !== $this->plain_text( $s['eyebrow'] ) ) : ?><span class="efi-gallery-eyebrow"><?php echo esc_html( $this->plain_text( $s['eyebrow'] ) ); ?></span><?php endif; ?>
							<h1><?php echo esc_html( $this->plain_text( $s['title'] ) ); ?></h1>
							<?php if ( '' !== $this->plain_text( $s['intro'] ) ) : ?><p><?php echo esc_html( $this->plain_text( $s['intro'] ) ); ?></p><?php endif; ?>
						</div>

						<?php if ( 'yes' === $this->plain_text( $s['show_hero_visual'] ) ) : ?>
							<div class="efi-gallery-hero__visual" aria-hidden="true">
								<div class="efi-gallery-stack efi-gallery-stack--one"></div>
								<div class="efi-gallery-stack efi-gallery-stack--two"></div>
								<div class="efi-gallery-play-card">
									<span class="efi-gallery-play-icon"><?php $this->render_gallery_play_icon(); ?></span>
									<strong><?php echo esc_html( $this->plain_text( $s['visual_title'] ) ); ?></strong>
									<small><?php echo esc_html( $this->plain_text( $s['visual_text'] ) ); ?></small>
								</div>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $filters ) ) : ?>
					<nav class="efi-gallery-filter" aria-label="<?php echo esc_attr__( 'Galéria kategóriák', 'vitacenter-elementor-header' ); ?>">
						<?php foreach ( $filters as $filter ) : ?>
							<a class="<?php echo $filter['active'] ? 'is-active' : ''; ?>" <?php echo $this->url_attributes( $filter['link'] ); ?>><?php echo esc_html( $filter['title'] ); ?></a>
						<?php endforeach; ?>
					</nav>
				<?php endif; ?>

				<?php if ( ! empty( $featured ) ) : ?>
					<div class="efi-gallery-featured">
						<?php foreach ( $featured as $item ) : ?>
							<?php $this->render_gallery_featured_card( $item ); ?>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<?php if ( $show_gallery || $has_sidebar_content ) : ?>
					<div class="<?php echo esc_attr( $main_grid_classes ); ?>">
						<?php if ( $show_gallery ) : ?>
							<main class="efi-gallery-content" aria-label="<?php echo esc_attr__( 'Galéria elemek', 'vitacenter-elementor-header' ); ?>">
								<div class="efi-gallery-section-heading">
									<?php if ( '' !== $this->plain_text( $s['gallery_label'] ) ) : ?><span><?php echo esc_html( $this->plain_text( $s['gallery_label'] ) ); ?></span><?php endif; ?>
									<?php if ( '' !== $this->plain_text( $s['gallery_title'] ) ) : ?><h2><?php echo esc_html( $this->plain_text( $s['gallery_title'] ) ); ?></h2><?php endif; ?>
								</div>

								<?php if ( ! empty( $items ) ) : ?>
									<div class="efi-gallery-grid">
										<?php foreach ( $items as $item ) : ?>
											<?php $this->render_gallery_item( $item ); ?>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
							</main>
						<?php endif; ?>

						<?php if ( $has_sidebar_content ) : ?>
							<aside class="efi-gallery-sidebar" aria-label="<?php echo esc_attr__( 'Galéria oldalsáv', 'vitacenter-elementor-header' ); ?>">
								<?php if ( $show_categories && ! empty( $cats ) ) : ?>
									<div class="efi-gallery-sidebar-card">
										<?php if ( '' !== $this->plain_text( $s['categories_label'] ) ) : ?><span class="efi-gallery-card-label"><?php echo esc_html( $this->plain_text( $s['categories_label'] ) ); ?></span><?php endif; ?>
										<nav class="efi-gallery-category-list">
											<?php foreach ( $cats as $cat ) : ?>
												<a <?php echo $this->url_attributes( $cat['link'] ); ?>><span><?php echo esc_html( $cat['title'] ); ?></span><strong><?php echo esc_html( $cat['count'] ); ?></strong></a>
											<?php endforeach; ?>
										</nav>
									</div>
								<?php endif; ?>

								<?php if ( $show_cta ) : ?>
									<?php $this->render_gallery_contact_card( $s ); ?>
								<?php endif; ?>
							</aside>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</section>
		</div>
		<?php
	}

	private function default_gallery_settings() {
		return array(
			'show_hero'        => 'yes',
			'eyebrow'          => esc_html__( 'Galéria', 'vitacenter-elementor-header' ),
			'title'            => esc_html__( 'Fotó- és videógaléria', 'vitacenter-elementor-header' ),
			'intro'            => esc_html__( 'Fotók és videók egészségügyi eseményeinkről, szűréseinkről és közösségi aktivitásainkról.', 'vitacenter-elementor-header' ),
			'show_hero_visual' => 'yes',
			'visual_title'     => esc_html__( 'Események képekben', 'vitacenter-elementor-header' ),
			'visual_text'      => esc_html__( 'fotók · videók · beszámolók', 'vitacenter-elementor-header' ),
			'show_filters'     => 'yes',
			'filters'          => $this->default_gallery_filters(),
			'show_featured'    => 'yes',
			'featured_items'   => $this->default_gallery_featured_items(),
			'show_gallery'     => 'yes',
			'gallery_label'    => esc_html__( 'Legutóbbi feltöltések', 'vitacenter-elementor-header' ),
			'gallery_title'    => esc_html__( 'Képek és videók', 'vitacenter-elementor-header' ),
			'gallery_items'    => $this->default_gallery_items(),
			'show_sidebar'     => 'yes',
			'show_categories'  => 'yes',
			'categories_label' => esc_html__( 'Kategóriák', 'vitacenter-elementor-header' ),
			'categories'       => $this->default_gallery_categories(),
			'show_cta'         => 'yes',
			'cta_label'        => esc_html__( 'Kapcsolat', 'vitacenter-elementor-header' ),
			'cta_title'        => esc_html__( 'Van megosztható fotója?', 'vitacenter-elementor-header' ),
			'cta_text'         => esc_html__( 'Programjainkhoz kapcsolódó képeket vagy videókat a kapcsolat oldalon keresztül is elküldhet.', 'vitacenter-elementor-header' ),
			'cta_phone'        => '+40 261 713 775',
			'cta_email'        => 'efi@szatmar.ro',
			'cta_button_text'  => esc_html__( 'Kapcsolatfelvétel', 'vitacenter-elementor-header' ),
			'cta_link'         => array( 'url' => '/kapcsolat' ),
		);
	}

	private function default_gallery_filters() {
		return array(
			array( 'show_item' => 'yes', 'title' => esc_html__( 'Összes', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ), 'active' => 'yes' ),
			array( 'show_item' => 'yes', 'title' => esc_html__( 'Események', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ), 'active' => '' ),
			array( 'show_item' => 'yes', 'title' => esc_html__( 'Szűrések', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ), 'active' => '' ),
			array( 'show_item' => 'yes', 'title' => esc_html__( 'Közösségi programok', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ), 'active' => '' ),
			array( 'show_item' => 'yes', 'title' => esc_html__( 'Videók', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ), 'active' => '' ),
		);
	}

	private function default_gallery_featured_items() {
		return array(
			array( 'show_item' => 'yes', 'label' => esc_html__( 'Kiemelt album', 'vitacenter-elementor-header' ), 'media_type' => esc_html__( 'Fotók', 'vitacenter-elementor-header' ), 'media_kind' => 'placeholder', 'image' => array(), 'gallery' => array(), 'video' => array(), 'title' => esc_html__( 'Egészségügyi események', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Válogatás legfontosabb programjaink pillanataiból.', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ), 'variant' => 'photo', 'large' => 'yes', 'show_play' => '' ),
			array( 'show_item' => 'yes', 'label' => '', 'media_type' => esc_html__( 'Album', 'vitacenter-elementor-header' ), 'media_kind' => 'placeholder', 'image' => array(), 'gallery' => array(), 'video' => array(), 'title' => esc_html__( 'Szűrések', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Helyszíni programok és szakmai aktivitások.', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ), 'variant' => 'screening', 'large' => '', 'show_play' => '' ),
			array( 'show_item' => 'yes', 'label' => '', 'media_type' => esc_html__( 'Videó', 'vitacenter-elementor-header' ), 'media_kind' => 'placeholder', 'image' => array(), 'gallery' => array(), 'video' => array(), 'title' => esc_html__( 'Videós beszámolók', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Rövid összefoglalók eseményeinkről.', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ), 'variant' => 'video', 'large' => '', 'show_play' => 'yes' ),
		);
	}

	private function default_gallery_items() {
		return array(
			array( 'show_item' => 'yes', 'badge' => esc_html__( 'Fotóalbum', 'vitacenter-elementor-header' ), 'media_kind' => 'placeholder', 'image' => array(), 'gallery' => array(), 'video' => array(), 'title' => esc_html__( 'Közösségi egészségnap', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Egészségfejlesztési programok és lakossági aktivitások.', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ), 'variant' => 'one', 'show_play' => '' ),
			array( 'show_item' => 'yes', 'badge' => esc_html__( 'Fotóalbum', 'vitacenter-elementor-header' ), 'media_kind' => 'placeholder', 'image' => array(), 'gallery' => array(), 'video' => array(), 'title' => esc_html__( 'Mobil szűrés', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Pillanatképek helyszíni szűrőprogramjainkról.', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ), 'variant' => 'two', 'show_play' => '' ),
			array( 'show_item' => 'yes', 'badge' => esc_html__( 'Videó', 'vitacenter-elementor-header' ), 'media_kind' => 'placeholder', 'image' => array(), 'gallery' => array(), 'video' => array(), 'title' => esc_html__( 'Tanácsadási programok', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Rövid videós betekintés a szakmai munkába.', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ), 'variant' => 'three', 'show_play' => 'yes' ),
			array( 'show_item' => 'yes', 'badge' => esc_html__( 'Fotóalbum', 'vitacenter-elementor-header' ), 'media_kind' => 'placeholder', 'image' => array(), 'gallery' => array(), 'video' => array(), 'title' => esc_html__( 'Óvodai programok', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Korai fejlesztést támogató közösségi alkalmak.', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ), 'variant' => 'four', 'show_play' => '' ),
			array( 'show_item' => 'yes', 'badge' => esc_html__( 'Videó', 'vitacenter-elementor-header' ), 'media_kind' => 'placeholder', 'image' => array(), 'gallery' => array(), 'video' => array(), 'title' => esc_html__( 'Workshopok', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Szakmai találkozók és tájékoztató alkalmak.', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ), 'variant' => 'five', 'show_play' => 'yes' ),
			array( 'show_item' => 'yes', 'badge' => esc_html__( 'Fotóalbum', 'vitacenter-elementor-header' ), 'media_kind' => 'placeholder', 'image' => array(), 'gallery' => array(), 'video' => array(), 'title' => esc_html__( 'Közösségi aktivitások', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Programok, találkozók és helyi kezdeményezések.', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#' ), 'variant' => 'six', 'show_play' => '' ),
		);
	}

	private function default_gallery_categories() {
		return array(
			array( 'show_item' => 'yes', 'title' => esc_html__( 'Fotók', 'vitacenter-elementor-header' ), 'count' => '24', 'link' => array( 'url' => '#' ) ),
			array( 'show_item' => 'yes', 'title' => esc_html__( 'Videók', 'vitacenter-elementor-header' ), 'count' => '8', 'link' => array( 'url' => '#' ) ),
			array( 'show_item' => 'yes', 'title' => esc_html__( 'Események', 'vitacenter-elementor-header' ), 'count' => '12', 'link' => array( 'url' => '#' ) ),
			array( 'show_item' => 'yes', 'title' => esc_html__( 'Szűrések', 'vitacenter-elementor-header' ), 'count' => '7', 'link' => array( 'url' => '#' ) ),
		);
	}

	private function normalize_gallery_filters( $items ) {
		$filters = array();

		foreach ( $this->repeater_items( $items ) as $item ) {
			if ( isset( $item['show_item'] ) && 'yes' !== $this->plain_text( $item['show_item'] ) ) {
				continue;
			}

			$title = isset( $item['title'] ) ? $this->plain_text( $item['title'] ) : '';

			if ( '' === $title ) {
				continue;
			}

			$filters[] = array(
				'title'  => $title,
				'link'   => isset( $item['link'] ) ? $item['link'] : array( 'url' => '#' ),
				'active' => isset( $item['active'] ) && 'yes' === $this->plain_text( $item['active'] ),
			);
		}

		return $filters;
	}

	private function normalize_gallery_featured_items( $items ) {
		$featured = array();
		$index    = 0;

		foreach ( $this->repeater_items( $items ) as $item ) {
			if ( isset( $item['show_item'] ) && 'yes' !== $this->plain_text( $item['show_item'] ) ) {
				continue;
			}

			$title = isset( $item['title'] ) ? $this->plain_text( $item['title'] ) : '';

			if ( '' === $title ) {
				continue;
			}

			$featured[] = array(
				'label'      => isset( $item['label'] ) ? $this->plain_text( $item['label'] ) : '',
				'media_type' => isset( $item['media_type'] ) ? $this->plain_text( $item['media_type'] ) : '',
				'media_kind' => isset( $item['media_kind'] ) ? $this->gallery_media_kind( $item['media_kind'] ) : 'placeholder',
				'image_url'  => isset( $item['image'] ) ? $this->media_url( $item['image'] ) : '',
				'gallery_urls' => isset( $item['gallery'] ) ? $this->gallery_image_urls( $item['gallery'] ) : array(),
				'video_url'  => isset( $item['video'] ) ? $this->media_url( $item['video'] ) : '',
				'title'      => $title,
				'text'       => isset( $item['text'] ) ? $this->plain_text( $item['text'] ) : '',
				'link'       => isset( $item['link'] ) ? $item['link'] : array( 'url' => '#' ),
				'variant'    => isset( $item['variant'] ) ? $this->gallery_variant( $item['variant'], array( 'photo', 'screening', 'video' ), 'photo' ) : 'photo',
				'large'      => isset( $item['large'] ) && 'yes' === $this->plain_text( $item['large'] ),
				'show_play'  => isset( $item['show_play'] ) && 'yes' === $this->plain_text( $item['show_play'] ),
				'lightbox_group' => 'featured-' . $index,
			);

			$index++;
		}

		return $featured;
	}

	private function normalize_gallery_items( $items ) {
		$gallery = array();
		$index   = 0;

		foreach ( $this->repeater_items( $items ) as $item ) {
			if ( isset( $item['show_item'] ) && 'yes' !== $this->plain_text( $item['show_item'] ) ) {
				continue;
			}

			$title = isset( $item['title'] ) ? $this->plain_text( $item['title'] ) : '';

			if ( '' === $title ) {
				continue;
			}

			$gallery[] = array(
				'badge'      => isset( $item['badge'] ) ? $this->plain_text( $item['badge'] ) : '',
				'media_kind' => isset( $item['media_kind'] ) ? $this->gallery_media_kind( $item['media_kind'] ) : 'placeholder',
				'image_url'  => isset( $item['image'] ) ? $this->media_url( $item['image'] ) : '',
				'gallery_urls' => isset( $item['gallery'] ) ? $this->gallery_image_urls( $item['gallery'] ) : array(),
				'video_url'  => isset( $item['video'] ) ? $this->media_url( $item['video'] ) : '',
				'title'      => $title,
				'text'       => isset( $item['text'] ) ? $this->plain_text( $item['text'] ) : '',
				'link'       => isset( $item['link'] ) ? $item['link'] : array( 'url' => '#' ),
				'variant'    => isset( $item['variant'] ) ? $this->gallery_variant( $item['variant'], array( 'one', 'two', 'three', 'four', 'five', 'six' ), 'one' ) : 'one',
				'show_play'  => isset( $item['show_play'] ) && 'yes' === $this->plain_text( $item['show_play'] ),
				'lightbox_group' => 'grid-' . $index,
			);

			$index++;
		}

		return $gallery;
	}

	private function normalize_gallery_categories( $items ) {
		$categories = array();

		foreach ( $this->repeater_items( $items ) as $item ) {
			if ( isset( $item['show_item'] ) && 'yes' !== $this->plain_text( $item['show_item'] ) ) {
				continue;
			}

			$title = isset( $item['title'] ) ? $this->plain_text( $item['title'] ) : '';

			if ( '' === $title ) {
				continue;
			}

			$categories[] = array(
				'title' => $title,
				'count' => isset( $item['count'] ) ? $this->plain_text( $item['count'] ) : '',
				'link'  => isset( $item['link'] ) ? $item['link'] : array( 'url' => '#' ),
			);
		}

		return $categories;
	}

	private function render_gallery_featured_card( $item ) {
		$classes = 'efi-gallery-featured-card';

		if ( $item['large'] ) {
			$classes .= ' efi-gallery-featured-card--large';
		}
		?>
		<article class="<?php echo esc_attr( $classes ); ?>">
			<a class="efi-gallery-media-link" aria-label="<?php echo esc_attr( $item['title'] ); ?>" <?php echo $this->gallery_card_link_attributes( $item ); ?>>
				<?php $this->render_gallery_media( $item, 'efi-gallery-placeholder', 'efi-gallery-placeholder--' . $item['variant'], $item['media_type'], true ); ?>
				<div class="efi-gallery-card-content">
					<?php if ( '' !== $item['label'] ) : ?><span class="efi-gallery-card-label"><?php echo esc_html( $item['label'] ); ?></span><?php endif; ?>
					<?php if ( $item['large'] ) : ?><h2><?php echo esc_html( $item['title'] ); ?></h2><?php else : ?><h3><?php echo esc_html( $item['title'] ); ?></h3><?php endif; ?>
					<?php if ( '' !== $item['text'] ) : ?><p><?php echo esc_html( $item['text'] ); ?></p><?php endif; ?>
				</div>
			</a>
			<?php $this->render_gallery_lightbox_links( $item ); ?>
		</article>
		<?php
	}

	private function render_gallery_item( $item ) {
		?>
		<article class="efi-gallery-item">
			<a aria-label="<?php echo esc_attr( $item['title'] ); ?>" <?php echo $this->gallery_card_link_attributes( $item ); ?>>
				<?php $this->render_gallery_media( $item, 'efi-gallery-thumb', 'efi-gallery-thumb--' . $item['variant'], $item['badge'], false ); ?>
				<div class="efi-gallery-item-body">
					<h3><?php echo esc_html( $item['title'] ); ?></h3>
					<?php if ( '' !== $item['text'] ) : ?><p><?php echo esc_html( $item['text'] ); ?></p><?php endif; ?>
				</div>
			</a>
			<?php $this->render_gallery_lightbox_links( $item ); ?>
		</article>
		<?php
	}

	private function render_gallery_media( $item, $base_class, $variant_class, $badge, $show_placeholder_icon ) {
		$media_kind = isset( $item['media_kind'] ) ? $item['media_kind'] : 'placeholder';
		$image_url  = isset( $item['image_url'] ) ? $item['image_url'] : '';
		$gallery_urls = isset( $item['gallery_urls'] ) && is_array( $item['gallery_urls'] ) ? $item['gallery_urls'] : array();
		$video_url  = isset( $item['video_url'] ) ? $item['video_url'] : '';
		$has_image  = 'image' === $media_kind && '' !== $image_url;
		$has_gallery = 'gallery' === $media_kind && ! empty( $gallery_urls );
		$has_video  = 'video' === $media_kind && '' !== $video_url;
		$classes    = trim( $base_class . ' ' . $variant_class );
		$show_play  = ( isset( $item['show_play'] ) && $item['show_play'] ) || $has_video;

		if ( $has_image || $has_gallery || $has_video ) {
			$classes .= ' efi-gallery-media-shell efi-gallery-media-shell--has-media';
		}

		if ( $has_gallery ) {
			$classes .= ' efi-gallery-media-shell--gallery';
		}

		if ( $has_video ) {
			$classes .= ' efi-gallery-media-shell--video';
		}
		?>
		<div class="<?php echo esc_attr( $classes ); ?>">
			<?php if ( $has_image ) : ?>
				<img class="efi-gallery-selected-media efi-gallery-selected-media--image" src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" loading="lazy">
			<?php elseif ( $has_gallery ) : ?>
				<img class="efi-gallery-selected-media efi-gallery-selected-media--image" src="<?php echo esc_url( $gallery_urls[0] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" loading="lazy">
			<?php elseif ( $has_video ) : ?>
				<video class="efi-gallery-selected-media efi-gallery-selected-media--video" preload="metadata" muted playsinline>
					<source src="<?php echo esc_url( $video_url ); ?>">
				</video>
			<?php endif; ?>

			<?php if ( '' !== $badge ) : ?>
				<span class="<?php echo 'efi-gallery-placeholder' === $base_class ? 'efi-gallery-type' : ''; ?>"><?php echo esc_html( $badge ); ?></span>
			<?php endif; ?>

			<?php if ( $has_gallery && count( $gallery_urls ) > 1 ) : ?>
				<small class="efi-gallery-photo-count"><?php echo esc_html( count( $gallery_urls ) ); ?> kép</small>
			<?php endif; ?>

			<?php if ( $show_play ) : ?>
				<?php if ( 'efi-gallery-thumb' === $base_class ) : ?><i aria-hidden="true">&#9654;</i><?php else : ?><span class="efi-video-play" aria-hidden="true">&#9654;</span><?php endif; ?>
			<?php elseif ( $show_placeholder_icon ) : ?>
				<span class="efi-gallery-placeholder-icon" aria-hidden="true"><?php $this->render_gallery_camera_icon(); ?></span>
			<?php endif; ?>
		</div>
		<?php
	}

	private function gallery_card_link_attributes( $item ) {
		if ( isset( $item['media_kind'], $item['image_url'] ) && 'image' === $item['media_kind'] && '' !== $item['image_url'] ) {
			$images = array( $item['image_url'] );
			$json   = function_exists( 'wp_json_encode' ) ? wp_json_encode( $images ) : json_encode( $images );
			$group  = $this->gallery_lightbox_group( $item );

			return implode(
				' ',
				array(
					'href="' . esc_url( $item['image_url'] ) . '"',
					'data-efi-gallery-lightbox="true"',
					'data-efi-gallery-images="' . esc_attr( $json ) . '"',
					'data-efi-gallery-title="' . esc_attr( $item['title'] ) . '"',
					'data-elementor-open-lightbox="yes"',
					'data-elementor-lightbox-slideshow="' . esc_attr( $group ) . '"',
					'data-elementor-lightbox-title="' . esc_attr( $item['title'] ) . '"',
				)
			);
		}

		if ( isset( $item['media_kind'], $item['gallery_urls'] ) && 'gallery' === $item['media_kind'] && ! empty( $item['gallery_urls'] ) && is_array( $item['gallery_urls'] ) ) {
			$images = array_values( $item['gallery_urls'] );
			$json   = function_exists( 'wp_json_encode' ) ? wp_json_encode( $images ) : json_encode( $images );
			$group  = $this->gallery_lightbox_group( $item );

			return implode(
				' ',
				array(
					'href="' . esc_url( $images[0] ) . '"',
					'data-efi-gallery-lightbox="true"',
					'data-efi-gallery-images="' . esc_attr( $json ) . '"',
					'data-efi-gallery-title="' . esc_attr( $item['title'] ) . '"',
					'data-elementor-open-lightbox="yes"',
					'data-elementor-lightbox-slideshow="' . esc_attr( $group ) . '"',
					'data-elementor-lightbox-title="' . esc_attr( $item['title'] ) . '"',
				)
			);
		}

		return $this->url_attributes( $item['link'] );
	}

	private function render_gallery_lightbox_links( $item ) {
		if ( ! isset( $item['media_kind'], $item['gallery_urls'] ) || 'gallery' !== $item['media_kind'] || empty( $item['gallery_urls'] ) || ! is_array( $item['gallery_urls'] ) ) {
			return;
		}

		$images = array_values( $item['gallery_urls'] );

		if ( count( $images ) < 2 ) {
			return;
		}

		$group = $this->gallery_lightbox_group( $item );

		foreach ( array_slice( $images, 1 ) as $url ) :
			?>
			<a
				class="efi-gallery-lightbox-link"
				href="<?php echo esc_url( $url ); ?>"
				data-elementor-open-lightbox="yes"
				data-elementor-lightbox-slideshow="<?php echo esc_attr( $group ); ?>"
				data-elementor-lightbox-title="<?php echo esc_attr( $item['title'] ); ?>"
				aria-hidden="true"
				tabindex="-1"
			></a>
			<?php
		endforeach;
	}

	private function render_gallery_contact_card( $settings ) {
		$label      = isset( $settings['cta_label'] ) ? $this->plain_text( $settings['cta_label'] ) : '';
		$title      = isset( $settings['cta_title'] ) ? $this->plain_text( $settings['cta_title'] ) : '';
		$text       = isset( $settings['cta_text'] ) ? $this->plain_text( $settings['cta_text'] ) : '';
		$phone      = isset( $settings['cta_phone'] ) ? $this->plain_text( $settings['cta_phone'] ) : '';
		$email      = isset( $settings['cta_email'] ) ? $this->plain_text( $settings['cta_email'] ) : '';
		$phone_href = $this->gallery_phone_href( $phone );
		$email_href = $this->gallery_email_href( $email );
		?>
		<div class="efi-gallery-sidebar-card efi-gallery-sidebar-card--cta efi-gallery-contact-card">
			<div class="efi-gallery-contact-card__head">
				<span class="efi-gallery-contact-icon" aria-hidden="true">&#9993;</span>
				<?php if ( '' !== $label ) : ?><span class="efi-gallery-card-label"><?php echo esc_html( $label ); ?></span><?php endif; ?>
			</div>

			<?php if ( '' !== $title ) : ?><h3><?php echo esc_html( $title ); ?></h3><?php endif; ?>
			<?php if ( '' !== $text ) : ?><p><?php echo esc_html( $text ); ?></p><?php endif; ?>

			<?php if ( '' !== $phone || '' !== $email ) : ?>
				<div class="efi-gallery-contact-list">
					<?php if ( '' !== $phone ) : ?>
						<div class="efi-gallery-contact-row">
							<span><?php echo esc_html__( 'Telefon', 'vitacenter-elementor-header' ); ?></span>
							<?php if ( '' !== $phone_href ) : ?><a href="<?php echo esc_url( $phone_href ); ?>"><?php echo esc_html( $phone ); ?></a><?php else : ?><strong><?php echo esc_html( $phone ); ?></strong><?php endif; ?>
						</div>
					<?php endif; ?>

					<?php if ( '' !== $email ) : ?>
						<div class="efi-gallery-contact-row">
							<span><?php echo esc_html__( 'E-mail', 'vitacenter-elementor-header' ); ?></span>
							<?php if ( '' !== $email_href ) : ?><a href="<?php echo esc_url( $email_href ); ?>"><?php echo esc_html( $email ); ?></a><?php else : ?><strong><?php echo esc_html( $email ); ?></strong><?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php $this->render_gallery_link_button( $settings['cta_button_text'], $settings['cta_link'] ); ?>
		</div>
		<?php
	}

	private function render_gallery_link_button( $text, $link ) {
		$text = $this->plain_text( $text );

		if ( '' === $text ) {
			return;
		}
		?>
		<a class="efi-gallery-contact-button" <?php echo $this->url_attributes( $link ); ?>><?php echo esc_html( $text ); ?><span aria-hidden="true">&#8594;</span></a>
		<?php
	}

	private function gallery_phone_href( $phone ) {
		$normalized = preg_replace( '/[^0-9+]/', '', $this->plain_text( $phone ) );

		return $normalized ? 'tel:' . $normalized : '';
	}

	private function gallery_email_href( $email ) {
		$email = sanitize_email( $this->plain_text( $email ) );

		return is_email( $email ) ? 'mailto:' . $email : '';
	}

	private function gallery_variant( $value, $allowed, $fallback ) {
		$value = $this->plain_text( $value );

		return in_array( $value, $allowed, true ) ? $value : $fallback;
	}

	private function gallery_media_kind( $value ) {
		return $this->gallery_variant( $value, array( 'placeholder', 'image', 'gallery', 'video' ), 'placeholder' );
	}

	private function gallery_image_urls( $gallery ) {
		$urls = array();

		foreach ( $this->repeater_items( $gallery ) as $image ) {
			$url = $this->media_url( $image );

			if ( '' !== $url ) {
				$urls[] = $url;
			}
		}

		return array_values( array_unique( $urls ) );
	}

	private function gallery_lightbox_group( $item ) {
		$group = isset( $item['lightbox_group'] ) ? $this->plain_text( $item['lightbox_group'] ) : 'gallery';

		return 'efi-gallery-' . preg_replace( '/[^a-z0-9_-]+/i', '-', $group );
	}

	private function render_gallery_play_icon() {
		?>
		<svg viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg">
			<defs>
				<linearGradient id="efiGalleryGradient" x1="14" y1="12" x2="84" y2="86" gradientUnits="userSpaceOnUse">
					<stop offset="0%" stop-color="#4FC3EA"/>
					<stop offset="100%" stop-color="#1266B3"/>
				</linearGradient>
			</defs>
			<circle cx="48" cy="48" r="45" fill="url(#efiGalleryGradient)"/>
			<path d="M39 31.5 67 48 39 64.5v-33Z" fill="#ffffff"/>
		</svg>
		<?php
	}

	private function render_gallery_camera_icon() {
		?>
		<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M4 7.5h3l1.6-2h6.8l1.6 2h3v11H4v-11Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
			<circle cx="12" cy="13" r="3.4" stroke="currentColor" stroke-width="1.8"/>
		</svg>
		<?php
	}
}

class VitaCenter_Partners_Widget extends VitaCenter_Structured_Widget_Base {
	public function get_name() { return 'vitacenter_partners'; }
	public function get_title() { return esc_html__( 'VitaCenter Partners', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-users'; }
	public function get_style_depends() { return array( 'vc-landing' ); }
	public function get_script_depends() { return array( 'vc-landing' ); }

	protected function register_controls() {
		$this->start_controls_section( 'hero_section', array( 'label' => esc_html__( 'Hero', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => esc_html__( 'Kis címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Partnerek', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Partnerek', 'vitacenter-elementor-header' ), 'label_block' => true ) );
		$this->add_control( 'intro', array( 'label' => esc_html__( 'Bevezető', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A projekt a vezető partner és a projektpartnerek együttműködésével valósul meg.', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'partners_section', array( 'label' => esc_html__( 'Partner intézmények', 'vitacenter-elementor-header' ) ) );
		$r = new Repeater();
		$r->add_control( 'logo', array( 'label' => esc_html__( 'Logó', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::MEDIA, 'default' => $this->media_default( 'birodepromovare (1).png' ) ) );
		$r->add_control( 'logo_text', array( 'label' => esc_html__( 'Logó rövidítés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => 'EFI' ) );
		$r->add_control( 'type', array( 'label' => esc_html__( 'Típus', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Projektpartner', 'vitacenter-elementor-header' ) ) );
		$r->add_control( 'name', array( 'label' => esc_html__( 'Név', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Partner neve', 'vitacenter-elementor-header' ), 'label_block' => true ) );
		$r->add_control( 'description', array( 'label' => esc_html__( 'Leírás', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => '' ) );
		$r->add_control( 'featured', array( 'label' => esc_html__( 'Kiemelt partner', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => '' ) );
		$this->add_control( 'partners', array(
			'label' => esc_html__( 'Partnerek', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $r->get_controls(),
			'title_field' => '{{{ name }}}',
			'default' => $this->default_partners(),
		) );
		$this->end_controls_section();

		$this->start_controls_section( 'note_section', array( 'label' => esc_html__( 'Alsó megjegyzés', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'note_text', array( 'label' => esc_html__( 'Megjegyzés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A partnerség célja, hogy a projekt egészségfejlesztési, szűrési és szakmai tevékenységei szervezett együttműködésben valósuljanak meg.', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = wp_parse_args(
			$this->get_settings_for_display(),
			array(
				'eyebrow'   => esc_html__( 'Partnerek', 'vitacenter-elementor-header' ),
				'title'     => esc_html__( 'Partnerek', 'vitacenter-elementor-header' ),
				'intro'     => esc_html__( 'A projekt a vezető partner és a projektpartnerek együttműködésével valósul meg.', 'vitacenter-elementor-header' ),
				'partners'  => $this->default_partners(),
				'note_text' => esc_html__( 'A partnerség célja, hogy a projekt egészségfejlesztési, szűrési és szakmai tevékenységei szervezett együttműködésben valósuljanak meg.', 'vitacenter-elementor-header' ),
			)
		);

		$partner_items = $this->partner_items_for_render( isset( $s['partners'] ) ? $s['partners'] : array() );

		if ( 'Együtt az egészségesebb közösségekért' === $this->plain_text( $s['title'] ) ) {
			$s['title'] = esc_html__( 'Partnerek', 'vitacenter-elementor-header' );
		}

		if ( 'Projektünk szakmai és intézményi partnereink együttműködésével valósul meg.' === $this->plain_text( $s['intro'] ) ) {
			$s['intro'] = esc_html__( 'A projekt a vezető partner és a projektpartnerek együttműködésével valósul meg.', 'vitacenter-elementor-header' );
		}

		$partners = $this->normalize_partners( $partner_items );

		if ( empty( $partners ) ) {
			$partners = $this->normalize_partners( $this->default_partners() );
		}
		?>
		<div class="vc-landing">
			<section class="efi-partners-page" aria-label="<?php echo esc_attr__( 'Partnerek oldal', 'vitacenter-elementor-header' ); ?>">
				<div class="efi-partners-hero">
					<?php if ( '' !== $this->plain_text( $s['eyebrow'] ) ) : ?><span class="efi-partners-eyebrow"><?php echo esc_html( $this->plain_text( $s['eyebrow'] ) ); ?></span><?php endif; ?>
					<h1><?php echo esc_html( $this->plain_text( $s['title'] ) ); ?></h1>
					<?php if ( '' !== $this->plain_text( $s['intro'] ) ) : ?><p><?php echo esc_html( $this->plain_text( $s['intro'] ) ); ?></p><?php endif; ?>
				</div>

				<div class="efi-partners-grid" aria-label="<?php echo esc_attr__( 'Partner intézmények', 'vitacenter-elementor-header' ); ?>">
					<?php foreach ( $partners as $partner ) : ?>
						<?php $this->render_partner_card( $partner ); ?>
					<?php endforeach; ?>
				</div>

				<?php if ( '' !== $this->plain_text( $s['note_text'] ) ) : ?>
					<div class="efi-partners-note">
						<div class="efi-partners-note__icon" aria-hidden="true">
							<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M7.5 12.5 10.5 15.5 16.8 8.8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								<circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/>
							</svg>
						</div>
						<p><?php echo esc_html( $this->plain_text( $s['note_text'] ) ); ?></p>
					</div>
				<?php endif; ?>
			</section>
		</div>
		<?php
	}

	private function default_partners() {
		$leader_logo      = $this->leader_partner_logo();
		$scheffler_logo   = $this->media_default( 'Scheffler_logo-200x120.png' );
		$healthcare_logo  = $this->media_default( 'fekvo_logo.png' );

		return array(
			array(
				'_id'         => 'vclead1',
				'logo'        => $leader_logo,
				'logo_text'   => 'PSV',
				'type'        => esc_html__( 'Vezető partner', 'vitacenter-elementor-header' ),
				'name'        => esc_html__( 'Páli Szent Vincéről Nevezett Szatmári Irgalmas Nővérek Egyesülete', 'vitacenter-elementor-header' ),
				'description' => '',
				'featured'    => 'yes',
			),
			array(
				'_id'         => 'vcsche1',
				'logo'        => $scheffler_logo,
				'logo_text'   => 'BSJ',
				'type'        => esc_html__( 'Projektpartner', 'vitacenter-elementor-header' ),
				'name'        => esc_html__( 'Boldog Scheffler János Központ', 'vitacenter-elementor-header' ),
				'description' => '',
				'featured'    => '',
			),
			array(
				'_id'         => 'vchodm1',
				'logo'        => $healthcare_logo,
				'logo_text'   => 'HM',
				'type'        => esc_html__( 'Projektpartner', 'vitacenter-elementor-header' ),
				'name'        => esc_html__( 'Hódmezővásárhelyi-Makói Egészségellátó Központ', 'vitacenter-elementor-header' ),
				'description' => '',
				'featured'    => '',
			),
		);
	}

	private function leader_partner_logo() {
		return $this->media_default( 'Logo-Szatmari-Szent-Vincarol-nevezett-1030x159.png' );
	}

	private function partner_items_for_render( $saved_items ) {
		$default_partners = $this->default_partners();
		$defaults         = array(
			'leader'           => $default_partners[0],
			'scheffler'        => $default_partners[1],
			'hodmezovasarhely' => $default_partners[2],
		);
		$items            = array();
		$extra_items      = array();

		foreach ( $this->repeater_items( $saved_items ) as $item ) {
			$name = isset( $item['name'] ) ? $this->plain_text( $item['name'] ) : '';
			$key  = $this->partner_item_key( $item );

			if ( '' === $key || ! isset( $defaults[ $key ] ) ) {
				if ( '' !== $name ) {
					$extra_items[] = $item;
				}

				continue;
			}

			$merged   = array_merge( $defaults[ $key ], $item );
			$logo_url = $this->media_url( isset( $merged['logo'] ) ? $merged['logo'] : array() );

			if ( '' === $logo_url ) {
				$merged['logo'] = $defaults[ $key ]['logo'];
			}

			if ( ! isset( $merged['logo_text'] ) || '' === $this->plain_text( $merged['logo_text'] ) ) {
				$merged['logo_text'] = $defaults[ $key ]['logo_text'];
			}

			if ( ! isset( $merged['type'] ) || '' === $this->plain_text( $merged['type'] ) ) {
				$merged['type'] = $defaults[ $key ]['type'];
			}

			if ( ! isset( $merged['name'] ) || '' === $this->plain_text( $merged['name'] ) ) {
				$merged['name'] = $defaults[ $key ]['name'];
			}

			$items[ $key ] = $merged;
		}

		foreach ( $defaults as $key => $item ) {
			if ( ! isset( $items[ $key ] ) ) {
				$items[ $key ] = $item;
			}
		}

		return array_merge( array(
			$items['leader'],
			$items['scheffler'],
			$items['hodmezovasarhely'],
		), $extra_items );
	}

	private function partner_item_key( $item ) {
		if ( is_array( $item ) && isset( $item['_id'] ) ) {
			$id = $this->plain_text( $item['_id'] );

			if ( 'vclead1' === $id ) {
				return 'leader';
			}

			if ( 'vcsche1' === $id ) {
				return 'scheffler';
			}

			if ( 'vchodm1' === $id ) {
				return 'hodmezovasarhely';
			}
		}

		$name = is_array( $item ) && isset( $item['name'] ) ? $this->plain_text( $item['name'] ) : '';

		return $this->partner_key( $name );
	}

	private function normalize_partners( $items ) {
		$partners = array();

		foreach ( $this->repeater_items( $items ) as $item ) {
			$name = isset( $item['name'] ) ? $this->plain_text( $item['name'] ) : '';

			if ( '' === $name ) {
				continue;
			}

			$logo_url = $this->media_url( isset( $item['logo'] ) ? $item['logo'] : array() );

			$partners[] = array(
				'logo_url'    => $logo_url,
				'logo_text'   => isset( $item['logo_text'] ) && '' !== $this->plain_text( $item['logo_text'] ) ? $this->plain_text( $item['logo_text'] ) : $this->partner_initials( $name ),
				'type'        => isset( $item['type'] ) ? $this->plain_text( $item['type'] ) : '',
				'name'        => $name,
				'description' => isset( $item['description'] ) ? $this->plain_text( $item['description'] ) : '',
				'featured'    => 'leader' === $this->partner_item_key( $item ) || $this->is_leader_partner_name( $name ) || ( isset( $item['featured'] ) && 'yes' === $this->plain_text( $item['featured'] ) ),
			);
		}

		return $partners;
	}

	private function is_leader_partner_name( $name ) {
		$normalized = strtolower( remove_accents( $name ) );

		return false !== strpos( $normalized, 'pali szent vincerol' )
			|| false !== strpos( $normalized, 'szatmari irgalmas noverek' );
	}

	private function partner_key( $name ) {
		$normalized = strtolower( remove_accents( $name ) );

		if ( $this->is_leader_partner_name( $normalized ) ) {
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

	private function render_partner_card( $partner ) {
		$classes = 'efi-partner-card';

		if ( ! empty( $partner['featured'] ) ) {
			$classes .= ' efi-partner-card--featured';
		}
		?>
		<article class="<?php echo esc_attr( $classes ); ?>">
			<div class="efi-partner-logo">
				<?php if ( ! empty( $partner['logo_url'] ) ) : ?>
					<img src="<?php echo esc_url( $partner['logo_url'] ); ?>" alt="<?php echo esc_attr( $partner['name'] ); ?>">
				<?php else : ?>
					<span><?php echo esc_html( $partner['logo_text'] ); ?></span>
				<?php endif; ?>
			</div>
			<div class="efi-partner-card__body">
				<?php if ( '' !== $partner['type'] ) : ?><span class="efi-partner-type"><?php echo esc_html( $partner['type'] ); ?></span><?php endif; ?>
				<h2><?php echo esc_html( $partner['name'] ); ?></h2>
				<?php if ( '' !== $partner['description'] ) : ?><p><?php echo esc_html( $partner['description'] ); ?></p><?php endif; ?>
			</div>
		</article>
		<?php
	}

	private function partner_initials( $name ) {
		$words = preg_split( '/\s+/', remove_accents( $name ) );
		$letters = '';

		foreach ( $words as $word ) {
			if ( '' === $word ) {
				continue;
			}

			$letters .= strtoupper( substr( $word, 0, 1 ) );

			if ( 3 <= strlen( $letters ) ) {
				break;
			}
		}

		return $letters ? $letters : 'P';
	}
}

class VitaCenter_Contact_Widget extends VitaCenter_Structured_Widget_Base {
	public function get_name() { return 'vitacenter_contact'; }
	public function get_title() { return esc_html__( 'VitaCenter Contact', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-mail'; }
	public function get_style_depends() { return array( 'vc-landing' ); }
	public function get_script_depends() { return array( 'vc-landing' ); }

	protected function register_controls() {
		$this->start_controls_section( 'hero_section', array( 'label' => esc_html__( 'Hero', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => esc_html__( 'Kis címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kapcsolat', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Lépjen kapcsolatba velünk', 'vitacenter-elementor-header' ), 'label_block' => true ) );
		$this->add_control( 'intro', array( 'label' => esc_html__( 'Bevezető', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Kérdése van programjainkkal, szűréseinkkel vagy tanácsadási lehetőségeinkkel kapcsolatban? Keressen minket bizalommal, munkatársaink készséggel állnak rendelkezésére.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'hero_card_title', array( 'label' => esc_html__( 'Kiemelt kártya cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Egészsége nem várhat.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'hero_card_text', array( 'label' => esc_html__( 'Kiemelt kártya szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Foglaljon időpontot, érdeklődjön programjainkról, vagy kérjen további tájékoztatást.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'call_button_text', array( 'label' => esc_html__( 'Telefon gomb', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Telefonhívás indítása', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'contact_section', array( 'label' => esc_html__( 'Elérhetőségek', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'phone', array( 'label' => esc_html__( 'Telefon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '+40 261 713 775' ) );
		$this->add_control( 'email', array( 'label' => esc_html__( 'E-mail', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => 'efi@szatmar.ro' ) );
		$this->add_control( 'address', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Szatmárnémeti, Vasile Lucaciu u. 21.', 'vitacenter-elementor-header' ), 'label_block' => true ) );
		$this->add_control( 'map_link', array( 'label' => esc_html__( 'Térkép link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => 'https://www.google.com/maps/search/?api=1&query=Szatm%C3%A1rn%C3%A9meti%2C%20Vasile%20Lucaciu%20u.%2021', 'is_external' => true ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'form_section', array( 'label' => esc_html__( 'Űrlap', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'form_eyebrow', array( 'label' => esc_html__( 'Űrlap címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Írjon nekünk', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'form_title', array( 'label' => esc_html__( 'Űrlap cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kapcsolatfelvételi űrlap', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'form_intro', array( 'label' => esc_html__( 'Űrlap szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Töltse ki az alábbi mezőket, és hamarosan felvesszük Önnel a kapcsolatot.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'form_shortcode', array( 'label' => esc_html__( 'Űrlap shortcode', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => '', 'description' => esc_html__( 'Ha kitöltöd, a beépített statikus űrlap helyett ez jelenik meg.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'form_action', array( 'label' => esc_html__( 'Statikus űrlap action', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '#' ) );
		$this->add_control( 'submit_text', array( 'label' => esc_html__( 'Küldés gomb', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Üzenet küldése', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'side_section', array( 'label' => esc_html__( 'Oldalsáv', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'hours_label', array( 'label' => esc_html__( 'Időpont kártya címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Ügyfélfogadás', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'hours_title', array( 'label' => esc_html__( 'Időpont kártya cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Egyeztessen időpontot!', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'appointment_text', array( 'label' => esc_html__( 'Időpont kártya szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A programokon és tanácsadásokon való részvételhez kérjük, egyeztessen időpontot telefonon vagy e-mailben.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'appointment_button_text', array( 'label' => esc_html__( 'Időpont gomb', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kapcsolatfelvétel', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'appointment_link', array( 'label' => esc_html__( 'Időpont gomb link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '' ) ) );
		$this->add_control( 'map_label', array( 'label' => esc_html__( 'Megközelítés címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Megközelítés', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'map_title', array( 'label' => esc_html__( 'Megközelítés cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Hol talál minket?', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'map_text', array( 'label' => esc_html__( 'Megközelítés szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Szatmárnémeti központi részén, a Vasile Lucaciu utcában várjuk az érdeklődőket.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'map_button_text', array( 'label' => esc_html__( 'Térkép gomb', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Megnyitás térképen', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'directions_text', array( 'label' => esc_html__( 'Útvonal gomb', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Útvonaltervezés', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = wp_parse_args(
			$this->get_settings_for_display(),
			$this->default_contact_settings()
		);

		$phone_href = $this->contact_phone_href( $s['phone'] );
		$email_href = $this->contact_email_href( $s['email'] );
		$appointment_title = $this->plain_text( $s['hours_title'] );
		$appointment_title = ( '' === $appointment_title || esc_html__( 'Nyitvatartás', 'vitacenter-elementor-header' ) === $appointment_title ) ? esc_html__( 'Egyeztessen időpontot!', 'vitacenter-elementor-header' ) : $appointment_title;
		$appointment_link  = is_array( $s['appointment_link'] ) ? $s['appointment_link'] : array( 'url' => $this->plain_text( $s['appointment_link'] ) );

		if ( empty( $appointment_link['url'] ) && '' !== $phone_href ) {
			$appointment_link['url'] = $phone_href;
		}
		?>
		<div class="vc-landing">
			<section class="efi-contact-page" aria-label="<?php echo esc_attr__( 'Kapcsolat oldal', 'vitacenter-elementor-header' ); ?>">
				<div class="efi-contact-hero">
					<div class="efi-contact-hero__content">
						<?php if ( '' !== $this->plain_text( $s['eyebrow'] ) ) : ?><span class="efi-contact-eyebrow"><?php echo esc_html( $this->plain_text( $s['eyebrow'] ) ); ?></span><?php endif; ?>
						<h1><?php echo esc_html( $this->plain_text( $s['title'] ) ); ?></h1>
						<?php if ( '' !== $this->plain_text( $s['intro'] ) ) : ?><p><?php echo esc_html( $this->plain_text( $s['intro'] ) ); ?></p><?php endif; ?>
					</div>

					<div class="efi-contact-hero__card" aria-label="<?php echo esc_attr__( 'Gyors elérhetőség', 'vitacenter-elementor-header' ); ?>">
						<div class="efi-contact-pulse" aria-hidden="true"><?php $this->render_contact_pulse_icon(); ?></div>
						<h2><?php echo esc_html( $this->plain_text( $s['hero_card_title'] ) ); ?></h2>
						<?php if ( '' !== $this->plain_text( $s['hero_card_text'] ) ) : ?><p><?php echo esc_html( $this->plain_text( $s['hero_card_text'] ) ); ?></p><?php endif; ?>
						<?php if ( '' !== $phone_href && '' !== $this->plain_text( $s['call_button_text'] ) ) : ?><a href="<?php echo esc_url( $phone_href ); ?>" class="efi-contact-hero__button"><?php echo esc_html( $this->plain_text( $s['call_button_text'] ) ); ?></a><?php endif; ?>
					</div>
				</div>

				<div class="efi-contact-info-grid">
					<?php $this->render_contact_info_card( 'phone', esc_html__( 'Telefon', 'vitacenter-elementor-header' ), $s['phone'], $phone_href ); ?>
					<?php $this->render_contact_info_card( 'mail', esc_html__( 'E-mail', 'vitacenter-elementor-header' ), $s['email'], $email_href ); ?>
					<?php $this->render_contact_info_card( 'pin', esc_html__( 'Cím', 'vitacenter-elementor-header' ), $s['address'] ); ?>
				</div>

				<div class="efi-contact-main-grid">
					<div class="efi-contact-form-card">
						<div class="efi-contact-section-heading">
							<?php if ( '' !== $this->plain_text( $s['form_eyebrow'] ) ) : ?><span><?php echo esc_html( $this->plain_text( $s['form_eyebrow'] ) ); ?></span><?php endif; ?>
							<h2><?php echo esc_html( $this->plain_text( $s['form_title'] ) ); ?></h2>
							<?php if ( '' !== $this->plain_text( $s['form_intro'] ) ) : ?><p><?php echo esc_html( $this->plain_text( $s['form_intro'] ) ); ?></p><?php endif; ?>
						</div>
						<?php $this->render_contact_form( $s ); ?>
					</div>

					<aside class="efi-contact-side">
						<div class="efi-contact-side-card efi-contact-side-card--hours efi-contact-side-card--appointment">
							<?php if ( '' !== $this->plain_text( $s['hours_label'] ) ) : ?><span class="efi-contact-side-card__label"><?php echo esc_html( $this->plain_text( $s['hours_label'] ) ); ?></span><?php endif; ?>
							<h3><?php echo esc_html( $appointment_title ); ?></h3>
							<?php if ( '' !== $this->plain_text( $s['appointment_text'] ) ) : ?><p><?php echo esc_html( $this->plain_text( $s['appointment_text'] ) ); ?></p><?php endif; ?>
							<?php $this->render_contact_link( $s['appointment_button_text'], $appointment_link, 'efi-map-link' ); ?>
						</div>

						<div class="efi-contact-side-card">
							<?php if ( '' !== $this->plain_text( $s['map_label'] ) ) : ?><span class="efi-contact-side-card__label"><?php echo esc_html( $this->plain_text( $s['map_label'] ) ); ?></span><?php endif; ?>
							<h3><?php echo esc_html( $this->plain_text( $s['map_title'] ) ); ?></h3>
							<?php if ( '' !== $this->plain_text( $s['map_text'] ) ) : ?><p><?php echo esc_html( $this->plain_text( $s['map_text'] ) ); ?></p><?php endif; ?>
							<?php $this->render_contact_link( $s['map_button_text'], $s['map_link'], 'efi-map-link' ); ?>
						</div>
					</aside>
				</div>

				<div class="efi-contact-map" aria-label="<?php echo esc_attr__( 'Térkép helye', 'vitacenter-elementor-header' ); ?>">
					<div class="efi-contact-map__overlay">
						<span><?php echo esc_html__( 'Cím', 'vitacenter-elementor-header' ); ?></span>
						<strong><?php echo esc_html( $this->plain_text( $s['address'] ) ); ?></strong>
						<?php $this->render_contact_link( $s['directions_text'], $s['map_link'], '' ); ?>
					</div>
				</div>
			</section>
		</div>
		<?php
	}

	private function default_contact_settings() {
		return array(
			'eyebrow'          => esc_html__( 'Kapcsolat', 'vitacenter-elementor-header' ),
			'title'            => esc_html__( 'Lépjen kapcsolatba velünk', 'vitacenter-elementor-header' ),
			'intro'            => esc_html__( 'Kérdése van programjainkkal, szűréseinkkel vagy tanácsadási lehetőségeinkkel kapcsolatban? Keressen minket bizalommal, munkatársaink készséggel állnak rendelkezésére.', 'vitacenter-elementor-header' ),
			'hero_card_title'  => esc_html__( 'Egészsége nem várhat.', 'vitacenter-elementor-header' ),
			'hero_card_text'   => esc_html__( 'Foglaljon időpontot, érdeklődjön programjainkról, vagy kérjen további tájékoztatást.', 'vitacenter-elementor-header' ),
			'call_button_text' => esc_html__( 'Telefonhívás indítása', 'vitacenter-elementor-header' ),
			'phone'            => '+40 261 713 775',
			'email'            => 'efi@szatmar.ro',
			'address'          => esc_html__( 'Szatmárnémeti, Vasile Lucaciu u. 21.', 'vitacenter-elementor-header' ),
			'map_link'         => array( 'url' => 'https://www.google.com/maps/search/?api=1&query=Szatm%C3%A1rn%C3%A9meti%2C%20Vasile%20Lucaciu%20u.%2021', 'is_external' => true ),
			'form_eyebrow'     => esc_html__( 'Írjon nekünk', 'vitacenter-elementor-header' ),
			'form_title'       => esc_html__( 'Kapcsolatfelvételi űrlap', 'vitacenter-elementor-header' ),
			'form_intro'       => esc_html__( 'Töltse ki az alábbi mezőket, és hamarosan felvesszük Önnel a kapcsolatot.', 'vitacenter-elementor-header' ),
			'form_shortcode'   => '',
			'form_action'      => '#',
			'submit_text'      => esc_html__( 'Üzenet küldése', 'vitacenter-elementor-header' ),
			'hours_label'      => esc_html__( 'Ügyfélfogadás', 'vitacenter-elementor-header' ),
			'hours_title'      => esc_html__( 'Egyeztessen időpontot!', 'vitacenter-elementor-header' ),
			'appointment_text' => esc_html__( 'A programokon és tanácsadásokon való részvételhez kérjük, egyeztessen időpontot telefonon vagy e-mailben.', 'vitacenter-elementor-header' ),
			'appointment_button_text' => esc_html__( 'Kapcsolatfelvétel', 'vitacenter-elementor-header' ),
			'appointment_link' => array( 'url' => '' ),
			'weekday_hours'    => '8:00 - 16:00',
			'saturday_hours'   => esc_html__( 'Zárva', 'vitacenter-elementor-header' ),
			'sunday_hours'     => esc_html__( 'Zárva', 'vitacenter-elementor-header' ),
			'map_label'        => esc_html__( 'Megközelítés', 'vitacenter-elementor-header' ),
			'map_title'        => esc_html__( 'Hol talál minket?', 'vitacenter-elementor-header' ),
			'map_text'         => esc_html__( 'Szatmárnémeti központi részén, a Vasile Lucaciu utcában várjuk az érdeklődőket.', 'vitacenter-elementor-header' ),
			'map_button_text'  => esc_html__( 'Megnyitás térképen', 'vitacenter-elementor-header' ),
			'directions_text'  => esc_html__( 'Útvonaltervezés', 'vitacenter-elementor-header' ),
		);
	}

	private function render_contact_info_card( $type, $label, $value, $href = '' ) {
		$value = $this->plain_text( $value );
		$href  = $this->plain_text( $href );

		if ( '' === $value ) {
			return;
		}
		?>
		<article class="efi-contact-info-card">
			<span class="efi-contact-info-card__icon" aria-hidden="true"><?php $this->render_contact_icon( $type ); ?></span>
			<div>
				<h3><?php echo esc_html( $label ); ?></h3>
				<p><?php if ( '' !== $href ) : ?><a href="<?php echo esc_url( $href ); ?>"><?php echo esc_html( $value ); ?></a><?php else : ?><?php echo esc_html( $value ); ?><?php endif; ?></p>
			</div>
		</article>
		<?php
	}

	private function render_contact_form( $settings ) {
		$shortcode = $this->plain_text( $settings['form_shortcode'] );

		if ( '' !== $shortcode && function_exists( 'do_shortcode' ) ) {
			echo '<div class="efi-contact-form-shortcode">' . do_shortcode( $shortcode ) . '</div>';
			return;
		}
		?>
		<form class="efi-contact-form" action="<?php echo esc_url( $this->plain_text( $settings['form_action'] ) ); ?>" method="post">
			<div class="efi-form-row">
				<label><span><?php echo esc_html__( 'Név', 'vitacenter-elementor-header' ); ?></span><input type="text" name="name" placeholder="<?php echo esc_attr__( 'Teljes név', 'vitacenter-elementor-header' ); ?>" required></label>
				<label><span><?php echo esc_html__( 'E-mail', 'vitacenter-elementor-header' ); ?></span><input type="email" name="email" placeholder="email@pelda.ro" required></label>
			</div>
			<div class="efi-form-row">
				<label><span><?php echo esc_html__( 'Telefon', 'vitacenter-elementor-header' ); ?></span><input type="tel" name="phone" placeholder="+40 ..."></label>
				<label><span><?php echo esc_html__( 'Téma', 'vitacenter-elementor-header' ); ?></span><select name="topic"><option value=""><?php echo esc_html__( 'Válasszon témát', 'vitacenter-elementor-header' ); ?></option><option><?php echo esc_html__( 'Programok', 'vitacenter-elementor-header' ); ?></option><option><?php echo esc_html__( 'Időpontfoglalás', 'vitacenter-elementor-header' ); ?></option><option><?php echo esc_html__( 'Szűrővizsgálatok', 'vitacenter-elementor-header' ); ?></option><option><?php echo esc_html__( 'Tanácsadás', 'vitacenter-elementor-header' ); ?></option><option><?php echo esc_html__( 'Egyéb kérdés', 'vitacenter-elementor-header' ); ?></option></select></label>
			</div>
			<label><span><?php echo esc_html__( 'Üzenet', 'vitacenter-elementor-header' ); ?></span><textarea name="message" rows="6" placeholder="<?php echo esc_attr__( 'Írja meg kérdését vagy üzenetét...', 'vitacenter-elementor-header' ); ?>" required></textarea></label>
			<button type="submit" class="efi-contact-submit"><span><?php echo esc_html( $this->plain_text( $settings['submit_text'] ) ); ?></span><span aria-hidden="true">&#8594;</span></button>
		</form>
		<?php
	}

	private function render_contact_link( $text, $link, $class = '' ) {
		$text = $this->plain_text( $text );

		if ( '' === $text ) {
			return;
		}
		?>
		<a <?php if ( '' !== $class ) : ?>class="<?php echo esc_attr( $class ); ?>"<?php endif; ?> <?php echo $this->url_attributes( $link ); ?>><?php echo esc_html( $text ); ?></a>
		<?php
	}

	private function render_contact_pulse_icon() {
		?>
		<svg viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg">
			<defs>
				<linearGradient id="efiContactIconGradient" x1="14" y1="12" x2="84" y2="86" gradientUnits="userSpaceOnUse">
					<stop offset="0%" stop-color="#4FC3EA"/>
					<stop offset="100%" stop-color="#1266B3"/>
				</linearGradient>
			</defs>
			<circle cx="48" cy="48" r="45" fill="url(#efiContactIconGradient)"/>
			<path d="M31 50h10l5-13 8 25 5-12h8" fill="none" stroke="#fff" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M35 34c3.5-5 11-5 13 1 2-6 9.5-6 13-1 5.5 8.5-5 19-13 25-8-6-18.5-16.5-13-25Z" fill="none" stroke="#fff" stroke-width="4" stroke-linejoin="round" opacity="0.92"/>
		</svg>
		<?php
	}

	private function render_contact_icon( $type ) {
		if ( 'mail' === $type ) :
			?>
			<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M4 6.5h16v11H4v-11Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
				<path d="m4.5 7 7.5 6 7.5-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
			<?php
			return;
		endif;

		if ( 'pin' === $type ) :
			?>
			<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M12 21s7-6.14 7-12a7 7 0 1 0-14 0c0 5.86 7 12 7 12Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
				<circle cx="12" cy="9" r="2.5" stroke="currentColor" stroke-width="1.8"/>
			</svg>
			<?php
			return;
		endif;
		?>
		<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M6.62 10.79c1.44 2.83 3.76 5.13 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1C10.61 21 3 13.39 3 4c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.24.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>
		<?php
	}

	private function contact_phone_href( $phone ) {
		$normalized = preg_replace( '/[^0-9+]/', '', $this->plain_text( $phone ) );

		return $normalized ? 'tel:' . $normalized : '';
	}

	private function contact_email_href( $email ) {
		$email = sanitize_email( $this->plain_text( $email ) );

		return is_email( $email ) ? 'mailto:' . $email : '';
	}
}

class VitaCenter_Landing_Contact_Widget extends VitaCenter_Structured_Widget_Base {
	public function get_name() { return 'vitacenter_landing_contact_footer'; }
	public function get_title() { return esc_html__( 'VitaCenter Contact/Footer', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-footer'; }
	public function get_style_depends() { return array( 'vc-landing' ); }
	public function get_script_depends() { return array( 'vc-landing' ); }

	protected function register_controls() {
		$this->start_controls_section( 'contact_section', array( 'label' => esc_html__( 'Kapcsolat', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'show_notice', array( 'label' => esc_html__( 'EU nyilatkozat mutatása', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$this->add_control( 'notice_text', array( 'label' => esc_html__( 'Nyilatkozat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Jelen weboldal tartalma nem feltétlenül tükrözi az Európai Unió hivatalos álláspontját.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'phone', array( 'label' => esc_html__( 'Telefon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '+40 261 713 775' ) );
		$this->add_control( 'email', array( 'label' => esc_html__( 'E-mail', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => 'efi@szatmar.ro' ) );
		$this->add_control( 'address', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Szatmárnémeti, Vasile Lucaciu u. 21.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'button_text', array( 'label' => esc_html__( 'Extra link felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '' ) );
		$this->add_control( 'button_link', array( 'label' => esc_html__( 'Extra link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#kapcsolat' ) ) );
		$this->add_control( 'show_compact_footer', array( 'label' => esc_html__( 'Alsó sor mutatása', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$this->add_control( 'copyright', array( 'label' => esc_html__( 'Copyright', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( '© 2025 Egészségfejlesztési Iroda – Szatmár megye', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'project', array( 'label' => esc_html__( 'Projekt sor', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'IPOP ROHU00259 – Interreg VI-A Románia-Magyarország Program', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'website_text', array( 'label' => esc_html__( 'Honlap felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => 'www.interreg-rohu.eu' ) );
		$this->add_control( 'website_link', array( 'label' => esc_html__( 'Honlap link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => 'https://interreg-rohu.eu' ) ) );
		$this->add_control( 'privacy_text', array( 'label' => esc_html__( 'Adatvédelem felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Adatvédelem', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'privacy_link', array( 'label' => esc_html__( 'Adatvédelem link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '/adatvedelem' ) ) );
		$this->add_control( 'imprint_text', array( 'label' => esc_html__( 'Impresszum felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Impresszum', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'imprint_link', array( 'label' => esc_html__( 'Impresszum link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '/impresszum' ) ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = wp_parse_args(
			$this->get_settings_for_display(),
			array(
				'show_notice'  => 'yes',
				'notice_text'  => esc_html__( 'Jelen weboldal tartalma nem feltétlenül tükrözi az Európai Unió hivatalos álláspontját.', 'vitacenter-elementor-header' ),
				'phone'        => '+40 261 713 775',
				'email'        => 'efi@szatmar.ro',
				'address'      => esc_html__( 'Szatmárnémeti, Vasile Lucaciu u. 21.', 'vitacenter-elementor-header' ),
				'button_text'  => '',
				'button_link'  => array( 'url' => '#kapcsolat' ),
				'show_compact_footer' => 'yes',
				'copyright'    => esc_html__( '© 2025 Egészségfejlesztési Iroda – Szatmár megye', 'vitacenter-elementor-header' ),
				'project'      => esc_html__( 'IPOP ROHU00259 – Interreg VI-A Románia-Magyarország Program', 'vitacenter-elementor-header' ),
				'website_text' => 'www.interreg-rohu.eu',
				'website_link' => array( 'url' => 'https://interreg-rohu.eu' ),
				'privacy_text' => esc_html__( 'Adatvédelem', 'vitacenter-elementor-header' ),
				'privacy_link' => array( 'url' => '/adatvedelem' ),
				'imprint_text' => esc_html__( 'Impresszum', 'vitacenter-elementor-header' ),
				'imprint_link' => array( 'url' => '/impresszum' ),
			)
		);
		?>
		<div class="vc-landing">
			<footer id="kapcsolat" class="efi-footer" aria-label="<?php echo esc_attr__( 'Oldal lábléc', 'vitacenter-elementor-header' ); ?>">
				<?php if ( 'yes' === $this->plain_text( $s['show_notice'] ) && '' !== $this->plain_text( $s['notice_text'] ) ) : ?>
					<div class="efi-footer__notice">
						<div class="efi-footer__inner">
							<p><?php echo esc_html( $this->plain_text( $s['notice_text'] ) ); ?></p>
						</div>
					</div>
				<?php endif; ?>

				<div class="efi-footer__bar">
					<div class="efi-footer__inner efi-footer__bar-inner">
						<?php $this->render_efi_footer_bottom( $s ); ?>
						<div class="efi-footer__contacts" aria-label="<?php echo esc_attr__( 'Kapcsolati információk', 'vitacenter-elementor-header' ); ?>">
							<?php $this->render_efi_contact_item( 'pin', esc_html__( 'Cím', 'vitacenter-elementor-header' ), $s['address'] ); ?>
							<?php $this->render_efi_contact_item( 'phone', esc_html__( 'Telefon', 'vitacenter-elementor-header' ), $s['phone'], $this->efi_phone_href( $s['phone'] ) ); ?>
							<?php $this->render_efi_contact_item( 'mail', esc_html__( 'E-mail', 'vitacenter-elementor-header' ), $s['email'], $this->efi_email_href( $s['email'] ) ); ?>
						</div>
					</div>
				</div>
			</footer>
		</div>
		<?php
	}

	private function render_efi_contact_item( $type, $label, $value, $href = '' ) {
		$label = $this->plain_text( $label );
		$value = $this->plain_text( $value );
		$href  = $this->plain_text( $href );

		if ( '' === $value ) {
			return;
		}
		?>
		<div class="efi-footer-contact__item efi-footer-contact__item--<?php echo esc_attr( $type ); ?>">
			<span class="efi-footer-contact__icon" aria-hidden="true"><?php $this->render_efi_footer_icon( $type ); ?></span>
			<div class="efi-footer-contact__text">
				<span class="screen-reader-text"><?php echo esc_html( $label ); ?></span>
				<strong>
					<?php if ( '' !== $href ) : ?>
						<a href="<?php echo esc_url( $href ); ?>"><?php echo esc_html( $value ); ?></a>
					<?php else : ?>
						<?php echo esc_html( $value ); ?>
					<?php endif; ?>
				</strong>
			</div>
		</div>
		<?php
	}

	private function render_efi_footer_icon( $type ) {
		if ( 'mail' === $type ) :
			?>
			<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M4 6.5h16v11H4v-11Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
				<path d="m4.5 7 7.5 6 7.5-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
			<?php
			return;
		endif;

		if ( 'pin' === $type ) :
			?>
			<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M12 21s7-6.14 7-12a7 7 0 1 0-14 0c0 5.86 7 12 7 12Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
				<circle cx="12" cy="9" r="2.5" stroke="currentColor" stroke-width="1.8"/>
			</svg>
			<?php
			return;
		endif;
		?>
		<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M6.62 10.79c1.44 2.83 3.76 5.13 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1C10.61 21 3 13.39 3 4c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.24.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>
		<?php
	}

	private function render_efi_footer_bottom( $settings ) {
		if ( 'yes' !== $this->plain_text( $settings['show_compact_footer'] ) ) {
			return;
		}

		$copyright   = $this->plain_text( $settings['copyright'] );
		$project     = $this->plain_text( $settings['project'] );
		$website     = $this->plain_text( $settings['website_text'] );
		$has_website = '' !== $website;
		?>
		<div class="efi-footer-bottom">
			<?php if ( '' !== $copyright || $has_website ) : ?>
				<p class="efi-footer-bottom__copyright">
					<?php if ( '' !== $copyright ) : ?><span><?php echo esc_html( $copyright ); ?></span><?php endif; ?>
					<?php if ( $has_website ) : ?><a <?php echo $this->url_attributes( $settings['website_link'] ); ?>><?php echo esc_html( $website ); ?></a><?php endif; ?>
				</p>
			<?php endif; ?>
			<?php if ( '' !== $project ) : ?><p class="efi-footer-bottom__project"><?php echo esc_html( $project ); ?></p><?php endif; ?>
			<nav class="efi-footer-bottom__links" aria-label="<?php echo esc_attr__( 'Lábléc linkek', 'vitacenter-elementor-header' ); ?>">
				<?php $this->render_efi_footer_link( $settings['button_text'], $settings['button_link'] ); ?>
				<?php $this->render_efi_footer_link( $settings['privacy_text'], $settings['privacy_link'] ); ?>
				<?php $this->render_efi_footer_link( $settings['imprint_text'], $settings['imprint_link'] ); ?>
			</nav>
		</div>
		<?php
	}

	private function render_efi_footer_link( $text, $link ) {
		$text = $this->plain_text( $text );

		if ( '' === $text ) {
			return;
		}
		?>
		<a <?php echo $this->url_attributes( $link ); ?>><?php echo esc_html( $text ); ?></a>
		<?php
	}

	private function efi_phone_href( $phone ) {
		$normalized = preg_replace( '/[^0-9+]/', '', $this->plain_text( $phone ) );

		return $normalized ? 'tel:' . $normalized : '';
	}

	private function efi_email_href( $email ) {
		$email = sanitize_email( $this->plain_text( $email ) );

		return is_email( $email ) ? 'mailto:' . $email : '';
	}
}

class VitaCenter_Legal_Footer_Widget extends VitaCenter_Structured_Widget_Base {
	public function get_name() { return 'vitacenter_legal_footer'; }
	public function get_title() { return esc_html__( 'VitaCenter Legal Footer', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-footer'; }
	public function get_style_depends() { return array( 'vc-landing' ); }

	protected function register_controls() {
		$this->start_controls_section( 'content_section', array( 'label' => esc_html__( 'Footer tartalom', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'show_notice', array( 'label' => esc_html__( 'EU nyilatkozat mutatása', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );
		$this->add_control( 'notice_text', array( 'label' => esc_html__( 'Nyilatkozat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Jelen weboldal tartalma nem feltétlenül tükrözi az Európai Unió hivatalos álláspontját.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'copyright', array( 'label' => esc_html__( 'Copyright', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( '© 2025 Egészségfejlesztési Iroda - Szatmár megye', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'project', array( 'label' => esc_html__( 'Projekt sor', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'IPOP ROHU00259 - Interreg VI-A Románia-Magyarország Program', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'website_text', array( 'label' => esc_html__( 'Honlap felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => 'www.interreg-rohu.eu' ) );
		$this->add_control( 'website_link', array( 'label' => esc_html__( 'Honlap link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => 'https://interreg-rohu.eu' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'contact_section', array( 'label' => esc_html__( 'Elérhetőségek', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'address_label', array( 'label' => esc_html__( 'Címke - cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Cím', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'address', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Szatmárnémeti, Vasile Lucaciu u. 21.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'address_link', array( 'label' => esc_html__( 'Cím link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL ) );
		$this->add_control( 'phone_label', array( 'label' => esc_html__( 'Címke - telefon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Telefon', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'phone', array( 'label' => esc_html__( 'Telefon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '+40 261 713 775' ) );
		$this->add_control( 'email_label', array( 'label' => esc_html__( 'Címke - e-mail', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'E-mail', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'email', array( 'label' => esc_html__( 'E-mail', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => 'efi@szatmar.ro' ) );
		$this->end_controls_section();

		$this->start_controls_section( 'style_section', array( 'label' => esc_html__( 'Stílus', 'vitacenter-elementor-header' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_control( 'notice_background', array( 'label' => esc_html__( 'Felső sáv háttér', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::COLOR, 'default' => '#ffffff', 'selectors' => array( '{{WRAPPER}} .vc-footer' => '--vc-footer-notice-bg: {{VALUE}};' ) ) );
		$this->add_control( 'notice_color', array( 'label' => esc_html__( 'Felső sáv szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::COLOR, 'default' => '#2c4248', 'selectors' => array( '{{WRAPPER}} .vc-footer' => '--vc-footer-notice-color: {{VALUE}};' ) ) );
		$this->add_control( 'bar_background', array( 'label' => esc_html__( 'Alsó sáv háttér', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::COLOR, 'default' => '#064b50', 'selectors' => array( '{{WRAPPER}} .vc-footer' => '--vc-footer-bar-bg: {{VALUE}};' ) ) );
		$this->add_control( 'accent_color', array( 'label' => esc_html__( 'Akcentus', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::COLOR, 'default' => '#58c4d8', 'selectors' => array( '{{WRAPPER}} .vc-footer' => '--vc-footer-accent: {{VALUE}};' ) ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = wp_parse_args(
			$this->get_settings_for_display(),
			array(
				'show_notice'   => 'yes',
				'notice_text'   => esc_html__( 'Jelen weboldal tartalma nem feltétlenül tükrözi az Európai Unió hivatalos álláspontját.', 'vitacenter-elementor-header' ),
				'copyright'     => esc_html__( '© 2025 Egészségfejlesztési Iroda - Szatmár megye', 'vitacenter-elementor-header' ),
				'project'       => esc_html__( 'IPOP ROHU00259 - Interreg VI-A Románia-Magyarország Program', 'vitacenter-elementor-header' ),
				'website_text'  => 'www.interreg-rohu.eu',
				'website_link'  => array( 'url' => 'https://interreg-rohu.eu' ),
				'address_label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ),
				'address'       => esc_html__( 'Szatmárnémeti, Vasile Lucaciu u. 21.', 'vitacenter-elementor-header' ),
				'address_link'  => array( 'url' => '' ),
				'phone_label'   => esc_html__( 'Telefon', 'vitacenter-elementor-header' ),
				'phone'         => '+40 261 713 775',
				'email_label'   => esc_html__( 'E-mail', 'vitacenter-elementor-header' ),
				'email'         => 'efi@szatmar.ro',
			)
		);

		$notice_text  = $this->plain_text( $s['notice_text'] );
		$copyright    = $this->plain_text( $s['copyright'] );
		$project      = $this->plain_text( $s['project'] );
		$website_text = $this->plain_text( $s['website_text'] );
		$address_link = is_array( $s['address_link'] ) && isset( $s['address_link']['url'] ) ? $this->plain_text( $s['address_link']['url'] ) : '';
		?>
		<footer class="vc-footer" role="contentinfo">
			<?php if ( 'yes' === $this->plain_text( $s['show_notice'] ) && '' !== $notice_text ) : ?>
				<div class="vc-footer__notice">
					<div class="vc-footer__container">
						<p><?php echo esc_html( $notice_text ); ?></p>
					</div>
				</div>
			<?php endif; ?>

			<div class="vc-footer__bar">
				<div class="vc-footer__container vc-footer__bar-inner">
					<div class="vc-footer__meta">
						<div class="vc-footer__copyright">
							<?php if ( '' !== $copyright ) : ?><span><?php echo esc_html( $copyright ); ?></span><?php endif; ?>
							<?php if ( '' !== $website_text ) : ?><a <?php echo $this->url_attributes( $s['website_link'] ); ?>><?php echo esc_html( $website_text ); ?></a><?php endif; ?>
						</div>
						<?php if ( '' !== $project ) : ?><p><?php echo esc_html( $project ); ?></p><?php endif; ?>
					</div>

					<div class="vc-footer__contacts" aria-label="<?php echo esc_attr__( 'Footer elérhetőségek', 'vitacenter-elementor-header' ); ?>">
						<?php $this->render_footer_contact( 'address', $s['address_label'], $s['address'], $address_link ); ?>
						<?php $this->render_footer_contact( 'phone', $s['phone_label'], $s['phone'], $this->phone_href( $s['phone'] ) ); ?>
						<?php $this->render_footer_contact( 'email', $s['email_label'], $s['email'], $this->email_href( $s['email'] ) ); ?>
					</div>
				</div>
			</div>
		</footer>
		<?php
	}

	private function render_footer_contact( $type, $label, $value, $href = '' ) {
		$label = $this->plain_text( $label );
		$value = $this->plain_text( $value );
		$href  = $this->plain_text( $href );

		if ( '' === $value ) {
			return;
		}

		if ( $href ) :
			?>
			<a class="vc-footer__contact vc-footer__contact--<?php echo esc_attr( $type ); ?>" href="<?php echo esc_url( $href ); ?>">
				<?php $this->render_footer_contact_inner( $label, $value ); ?>
			</a>
			<?php
		else :
			?>
			<span class="vc-footer__contact vc-footer__contact--<?php echo esc_attr( $type ); ?>">
				<?php $this->render_footer_contact_inner( $label, $value ); ?>
			</span>
			<?php
		endif;
	}

	private function render_footer_contact_inner( $label, $value ) {
		?>
		<span class="vc-footer__icon" aria-hidden="true"></span>
		<span>
			<?php if ( '' !== $label ) : ?><small><?php echo esc_html( $label ); ?></small><?php endif; ?>
			<strong><?php echo esc_html( $value ); ?></strong>
		</span>
		<?php
	}

	private function phone_href( $phone ) {
		$normalized = preg_replace( '/[^0-9+]/', '', $this->plain_text( $phone ) );

		return $normalized ? 'tel:' . $normalized : '';
	}

	private function email_href( $email ) {
		$email = sanitize_email( $this->plain_text( $email ) );

		return is_email( $email ) ? 'mailto:' . $email : '';
	}
}
