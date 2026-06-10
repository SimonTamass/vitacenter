<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Repeater;

class VitaCenter_Eletmodtanacsadas_Widget extends VitaCenter_Structured_Widget_Base {
	public function get_name() { return 'vitacenter_eletmodtanacsadas'; }
	public function get_title() { return esc_html__( 'VitaCenter Életmódtanácsadás', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-kit-details'; }
	public function get_style_depends() { return array( 'vc-landing' ); }
	public function get_script_depends() { return array( 'vc-landing' ); }

	protected function register_controls() {
		$this->start_controls_section( 'hero_section', array( 'label' => esc_html__( 'Hero', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'breadcrumb', array( 'label' => esc_html__( 'Morzsa navigáció', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Főoldal / Programok / Életmódtanácsadás', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => esc_html__( 'Kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Programok', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Életmódtanácsadás', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'subtitle', array( 'label' => esc_html__( 'Alcím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Személyre szabott támogatás az egészséges életvitel kialakításához.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'primary_text', array( 'label' => esc_html__( 'Első gomb felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'További információ', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'primary_link', array( 'label' => esc_html__( 'Első gomb link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#kapcsolat' ) ) );
		$this->add_control( 'secondary_text', array( 'label' => esc_html__( 'Második gomb felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Tanácsadási területek', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'secondary_link', array( 'label' => esc_html__( 'Második gomb link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#szolgaltatasok' ) ) );
		$this->add_control( 'visual_kicker', array( 'label' => esc_html__( 'Vizuál kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Személyre szabott támogatás', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_title', array( 'label' => esc_html__( 'Vizuál cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Egészségesebb mindennapok tudatos lépésekkel', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_text', array( 'label' => esc_html__( 'Vizuál szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Pszicho-szociális, táplálkozási és prevenciós tanácsadás egyéni egészségtervvel.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_stat_one_value', array( 'label' => esc_html__( 'Első stat érték', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'EFI', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_stat_one_label', array( 'label' => esc_html__( 'Első stat címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'iroda', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_stat_two_value', array( 'label' => esc_html__( 'Második stat érték', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( '1:1', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_stat_two_label', array( 'label' => esc_html__( 'Második stat címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'tanácsadás', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_stat_three_value', array( 'label' => esc_html__( 'Harmadik stat érték', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'P', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'visual_stat_three_label', array( 'label' => esc_html__( 'Harmadik stat címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'prevenció', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'quick_info_section', array( 'label' => esc_html__( 'Gyors információk', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'quick_info_title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Gyors információk', 'vitacenter-elementor-header' ) ) );
		$quick = new Repeater();
		$quick->add_control( 'label', array( 'label' => esc_html__( 'Címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Program neve', 'vitacenter-elementor-header' ) ) );
		$quick->add_control( 'value', array( 'label' => esc_html__( 'Érték', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Életmódtanácsadás', 'vitacenter-elementor-header' ) ) );
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

		$this->start_controls_section( 'services_section', array( 'label' => esc_html__( 'Tanácsadási területek', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'services_kicker', array( 'label' => esc_html__( 'Kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Tanácsadási területek', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'services_title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Egyéni egészségterv és prevenciós támogatás', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'services_subtitle', array( 'label' => esc_html__( 'Alcím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A tanácsadás célja, hogy az egészséges életmódra vágyók szakemberek segítségével, személyre szabott támogatással alakíthassák ki mindennapi szokásaikat.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'services_list_title', array( 'label' => esc_html__( 'Lista cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Elérhető támogatási formák', 'vitacenter-elementor-header' ) ) );
		$services = new Repeater();
		$services->add_control( 'text', array( 'label' => esc_html__( 'Szolgáltatás', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Szolgáltatás', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'services', array(
			'label' => esc_html__( 'Támogatási formák', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $services->get_controls(),
			'title_field' => '{{{ text }}}',
			'default' => $this->service_defaults(),
		) );
		$this->add_control( 'primary_metric_label', array( 'label' => esc_html__( 'Első kártya jelölés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Időpont', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'primary_metric_title', array( 'label' => esc_html__( 'Első kártya cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Időpont-egyeztetés', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'primary_metric_text', array( 'label' => esc_html__( 'Első kártya szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A tanácsadás előzetes egyeztetés alapján érhető el.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'secondary_metric_label', array( 'label' => esc_html__( 'Második kártya jelölés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( '1:1', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'secondary_metric_title', array( 'label' => esc_html__( 'Második kártya cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Személyre szabott terv', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'secondary_metric_text', array( 'label' => esc_html__( 'Második kártya szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Egyéni egészségterv és célzott prevenciós tanácsadás', 'vitacenter-elementor-header' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'message_section', array( 'label' => esc_html__( 'Kiemelt üzenet', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'message_kicker', array( 'label' => esc_html__( 'Kiemelt kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kiemelt üzenet', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'message_title', array( 'label' => esc_html__( 'Kiemelt cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Az egészséges életmód kialakítása könnyebb, ha szakmai támogatás kíséri.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'message_text', array( 'label' => esc_html__( 'Kiemelt szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Az életmódtanácsadás a felvilágosítás, az egészségnevelés és az egyéni támogatás eszközeivel segít abban, hogy a megelőzés és az egészségtudatos döntések a mindennapok részévé váljanak.', 'vitacenter-elementor-header' ) ) );
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
		$s = $this->normalize_appointment_copy( $s );

		$quick_info   = $this->items_or_default( $s, 'quick_info', $this->quick_info_defaults() );
		$quick_info   = $this->normalize_quick_info_items( $quick_info );
		$intro        = $this->items_or_default( $s, 'intro', $this->intro_defaults() );
		$intro        = $this->normalize_intro_items( $intro );
		$importance   = $this->items_or_default( $s, 'importance', $this->importance_defaults() );
		$services     = $this->items_or_default( $s, 'services', $this->service_defaults() );
		$useful_items = $this->items_or_default( $s, 'useful_items', $this->useful_defaults() );
		?>
		<div class="vc-landing">
			<section id="eletmodtanacsadas" class="vc-mobile-specialist vc-lifestyle-counseling">
				<div class="vc-mobile-specialist__hero">
					<div class="vc-mobile-specialist__container vc-mobile-specialist__hero-grid">
						<div class="vc-mobile-specialist__hero-copy">
							<?php $this->render_breadcrumb( $s['breadcrumb'] ); ?>
							<?php if ( ! empty( $s['eyebrow'] ) ) : ?><span class="vc-mobile-specialist__eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></span><?php endif; ?>
							<h1><?php echo $this->format_multiline( $s['title'] ); ?></h1>
							<p><?php echo esc_html( $s['subtitle'] ); ?></p>
							<div class="vc-mobile-specialist__actions">
								<?php $this->render_lifestyle_button( $s['primary_text'], $s['primary_link'], 'vc-mobile-specialist__button vc-mobile-specialist__button--primary' ); ?>
								<?php $this->render_lifestyle_button( $s['secondary_text'], $s['secondary_link'], 'vc-mobile-specialist__button vc-mobile-specialist__button--secondary' ); ?>
							</div>
						</div>

						<div class="vc-mobile-specialist__visual" aria-label="<?php echo esc_attr__( 'Életmódtanácsadás összefoglaló', 'vitacenter-elementor-header' ); ?>">
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
							<?php $this->render_lifestyle_button( $s['contact_button_text'], $s['contact_button_link'], 'vc-mobile-specialist__button vc-mobile-specialist__button--primary vc-mobile-specialist__button--full' ); ?>
						</div>
					</aside>
				</div>
			</section>
		</div>
		<?php
	}

	private function defaults() {
		return array(
			'breadcrumb'                  => esc_html__( 'Főoldal / Programok / Életmódtanácsadás', 'vitacenter-elementor-header' ),
			'eyebrow'                     => esc_html__( 'Programok', 'vitacenter-elementor-header' ),
			'title'                       => esc_html__( 'Életmódtanácsadás', 'vitacenter-elementor-header' ),
			'subtitle'                    => esc_html__( 'Személyre szabott támogatás az egészséges életvitel kialakításához.', 'vitacenter-elementor-header' ),
			'primary_text'                => esc_html__( 'További információ', 'vitacenter-elementor-header' ),
			'primary_link'                => array( 'url' => '#kapcsolat' ),
			'secondary_text'              => esc_html__( 'Tanácsadási területek', 'vitacenter-elementor-header' ),
			'secondary_link'              => array( 'url' => '#szolgaltatasok' ),
			'visual_kicker'               => esc_html__( 'Személyre szabott támogatás', 'vitacenter-elementor-header' ),
			'visual_title'                => esc_html__( 'Egészségesebb mindennapok tudatos lépésekkel', 'vitacenter-elementor-header' ),
			'visual_text'                 => esc_html__( 'Pszicho-szociális, táplálkozási és prevenciós tanácsadás egyéni egészségtervvel.', 'vitacenter-elementor-header' ),
			'visual_stat_one_value'       => esc_html__( 'EFI', 'vitacenter-elementor-header' ),
			'visual_stat_one_label'       => esc_html__( 'iroda', 'vitacenter-elementor-header' ),
			'visual_stat_two_value'       => esc_html__( '1:1', 'vitacenter-elementor-header' ),
			'visual_stat_two_label'       => esc_html__( 'tanácsadás', 'vitacenter-elementor-header' ),
			'visual_stat_three_value'     => esc_html__( 'P', 'vitacenter-elementor-header' ),
			'visual_stat_three_label'     => esc_html__( 'prevenció', 'vitacenter-elementor-header' ),
			'quick_info_title'            => esc_html__( 'Gyors információk', 'vitacenter-elementor-header' ),
			'quick_info'                  => $this->quick_info_defaults(),
			'intro_title'                 => esc_html__( 'A programról', 'vitacenter-elementor-header' ),
			'intro'                       => $this->intro_defaults(),
			'importance_title'            => esc_html__( 'Miért fontos?', 'vitacenter-elementor-header' ),
			'importance'                  => $this->importance_defaults(),
			'services_kicker'             => esc_html__( 'Tanácsadási területek', 'vitacenter-elementor-header' ),
			'services_title'              => esc_html__( 'Egyéni egészségterv és prevenciós támogatás', 'vitacenter-elementor-header' ),
			'services_subtitle'           => esc_html__( 'A tanácsadás célja, hogy az egészséges életmódra vágyók szakemberek segítségével, személyre szabott támogatással alakíthassák ki mindennapi szokásaikat.', 'vitacenter-elementor-header' ),
			'services_list_title'         => esc_html__( 'Elérhető támogatási formák', 'vitacenter-elementor-header' ),
			'services'                    => $this->service_defaults(),
			'primary_metric_label'        => esc_html__( 'Időpont', 'vitacenter-elementor-header' ),
			'primary_metric_title'        => esc_html__( 'Időpont-egyeztetés', 'vitacenter-elementor-header' ),
			'primary_metric_text'         => esc_html__( 'A tanácsadás előzetes egyeztetés alapján érhető el.', 'vitacenter-elementor-header' ),
			'secondary_metric_label'      => esc_html__( '1:1', 'vitacenter-elementor-header' ),
			'secondary_metric_title'      => esc_html__( 'Személyre szabott terv', 'vitacenter-elementor-header' ),
			'secondary_metric_text'       => esc_html__( 'Egyéni egészségterv és célzott prevenciós tanácsadás', 'vitacenter-elementor-header' ),
			'message_kicker'              => esc_html__( 'Kiemelt üzenet', 'vitacenter-elementor-header' ),
			'message_title'               => esc_html__( 'Az egészséges életmód kialakítása könnyebb, ha szakmai támogatás kíséri.', 'vitacenter-elementor-header' ),
			'message_text'                => esc_html__( 'Az életmódtanácsadás a felvilágosítás, az egészségnevelés és az egyéni támogatás eszközeivel segít abban, hogy a megelőzés és az egészségtudatos döntések a mindennapok részévé váljanak.', 'vitacenter-elementor-header' ),
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
			array( 'label' => esc_html__( 'Program neve', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Életmódtanácsadás', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Típus', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Egyéni és csoportos tanácsadás', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Fókusz', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Egészséges életmód és prevenció', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Időpont-egyeztetés', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Előzetes egyeztetés alapján', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Szakemberek', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Pszichológus, táplálkozási szakértő és más szakemberek', 'vitacenter-elementor-header' ) ),
			array( 'label' => esc_html__( 'Támogatás', 'vitacenter-elementor-header' ), 'value' => esc_html__( 'Egyéni egészségterv és prevenciós tanácsadás', 'vitacenter-elementor-header' ) ),
		);
	}

	private function intro_defaults() {
		return array(
			array( 'text' => esc_html__( 'Az Egészségfejlesztő Iroda keretén belül működő felvilágosító munka, kapcsolattartás és egészségnevelés célja egy tudatosabb, a megelőzést és az egészséges életmódot népszerűsítő tevékenység és szemléletmód meghonosítása.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'A központ figyelemfelkeltő rendezvényeinek, tájékoztató anyagainak, egészségfelmérési tevékenységeinek, valamint csoportos és egyéni tanácsadásának köszönhetően középtávon javulhatnak a lakosság morbiditási és mortalitási adatai.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Az egészségnevelési és tanácsadói iroda működtetése nagyban hozzájárulhat az egészséges életmód, a prevenció, a korai felismerés és a hatékony terápia megvalósításához.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Előzetes időpont-egyeztetés alapján különböző szakemberek, pszichológus, táplálkozási szakértő és más segítő szakemberek pszicho-szociális és táplálkozási tanácsadással, egyéni egészségtervvel, valamint prevenciós támogatással várják az egészséges életmódra vágyókat.', 'vitacenter-elementor-header' ) ),
		);
	}

	private function importance_defaults() {
		return array(
			array( 'text' => esc_html__( 'Támogatja az egészséges életmód kialakítását és fenntartását.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Erősíti a megelőzésre épülő szemléletmódot.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Segíti a lakosság egészségtudatos döntéseit.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Hozzájárulhat a korai felismerés és a hatékony terápia megvalósításához.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Egyéni és csoportos tanácsadással is támogatja az érdeklődőket.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Középtávon javíthatja a lakosság egészségi mutatóit.', 'vitacenter-elementor-header' ) ),
		);
	}

	private function service_defaults() {
		return array(
			array( 'text' => esc_html__( 'Pszicho-szociális tanácsadás', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Táplálkozási tanácsadás', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Egyéni egészségterv készítése', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Prevenciós támogatás', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Egészségfelmérési tevékenységek', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Csoportos és egyéni egészségnevelés', 'vitacenter-elementor-header' ) ),
		);
	}

	private function useful_defaults() {
		return array(
			array( 'text' => esc_html__( 'Egészségesebb életmódra vágyóknak', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Táplálkozási tanácsadás iránt érdeklődőknek', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Prevenciós támogatást kereső fiataloknak és felnőtteknek', 'vitacenter-elementor-header' ) ),
		);
	}

	private function normalize_appointment_copy( $settings ) {
		if ( '4h' === $this->plain_text( $settings['visual_stat_one_value'] ) && 'naponta' === $this->plain_text( $settings['visual_stat_one_label'] ) ) {
			$settings['visual_stat_one_value'] = esc_html__( 'EFI', 'vitacenter-elementor-header' );
			$settings['visual_stat_one_label'] = esc_html__( 'iroda', 'vitacenter-elementor-header' );
		}

		if ( '4h' === $this->plain_text( $settings['primary_metric_label'] ) ) {
			$settings['primary_metric_label'] = esc_html__( 'Időpont', 'vitacenter-elementor-header' );
		}

		if ( 'Napi elérhetőség' === $this->plain_text( $settings['primary_metric_title'] ) ) {
			$settings['primary_metric_title'] = esc_html__( 'Időpont-egyeztetés', 'vitacenter-elementor-header' );
		}

		if ( 'Napi 4 órában várják az egészséges életmódra vágyókat' === $this->plain_text( $settings['primary_metric_text'] ) ) {
			$settings['primary_metric_text'] = esc_html__( 'A tanácsadás előzetes egyeztetés alapján érhető el.', 'vitacenter-elementor-header' );
		}

		return $settings;
	}

	private function normalize_quick_info_items( $items ) {
		foreach ( $items as $index => $item ) {
			if ( ! is_array( $item ) ) {
				continue;
			}

			$label = isset( $item['label'] ) ? $this->plain_text( $item['label'] ) : '';
			$value = isset( $item['value'] ) ? $this->plain_text( $item['value'] ) : '';

			if ( 'Elérhetőség' === $label && 'Napi 4 órában' === $value ) {
				$items[ $index ]['label'] = esc_html__( 'Időpont-egyeztetés', 'vitacenter-elementor-header' );
				$items[ $index ]['value'] = esc_html__( 'Előzetes egyeztetés alapján', 'vitacenter-elementor-header' );
			}
		}

		return $items;
	}

	private function normalize_intro_items( $items ) {
		$old_text = esc_html__( 'Napi 4 órában különböző szakemberek, pszichológus, táplálkozási szakértő és más segítő szakemberek pszicho-szociális és táplálkozási tanácsadással, egyéni egészségtervvel, valamint prevenciós támogatással várják az egészséges életmódra vágyókat.', 'vitacenter-elementor-header' );
		$new_text = esc_html__( 'Előzetes időpont-egyeztetés alapján különböző szakemberek, pszichológus, táplálkozási szakértő és más segítő szakemberek pszicho-szociális és táplálkozási tanácsadással, egyéni egészségtervvel, valamint prevenciós támogatással várják az egészséges életmódra vágyókat.', 'vitacenter-elementor-header' );

		foreach ( $items as $index => $item ) {
			if ( ! is_array( $item ) || ! isset( $item['text'] ) ) {
				continue;
			}

			if ( $old_text === $this->plain_text( $item['text'] ) ) {
				$items[ $index ]['text'] = $new_text;
			}
		}

		return $items;
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

	private function render_lifestyle_button( $text, $link, $class ) {
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
