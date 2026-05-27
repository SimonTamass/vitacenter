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
		$this->add_control( 'eyebrow', array( 'label' => esc_html__( 'Kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Programok', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Mobil szűrés', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'subtitle', array( 'label' => esc_html__( 'Alcím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Helyben elérhető onkológiai szűrések a könnyebb hozzáférésért.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'primary_text', array( 'label' => esc_html__( 'Első gomb felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Program részletei', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'primary_link', array( 'label' => esc_html__( 'Első gomb link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#program-reszletek-szures' ) ) );
		$this->add_control( 'secondary_text', array( 'label' => esc_html__( 'Második gomb felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Gyors információk', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'secondary_link', array( 'label' => esc_html__( 'Második gomb link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#gyors-informaciok-szures' ) ) );
		$this->add_control( 'visual_label', array( 'label' => esc_html__( 'Vizuál címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Korai felismerés', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_title', array( 'label' => esc_html__( 'Vizuál üzenet', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A szűrés helybe megy, hogy a megelőzés minél több emberhez eljusson.', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'highlights_section', array( 'label' => esc_html__( 'Kiemelt kártyák', 'vitacenter-elementor-header' ) ) );
		$highlights = new Repeater();
		$highlights->add_control( 'number', array( 'label' => esc_html__( 'Sorszám', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '01' ) );
		$highlights->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Korai szűrés', 'vitacenter-elementor-header' ) ) );
		$highlights->add_control( 'text', array( 'label' => esc_html__( 'Szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A program a daganatos betegségek korai felismerésének fontosságát hangsúlyozza.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'highlights', array(
			'label'       => esc_html__( 'Kártyák', 'vitacenter-elementor-header' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $highlights->get_controls(),
			'title_field' => '{{{ title }}}',
			'default'     => $this->highlight_defaults(),
		) );
		$this->end_controls_section();

		$this->start_controls_section( 'content_section', array( 'label' => esc_html__( 'Fő tartalom', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'intro_kicker', array( 'label' => esc_html__( 'Első blokk kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'A programról', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'intro_title', array( 'label' => esc_html__( 'Első blokk cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Onkológiai szűrések közelebb a vidéki közösségekhez', 'vitacenter-elementor-header' ) ) );
		$intro = new Repeater();
		$intro->add_control( 'text', array( 'label' => esc_html__( 'Bekezdés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Szöveg.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'intro', array(
			'label'       => esc_html__( 'Bekezdések', 'vitacenter-elementor-header' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $intro->get_controls(),
			'title_field' => '{{{ text }}}',
			'default'     => $this->intro_defaults(),
		) );
		$this->add_control( 'implementation_kicker', array( 'label' => esc_html__( 'Megvalósítás kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Megvalósítás', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'implementation_title', array( 'label' => esc_html__( 'Megvalósítás cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( '1000 személy szűrése tervezett', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'implementation_text', array( 'label' => esc_html__( 'Megvalósítás szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A program keretében 1000 személy szűrése tervezett, 10 háziorvosnál, a megye különböző vidéki településein.', 'vitacenter-elementor-header' ) ) );
		$stats = new Repeater();
		$stats->add_control( 'value', array( 'label' => esc_html__( 'Érték', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '1000' ) );
		$stats->add_control( 'label', array( 'label' => esc_html__( 'Felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'tervezett szűrés', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'stats', array(
			'label'       => esc_html__( 'Számkártyák', 'vitacenter-elementor-header' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $stats->get_controls(),
			'title_field' => '{{{ value }}}',
			'default'     => $this->stat_defaults(),
		) );
		$this->add_control( 'screening_kicker', array( 'label' => esc_html__( 'Szűrések kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Szűrési területek', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'screening_title', array( 'label' => esc_html__( 'Szűrések cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Milyen szűréseket biztosítunk?', 'vitacenter-elementor-header' ) ) );
		$screening_items = new Repeater();
		$screening_items->add_control( 'number', array( 'label' => esc_html__( 'Sorszám', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '01' ) );
		$screening_items->add_control( 'title', array( 'label' => esc_html__( 'Szűrés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Prosztatarák szűrés', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'screening_items', array(
			'label'       => esc_html__( 'Szűrések', 'vitacenter-elementor-header' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $screening_items->get_controls(),
			'title_field' => '{{{ title }}}',
			'default'     => $this->screening_item_defaults(),
		) );
		$this->add_control( 'benefits_kicker', array( 'label' => esc_html__( 'Hatások kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Várható hatások', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'benefits_title', array( 'label' => esc_html__( 'Hatások cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Miért fontos a mobil szűrés?', 'vitacenter-elementor-header' ) ) );
		$benefits = new Repeater();
		$benefits->add_control( 'text', array( 'label' => esc_html__( 'Hatás', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Tudatosítja a korai szűrés és a megelőzés jelentőségét.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'benefits', array(
			'label'       => esc_html__( 'Hatások', 'vitacenter-elementor-header' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $benefits->get_controls(),
			'title_field' => '{{{ text }}}',
			'default'     => $this->benefit_defaults(),
		) );
		$this->end_controls_section();

		$this->start_controls_section( 'sidebar_section', array( 'label' => esc_html__( 'Oldalsáv', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'quick_info_title', array( 'label' => esc_html__( 'Gyors információk cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Gyors információk', 'vitacenter-elementor-header' ) ) );
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
		$this->add_control( 'message_title', array( 'label' => esc_html__( 'Üzenet cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kulcsüzenet', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'message_text', array( 'label' => esc_html__( 'Üzenet szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A mobil szűrés célja, hogy a megelőzés ne távoli lehetőség legyen, hanem helyben elérhető támogatás a vidéki közösségek számára.', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s               = wp_parse_args( $this->get_settings_for_display(), $this->defaults() );
		$highlights      = $this->items_or_default( $s, 'highlights', $this->highlight_defaults() );
		$intro           = $this->items_or_default( $s, 'intro', $this->intro_defaults() );
		$stats           = $this->items_or_default( $s, 'stats', $this->stat_defaults() );
		$screening_items = $this->items_or_default( $s, 'screening_items', $this->screening_item_defaults() );
		$benefits        = $this->items_or_default( $s, 'benefits', $this->benefit_defaults() );
		$quick_info      = $this->items_or_default( $s, 'quick_info', $this->quick_info_defaults() );
		?>
		<div class="vc-landing">
			<section id="mobil-szures" class="vc-mobile-screening" aria-label="<?php echo esc_attr__( 'Mobil szűrés oldal', 'vitacenter-elementor-header' ); ?>">
				<div class="vc-mobile-screening__hero">
					<div class="vc-mobile-screening__hero-copy">
						<?php if ( ! empty( $s['eyebrow'] ) ) : ?><span class="vc-mobile-screening__eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></span><?php endif; ?>
						<h1><?php echo $this->format_multiline( $s['title'] ); ?></h1>
						<p><?php echo esc_html( $s['subtitle'] ); ?></p>
						<div class="vc-mobile-screening__actions">
							<?php $this->render_screening_button( $s['primary_text'], $s['primary_link'], 'vc-mobile-screening__button vc-mobile-screening__button--primary' ); ?>
							<?php $this->render_screening_button( $s['secondary_text'], $s['secondary_link'], 'vc-mobile-screening__button vc-mobile-screening__button--secondary' ); ?>
						</div>
					</div>

					<div class="vc-mobile-screening__visual" aria-hidden="true">
						<div class="vc-mobile-screening__visual-card">
							<div class="vc-mobile-screening__visual-icon"><?php $this->render_visual_icon(); ?></div>
							<?php if ( ! empty( $s['visual_label'] ) ) : ?><span class="vc-mobile-screening__visual-label"><?php echo esc_html( $s['visual_label'] ); ?></span><?php endif; ?>
							<strong><?php echo esc_html( $s['visual_title'] ); ?></strong>
						</div>
					</div>
				</div>

				<div class="vc-mobile-screening__highlight-grid">
					<?php foreach ( $highlights as $item ) : ?>
						<?php
						$number = isset( $item['number'] ) ? $this->plain_text( $item['number'] ) : '';
						$title  = isset( $item['title'] ) ? $this->plain_text( $item['title'] ) : '';
						$text   = isset( $item['text'] ) ? $this->plain_text( $item['text'] ) : '';

						if ( '' === $number && '' === $title && '' === $text ) {
							continue;
						}
						?>
						<article class="vc-mobile-screening__highlight-card">
							<?php if ( '' !== $number ) : ?><span><?php echo esc_html( $number ); ?></span><?php endif; ?>
							<?php if ( '' !== $title ) : ?><h2><?php echo esc_html( $title ); ?></h2><?php endif; ?>
							<?php if ( '' !== $text ) : ?><p><?php echo esc_html( $text ); ?></p><?php endif; ?>
						</article>
					<?php endforeach; ?>
				</div>

				<div class="vc-mobile-screening__main-grid" id="program-reszletek-szures">
					<main class="vc-mobile-screening__content">
						<section class="vc-mobile-screening__card">
							<?php $this->render_section_heading( $s['intro_kicker'], $s['intro_title'] ); ?>
							<?php $this->render_paragraphs( $intro ); ?>
						</section>

						<section class="vc-mobile-screening__card vc-mobile-screening__card--soft">
							<?php $this->render_section_heading( $s['implementation_kicker'], $s['implementation_title'] ); ?>
							<?php if ( ! empty( $s['implementation_text'] ) ) : ?><p class="vc-mobile-screening__large-text"><?php echo esc_html( $s['implementation_text'] ); ?></p><?php endif; ?>
							<div class="vc-mobile-screening__stats-grid">
								<?php foreach ( $stats as $item ) : ?>
									<?php
									$value = isset( $item['value'] ) ? $this->plain_text( $item['value'] ) : '';
									$label = isset( $item['label'] ) ? $this->plain_text( $item['label'] ) : '';

									if ( '' === $value && '' === $label ) {
										continue;
									}
									?>
									<div class="vc-mobile-screening__stat-card">
										<?php if ( '' !== $value ) : ?><strong><?php echo esc_html( $value ); ?></strong><?php endif; ?>
										<?php if ( '' !== $label ) : ?><span><?php echo esc_html( $label ); ?></span><?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>
						</section>

						<section class="vc-mobile-screening__card">
							<?php $this->render_section_heading( $s['screening_kicker'], $s['screening_title'] ); ?>
							<div class="vc-mobile-screening__screening-grid">
								<?php foreach ( $screening_items as $index => $item ) : ?>
									<?php
									$number = isset( $item['number'] ) ? $this->plain_text( $item['number'] ) : '';
									$title  = isset( $item['title'] ) ? $this->plain_text( $item['title'] ) : '';

									if ( '' === $number && '' === $title ) {
										continue;
									}

									$class = count( $screening_items ) - 1 === $index && 1 === count( $screening_items ) % 2 ? ' vc-mobile-screening__screening-item--wide' : '';
									?>
									<div class="vc-mobile-screening__screening-item<?php echo esc_attr( $class ); ?>">
										<?php if ( '' !== $number ) : ?><span><?php echo esc_html( $number ); ?></span><?php endif; ?>
										<?php if ( '' !== $title ) : ?><strong><?php echo esc_html( $title ); ?></strong><?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>
						</section>

						<section class="vc-mobile-screening__card">
							<?php $this->render_section_heading( $s['benefits_kicker'], $s['benefits_title'] ); ?>
							<div class="vc-mobile-screening__benefit-grid">
								<?php foreach ( $benefits as $item ) : ?>
									<?php $text = isset( $item['text'] ) ? $this->plain_text( $item['text'] ) : ''; ?>
									<?php if ( '' !== $text ) : ?><div class="vc-mobile-screening__benefit-item"><?php echo esc_html( $text ); ?></div><?php endif; ?>
								<?php endforeach; ?>
							</div>
						</section>
					</main>

					<aside class="vc-mobile-screening__sidebar" id="gyors-informaciok-szures" aria-label="<?php echo esc_attr__( 'Gyors információk', 'vitacenter-elementor-header' ); ?>">
						<div class="vc-mobile-screening__sidebar-card">
							<?php if ( ! empty( $s['quick_info_title'] ) ) : ?><span class="vc-mobile-screening__card-label"><?php echo esc_html( $s['quick_info_title'] ); ?></span><?php endif; ?>
							<div class="vc-mobile-screening__info-list">
								<?php foreach ( $quick_info as $item ) : ?>
									<?php
									$label = isset( $item['label'] ) ? $this->plain_text( $item['label'] ) : '';
									$value = isset( $item['value'] ) ? $this->plain_text( $item['value'] ) : '';

									if ( '' === $label && '' === $value ) {
										continue;
									}
									?>
									<div>
										<?php if ( '' !== $label ) : ?><span><?php echo esc_html( $label ); ?></span><?php endif; ?>
										<?php if ( '' !== $value ) : ?><strong><?php echo esc_html( $value ); ?></strong><?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>
						</div>

						<div class="vc-mobile-screening__sidebar-card vc-mobile-screening__sidebar-card--message">
							<?php if ( ! empty( $s['message_title'] ) ) : ?><h3><?php echo esc_html( $s['message_title'] ); ?></h3><?php endif; ?>
							<?php if ( ! empty( $s['message_text'] ) ) : ?><p><?php echo esc_html( $s['message_text'] ); ?></p><?php endif; ?>
						</div>
					</aside>
				</div>
			</section>
		</div>
		<?php
	}

	private function defaults() {
		return array(
			'eyebrow'              => esc_html__( 'Programok', 'vitacenter-elementor-header' ),
			'title'                => esc_html__( 'Mobil szűrés', 'vitacenter-elementor-header' ),
			'subtitle'             => esc_html__( 'Helyben elérhető onkológiai szűrések a könnyebb hozzáférésért.', 'vitacenter-elementor-header' ),
			'primary_text'         => esc_html__( 'Program részletei', 'vitacenter-elementor-header' ),
			'primary_link'         => array( 'url' => '#program-reszletek-szures' ),
			'secondary_text'       => esc_html__( 'Gyors információk', 'vitacenter-elementor-header' ),
			'secondary_link'       => array( 'url' => '#gyors-informaciok-szures' ),
			'visual_label'         => esc_html__( 'Korai felismerés', 'vitacenter-elementor-header' ),
			'visual_title'         => esc_html__( 'A szűrés helybe megy, hogy a megelőzés minél több emberhez eljusson.', 'vitacenter-elementor-header' ),
			'highlights'           => $this->highlight_defaults(),
			'intro_kicker'         => esc_html__( 'A programról', 'vitacenter-elementor-header' ),
			'intro_title'          => esc_html__( 'Onkológiai szűrések közelebb a vidéki közösségekhez', 'vitacenter-elementor-header' ),
			'intro'                => $this->intro_defaults(),
			'implementation_kicker' => esc_html__( 'Megvalósítás', 'vitacenter-elementor-header' ),
			'implementation_title' => esc_html__( '1000 személy szűrése tervezett', 'vitacenter-elementor-header' ),
			'implementation_text'  => esc_html__( 'A program keretében 1000 személy szűrése tervezett, 10 háziorvosnál, a megye különböző vidéki településein.', 'vitacenter-elementor-header' ),
			'stats'                => $this->stat_defaults(),
			'screening_kicker'     => esc_html__( 'Szűrési területek', 'vitacenter-elementor-header' ),
			'screening_title'      => esc_html__( 'Milyen szűréseket biztosítunk?', 'vitacenter-elementor-header' ),
			'screening_items'      => $this->screening_item_defaults(),
			'benefits_kicker'      => esc_html__( 'Várható hatások', 'vitacenter-elementor-header' ),
			'benefits_title'       => esc_html__( 'Miért fontos a mobil szűrés?', 'vitacenter-elementor-header' ),
			'benefits'             => $this->benefit_defaults(),
			'quick_info_title'     => esc_html__( 'Gyors információk', 'vitacenter-elementor-header' ),
			'quick_info'           => $this->quick_info_defaults(),
			'message_title'        => esc_html__( 'Kulcsüzenet', 'vitacenter-elementor-header' ),
			'message_text'         => esc_html__( 'A mobil szűrés célja, hogy a megelőzés ne távoli lehetőség legyen, hanem helyben elérhető támogatás a vidéki közösségek számára.', 'vitacenter-elementor-header' ),
		);
	}

	private function highlight_defaults() {
		return array(
			array( 'number' => '01', 'title' => esc_html__( 'Korai szűrés', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'A program a daganatos betegségek korai felismerésének fontosságát hangsúlyozza.', 'vitacenter-elementor-header' ) ),
			array( 'number' => '02', 'title' => esc_html__( 'Helyben elérhető', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'A szolgáltatás a vidéki közösségekhez kerül közelebb, nem a betegnek kell utaznia.', 'vitacenter-elementor-header' ) ),
			array( 'number' => '03', 'title' => esc_html__( 'Széles körű szűrések', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Prosztata-, mell-, méhnyak-, melanóma- és vastagbélrák szűrések biztosítása.', 'vitacenter-elementor-header' ) ),
		);
	}

	private function intro_defaults() {
		return array(
			array( 'text' => esc_html__( 'A mozgó szűrőakció bevezetésének célja Szatmár megyében a korai szűrés fontosságának tudatosítása, valamint a szűrési lehetőségek vidéki közösségekhez való közelebb vitele.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'A program szemlélete egyszerű és közösségközpontú: nem a beteg utazik, hanem a szolgáltatás kerül közelebb a beteghez. Ez különösen fontos azokban a településekben, ahol a szűrővizsgálatokhoz való hozzáférés nehezebb lehet.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'A mobil szűrés célja, hogy a lakosság könnyebben elérje azokat a vizsgálatokat, amelyek segíthetik a betegségek korai felismerését, és hozzájárulhatnak a megelőzés erősítéséhez.', 'vitacenter-elementor-header' ) ),
		);
	}

	private function stat_defaults() {
		return array(
			array( 'value' => '1000', 'label' => esc_html__( 'tervezett szűrés', 'vitacenter-elementor-header' ) ),
			array( 'value' => '10', 'label' => esc_html__( 'bevonható háziorvos', 'vitacenter-elementor-header' ) ),
			array( 'value' => '5', 'label' => esc_html__( 'kiemelt szűrési terület', 'vitacenter-elementor-header' ) ),
		);
	}

	private function screening_item_defaults() {
		return array(
			array( 'number' => '01', 'title' => esc_html__( 'Prosztatarák szűrés', 'vitacenter-elementor-header' ) ),
			array( 'number' => '02', 'title' => esc_html__( 'Mellrák szűrés', 'vitacenter-elementor-header' ) ),
			array( 'number' => '03', 'title' => esc_html__( 'Méhnyakrák szűrés', 'vitacenter-elementor-header' ) ),
			array( 'number' => '04', 'title' => esc_html__( 'Melanóma szűrés', 'vitacenter-elementor-header' ) ),
			array( 'number' => '05', 'title' => esc_html__( 'Vastagbélrák szűrés', 'vitacenter-elementor-header' ) ),
		);
	}

	private function benefit_defaults() {
		return array(
			array( 'text' => esc_html__( 'Tudatosítja a korai szűrés és a megelőzés jelentőségét.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Könnyebbé teszi a szűrésekhez való hozzáférést vidéki településeken.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'A szolgáltatás közelebb kerül azokhoz, akik nehezebben jutnak el városi központokba.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Támogatja a lakosság egészségtudatosabb döntéseit.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Segítheti a daganatos betegségek korábbi felismerését.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Erősíti a helyi háziorvosokkal való együttműködést.', 'vitacenter-elementor-header' ) ),
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

	private function items_or_default( $settings, $key, $default ) {
		return ! empty( $settings[ $key ] ) && is_array( $settings[ $key ] ) ? $this->repeater_items( $settings[ $key ] ) : $default;
	}

	private function render_section_heading( $kicker, $title ) {
		$kicker = $this->plain_text( $kicker );
		$title  = $this->plain_text( $title );

		if ( '' === $kicker && '' === $title ) {
			return;
		}
		?>
		<div class="vc-mobile-screening__section-heading">
			<?php if ( '' !== $kicker ) : ?><span><?php echo esc_html( $kicker ); ?></span><?php endif; ?>
			<?php if ( '' !== $title ) : ?><h2><?php echo esc_html( $title ); ?></h2><?php endif; ?>
		</div>
		<?php
	}

	private function render_paragraphs( $items ) {
		if ( empty( $items ) ) {
			return;
		}
		?>
		<div class="vc-mobile-screening__text-content">
			<?php foreach ( $items as $item ) : ?>
				<?php $text = isset( $item['text'] ) ? $this->plain_text( $item['text'] ) : ''; ?>
				<?php if ( '' !== $text ) : ?><p><?php echo esc_html( $text ); ?></p><?php endif; ?>
			<?php endforeach; ?>
		</div>
		<?php
	}

	private function render_screening_button( $text, $link, $class ) {
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

	private function render_visual_icon() {
		$gradient_id = 'vcMobileScreeningGradient-' . sanitize_html_class( $this->get_id() );
		?>
		<svg viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg" focusable="false" aria-hidden="true">
			<defs>
				<linearGradient id="<?php echo esc_attr( $gradient_id ); ?>" x1="18" y1="18" x2="104" y2="104" gradientUnits="userSpaceOnUse">
					<stop offset="0%" stop-color="#4fc3ea" />
					<stop offset="100%" stop-color="#1266b3" />
				</linearGradient>
			</defs>
			<circle cx="60" cy="60" r="54" fill="url(#<?php echo esc_attr( $gradient_id ); ?>)" />
			<path d="M26 61h46V39c0-4.4-3.6-8-8-8H34c-4.4 0-8 3.6-8 8v22Z" fill="#ffffff" />
			<path d="M72 48h15l13 15v18H72V48Z" fill="#ffffff" opacity="0.95" />
			<circle cx="44" cy="84" r="9" fill="#fff" stroke="#2bbfd0" stroke-width="5" />
			<circle cx="87" cy="84" r="9" fill="#fff" stroke="#2bbfd0" stroke-width="5" />
			<path d="M83 55h8l7 8H83V55Z" fill="#2bbfd0" opacity="0.85" />
			<path d="M27 72h73" stroke="#2bbfd0" stroke-width="5" stroke-linecap="round" />
			<path d="M46 44c3.5-5 10.8-4.5 13 1.1 2.2-5.6 9.5-6.1 13-1.1 5.4 7.8-4.7 17.6-13 23.4-8.3-5.8-18.4-15.6-13-23.4Z" fill="none" stroke="#2bbfd0" stroke-width="4.5" stroke-linejoin="round" />
		</svg>
		<?php
	}
}
