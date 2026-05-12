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
				'default'     => esc_html__( "Szűrés. Prevenció. Életmód.\nEgyütt a hosszabb életért.", 'vitacenter-elementor-header' ),
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
				'default'     => esc_html__( 'Az IPOP ROHU00259 projekt célja Szatmár megye lakosságának egészségi állapotának javítása, a demográfiai kihívások kezelése és a közösségi alapú egészségügyi ellátás erősítése a megelőzés és a tudatos életmód támogatásával.', 'vitacenter-elementor-header' ),
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
					array( 'program_title' => esc_html__( 'Ciklusoktatás', 'vitacenter-elementor-header' ), 'program_text' => esc_html__( 'Termékenységtudatosság és egészségnevelés fiatal nőknek.', 'vitacenter-elementor-header' ), 'program_icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_00 PM (1).png' ), 'program_link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ), 'program_link' => array( 'url' => '#ciklusoktatas' ) ),
					array( 'program_title' => esc_html__( 'Meddőségi tanácsadás', 'vitacenter-elementor-header' ), 'program_text' => esc_html__( 'Komplex, életmód-alapú megközelítés szakmai háttérrel.', 'vitacenter-elementor-header' ), 'program_icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_00 PM (2).png' ), 'program_link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ), 'program_link' => array( 'url' => '#meddosegi-tanacsadas' ) ),
					array( 'program_title' => esc_html__( 'Egészségfejlesztési Iroda', 'vitacenter-elementor-header' ), 'program_text' => esc_html__( 'Egyéni és csoportos prevenciós tanácsadás.', 'vitacenter-elementor-header' ), 'program_icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_00 PM (3).png' ), 'program_link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ), 'program_link' => array( 'url' => '#efi' ) ),
					array( 'program_title' => esc_html__( 'Mobil szakorvosi szolgálat', 'vitacenter-elementor-header' ), 'program_text' => esc_html__( 'Helyben elérhető kardiovaszkuláris és nőgyógyászati szűrések.', 'vitacenter-elementor-header' ), 'program_icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_01 PM (4).png' ), 'program_link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ), 'program_link' => array( 'url' => '#mobil-szakorvosi' ) ),
					array( 'program_title' => esc_html__( 'Életmódtanácsadás', 'vitacenter-elementor-header' ), 'program_text' => esc_html__( 'Személyre szabott támogatás az egyéni egészségtervhez.', 'vitacenter-elementor-header' ), 'program_icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_01 PM (5).png' ), 'program_link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ), 'program_link' => array( 'url' => '#eletmodtanacsadas' ) ),
					array( 'program_title' => esc_html__( 'Óvodás iskolaérettséget vizsgáló szűrések', 'vitacenter-elementor-header' ), 'program_text' => esc_html__( 'Iskolaérettségi, szenzo-motoros és pszichológiai szűrések.', 'vitacenter-elementor-header' ), 'program_icon' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_01 PM (6).png' ), 'program_link_text' => esc_html__( 'Részletek', 'vitacenter-elementor-header' ), 'program_link' => array( 'url' => '#ovodas-szuresek' ) ),
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
		$this->add_control( 'events_all_text', array( 'label' => esc_html__( 'Összes link felirat', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Összes esemény megtekintése', 'vitacenter-elementor-header' ) ) );
		$this->add_control( 'events_all_link', array( 'label' => esc_html__( 'Összes link', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#esemenyek' ) ) );

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
		$this->add_control( 'cta_text', array( 'label' => esc_html__( 'Szöveg', 'vitacenter-elementor-header' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Foglaljon időpontot, vegyen részt programjainkon, tegyen többet önmagáért és családjáért!', 'vitacenter-elementor-header' ) ) );
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
					array( 'article_title' => esc_html__( 'A megelőzés ereje', 'vitacenter-elementor-header' ), 'article_text' => esc_html__( 'Miért fontosak a rendszeres szűrések és a korai felismerés?', 'vitacenter-elementor-header' ), 'article_image' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_20_40 PM (2).png' ) ),
					array( 'article_title' => esc_html__( 'Egészséges életmód', 'vitacenter-elementor-header' ), 'article_text' => esc_html__( 'Gyakorlati tippek a mindennapokra a jobb közérzetért.', 'vitacenter-elementor-header' ), 'article_image' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_42_01 PM (5).png' ) ),
					array( 'article_title' => esc_html__( 'Demográfiai kihívások', 'vitacenter-elementor-header' ), 'article_text' => esc_html__( 'Hogyan támogathatjuk családjainkat és közösségeinket?', 'vitacenter-elementor-header' ), 'article_image' => $this->media_default( 'ChatGPT Image Apr 27, 2026, 02_20_41 PM (4).png' ) ),
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
		?>
		<section id="esemenyek" class="vc-landing__section vc-landing__events">
			<div class="vc-landing__container">
				<div class="vc-landing__section-head">
					<h2 class="vc-landing__section-title vc-landing__section-title--left"><?php echo esc_html( $settings['events_title'] ); ?></h2>
					<?php $this->render_text_link( $settings['events_all_text'], $settings['events_all_link'], 'vc-landing__all-link' ); ?>
				</div>
				<div class="vc-landing__event-grid">
					<?php foreach ( $settings['event_items'] as $item ) : ?>
						<?php $image = $this->get_media_url( $item['event_image'] ); ?>
						<article class="vc-landing__event-card">
							<?php if ( $image ) : ?><img class="vc-landing__event-image" src="<?php echo esc_url( $image ); ?>" alt=""><?php endif; ?>
							<div class="vc-landing__event-body">
								<span class="vc-landing__date-badge"><?php echo esc_html( $item['event_date_badge'] ); ?></span>
								<h3><?php echo esc_html( $item['event_title'] ); ?></h3>
								<p><?php echo esc_html( $item['event_text'] ); ?></p>
								<ul>
									<li><?php echo esc_html( $item['event_time'] ); ?></li>
									<li><?php echo esc_html( $item['event_place'] ); ?></li>
								</ul>
								<?php $this->render_text_link( $item['event_link_text'], $item['event_link'], 'vc-landing__small-button' ); ?>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
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
