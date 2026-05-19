<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Repeater;

class VitaCenter_Ciklusoktatas_Widget extends VitaCenter_Structured_Widget_Base {
	public function get_name() { return 'vitacenter_ciklusoktatas'; }
	public function get_title() { return esc_html__( 'VitaCenter Ciklusoktatás', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-user-preferences'; }
	public function get_style_depends() { return array( 'vc-landing' ); }
	public function get_script_depends() { return array( 'vc-landing' ); }

	protected function register_controls() {
		$this->start_controls_section( 'hero_section', array( 'label' => esc_html__( 'Hero', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'breadcrumb', array( 'label' => esc_html__( 'Morzsa navigáció', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Főoldal / Programok / Ciklusoktatás', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => esc_html__( 'Kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Programok', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Ciklusoktatás', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'subtitle', array( 'label' => esc_html__( 'Alcím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Nőknek szóló termékenységtudatosság', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'primary_text', array( 'label' => esc_html__( 'Első gomb felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'További információ', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'primary_link', array( 'label' => esc_html__( 'Első gomb link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#kapcsolat' ) ) );
		$this->add_control( 'secondary_text', array( 'label' => esc_html__( 'Második gomb felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Témák megtekintése', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'secondary_link', array( 'label' => esc_html__( 'Második gomb link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#temak' ) ) );
		$this->add_control( 'visual_kicker', array( 'label' => esc_html__( 'Vizuál kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Tudatos női egészség', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_title', array( 'label' => esc_html__( 'Vizuál cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Ismeret, cikluskövetés, felelős döntés', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_text', array( 'label' => esc_html__( 'Vizuál szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Termékenységtudatosság és egészségügyi nevelés fiatal lányoknak és nőknek.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_stat_one_value', array( 'label' => esc_html__( 'Első stat érték', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( '8–12.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_stat_one_label', array( 'label' => esc_html__( 'Első stat címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'osztály', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_stat_two_value', array( 'label' => esc_html__( 'Második stat érték', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'EFI', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_stat_two_label', array( 'label' => esc_html__( 'Második stat címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'iroda', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_stat_three_value', array( 'label' => esc_html__( 'Harmadik stat érték', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( '∞', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_stat_three_label', array( 'label' => esc_html__( 'Harmadik stat címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'tudás', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'quick_info_section', array( 'label' => esc_html__( 'Gyors információk', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'quick_info_title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Gyors információk', 'vitacenter-elementor-header' ) ) );
		$quick = new Repeater();
		$quick->add_control( 'label', array( 'label' => esc_html__( 'Címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Program neve', 'vitacenter-elementor-header' ) ) );
		$quick->add_control( 'value', array( 'label' => esc_html__( 'Érték', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Ciklusoktatás', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'quick_info', array(
			'label' => esc_html__( 'Információk', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $quick->get_controls(),
			'title_field' => '{{{ label }}}',
			'default' => $this->quick_info_defaults(),
		) );
		$this->end_controls_section();

		$this->start_controls_section( 'content_section', array( 'label' => esc_html__( 'Fő tartalom', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'intro_title', array( 'label' => esc_html__( 'Első blokk cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'A programról', 'vitacenter-elementor-header' ) ) );
		$intro = new Repeater();
		$intro->add_control( 'text', array( 'label' => esc_html__( 'Bekezdés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Szöveg.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'intro', array(
			'label' => esc_html__( 'Programról bekezdések', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $intro->get_controls(),
			'title_field' => '{{{ text }}}',
			'default' => $this->intro_defaults(),
		) );
		$this->add_control( 'importance_title', array( 'label' => esc_html__( 'Fontosság cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Miért fontos?', 'vitacenter-elementor-header' ) ) );
		$importance = new Repeater();
		$importance->add_control( 'text', array( 'label' => esc_html__( 'Elem', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Fontos elem.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'importance', array(
			'label' => esc_html__( 'Fontossági elemek', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $importance->get_controls(),
			'title_field' => '{{{ text }}}',
			'default' => $this->importance_defaults(),
		) );
		$this->end_controls_section();

		$this->start_controls_section( 'topics_section', array( 'label' => esc_html__( 'Oktatási tartalom', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'topics_kicker', array( 'label' => esc_html__( 'Kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Oktatási tartalom', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'topics_title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Cikluskövetési módszerek és termékenységtudatosság', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'topics_subtitle', array( 'label' => esc_html__( 'Alcím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A foglalkozások célja, hogy érthető, biztonságos és életkornak megfelelő tudást adjanak a női ciklusról, a termékenységről és az egészségtudatos döntésekről.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'topics_list_title', array( 'label' => esc_html__( 'Lista cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Érintett fő témák', 'vitacenter-elementor-header' ) ) );
		$topics = new Repeater();
		$topics->add_control( 'text', array( 'label' => esc_html__( 'Téma', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Téma', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'topics', array(
			'label' => esc_html__( 'Témák', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $topics->get_controls(),
			'title_field' => '{{{ text }}}',
			'default' => $this->topic_defaults(),
		) );
		$this->add_control( 'primary_metric_label', array( 'label' => esc_html__( 'Első kártya jelölés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( '8–12', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'primary_metric_title', array( 'label' => esc_html__( 'Első kártya cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kiemelt célcsoport', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'primary_metric_text', array( 'label' => esc_html__( 'Első kártya szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( '8–12. osztályos lányok', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'secondary_metric_label', array( 'label' => esc_html__( 'Második kártya jelölés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'EFI', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'secondary_metric_title', array( 'label' => esc_html__( 'Második kártya cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'További jelentkezők', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'secondary_metric_text', array( 'label' => esc_html__( 'Második kártya szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Egészségfejlesztési Irodába érkező érdeklődők', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'message_section', array( 'label' => esc_html__( 'Kiemelt üzenet', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'message_kicker', array( 'label' => esc_html__( 'Kiemelt kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kiemelt üzenet', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'message_title', array( 'label' => esc_html__( 'Kiemelt cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A tudás segít megérteni a test működését és támogatja a felelős döntéseket.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'message_text', array( 'label' => esc_html__( 'Kiemelt szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A ciklusoktatás célja, hogy a lányok és nők ne információhiányból, hanem hiteles tudás birtokában tudjanak dönteni saját egészségükről és termékenységükről.', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'sidebar_section', array( 'label' => esc_html__( 'Oldalsáv', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'useful_title', array( 'label' => esc_html__( 'Ajánlás cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kinek ajánlott?', 'vitacenter-elementor-header' ) ) );
		$useful = new Repeater();
		$useful->add_control( 'text', array( 'label' => esc_html__( 'Elem', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Célcsoport', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'useful_items', array(
			'label' => esc_html__( 'Ajánlott célcsoportok', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $useful->get_controls(),
			'title_field' => '{{{ text }}}',
			'default' => $this->useful_defaults(),
		) );
		$this->add_control( 'contact_title', array( 'label' => esc_html__( 'Kapcsolat cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kapcsolat', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'phone', array( 'label' => esc_html__( 'Telefon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '+36 30 123 4567' ) );
		$this->add_control( 'email', array( 'label' => esc_html__( 'E-mail', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => 'info@nepegeszseg.hu' ) );
		$this->add_control( 'hours', array( 'label' => esc_html__( 'Nyitvatartás', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'H–P: 8:00 – 16:00', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'contact_button_text', array( 'label' => esc_html__( 'Kapcsolat gomb', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Érdeklődöm', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'contact_button_link', array( 'label' => esc_html__( 'Kapcsolat link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = wp_parse_args( $this->get_settings_for_display(), $this->defaults() );

		$quick_info   = $this->items_or_default( $s, 'quick_info', $this->quick_info_defaults() );
		$intro        = $this->items_or_default( $s, 'intro', $this->intro_defaults() );
		$importance   = $this->items_or_default( $s, 'importance', $this->importance_defaults() );
		$topics       = $this->items_or_default( $s, 'topics', $this->topic_defaults() );
		$useful_items = $this->items_or_default( $s, 'useful_items', $this->useful_defaults() );
		?>
		<div class="vc-landing">
			<section id="ciklusoktatas" class="vc-mobile-specialist vc-cycle-education">
				<div class="vc-mobile-specialist__hero">
					<div class="vc-mobile-specialist__container vc-mobile-specialist__hero-grid">
						<div class="vc-mobile-specialist__hero-copy">
							<?php $this->render_breadcrumb( $s['breadcrumb'] ); ?>
							<?php if ( ! empty( $s['eyebrow'] ) ) : ?><span class="vc-mobile-specialist__eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></span><?php endif; ?>
							<h1><?php echo $this->format_multiline( $s['title'] ); ?></h1>
							<p><?php echo esc_html( $s['subtitle'] ); ?></p>
							<div class="vc-mobile-specialist__actions">
								<?php $this->render_cycle_button( $s['primary_text'], $s['primary_link'], 'vc-mobile-specialist__button vc-mobile-specialist__button--primary' ); ?>
								<?php $this->render_cycle_button( $s['secondary_text'], $s['secondary_link'], 'vc-mobile-specialist__button vc-mobile-specialist__button--secondary' ); ?>
							</div>
						</div>

						<div class="vc-mobile-specialist__visual" aria-label="<?php echo esc_attr__( 'Ciklusoktatás összefoglaló', 'vitacenter-elementor-header' ); ?>">
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

						<section id="temak" class="vc-mobile-specialist__screening">
							<?php if ( ! empty( $s['topics_kicker'] ) ) : ?><span class="vc-mobile-specialist__kicker"><?php echo esc_html( $s['topics_kicker'] ); ?></span><?php endif; ?>
							<h2><?php echo esc_html( $s['topics_title'] ); ?></h2>
							<p class="vc-mobile-specialist__screening-subtitle"><?php echo esc_html( $s['topics_subtitle'] ); ?></p>
							<div class="vc-mobile-specialist__screening-list">
								<h3><?php echo esc_html( $s['topics_list_title'] ); ?></h3>
								<?php $this->render_bullet_list( $topics ); ?>
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
							<?php $this->render_cycle_button( $s['contact_button_text'], $s['contact_button_link'], 'vc-mobile-specialist__button vc-mobile-specialist__button--primary vc-mobile-specialist__button--full' ); ?>
						</div>
					</aside>
				</div>
			</section>
		</div>
		<?php
	}

	private function defaults() {
		return array(
			'breadcrumb'                  => esc_html__( 'Főoldal / Programok / Ciklusoktatás', 'vitacenter-elementor-header' ),
			'eyebrow'                     => esc_html__( 'Programok', 'vitacenter-elementor-header' ),
			'title'                       => esc_html__( 'Ciklusoktatás', 'vitacenter-elementor-header' ),
			'subtitle'                    => esc_html__( 'Nőknek szóló termékenységtudatosság', 'vitacenter-elementor-header' ),
			'primary_text'                => esc_html__( 'További információ', 'vitacenter-elementor-header' ),
			'primary_link'                => array( 'url' => '#kapcsolat' ),
			'secondary_text'              => esc_html__( 'Témák megtekintése', 'vitacenter-elementor-header' ),
			'secondary_link'              => array( 'url' => '#temak' ),
			'visual_kicker'               => esc_html__( 'Tudatos női egészség', 'vitacenter-elementor-header' ),
			'visual_title'                => esc_html__( 'Ismeret, cikluskövetés, felelős döntés', 'vitacenter-elementor-header' ),
			'visual_text'                 => esc_html__( 'Termékenységtudatosság és egészségügyi nevelés fiatal lányoknak és nőknek.', 'vitacenter-elementor-header' ),
			'visual_stat_one_value'       => esc_html__( '8–12.', 'vitacenter-elementor-header' ),
			'visual_stat_one_label'       => esc_html__( 'osztály', 'vitacenter-elementor-header' ),
			'visual_stat_two_value'       => esc_html__( 'EFI', 'vitacenter-elementor-header' ),
			'visual_stat_two_label'       => esc_html__( 'iroda', 'vitacenter-elementor-header' ),
			'visual_stat_three_value'     => esc_html__( '∞', 'vitacenter-elementor-header' ),
			'visual_stat_three_label'     => esc_html__( 'tudás', 'vitacenter-elementor-header' ),
			'quick_info_title'            => esc_html__( 'Gyors információk', 'vitacenter-elementor-header' ),
			'quick_info'                  => $this->quick_info_defaults(),
			'intro_title'                 => esc_html__( 'A programról', 'vitacenter-elementor-header' ),
			'intro'                       => $this->intro_defaults(),
			'importance_title'            => esc_html__( 'Miért fontos?', 'vitacenter-elementor-header' ),
			'importance'                  => $this->importance_defaults(),
			'topics_kicker'               => esc_html__( 'Oktatási tartalom', 'vitacenter-elementor-header' ),
			'topics_title'                => esc_html__( 'Cikluskövetési módszerek és termékenységtudatosság', 'vitacenter-elementor-header' ),
			'topics_subtitle'             => esc_html__( 'A foglalkozások célja, hogy érthető, biztonságos és életkornak megfelelő tudást adjanak a női ciklusról, a termékenységről és az egészségtudatos döntésekről.', 'vitacenter-elementor-header' ),
			'topics_list_title'           => esc_html__( 'Érintett fő témák', 'vitacenter-elementor-header' ),
			'topics'                      => $this->topic_defaults(),
			'primary_metric_label'        => esc_html__( '8–12', 'vitacenter-elementor-header' ),
			'primary_metric_title'        => esc_html__( 'Kiemelt célcsoport', 'vitacenter-elementor-header' ),
			'primary_metric_text'         => esc_html__( '8–12. osztályos lányok', 'vitacenter-elementor-header' ),
			'secondary_metric_label'      => esc_html__( 'EFI', 'vitacenter-elementor-header' ),
			'secondary_metric_title'      => esc_html__( 'További jelentkezők', 'vitacenter-elementor-header' ),
			'secondary_metric_text'       => esc_html__( 'Egészségfejlesztési Irodába érkező érdeklődők', 'vitacenter-elementor-header' ),
			'message_kicker'              => esc_html__( 'Kiemelt üzenet', 'vitacenter-elementor-header' ),
			'message_title'               => esc_html__( 'A tudás segít megérteni a test működését és támogatja a felelős döntéseket.', 'vitacenter-elementor-header' ),
			'message_text'                => esc_html__( 'A ciklusoktatás célja, hogy a lányok és nők ne információhiányból, hanem hiteles tudás birtokában tudjanak dönteni saját egészségükről és termékenységükről.', 'vitacenter-elementor-header' ),
			'useful_title'                => esc_html__( 'Kinek ajánlott?', 'vitacenter-elementor-header' ),
			'useful_items'                => $this->useful_defaults(),
			'contact_title'               => esc_html__( 'Kapcsolat', 'vitacenter-elementor-header' ),
			'phone'                       => '+36 30 123 4567',
			'email'                       => 'info@nepegeszseg.hu',
			'hours'                       => esc_html__( 'H–P: 8:00 – 16:00', 'vitacenter-elementor-header' ),
			'contact_button_text'         => esc_html__( 'Érdeklődöm', 'vitacenter-elementor-header' ),
			'contact_button_link'         => array( 'url' => '#' ),
		);
	}

	private function quick_info_defaults() {
		return array(
			array( 'label' => esc_html__( 'Program neve', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Ciklusoktatás', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Téma', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Termékenységtudatosság', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Célcsoport', 'vitacenter-elementor-header' ), 'value' => esc_html__( '8–12. osztályos lányok és érdeklődő nők', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Helyszín', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Közoktatási intézmények és Egészségfejlesztési Iroda', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Fókusz', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Cikluskövetés és egészségügyi nevelés', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Cél', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Tudásátadás és felelős döntéshozatal támogatása', 'vitacenter-elementor-header' ) ),
		);
	}

	private function intro_defaults() {
		return array(
			array( 'text' => esc_html__( 'Az abortuszok száma Romániában is rendkívül magas. Az elhagyott újszülöttek aránya és az Európai Unió országai között vezető helyet foglalunk el a gyermekhalandóság területén.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Mindemellett nő a koraszülések száma, aggasztóan emelkedett a házaspárok sterilitás aránya, mely összefügg a késői gyerekvállalással is. 30 éves kor felett sokszorosára nő a veleszületett rendellenességek aránya.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Ugyanakkor hiányos az egészségügyi nevelés, magas a nem kívánt terhességek aránya, valamint rendkívül magas a művi abortuszok száma. Mindez összefüggésben áll a nemi érés és a nemi élet fiziológiai ismereteinek hiányával.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Mindezen okok miatt fontos a megfelelő cikluskövetés-oktatás és tudásátadás a megye közoktatási intézményeiben, főként a 8–12. osztályos lányok körében, illetve az Egészségfejlesztési Irodába jelentkezőknél, ahol cikluskövetési módszereket sajátíthatnak el a termékenységtudatosság jegyében.', 'vitacenter-elementor-header' ) ),
		);
	}

	private function importance_defaults() {
		return array(
			array( 'text' => esc_html__( 'A fiatal lányok és nők hiteles, érthető információkat kapnak saját testük működéséről.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'A cikluskövetés segíti a termékenységtudatosság kialakítását.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Az oktatás hozzájárulhat a felelősebb döntéshozatalhoz.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'A program támogatja az egészségügyi nevelést és a prevenciót.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'A tudásátadás segíthet csökkenteni a tévhiteket és az információhiányt.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Az Egészségfejlesztési Irodába jelentkezők személyre szabottabb támogatást kaphatnak.', 'vitacenter-elementor-header' ) ),
		);
	}

	private function topic_defaults() {
		return array(
			array( 'text' => esc_html__( 'A női ciklus alapvető működésének megismerése', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Termékenységtudatosság és cikluskövetési módszerek', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'A nemi érés és a női egészség fiziológiai alapjai', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'A felelős döntésekhez szükséges egészségügyi ismeretek', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'A prevenció és az egészségmegőrzés fontossága', 'vitacenter-elementor-header' ) ),
		);
	}

	private function useful_defaults() {
		return array(
			array( 'text' => esc_html__( '8–12. osztályos lányoknak', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Termékenységtudatosság iránt érdeklődő nőknek', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Egészségfejlesztési Irodába jelentkezőknek', 'vitacenter-elementor-header' ) ),
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

	private function render_cycle_button( $text, $link, $class ) {
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
