<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Repeater;

class VitaCenter_Mobile_Screening_Widget extends VitaCenter_Structured_Widget_Base {
	public function get_name() { return 'vitacenter_mobile_screening'; }
	public function get_title() { return esc_html__( 'VitaCenter Mobil szűrés', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-kit-details'; }
	public function get_style_depends() { return array( 'vc-landing' ); }
	public function get_script_depends() { return array( 'vc-landing' ); }

	protected function register_controls() {
		$this->start_controls_section( 'hero_section', array( 'label' => esc_html__( 'Hero', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'breadcrumb', array( 'label' => esc_html__( 'Morzsa navigáció', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Főoldal / Programok / Mobil szűrés', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => esc_html__( 'Kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Programok', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Mobil szűrés', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'subtitle', array( 'label' => esc_html__( 'Alcím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Helyben elérhető onkológiai szűrések a könnyebb hozzáférésért.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'primary_text', array( 'label' => esc_html__( 'Első gomb felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'További információ', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'primary_link', array( 'label' => esc_html__( 'Első gomb link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#kapcsolat' ) ) );
		$this->add_control( 'secondary_text', array( 'label' => esc_html__( 'Második gomb felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Szűrések megtekintése', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'secondary_link', array( 'label' => esc_html__( 'Második gomb link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#szuresi-teruletek' ) ) );
		$this->add_control( 'visual_kicker', array( 'label' => esc_html__( 'Vizuál kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Korai felismerés', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_title', array( 'label' => esc_html__( 'Vizuál cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A szűrés helybe megy, hogy a megelőzés minél több emberhez eljusson', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_text', array( 'label' => esc_html__( 'Vizuál szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Onkológiai szűrések vidéki helyszíneken, háziorvosok bevonásával.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_stat_one_value', array( 'label' => esc_html__( 'Első stat érték', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '1000' ) );
		$this->add_control( 'visual_stat_one_label', array( 'label' => esc_html__( 'Első stat címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'szűrés', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_stat_two_value', array( 'label' => esc_html__( 'Második stat érték', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '10' ) );
		$this->add_control( 'visual_stat_two_label', array( 'label' => esc_html__( 'Második stat címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'háziorvos', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_stat_three_value', array( 'label' => esc_html__( 'Harmadik stat érték', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '5' ) );
		$this->add_control( 'visual_stat_three_label', array( 'label' => esc_html__( 'Harmadik stat címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'terület', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'quick_info_section', array( 'label' => esc_html__( 'Gyors információk', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'quick_info_title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Gyors információk', 'vitacenter-elementor-header' ) ) );
		$quick = new Repeater();
		$quick->add_control( 'label', array( 'label' => esc_html__( 'Címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Program neve', 'vitacenter-elementor-header' ) ) );
		$quick->add_control( 'value', array( 'label' => esc_html__( 'Érték', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Mobil szűrés', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'quick_info', array(
			'label'       => esc_html__( 'Információk', 'vitacenter-elementor-header' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $quick->get_controls(),
			'title_field' => '{{{ label }}}',
			'default'     => $this->quick_info_defaults(),
		) );
		$this->end_controls_section();

		$this->start_controls_section( 'content_section', array( 'label' => esc_html__( 'Fő tartalom', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'intro_title', array( 'label' => esc_html__( 'Első blokk cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'A programról', 'vitacenter-elementor-header' ) ) );
		$intro = new Repeater();
		$intro->add_control( 'text', array( 'label' => esc_html__( 'Bekezdés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Szöveg.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'intro', array(
			'label'       => esc_html__( 'Bekezdések', 'vitacenter-elementor-header' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $intro->get_controls(),
			'title_field' => '{{{ text }}}',
			'default'     => $this->intro_defaults(),
		) );
		$this->add_control( 'importance_title', array( 'label' => esc_html__( 'Fontosság cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Miért fontos?', 'vitacenter-elementor-header' ) ) );
		$importance = new Repeater();
		$importance->add_control( 'text', array( 'label' => esc_html__( 'Elem', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Fontos elem.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'importance', array(
			'label'       => esc_html__( 'Fontossági elemek', 'vitacenter-elementor-header' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $importance->get_controls(),
			'title_field' => '{{{ text }}}',
			'default'     => $this->importance_defaults(),
		) );
		$this->end_controls_section();

		$this->start_controls_section( 'screening_section', array( 'label' => esc_html__( 'Szűrések', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'screening_kicker', array( 'label' => esc_html__( 'Kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Szűrési területek', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'screening_title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Milyen szűréseket biztosítunk?', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'screening_subtitle', array( 'label' => esc_html__( 'Alcím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A program keretében 1000 személy szűrése tervezett, 10 háziorvosnál, a megye különböző vidéki településein.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'screening_list_title', array( 'label' => esc_html__( 'Lista cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kiemelt szűrések', 'vitacenter-elementor-header' ) ) );
		$screenings = new Repeater();
		$screenings->add_control( 'text', array( 'label' => esc_html__( 'Szűrés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Szűrés', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'screenings', array(
			'label'       => esc_html__( 'Szűrési elemek', 'vitacenter-elementor-header' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $screenings->get_controls(),
			'title_field' => '{{{ text }}}',
			'default'     => $this->screening_defaults(),
		) );
		$this->add_control( 'primary_metric_label', array( 'label' => esc_html__( 'Első kártya jelölés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '1000' ) );
		$this->add_control( 'primary_metric_title', array( 'label' => esc_html__( 'Első kártya cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Tervezett szűrés', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'primary_metric_text', array( 'label' => esc_html__( 'Első kártya szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( '1000 személy szűrése vidéki településeken', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'secondary_metric_label', array( 'label' => esc_html__( 'Második kártya jelölés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '10' ) );
		$this->add_control( 'secondary_metric_title', array( 'label' => esc_html__( 'Második kártya cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Háziorvos', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'secondary_metric_text', array( 'label' => esc_html__( 'Második kártya szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( '10 háziorvos bevonása a programba', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'message_section', array( 'label' => esc_html__( 'Kiemelt üzenet', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'message_kicker', array( 'label' => esc_html__( 'Kiemelt kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kiemelt üzenet', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'message_title', array( 'label' => esc_html__( 'Kiemelt cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A megelőzés ne távoli lehetőség legyen, hanem helyben elérhető támogatás.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'message_text', array( 'label' => esc_html__( 'Kiemelt szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A mobil szűrés célja, hogy a megelőzés a vidéki közösségek számára is közelségbe kerüljön, és minél több ember eljusson a korai felismerést segítő vizsgálatokig.', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'sidebar_section', array( 'label' => esc_html__( 'Oldalsáv', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'useful_title', array( 'label' => esc_html__( 'Ajánlás cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kinek hasznos?', 'vitacenter-elementor-header' ) ) );
		$useful = new Repeater();
		$useful->add_control( 'text', array( 'label' => esc_html__( 'Elem', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Célcsoport', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'useful_items', array(
			'label'       => esc_html__( 'Hasznosság elemek', 'vitacenter-elementor-header' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $useful->get_controls(),
			'title_field' => '{{{ text }}}',
			'default'     => $this->useful_defaults(),
		) );
		$this->add_control( 'contact_title', array( 'label' => esc_html__( 'Kapcsolat cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kapcsolat', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'phone', array( 'label' => esc_html__( 'Telefon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '0742021316' ) );
		$this->add_control( 'email', array( 'label' => esc_html__( 'E-mail', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => 'info@nepegeszseg.hu' ) );
		$this->add_control( 'hours', array( 'label' => esc_html__( 'Nyitvatartás', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'H-P: 8:00 - 16:00', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'contact_button_text', array( 'label' => esc_html__( 'Kapcsolat gomb', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Érdeklődöm', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'contact_button_link', array( 'label' => esc_html__( 'Kapcsolat link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = wp_parse_args( $this->get_settings_for_display(), $this->defaults() );

		$quick_info   = $this->items_or_default( $s, 'quick_info', $this->quick_info_defaults() );
		$intro        = $this->items_or_default( $s, 'intro', $this->intro_defaults() );
		$importance   = $this->items_or_default( $s, 'importance', $this->importance_defaults() );
		$screenings   = $this->items_or_default( $s, 'screenings', $this->screening_defaults() );
		$useful_items = $this->items_or_default( $s, 'useful_items', $this->useful_defaults() );
		?>
		<div class="vc-landing">
			<section id="mobil-szures" class="vc-mobile-specialist vc-mobile-screening-program">
				<div class="vc-mobile-specialist__hero">
					<div class="vc-mobile-specialist__container vc-mobile-specialist__hero-grid">
						<div class="vc-mobile-specialist__hero-copy">
							<?php $this->render_breadcrumb( $s['breadcrumb'] ); ?>
							<?php if ( ! empty( $s['eyebrow'] ) ) : ?><span class="vc-mobile-specialist__eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></span><?php endif; ?>
							<h1><?php echo $this->format_multiline( $s['title'] ); ?></h1>
							<p><?php echo esc_html( $s['subtitle'] ); ?></p>
							<div class="vc-mobile-specialist__actions">
								<?php $this->render_program_button( $s['primary_text'], $s['primary_link'], 'vc-mobile-specialist__button vc-mobile-specialist__button--primary' ); ?>
								<?php $this->render_program_button( $s['secondary_text'], $s['secondary_link'], 'vc-mobile-specialist__button vc-mobile-specialist__button--secondary' ); ?>
							</div>
						</div>

						<div class="vc-mobile-specialist__visual" aria-label="<?php echo esc_attr__( 'Mobil szűrés összefoglaló', 'vitacenter-elementor-header' ); ?>">
							<div class="vc-mobile-specialist__visual-card">
								<span><?php echo esc_html( $s['visual_kicker'] ); ?></span>
								<h2><?php echo esc_html( $s['visual_title'] ); ?></h2>
								<p><?php echo esc_html( $s['visual_text'] ); ?></p>
								<div class="vc-mobile-specialist__visual-stats">
									<?php $this->render_visual_stat( $s['visual_stat_one_value'], $s['visual_stat_one_label'] ); ?>
									<?php $this->render_visual_stat( $s['visual_stat_two_value'], $s['visual_stat_two_label'] ); ?>
									<?php $this->render_visual_stat( $s['visual_stat_three_value'], $s['visual_stat_three_label'] ); ?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="vc-mobile-specialist__container vc-mobile-specialist__layout">
					<div class="vc-mobile-specialist__main">
						<section class="vc-mobile-specialist__card">
							<?php $this->render_section_title( $s['intro_title'] ); ?>
							<?php $this->render_paragraphs( $intro ); ?>
						</section>

						<section class="vc-mobile-specialist__card">
							<?php $this->render_section_title( $s['importance_title'] ); ?>
							<ul class="vc-mobile-specialist__benefit-grid">
								<?php foreach ( $importance as $item ) : ?>
									<?php $text = isset( $item['text'] ) ? $this->plain_text( $item['text'] ) : ''; ?>
									<?php if ( '' !== $text ) : ?><li><?php $this->render_dot(); ?><span><?php echo esc_html( $text ); ?></span></li><?php endif; ?>
								<?php endforeach; ?>
							</ul>
						</section>

						<section id="szuresi-teruletek" class="vc-mobile-specialist__screening">
							<?php if ( ! empty( $s['screening_kicker'] ) ) : ?><span class="vc-mobile-specialist__kicker"><?php echo esc_html( $s['screening_kicker'] ); ?></span><?php endif; ?>
							<h2><?php echo esc_html( $s['screening_title'] ); ?></h2>
							<p class="vc-mobile-specialist__screening-subtitle"><?php echo esc_html( $s['screening_subtitle'] ); ?></p>
							<div class="vc-mobile-specialist__screening-list">
								<h3><?php echo esc_html( $s['screening_list_title'] ); ?></h3>
								<?php $this->render_bullet_list( $screenings ); ?>
							</div>
							<div class="vc-mobile-specialist__mini-cards">
								<?php $this->render_metric_card( $s['primary_metric_label'], $s['primary_metric_title'], $s['primary_metric_text'] ); ?>
								<?php $this->render_metric_card( $s['secondary_metric_label'], $s['secondary_metric_title'], $s['secondary_metric_text'] ); ?>
							</div>
						</section>

						<section class="vc-mobile-specialist__message">
							<?php if ( ! empty( $s['message_kicker'] ) ) : ?><span><?php echo esc_html( $s['message_kicker'] ); ?></span><?php endif; ?>
							<h2><?php echo $this->format_multiline( $s['message_title'] ); ?></h2>
							<p><?php echo esc_html( $s['message_text'] ); ?></p>
						</section>
					</div>

					<aside id="kapcsolat" class="vc-mobile-specialist__sidebar">
						<div class="vc-mobile-specialist__side-card">
							<h3><?php echo esc_html( $s['quick_info_title'] ); ?></h3>
							<div class="vc-mobile-specialist__quick-list">
								<?php foreach ( $quick_info as $item ) : ?>
									<?php
									$label = isset( $item['label'] ) ? $this->plain_text( $item['label'] ) : '';
									$value = isset( $item['value'] ) ? $this->plain_text( $item['value'] ) : '';
									if ( '' === $label && '' === $value ) {
										continue;
									}
									?>
									<div>
										<?php if ( '' !== $label ) : ?><strong><?php echo esc_html( $label ); ?></strong><?php endif; ?>
										<?php if ( '' !== $value ) : ?><span><?php echo esc_html( $value ); ?></span><?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>
						</div>

						<div class="vc-mobile-specialist__useful">
							<h3><?php echo esc_html( $s['useful_title'] ); ?></h3>
							<?php $this->render_bullet_list( $useful_items ); ?>
						</div>

						<div class="vc-mobile-specialist__side-card">
							<h3><?php echo esc_html( $s['contact_title'] ); ?></h3>
							<div class="vc-mobile-specialist__contact-lines">
								<?php $this->render_contact_line( $s['phone'] ); ?>
								<?php $this->render_contact_line( $s['email'] ); ?>
								<?php $this->render_contact_line( $s['hours'] ); ?>
							</div>
							<?php $this->render_program_button( $s['contact_button_text'], $s['contact_button_link'], 'vc-mobile-specialist__button vc-mobile-specialist__button--primary vc-mobile-specialist__button--full' ); ?>
						</div>
					</aside>
				</div>
			</section>
		</div>
		<?php
	}

	private function defaults() {
		return array(
			'breadcrumb'               => esc_html__( 'Főoldal / Programok / Mobil szűrés', 'vitacenter-elementor-header' ),
			'eyebrow'                  => esc_html__( 'Programok', 'vitacenter-elementor-header' ),
			'title'                    => esc_html__( 'Mobil szűrés', 'vitacenter-elementor-header' ),
			'subtitle'                 => esc_html__( 'Helyben elérhető onkológiai szűrések a könnyebb hozzáférésért.', 'vitacenter-elementor-header' ),
			'primary_text'             => esc_html__( 'További információ', 'vitacenter-elementor-header' ),
			'primary_link'             => array( 'url' => '#kapcsolat' ),
			'secondary_text'           => esc_html__( 'Szűrések megtekintése', 'vitacenter-elementor-header' ),
			'secondary_link'           => array( 'url' => '#szuresi-teruletek' ),
			'visual_kicker'            => esc_html__( 'Korai felismerés', 'vitacenter-elementor-header' ),
			'visual_title'             => esc_html__( 'A szűrés helybe megy, hogy a megelőzés minél több emberhez eljusson', 'vitacenter-elementor-header' ),
			'visual_text'              => esc_html__( 'Onkológiai szűrések vidéki helyszíneken, háziorvosok bevonásával.', 'vitacenter-elementor-header' ),
			'visual_stat_one_value'    => '1000',
			'visual_stat_one_label'    => esc_html__( 'szűrés', 'vitacenter-elementor-header' ),
			'visual_stat_two_value'    => '10',
			'visual_stat_two_label'    => esc_html__( 'háziorvos', 'vitacenter-elementor-header' ),
			'visual_stat_three_value'  => '5',
			'visual_stat_three_label'  => esc_html__( 'terület', 'vitacenter-elementor-header' ),
			'quick_info_title'         => esc_html__( 'Gyors információk', 'vitacenter-elementor-header' ),
			'quick_info'               => $this->quick_info_defaults(),
			'intro_title'              => esc_html__( 'A programról', 'vitacenter-elementor-header' ),
			'intro'                    => $this->intro_defaults(),
			'importance_title'         => esc_html__( 'Miért fontos?', 'vitacenter-elementor-header' ),
			'importance'               => $this->importance_defaults(),
			'screening_kicker'         => esc_html__( 'Szűrési területek', 'vitacenter-elementor-header' ),
			'screening_title'          => esc_html__( 'Milyen szűréseket biztosítunk?', 'vitacenter-elementor-header' ),
			'screening_subtitle'       => esc_html__( 'A program keretében 1000 személy szűrése tervezett, 10 háziorvosnál, a megye különböző vidéki településein.', 'vitacenter-elementor-header' ),
			'screening_list_title'     => esc_html__( 'Kiemelt szűrések', 'vitacenter-elementor-header' ),
			'screenings'               => $this->screening_defaults(),
			'primary_metric_label'     => '1000',
			'primary_metric_title'     => esc_html__( 'Tervezett szűrés', 'vitacenter-elementor-header' ),
			'primary_metric_text'      => esc_html__( '1000 személy szűrése vidéki településeken', 'vitacenter-elementor-header' ),
			'secondary_metric_label'   => '10',
			'secondary_metric_title'   => esc_html__( 'Háziorvos', 'vitacenter-elementor-header' ),
			'secondary_metric_text'    => esc_html__( '10 háziorvos bevonása a programba', 'vitacenter-elementor-header' ),
			'message_kicker'           => esc_html__( 'Kiemelt üzenet', 'vitacenter-elementor-header' ),
			'message_title'            => esc_html__( 'A megelőzés ne távoli lehetőség legyen, hanem helyben elérhető támogatás.', 'vitacenter-elementor-header' ),
			'message_text'             => esc_html__( 'A mobil szűrés célja, hogy a megelőzés a vidéki közösségek számára is közelségbe kerüljön, és minél több ember eljusson a korai felismerést segítő vizsgálatokig.', 'vitacenter-elementor-header' ),
			'useful_title'             => esc_html__( 'Kinek hasznos?', 'vitacenter-elementor-header' ),
			'useful_items'             => $this->useful_defaults(),
			'contact_title'            => esc_html__( 'Kapcsolat', 'vitacenter-elementor-header' ),
			'phone'                    => '0742021316',
			'email'                    => 'info@nepegeszseg.hu',
			'hours'                    => esc_html__( 'H-P: 8:00 - 16:00', 'vitacenter-elementor-header' ),
			'contact_button_text'      => esc_html__( 'Érdeklődöm', 'vitacenter-elementor-header' ),
			'contact_button_link'      => array( 'url' => '#' ),
		);
	}

	private function quick_info_defaults() {
		return array(
			array( 'label' => esc_html__( 'Program neve', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Mobil szűrés', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Fő cél', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Korai onkológiai szűrések helyben', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Helyszín', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Szatmár megye vidéki települései', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Tervezett elérés', 'vitacenter-elementor-header' ), 'value' => esc_html__( '1000 személy szűrése', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Bevonás', 'vitacenter-elementor-header' ), 'value' => esc_html__( '10 háziorvos', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Szűrések', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Prosztata, mell, méhnyak, melanóma, vastagbél', 'vitacenter-elementor-header' ) ),
		);
	}

	private function intro_defaults() {
		return array(
			array( 'text' => esc_html__( 'A mozgó szűrőakció bevezetésének célja Szatmár megyében a korai szűrés fontosságának tudatosítása, valamint a szűrési lehetőségek vidéki közösségekhez való közelebb vitele.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'A program szemlélete egyszerű és közösségközpontú: nem a beteg utazik, hanem a szolgáltatás kerül közelebb a beteghez. Ez különösen fontos azokban a településekben, ahol a szűrővizsgálatokhoz való hozzáférés nehezebb lehet.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'A mobil szűrés célja, hogy a lakosság könnyebben elérje azokat a vizsgálatokat, amelyek segíthetik a betegségek korai felismerését, és hozzájárulhatnak a megelőzés erősítéséhez.', 'vitacenter-elementor-header' ) ),
		);
	}

	private function importance_defaults() {
		return array(
			array( 'text' => esc_html__( 'Tudatosítja a korai szűrés és a megelőzés jelentőségét.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Könnyebbé teszi a szűrésekhez való hozzáférést vidéki településeken.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'A szolgáltatás közelebb kerül azokhoz, akik nehezebben jutnak el városi központokba.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Támogatja a lakosság egészségtudatosabb döntéseit.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Segítheti a daganatos betegségek korábbi felismerését.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Erősíti a helyi háziorvosokkal való együttműködést.', 'vitacenter-elementor-header' ) ),
		);
	}

	private function screening_defaults() {
		return array(
			array( 'text' => esc_html__( 'Prosztatarák szűrés', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Mellrák szűrés', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Méhnyakrák szűrés', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Melanóma szűrés', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Vastagbélrák szűrés', 'vitacenter-elementor-header' ) ),
		);
	}

	private function useful_defaults() {
		return array(
			array( 'text' => esc_html__( 'Vidéki településeken élőknek', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Szűrésekhez nehezebben hozzáférő lakosoknak', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Megelőzés iránt érdeklődőknek', 'vitacenter-elementor-header' ) ),
		);
	}

	private function items_or_default( $settings, $key, $default ) {
		return ! empty( $settings[ $key ] ) && is_array( $settings[ $key ] ) ? $this->repeater_items( $settings[ $key ] ) : $default;
	}

	private function render_breadcrumb( $breadcrumb ) {
		$parts = array_filter( array_map( 'trim', explode( '/', $this->plain_text( $breadcrumb ) ) ) );

		if ( ! $parts ) {
			return;
		}
		?>
		<div class="vc-mobile-specialist__breadcrumb">
			<?php foreach ( $parts as $index => $part ) : ?>
				<span class="<?php echo $index === count( $parts ) - 1 ? 'is-current' : ''; ?>"><?php echo esc_html( $part ); ?></span>
				<?php if ( $index < count( $parts ) - 1 ) : ?><i aria-hidden="true">/</i><?php endif; ?>
			<?php endforeach; ?>
		</div>
		<?php
	}

	private function render_section_title( $title ) {
		$title = $this->plain_text( $title );

		if ( '' === $title ) {
			return;
		}
		?>
		<div class="vc-mobile-specialist__section-title">
			<h2><?php echo esc_html( $title ); ?></h2>
			<span aria-hidden="true"></span>
		</div>
		<?php
	}

	private function render_paragraphs( $items ) {
		if ( empty( $items ) ) {
			return;
		}
		?>
		<div class="vc-mobile-specialist__prose">
			<?php foreach ( $items as $item ) : ?>
				<?php $text = isset( $item['text'] ) ? $this->plain_text( $item['text'] ) : ''; ?>
				<?php if ( '' !== $text ) : ?><p><?php echo esc_html( $text ); ?></p><?php endif; ?>
			<?php endforeach; ?>
		</div>
		<?php
	}

	private function render_dot() {
		echo '<span class="vc-mobile-specialist__dot" aria-hidden="true"></span>';
	}

	private function render_bullet_list( $items ) {
		if ( empty( $items ) ) {
			return;
		}
		?>
		<ul class="vc-mobile-specialist__bullet-list">
			<?php foreach ( $items as $item ) : ?>
				<?php $text = isset( $item['text'] ) ? $this->plain_text( $item['text'] ) : ''; ?>
				<?php if ( '' !== $text ) : ?><li><?php $this->render_dot(); ?><span><?php echo esc_html( $text ); ?></span></li><?php endif; ?>
			<?php endforeach; ?>
		</ul>
		<?php
	}

	private function render_visual_stat( $value, $label ) {
		$value = $this->plain_text( $value );
		$label = $this->plain_text( $label );

		if ( '' === $value && '' === $label ) {
			return;
		}
		?>
		<div>
			<?php if ( '' !== $value ) : ?><strong><?php echo esc_html( $value ); ?></strong><?php endif; ?>
			<?php if ( '' !== $label ) : ?><small><?php echo esc_html( $label ); ?></small><?php endif; ?>
		</div>
		<?php
	}

	private function render_metric_card( $label, $title, $text ) {
		?>
		<div class="vc-mobile-specialist__metric">
			<strong><?php echo esc_html( $label ); ?></strong>
			<span><b><?php echo esc_html( $title ); ?></b><em><?php echo esc_html( $text ); ?></em></span>
		</div>
		<?php
	}

	private function render_contact_line( $text ) {
		$text = $this->plain_text( $text );

		if ( '' === $text ) {
			return;
		}
		?>
		<div><?php echo esc_html( $text ); ?></div>
		<?php
	}

	private function render_program_button( $text, $link, $class ) {
		$text = $this->plain_text( $text );

		if ( '' === $text ) {
			return;
		}
		?>
		<a class="<?php echo esc_attr( $class ); ?>" <?php echo $this->url_attributes( $link ); ?>>
			<span><?php echo esc_html( $text ); ?></span>
		</a>
		<?php
	}
}
