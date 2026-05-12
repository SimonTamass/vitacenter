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
		return VC_ELEMENTOR_HEADER_URL . 'source/' . rawurlencode( $file_name );
	}

	protected function media_default( $file_name ) {
		return array( 'url' => $this->source_asset_url( $file_name ) );
	}

	protected function media_url( $media, $fallback_file = '' ) {
		if ( ! empty( $media['url'] ) ) {
			return $media['url'];
		}

		return $fallback_file ? $this->source_asset_url( $fallback_file ) : '';
	}

	protected function url_attributes( $url_control ) {
		$url = isset( $url_control['url'] ) && '' !== $url_control['url'] ? $url_control['url'] : '#';
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
		return nl2br( esc_html( $text ) );
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
		$this->add_control( 'menu_id', array( 'label' => esc_html__( 'WordPress menü', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SELECT, 'options' => $this->menus(), 'default' => '0' ) );
		$this->add_control( 'mobile_label', array( 'label' => esc_html__( 'Mobil gomb felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Menü', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$nav_id = 'vc-header-nav-' . esc_attr( $this->get_id() );
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
						if ( ! empty( $s['menu_id'] ) ) {
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
		$this->add_control( 'title', array( 'label' => esc_html__( 'Címsor', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => "Szűrés. Prevenció. Életmód.\nEgyütt a hosszabb életért." ) );
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
		$this->add_control( 'text', array( 'label' => esc_html__( 'Leírás', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Az IPOP ROHU00259 projekt célja Szatmár megye lakosságának egészségi állapotának javítása, a demográfiai kihívások kezelése és a közösségi alapú egészségügyi ellátás erősítése.', 'vitacenter-elementor-header' ) ) );
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
				array( 'title' => esc_html__( 'Ciklusoktatás', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Termékenységtudatosság és egészségnevelés fiatal nőknek.', 'vitacenter-elementor-header' ), 'icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_00 PM (1).png' ), 'link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#ciklusoktatas' ) ),
				array( 'title' => esc_html__( 'Meddőségi tanácsadás', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Komplex, életmód-alapú megközelítés szakmai háttérrel.', 'vitacenter-elementor-header' ), 'icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_00 PM (2).png' ), 'link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#meddosegi-tanacsadas' ) ),
				array( 'title' => esc_html__( 'Egészségfejlesztési Iroda', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Egyéni és csoportos prevenciós tanácsadás.', 'vitacenter-elementor-header' ), 'icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_00 PM (3).png' ), 'link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#efi' ) ),
				array( 'title' => esc_html__( 'Mobil szakorvosi szolgálat', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Helyben elérhető kardiovaszkuláris és nőgyógyászati szűrések.', 'vitacenter-elementor-header' ), 'icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_01 PM (4).png' ), 'link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#mobil-szakorvosi' ) ),
				array( 'title' => esc_html__( 'Életmódtanácsadás', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Személyre szabott támogatás az egyéni egészségtervhez.', 'vitacenter-elementor-header' ), 'icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_01 PM (5).png' ), 'link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#eletmodtanacsadas' ) ),
				array( 'title' => esc_html__( 'Óvodás iskolaérettséget vizsgáló szűrések', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Iskolaérettségi, szenzo-motoros és pszichológiai szűrések.', 'vitacenter-elementor-header' ), 'icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_01 PM (6).png' ), 'link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#ovodas-szuresek' ) ),
			),
		) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		?>
		<div class="vc-landing">
			<section id="programok" class="vc-landing__section vc-landing__programs">
				<div class="vc-landing__container">
					<h2 class="vc-landing__section-title"><?php echo esc_html( $s['title'] ); ?></h2>
					<div class="vc-landing__program-grid">
						<?php foreach ( $s['items'] as $item ) : ?>
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
						<h2 class="vc-landing__section-title vc-landing__section-title--left"><?php echo esc_html( $s['title'] ); ?></h2>
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
		$this->add_control( 'text', array( 'label' => esc_html__( 'Szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Foglaljon időpontot, vegyen részt programjainkon, tegyen többet önmagáért és családjáért!', 'vitacenter-elementor-header' ) ) );
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
				array( 'title' => esc_html__( 'A megelőzés ereje', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Miért fontosak a rendszeres szűrések és a korai felismerés?', 'vitacenter-elementor-header' ), 'image' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_20_40 PM (2).png' ), 'link_text' => esc_html__( 'Tovább olvasom', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#tudastar' ) ),
				array( 'title' => esc_html__( 'Egészséges életmód', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Gyakorlati tippek a mindennapokra a jobb közérzetért.', 'vitacenter-elementor-header' ), 'image' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_01 PM (5).png' ), 'link_text' => esc_html__( 'Tovább olvasom', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#tudastar' ) ),
				array( 'title' => esc_html__( 'Demográfiai kihívások', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Hogyan támogathatjuk családjainkat és közösségeinket?', 'vitacenter-elementor-header' ), 'image' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_20_41 PM (4).png' ), 'link_text' => esc_html__( 'Tovább olvasom', 'vitacenter-elementor-header' ), 'link' => array( 'url' => '#tudastar' ) ),
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

class VitaCenter_Landing_Contact_Widget extends VitaCenter_Structured_Widget_Base {
	public function get_name() { return 'vitacenter_landing_contact_footer'; }
	public function get_title() { return esc_html__( 'VitaCenter Contact/Footer', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-footer'; }
	public function get_style_depends() { return array( 'vc-landing' ); }
	public function get_script_depends() { return array( 'vc-landing' ); }

	protected function register_controls() {
		$this->start_controls_section( 'contact_section', array( 'label' => esc_html__( 'Kapcsolat', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'phone', array( 'label' => esc_html__( 'Telefon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '+40 261 713 775' ) );
		$this->add_control( 'email', array( 'label' => esc_html__( 'E-mail', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => 'efi@szatmar.ro' ) );
		$this->add_control( 'address', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Szatmárnémeti, Vasile Lucaciu u. 21.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'button_text', array( 'label' => esc_html__( 'Gomb', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kapcsolatfelvétel', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'button_link', array( 'label' => esc_html__( 'Gomb link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#kapcsolat' ) ) );
		$this->add_control( 'copyright', array( 'label' => esc_html__( 'Copyright', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( '© 2025 Egészségfejlesztési Iroda - Szatmár megye', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'project', array( 'label' => esc_html__( 'Projekt sor', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'IPOP ROHU00259 - Interreg VI-A Románia-Magyarország Program', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'privacy_text', array( 'label' => esc_html__( 'Adatvédelem felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Adatvédelem', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'privacy_link', array( 'label' => esc_html__( 'Adatvédelem link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->add_control( 'imprint_text', array( 'label' => esc_html__( 'Impresszum felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Impresszum', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'imprint_link', array( 'label' => esc_html__( 'Impresszum link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		?>
		<div class="vc-landing"><section id="kapcsolat" class="vc-landing__contact-wrap"><div class="vc-landing__container"><div class="vc-landing__contact-bar"><div class="vc-landing__contact-item vc-landing__contact-item--phone"><span aria-hidden="true"></span><div><strong><?php echo esc_html__( 'Telefon', 'vitacenter-elementor-header' ); ?></strong><p><?php echo esc_html( $s['phone'] ); ?></p></div></div><div class="vc-landing__contact-item vc-landing__contact-item--mail"><span aria-hidden="true"></span><div><strong><?php echo esc_html__( 'E-mail', 'vitacenter-elementor-header' ); ?></strong><p><?php echo esc_html( $s['email'] ); ?></p></div></div><div class="vc-landing__contact-item vc-landing__contact-item--pin"><span aria-hidden="true"></span><div><strong><?php echo esc_html__( 'Cím', 'vitacenter-elementor-header' ); ?></strong><p><?php echo esc_html( $s['address'] ); ?></p></div></div><?php $this->render_button( $s['button_text'], $s['button_link'], 'vc-landing__button vc-landing__button--outline' ); ?></div><footer class="vc-landing__footer"><span><?php echo esc_html( $s['copyright'] ); ?></span><span><?php echo esc_html( $s['project'] ); ?></span><nav><?php $this->render_text_link( $s['privacy_text'], $s['privacy_link'], 'vc-landing__plain-link' ); ?><?php $this->render_text_link( $s['imprint_text'], $s['imprint_link'], 'vc-landing__plain-link' ); ?></nav></footer></div></section></div>
		<?php
	}
}
