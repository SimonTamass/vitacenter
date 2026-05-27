<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Repeater;

class VitaCenter_Mobile_Specialist_V2_Widget extends VitaCenter_Structured_Widget_Base {
	public function get_name() { return 'vitacenter_mobile_specialist_v2'; }
	public function get_title() { return esc_html__( 'VitaCenter Mobil szakorvosi szolgálat 2.0', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-kit-details'; }
	public function get_style_depends() { return array( 'vc-landing' ); }
	public function get_script_depends() { return array( 'vc-landing' ); }

	protected function register_controls() {
		$this->start_controls_section( 'hero_section', array( 'label' => esc_html__( 'Hero', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => esc_html__( 'Kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Programok', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Mobil szakorvosi szolgálat', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'subtitle', array( 'label' => esc_html__( 'Alcím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Helyben elérhető szakvizsgálatok a könnyebb hozzáférésért.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'primary_text', array( 'label' => esc_html__( 'Első gomb felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Program részletei', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'primary_link', array( 'label' => esc_html__( 'Első gomb link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#program-reszletek-v2' ) ) );
		$this->add_control( 'secondary_text', array( 'label' => esc_html__( 'Második gomb felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Gyors információk', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'secondary_link', array( 'label' => esc_html__( 'Második gomb link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#gyors-informaciok-v2' ) ) );
		$this->add_control( 'visual_label', array( 'label' => esc_html__( 'Vizuál címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Helybe vitt ellátás', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_title', array( 'label' => esc_html__( 'Vizuál üzenet', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Nem a beteg utazik, hanem a szolgáltatás kerül közelebb hozzá.', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'highlights_section', array( 'label' => esc_html__( 'Kiemelt kártyák', 'vitacenter-elementor-header' ) ) );
		$highlights = new Repeater();
		$highlights->add_control( 'number', array( 'label' => esc_html__( 'Sorszám', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '01' ) );
		$highlights->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Könnyebb hozzáférés', 'vitacenter-elementor-header' ) ) );
		$highlights->add_control( 'text', array( 'label' => esc_html__( 'Szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A szakorvosi ellátás közelebb kerül a vidéki közösségekhez.', 'vitacenter-elementor-header' ) ) );
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
		$this->add_control( 'intro_title', array( 'label' => esc_html__( 'Első blokk cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Szakellátás közelebb a közösségekhez', 'vitacenter-elementor-header' ) ) );
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
		$this->add_control( 'implementation_title', array( 'label' => esc_html__( 'Megvalósítás cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Vizsgálatok vidéki településeken', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'implementation_text', array( 'label' => esc_html__( 'Megvalósítás szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A megye különböző vidéki településein 10 háziorvosnál, a szakvizsgálatoknak megfelelő szakorvosok bevonásával fognak kardiovaszkuláris és egyéb vizsgálatokat végezni.', 'vitacenter-elementor-header' ) ) );
		$stats = new Repeater();
		$stats->add_control( 'value', array( 'label' => esc_html__( 'Érték', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '10' ) );
		$stats->add_control( 'label', array( 'label' => esc_html__( 'Felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'bevonható háziorvos', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'stats', array(
			'label'       => esc_html__( 'Számkártyák', 'vitacenter-elementor-header' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $stats->get_controls(),
			'title_field' => '{{{ value }}}',
			'default'     => $this->stat_defaults(),
		) );
		$this->add_control( 'benefits_kicker', array( 'label' => esc_html__( 'Hatások kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Várható hatások', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'benefits_title', array( 'label' => esc_html__( 'Hatások cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Miért fontos ez a szolgáltatás?', 'vitacenter-elementor-header' ) ) );
		$benefits = new Repeater();
		$benefits->add_control( 'text', array( 'label' => esc_html__( 'Hatás', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Csökkentheti a falusi és városi ellátáshoz való hozzáférés különbségeit.', 'vitacenter-elementor-header' ) ) );
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
		$quick->add_control( 'value', array( 'label' => esc_html__( 'Érték', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Mobil szakorvosi szolgálat', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'quick_info', array(
			'label'       => esc_html__( 'Információk', 'vitacenter-elementor-header' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $quick->get_controls(),
			'title_field' => '{{{ label }}}',
			'default'     => $this->quick_info_defaults(),
		) );
		$this->add_control( 'message_title', array( 'label' => esc_html__( 'Üzenet cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kulcsüzenet', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'message_text', array( 'label' => esc_html__( 'Üzenet szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A szolgáltatás célja, hogy a szakellátás ne csak a nagyobb városi központokban legyen könnyebben elérhető, hanem a vidéki lakosság számára is közelségbe kerüljön.', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s           = wp_parse_args( $this->get_settings_for_display(), $this->defaults() );
		$highlights  = $this->items_or_default( $s, 'highlights', $this->highlight_defaults() );
		$intro       = $this->items_or_default( $s, 'intro', $this->intro_defaults() );
		$stats       = $this->items_or_default( $s, 'stats', $this->stat_defaults() );
		$benefits    = $this->items_or_default( $s, 'benefits', $this->benefit_defaults() );
		$quick_info  = $this->items_or_default( $s, 'quick_info', $this->quick_info_defaults() );
		?>
		<div class="vc-landing">
			<section id="mobil-szakorvosi-szolgalat-v2" class="vc-mobile-specialist-v2" aria-label="<?php echo esc_attr__( 'Mobil szakorvosi szolgálat 2.0 oldal', 'vitacenter-elementor-header' ); ?>">
				<div class="vc-mobile-specialist-v2__hero">
					<div class="vc-mobile-specialist-v2__hero-copy">
						<?php if ( ! empty( $s['eyebrow'] ) ) : ?><span class="vc-mobile-specialist-v2__eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></span><?php endif; ?>
						<h1><?php echo $this->format_multiline( $s['title'] ); ?></h1>
						<p><?php echo esc_html( $s['subtitle'] ); ?></p>
						<div class="vc-mobile-specialist-v2__actions">
							<?php $this->render_v2_button( $s['primary_text'], $s['primary_link'], 'vc-mobile-specialist-v2__button vc-mobile-specialist-v2__button--primary' ); ?>
							<?php $this->render_v2_button( $s['secondary_text'], $s['secondary_link'], 'vc-mobile-specialist-v2__button vc-mobile-specialist-v2__button--secondary' ); ?>
						</div>
					</div>

					<div class="vc-mobile-specialist-v2__visual" aria-hidden="true">
						<div class="vc-mobile-specialist-v2__visual-card">
							<div class="vc-mobile-specialist-v2__visual-icon"><?php $this->render_visual_icon(); ?></div>
							<?php if ( ! empty( $s['visual_label'] ) ) : ?><span class="vc-mobile-specialist-v2__visual-label"><?php echo esc_html( $s['visual_label'] ); ?></span><?php endif; ?>
							<strong><?php echo esc_html( $s['visual_title'] ); ?></strong>
						</div>
					</div>
				</div>

				<div class="vc-mobile-specialist-v2__highlight-grid">
					<?php foreach ( $highlights as $item ) : ?>
						<?php
						$number = isset( $item['number'] ) ? $this->plain_text( $item['number'] ) : '';
						$title  = isset( $item['title'] ) ? $this->plain_text( $item['title'] ) : '';
						$text   = isset( $item['text'] ) ? $this->plain_text( $item['text'] ) : '';

						if ( '' === $number && '' === $title && '' === $text ) {
							continue;
						}
						?>
						<article class="vc-mobile-specialist-v2__highlight-card">
							<?php if ( '' !== $number ) : ?><span><?php echo esc_html( $number ); ?></span><?php endif; ?>
							<?php if ( '' !== $title ) : ?><h2><?php echo esc_html( $title ); ?></h2><?php endif; ?>
							<?php if ( '' !== $text ) : ?><p><?php echo esc_html( $text ); ?></p><?php endif; ?>
						</article>
					<?php endforeach; ?>
				</div>

				<div class="vc-mobile-specialist-v2__main-grid" id="program-reszletek-v2">
					<main class="vc-mobile-specialist-v2__content">
						<section class="vc-mobile-specialist-v2__card">
							<?php $this->render_section_heading( $s['intro_kicker'], $s['intro_title'] ); ?>
							<?php $this->render_paragraphs( $intro ); ?>
						</section>

						<section class="vc-mobile-specialist-v2__card vc-mobile-specialist-v2__card--soft">
							<?php $this->render_section_heading( $s['implementation_kicker'], $s['implementation_title'] ); ?>
							<?php if ( ! empty( $s['implementation_text'] ) ) : ?><p class="vc-mobile-specialist-v2__large-text"><?php echo esc_html( $s['implementation_text'] ); ?></p><?php endif; ?>
							<div class="vc-mobile-specialist-v2__stats-grid">
								<?php foreach ( $stats as $item ) : ?>
									<?php
									$value = isset( $item['value'] ) ? $this->plain_text( $item['value'] ) : '';
									$label = isset( $item['label'] ) ? $this->plain_text( $item['label'] ) : '';

									if ( '' === $value && '' === $label ) {
										continue;
									}
									?>
									<div class="vc-mobile-specialist-v2__stat-card">
										<?php if ( '' !== $value ) : ?><strong><?php echo esc_html( $value ); ?></strong><?php endif; ?>
										<?php if ( '' !== $label ) : ?><span><?php echo esc_html( $label ); ?></span><?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>
						</section>

						<section class="vc-mobile-specialist-v2__card">
							<?php $this->render_section_heading( $s['benefits_kicker'], $s['benefits_title'] ); ?>
							<div class="vc-mobile-specialist-v2__benefit-grid">
								<?php foreach ( $benefits as $item ) : ?>
									<?php $text = isset( $item['text'] ) ? $this->plain_text( $item['text'] ) : ''; ?>
									<?php if ( '' !== $text ) : ?><div class="vc-mobile-specialist-v2__benefit-item"><?php echo esc_html( $text ); ?></div><?php endif; ?>
								<?php endforeach; ?>
							</div>
						</section>
					</main>

					<aside class="vc-mobile-specialist-v2__sidebar" id="gyors-informaciok-v2" aria-label="<?php echo esc_attr__( 'Gyors információk', 'vitacenter-elementor-header' ); ?>">
						<div class="vc-mobile-specialist-v2__sidebar-card">
							<?php if ( ! empty( $s['quick_info_title'] ) ) : ?><span class="vc-mobile-specialist-v2__card-label"><?php echo esc_html( $s['quick_info_title'] ); ?></span><?php endif; ?>
							<div class="vc-mobile-specialist-v2__info-list">
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

						<div class="vc-mobile-specialist-v2__sidebar-card vc-mobile-specialist-v2__sidebar-card--message">
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
			'title'                => esc_html__( 'Mobil szakorvosi szolgálat', 'vitacenter-elementor-header' ),
			'subtitle'             => esc_html__( 'Helyben elérhető szakvizsgálatok a könnyebb hozzáférésért.', 'vitacenter-elementor-header' ),
			'primary_text'         => esc_html__( 'Program részletei', 'vitacenter-elementor-header' ),
			'primary_link'         => array( 'url' => '#program-reszletek-v2' ),
			'secondary_text'       => esc_html__( 'Gyors információk', 'vitacenter-elementor-header' ),
			'secondary_link'       => array( 'url' => '#gyors-informaciok-v2' ),
			'visual_label'         => esc_html__( 'Helybe vitt ellátás', 'vitacenter-elementor-header' ),
			'visual_title'         => esc_html__( 'Nem a beteg utazik, hanem a szolgáltatás kerül közelebb hozzá.', 'vitacenter-elementor-header' ),
			'highlights'           => $this->highlight_defaults(),
			'intro_kicker'         => esc_html__( 'A programról', 'vitacenter-elementor-header' ),
			'intro_title'          => esc_html__( 'Szakellátás közelebb a közösségekhez', 'vitacenter-elementor-header' ),
			'intro'                => $this->intro_defaults(),
			'implementation_kicker' => esc_html__( 'Megvalósítás', 'vitacenter-elementor-header' ),
			'implementation_title' => esc_html__( 'Vizsgálatok vidéki településeken', 'vitacenter-elementor-header' ),
			'implementation_text'  => esc_html__( 'A megye különböző vidéki településein 10 háziorvosnál, a szakvizsgálatoknak megfelelő szakorvosok bevonásával fognak kardiovaszkuláris és egyéb vizsgálatokat végezni.', 'vitacenter-elementor-header' ),
			'stats'                => $this->stat_defaults(),
			'benefits_kicker'      => esc_html__( 'Várható hatások', 'vitacenter-elementor-header' ),
			'benefits_title'       => esc_html__( 'Miért fontos ez a szolgáltatás?', 'vitacenter-elementor-header' ),
			'benefits'             => $this->benefit_defaults(),
			'quick_info_title'     => esc_html__( 'Gyors információk', 'vitacenter-elementor-header' ),
			'quick_info'           => $this->quick_info_defaults(),
			'message_title'        => esc_html__( 'Kulcsüzenet', 'vitacenter-elementor-header' ),
			'message_text'         => esc_html__( 'A szolgáltatás célja, hogy a szakellátás ne csak a nagyobb városi központokban legyen könnyebben elérhető, hanem a vidéki lakosság számára is közelségbe kerüljön.', 'vitacenter-elementor-header' ),
		);
	}

	private function highlight_defaults() {
		return array(
			array( 'number' => '01', 'title' => esc_html__( 'Könnyebb hozzáférés', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'A szakorvosi ellátás közelebb kerül a vidéki közösségekhez.', 'vitacenter-elementor-header' ) ),
			array( 'number' => '02', 'title' => esc_html__( 'Erősebb alapellátás', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Támogatja a háziorvosi rendelők és szakrendelők kapcsolatát.', 'vitacenter-elementor-header' ) ),
			array( 'number' => '03', 'title' => esc_html__( 'Célzott vizsgálatok', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Kardiovaszkuláris és egyéb szakvizsgálatok vidéki helyszíneken.', 'vitacenter-elementor-header' ) ),
		);
	}

	private function intro_defaults() {
		return array(
			array( 'text' => esc_html__( 'Romániában köztudott az egészségügyi ellátáshoz, ezen belül a szakellátáshoz való hozzáférés és annak igénybevétele között óriási különbség van falusi és városi, főleg nagyvárosi összehasonlításban, a falvakon élők rovására.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'A mozgó szakorvosi szolgálat bevezetésének célja Szatmár megyében a szakorvosi ellátás közösséghez való közelebb vitele. Ennek lényege, hogy nem a beteg utazik, hanem a szolgáltatás kerül közelebb a beteghez.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Ezáltal lényegesen javulhat a város és a falu lakosainak egészségügyi ellátáshoz való hozzáférése közötti különbség, erősödhet a háziorvosi, családorvosi rendelők és a járóbeteg szakrendelők szakmai kapcsolata.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'A program hozzájárulhat a hátrányos, falusi települések háziorvosi rendelői szintjén végzett szakmai munka színvonalának emeléséhez, valamint javíthatja a háziorvosi tevékenység megelőzésben és ellátásban betöltött szerepét.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'A kezdeményezés különösen fontos a szociálisan hátrányos lakossági csoportok és az infrastrukturálisan izolált települések számára, ahol a szakorvosi ellátáshoz való hozzáférés korlátozottabb lehet.', 'vitacenter-elementor-header' ) ),
		);
	}

	private function stat_defaults() {
		return array(
			array( 'value' => '10', 'label' => esc_html__( 'bevonható háziorvos', 'vitacenter-elementor-header' ) ),
			array( 'value' => '+', 'label' => esc_html__( 'szakorvosi vizsgálatok', 'vitacenter-elementor-header' ) ),
			array( 'value' => esc_html__( 'vidék', 'vitacenter-elementor-header' ), 'label' => esc_html__( 'helyben elérhető ellátás', 'vitacenter-elementor-header' ) ),
		);
	}

	private function benefit_defaults() {
		return array(
			array( 'text' => esc_html__( 'Csökkentheti a falusi és városi ellátáshoz való hozzáférés különbségeit.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Erősítheti az alapellátás és a szakrendelői járóbeteg-ellátás kapcsolatát.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Segítheti a háziorvosi munka megelőzésben betöltött szerepét.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Javíthatja a szakellátáshoz való hozzáférést izolált településeken.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Támogathatja a szociálisan hátrányos lakossági csoportokat.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Hosszabb távon kedvezően hathat a lakosság egészségi mutatóira.', 'vitacenter-elementor-header' ) ),
		);
	}

	private function quick_info_defaults() {
		return array(
			array( 'label' => esc_html__( 'Program neve', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Mobil szakorvosi szolgálat', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Fő cél', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Szakellátás közelebb vitele a vidéki közösségekhez', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Helyszín', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Szatmár megye vidéki települései', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Bevonás', 'vitacenter-elementor-header' ), 'value' => esc_html__( '10 háziorvos és szakorvosok', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Vizsgálatok', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Kardiovaszkuláris és egyéb szakvizsgálatok', 'vitacenter-elementor-header' ) ),
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
		<div class="vc-mobile-specialist-v2__section-heading">
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
		<div class="vc-mobile-specialist-v2__text-content">
			<?php foreach ( $items as $item ) : ?>
				<?php $text = isset( $item['text'] ) ? $this->plain_text( $item['text'] ) : ''; ?>
				<?php if ( '' !== $text ) : ?><p><?php echo esc_html( $text ); ?></p><?php endif; ?>
			<?php endforeach; ?>
		</div>
		<?php
	}

	private function render_v2_button( $text, $link, $class ) {
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
		$gradient_id = 'vcMobileSpecialistV2Gradient-' . sanitize_html_class( $this->get_id() );
		?>
		<svg viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg" focusable="false" aria-hidden="true">
			<defs>
				<linearGradient id="<?php echo esc_attr( $gradient_id ); ?>" x1="18" y1="18" x2="104" y2="104" gradientUnits="userSpaceOnUse">
					<stop offset="0%" stop-color="#4fc3ea" />
					<stop offset="100%" stop-color="#1266b3" />
				</linearGradient>
			</defs>
			<circle cx="60" cy="60" r="54" fill="url(#<?php echo esc_attr( $gradient_id ); ?>)" />
			<path d="M25 63h46V40c0-4.4-3.6-8-8-8H33c-4.4 0-8 3.6-8 8v23Z" fill="#fff" />
			<path d="M71 49h15l13 15v18H71V49Z" fill="#fff" opacity="0.95" />
			<path d="M39 44v22M28 55h22" stroke="#2bbfd0" stroke-width="7" stroke-linecap="round" />
			<circle cx="43" cy="84" r="9" fill="#fff" stroke="#2bbfd0" stroke-width="5" />
			<circle cx="86" cy="84" r="9" fill="#fff" stroke="#2bbfd0" stroke-width="5" />
			<path d="M82 56h8l7 8H82V56Z" fill="#2bbfd0" opacity="0.85" />
			<path d="M25 72h74" stroke="#2bbfd0" stroke-width="5" stroke-linecap="round" />
		</svg>
		<?php
	}
}
