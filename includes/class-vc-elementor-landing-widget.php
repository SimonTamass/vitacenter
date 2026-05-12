<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;

class VitaCenter_Elementor_Landing_Widget extends Widget_Base {
	public function get_name() {
		return 'vitacenter_landing_page';
	}

	public function get_title() {
		return esc_html__( 'VitaCenter Landing Page', 'vitacenter-elementor-header' );
	}

	public function get_icon() {
		return 'eicon-page-transition';
	}

	public function get_categories() {
		return array( 'vitacenter' );
	}

	public function get_keywords() {
		return array( 'landing', 'home', 'vitacenter', 'programok', 'esemenyek' );
	}

	public function get_style_depends() {
		return array( 'vc-landing' );
	}

	public function get_script_depends() {
		return array( 'vc-landing' );
	}

	protected function register_controls() {
		$this->register_content_controls();
		$this->register_style_controls();
	}

	private function register_content_controls() {
		$this->start_controls_section(
			'section_hero',
			array(
				'label' => esc_html__( 'Hero', 'vitacenter-elementor-header' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'hero_image',
			array(
				'label'   => esc_html__( 'Hero háttérkép', 'vitacenter-elementor-header' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => $this->media_default( 'index_hero_vitacenter.jpg' ),
			)
		);

		$this->add_control(
			'hero_title',
			array(
				'label'       => esc_html__( 'Címsor', 'vitacenter-elementor-header' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( "Szűrés. Prevenció. Egészséges életmód.\nEgyütt a hosszabb életért!", 'vitacenter-elementor-header' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'hero_text',
			array(
				'label'       => esc_html__( 'Alcím', 'vitacenter-elementor-header' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Szűrővizsgálatok, tanácsadás és közösségi programok Szatmár megyében - a megelőzés és az egészségtudatos életmód szolgálatában.', 'vitacenter-elementor-header' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'hero_primary_text',
			array(
				'label'   => esc_html__( 'Első gomb felirata', 'vitacenter-elementor-header' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Programok megtekintése', 'vitacenter-elementor-header' ),
			)
		);

		$this->add_control(
			'hero_primary_link',
			array(
				'label'   => esc_html__( 'Első gomb link', 'vitacenter-elementor-header' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#programok' ),
			)
		);

		$this->add_control(
			'hero_secondary_text',
			array(
				'label'   => esc_html__( 'Második gomb felirata', 'vitacenter-elementor-header' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Időpontfoglalás', 'vitacenter-elementor-header' ),
			)
		);

		$this->add_control(
			'hero_secondary_link',
			array(
				'label'   => esc_html__( 'Második gomb link', 'vitacenter-elementor-header' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#kapcsolat' ),
			)
		);

		$this->add_control(
			'hero_badge_icon',
			array(
				'label'   => esc_html__( 'Lebegő ikon', 'vitacenter-elementor-header' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_20_41 PM (5).png' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_about',
			array(
				'label' => esc_html__( 'A projektről', 'vitacenter-elementor-header' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'about_icon',
			array(
				'label'   => esc_html__( 'Bal oldali ikon', 'vitacenter-elementor-header' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_20_40 PM (1).png' ),
			)
		);

		$this->add_control(
			'about_title',
			array(
				'label'   => esc_html__( 'Cím', 'vitacenter-elementor-header' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'A projektről', 'vitacenter-elementor-header' ),
			)
		);

		$this->add_control(
			'about_text',
			array(
				'label'       => esc_html__( 'Leírás', 'vitacenter-elementor-header' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'A „Népesedési folyamatok javítása helyi szinten egészségfejlesztési módszerekkel” elnevezésű IPOP ROHU00259-es számú projekt célja, hogy hozzájáruljon Szatmár megye lakosságának egészségi állapotának javításához, valamint a demográfiai kihívások kezeléséhez. A kezdeményezés a Szatmárnémeti Egészségfejlesztési Iroda létrehozása mellett a megelőzésre, az egészségtudatosság növelésére és a család- és közösségalapú ellátás erősítésére épül.', 'vitacenter-elementor-header' ),
				'label_block' => true,
			)
		);

		$focus_repeater = new Repeater();
		$focus_repeater->add_control( 'focus_icon', array( 'label' => esc_html__( 'Ikon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::MEDIA ) );
		$focus_repeater->add_control( 'focus_title', array( 'label' => esc_html__( 'Felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Fókuszpont', 'vitacenter-elementor-header' ), 'label_block' => true ) );

		$this->add_control(
			'focus_items',
			array(
				'label'       => esc_html__( 'Fókuszpontok', 'vitacenter-elementor-header' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $focus_repeater->get_controls(),
				'title_field' => '{{{ focus_title }}}',
				'default'     => array(
					array( 'focus_title' => esc_html__( 'Egészségi állapot javítása', 'vitacenter-elementor-header' ), 'focus_icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_20_41 PM (5).png' ) ),
					array( 'focus_title' => esc_html__( 'Demográfiai kihívások kezelése', 'vitacenter-elementor-header' ), 'focus_icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_20_41 PM (4).png' ) ),
					array( 'focus_title' => esc_html__( 'Közösségi alapú ellátás', 'vitacenter-elementor-header' ), 'focus_icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_20_40 PM (3).png' ) ),
					array( 'focus_title' => esc_html__( 'Prevenció és életmódprogramok', 'vitacenter-elementor-header' ), 'focus_icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_20_40 PM (2).png' ) ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_programs',
			array(
				'label' => esc_html__( 'Kiemelt programok', 'vitacenter-elementor-header' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control( 'programs_title', array( 'label' => esc_html__( 'Szekció címe', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kiemelt programok', 'vitacenter-elementor-header' ) ) );

		$program_repeater = new Repeater();
		$program_repeater->add_control( 'program_icon', array( 'label' => esc_html__( 'Ikon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::MEDIA ) );
		$program_repeater->add_control( 'program_title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Program', 'vitacenter-elementor-header' ), 'label_block' => true ) );
		$program_repeater->add_control( 'program_text', array( 'label' => esc_html__( 'Rövid leírás', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Rövid programleírás.', 'vitacenter-elementor-header' ) ) );
		$program_repeater->add_control( 'program_link_text', array( 'label' => esc_html__( 'Link felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ) ) );
		$program_repeater->add_control( 'program_link', array( 'label' => esc_html__( 'Link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );

		$this->add_control(
			'program_items',
			array(
				'label'       => esc_html__( 'Programkártyák', 'vitacenter-elementor-header' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $program_repeater->get_controls(),
				'title_field' => '{{{ program_title }}}',
				'default'     => array(
					array( 'program_title' => esc_html__( 'Ciklusoktatás', 'vitacenter-elementor-header' ), 'program_text' => esc_html__( 'Nőknek szóló termékenységtudatosság.', 'vitacenter-elementor-header' ), 'program_icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_00 PM (1).png' ), 'program_link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ), 'program_link' => array( 'url' => '#ciklusoktatas' ) ),
					array( 'program_title' => esc_html__( 'Meddőségi tanácsadás', 'vitacenter-elementor-header' ), 'program_text' => esc_html__( 'Komplex, életmód-alapú megközelítés szakmai háttérrel.', 'vitacenter-elementor-header' ), 'program_icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_00 PM (2).png' ), 'program_link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ), 'program_link' => array( 'url' => '#meddosegi-tanacsadas' ) ),
					array( 'program_title' => esc_html__( 'Egészségfejlesztési Iroda', 'vitacenter-elementor-header' ), 'program_text' => esc_html__( 'Az egészséges életmódot, a betegségmegelőzést és a szűrővizsgálatok jelentőségét népszerűsítő tevékenységek.', 'vitacenter-elementor-header' ), 'program_icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_00 PM (3).png' ), 'program_link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ), 'program_link' => array( 'url' => '#efi' ) ),
					array( 'program_title' => esc_html__( 'Mobil szakorvosi szolgálat', 'vitacenter-elementor-header' ), 'program_text' => esc_html__( 'Helyben elérhető szakvizsgálatok a könnyebb hozzáférésért.', 'vitacenter-elementor-header' ), 'program_icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_01 PM (4).png' ), 'program_link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ), 'program_link' => array( 'url' => '#mobil-szakorvosi' ) ),
					array( 'program_title' => esc_html__( 'Mobil szűrés', 'vitacenter-elementor-header' ), 'program_text' => esc_html__( 'Helyben elérhető onkológiai szűrések a könnyebb hozzáférésért.', 'vitacenter-elementor-header' ), 'program_icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_20_40 PM (2).png' ), 'program_link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ), 'program_link' => array( 'url' => '#mobil-szures' ) ),
					array( 'program_title' => esc_html__( 'Életmódtanácsadás', 'vitacenter-elementor-header' ), 'program_text' => esc_html__( 'Személyre szabott támogatás az egészséges életvitel kialakításához.', 'vitacenter-elementor-header' ), 'program_icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_01 PM (5).png' ), 'program_link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ), 'program_link' => array( 'url' => '#eletmodtanacsadas' ) ),
					array( 'program_title' => esc_html__( 'Óvodás iskolaérettséget vizsgáló szűrések', 'vitacenter-elementor-header' ), 'program_text' => esc_html__( 'Korai felismerés és támogatás a gyermekek fejlődésében.', 'vitacenter-elementor-header' ), 'program_icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_01 PM (6).png' ), 'program_link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ), 'program_link' => array( 'url' => '#ovodas-szuresek' ) ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_events',
			array(
				'label' => esc_html__( 'Közelgő események', 'vitacenter-elementor-header' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control( 'events_title', array( 'label' => esc_html__( 'Szekció címe', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Közelgő események', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'events_intro', array( 'label' => esc_html__( 'Bevezető szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Vegyen részt szűréseinken, workshopjainkon és közösségi programjainkon!', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'events_all_text', array( 'label' => esc_html__( 'Összes link felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Összes esemény megtekintése', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'events_all_link', array( 'label' => esc_html__( 'Összes link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#esemenyek' ) ) );
		$this->add_control(
			'events_source',
			array(
				'label'   => esc_html__( 'Események forrása', 'vitacenter-elementor-header' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'dynamic',
				'options' => array(
					'dynamic' => esc_html__( 'Esemény pluginből dinamikusan', 'vitacenter-elementor-header' ),
					'manual'  => esc_html__( 'Kézi kártyák', 'vitacenter-elementor-header' ),
				),
			)
		);
		$this->add_control(
			'events_post_type',
			array(
				'label'       => esc_html__( 'Esemény post type', 'vitacenter-elementor-header' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'tribe_events',
				'options'     => $this->get_event_post_type_options(),
				'description' => esc_html__( 'The Events Calendar esetén hagyd tribe_events értéken.', 'vitacenter-elementor-header' ),
				'condition'   => array(
					'events_source' => 'dynamic',
				),
			)
		);
		$this->add_control(
			'events_count',
			array(
				'label'     => esc_html__( 'Megjelenített események száma', 'vitacenter-elementor-header' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 3,
				'min'       => 1,
				'max'       => 12,
				'condition' => array(
					'events_source' => 'dynamic',
				),
			)
		);
		$this->add_control(
			'events_future_only',
			array(
				'label'        => esc_html__( 'Csak jövőbeli események', 'vitacenter-elementor-header' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Igen', 'vitacenter-elementor-header' ),
				'label_off'    => esc_html__( 'Nem', 'vitacenter-elementor-header' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'events_source' => 'dynamic',
				),
			)
		);
		$this->add_control(
			'events_date_meta_key',
			array(
				'label'       => esc_html__( 'Dátum meta kulcs', 'vitacenter-elementor-header' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Automatikus', 'vitacenter-elementor-header' ),
				'description' => esc_html__( 'The Events Calendar esetén hagyd üresen vagy használd: _EventStartDate.', 'vitacenter-elementor-header' ),
				'condition'   => array(
					'events_source' => 'dynamic',
				),
			)
		);
		$this->add_control(
			'events_location_meta_key',
			array(
				'label'       => esc_html__( 'Helyszín meta kulcs', 'vitacenter-elementor-header' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Automatikus', 'vitacenter-elementor-header' ),
				'description' => esc_html__( 'Hagyd üresen automatikus felismeréshez. Támogatott példák: _EventVenueID, _event_location_id, location.', 'vitacenter-elementor-header' ),
				'condition'   => array(
					'events_source' => 'dynamic',
				),
			)
		);
		$this->add_control(
			'events_dynamic_link_text',
			array(
				'label'     => esc_html__( 'Dinamikus kártya link felirat', 'vitacenter-elementor-header' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Részletek', 'vitacenter-elementor-header' ),
				'condition' => array(
					'events_source' => 'dynamic',
				),
			)
		);
		$this->add_control(
			'events_fallback_to_manual',
			array(
				'label'        => esc_html__( 'Kézi kártyák használata, ha nincs találat', 'vitacenter-elementor-header' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Igen', 'vitacenter-elementor-header' ),
				'label_off'    => esc_html__( 'Nem', 'vitacenter-elementor-header' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'events_source' => 'dynamic',
				),
			)
		);

		$event_repeater = new Repeater();
		$event_repeater->add_control( 'event_image', array( 'label' => esc_html__( 'Kép', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::MEDIA ) );
		$event_repeater->add_control( 'event_date_badge', array( 'label' => esc_html__( 'Dátum jelölő', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'JÚN', 'vitacenter-elementor-header' ) ) );
		$event_repeater->add_control( 'event_title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Esemény neve', 'vitacenter-elementor-header' ), 'label_block' => true ) );
		$event_repeater->add_control( 'event_text', array( 'label' => esc_html__( 'Leírás', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Rövid leírás az eseményről.', 'vitacenter-elementor-header' ) ) );
		$event_repeater->add_control( 'event_time', array( 'label' => esc_html__( 'Időpont', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( '2025. június 5. 10:00', 'vitacenter-elementor-header' ) ) );
		$event_repeater->add_control( 'event_place', array( 'label' => esc_html__( 'Helyszín', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Szatmárnémeti', 'vitacenter-elementor-header' ) ) );
		$event_repeater->add_control( 'event_link_text', array( 'label' => esc_html__( 'Link felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ) ) );
		$event_repeater->add_control( 'event_link', array( 'label' => esc_html__( 'Link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#esemenyek' ) ) );

		$this->add_control(
			'event_items',
			array(
				'label'       => esc_html__( 'Eseménykártyák', 'vitacenter-elementor-header' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $event_repeater->get_controls(),
				'title_field' => '{{{ event_title }}}',
				'condition'   => array(
					'events_source' => 'manual',
				),
				'default'     => array(
					array( 'event_title' => esc_html__( 'Nyitórendezvény', 'vitacenter-elementor-header' ), 'event_text' => esc_html__( 'A projekt bemutatása, partnerek és közösségi célok.', 'vitacenter-elementor-header' ), 'event_time' => esc_html__( '2025. június 5. 10:00', 'vitacenter-elementor-header' ), 'event_place' => esc_html__( 'Szatmárnémeti, Megyeháza', 'vitacenter-elementor-header' ), 'event_image' => $this->media_default( 'index_hero_vitacenter.jpg' ) ),
					array( 'event_title' => esc_html__( 'Szűrési napok', 'vitacenter-elementor-header' ), 'event_text' => esc_html__( 'Kihelyezett kardiovaszkuláris és onkológiai szűrések.', 'vitacenter-elementor-header' ), 'event_time' => esc_html__( '2025. június 18-20.', 'vitacenter-elementor-header' ), 'event_place' => esc_html__( 'Nagykároly, Művelődési Ház', 'vitacenter-elementor-header' ), 'event_image' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_01 PM (4).png' ) ),
					array( 'event_title' => esc_html__( 'Workshopok', 'vitacenter-elementor-header' ), 'event_text' => esc_html__( 'Egészségnevelés, szülői tájékoztatók és szakmai alkalmak.', 'vitacenter-elementor-header' ), 'event_time' => esc_html__( '2025. június 28. 14:00', 'vitacenter-elementor-header' ), 'event_place' => esc_html__( 'Carei, Közösségi Központ', 'vitacenter-elementor-header' ), 'event_image' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_00 PM (1).png' ) ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cta',
			array(
				'label' => esc_html__( 'Időpontfoglalás CTA', 'vitacenter-elementor-header' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control( 'cta_icon', array( 'label' => esc_html__( 'Ikon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::MEDIA, 'default' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_20_41 PM (5).png' ) ) );
		$this->add_control( 'cta_title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Egészsége nem várhat.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'cta_text', array( 'label' => esc_html__( 'Szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Jelentkezzen szűréseinkre, tanácsadásainkra vagy közösségi programjainkra.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'cta_button_text', array( 'label' => esc_html__( 'Gomb felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Jelentkezem', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'cta_button_link', array( 'label' => esc_html__( 'Gomb link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#kapcsolat' ) ) );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_articles',
			array(
				'label' => esc_html__( 'Tudástár', 'vitacenter-elementor-header' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control( 'articles_title', array( 'label' => esc_html__( 'Szekció címe', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Tudástár', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'articles_all_text', array( 'label' => esc_html__( 'Összes link felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Összes cikk megtekintése', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'articles_all_link', array( 'label' => esc_html__( 'Összes link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#tudastar' ) ) );

		$article_repeater = new Repeater();
		$article_repeater->add_control( 'article_image', array( 'label' => esc_html__( 'Kép', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::MEDIA ) );
		$article_repeater->add_control( 'article_title', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Cikk címe', 'vitacenter-elementor-header' ), 'label_block' => true ) );
		$article_repeater->add_control( 'article_text', array( 'label' => esc_html__( 'Leírás', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Rövid cikkleírás.', 'vitacenter-elementor-header' ) ) );
		$article_repeater->add_control( 'article_link_text', array( 'label' => esc_html__( 'Link felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Tovább olvasom', 'vitacenter-elementor-header' ) ) );
		$article_repeater->add_control( 'article_link', array( 'label' => esc_html__( 'Link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#tudastar' ) ) );

		$this->add_control(
			'article_items',
			array(
				'label'       => esc_html__( 'Cikk kártyák', 'vitacenter-elementor-header' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $article_repeater->get_controls(),
				'title_field' => '{{{ article_title }}}',
				'default'     => array(
					array( 'article_title' => esc_html__( 'Prevenció fontossága', 'vitacenter-elementor-header' ), 'article_text' => esc_html__( 'Hasznos tartalmak a megelőzésről, a rendszeres szűrések szerepéről és a korai felismerés jelentőségéről.', 'vitacenter-elementor-header' ), 'article_image' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_20_40 PM (2).png' ) ),
					array( 'article_title' => esc_html__( 'Demográfiai kihívások', 'vitacenter-elementor-header' ), 'article_text' => esc_html__( 'Ismeretterjesztő anyagok családokról, közösségekről és a helyi egészségfejlesztés szerepéről.', 'vitacenter-elementor-header' ), 'article_image' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_20_41 PM (4).png' ) ),
					array( 'article_title' => esc_html__( 'Egészséges életmód útmutató', 'vitacenter-elementor-header' ), 'article_text' => esc_html__( 'Gyakorlati tanácsok, letölthető anyagok és GYIK a tudatosabb mindennapokhoz.', 'vitacenter-elementor-header' ), 'article_image' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_01 PM (5).png' ) ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_contact_footer',
			array(
				'label' => esc_html__( 'Kapcsolat és alsó sáv', 'vitacenter-elementor-header' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control( 'contact_phone_label', array( 'label' => esc_html__( 'Telefon címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Telefon', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'contact_phone', array( 'label' => esc_html__( 'Telefon', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => '+40 261 713 775' ) );
		$this->add_control( 'contact_email_label', array( 'label' => esc_html__( 'E-mail címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'E-mail', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'contact_email', array( 'label' => esc_html__( 'E-mail', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => 'efi@szatmar.ro' ) );
		$this->add_control( 'contact_address_label', array( 'label' => esc_html__( 'Cím címke', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Cím', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'contact_address', array( 'label' => esc_html__( 'Cím', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Szatmárnémeti, Vasile Lucaciu u. 21.', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'contact_button_text', array( 'label' => esc_html__( 'Kapcsolat gomb', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Kapcsolatfelvétel', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'contact_button_link', array( 'label' => esc_html__( 'Kapcsolat link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#kapcsolat' ) ) );
		$this->add_control( 'footer_copyright', array( 'label' => esc_html__( 'Copyright', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( '© 2025 Egészségfejlesztési Iroda - Szatmár megye', 'vitacenter-elementor-header' ), 'label_block' => true ) );
		$this->add_control( 'footer_project', array( 'label' => esc_html__( 'Projekt sor', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'IPOP ROHU00259 - Interreg VI-A Románia-Magyarország Program', 'vitacenter-elementor-header' ), 'label_block' => true ) );
		$this->add_control( 'footer_privacy_text', array( 'label' => esc_html__( 'Adatvédelem felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Adatvédelem', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'footer_privacy_link', array( 'label' => esc_html__( 'Adatvédelem link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->add_control( 'footer_imprint_text', array( 'label' => esc_html__( 'Impresszum felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Impresszum', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'footer_imprint_link', array( 'label' => esc_html__( 'Impresszum link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );

		$this->end_controls_section();
	}

	private function register_style_controls() {
		$this->start_controls_section(
			'section_style_base',
			array(
				'label' => esc_html__( 'Landing stílus', 'vitacenter-elementor-header' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'content_width',
			array(
				'label'      => esc_html__( 'Tartalom max. szélessége', 'vitacenter-elementor-header' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => 960, 'max' => 1500 ) ),
				'default'    => array( 'size' => 1220, 'unit' => 'px' ),
				'selectors'  => array( '{{WRAPPER}} .vc-landing__container' => 'max-width: {{SIZE}}{{UNIT}};' ),
			)
		);

		$this->add_control(
			'primary_color',
			array(
				'label'     => esc_html__( 'Elsődleges zöld', 'vitacenter-elementor-header' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0a6567',
				'selectors' => array( '{{WRAPPER}} .vc-landing' => '--vc-landing-primary: {{VALUE}};' ),
			)
		);

		$this->add_control(
			'accent_color',
			array(
				'label'     => esc_html__( 'Akcentus kék', 'vitacenter-elementor-header' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1e95bd',
				'selectors' => array( '{{WRAPPER}} .vc-landing' => '--vc-landing-accent: {{VALUE}};' ),
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'     => esc_html__( 'Szövegszín', 'vitacenter-elementor-header' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#4e6267',
				'selectors' => array( '{{WRAPPER}} .vc-landing' => '--vc-landing-text: {{VALUE}};' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'hero_title_typography',
				'label'    => esc_html__( 'Hero címsor tipográfia', 'vitacenter-elementor-header' ),
				'selector' => '{{WRAPPER}} .vc-landing__hero-title',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'section_title_typography',
				'label'    => esc_html__( 'Szekció cím tipográfia', 'vitacenter-elementor-header' ),
				'selector' => '{{WRAPPER}} .vc-landing__section-title',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$hero_url  = $this->get_media_url( $settings['hero_image'], 'index_hero_vitacenter.jpg' );
		$style     = $hero_url ? '--vc-landing-hero-image: url("' . esc_url( $hero_url ) . '");' : '';
		?>
		<div class="vc-landing" style="<?php echo esc_attr( $style ); ?>">
			<?php $this->render_hero( $settings ); ?>
			<?php $this->render_about( $settings ); ?>
			<?php $this->render_programs( $settings ); ?>
			<?php $this->render_events( $settings ); ?>
			<?php $this->render_cta( $settings ); ?>
			<?php $this->render_articles( $settings ); ?>
			<?php $this->render_contact_footer( $settings ); ?>
		</div>
		<?php
	}

	private function render_hero( $settings ) {
		$badge = $this->get_media_url( $settings['hero_badge_icon'], 'ChatGPT Image Apr 27, 2026, 02_20_41 PM (5).png' );
		?>
		<section class="vc-landing__hero">
			<div class="vc-landing__hero-dots" aria-hidden="true"></div>
			<div class="vc-landing__container vc-landing__hero-inner">
				<div class="vc-landing__hero-copy">
					<h1 class="vc-landing__hero-title"><?php echo $this->format_multiline( $settings['hero_title'] ); ?></h1>
					<p><?php echo esc_html( $settings['hero_text'] ); ?></p>
					<div class="vc-landing__hero-actions">
						<?php $this->render_button( $settings['hero_primary_text'], $settings['hero_primary_link'], 'vc-landing__button vc-landing__button--primary' ); ?>
						<?php $this->render_button( $settings['hero_secondary_text'], $settings['hero_secondary_link'], 'vc-landing__button vc-landing__button--outline vc-landing__button--calendar' ); ?>
					</div>
				</div>
			</div>
			<?php if ( $badge ) : ?>
				<div class="vc-landing__hero-badge"><img src="<?php echo esc_url( $badge ); ?>" alt=""></div>
			<?php endif; ?>
		</section>
		<?php
	}

	private function render_about( $settings ) {
		$about_icon = $this->get_media_url( $settings['about_icon'], 'ChatGPT Image Apr 27, 2026, 02_20_40 PM (1).png' );
		?>
		<section class="vc-landing__about">
			<div class="vc-landing__container vc-landing__about-grid">
				<div class="vc-landing__about-copy">
					<?php if ( $about_icon ) : ?>
						<div class="vc-landing__round-icon"><img src="<?php echo esc_url( $about_icon ); ?>" alt=""></div>
					<?php endif; ?>
					<div>
						<h2 class="vc-landing__section-title vc-landing__section-title--left"><?php echo esc_html( $settings['about_title'] ); ?></h2>
						<p><?php echo esc_html( $settings['about_text'] ); ?></p>
					</div>
				</div>
				<div class="vc-landing__focus-list">
					<?php foreach ( $settings['focus_items'] as $item ) : ?>
						<?php $icon = $this->get_media_url( $item['focus_icon'] ); ?>
						<div class="vc-landing__focus-item">
							<?php if ( $icon ) : ?><span><img src="<?php echo esc_url( $icon ); ?>" alt=""></span><?php endif; ?>
							<strong><?php echo esc_html( $item['focus_title'] ); ?></strong>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}

	private function render_programs( $settings ) {
		?>
		<section id="programok" class="vc-landing__section vc-landing__programs">
			<div class="vc-landing__container">
				<h2 class="vc-landing__section-title"><?php echo esc_html( $settings['programs_title'] ); ?></h2>
				<div class="vc-landing__program-grid">
					<?php foreach ( $settings['program_items'] as $item ) : ?>
						<?php $icon = $this->get_media_url( $item['program_icon'] ); ?>
						<article class="vc-landing__program-card">
							<?php if ( $icon ) : ?><img class="vc-landing__program-icon" src="<?php echo esc_url( $icon ); ?>" alt=""><?php endif; ?>
							<h3><?php echo esc_html( $item['program_title'] ); ?></h3>
							<p><?php echo esc_html( $item['program_text'] ); ?></p>
							<?php $this->render_text_link( $item['program_link_text'], $item['program_link'] ); ?>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}

	private function render_events( $settings ) {
		$source = isset( $settings['events_source'] ) ? $settings['events_source'] : 'dynamic';
		$events = 'dynamic' === $source ? $this->get_dynamic_events( $settings ) : $this->get_manual_events( $settings );

		if ( empty( $events ) && 'dynamic' === $source && ( ! isset( $settings['events_fallback_to_manual'] ) || 'yes' === $settings['events_fallback_to_manual'] ) ) {
			$events = $this->get_manual_events( $settings );
		}

		if ( empty( $events ) ) {
			return;
		}
		?>
		<section id="esemenyek" class="vc-landing__section vc-landing__events">
			<div class="vc-landing__container">
				<div class="vc-landing__section-head">
					<div>
						<h2 class="vc-landing__section-title vc-landing__section-title--left"><?php echo esc_html( $settings['events_title'] ); ?></h2>
						<?php if ( ! empty( $settings['events_intro'] ) ) : ?><p class="vc-landing__section-lead"><?php echo esc_html( $settings['events_intro'] ); ?></p><?php endif; ?>
					</div>
					<?php $this->render_text_link( $settings['events_all_text'], $settings['events_all_link'], 'vc-landing__all-link' ); ?>
				</div>
				<div class="vc-landing__event-grid">
					<?php foreach ( $events as $item ) : ?>
						<?php $image = ! empty( $item['image'] ) ? $item['image'] : ''; ?>
						<article class="vc-landing__event-card <?php echo empty( $image ) ? 'vc-landing__event-card--no-image' : ''; ?>">
							<?php if ( $image ) : ?>
								<?php if ( ! empty( $item['url'] ) && '#' !== $item['url'] ) : ?>
									<a class="vc-landing__event-image-link" href="<?php echo esc_url( $item['url'] ); ?>" aria-label="<?php echo esc_attr( $item['title'] ); ?>">
										<img class="vc-landing__event-image" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" loading="lazy">
									</a>
								<?php else : ?>
									<div class="vc-landing__event-image-link">
										<img class="vc-landing__event-image" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" loading="lazy">
									</div>
								<?php endif; ?>
							<?php endif; ?>
							<div class="vc-landing__event-body">
								<?php if ( ! empty( $item['date_month'] ) || ! empty( $item['date_day'] ) ) : ?>
									<div class="vc-landing__date-badge">
										<?php if ( ! empty( $item['date_month'] ) ) : ?><span class="vc-landing__date-month"><?php echo esc_html( $item['date_month'] ); ?></span><?php endif; ?>
										<?php if ( ! empty( $item['date_day'] ) ) : ?><span class="vc-landing__date-day"><?php echo esc_html( $item['date_day'] ); ?></span><?php endif; ?>
									</div>
								<?php elseif ( ! empty( $item['date_badge'] ) ) : ?>
									<div class="vc-landing__date-badge"><?php echo esc_html( $item['date_badge'] ); ?></div>
								<?php endif; ?>
								<h3>
									<?php if ( ! empty( $item['url'] ) && '#' !== $item['url'] ) : ?>
										<a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['title'] ); ?></a>
									<?php else : ?>
										<?php echo esc_html( $item['title'] ); ?>
									<?php endif; ?>
								</h3>
								<?php if ( ! empty( $item['text'] ) ) : ?><p><?php echo esc_html( $item['text'] ); ?></p><?php endif; ?>
								<ul>
									<?php if ( ! empty( $item['time'] ) ) : ?><li><?php echo esc_html( $item['time'] ); ?></li><?php endif; ?>
									<?php if ( ! empty( $item['place'] ) ) : ?><li><?php echo esc_html( $item['place'] ); ?></li><?php endif; ?>
								</ul>
								<?php $this->render_text_link( $item['link_text'], array( 'url' => $item['url'] ), 'vc-landing__small-button' ); ?>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}

	private function get_manual_events( $settings ) {
		$events = array();
		$items  = ! empty( $settings['event_items'] ) && is_array( $settings['event_items'] ) ? $settings['event_items'] : array();

		foreach ( $items as $item ) {
			$events[] = array(
				'image'      => $this->get_media_url( isset( $item['event_image'] ) ? $item['event_image'] : array() ),
				'date_badge' => isset( $item['event_date_badge'] ) ? $item['event_date_badge'] : '',
				'date_month' => '',
				'date_day'   => '',
				'title'      => isset( $item['event_title'] ) ? $item['event_title'] : '',
				'text'       => isset( $item['event_text'] ) ? $item['event_text'] : '',
				'time'       => isset( $item['event_time'] ) ? $item['event_time'] : '',
				'place'      => isset( $item['event_place'] ) ? $item['event_place'] : '',
				'link_text'  => isset( $item['event_link_text'] ) ? $item['event_link_text'] : esc_html__( 'Részletek', 'vitacenter-elementor-header' ),
				'url'        => isset( $item['event_link']['url'] ) ? $item['event_link']['url'] : '#',
			);
		}

		return $events;
	}

	private function get_dynamic_events( $settings ) {
		$post_type = $this->resolve_event_post_type( isset( $settings['events_post_type'] ) ? $settings['events_post_type'] : 'auto' );

		if ( '' === $post_type ) {
			return array();
		}

		$count    = max( 1, min( 12, absint( isset( $settings['events_count'] ) ? $settings['events_count'] : 3 ) ) );

		if ( 'tribe_events' === $post_type ) {
			return $this->get_tribe_events( $settings, $count );
		}

		$date_key = ! empty( $settings['events_date_meta_key'] ) ? trim( $settings['events_date_meta_key'] ) : $this->get_default_event_date_meta_key( $post_type );
		$future_only = ! isset( $settings['events_future_only'] ) || 'yes' === $settings['events_future_only'];
		$args     = array(
			'post_type'           => $post_type,
			'post_status'         => 'publish',
			'posts_per_page'      => max( $count * 4, $count ),
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		);

		if ( $date_key ) {
			$is_numeric_date  = in_array( $date_key, array( 'evcal_srow', 'evcal_erow' ), true );
			$args['meta_key'] = $date_key;
			$args['orderby']  = $is_numeric_date ? 'meta_value_num' : 'meta_value';
			$args['order']    = 'ASC';

			if ( $future_only ) {
				$args['meta_query'] = array(
					array(
						'key'     => $date_key,
						'value'   => $is_numeric_date ? current_time( 'timestamp' ) : current_time( 'Y-m-d' ),
						'compare' => '>=',
						'type'    => $is_numeric_date ? 'NUMERIC' : 'CHAR',
					),
				);
			}
		} else {
			$args['orderby'] = 'date';
			$args['order']   = 'DESC';
		}

		$query  = new WP_Query( $args );
		$events = array();

		foreach ( $query->posts as $post ) {
			$event = $this->format_dynamic_event( $post, $post_type, $date_key, $settings );

			if ( $future_only && ! empty( $event['timestamp'] ) && $event['timestamp'] < strtotime( 'today', current_time( 'timestamp' ) ) ) {
				continue;
			}

			$events[] = $event;

			if ( count( $events ) >= $count ) {
				break;
			}
		}

		wp_reset_postdata();

		return $events;
	}

	private function get_tribe_events( $settings, $count ) {
		if ( ! post_type_exists( 'tribe_events' ) ) {
			return array();
		}

		$future_only = ! isset( $settings['events_future_only'] ) || 'yes' === $settings['events_future_only'];
		$today       = current_time( 'Y-m-d H:i:s' );
		$args        = array(
			'post_type'           => 'tribe_events',
			'posts_per_page'      => $count,
			'post_status'         => 'publish',
			'meta_key'            => '_EventStartDate',
			'orderby'             => 'meta_value',
			'order'               => 'ASC',
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		);

		if ( $future_only ) {
			$args['meta_query'] = array(
				array(
					'key'     => '_EventStartDate',
					'value'   => $today,
					'compare' => '>=',
					'type'    => 'DATETIME',
				),
			);
		}

		$query  = new WP_Query( $args );
		$events = array();

		foreach ( $query->posts as $post ) {
			$events[] = $this->format_tribe_event( $post, $settings );
		}

		wp_reset_postdata();

		return $events;
	}

	private function format_tribe_event( $post, $settings ) {
		$event_id      = $post->ID;
		$start_raw     = get_post_meta( $event_id, '_EventStartDate', true );
		$end_raw       = get_post_meta( $event_id, '_EventEndDate', true );
		$start_ts      = ! empty( $start_raw ) && strtotime( $start_raw ) ? strtotime( $start_raw ) : 0;
		$end_ts        = ! empty( $end_raw ) && strtotime( $end_raw ) ? strtotime( $end_raw ) : 0;
		$date_day      = '';
		$date_month    = '';
		$date_display  = '';
		$venue         = '';
		$image         = get_the_post_thumbnail_url( $event_id, 'large' );
		$excerpt       = get_the_excerpt( $event_id );
		$fallback      = $this->source_asset_url( 'index_hero_vitacenter.jpg' );

		if ( $start_ts ) {
			$date_day   = date_i18n( 'j', $start_ts );
			$month      = date_i18n( 'M', $start_ts );
			$date_month = function_exists( 'mb_strtoupper' ) ? mb_strtoupper( $month, 'UTF-8' ) : strtoupper( $month );

			if ( function_exists( 'tribe_get_start_date' ) ) {
				$date_display = tribe_get_start_date( $event_id, false, 'Y. F j. H:i' );
			} else {
				$date_display = date_i18n( 'Y. F j. H:i', $start_ts );
			}

			if ( $end_ts ) {
				$start_day = date_i18n( 'Y-m-d', $start_ts );
				$end_day   = date_i18n( 'Y-m-d', $end_ts );

				if ( $start_day !== $end_day ) {
					$date_display = date_i18n( 'Y. F j.', $start_ts ) . ' - ' . date_i18n( 'j.', $end_ts );
				}
			}
		}

		if ( function_exists( 'tribe_get_venue' ) ) {
			$venue = tribe_get_venue( $event_id );
		}

		if ( empty( $venue ) ) {
			$venue_id = get_post_meta( $event_id, '_EventVenueID', true );

			if ( ! empty( $venue_id ) && is_numeric( $venue_id ) ) {
				$venue_post = get_post( (int) $venue_id );

				if ( $venue_post && ! is_wp_error( $venue_post ) ) {
					$venue = $venue_post->post_title;
				}
			}
		}

		if ( empty( $excerpt ) ) {
			$content = get_post_field( 'post_content', $event_id );
			$excerpt = wp_trim_words( wp_strip_all_tags( $content ), 14, '...' );
		} else {
			$excerpt = wp_trim_words( wp_strip_all_tags( $excerpt ), 14, '...' );
		}

		return array(
			'image'      => $image ? $image : $fallback,
			'date_badge' => '',
			'date_month' => $date_month,
			'date_day'   => $date_day,
			'title'      => get_the_title( $event_id ),
			'text'       => $excerpt,
			'time'       => $date_display,
			'place'      => $venue,
			'link_text'  => ! empty( $settings['events_dynamic_link_text'] ) ? $settings['events_dynamic_link_text'] : esc_html__( 'Részletek', 'vitacenter-elementor-header' ),
			'url'        => get_permalink( $event_id ),
			'timestamp'  => $start_ts,
		);
	}

	private function format_dynamic_event( $post, $post_type, $date_key, $settings ) {
		$post_id        = $post->ID;
		$date_raw       = $date_key ? get_post_meta( $post_id, $date_key, true ) : $this->get_first_meta_value( $post_id, $this->get_event_date_meta_candidates( $post_type ) );
		$timestamp      = $this->parse_event_timestamp( $date_raw );
		$excerpt        = has_excerpt( $post_id ) ? get_the_excerpt( $post_id ) : wp_trim_words( wp_strip_all_tags( strip_shortcodes( $post->post_content ) ), 18 );
		$fallback_image = $this->source_asset_url( 'index_hero_vitacenter.jpg' );
		$image          = get_the_post_thumbnail_url( $post_id, 'large' );

		return array(
			'image'      => $image ? $image : $fallback_image,
			'date_badge' => $this->format_event_date_badge( $timestamp ),
			'date_month' => '',
			'date_day'   => '',
			'title'      => get_the_title( $post_id ),
			'text'       => $excerpt,
			'time'       => $this->format_event_time( $post_id, $post_type, $date_raw, $timestamp ),
			'place'      => $this->get_event_place( $post_id, $post_type, isset( $settings['events_location_meta_key'] ) ? $settings['events_location_meta_key'] : '' ),
			'link_text'  => ! empty( $settings['events_dynamic_link_text'] ) ? $settings['events_dynamic_link_text'] : esc_html__( 'Részletek', 'vitacenter-elementor-header' ),
			'url'        => get_permalink( $post_id ),
			'timestamp'  => $timestamp,
		);
	}

	private function resolve_event_post_type( $selected ) {
		if ( 'auto' !== $selected && post_type_exists( $selected ) ) {
			return $selected;
		}

		foreach ( $this->get_event_post_type_candidates() as $post_type ) {
			if ( post_type_exists( $post_type ) ) {
				return $post_type;
			}
		}

		return '';
	}

	private function get_event_post_type_options() {
		$options = array(
			'auto' => esc_html__( 'Automatikus felismerés', 'vitacenter-elementor-header' ),
		);
		$types  = get_post_types( array( 'public' => true ), 'objects' );
		$labels = array(
			'tribe_events' => esc_html__( 'The Events Calendar', 'vitacenter-elementor-header' ),
			'event'        => esc_html__( 'Event', 'vitacenter-elementor-header' ),
			'events'       => esc_html__( 'Events', 'vitacenter-elementor-header' ),
			'mec-events'   => esc_html__( 'Modern Events Calendar', 'vitacenter-elementor-header' ),
			'ajde_events'  => esc_html__( 'EventON', 'vitacenter-elementor-header' ),
		);

		foreach ( $this->get_event_post_type_candidates() as $candidate ) {
			if ( isset( $types[ $candidate ] ) ) {
				$options[ $candidate ] = $types[ $candidate ]->labels->singular_name . ' (' . $candidate . ')';
				unset( $types[ $candidate ] );
			} else {
				$options[ $candidate ] = $labels[ $candidate ] . ' (' . $candidate . ')';
			}
		}

		foreach ( $types as $post_type => $object ) {
			$options[ $post_type ] = $object->labels->singular_name . ' (' . $post_type . ')';
		}

		return $options;
	}

	private function get_event_post_type_candidates() {
		return array( 'tribe_events', 'event', 'events', 'mec-events', 'ajde_events' );
	}

	private function get_default_event_date_meta_key( $post_type ) {
		$map = array(
			'tribe_events' => '_EventStartDate',
			'event'        => '_event_start_date',
			'events'       => '_event_start_date',
			'mec-events'   => 'mec_start_date',
			'ajde_events'  => 'evcal_srow',
		);

		return isset( $map[ $post_type ] ) ? $map[ $post_type ] : '';
	}

	private function get_event_date_meta_candidates( $post_type ) {
		$candidates = array( $this->get_default_event_date_meta_key( $post_type ), '_EventStartDate', '_event_start_date', 'mec_start_date', 'event_start_date', 'start_date', 'event_date', 'date', 'evcal_srow' );

		return array_values( array_filter( array_unique( $candidates ) ) );
	}

	private function get_event_location_meta_candidates( $post_type ) {
		$candidates = array( '_EventVenueID', '_event_location_id', 'mec_location_id', 'location_id', 'venue_id', '_EventVenue', '_VenueVenue', 'event_location', 'location', 'venue', 'helyszin' );

		if ( 'tribe_events' === $post_type ) {
			array_unshift( $candidates, '_EventVenueID' );
		}

		return array_values( array_filter( array_unique( $candidates ) ) );
	}

	private function get_first_meta_value( $post_id, $keys ) {
		foreach ( $keys as $key ) {
			if ( '' === $key ) {
				continue;
			}

			$value = get_post_meta( $post_id, $key, true );

			if ( '' !== $value && array() !== $value ) {
				return $value;
			}
		}

		return '';
	}

	private function get_event_place( $post_id, $post_type, $custom_key = '' ) {
		$custom_key = trim( $custom_key );
		$keys       = $custom_key ? array( $custom_key ) : $this->get_event_location_meta_candidates( $post_type );

		foreach ( $keys as $key ) {
			$value = get_post_meta( $post_id, $key, true );

			if ( '' === $value || array() === $value ) {
				continue;
			}

			$place = $this->normalize_event_place_value( $value );

			if ( '' !== $place ) {
				return $place;
			}
		}

		foreach ( array( 'mec_location', 'tribe_venue', 'event_location', 'location' ) as $taxonomy ) {
			$terms = taxonomy_exists( $taxonomy ) ? get_the_terms( $post_id, $taxonomy ) : false;

			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				return $terms[0]->name;
			}
		}

		return '';
	}

	private function normalize_event_place_value( $value ) {
		if ( is_array( $value ) ) {
			$value = reset( $value );
		}

		if ( is_numeric( $value ) ) {
			$post = get_post( absint( $value ) );

			if ( $post ) {
				return get_the_title( $post );
			}

			$term = get_term( absint( $value ) );

			if ( $term && ! is_wp_error( $term ) ) {
				return $term->name;
			}
		}

		return is_scalar( $value ) ? wp_strip_all_tags( (string) $value ) : '';
	}

	private function parse_event_timestamp( $date_raw ) {
		if ( empty( $date_raw ) ) {
			return 0;
		}

		if ( is_numeric( $date_raw ) ) {
			return absint( $date_raw );
		}

		$timestamp = strtotime( (string) $date_raw );

		return $timestamp ? $timestamp : 0;
	}

	private function format_event_date_badge( $timestamp ) {
		if ( ! $timestamp ) {
			return '';
		}

		$month = date_i18n( 'M', $timestamp );

		return function_exists( 'mb_strtoupper' ) ? mb_strtoupper( $month ) : strtoupper( $month );
	}

	private function format_event_time( $post_id, $post_type, $date_raw, $timestamp ) {
		if ( ! $timestamp ) {
			return '';
		}

		$time_raw = $this->get_first_meta_value( $post_id, array( '_event_start_time', 'event_start_time', 'start_time' ) );
		$end_raw  = $this->get_first_meta_value( $post_id, array( '_EventEndDate', '_event_end_date', 'mec_end_date', 'event_end_date', 'end_date' ) );
		$end_time = $this->get_first_meta_value( $post_id, array( '_event_end_time', 'event_end_time', 'end_time' ) );
		$has_time = preg_match( '/\d{1,2}:\d{2}/', (string) $date_raw . ' ' . (string) $time_raw );

		if ( $time_raw && ! preg_match( '/\d{1,2}:\d{2}/', (string) $date_raw ) ) {
			$timestamp = $this->parse_event_timestamp( trim( $date_raw . ' ' . $time_raw ) );
			$has_time  = true;
		}

		$format = $has_time ? 'Y. F j. H:i' : 'Y. F j.';
		$output = date_i18n( $format, $timestamp );
		$end_ts = $this->parse_event_timestamp( trim( $end_raw . ' ' . $end_time ) );

		if ( $end_ts && $end_ts > $timestamp ) {
			$output .= date_i18n( 'Y-m-d', $end_ts ) === date_i18n( 'Y-m-d', $timestamp ) && ( $has_time || $end_time ) ? ' - ' . date_i18n( 'H:i', $end_ts ) : ' - ' . date_i18n( $format, $end_ts );
		}

		return $output;
	}

	private function render_cta( $settings ) {
		$icon = $this->get_media_url( $settings['cta_icon'], 'ChatGPT Image Apr 27, 2026, 02_20_41 PM (5).png' );
		?>
		<section class="vc-landing__cta-wrap">
			<div class="vc-landing__container">
				<div class="vc-landing__cta">
					<?php if ( $icon ) : ?><img src="<?php echo esc_url( $icon ); ?>" alt=""><?php endif; ?>
					<div>
						<h2><?php echo esc_html( $settings['cta_title'] ); ?></h2>
						<p><?php echo esc_html( $settings['cta_text'] ); ?></p>
					</div>
					<?php $this->render_button( $settings['cta_button_text'], $settings['cta_button_link'], 'vc-landing__button vc-landing__button--light' ); ?>
				</div>
			</div>
		</section>
		<?php
	}

	private function render_articles( $settings ) {
		?>
		<section id="tudastar" class="vc-landing__section vc-landing__articles">
			<div class="vc-landing__container">
				<div class="vc-landing__section-head">
					<h2 class="vc-landing__section-title vc-landing__section-title--left"><?php echo esc_html( $settings['articles_title'] ); ?></h2>
					<?php $this->render_text_link( $settings['articles_all_text'], $settings['articles_all_link'], 'vc-landing__all-link' ); ?>
				</div>
				<div class="vc-landing__article-grid">
					<?php foreach ( $settings['article_items'] as $item ) : ?>
						<?php $image = $this->get_media_url( $item['article_image'] ); ?>
						<article class="vc-landing__article-card">
							<?php if ( $image ) : ?><img src="<?php echo esc_url( $image ); ?>" alt=""><?php endif; ?>
							<div>
								<h3><?php echo esc_html( $item['article_title'] ); ?></h3>
								<p><?php echo esc_html( $item['article_text'] ); ?></p>
								<?php $this->render_text_link( $item['article_link_text'], $item['article_link'] ); ?>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}

	private function render_contact_footer( $settings ) {
		?>
		<section id="kapcsolat" class="vc-landing__contact-wrap">
			<div class="vc-landing__container">
				<div class="vc-landing__contact-bar">
					<?php $this->render_contact_item( 'phone', $settings['contact_phone_label'], $settings['contact_phone'] ); ?>
					<?php $this->render_contact_item( 'mail', $settings['contact_email_label'], $settings['contact_email'] ); ?>
					<?php $this->render_contact_item( 'pin', $settings['contact_address_label'], $settings['contact_address'] ); ?>
					<?php $this->render_button( $settings['contact_button_text'], $settings['contact_button_link'], 'vc-landing__button vc-landing__button--outline' ); ?>
				</div>
				<footer class="vc-landing__footer">
					<span><?php echo esc_html( $settings['footer_copyright'] ); ?></span>
					<span><?php echo esc_html( $settings['footer_project'] ); ?></span>
					<nav>
						<?php $this->render_plain_link( $settings['footer_privacy_text'], $settings['footer_privacy_link'] ); ?>
						<?php $this->render_plain_link( $settings['footer_imprint_text'], $settings['footer_imprint_link'] ); ?>
					</nav>
				</footer>
			</div>
		</section>
		<?php
	}

	private function render_contact_item( $type, $label, $value ) {
		?>
		<div class="vc-landing__contact-item vc-landing__contact-item--<?php echo esc_attr( $type ); ?>">
			<span aria-hidden="true"></span>
			<div>
				<strong><?php echo esc_html( $label ); ?></strong>
				<p><?php echo esc_html( $value ); ?></p>
			</div>
		</div>
		<?php
	}

	private function render_button( $text, $link, $class ) {
		if ( '' === $text ) {
			return;
		}
		?>
		<a class="<?php echo esc_attr( $class ); ?>" <?php echo $this->get_url_attributes( $link ); ?>>
			<span><?php echo esc_html( $text ); ?></span>
			<i aria-hidden="true">&#8594;</i>
		</a>
		<?php
	}

	private function render_text_link( $text, $link, $class = 'vc-landing__text-link' ) {
		if ( '' === $text ) {
			return;
		}
		?>
		<a class="<?php echo esc_attr( $class ); ?>" <?php echo $this->get_url_attributes( $link ); ?>>
			<span><?php echo esc_html( $text ); ?></span>
			<i aria-hidden="true">&#8594;</i>
		</a>
		<?php
	}

	private function render_plain_link( $text, $link ) {
		if ( '' === $text ) {
			return;
		}
		?>
		<a <?php echo $this->get_url_attributes( $link ); ?>><?php echo esc_html( $text ); ?></a>
		<?php
	}

	private function format_multiline( $text ) {
		return nl2br( esc_html( $text ) );
	}

	private function media_default( $file_name ) {
		return array( 'url' => $this->source_asset_url( $file_name ) );
	}

	private function get_media_url( $media, $fallback_file = '' ) {
		if ( ! empty( $media['url'] ) ) {
			return $media['url'];
		}

		return $fallback_file ? $this->source_asset_url( $fallback_file ) : '';
	}

	private function source_asset_url( $file_name ) {
		return VC_ELEMENTOR_HEADER_URL . 'source/' . rawurlencode( $file_name );
	}

	private function get_url_attributes( $url_control ) {
		$url = isset( $url_control['url'] ) ? $url_control['url'] : '#';

		if ( '' === $url ) {
			$url = '#';
		}

		$attributes = array( 'href="' . esc_url( $url ) . '"' );
		$rel        = array();

		if ( ! empty( $url_control['is_external'] ) ) {
			$attributes[] = 'target="_blank"';
			$rel[]        = 'noopener';
		}

		if ( ! empty( $url_control['nofollow'] ) ) {
			$rel[] = 'nofollow';
		}

		if ( $rel ) {
			$attributes[] = 'rel="' . esc_attr( implode( ' ', array_unique( $rel ) ) ) . '"';
		}

		return implode( ' ', $attributes );
	}
}
