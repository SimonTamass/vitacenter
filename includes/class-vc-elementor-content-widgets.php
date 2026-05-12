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
		$this->start_controls_section( 'content_section', array( 'label' => esc_html__( 'Projekt tartalom', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => esc_html__( 'Kis cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => 'IPOP ROHU00259' ) );
		$this->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Népesedési folyamatok javítása helyi szinten egészségfejlesztési módszerekkel', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'intro', array( 'label' => esc_html__( 'Bevezető', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A projekt 2025.05.28. és 2027.11.27. között valósul meg a Páli Szent Vincéről Nevezett Szatmári Irgalmas Nővérek Egyesületének vezetésével, a Hódmezővásárhelyi-Makói Egészségügyi Ellátó Központtal partnerségben, az Interreg VI-A Románia-Magyarország Program támogatásával.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'description', array( 'label' => esc_html__( 'Leírás', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'A projekt keretében kialakított Szatmárnémeti Egészségfejlesztési Iroda egészségvédelmi és felvilágosító szerepet tölt be. Küldetése a demográfiai helyzet javítása egészségfejlesztési módszerekkel, az esélyegyenlőség biztosítása, a család- és közösségalapú ellátás erősítése, valamint a prevenció és a megye egészségügyi állapotának javítása.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'objective', array( 'label' => esc_html__( 'Program célkitűzés', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( '4.5 - Az egészségügyi ellátáshoz való egyenlő hozzáférés biztosítása, az egészségügyi rendszerek ellenálló képességének erősítése, valamint az intézményi ellátásról a családi és közösségi alapú gondozásra való áttérés előmozdítása.', 'vitacenter-elementor-header' ) ) );

		$goals = new Repeater();
		$goals->add_control( 'text', array( 'label' => esc_html__( 'Cél', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Projektcél', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'goals', array(
			'label' => esc_html__( 'Projekt céljai', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $goals->get_controls(),
			'title_field' => '{{{ text }}}',
			'default' => array(
				array( 'text' => esc_html__( 'Szatmár megye demográfiai helyzetének javítása.', 'vitacenter-elementor-header' ) ),
				array( 'text' => esc_html__( 'A prevenció és az egészségnevelés erősítése.', 'vitacenter-elementor-header' ) ),
				array( 'text' => esc_html__( 'A családalapú ellátás támogatása.', 'vitacenter-elementor-header' ) ),
				array( 'text' => esc_html__( 'Az egészségügyi szolgáltatásokhoz való hozzáférés javítása.', 'vitacenter-elementor-header' ) ),
				array( 'text' => esc_html__( 'A megelőzés fontosságának és az egészséges életmódnak a népszerűsítése.', 'vitacenter-elementor-header' ) ),
				array( 'text' => esc_html__( 'Tanácsadói tevékenységek ellátása.', 'vitacenter-elementor-header' ) ),
			),
		) );

		$stats = new Repeater();
		$stats->add_control( 'number', array( 'label' => esc_html__( 'Szám', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '1000+' ) );
		$stats->add_control( 'label', array( 'label' => esc_html__( 'Felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'résztvevő', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'stats', array(
			'label' => esc_html__( 'Kiemelt számok', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $stats->get_controls(),
			'title_field' => '{{{ number }}} {{{ label }}}',
			'default' => array(
				array( 'number' => '1000+', 'label' => esc_html__( 'személy részére tervezett kardiovaszkuláris és onkológiai szűrés', 'vitacenter-elementor-header' ) ),
				array( 'number' => '10', 'label' => esc_html__( 'vidéki háziorvos bevonása', 'vitacenter-elementor-header' ) ),
				array( 'number' => '30', 'label' => esc_html__( 'megyei intézmény óvodás szűrésekkel', 'vitacenter-elementor-header' ) ),
				array( 'number' => '500-600', 'label' => esc_html__( 'nagycsoportos óvodás felmérése', 'vitacenter-elementor-header' ) ),
			),
		) );

		$messages = new Repeater();
		$messages->add_control( 'text', array( 'label' => esc_html__( 'Üzenet', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Stratégiai üzenet', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'messages', array(
			'label' => esc_html__( 'Stratégiai üzenetek', 'vitacenter-elementor-header' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $messages->get_controls(),
			'title_field' => '{{{ text }}}',
			'default' => array(
				array( 'text' => esc_html__( 'A vidéki egészségügyi szolgáltatások és szűrések az esélyegyenlőséget erősítik.', 'vitacenter-elementor-header' ) ),
				array( 'text' => esc_html__( 'A prevenció kulcsfontosságú a hosszú távú egészség megőrzésében.', 'vitacenter-elementor-header' ) ),
				array( 'text' => esc_html__( 'Az egészségfejlesztés által az egészséges egyének és családok életerős közösségeket hozhatnak létre.', 'vitacenter-elementor-header' ) ),
			),
		) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		?>
		<div class="vc-landing">
			<section id="projekt" class="vc-page-section vc-page-section--project">
				<div class="vc-landing__container">
					<div class="vc-page-heading">
						<?php if ( ! empty( $s['eyebrow'] ) ) : ?><span><?php echo esc_html( $s['eyebrow'] ); ?></span><?php endif; ?>
						<h1><?php echo $this->format_multiline( $s['title'] ); ?></h1>
						<p><?php echo esc_html( $s['intro'] ); ?></p>
					</div>
					<div class="vc-page-grid">
						<article class="vc-page-card vc-page-card--wide">
							<h2><?php echo esc_html__( 'A projektről', 'vitacenter-elementor-header' ); ?></h2>
							<p><?php echo esc_html( $s['description'] ); ?></p>
						</article>
						<article class="vc-page-card">
							<h2><?php echo esc_html__( 'Projekt céljai', 'vitacenter-elementor-header' ); ?></h2>
							<ul><?php foreach ( $s['goals'] as $goal ) : ?><li><?php echo esc_html( $goal['text'] ); ?></li><?php endforeach; ?></ul>
						</article>
					</div>
					<div class="vc-stat-grid">
						<?php foreach ( $s['stats'] as $stat ) : ?>
							<div class="vc-stat-card"><strong><?php echo esc_html( $stat['number'] ); ?></strong><span><?php echo esc_html( $stat['label'] ); ?></span></div>
						<?php endforeach; ?>
					</div>
					<div class="vc-message-grid">
						<?php foreach ( $s['messages'] as $message ) : ?><div><?php echo esc_html( $message['text'] ); ?></div><?php endforeach; ?>
					</div>
					<?php if ( ! empty( $s['objective'] ) ) : ?><p class="vc-page-note"><?php echo esc_html( $s['objective'] ); ?></p><?php endif; ?>
				</div>
			</section>
		</div>
		<?php
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
				'title' => esc_html__( 'Meddőségi tanácsadás', 'vitacenter-elementor-header' ),
				'subtitle' => esc_html__( 'Komplex, életmód-alapú megközelítés szakmai háttérrel', 'vitacenter-elementor-header' ),
				'text' => esc_html__( 'A meddőségi tanácsadás szakmai támogatást nyújt azoknak, akik életmódbeli, prevenciós és egészségfejlesztési szempontból szeretnének tudatosabban felkészülni a gyermekvállalásra.', 'vitacenter-elementor-header' ),
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
		$this->add_control( 'title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Regisztráció / Időpontfoglalás', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'text', array( 'label' => esc_html__( 'Szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Vegye fel velünk a kapcsolatot bizalommal!', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'phone', array( 'label' => esc_html__( 'Telefon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '+40 261 713 775' ) );
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
