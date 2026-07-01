<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Repeater;

class VitaCenter_Mobile_Specialist_Widget extends VitaCenter_Structured_Widget_Base {
	public function get_name() { return 'vitacenter_mobile_specialist'; }
	public function get_title() { return esc_html__( 'VitaCenter Mobil szakorvosi szolgálat', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-kit-details'; }
	public function get_style_depends() { return array( 'vc-landing' ); }
	public function get_script_depends() { return array( 'vc-landing' ); }

	protected function register_controls() {
		$this->start_controls_section( 'hero_section', array( 'label' => esc_html__( 'Hero', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'breadcrumb', array( 'label' => esc_html__( 'Morzsa navigáció', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Főoldal / Programok / Mobil szakorvosi szolgálat', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => esc_html__( 'Kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Programok', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Mobil szakorvosi szolgálat', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'subtitle', array( 'label' => esc_html__( 'Alcím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Helyben elérhető szakvizsgálatok a könnyebb hozzáférésért.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'primary_text', array( 'label' => esc_html__( 'Első gomb felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'További információ', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'primary_link', array( 'label' => esc_html__( 'Első gomb link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#kapcsolat' ) ) );
		$this->add_control( 'secondary_text', array( 'label' => esc_html__( 'Második gomb felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Mobil szűrés megtekintése', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'secondary_link', array( 'label' => esc_html__( 'Második gomb link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#mobil-szures' ) ) );
		$this->add_control( 'visual_kicker', array( 'label' => esc_html__( 'Vizuál kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Helyben elérhető ellátás', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_title', array( 'label' => esc_html__( 'Vizuál cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'A szolgáltatás közelebb kerül a beteghez', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_text', array( 'label' => esc_html__( 'Vizuál szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Szakorvosi vizsgálatok, vidéki közösségek, javuló hozzáférés.', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'quick_info_section', array( 'label' => esc_html__( 'Gyors információk', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'quick_info_title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Gyors információk', 'vitacenter-elementor-header' ) ) );
		$quick = new Repeater();
		$quick->add_control( 'label', array( 'label' => esc_html__( 'Címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Program neve', 'vitacenter-elementor-header' ) ) );
		$quick->add_control( 'value', array( 'label' => esc_html__( 'Érték', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Mobil szakorvosi szolgálat', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'quick_info', array(
			'label' => esc_html__( 'Információk', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $quick->get_controls(),
			'title_field' => '{{{ label }}}',
			'default' => $this->quick_info_defaults(),
		) );
		$this->end_controls_section();

		$this->start_controls_section( 'content_section', array( 'label' => esc_html__( 'Fő tartalom', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'intro_title', array( 'label' => esc_html__( 'Első blokk cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'A szolgáltatásról', 'vitacenter-elementor-header' ) ) );
		$intro = new Repeater();
		$intro->add_control( 'text', array( 'label' => esc_html__( 'Bekezdés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Szöveg.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'intro', array(
			'label' => esc_html__( 'Szolgáltatásról bekezdések', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $intro->get_controls(),
			'title_field' => '{{{ text }}}',
			'default' => $this->intro_defaults(),
		) );
		$this->add_control( 'implementation_title', array( 'label' => esc_html__( 'Megvalósítás cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Megvalósítás', 'vitacenter-elementor-header' ) ) );
		$implementation = new Repeater();
		$implementation->add_control( 'text', array( 'label' => esc_html__( 'Bekezdés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Megvalósítás szöveg.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'implementation', array(
			'label' => esc_html__( 'Megvalósítás bekezdések', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $implementation->get_controls(),
			'title_field' => '{{{ text }}}',
			'default' => $this->implementation_defaults(),
		) );
		$this->add_control( 'benefits_title', array( 'label' => esc_html__( 'Előnyök cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Várható előnyök', 'vitacenter-elementor-header' ) ) );
		$benefits = new Repeater();
		$benefits->add_control( 'text', array( 'label' => esc_html__( 'Előny', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Előny.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'benefits', array(
			'label' => esc_html__( 'Előnyök', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $benefits->get_controls(),
			'title_field' => '{{{ text }}}',
			'default' => $this->benefit_defaults(),
		) );
		$this->end_controls_section();

		$this->start_controls_section( 'screening_section', array( 'label' => esc_html__( 'Kapcsolódó mobil szűrés', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'screening_kicker', array( 'label' => esc_html__( 'Kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kapcsolódó program', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'screening_title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Mobil szűrés', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'screening_subtitle', array( 'label' => esc_html__( 'Alcím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Helyben elérhető onkológiai szűrések a könnyebb hozzáférésért.', 'vitacenter-elementor-header' ) ) );
		$screening_paragraphs = new Repeater();
		$screening_paragraphs->add_control( 'text', array( 'label' => esc_html__( 'Bekezdés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Szűrés szöveg.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'screening_paragraphs', array(
			'label' => esc_html__( 'Bekezdések', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $screening_paragraphs->get_controls(),
			'title_field' => '{{{ text }}}',
			'default' => $this->screening_paragraph_defaults(),
		) );
		$this->add_control( 'screening_participants_label', array( 'label' => esc_html__( 'Résztvevő kártya cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Tervezett résztvevők', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'screening_participants_text', array( 'label' => esc_html__( 'Résztvevő kártya szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( '1000 személy szűrése', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'screening_location_label', array( 'label' => esc_html__( 'Helyszín kártya cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Helyszínek / háziorvosok', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'screening_location_text', array( 'label' => esc_html__( 'Helyszín kártya szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( '10 háziorvosnál, vidéki településeken', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'screening_list_title', array( 'label' => esc_html__( 'Lista cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Biztosított onkológiai szűrések', 'vitacenter-elementor-header' ) ) );
		$screening_items = new Repeater();
		$screening_items->add_control( 'text', array( 'label' => esc_html__( 'Szűrés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Szűrés', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'screening_items', array(
			'label' => esc_html__( 'Szűrések listája', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $screening_items->get_controls(),
			'title_field' => '{{{ text }}}',
			'default' => $this->screening_item_defaults(),
		) );
		$this->end_controls_section();

		$this->start_controls_section( 'message_section', array( 'label' => esc_html__( 'Kiemelt üzenet', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'message_kicker', array( 'label' => esc_html__( 'Kiemelt kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kiemelt üzenet', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'message_title', array( 'label' => esc_html__( 'Kiemelt cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Nem a beteg utazik, hanem a szolgáltatás kerül közelebb hozzá.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'message_text', array( 'label' => esc_html__( 'Kiemelt szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A program célja, hogy a szakellátás és a szűrés a vidéki közösségek számára is könnyebben elérhetővé váljon, különösen ott, ahol a hozzáférés ma korlátozott.', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'sidebar_section', array( 'label' => esc_html__( 'Oldalsáv', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'useful_title', array( 'label' => esc_html__( 'Hasznosság cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Miért hasznos?', 'vitacenter-elementor-header' ) ) );
		$useful = new Repeater();
		$useful->add_control( 'text', array( 'label' => esc_html__( 'Elem', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Hasznosság', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'useful_items', array(
			'label' => esc_html__( 'Hasznosság elemek', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $useful->get_controls(),
			'title_field' => '{{{ text }}}',
			'default' => $this->useful_defaults(),
		) );
		$this->add_control( 'contact_title', array( 'label' => esc_html__( 'Kapcsolat cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kapcsolat', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'phone', array( 'label' => esc_html__( 'Telefon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '0742021316' ) );
		$this->add_control( 'email', array( 'label' => esc_html__( 'E-mail', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => 'info@nepegeszseg.hu' ) );
		$this->add_control( 'hours', array( 'label' => esc_html__( 'Nyitvatartás', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'H–P: 8:00 – 16:00', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'contact_button_text', array( 'label' => esc_html__( 'Kapcsolat gomb', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Érdeklődöm', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'contact_button_link', array( 'label' => esc_html__( 'Kapcsolat link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = wp_parse_args( $this->get_settings_for_display(), $this->defaults() );

		$quick_info           = $this->items_or_default( $s, 'quick_info', $this->quick_info_defaults() );
		$intro                = $this->items_or_default( $s, 'intro', $this->intro_defaults() );
		$implementation       = $this->items_or_default( $s, 'implementation', $this->implementation_defaults() );
		$benefits             = $this->items_or_default( $s, 'benefits', $this->benefit_defaults() );
		$screening_paragraphs = $this->items_or_default( $s, 'screening_paragraphs', $this->screening_paragraph_defaults() );
		$screening_items      = $this->items_or_default( $s, 'screening_items', $this->screening_item_defaults() );
		$useful_items         = $this->items_or_default( $s, 'useful_items', $this->useful_defaults() );
		?>
		<div class="vc-landing">
			<section id="mobil-szakorvosi-szolgalat" class="vc-mobile-specialist">
				<div class="vc-mobile-specialist__hero">
					<div class="vc-mobile-specialist__container vc-mobile-specialist__hero-grid">
						<div class="vc-mobile-specialist__hero-copy">
							<?php $this->render_breadcrumb( $s['breadcrumb'] ); ?>
							<?php if ( ! empty( $s['eyebrow'] ) ) : ?><span class="vc-mobile-specialist__eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></span><?php endif; ?>
							<h1><?php echo $this->format_multiline( $s['title'] ); ?></h1>
							<p><?php echo esc_html( $s['subtitle'] ); ?></p>
							<div class="vc-mobile-specialist__actions">
								<?php $this->render_specialist_button( $s['primary_text'], $s['primary_link'], 'vc-mobile-specialist__button vc-mobile-specialist__button--primary' ); ?>
								<?php $this->render_specialist_button( $s['secondary_text'], $s['secondary_link'], 'vc-mobile-specialist__button vc-mobile-specialist__button--secondary' ); ?>
							</div>
						</div>

						<div class="vc-mobile-specialist__visual" aria-label="<?php echo esc_attr__( 'Mobil szakorvosi szolgálat összefoglaló', 'vitacenter-elementor-header' ); ?>">
							<div class="vc-mobile-specialist__visual-card">
								<span><?php echo esc_html( $s['visual_kicker'] ); ?></span>
								<h2><?php echo esc_html( $s['visual_title'] ); ?></h2>
								<p><?php echo esc_html( $s['visual_text'] ); ?></p>
								<div class="vc-mobile-specialist__visual-stats">
									<div><strong>10</strong><small><?php echo esc_html__( 'háziorvos', 'vitacenter-elementor-header' ); ?></small></div>
									<div><strong>1000</strong><small><?php echo esc_html__( 'szűrés', 'vitacenter-elementor-header' ); ?></small></div>
									<div><strong>5</strong><small><?php echo esc_html__( 'onkológiai terület', 'vitacenter-elementor-header' ); ?></small></div>
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
							<?php $this->render_section_title( $s['implementation_title'] ); ?>
							<?php $this->render_paragraphs( $implementation ); ?>
						</section>

						<section class="vc-mobile-specialist__card">
							<?php $this->render_section_title( $s['benefits_title'] ); ?>
							<ul class="vc-mobile-specialist__benefit-grid">
								<?php foreach ( $benefits as $item ) : ?>
									<?php $text = isset( $item['text'] ) ? $this->plain_text( $item['text'] ) : ''; ?>
									<?php if ( '' !== $text ) : ?><li><?php $this->render_dot(); ?><span><?php echo esc_html( $text ); ?></span></li><?php endif; ?>
								<?php endforeach; ?>
							</ul>
						</section>

						<section id="mobil-szures" class="vc-mobile-specialist__screening">
							<?php if ( ! empty( $s['screening_kicker'] ) ) : ?><span class="vc-mobile-specialist__kicker"><?php echo esc_html( $s['screening_kicker'] ); ?></span><?php endif; ?>
							<h2><?php echo esc_html( $s['screening_title'] ); ?></h2>
							<p class="vc-mobile-specialist__screening-subtitle"><?php echo esc_html( $s['screening_subtitle'] ); ?></p>
							<?php $this->render_paragraphs( $screening_paragraphs ); ?>
							<div class="vc-mobile-specialist__mini-cards">
								<?php $this->render_metric_card( '1K', $s['screening_participants_label'], $s['screening_participants_text'] ); ?>
								<?php $this->render_metric_card( '10', $s['screening_location_label'], $s['screening_location_text'] ); ?>
							</div>
							<div class="vc-mobile-specialist__screening-list">
								<h3><?php echo esc_html( $s['screening_list_title'] ); ?></h3>
								<?php $this->render_bullet_list( $screening_items ); ?>
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
							<?php $this->render_specialist_button( $s['contact_button_text'], $s['contact_button_link'], 'vc-mobile-specialist__button vc-mobile-specialist__button--primary vc-mobile-specialist__button--full' ); ?>
						</div>
					</aside>
				</div>
			</section>
		</div>
		<?php
	}

	private function defaults() {
		return array(
			'breadcrumb'                   => esc_html__( 'Főoldal / Programok / Mobil szakorvosi szolgálat', 'vitacenter-elementor-header' ),
			'eyebrow'                      => esc_html__( 'Programok', 'vitacenter-elementor-header' ),
			'title'                        => esc_html__( 'Mobil szakorvosi szolgálat', 'vitacenter-elementor-header' ),
			'subtitle'                     => esc_html__( 'Helyben elérhető szakvizsgálatok a könnyebb hozzáférésért.', 'vitacenter-elementor-header' ),
			'primary_text'                 => esc_html__( 'További információ', 'vitacenter-elementor-header' ),
			'primary_link'                 => array( 'url' => '#kapcsolat' ),
			'secondary_text'               => esc_html__( 'Mobil szűrés megtekintése', 'vitacenter-elementor-header' ),
			'secondary_link'               => array( 'url' => '#mobil-szures' ),
			'visual_kicker'                => esc_html__( 'Helyben elérhető ellátás', 'vitacenter-elementor-header' ),
			'visual_title'                 => esc_html__( 'A szolgáltatás közelebb kerül a beteghez', 'vitacenter-elementor-header' ),
			'visual_text'                  => esc_html__( 'Szakorvosi vizsgálatok, vidéki közösségek, javuló hozzáférés.', 'vitacenter-elementor-header' ),
			'quick_info_title'             => esc_html__( 'Gyors információk', 'vitacenter-elementor-header' ),
			'quick_info'                   => $this->quick_info_defaults(),
			'intro_title'                  => esc_html__( 'A szolgáltatásról', 'vitacenter-elementor-header' ),
			'intro'                        => $this->intro_defaults(),
			'implementation_title'         => esc_html__( 'Megvalósítás', 'vitacenter-elementor-header' ),
			'implementation'               => $this->implementation_defaults(),
			'benefits_title'               => esc_html__( 'Várható előnyök', 'vitacenter-elementor-header' ),
			'benefits'                     => $this->benefit_defaults(),
			'screening_kicker'             => esc_html__( 'Kapcsolódó program', 'vitacenter-elementor-header' ),
			'screening_title'              => esc_html__( 'Mobil szűrés', 'vitacenter-elementor-header' ),
			'screening_subtitle'           => esc_html__( 'Helyben elérhető onkológiai szűrések a könnyebb hozzáférésért.', 'vitacenter-elementor-header' ),
			'screening_paragraphs'         => $this->screening_paragraph_defaults(),
			'screening_participants_label' => esc_html__( 'Tervezett résztvevők', 'vitacenter-elementor-header' ),
			'screening_participants_text'  => esc_html__( '1000 személy szűrése', 'vitacenter-elementor-header' ),
			'screening_location_label'     => esc_html__( 'Helyszínek / háziorvosok', 'vitacenter-elementor-header' ),
			'screening_location_text'      => esc_html__( '10 háziorvosnál, vidéki településeken', 'vitacenter-elementor-header' ),
			'screening_list_title'         => esc_html__( 'Biztosított onkológiai szűrések', 'vitacenter-elementor-header' ),
			'screening_items'              => $this->screening_item_defaults(),
			'message_kicker'               => esc_html__( 'Kiemelt üzenet', 'vitacenter-elementor-header' ),
			'message_title'                => esc_html__( 'Nem a beteg utazik, hanem a szolgáltatás kerül közelebb hozzá.', 'vitacenter-elementor-header' ),
			'message_text'                 => esc_html__( 'A program célja, hogy a szakellátás és a szűrés a vidéki közösségek számára is könnyebben elérhetővé váljon, különösen ott, ahol a hozzáférés ma korlátozott.', 'vitacenter-elementor-header' ),
			'useful_title'                 => esc_html__( 'Miért hasznos?', 'vitacenter-elementor-header' ),
			'useful_items'                 => $this->useful_defaults(),
			'contact_title'                => esc_html__( 'Kapcsolat', 'vitacenter-elementor-header' ),
			'phone'                        => '0742021316',
			'email'                        => 'info@nepegeszseg.hu',
			'hours'                        => esc_html__( 'H–P: 8:00 – 16:00', 'vitacenter-elementor-header' ),
			'contact_button_text'          => esc_html__( 'Érdeklődöm', 'vitacenter-elementor-header' ),
			'contact_button_link'          => array( 'url' => '#' ),
		);
	}

	private function quick_info_defaults() {
		return array(
			array( 'label' => esc_html__( 'Program neve', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Mobil szakorvosi szolgálat', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Típus', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Kihelyezett szakorvosi ellátás', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Megvalósítás helye', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Szatmár megye vidéki települései', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Bevont háziorvosok', 'vitacenter-elementor-header' ), 'value' => esc_html__( '10 háziorvos', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Vizsgálatok', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Kardiovaszkuláris és egyéb szakvizsgálatok', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Kapcsolódó program', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Mobil szűrés', 'vitacenter-elementor-header' ) ),
		);
	}

	private function intro_defaults() {
		return array(
			array( 'text' => esc_html__( 'Romániában köztudott az egészségügyi ellátáshoz (szakellátáshoz) való hozzáférés, igénybevétel óriási különbsége falusi és városi, főleg nagyvárosi összehasonlításban, a falvakon élők rovására.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'A mozgó szakorvosi szolgálat bevezetésének célja Szatmár megyében a szakorvosi ellátás közösséghez való közelebb vitele, mely által nem a beteg utazik, hanem a szolgáltatás kerül közelebb a beteghez.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Ezáltal lényegesen javulhat a város és a falu lakosainak egészségügyi ellátáshoz való hozzáférésének a különbsége, erősödhet a háziorvosi (családorvosi) rendelők és a járóbeteg szakrendelők szakmai kapcsolata, a hátrányos települések háziorvosi rendelői szintjén a szakmai munka színvonala, javulhat a háziorvosi tevékenység megelőzésben és ellátásban nyújtott szerepe, valamint a szakmai kapcsolat az alapellátás és a szakrendelői járóbeteg-ellátás között.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'A program hozzájárulhat a szakorvosi ellátáshoz való jobb hozzáféréshez, különösen a szociálisan hátrányos lakossági csoportok és az infrastrukturálisan izolált települések esetében, és hosszabb távon kedvezően hathat a lakosság morbiditási és mortalitási adataira is.', 'vitacenter-elementor-header' ) ),
		);
	}

	private function implementation_defaults() {
		return array(
			array( 'text' => esc_html__( 'A megye különböző vidéki településein 10 háziorvosnál a szakvizsgálatoknak megfelelő szakorvosok bevonásával fognak kardiovaszkuláris és egyéb vizsgálatokat végezni.', 'vitacenter-elementor-header' ) ),
		);
	}

	private function benefit_defaults() {
		return array(
			array( 'text' => esc_html__( 'A szolgáltatás közelebb kerül a beteghez', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Csökkenhet a falusi és városi ellátás közötti különbség', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Erősödhet a háziorvosok és a szakrendelők szakmai együttműködése', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Javulhat a megelőzés és az alapellátás szerepe', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Nőhet a hozzáférés a szakorvosi ellátáshoz', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Segítheti a hátrányos helyzetű lakosságot és az izolált településeket', 'vitacenter-elementor-header' ) ),
		);
	}

	private function screening_paragraph_defaults() {
		return array(
			array( 'text' => esc_html__( 'A mozgó szűrőakció bevezetésének célja Szatmár megyében a korai szűrés fontosságának tudatosítása és a vidéki közösséghez való közelebb vitele, mely által nem a beteg utazik, hanem a szolgáltatás kerül közelebb a beteghez.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( '1000 személy szűrése tervezett, 10 háziorvosnál a megye különböző vidéki településein.', 'vitacenter-elementor-header' ) ),
		);
	}

	private function screening_item_defaults() {
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
			array( 'text' => esc_html__( 'Javítja a hozzáférést a szakellátáshoz', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Támogatja a megelőzést és a korai felismerést', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Segíti a vidéki lakosság egészségvédelmét', 'vitacenter-elementor-header' ) ),
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

		if ( in_array( $text, array( '+36 30 123 4567', '+40 261 713 775', '+40 744 920 xxx' ), true ) ) {
			$text = '0742021316';
		}

		if ( '' === $text ) {
			return;
		}
		?>
		<div><?php echo esc_html( $text ); ?></div>
		<?php
	}

	private function render_specialist_button( $text, $link, $class ) {
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
