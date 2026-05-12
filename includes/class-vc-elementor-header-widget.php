<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;

class VitaCenter_Elementor_Header_Widget extends Widget_Base {
	public function get_name() {
		return 'vitacenter_header_nav';
	}

	public function get_title() {
		return esc_html__( 'VitaCenter Header/Nav', 'vitacenter-elementor-header' );
	}

	public function get_icon() {
		return 'eicon-nav-menu';
	}

	public function get_categories() {
		return array( 'vitacenter' );
	}

	public function get_keywords() {
		return array( 'header', 'navigation', 'vitacenter', 'efi', 'interreg' );
	}

	public function get_style_depends() {
		return array( 'vc-header' );
	}

	public function get_script_depends() {
		return array( 'vc-header' );
	}

	protected function register_controls() {
		$this->register_content_controls();
		$this->register_style_controls();
	}

	private function register_content_controls() {
		$this->start_controls_section(
			'section_brand',
			array(
				'label' => esc_html__( 'EFI / logo blokk', 'vitacenter-elementor-header' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'brand_logo',
			array(
				'label' => esc_html__( 'Logó', 'vitacenter-elementor-header' ),
				'type'  => Controls_Manager::MEDIA,
			)
		);

		$this->add_control(
			'brand_logo_alt',
			array(
				'label'       => esc_html__( 'Logó alt szöveg', 'vitacenter-elementor-header' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Egészségfejlesztési Iroda', 'vitacenter-elementor-header' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'brand_name',
			array(
				'label'       => esc_html__( 'Név', 'vitacenter-elementor-header' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Egészségfejlesztési Iroda', 'vitacenter-elementor-header' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'brand_subtitle',
			array(
				'label'       => esc_html__( 'Alcím', 'vitacenter-elementor-header' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Szatmár megye', 'vitacenter-elementor-header' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'brand_link',
			array(
				'label'       => esc_html__( 'Link', 'vitacenter-elementor-header' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => home_url( '/' ),
				'default'     => array(
					'url' => home_url( '/' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_project',
			array(
				'label' => esc_html__( 'Projekt blokk', 'vitacenter-elementor-header' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'project_code',
			array(
				'label'       => esc_html__( 'Projektkód', 'vitacenter-elementor-header' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'IPOP ROHU00259', 'vitacenter-elementor-header' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'project_program',
			array(
				'label'       => esc_html__( 'Programnév', 'vitacenter-elementor-header' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Interreg VI-A Románia-Magyarország Program', 'vitacenter-elementor-header' ),
				'label_block' => true,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_partner_logos',
			array(
				'label' => esc_html__( 'Jobb oldali logók', 'vitacenter-elementor-header' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$partner_repeater = new Repeater();

		$partner_repeater->add_control(
			'partner_logo',
			array(
				'label' => esc_html__( 'Logó', 'vitacenter-elementor-header' ),
				'type'  => Controls_Manager::MEDIA,
			)
		);

		$partner_repeater->add_control(
			'partner_alt',
			array(
				'label'       => esc_html__( 'Alt szöveg / felirat', 'vitacenter-elementor-header' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Partner logó', 'vitacenter-elementor-header' ),
				'label_block' => true,
			)
		);

		$partner_repeater->add_control(
			'partner_url',
			array(
				'label'       => esc_html__( 'Link', 'vitacenter-elementor-header' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://',
			)
		);

		$partner_repeater->add_control(
			'partner_width',
			array(
				'label'      => esc_html__( 'Szélesség', 'vitacenter-elementor-header' ),
				'type'       => Controls_Manager::NUMBER,
				'default'    => 120,
				'min'        => 32,
				'max'        => 220,
				'step'       => 1,
				'selectors'  => array(),
			)
		);

		$this->add_control(
			'partner_logos',
			array(
				'label'       => esc_html__( 'Logók', 'vitacenter-elementor-header' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $partner_repeater->get_controls(),
				'title_field' => '{{{ partner_alt }}}',
				'default'     => array(
					array(
						'partner_alt'   => esc_html__( 'Interreg Románia-Magyarország', 'vitacenter-elementor-header' ),
						'partner_width' => 120,
					),
					array(
						'partner_alt'   => esc_html__( 'Az Európai Unió társfinanszírozásával', 'vitacenter-elementor-header' ),
						'partner_width' => 146,
					),
					array(
						'partner_alt'   => esc_html__( 'Magyarország Kormánya', 'vitacenter-elementor-header' ),
						'partner_width' => 120,
					),
					array(
						'partner_alt'   => 'interreg-rohu.eu',
						'partner_width' => 118,
					),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_navigation',
			array(
				'label' => esc_html__( 'Menüsor', 'vitacenter-elementor-header' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'menu_source',
			array(
				'label'   => esc_html__( 'Menü forrása', 'vitacenter-elementor-header' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'wp_menu',
				'options' => array(
					'wp_menu' => esc_html__( 'WordPress menü', 'vitacenter-elementor-header' ),
					'manual'  => esc_html__( 'Kézi menüpontok', 'vitacenter-elementor-header' ),
				),
			)
		);

		$this->add_control(
			'menu_id',
			array(
				'label'     => esc_html__( 'WordPress menü', 'vitacenter-elementor-header' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '0',
				'options'   => $this->get_available_menus(),
				'condition' => array(
					'menu_source' => 'wp_menu',
				),
			)
		);

		$menu_repeater = new Repeater();

		$menu_repeater->add_control(
			'menu_label',
			array(
				'label'       => esc_html__( 'Felirat', 'vitacenter-elementor-header' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Menüpont', 'vitacenter-elementor-header' ),
				'label_block' => true,
			)
		);

		$menu_repeater->add_control(
			'menu_url',
			array(
				'label'       => esc_html__( 'Link', 'vitacenter-elementor-header' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => home_url( '/' ),
				'default'     => array(
					'url' => '#',
				),
			)
		);

		$this->add_control(
			'manual_menu_items',
			array(
				'label'       => esc_html__( 'Kézi menüpontok', 'vitacenter-elementor-header' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $menu_repeater->get_controls(),
				'title_field' => '{{{ menu_label }}}',
				'condition'   => array(
					'menu_source' => 'manual',
				),
				'default'     => array(
					array(
						'menu_label' => esc_html__( 'Főoldal', 'vitacenter-elementor-header' ),
						'menu_url'   => array( 'url' => '#' ),
					),
					array(
						'menu_label' => esc_html__( 'Projekt', 'vitacenter-elementor-header' ),
						'menu_url'   => array( 'url' => '#projekt' ),
					),
					array(
						'menu_label' => esc_html__( 'Programok', 'vitacenter-elementor-header' ),
						'menu_url'   => array( 'url' => '#programok' ),
					),
					array(
						'menu_label' => esc_html__( 'Események', 'vitacenter-elementor-header' ),
						'menu_url'   => array( 'url' => '#esemenyek' ),
					),
					array(
						'menu_label' => esc_html__( 'Tudástár', 'vitacenter-elementor-header' ),
						'menu_url'   => array( 'url' => '#tudastar' ),
					),
					array(
						'menu_label' => esc_html__( 'Kapcsolat', 'vitacenter-elementor-header' ),
						'menu_url'   => array( 'url' => '#kapcsolat' ),
					),
				),
			)
		);

		$this->add_control(
			'active_label',
			array(
				'label'       => esc_html__( 'Aktív kézi menüpont felirata', 'vitacenter-elementor-header' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Főoldal', 'vitacenter-elementor-header' ),
				'description' => esc_html__( 'Csak kézi menüpontoknál használatos. WordPress menünél a WordPress current-menu-item osztályai érvényesülnek.', 'vitacenter-elementor-header' ),
				'condition'   => array(
					'menu_source' => 'manual',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_layout',
			array(
				'label' => esc_html__( 'Elrendezés', 'vitacenter-elementor-header' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'sticky_header',
			array(
				'label'        => esc_html__( 'Sticky fejléc', 'vitacenter-elementor-header' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Igen', 'vitacenter-elementor-header' ),
				'label_off'    => esc_html__( 'Nem', 'vitacenter-elementor-header' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_control(
			'mobile_menu_label',
			array(
				'label'       => esc_html__( 'Mobil menü gomb felirata', 'vitacenter-elementor-header' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Menü', 'vitacenter-elementor-header' ),
				'label_block' => true,
			)
		);

		$this->end_controls_section();
	}

	private function register_style_controls() {
		$this->start_controls_section(
			'section_style_layout',
			array(
				'label' => esc_html__( 'Fejléc stílus', 'vitacenter-elementor-header' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'content_max_width',
			array(
				'label'      => esc_html__( 'Tartalom max. szélessége', 'vitacenter-elementor-header' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 720,
						'max' => 1600,
					),
				),
				'default'    => array(
					'size' => 1180,
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .vc-header__inner' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'header_background',
			array(
				'label'     => esc_html__( 'Háttér', 'vitacenter-elementor-header' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .vc-header' => '--vc-header-background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'header_border_color',
			array(
				'label'     => esc_html__( 'Alsó vonal színe', 'vitacenter-elementor-header' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e6f0ef',
				'selectors' => array(
					'{{WRAPPER}} .vc-header' => '--vc-header-border: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'top_padding',
			array(
				'label'      => esc_html__( 'Felső sáv belső térköz', 'vitacenter-elementor-header' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'default'    => array(
					'top'      => 18,
					'right'    => 24,
					'bottom'   => 14,
					'left'     => 24,
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .vc-header__top' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'nav_padding',
			array(
				'label'      => esc_html__( 'Menüsor belső térköz', 'vitacenter-elementor-header' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'default'    => array(
					'top'      => 0,
					'right'    => 24,
					'bottom'   => 0,
					'left'     => 24,
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .vc-header__nav-row' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_brand',
			array(
				'label' => esc_html__( 'Logó és projekt', 'vitacenter-elementor-header' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'brand_logo_width',
			array(
				'label'      => esc_html__( 'EFI logó szélessége', 'vitacenter-elementor-header' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 36,
						'max' => 180,
					),
				),
				'default'    => array(
					'size' => 58,
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .vc-header__brand-logo img' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'brand_text_color',
			array(
				'label'     => esc_html__( 'EFI szöveg színe', 'vitacenter-elementor-header' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0d5d5f',
				'selectors' => array(
					'{{WRAPPER}} .vc-header' => '--vc-header-brand-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'muted_text_color',
			array(
				'label'     => esc_html__( 'Másodlagos szöveg színe', 'vitacenter-elementor-header' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#596f72',
				'selectors' => array(
					'{{WRAPPER}} .vc-header' => '--vc-header-muted-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'brand_title_typography',
				'label'    => esc_html__( 'EFI név tipográfia', 'vitacenter-elementor-header' ),
				'selector' => '{{WRAPPER}} .vc-header__brand-name',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'project_typography',
				'label'    => esc_html__( 'Projekt tipográfia', 'vitacenter-elementor-header' ),
				'selector' => '{{WRAPPER}} .vc-header__project-code, {{WRAPPER}} .vc-header__project-program',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_nav',
			array(
				'label' => esc_html__( 'Menü stílus', 'vitacenter-elementor-header' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'nav_text_color',
			array(
				'label'     => esc_html__( 'Menü szövegszín', 'vitacenter-elementor-header' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#263f44',
				'selectors' => array(
					'{{WRAPPER}} .vc-header' => '--vc-header-nav-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'nav_accent_color',
			array(
				'label'     => esc_html__( 'Aktív/hover szín', 'vitacenter-elementor-header' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#007f7d',
				'selectors' => array(
					'{{WRAPPER}} .vc-header' => '--vc-header-accent: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'nav_typography',
				'label'    => esc_html__( 'Menü tipográfia', 'vitacenter-elementor-header' ),
				'selector' => '{{WRAPPER}} .vc-header__menu a',
			)
		);

		$this->add_responsive_control(
			'nav_gap',
			array(
				'label'      => esc_html__( 'Menüpont távolság', 'vitacenter-elementor-header' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 8,
						'max' => 72,
					),
				),
				'default'    => array(
					'size' => 42,
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .vc-header__menu' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'active_underline_height',
			array(
				'label'      => esc_html__( 'Aktív aláhúzás vastagság', 'vitacenter-elementor-header' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 8,
					),
				),
				'default'    => array(
					'size' => 3,
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .vc-header__menu a::after' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$classes  = array( 'vc-header' );

		if ( 'yes' === $settings['sticky_header'] ) {
			$classes[] = 'vc-header--sticky';
		}

		$nav_id = 'vc-header-nav-' . esc_attr( $this->get_id() );
		?>
		<header class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<div class="vc-header__inner">
				<div class="vc-header__top">
					<div class="vc-header__identity">
						<?php $this->render_brand( $settings ); ?>
						<?php $this->render_project( $settings ); ?>
					</div>
					<?php $this->render_partner_logos( $settings ); ?>
				</div>

				<div class="vc-header__nav-row">
					<button class="vc-header__toggle" type="button" aria-controls="<?php echo esc_attr( $nav_id ); ?>" aria-expanded="false">
						<span class="vc-header__toggle-bars" aria-hidden="true"></span>
						<span class="vc-header__toggle-label"><?php echo esc_html( $settings['mobile_menu_label'] ); ?></span>
					</button>
					<nav id="<?php echo esc_attr( $nav_id ); ?>" class="vc-header__nav" aria-label="<?php echo esc_attr__( 'Fő navigáció', 'vitacenter-elementor-header' ); ?>">
						<?php $this->render_navigation( $settings ); ?>
					</nav>
				</div>
			</div>
		</header>
		<?php
	}

	private function render_brand( $settings ) {
		$link = $this->get_url_attributes( $settings['brand_link'] );
		$logo = isset( $settings['brand_logo']['url'] ) ? $settings['brand_logo']['url'] : '';
		$alt  = ! empty( $settings['brand_logo_alt'] ) ? $settings['brand_logo_alt'] : $settings['brand_name'];
		?>
		<a class="vc-header__brand" <?php echo $link; ?>>
			<?php if ( $logo ) : ?>
				<span class="vc-header__brand-logo">
					<img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
				</span>
			<?php endif; ?>
			<span class="vc-header__brand-copy">
				<?php if ( ! empty( $settings['brand_name'] ) ) : ?>
					<span class="vc-header__brand-name"><?php echo esc_html( $settings['brand_name'] ); ?></span>
				<?php endif; ?>
				<?php if ( ! empty( $settings['brand_subtitle'] ) ) : ?>
					<span class="vc-header__brand-subtitle"><?php echo esc_html( $settings['brand_subtitle'] ); ?></span>
				<?php endif; ?>
			</span>
		</a>
		<?php
	}

	private function render_project( $settings ) {
		if ( empty( $settings['project_code'] ) && empty( $settings['project_program'] ) ) {
			return;
		}
		?>
		<div class="vc-header__project">
			<?php if ( ! empty( $settings['project_code'] ) ) : ?>
				<span class="vc-header__project-code"><?php echo esc_html( $settings['project_code'] ); ?></span>
			<?php endif; ?>
			<?php if ( ! empty( $settings['project_program'] ) ) : ?>
				<span class="vc-header__project-program"><?php echo esc_html( $settings['project_program'] ); ?></span>
			<?php endif; ?>
		</div>
		<?php
	}

	private function render_partner_logos( $settings ) {
		if ( empty( $settings['partner_logos'] ) || ! is_array( $settings['partner_logos'] ) ) {
			return;
		}
		?>
		<div class="vc-header__partners" aria-label="<?php echo esc_attr__( 'Támogatói és partner logók', 'vitacenter-elementor-header' ); ?>">
			<?php foreach ( $settings['partner_logos'] as $logo_item ) : ?>
				<?php
				$image_url = isset( $logo_item['partner_logo']['url'] ) ? $logo_item['partner_logo']['url'] : '';
				$alt       = ! empty( $logo_item['partner_alt'] ) ? $logo_item['partner_alt'] : esc_html__( 'Partner logó', 'vitacenter-elementor-header' );
				$width     = ! empty( $logo_item['partner_width'] ) ? absint( $logo_item['partner_width'] ) : 120;
				$link      = $this->get_url_attributes( isset( $logo_item['partner_url'] ) ? $logo_item['partner_url'] : array() );
				?>
				<a class="vc-header__partner" <?php echo $link; ?> style="--vc-partner-width: <?php echo esc_attr( $width ); ?>px;">
					<?php if ( $image_url ) : ?>
						<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
					<?php else : ?>
						<span><?php echo esc_html( $alt ); ?></span>
					<?php endif; ?>
				</a>
			<?php endforeach; ?>
		</div>
		<?php
	}

	private function render_navigation( $settings ) {
		if ( 'wp_menu' === $settings['menu_source'] && ! empty( $settings['menu_id'] ) ) {
			wp_nav_menu(
				array(
					'menu'           => absint( $settings['menu_id'] ),
					'menu_class'     => 'vc-header__menu',
					'container'      => false,
					'fallback_cb'    => false,
					'depth'          => 3,
					'link_before'    => '<span>',
					'link_after'     => '</span>',
					'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				)
			);
			return;
		}

		$items = ! empty( $settings['manual_menu_items'] ) && is_array( $settings['manual_menu_items'] ) ? $settings['manual_menu_items'] : array();

		if ( empty( $items ) ) {
			return;
		}
		?>
		<ul class="vc-header__menu vc-header__menu--manual">
			<?php foreach ( $items as $item ) : ?>
				<?php
				$label     = ! empty( $item['menu_label'] ) ? $item['menu_label'] : '';
				$item_link = $this->get_url_attributes( isset( $item['menu_url'] ) ? $item['menu_url'] : array() );
				$is_active = ! empty( $settings['active_label'] ) && $label === $settings['active_label'];

				if ( '' === $label ) {
					continue;
				}
				?>
				<li class="<?php echo $is_active ? 'current-menu-item' : ''; ?>">
					<a <?php echo $item_link; ?>><span><?php echo esc_html( $label ); ?></span></a>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php
	}

	private function get_available_menus() {
		$options = array(
			'0' => esc_html__( 'Válassz menüt', 'vitacenter-elementor-header' ),
		);
		$menus = wp_get_nav_menus();

		if ( empty( $menus ) || is_wp_error( $menus ) ) {
			return $options;
		}

		foreach ( $menus as $menu ) {
			$options[ (string) $menu->term_id ] = $menu->name;
		}

		return $options;
	}

	private function get_url_attributes( $url_control ) {
		$url = isset( $url_control['url'] ) ? $url_control['url'] : '';

		if ( '' === $url ) {
			$url = '#';
		}

		$attributes = array(
			'href="' . esc_url( $url ) . '"',
		);
		$rel = array();

		if ( ! empty( $url_control['is_external'] ) ) {
			$attributes[] = 'target="_blank"';
			$rel[] = 'noopener';
		}

		if ( ! empty( $url_control['nofollow'] ) ) {
			$rel[] = 'nofollow';
		}

		if ( ! empty( $rel ) ) {
			$attributes[] = 'rel="' . esc_attr( implode( ' ', array_unique( $rel ) ) ) . '"';
		}

		return implode( ' ', $attributes );
	}
}
