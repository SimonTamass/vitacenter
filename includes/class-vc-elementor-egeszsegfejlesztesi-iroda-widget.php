<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Repeater;

class VitaCenter_Egeszsegfejlesztesi_Iroda_Widget extends VitaCenter_Structured_Widget_Base {
	public function get_name() { return 'vitacenter_egeszsegfejlesztesi_iroda'; }
	public function get_title() { return esc_html__( 'VitaCenter Egészségfejlesztési Iroda', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-kit-details'; }
	public function get_style_depends() { return array( 'vc-landing' ); }
	public function get_script_depends() { return array( 'vc-landing' ); }

	protected function register_controls() {
		$this->start_controls_section( 'hero_section', array( 'label' => esc_html__( 'Hero', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'breadcrumb', array( 'label' => esc_html__( 'Morzsa navigáció', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Főoldal / Programok / Egészségfejlesztési Iroda', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => esc_html__( 'Kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Programok', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Egészségfejlesztési Iroda', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'subtitle', array( 'label' => esc_html__( 'Alcím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Az egészséges életmódot, a betegségmegelőzést és a szűrővizsgálatok jelentőségét népszerűsítő tevékenységek', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'primary_text', array( 'label' => esc_html__( 'Első gomb felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'További információ', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'primary_link', array( 'label' => esc_html__( 'Első gomb link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#kapcsolat' ) ) );
		$this->add_control( 'secondary_text', array( 'label' => esc_html__( 'Második gomb felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Szolgáltatások megtekintése', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'secondary_link', array( 'label' => esc_html__( 'Második gomb link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#szolgaltatasok' ) ) );
		$this->add_control( 'visual_kicker', array( 'label' => esc_html__( 'Vizuál kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Prevenció és egészségnevelés', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_title', array( 'label' => esc_html__( 'Vizuál cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Egészségesebb életmód, tudatosabb döntések', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_text', array( 'label' => esc_html__( 'Vizuál szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Tanácsadás, szűrés, prevenció és szakmai támogatás szervezett formában.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_stat_one_value', array( 'label' => esc_html__( 'Első stat érték', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'EFI', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_stat_one_label', array( 'label' => esc_html__( 'Első stat címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'iroda', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_stat_two_value', array( 'label' => esc_html__( 'Második stat érték', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( '360°', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_stat_two_label', array( 'label' => esc_html__( 'Második stat címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'támogatás', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_stat_three_value', array( 'label' => esc_html__( 'Harmadik stat érték', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'P', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_stat_three_label', array( 'label' => esc_html__( 'Harmadik stat címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'prevenció', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'quick_info_section', array( 'label' => esc_html__( 'Gyors információk', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'quick_info_title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Gyors információk', 'vitacenter-elementor-header' ) ) );
		$quick = new Repeater();
		$quick->add_control( 'label', array( 'label' => esc_html__( 'Címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Program neve', 'vitacenter-elementor-header' ) ) );
		$quick->add_control( 'value', array( 'label' => esc_html__( 'Érték', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Egészségfejlesztési Iroda', 'vitacenter-elementor-header' ) ) );
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

		$this->start_controls_section( 'services_section', array( 'label' => esc_html__( 'Tevékenységek', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'services_kicker', array( 'label' => esc_html__( 'Kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Tevékenységek', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'services_title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Tanácsadás, prevenció és egészségfejlesztés egy helyen', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'services_subtitle', array( 'label' => esc_html__( 'Alcím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Az iroda célja, hogy szakemberek bevonásával, szervezett formában tegye elérhetővé az egészséges életmódot, a betegségmegelőzést és a szűrővizsgálatok fontosságát népszerűsítő szolgáltatásokat.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'services_list_title', array( 'label' => esc_html__( 'Lista cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Főbb szolgáltatási területek', 'vitacenter-elementor-header' ) ) );
		$services = new Repeater();
		$services->add_control( 'text', array( 'label' => esc_html__( 'Szolgáltatás', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Szolgáltatás', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'services', array(
			'label' => esc_html__( 'Szolgáltatások', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $services->get_controls(),
			'title_field' => '{{{ text }}}',
			'default' => $this->service_defaults(),
		) );
		$this->add_control( 'primary_metric_label', array( 'label' => esc_html__( 'Első kártya jelölés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'EFI', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'primary_metric_title', array( 'label' => esc_html__( 'Első kártya cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Hiánypótló iroda', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'primary_metric_text', array( 'label' => esc_html__( 'Első kártya szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Egyedülálló egészségügyi tanácsadói forma a régióban', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'secondary_metric_label', array( 'label' => esc_html__( 'Második kártya jelölés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( '+', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'secondary_metric_title', array( 'label' => esc_html__( 'Második kártya cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Széles körű támogatás', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'secondary_metric_text', array( 'label' => esc_html__( 'Második kártya szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Tanácsadástól a prevención át a rehabilitációig', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'message_section', array( 'label' => esc_html__( 'Kiemelt üzenet', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'message_kicker', array( 'label' => esc_html__( 'Kiemelt kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kiemelt üzenet', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'message_title', array( 'label' => esc_html__( 'Kiemelt cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Az egészségfejlesztés akkor hatékony, ha szervezett, elérhető és közösségközeli.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'message_text', array( 'label' => esc_html__( 'Kiemelt szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Az Egészségfejlesztési Iroda célja, hogy a lakosság ne csak akkor találkozzon az egészségügyi ellátással, amikor már kialakult a probléma, hanem időben, a megelőzés és a tudatos életmód szintjén kapjon támogatást.', 'vitacenter-elementor-header' ) ) );
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
		$this->add_control( 'phone', array( 'label' => esc_html__( 'Telefon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '0742021316' ) );
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
		$services     = $this->items_or_default( $s, 'services', $this->service_defaults() );
		$useful_items = $this->items_or_default( $s, 'useful_items', $this->useful_defaults() );
		?>
		<div class="vc-landing">
			<section id="egeszsegfejlesztesi-iroda" class="vc-mobile-specialist vc-health-development-office">
				<div class="vc-mobile-specialist__hero">
					<div class="vc-mobile-specialist__container vc-mobile-specialist__hero-grid">
						<div class="vc-mobile-specialist__hero-copy">
							<?php $this->render_breadcrumb( $s['breadcrumb'] ); ?>
							<?php if ( ! empty( $s['eyebrow'] ) ) : ?><span class="vc-mobile-specialist__eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></span><?php endif; ?>
							<h1><?php echo $this->format_multiline( $s['title'] ); ?></h1>
							<p><?php echo esc_html( $s['subtitle'] ); ?></p>
							<div class="vc-mobile-specialist__actions">
								<?php $this->render_office_button( $s['primary_text'], $s['primary_link'], 'vc-mobile-specialist__button vc-mobile-specialist__button--primary' ); ?>
								<?php $this->render_office_button( $s['secondary_text'], $s['secondary_link'], 'vc-mobile-specialist__button vc-mobile-specialist__button--secondary' ); ?>
							</div>
						</div>

						<div class="vc-mobile-specialist__visual" aria-label="<?php echo esc_attr__( 'Egészségfejlesztési Iroda összefoglaló', 'vitacenter-elementor-header' ); ?>">
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

						<section id="szolgaltatasok" class="vc-mobile-specialist__screening">
							<?php if ( ! empty( $s['services_kicker'] ) ) : ?><span class="vc-mobile-specialist__kicker"><?php echo esc_html( $s['services_kicker'] ); ?></span><?php endif; ?>
							<h2><?php echo esc_html( $s['services_title'] ); ?></h2>
							<p class="vc-mobile-specialist__screening-subtitle"><?php echo esc_html( $s['services_subtitle'] ); ?></p>
							<div class="vc-mobile-specialist__screening-list">
								<h3><?php echo esc_html( $s['services_list_title'] ); ?></h3>
								<?php $this->render_bullet_list( $services ); ?>
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
							<?php $this->render_office_button( $s['contact_button_text'], $s['contact_button_link'], 'vc-mobile-specialist__button vc-mobile-specialist__button--primary vc-mobile-specialist__button--full' ); ?>
						</div>
					</aside>
				</div>
			</section>
		</div>
		<?php
	}

	private function defaults() {
		return array(
			'breadcrumb'                  => esc_html__( 'Főoldal / Programok / Egészségfejlesztési Iroda', 'vitacenter-elementor-header' ),
			'eyebrow'                     => esc_html__( 'Programok', 'vitacenter-elementor-header' ),
			'title'                       => esc_html__( 'Egészségfejlesztési Iroda', 'vitacenter-elementor-header' ),
			'subtitle'                    => esc_html__( 'Az egészséges életmódot, a betegségmegelőzést és a szűrővizsgálatok jelentőségét népszerűsítő tevékenységek', 'vitacenter-elementor-header' ),
			'primary_text'                => esc_html__( 'További információ', 'vitacenter-elementor-header' ),
			'primary_link'                => array( 'url' => '#kapcsolat' ),
			'secondary_text'              => esc_html__( 'Szolgáltatások megtekintése', 'vitacenter-elementor-header' ),
			'secondary_link'              => array( 'url' => '#szolgaltatasok' ),
			'visual_kicker'               => esc_html__( 'Prevenció és egészségnevelés', 'vitacenter-elementor-header' ),
			'visual_title'                => esc_html__( 'Egészségesebb életmód, tudatosabb döntések', 'vitacenter-elementor-header' ),
			'visual_text'                 => esc_html__( 'Tanácsadás, szűrés, prevenció és szakmai támogatás szervezett formában.', 'vitacenter-elementor-header' ),
			'visual_stat_one_value'       => esc_html__( 'EFI', 'vitacenter-elementor-header' ),
			'visual_stat_one_label'       => esc_html__( 'iroda', 'vitacenter-elementor-header' ),
			'visual_stat_two_value'       => esc_html__( '360°', 'vitacenter-elementor-header' ),
			'visual_stat_two_label'       => esc_html__( 'támogatás', 'vitacenter-elementor-header' ),
			'visual_stat_three_value'     => esc_html__( 'P', 'vitacenter-elementor-header' ),
			'visual_stat_three_label'     => esc_html__( 'prevenció', 'vitacenter-elementor-header' ),
			'quick_info_title'            => esc_html__( 'Gyors információk', 'vitacenter-elementor-header' ),
			'quick_info'                  => $this->quick_info_defaults(),
			'intro_title'                 => esc_html__( 'A programról', 'vitacenter-elementor-header' ),
			'intro'                       => $this->intro_defaults(),
			'importance_title'            => esc_html__( 'Miért fontos?', 'vitacenter-elementor-header' ),
			'importance'                  => $this->importance_defaults(),
			'services_kicker'             => esc_html__( 'Tevékenységek', 'vitacenter-elementor-header' ),
			'services_title'              => esc_html__( 'Tanácsadás, prevenció és egészségfejlesztés egy helyen', 'vitacenter-elementor-header' ),
			'services_subtitle'           => esc_html__( 'Az iroda célja, hogy szakemberek bevonásával, szervezett formában tegye elérhetővé az egészséges életmódot, a betegségmegelőzést és a szűrővizsgálatok fontosságát népszerűsítő szolgáltatásokat.', 'vitacenter-elementor-header' ),
			'services_list_title'         => esc_html__( 'Főbb szolgáltatási területek', 'vitacenter-elementor-header' ),
			'services'                    => $this->service_defaults(),
			'primary_metric_label'        => esc_html__( 'EFI', 'vitacenter-elementor-header' ),
			'primary_metric_title'        => esc_html__( 'Hiánypótló iroda', 'vitacenter-elementor-header' ),
			'primary_metric_text'         => esc_html__( 'Egyedülálló egészségügyi tanácsadói forma a régióban', 'vitacenter-elementor-header' ),
			'secondary_metric_label'      => esc_html__( '+', 'vitacenter-elementor-header' ),
			'secondary_metric_title'      => esc_html__( 'Széles körű támogatás', 'vitacenter-elementor-header' ),
			'secondary_metric_text'       => esc_html__( 'Tanácsadástól a prevención át a rehabilitációig', 'vitacenter-elementor-header' ),
			'message_kicker'              => esc_html__( 'Kiemelt üzenet', 'vitacenter-elementor-header' ),
			'message_title'               => esc_html__( 'Az egészségfejlesztés akkor hatékony, ha szervezett, elérhető és közösségközeli.', 'vitacenter-elementor-header' ),
			'message_text'                => esc_html__( 'Az Egészségfejlesztési Iroda célja, hogy a lakosság ne csak akkor találkozzon az egészségügyi ellátással, amikor már kialakult a probléma, hanem időben, a megelőzés és a tudatos életmód szintjén kapjon támogatást.', 'vitacenter-elementor-header' ),
			'useful_title'                => esc_html__( 'Kinek ajánlott?', 'vitacenter-elementor-header' ),
			'useful_items'                => $this->useful_defaults(),
			'contact_title'               => esc_html__( 'Kapcsolat', 'vitacenter-elementor-header' ),
			'phone'                       => '0742021316',
			'email'                       => 'info@nepegeszseg.hu',
			'hours'                       => esc_html__( 'H–P: 8:00 – 16:00', 'vitacenter-elementor-header' ),
			'contact_button_text'         => esc_html__( 'Érdeklődöm', 'vitacenter-elementor-header' ),
			'contact_button_link'         => array( 'url' => '#' ),
		);
	}

	private function quick_info_defaults() {
		return array(
			array( 'label' => esc_html__( 'Program neve', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Egészségfejlesztési Iroda', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Típus', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Egészségügyi tanácsadói iroda', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Fókusz', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Egészséges életmód és prevenció', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Célcsoport', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Fiatalok és felnőttek', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Szolgáltatások', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Tanácsadás, prevenció, szűrések, rehabilitáció', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Cél', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Az alapellátás szerepének megerősítése', 'vitacenter-elementor-header' ) ),
		);
	}

	private function intro_defaults() {
		return array(
			array( 'text' => esc_html__( 'A megyében egyedülálló, hiánypótló egészségügyi tanácsadói iroda az alapellátás szerepének megerősítését tűzi ki egyik fő céljául.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Az egészséges életmódot, a betegségmegelőzést és a szűrővizsgálatok jelentőségét népszerűsítő tevékenység ilyen szervezett formában való működtetése ismeretlen régiónkban.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Az iroda szakemberek bevonásával az egyedi tanácsadástól, a prevención és szűréseken keresztül, a rehabilitációs és terápiás munkáig nyújt szolgáltatásokat.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Ugyanakkor fiatalok és felnőttek számára szervez népszerűsítő akciókat az egészséges életforma, a betegségeket megelőző életmód és a szűrővizsgálatokon való részvétel fontosságának erősítésére.', 'vitacenter-elementor-header' ) ),
		);
	}

	private function importance_defaults() {
		return array(
			array( 'text' => esc_html__( 'Erősíti az alapellátás szerepét a lakosság egészségvédelmében.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Szervezett formában népszerűsíti az egészséges életmódot.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Felhívja a figyelmet a betegségmegelőzés jelentőségére.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Támogatja a szűrővizsgálatokon való részvétel fontosságának tudatosítását.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Szakemberek bevonásával nyújt egyedi tanácsadást és támogatást.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Fiatalok és felnőttek számára is elérhető programokat és akciókat szervez.', 'vitacenter-elementor-header' ) ),
		);
	}

	private function service_defaults() {
		return array(
			array( 'text' => esc_html__( 'Egyedi egészségügyi és életmódtanácsadás', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Prevenciós és egészségnevelési tevékenységek', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Szűrővizsgálatok jelentőségének népszerűsítése', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Rehabilitációt támogató szolgáltatások', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Terápiás munkát segítő szakmai tevékenységek', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Fiataloknak és felnőtteknek szóló népszerűsítő akciók', 'vitacenter-elementor-header' ) ),
		);
	}

	private function useful_defaults() {
		return array(
			array( 'text' => esc_html__( 'Egészségesebb életmódra törekvő lakosoknak', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Prevenció iránt érdeklődő fiataloknak és felnőtteknek', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Szűrővizsgálatok fontosságáról tájékozódni vágyóknak', 'vitacenter-elementor-header' ) ),
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

	private function render_office_button( $text, $link, $class ) {
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
