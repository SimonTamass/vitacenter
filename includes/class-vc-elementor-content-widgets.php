<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Repeater;

class VitaCenter_Project_Content_Widget extends VitaCenter_Structured_Widget_Base {
	public function get_name() { return 'vitacenter_project_content'; }
	public function get_title() { return esc_html__( 'VitaCenter Project Content', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-document-file'; }
	public function get_style_depends() { return array( 'vc-landing' ); }
	public function get_script_depends() { return array( 'vc-landing' ); }

	protected function register_controls() {
		$this->start_controls_section( 'hero_section', array( 'label' => esc_html__( 'Projekt hero', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => esc_html__( 'Kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Projekt', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'period', array( 'label' => esc_html__( 'Projekt időszak', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( '2025.05.28. - 2027.11.27.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Népesedési folyamatok javítása helyi szinten egészségfejlesztési módszerekkel', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'intro', array( 'label' => esc_html__( 'Hero szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A projekt célja, hogy Szatmár megye lakosságának egészségi állapotát, prevenciós lehetőségeit és az egészségügyi szolgáltatásokhoz való hozzáférését javítsa.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'primary_text', array( 'label' => esc_html__( 'Első gomb felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Programok megtekintése', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'primary_link', array( 'label' => esc_html__( 'Első gomb link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#programok' ) ) );
		$this->add_control( 'secondary_text', array( 'label' => esc_html__( 'Második gomb felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Egyeztessen időpontot!', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'secondary_link', array( 'label' => esc_html__( 'Második gomb link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#kapcsolat' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'highlight_section', array( 'label' => esc_html__( 'Kiemelt számok', 'vitacenter-elementor-header' ) ) );
		$highlights = new Repeater();
		$highlights->add_control( 'icon', array( 'label' => esc_html__( 'Ikon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SELECT, 'default' => 'users', 'options' => $this->project_icon_options() ) );
		$highlights->add_control( 'number', array( 'label' => esc_html__( 'Szám', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '1000+' ) );
		$highlights->add_control( 'label', array( 'label' => esc_html__( 'Felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'résztvevő mobil szűréseken', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'highlights', array(
			'label' => esc_html__( 'Kiemelések', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $highlights->get_controls(),
			'title_field' => '{{{ number }}} {{{ label }}}',
			'default' => $this->project_highlight_defaults(),
		) );
		$this->end_controls_section();

		$this->start_controls_section( 'overview_section', array( 'label' => esc_html__( 'Áttekintés', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'overview_title', array( 'label' => esc_html__( 'Áttekintés cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'A projektről', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'overview_text', array( 'label' => esc_html__( 'Áttekintés szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A Szatmárnémeti Egészségfejlesztési Iroda a prevenció, az esélyegyenlőség és a család- és közösségalapú ellátás erősítésére épül.', 'vitacenter-elementor-header' ) ) );
		$overview = new Repeater();
		$overview->add_control( 'text', array( 'label' => esc_html__( 'Elem', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Egészségügyi hozzáférés', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'overview_items', array(
			'label' => esc_html__( 'Áttekintés elemek', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $overview->get_controls(),
			'title_field' => '{{{ text }}}',
			'default' => $this->project_overview_defaults(),
		) );
		$this->end_controls_section();

		$this->start_controls_section( 'content_section', array( 'label' => esc_html__( 'Projektbemutató', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'content_title', array( 'label' => esc_html__( 'Tartalmi cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Projektbemutató', 'vitacenter-elementor-header' ) ) );
		$paragraphs = new Repeater();
		$paragraphs->add_control( 'text', array( 'label' => esc_html__( 'Bekezdés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Projekt szöveg.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'paragraphs', array(
			'label' => esc_html__( 'Bekezdések', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $paragraphs->get_controls(),
			'title_field' => '{{{ text }}}',
			'default' => $this->project_paragraph_defaults(),
		) );
		$this->end_controls_section();

		$this->start_controls_section( 'goals_section', array( 'label' => esc_html__( 'Projekt céljai', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'goals_title', array( 'label' => esc_html__( 'Célok cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'A projekt céljai', 'vitacenter-elementor-header' ) ) );
		$goals = new Repeater();
		$goals->add_control( 'text', array( 'label' => esc_html__( 'Cél', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Projektcél', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'goals', array(
			'label' => esc_html__( 'Célok', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $goals->get_controls(),
			'title_field' => '{{{ text }}}',
			'default' => $this->project_goal_defaults(),
		) );
		$this->end_controls_section();

		$this->start_controls_section( 'programs_section', array( 'label' => esc_html__( 'Programkártyák', 'vitacenter-elementor-header' ) ) );
		$programs = new Repeater();
		$programs->add_control( 'icon', array( 'label' => esc_html__( 'Ikon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::SELECT, 'default' => 'heart-pulse', 'options' => $this->project_icon_options() ) );
		$programs->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Program', 'vitacenter-elementor-header' ) ) );
		$programs->add_control( 'text', array( 'label' => esc_html__( 'Leírás', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Programleírás.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'program_cards', array(
			'label' => esc_html__( 'Programkártyák', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $programs->get_controls(),
			'title_field' => '{{{ title }}}',
			'default' => $this->project_program_defaults(),
		) );
		$this->end_controls_section();

		$this->start_controls_section( 'strategy_section', array( 'label' => esc_html__( 'Stratégiai üzenetek', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'strategy_title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Esélyegyenlőség. Prevenció. Életerős közösségek.', 'vitacenter-elementor-header' ) ) );
		$messages = new Repeater();
		$messages->add_control( 'text', array( 'label' => esc_html__( 'Üzenet', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Stratégiai üzenet', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'messages', array(
			'label' => esc_html__( 'Üzenetek', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $messages->get_controls(),
			'title_field' => '{{{ text }}}',
			'default' => $this->project_message_defaults(),
		) );
		$this->add_control( 'strategy_button_text', array( 'label' => esc_html__( 'Gomb felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kapcsolatfelvétel', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'strategy_button_link', array( 'label' => esc_html__( 'Gomb link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#kapcsolat' ) ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = wp_parse_args( $this->get_settings_for_display(), $this->project_defaults() );

		$highlights     = $this->project_items_or_default( $s, 'highlights', $this->project_highlight_defaults() );
		$overview_items = $this->project_items_or_default( $s, 'overview_items', $this->project_overview_defaults() );
		$paragraphs     = $this->project_items_or_default( $s, 'paragraphs', $this->project_paragraph_defaults() );
		$goals          = $this->project_items_or_default( $s, 'goals', $this->project_goal_defaults() );
		$program_cards  = $this->project_items_or_default( $s, 'program_cards', $this->project_program_defaults() );
		$messages       = $this->project_items_or_default( $s, 'messages', $this->project_message_defaults() );
		?>
		<div class="vc-landing">
			<section id="projekt" class="vc-project-page">
				<div class="vc-project-page__hero">
					<div class="vc-landing__container vc-project-page__hero-grid">
						<div class="vc-project-page__hero-copy">
							<?php if ( ! empty( $s['period'] ) ) : ?>
								<div class="vc-project-page__period">
									<?php $this->render_project_icon( 'calendar' ); ?>
									<span><?php echo esc_html( $s['period'] ); ?></span>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $s['eyebrow'] ) ) : ?><span class="vc-project-page__eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></span><?php endif; ?>
							<h1><?php echo $this->format_multiline( $s['title'] ); ?></h1>
							<p><?php echo esc_html( $s['intro'] ); ?></p>
							<div class="vc-project-page__actions">
								<?php $this->render_project_button( $s['primary_text'], $s['primary_link'], 'vc-project-page__button vc-project-page__button--primary' ); ?>
								<?php $this->render_project_button( $s['secondary_text'], $s['secondary_link'], 'vc-project-page__button vc-project-page__button--secondary', false ); ?>
							</div>
						</div>

						<div class="vc-project-page__visual" aria-label="<?php echo esc_attr__( 'Projekt összefoglaló', 'vitacenter-elementor-header' ); ?>">
							<div class="vc-project-page__visual-body">
								<div class="vc-project-page__visual-top">
									<span class="vc-project-page__visual-icon"><?php $this->render_project_icon( 'map-pin' ); ?></span>
									<span class="vc-project-page__location"><?php echo esc_html__( 'Szatmár megye', 'vitacenter-elementor-header' ); ?></span>
								</div>
								<h2><?php echo esc_html__( 'Egészség közelebb a közösségekhez', 'vitacenter-elementor-header' ); ?></h2>
								<p><?php echo esc_html__( 'Mobil szűrések, tanácsadások, oktatási programok és közösségalapú egészségfejlesztés egy integrált projekt keretében.', 'vitacenter-elementor-header' ); ?></p>
								<div class="vc-project-page__visual-meta">
									<span><strong>4.5</strong><?php echo esc_html__( 'egyedi célkitűzés', 'vitacenter-elementor-header' ); ?></span>
									<span><strong>VI-A</strong><?php echo esc_html__( 'Interreg program', 'vitacenter-elementor-header' ); ?></span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="vc-landing__container">
					<div class="vc-project-page__highlights">
						<?php foreach ( $highlights as $index => $item ) : ?>
							<?php
							$icon   = ! empty( $item['icon'] ) ? $this->plain_text( $item['icon'] ) : $this->project_default_highlight_icon( $index );
							$number = isset( $item['number'] ) ? $this->plain_text( $item['number'] ) : '';
							$label  = isset( $item['label'] ) ? $this->plain_text( $item['label'] ) : '';
							if ( '' === $number && '' === $label ) {
								continue;
							}
							?>
							<div class="vc-project-page__highlight">
								<span class="vc-project-page__highlight-icon"><?php $this->render_project_icon( $icon ); ?></span>
								<?php if ( '' !== $number ) : ?><strong><?php echo esc_html( $number ); ?></strong><?php endif; ?>
								<?php if ( '' !== $label ) : ?><p><?php echo esc_html( $label ); ?></p><?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>

					<div class="vc-project-page__content-grid">
						<aside class="vc-project-page__overview">
							<div class="vc-project-page__overview-card">
								<span class="vc-project-page__section-kicker"><?php echo esc_html__( 'Áttekintés', 'vitacenter-elementor-header' ); ?></span>
								<h2><?php echo esc_html( $s['overview_title'] ); ?></h2>
								<p><?php echo esc_html( $s['overview_text'] ); ?></p>
								<div class="vc-project-page__overview-list">
									<?php foreach ( $overview_items as $item ) : ?>
										<?php $text = isset( $item['text'] ) ? $this->plain_text( $item['text'] ) : ''; ?>
										<?php if ( '' !== $text ) : ?>
											<div>
												<?php $this->render_project_icon( 'check' ); ?>
												<span><?php echo esc_html( $text ); ?></span>
											</div>
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
							</div>
						</aside>

						<article class="vc-project-page__main">
							<div class="vc-project-page__panel vc-project-page__panel--text">
								<h2><?php echo esc_html( $s['content_title'] ); ?></h2>
								<div class="vc-project-page__prose">
									<?php foreach ( $paragraphs as $paragraph ) : ?>
										<?php $text = isset( $paragraph['text'] ) ? $this->plain_text( $paragraph['text'] ) : ''; ?>
										<?php if ( '' !== $text ) : ?><p><?php echo esc_html( $text ); ?></p><?php endif; ?>
									<?php endforeach; ?>
								</div>
							</div>

							<div class="vc-project-page__panel vc-project-page__panel--goals">
								<h2><?php echo esc_html( $s['goals_title'] ); ?></h2>
								<div class="vc-project-page__goals">
									<?php foreach ( $goals as $goal ) : ?>
										<?php $text = isset( $goal['text'] ) ? $this->plain_text( $goal['text'] ) : ''; ?>
										<?php if ( '' !== $text ) : ?>
											<div class="vc-project-page__goal">
												<?php $this->render_project_icon( 'check' ); ?>
												<span><?php echo esc_html( $text ); ?></span>
											</div>
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
							</div>

							<div class="vc-project-page__program-grid">
								<?php foreach ( $program_cards as $item ) : ?>
									<?php
									$title = isset( $item['title'] ) ? $this->plain_text( $item['title'] ) : '';
									$text  = isset( $item['text'] ) ? $this->plain_text( $item['text'] ) : '';
									$icon  = ! empty( $item['icon'] ) ? $this->plain_text( $item['icon'] ) : 'heart-pulse';
									if ( '' === $title && '' === $text ) {
										continue;
									}
									?>
									<div class="vc-project-page__program-card">
										<span class="vc-project-page__program-icon"><?php $this->render_project_icon( $icon ); ?></span>
										<?php if ( '' !== $title ) : ?><h3><?php echo esc_html( $title ); ?></h3><?php endif; ?>
										<?php if ( '' !== $text ) : ?><p><?php echo esc_html( $text ); ?></p><?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>

							<div class="vc-project-page__strategy">
								<span class="vc-project-page__section-kicker"><?php echo esc_html__( 'Stratégiai üzenetek', 'vitacenter-elementor-header' ); ?></span>
								<h2><?php echo esc_html( $s['strategy_title'] ); ?></h2>
								<div class="vc-project-page__strategy-messages">
									<?php foreach ( $messages as $message ) : ?>
										<?php $text = isset( $message['text'] ) ? $this->plain_text( $message['text'] ) : ''; ?>
										<?php if ( '' !== $text ) : ?><p><?php echo esc_html( $text ); ?></p><?php endif; ?>
									<?php endforeach; ?>
								</div>
								<?php $this->render_project_button( $s['strategy_button_text'], $s['strategy_button_link'], 'vc-project-page__button vc-project-page__button--light', true, esc_html__( 'Kapcsolatfelvétel', 'vitacenter-elementor-header' ) ); ?>
							</div>
						</article>
					</div>
				</div>
			</section>
		</div>
		<?php
	}

	private function project_defaults() {
		return array(
			'eyebrow'              => esc_html__( 'Projekt', 'vitacenter-elementor-header' ),
			'period'               => esc_html__( '2025.05.28. - 2027.11.27.', 'vitacenter-elementor-header' ),
			'title'                => esc_html__( 'Népesedési folyamatok javítása helyi szinten egészségfejlesztési módszerekkel', 'vitacenter-elementor-header' ),
			'intro'                => esc_html__( 'A projekt célja, hogy Szatmár megye lakosságának egészségi állapotát, prevenciós lehetőségeit és az egészségügyi szolgáltatásokhoz való hozzáférését javítsa.', 'vitacenter-elementor-header' ),
			'primary_text'         => esc_html__( 'Programok megtekintése', 'vitacenter-elementor-header' ),
			'primary_link'         => array( 'url' => '#programok' ),
			'secondary_text'       => esc_html__( 'Egyeztessen időpontot!', 'vitacenter-elementor-header' ),
			'secondary_link'       => array( 'url' => '#kapcsolat' ),
			'highlights'           => $this->project_highlight_defaults(),
			'overview_title'       => esc_html__( 'A projektről', 'vitacenter-elementor-header' ),
			'overview_text'        => esc_html__( 'A Szatmárnémeti Egészségfejlesztési Iroda a prevenció, az esélyegyenlőség és a család- és közösségalapú ellátás erősítésére épül.', 'vitacenter-elementor-header' ),
			'overview_items'       => $this->project_overview_defaults(),
			'content_title'        => esc_html__( 'Projektbemutató', 'vitacenter-elementor-header' ),
			'paragraphs'           => $this->project_paragraph_defaults(),
			'goals_title'          => esc_html__( 'A projekt céljai', 'vitacenter-elementor-header' ),
			'goals'                => $this->project_goal_defaults(),
			'program_cards'        => $this->project_program_defaults(),
			'strategy_title'       => esc_html__( 'Esélyegyenlőség. Prevenció. Életerős közösségek.', 'vitacenter-elementor-header' ),
			'messages'             => $this->project_message_defaults(),
			'strategy_button_text' => esc_html__( 'Kapcsolatfelvétel', 'vitacenter-elementor-header' ),
			'strategy_button_link' => array( 'url' => '#kapcsolat' ),
		);
	}

	private function project_highlight_defaults() {
		return array(
			array( 'icon' => 'users', 'number' => '1000+', 'label' => esc_html__( 'résztvevő mobil szűréseken', 'vitacenter-elementor-header' ) ),
			array( 'icon' => 'stethoscope', 'number' => '10+', 'label' => esc_html__( 'vidéki háziorvos bevonása', 'vitacenter-elementor-header' ) ),
			array( 'icon' => 'building', 'number' => '30+', 'label' => esc_html__( 'megyei intézmény az Iskolára készen kampányban', 'vitacenter-elementor-header' ) ),
			array( 'icon' => 'baby', 'number' => '500-600', 'label' => esc_html__( 'nagycsoportos óvodás felmérése', 'vitacenter-elementor-header' ) ),
		);
	}

	private function project_overview_defaults() {
		return array(
			array( 'text' => esc_html__( 'Egészségügyi hozzáférés', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Prevenció', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Családalapú ellátás', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Közösségi egészségfejlesztés', 'vitacenter-elementor-header' ) ),
		);
	}

	private function project_paragraph_defaults() {
		return array(
			array( 'text' => esc_html__( 'A „Népesedési folyamatok javítása helyi szinten egészségfejlesztési módszerekkel” elnevezésű IPOP ROHU00259-es számú, 2025.05.28. - 2027.11.27. időszakban futó projekt a Páli Szent Vincéről Nevezett Szatmári Irgalmas Nővérek Egyesületének a Hódmezővásárhelyi-Makói Egészségügyi Ellátó Központtal partnerségben az Interreg VI-A Románia-Magyarország Program támogatásával, a „4.5 - Az egészségügyi ellátáshoz való egyenlő hozzáférés biztosítása, az egészségügyi rendszerek ellenálló képességének erősítése - beleértve az alapellátást is -, valamint az intézményi ellátásról a családi és közösségi alapú gondozásra való áttérés előmozdítása” egyedi célkitűzés keretén belül valósul meg.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'A projekt keretén belül kialakított és működés alatt álló Szatmárnémeti Egészségfejlesztési Iroda egy olyan egészségvédelmi és felvilágosító iroda, melynek küldetése a demográfiai helyzet javítása egészségfejlesztési módszerekkel, esélyegyenlőség biztosításával és a család- és közösségalapú ellátás erősítésével, a prevenció, valamint a megye egészségügyi állapotának javítása.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Ennek megfelelően Szatmár megyében legalább 1000 fő részére egy mozgó kardiovaszkuláris és onkológiai - bőr, prosztata, mell, vastagbél - szűrés valósul meg, legalább 10 vidéki háziorvos bevonásával, biztosítva a szükséges szakorvosi vizsgálatok időszakos kihelyezését az érintett rendelőkbe, illetve modern orvosi felszereléseket.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'A vezető partner irányításával olyan személyeket szándékoznak kiképezni, akik cikluskövetés-oktatást és meddőségi tanácsadást tudnak majd nyújtani fiatal hölgyeknek. A tanult módszerrel a megye legalább 6 gimnáziumába szeretnének eljutni a projekt időtartama alatt.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Szintén a pályázat segítségével a Boldog Scheffler János Központ „Iskolára készen” kampányával Szatmár megye vidéki településein óvodás gyermekek iskola előtti szenzo-motoros, kognitív és pszichológiai szűrését fogják elvégezni.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'A kitűzött cél legalább 30 megyei intézményben, melyben 500-600 nagycsoportos óvodás felmérése zajlik majd a szakemberek által, az óvónők segítségével.', 'vitacenter-elementor-header' ) ),
		);
	}

	private function project_goal_defaults() {
		return array(
			array( 'text' => esc_html__( 'Szatmár megye demográfiai helyzetének javítása', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Prevenció és egészségnevelés erősítése', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Családalapú ellátás támogatása', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Az egészségügyi szolgáltatásokhoz való hozzáférés javítása', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'A megelőzés fontossága és az egészséges életmód népszerűsítése', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Tanácsadói tevékenységek ellátása', 'vitacenter-elementor-header' ) ),
		);
	}

	private function project_program_defaults() {
		return array(
			array( 'icon' => 'heart-pulse', 'title' => esc_html__( 'Mobil kardiovaszkuláris szűrés', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Helyben elérhető vizsgálatok a szív- és érrendszeri kockázatok korai felismerésére.', 'vitacenter-elementor-header' ) ),
			array( 'icon' => 'shield', 'title' => esc_html__( 'Onkológiai szűrések', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Bőr-, prosztata-, mell- és vastagbél-szűrések a megelőzés támogatására.', 'vitacenter-elementor-header' ) ),
			array( 'icon' => 'graduation', 'title' => esc_html__( 'Cikluskövetés-oktatás', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Képzett szakemberek bevonása fiatal hölgyek termékenységtudatosságának fejlesztésére.', 'vitacenter-elementor-header' ) ),
			array( 'icon' => 'baby', 'title' => esc_html__( 'Iskolára készen kampány', 'vitacenter-elementor-header' ), 'text' => esc_html__( 'Szenzo-motoros, kognitív és pszichológiai szűrések óvodás gyermekeknek.', 'vitacenter-elementor-header' ) ),
		);
	}

	private function project_message_defaults() {
		return array(
			array( 'text' => esc_html__( 'A vidéki egészségügyi szolgáltatásokkal és szűrésekkel az esélyegyenlőség teremtődik meg.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'A prevenció kulcsfontosságú a hosszú távú egészség megőrzésében.', 'vitacenter-elementor-header' ) ),
			array( 'text' => esc_html__( 'Az egészségfejlesztés által az egészséges egyének és családok életerős közösségeket hozhatnak létre.', 'vitacenter-elementor-header' ) ),
		);
	}

	private function project_items_or_default( $settings, $key, $default ) {
		return ! empty( $settings[ $key ] ) && is_array( $settings[ $key ] ) ? $this->repeater_items( $settings[ $key ] ) : $default;
	}

	private function project_default_highlight_icon( $index ) {
		$icons = array( 'users', 'stethoscope', 'building', 'baby' );
		return $icons[ $index % count( $icons ) ];
	}

	private function project_icon_options() {
		return array(
			'heart-pulse' => esc_html__( 'Szív / egészség', 'vitacenter-elementor-header' ),
			'calendar'    => esc_html__( 'Naptár', 'vitacenter-elementor-header' ),
			'map-pin'     => esc_html__( 'Helyszín', 'vitacenter-elementor-header' ),
			'shield'      => esc_html__( 'Védelem', 'vitacenter-elementor-header' ),
			'users'       => esc_html__( 'Közösség', 'vitacenter-elementor-header' ),
			'baby'        => esc_html__( 'Gyermek', 'vitacenter-elementor-header' ),
			'graduation'  => esc_html__( 'Oktatás', 'vitacenter-elementor-header' ),
			'stethoscope' => esc_html__( 'Orvosi vizsgálat', 'vitacenter-elementor-header' ),
			'building'    => esc_html__( 'Intézmény', 'vitacenter-elementor-header' ),
			'check'       => esc_html__( 'Pipa', 'vitacenter-elementor-header' ),
			'arrow'       => esc_html__( 'Nyíl', 'vitacenter-elementor-header' ),
		);
	}

	private function render_project_button( $text, $link, $class, $show_arrow = true, $fallback_text = '' ) {
		$text = $this->plain_text( $text );

		if ( '' === $text ) {
			$text = $this->plain_text( $fallback_text );
		}

		if ( '' === $text ) {
			return;
		}
		?>
		<a class="<?php echo esc_attr( $class ); ?>" <?php echo $this->url_attributes( $link ); ?>>
			<span><?php echo esc_html( $text ); ?></span>
			<?php if ( $show_arrow ) : ?>
				<?php $this->render_project_icon( 'arrow' ); ?>
			<?php endif; ?>
		</a>
		<?php
	}

	private function render_project_icon( $icon ) {
		$icon = $this->plain_text( $icon );
		$icons = array(
			'heart-pulse' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M19.5 12.6 12 20l-7.5-7.4a5 5 0 0 1 7.1-7.1l.4.4.4-.4a5 5 0 0 1 7.1 7.1Z"/><path d="M3 12h4l2-4 3 8 2-4h7"/></svg>',
			'calendar'    => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M8 2v4M16 2v4M3 10h18"/><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M8 14h.01M12 14h.01M16 14h.01M8 18h.01M12 18h.01"/></svg>',
			'map-pin'     => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M12 21s7-5.1 7-11a7 7 0 1 0-14 0c0 5.9 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg>',
			'shield'      => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-5"/></svg>',
			'users'       => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
			'baby'        => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M9 12h.01M15 12h.01"/><path d="M10 16c.7.6 1.3.8 2 .8s1.3-.2 2-.8"/><path d="M19 6.5A8 8 0 1 1 6.5 5"/><path d="M8 4.5c1.5-2 6.5-2 8 0"/></svg>',
			'graduation'  => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="m22 10-10-5-10 5 10 5 10-5Z"/><path d="M6 12v5c3 2 9 2 12 0v-5"/><path d="M22 10v6"/></svg>',
			'stethoscope' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M6 3v5a4 4 0 0 0 8 0V3"/><path d="M10 12v3a5 5 0 0 0 10 0v-1"/><circle cx="20" cy="10" r="2"/><path d="M4 3h4M12 3h4"/></svg>',
			'building'    => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><rect x="4" y="3" width="16" height="18" rx="2"/><path d="M9 8h1M14 8h1M9 12h1M14 12h1M9 16h1M14 16h1M10 21v-3h4v3"/></svg>',
			'check'       => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="10"/><path d="m8 12 2.5 2.5L16 9"/></svg>',
			'arrow'       => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>',
		);

		echo isset( $icons[ $icon ] ) ? $icons[ $icon ] : $icons['heart-pulse'];
	}
}

class VitaCenter_Program_Content_Widget extends VitaCenter_Structured_Widget_Base {
	public function get_name() { return 'vitacenter_program_content'; }
	public function get_title() { return esc_html__( 'VitaCenter Program Content', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-post-content'; }
	public function get_style_depends() { return array( 'vc-landing' ); }
	public function get_script_depends() { return array( 'vc-landing' ); }

	protected function register_controls() {
		$this->start_controls_section( 'content_section', array( 'label' => esc_html__( 'Programjaink tartalom', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Programjaink', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'intro', array( 'label' => esc_html__( 'Bevezető', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Ismerje meg egészségfejlesztési programjainkat, amelyek a megelőzésre, a könnyebb hozzáférésre és a családok támogatására épülnek.', 'vitacenter-elementor-header' ) ) );
		$r = new Repeater();
		$r->add_control( 'title', array( 'label' => esc_html__( 'Program címe', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Program', 'vitacenter-elementor-header' ) ) );
		$r->add_control( 'subtitle', array( 'label' => esc_html__( 'Alcím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Rövid alcím', 'vitacenter-elementor-header' ) ) );
		$r->add_control( 'text', array( 'label' => esc_html__( 'Leírás', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Programleírás.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'items', array(
			'label' => esc_html__( 'Program szekciók', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $r->get_controls(),
			'title_field' => '{{{ title }}}',
			'default' => $this->program_defaults(),
		) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		?>
		<div class="vc-landing">
			<section id="programok" class="vc-page-section vc-page-section--programs">
				<div class="vc-landing__container">
					<div class="vc-page-heading vc-page-heading--compact">
						<h1><?php echo esc_html( $s['title'] ); ?></h1>
						<p><?php echo esc_html( $s['intro'] ); ?></p>
					</div>
					<div class="vc-content-list">
						<?php foreach ( $s['items'] as $index => $item ) : ?>
							<article class="vc-content-panel">
								<span><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span>
								<div>
									<h2><?php echo esc_html( $item['title'] ); ?></h2>
									<?php if ( ! empty( $item['subtitle'] ) ) : ?><strong><?php echo esc_html( $item['subtitle'] ); ?></strong><?php endif; ?>
									<p><?php echo esc_html( $item['text'] ); ?></p>
								</div>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
		</div>
		<?php
	}

	private function program_defaults() {
		return array(
			array(
				'title' => esc_html__( 'Ciklusoktatás', 'vitacenter-elementor-header' ),
				'subtitle' => esc_html__( 'Nőknek szóló termékenységtudatosság', 'vitacenter-elementor-header' ),
				'text' => esc_html__( 'A cikluskövetés-oktatás célja a megfelelő egészségügyi ismeretek átadása, különösen a 8-12. osztályos lányok körében, illetve az Egészségfejlesztési Irodába jelentkezőknél. A program a termékenységtudatosságot, a felelős döntéseket és az egészségnevelést támogatja.', 'vitacenter-elementor-header' ),
			),
			array(
				'title' => esc_html__( 'Egészségfejlesztési Iroda', 'vitacenter-elementor-header' ),
				'subtitle' => esc_html__( 'Az egészséges életmódot és a szűrővizsgálatok jelentőségét népszerűsítő tevékenységek', 'vitacenter-elementor-header' ),
				'text' => esc_html__( 'A megyében hiánypótló egészségügyi tanácsadói iroda az alapellátás szerepének megerősítését, a betegségmegelőzést, a szűréseken való részvétel fontosságát és az egészséges életforma népszerűsítését szolgálja.', 'vitacenter-elementor-header' ),
			),
			array(
				'title' => esc_html__( 'Mobil szakorvosi szolgálat', 'vitacenter-elementor-header' ),
				'subtitle' => esc_html__( 'Helyben elérhető szakvizsgálatok a könnyebb hozzáférésért', 'vitacenter-elementor-header' ),
				'text' => esc_html__( 'A mozgó szakorvosi szolgálat célja, hogy a szakellátást közelebb vigye a vidéki közösségekhez. A megye különböző településein 10 háziorvosnál, szakorvosok bevonásával valósulnak meg kardiovaszkuláris és egyéb vizsgálatok.', 'vitacenter-elementor-header' ),
			),
			array(
				'title' => esc_html__( 'Mobil szűrés', 'vitacenter-elementor-header' ),
				'subtitle' => esc_html__( 'Helyben elérhető onkológiai szűrések a könnyebb hozzáférésért', 'vitacenter-elementor-header' ),
				'text' => esc_html__( 'A mozgó szűrőakció célja a korai felismerés fontosságának tudatosítása. A projekt 1000 személy szűrését tervezi 10 háziorvos bevonásával, többek között prosztata-, mell-, méhnyak-, bőr- és vastagbélrák szűrések biztosításával.', 'vitacenter-elementor-header' ),
			),
			array(
				'title' => esc_html__( 'Életmódtanácsadás', 'vitacenter-elementor-header' ),
				'subtitle' => esc_html__( 'Személyre szabott támogatás az egészséges életvitel kialakításához', 'vitacenter-elementor-header' ),
				'text' => esc_html__( 'Az Egészségfejlesztési Iroda felvilágosító munkával, egészségneveléssel, csoportos és egyéni tanácsadással, egyéni egészségtervvel és prevenciós támogatással segíti az egészségesebb életmód kialakítását.', 'vitacenter-elementor-header' ),
			),
			array(
				'title' => esc_html__( 'Óvodás iskolaérettséget vizsgáló szűrések', 'vitacenter-elementor-header' ),
				'subtitle' => esc_html__( 'Korai felismerés és támogatás a gyermekek fejlődésében', 'vitacenter-elementor-header' ),
				'text' => esc_html__( 'Az Iskolára készen! program óvodás gyermekek iskola előtti szenzo-motoros, kognitív és pszichológiai szűrését támogatja. A cél a rizikótünetek időben történő felismerése, a sikeres iskolai beválás támogatása és a gyermekek fejlődési lemaradásainak csökkentése.', 'vitacenter-elementor-header' ),
			),
		);
	}
}

class VitaCenter_Info_Section_Widget extends VitaCenter_Structured_Widget_Base {
	public function get_name() { return 'vitacenter_info_section'; }
	public function get_title() { return esc_html__( 'VitaCenter Info Section', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-info-box'; }
	public function get_style_depends() { return array( 'vc-landing' ); }
	public function get_script_depends() { return array( 'vc-landing' ); }

	protected function register_controls() {
		$this->start_controls_section( 'content_section', array( 'label' => esc_html__( 'Tartalom', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'section_id', array( 'label' => esc_html__( 'Szekció ID', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => 'galeria' ) );
		$this->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Fotó- és videógaléria', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'text', array( 'label' => esc_html__( 'Szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Fotók és videók egészségügyi eseményeinkről, szűréseinkről és közösségi aktivitásainkról.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'button_text', array( 'label' => esc_html__( 'Gomb felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Megtekintés', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'button_link', array( 'label' => esc_html__( 'Gomb link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		?>
		<div class="vc-landing">
			<section id="<?php echo esc_attr( sanitize_title( $s['section_id'] ) ); ?>" class="vc-page-section vc-page-section--info">
				<div class="vc-landing__container">
					<div class="vc-info-band">
						<div>
							<h2><?php echo esc_html( $s['title'] ); ?></h2>
							<p><?php echo esc_html( $s['text'] ); ?></p>
						</div>
						<?php $this->render_button( $s['button_text'], $s['button_link'], 'vc-landing__button vc-landing__button--outline' ); ?>
					</div>
				</div>
			</section>
		</div>
		<?php
	}
}

class VitaCenter_Registration_Info_Widget extends VitaCenter_Structured_Widget_Base {
	public function get_name() { return 'vitacenter_registration_info'; }
	public function get_title() { return esc_html__( 'VitaCenter Registration Info', 'vitacenter-elementor-header' ); }
	public function get_icon() { return 'eicon-form-horizontal'; }
	public function get_style_depends() { return array( 'vc-landing' ); }
	public function get_script_depends() { return array( 'vc-landing' ); }

	protected function register_controls() {
		$this->start_controls_section( 'content_section', array( 'label' => esc_html__( 'Regisztráció / kapcsolat', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Egyeztessen időpontot!', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'text', array( 'label' => esc_html__( 'Szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Vegye fel velünk a kapcsolatot bizalommal!', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'phone', array( 'label' => esc_html__( 'Telefon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '0742021316' ) );
		$this->add_control( 'email', array( 'label' => esc_html__( 'E-mail', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => 'efi@szatmar.ro' ) );
		$r = new Repeater();
		$r->add_control( 'label', array( 'label' => esc_html__( 'Mező neve', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Mező', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'fields', array(
			'label' => esc_html__( 'Űrlap mezők', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $r->get_controls(),
			'title_field' => '{{{ label }}}',
			'default' => array(
				array( 'label' => esc_html__( 'Név', 'vitacenter-elementor-header' ) ),
				array( 'label' => esc_html__( 'Elérhetőség', 'vitacenter-elementor-header' ) ),
				array( 'label' => esc_html__( 'Választott szolgáltatás', 'vitacenter-elementor-header' ) ),
				array( 'label' => esc_html__( 'Üzenet', 'vitacenter-elementor-header' ) ),
			),
		) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		?>
		<div class="vc-landing">
			<section id="kapcsolat" class="vc-page-section vc-page-section--registration">
				<div class="vc-landing__container">
					<div class="vc-registration-card">
						<div>
							<h2><?php echo esc_html( $s['title'] ); ?></h2>
							<p><?php echo esc_html( $s['text'] ); ?></p>
							<div class="vc-registration-contact">
								<?php if ( ! empty( $s['phone'] ) ) : ?><span><?php echo esc_html__( 'Telefon', 'vitacenter-elementor-header' ); ?>: <?php echo esc_html( $s['phone'] ); ?></span><?php endif; ?>
								<?php if ( ! empty( $s['email'] ) ) : ?><span><?php echo esc_html__( 'E-mail', 'vitacenter-elementor-header' ); ?>: <?php echo esc_html( $s['email'] ); ?></span><?php endif; ?>
							</div>
						</div>
						<div class="vc-form-outline">
							<strong><?php echo esc_html__( 'Online űrlap mezői', 'vitacenter-elementor-header' ); ?></strong>
							<ul><?php foreach ( $s['fields'] as $field ) : ?><li><?php echo esc_html( $field['label'] ); ?></li><?php endforeach; ?></ul>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php
	}
}
