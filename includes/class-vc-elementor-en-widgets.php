<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * English variants for the Hungarian VitaCenter widgets.
 *
 * The EN widgets reuse the original widget renderers so the visual structure,
 * controls and CSS classes stay identical. Text is translated at render/control
 * registration time, using homepage.docx as the primary English source.
 */
final class VitaCenter_EN_Text {
	const DOMAIN  = 'vitacenter-elementor-header';
	const PHONE   = '0742021316';
	const EMAIL   = 'contact@vitacenter.ro';
	const ADDRESS = '13 Ștefan cel Mare Street, Satu Mare';

	private static $filter_depth = 0;
	private static $map          = null;

	public static function begin_filter() {
		if ( 0 === self::$filter_depth && function_exists( 'add_filter' ) ) {
			add_filter( 'gettext', array( __CLASS__, 'gettext' ), 20, 3 );
		}

		self::$filter_depth++;
	}

	public static function end_filter() {
		self::$filter_depth = max( 0, self::$filter_depth - 1 );

		if ( 0 === self::$filter_depth && function_exists( 'remove_filter' ) ) {
			remove_filter( 'gettext', array( __CLASS__, 'gettext' ), 20 );
		}
	}

	public static function gettext( $translation, $text, $domain ) {
		if ( self::DOMAIN !== $domain ) {
			return $translation;
		}

		return self::translate_text( $text );
	}

	public static function translate_value( $value ) {
		if ( is_array( $value ) ) {
			foreach ( $value as $key => $item ) {
				$value[ $key ] = self::translate_value( $item );
			}

			return $value;
		}

		if ( is_string( $value ) ) {
			return self::translate_text( $value );
		}

		return $value;
	}

	public static function translate_text( $text ) {
		$text = (string) $text;

		if ( 'É' === $text ) {
			return 'H';
		}

		$map = self::map();

		if ( isset( $map[ $text ] ) ) {
			return $map[ $text ];
		}

		$decoded = html_entity_decode( $text, ENT_QUOTES, 'UTF-8' );

		if ( $decoded !== $text && isset( $map[ $decoded ] ) ) {
			return $map[ $decoded ];
		}

		$normalized = str_replace( array( '–', '—', '‑' ), '-', $decoded );

		if ( preg_match( '/\b[HL]\s*-\s*[PV]\b/i', $normalized ) && false !== strpos( $normalized, '8:00' ) && false !== strpos( $normalized, '16:00' ) ) {
			return 'Book an Appointment';
		}

		$fallback = self::translate_control_label_fallback( $decoded );
		if ( $fallback !== $decoded ) {
			return $fallback;
		}

		return $text;
	}

	public static function translate_markup( $html ) {
		$map = self::map();
		uksort(
			$map,
			static function ( $a, $b ) {
				return strlen( $b ) <=> strlen( $a );
			}
		);

		foreach ( $map as $source => $target ) {
			if ( '' === $source || $source === $target ) {
				continue;
			}

			$html = str_replace( $source, $target, $html );
			$html = str_replace( htmlspecialchars( $source, ENT_QUOTES, 'UTF-8' ), htmlspecialchars( $target, ENT_QUOTES, 'UTF-8' ), $html );
		}

		$html = preg_replace( '/\b[HL]\s*[-–—‑]\s*[PV]\s*:\s*8:00\s*[-–—‑]\s*16:00\b/u', 'Book an Appointment', $html );
		$html = preg_replace( '/>\s*É\s*</u', '>H<', $html );

		return $html;
	}

	private static function translate_control_label_fallback( $text ) {
		if ( preg_match( '~^(#|/|https?://)~i', $text ) || preg_match( '/^\d{4}\./', $text ) ) {
			return $text;
		}

		if ( ! preg_match( '/[áéíóöőúüűÁÉÍÓÖŐÚÜŰ]|\b(cím|Cím|szöveg|Szöveg|gomb|Gomb|link|kártya|Kártya|címke|Címke|megjelenít|mutatása|felirat|Felirat|háttér|Háttér|szín|Szín|menü|Menü|galéria|Galéria|kép|Kép|fotó|Fotó|videó|Videó|esemény|Esemény|program|Program|szekció|Szekció|mező|Mező|űrlap|Űrlap|oldal|Oldal|oldalsáv|Oldalsáv|lábléc|Lábléc|tartalom|Tartalom|logó|Logó|bevezető|Bevezető|lista|Lista|elem|Elem|kérdés|Kérdés|válasz|Válasz|letölt|Letölt|stílus|Stílus|tipográfia|Tipográfia|távolság|Távolság|térköz|Térköz|adat|Adat|honlap|Honlap|nyilatkozat|Nyilatkozat|akcentus|Akcentus|aktív|Aktív|kézi|Kézi|mobil|Mobil|hero|Hero)\b/u', $text ) ) {
			return $text;
		}

		$phrases = array(
			'VitaCenter Fejléc/Nav' => 'VitaCenter Header/Nav',
			'VitaCenter Kezdőlap' => 'VitaCenter Homepage',
			'VitaCenter Fejléc felső rész' => 'VitaCenter Header Top',
			'VitaCenter Fejléc menü' => 'VitaCenter Header Menu',
			'VitaCenter Projekt bemutató' => 'VitaCenter Project Intro',
			'VitaCenter Programok' => 'VitaCenter Programs',
			'VitaCenter Események' => 'VitaCenter Events',
			'VitaCenter Közelgő események' => 'VitaCenter Upcoming Events',
			'VitaCenter Tudástár kártyák' => 'VitaCenter Knowledge Cards',
			'VitaCenter Tudástár' => 'VitaCenter Knowledge Center',
			'VitaCenter Fotó- és videógaléria' => 'VitaCenter Photo and Video Gallery',
			'VitaCenter Partnerek' => 'VitaCenter Partners',
			'VitaCenter Kapcsolat/Footer' => 'VitaCenter Contact/Footer',
			'VitaCenter Jogi lábléc' => 'VitaCenter Legal Footer',
			'VitaCenter Projekt tartalom' => 'VitaCenter Project Content',
			'VitaCenter Program tartalom' => 'VitaCenter Program Content',
			'VitaCenter Mobil szakorvosi szolgálat' => 'VitaCenter Mobile Specialist Medical Service',
			'VitaCenter Mobil szűrés' => 'VitaCenter Mobile Screening',
			'VitaCenter Ciklusoktatás' => 'VitaCenter Menstrual Cycle Education',
			'VitaCenter Egészségfejlesztési Iroda' => 'VitaCenter Health Promotion Office',
			'VitaCenter Életmódtanácsadás' => 'VitaCenter Lifestyle Counseling',
			'VitaCenter Iskolaérettség' => 'VitaCenter PreSchool Screening',
			'VitaCenter Info szekció' => 'VitaCenter Info Section',
			'VitaCenter Regisztráció / kapcsolat' => 'VitaCenter Registration / Contact',
			'Fotó- és videógaléria oldal' => 'Photo and Video Gallery Page',
			'Tudástár oldal' => 'Knowledge Center Page',
			'Tudástár oldalsáv' => 'Knowledge Center Sidebar',
			'Kapcsolat oldal' => 'Contact Page',
			'Regisztráció / Időpontfoglalás' => 'Registration / Appointment Booking',
			'Adatvédelem felirat' => 'Privacy Label',
			'Adatvédelem link' => 'Privacy Link',
			'Ajánlott célcsoportok' => 'Recommended Target Groups',
			'Ajánlás cím' => 'Recommendation Title',
			'Alapból nyitva' => 'Open by Default',
			'Aktív aláhúzás vastagság' => 'Active Underline Thickness',
			'Aktív kézi menüpont felirata' => 'Active Manual Menu Item Label',
			'Aktív/hover szín' => 'Active/Hover Color',
			'Alsó megjegyzés' => 'Bottom Note',
			'Alsó sor mutatása' => 'Show Bottom Row',
			'Alsó sáv háttér' => 'Bottom Bar Background',
			'Alsó vonal színe' => 'Bottom Line Color',
			'Alt szöveg / felirat' => 'Alt Text / Caption',
			'Automatikus felismerés' => 'Automatic Detection',
			'Bevezető szöveg' => 'Intro Text',
			'Cikk címe' => 'Article Title',
			'Cikk kártyák' => 'Article Cards',
			'Cikkek megjelenítése' => 'Show Articles',
			'Célok cím' => 'Objectives Title',
			'Cím címke' => 'Address Label',
			'Cím link' => 'Address Link',
			'Címke - cím' => 'Label - Address',
			'Címke - e-mail' => 'Label - E-mail',
			'Címke - telefon' => 'Label - Phone',
			'Dátum jelölő' => 'Date Badge',
			'Dátum meta kulcs' => 'Date Meta Key',
			'EU nyilatkozat mutatása' => 'Show EU Notice',
			'Elmúlt blokk címe' => 'Past Block Title',
			'Elmúlt jelölő felirat' => 'Past Badge Label',
			'Elmúlt kártya címke' => 'Past Card Label',
			'Első bevezető' => 'First Intro',
			'Első blokk cím' => 'First Block Title',
			'Első gomb felirata' => 'First Button Label',
			'Első gomb felirat' => 'First Button Label',
			'Első gomb link' => 'First Button Link',
			'Első kártya cím' => 'First Card Title',
			'Első kártya jelölés' => 'First Card Badge',
			'Első kártya szöveg' => 'First Card Text',
			'Első stat címke' => 'First Stat Label',
			'Első stat érték' => 'First Stat Value',
			'Esemény dátuma' => 'Event Date',
			'Esemény neve' => 'Event Name',
			'Esemény pluginből dinamikusan' => 'Dynamically from Event Plugin',
			'Esemény post type' => 'Event Post Type',
			'Események forrása' => 'Events Source',
			'Események száma' => 'Number of Events',
			'Eseménykezelő hiányzik szöveg' => 'Missing Event Manager Text',
			'Eseménykártyák' => 'Event Cards',
			'Extra link felirat' => 'Extra Link Label',
			'Fejléc stílus' => 'Header Style',
			'Felső sáv belső térköz' => 'Top Bar Inner Spacing',
			'Felső sáv háttér' => 'Top Bar Background',
			'Felső sáv szöveg' => 'Top Bar Text',
			'Fontosság cím' => 'Importance Title',
			'Fontossági elemek' => 'Importance Items',
			'Footer elérhetőségek' => 'Footer Contact Details',
			'Footer tartalom' => 'Footer Content',
			'Fő tartalom' => 'Main Content',
			'Galéria elem' => 'Gallery Item',
			'Galéria elemek' => 'Gallery Items',
			'Galéria elemek megjelenítése' => 'Show Gallery Items',
			'Galéria kategóriák' => 'Gallery Categories',
			'Galéria képek kiválasztása' => 'Select Gallery Images',
			'Galéria oldalsáv' => 'Gallery Sidebar',
			'Gomb felirat' => 'Button Label',
			'Gomb link' => 'Button Link',
			'Harmadik kártya cím' => 'Third Card Title',
			'Harmadik kártya jelölés' => 'Third Card Badge',
			'Harmadik kártya szöveg' => 'Third Card Text',
			'Harmadik stat címke' => 'Third Stat Label',
			'Harmadik stat érték' => 'Third Stat Value',
			'Hasznosság cím' => 'Usefulness Title',
			'Hasznosság elemek' => 'Usefulness Items',
			'Helyszín kártya cím' => 'Location Card Title',
			'Helyszín kártya szöveg' => 'Location Card Text',
			'Helyszín meta kulcs' => 'Location Meta Key',
			'Hero címsor tipográfia' => 'Hero Heading Typography',
			'Hero megjelenítése' => 'Show Hero',
			'Hero háttérkép' => 'Hero Background Image',
			'Honlap felirat' => 'Website Label',
			'Honlap link' => 'Website Link',
			'Időpont gomb link' => 'Appointment Button Link',
			'Időpont gomb' => 'Appointment Button',
			'Időpont kártya címke' => 'Appointment Card Label',
			'Időpont kártya cím' => 'Appointment Card Title',
			'Időpont kártya szöveg' => 'Appointment Card Text',
			'Időpontfoglalás CTA' => 'Appointment Booking CTA',
			'Impresszum felirat' => 'Imprint Label',
			'Impresszum link' => 'Imprint Link',
			'Jövőbeli blokk címe' => 'Upcoming Block Title',
			'Jövőbeli kártya címke' => 'Upcoming Card Label',
			'Kapcsolatfelvétel megjelenítése' => 'Show Contact',
			'Kapcsolat cím' => 'Contact Title',
			'Kapcsolat címke' => 'Contact Label',
			'Kapcsolat gomb' => 'Contact Button',
			'Kapcsolat link' => 'Contact Link',
			'Kapcsolat szöveg' => 'Contact Text',
			'Kapcsolati információk' => 'Contact Information',
			'Kategória címke' => 'Category Label',
			'Kategória felirat' => 'Category Label',
			'Kategória szűrők' => 'Category Filters',
			'Kategóriák megjelenítése' => 'Show Categories',
			'Kiemelt blokk megjelenítése' => 'Show Featured Block',
			'Kiemelt cím' => 'Featured Title',
			'Kiemelt galéria megjelenítése' => 'Show Featured Gallery',
			'Kiemelt galéria' => 'Featured Gallery',
			'Kiemelt kis cím' => 'Featured Kicker',
			'Kiemelt kártya cím' => 'Featured Card Title',
			'Kiemelt kártya szöveg' => 'Featured Card Text',
			'Kiemelt számok' => 'Featured Numbers',
			'Kiemelt szöveg' => 'Featured Text',
			'Kiemelt tartalom' => 'Featured Content',
			'Kis alsó sor mutatása' => 'Show Small Bottom Row',
			'Kis címke' => 'Small Label',
			'Kép a médiatárból' => 'Image from Media Library',
			'Kép kiválasztása' => 'Select Image',
			'Kézi kártyák használata, ha nincs találat' => 'Use Manual Cards if There Are No Results',
			'Kézi kártyák' => 'Manual Cards',
			'Kézi menüpontok' => 'Manual Menu Items',
			'Lebegő ikon' => 'Floating Icon',
			'Lejátszás ikon' => 'Play Icon',
			'Letöltések megjelenítése' => 'Show Downloads',
			'Link felirat' => 'Link Label',
			'Lista cím' => 'List Title',
			'Logó alt szöveg' => 'Logo Alt Text',
			'Logó link' => 'Logo Link',
			'Logó rövidítés' => 'Logo Abbreviation',
			'Logó és projekt' => 'Logo and Project',
			'Lábléc linkek' => 'Footer Links',
			'Megjelenített események száma' => 'Number of Displayed Events',
			'Megközelítés címke' => 'Access Label',
			'Megközelítés cím' => 'Access Title',
			'Megközelítés szöveg' => 'Access Text',
			'Megvalósítás bekezdések' => 'Implementation Paragraphs',
			'Megvalósítás cím' => 'Implementation Title',
			'Megvalósítás szöveg.' => 'Implementation text.',
			'Menüpont' => 'Menu Item',
			'Menüsor' => 'Menu Bar',
			'Mini téma' => 'Mini Topic',
			'Mobil szűrés összefoglaló' => 'Mobile Screening Summary',
			'Morzsa navigáció' => 'Breadcrumb Navigation',
			'Második gomb felirata' => 'Second Button Label',
			'Második gomb felirat' => 'Second Button Label',
			'Második gomb link' => 'Second Button Link',
			'Második kártya cím' => 'Second Card Title',
			'Második kártya jelölés' => 'Second Card Badge',
			'Második kártya szöveg' => 'Second Card Text',
			'Második stat címke' => 'Second Stat Label',
			'Második stat érték' => 'Second Stat Value',
			'Napi elérhetőség' => 'Daily Availability',
			'Oktatási tartalom' => 'Educational Content',
			'Oldalsáv gyors információk' => 'Sidebar Quick Information',
			'Oldalsáv megjelenítése' => 'Show Sidebar',
			'Partner kártyák' => 'Partner Cards',
			'Partner logó' => 'Partner Logo',
			'Programkártyák' => 'Program Cards',
			'Programleírás' => 'Program Description',
			'Programnév' => 'Program Name',
			'Programról bekezdések' => 'About Program Paragraphs',
			'Program szekciók' => 'Program Sections',
			'Projekt sor' => 'Project Line',
			'Projektpartner' => 'Project Partner',
			'Rizikó' => 'Risk',
			'Soron következő' => 'Upcoming',
			'Szekció' => 'Section',
			'Szolgáltatásról' => 'About Service',
			'Szövegszín' => 'Text Color',
			'Szűrések listája' => 'Screening List',
			'Szűrési tevékenységek' => 'Screening Activities',
			'Szűrők megjelenítése' => 'Show Filters',
			'Szűrők' => 'Filters',
			'Telefon gomb' => 'Phone Button',
			'Támogatási formák' => 'Forms of Support',
			'Támogatói és partner logók' => 'Sponsor and Partner Logos',
			'Térkép gomb' => 'Map Button',
			'Térkép link' => 'Map Link',
			'Több képes galéria' => 'Multi-image Gallery',
			'Válassz menüt' => 'Choose Menu',
			'Válasz szövege.' => 'Answer text.',
			'Vezető partner' => 'Lead Partner',
			'Vizuál cím' => 'Visual Title',
			'Vizuál kis cím' => 'Visual Kicker',
			'Vizuál szöveg' => 'Visual Text',
			'WordPress menü' => 'WordPress Menu',
			'Áttekintés lista' => 'Overview List',
			'Űrlap shortcode' => 'Form Shortcode',
			'Űrlap shortcode / HTML' => 'Form Shortcode / HTML',
			'Adatvédelem' => 'Privacy',
			'Ajánlás' => 'Recommendation',
			'Alsó' => 'Bottom',
			'Felső' => 'Top',
			'Aktív' => 'Active',
			'Automatikus' => 'Automatic',
			'Bekezdések' => 'Paragraphs',
			'Bekezdés' => 'Paragraph',
			'Bevezető' => 'Introduction',
			'Cikkek' => 'Articles',
			'Cikk' => 'Article',
			'Célok' => 'Objectives',
			'Cél' => 'Objective',
			'Címke' => 'Label',
			'Címsor' => 'Heading',
			'Cím' => 'Title',
			'Dátum' => 'Date',
			'Elrendezés' => 'Layout',
			'Elsődleges' => 'Primary',
			'Első' => 'First',
			'Második' => 'Second',
			'Harmadik' => 'Third',
			'Elérhetőség' => 'Contact Details',
			'Előnyök' => 'Benefits',
			'Előny' => 'Benefit',
			'Esemény' => 'Event',
			'Fejléc' => 'Header',
			'Felirat' => 'Label',
			'Fontosság' => 'Importance',
			'Fókuszpontok' => 'Focus Points',
			'Fókuszpont' => 'Focus Point',
			'Galéria' => 'Gallery',
			'Gomb' => 'Button',
			'Háttérkép' => 'Background Image',
			'Háttér' => 'Background',
			'Honlap' => 'Website',
			'Időpont' => 'Appointment',
			'Ikon' => 'Icon',
			'Kategóriák' => 'Categories',
			'Kategória' => 'Category',
			'Kiemelt' => 'Featured',
			'Kiemelések' => 'Highlights',
			'Kis' => 'Small',
			'Kártyák' => 'Cards',
			'Kártya' => 'Card',
			'Kép' => 'Image',
			'Kézi' => 'Manual',
			'Kérdések' => 'Questions',
			'Kérdés' => 'Question',
			'Lebegő' => 'Floating',
			'Lejátszás' => 'Play',
			'Letöltések' => 'Downloads',
			'Letölthető' => 'Downloadable',
			'Link' => 'Link',
			'Lista' => 'List',
			'Logó' => 'Logo',
			'Lábléc' => 'Footer',
			'Megjegyzés' => 'Note',
			'Megjelenített' => 'Displayed',
			'Megjelenítése' => 'Display',
			'Megjelenítés' => 'Display',
			'Megközelítés' => 'Access',
			'Megvalósítás' => 'Implementation',
			'Menü' => 'Menu',
			'Mező' => 'Field',
			'Mobil' => 'Mobile',
			'Média' => 'Media',
			'Naptár' => 'Calendar',
			'Nyilatkozat' => 'Notice',
			'Nyíl' => 'Arrow',
			'Oldalsáv' => 'Sidebar',
			'Oldal' => 'Page',
			'Programjaink' => 'Our Programs',
			'Program' => 'Program',
			'Projekt' => 'Project',
			'Regisztráció' => 'Registration',
			'Rövid' => 'Short',
			'Sorszám' => 'Number',
			'Statikus' => 'Static',
			'Stratégiai' => 'Strategic',
			'Stílus' => 'Style',
			'Szolgáltatásokról' => 'About Services',
			'Szolgáltatásról' => 'About Service',
			'Szám' => 'Number',
			'Szélesség' => 'Width',
			'Szöveg' => 'Text',
			'Szín' => 'Color',
			'Tartalom' => 'Content',
			'Tipográfia' => 'Typography',
			'Távolság' => 'Distance',
			'Térköz' => 'Spacing',
			'Típus' => 'Type',
			'Válasz' => 'Answer',
			'Videó' => 'Video',
			'Vizuális' => 'Visual',
			'Űrlap' => 'Form',
		);

		return strtr( $text, $phrases );
	}

	private static function map() {
		if ( null !== self::$map ) {
			return self::$map;
		}

		self::$map = array(
			// Current contact details and legacy placeholders.
			'efi@szatmar.ro' => self::EMAIL,
			'info@nepegeszseg.hu' => self::EMAIL,
			'+36 30 123 4567' => self::PHONE,
			'+40 261 713 775' => self::PHONE,
			'+40 744 920 xxx' => self::PHONE,
			'Szatmárnémeti, Vasile Lucaciu u. 21.' => self::ADDRESS,
			'Szatmárnémeti, Ștefan cel Mare utca 13. szám' => self::ADDRESS,
			'Szatmárnémeti, Ştefan cel Mare utca 13. szám' => self::ADDRESS,
			'Szatmárnémeti központi részén, a Vasile Lucaciu utcában várjuk az érdeklődőket.' => 'You can find us in central Satu Mare, at 13 Ștefan cel Mare Street.',
			'https://www.google.com/maps/search/?api=1&query=Szatm%C3%A1rn%C3%A9meti%2C%20Vasile%20Lucaciu%20u.%2021' => 'https://www.google.com/maps/search/?api=1&query=Satu%20Mare%2C%20Str.%20%C8%98tefan%20cel%20Mare%2013',

			// Common UI and navigation.
			'Főoldal' => 'Home',
			'Projekt' => 'Project',
			'Programjaink' => 'Our Programs',
			'Programok' => 'Programs',
			'Események' => 'Events',
			'ESEMÉNY' => 'EVENT',
			'Közelgő események' => 'Upcoming Events',
			'Elmúlt események' => 'Past Events',
			'Elmúlt esemény' => 'Past Event',
			'Elmúlt' => 'Past',
			'Összes esemény' => 'All Events',
			'Fotó- és videógaléria' => 'Photo and Video Gallery',
			'Fotó- és videógaléria oldal' => 'Photo and Video Gallery Page',
			'Partnerek' => 'Partners',
			'Tudástár' => 'Knowledge Center',
			'Kapcsolat' => 'Contact',
			'Menü' => 'Menu',
			'Cím' => 'Address',
			'Alcím' => 'Subtitle',
			'Szöveg' => 'Text',
			'Leírás' => 'Description',
			'Bevezető' => 'Introduction',
			'Név' => 'Name',
			'Teljes név' => 'Full Name',
			'Telefon' => 'Phone',
			'E-mail' => 'E-mail',
			'Téma' => 'Subject',
			'Üzenet' => 'Message',
			'Válasszon témát' => 'Select a Service',
			'Tanácsadás' => 'Counseling',
			'Egyéb kérdés' => 'Other Inquiry',
			'Írja meg kérdését vagy üzenetét...' => 'Write your question or message...',
			'Üzenet küldése' => 'Send Message',
			'Küldés gomb' => 'Send Button',
			'Részletek' => 'Details',
			'Elolvasom' => 'Read More',
			'Tovább olvasom' => 'Read More',
			'További információ' => 'More Information',
			'Témák megtekintése' => 'View Topics',
			'Szolgáltatások megtekintése' => 'View Services',
			'Szűrések megtekintése' => 'View Screenings',
			'Programok megtekintése' => 'View Programs',
			'Időpontfoglalás' => 'Book an Appointment',
			'IDŐPONT' => 'DATE',
			'Regisztráció / Időpontfoglalás' => 'Registration / Appointment Booking',
			'Kapcsolatfelvétel' => 'Contact Us',
			'Érdeklődöm' => 'I’m Interested',
			'Jelentkezem' => 'Book an Appointment',
			'Megtekintés' => 'View',
			'Megjelenítés' => 'Display',
			'Gyors információk' => 'Quick Information',
			'A programról' => 'About the Program',
			'A szolgáltatásról' => 'About the Service',
			'Miért fontos?' => 'Why Is It Important?',
			'Miért hasznos?' => 'Why Is It Useful?',
			'Kinek ajánlott?' => 'Who Is It Recommended For?',
			'Kinek hasznos?' => 'Who Is It Useful For?',
			'Célcsoport' => 'Target Group',
			'Kiemelt üzenet' => 'Key Message',
			'Szolgáltatások' => 'Services',
			'Tevékenységek' => 'Activities',
			'Fókusz' => 'Focus',
			'Cél' => 'Objective',
			'Típus' => 'Type',
			'Helyszín' => 'Location',
			'Bevonás' => 'Involvement',
			'Támogatás' => 'Support',
			'Kategóriák' => 'Categories',
			'Kategória' => 'Category',
			'Letöltések' => 'Available Resources',
			'Letölthető anyagok' => 'Downloadable Materials',
			'Letölthető dokumentum' => 'Downloadable Document',
			'GYIK' => 'FAQ',
			'Gyakori kérdések' => 'Frequently Asked Questions',
			'Kérdés' => 'Question',
			'Válasz szövege.' => 'Answer text.',
			'Nyitvatartás' => 'Book an Appointment',
			'H–P: 8:00 – 16:00' => 'Book an Appointment',
			'H-P: 8:00 - 16:00' => 'Book an Appointment',
			'L-V: 8:00 – 16:00' => 'Book an Appointment',
			'L-V: 8:00 - 16:00' => 'Book an Appointment',
			'Zárva' => 'Closed',
			'Adatvédelem' => 'Privacy',
			'Impresszum' => 'Imprint',
			'Jelen weboldal tartalma nem feltétlenül tükrözi az Európai Unió hivatalos álláspontját.' => 'The content of this website does not necessarily reflect the official position of the European Union.',
			'© 2025 Egészségfejlesztési Iroda - Szatmár megye' => '© 2025 Health Promotion Office - Satu Mare County',
			'© 2025 Egészségfejlesztési Iroda – Szatmár megye' => '© 2025 Health Promotion Office – Satu Mare County',
			'© 2026 Egészségfejlesztési Iroda - Szatmár megye' => '© 2026 Health Promotion Office - Satu Mare County',
			'&copy; 2026 Eg&eacute;szs&eacute;gfejleszt&eacute;si Iroda - Szatm&aacute;r megye' => '&copy; 2026 Health Promotion Office - Satu Mare County',
			'IPOP ROHU00259 - Interreg VI-A Románia-Magyarország Program' => 'IPOP ROHU00259 - Interreg VI-A Romania-Hungary Programme',
			'IPOP ROHU00259 – Interreg VI-A Románia-Magyarország Program' => 'IPOP ROHU00259 – Interreg VI-A Romania-Hungary Programme',
			'Interreg VI-A Románia-Magyarország Program' => 'Interreg VI-A Romania-Hungary Programme',
			'Szatmár megye' => 'Satu Mare County',
			'Egészségfejlesztési Iroda' => 'Health Promotion Office',
			'EFI' => 'HPO',
			'Partner logó' => 'Partner Logo',
			'Fő navigáció' => 'Main Navigation',
			'Online űrlap mezői' => 'Online Form Fields',
			'Áttekintés' => 'Overview',
			'Fő cél' => 'Main Objective',
			'útmutatók és anyagok' => 'guides and materials',
			'Közösség' => 'Community',
			'Szűrővizsgálatok' => 'Screening Services',
			'Közösségi programok' => 'Community Programs',
			'Egészségügyi események' => 'Health Events',
			'Carei, Közösségi Központ' => 'Carei, Community Center',
			'Szatmárnémeti' => 'Satu Mare',
			'Szatmárnémeti, Megyeháza' => 'Satu Mare, County Hall',
			'Nagykároly, Művelődési Ház' => 'Carei, House of Culture',
			'2025. június 5. 10:00' => '5 June 2025, 10:00',
			'2025. június 18-20.' => '18-20 June 2025',
			'2025. június 28. 14:00' => '28 June 2025, 14:00',
			'JÚN' => 'JUN',
			'Nyitórendezvény' => 'Opening Event',
			'Szűrési napok' => 'Screening Days',
			'Archívum' => 'Archive',
			'Ciklusoktatás összefoglaló' => 'Menstrual Cycle Education Summary',
			'Mobil szűrés összefoglaló' => 'Mobile Screening Summary',
			'Életmódtanácsadás összefoglaló' => 'Lifestyle Counseling Summary',
			'Jelenleg nincs meghirdetett közelgő esemény.' => 'There are currently no announced upcoming events.',
			'Az eseménykezelő jelenleg nem érhető el.' => 'The event manager is currently unavailable.',
			'Jelenleg nincs megjeleníthető esemény.' => 'There are currently no events to display.',

			// Homepage and project content from homepage.docx.
			'Főoldal / Programok / Ciklusoktatás' => 'Home / Programs / Menstrual Cycle Education',
			'Főoldal / Programok / Egészségfejlesztési Iroda' => 'Home / Programs / Health Promotion Office',
			'Főoldal / Programok / Mobil szakorvosi szolgálat' => 'Home / Programs / Mobile Specialist Medical Service',
			'Főoldal / Programok / Mobil szűrés' => 'Home / Programs / Mobile Screening',
			'Főoldal / Programok / Életmódtanácsadás' => 'Home / Programs / Lifestyle Counseling',
			'Főoldal / Programok / Iskolaérettségi szűrések' => 'Home / Programs / PreSchool Screening',
			'Szűrés. Prevenció. Egészséges életmód. Együtt a hosszabb életért!' => 'Screening. Prevention. Healthy Lifestyle. Together for a Longer Life!',
			'Szűrővizsgálatok, tanácsadás és közösségi programok Szatmár megyében - a megelőzés és az egészségtudatos életmód szolgálatában.' => 'Screening services, counseling, and community programs in Satu Mare County - promoting prevention and health-conscious living.',
			'Szűrővizsgálatok, tanácsadás és közösségi programok Szatmár megyében – a megelőzés és az egészségtudatos életmód szolgálatában.' => 'Screening services, counseling, and community programs in Satu Mare County – promoting prevention and health-conscious living.',
			'A „Népesedési folyamatok javítása helyi szinten egészségfejlesztési módszerekkel” elnevezésű IPOP ROHU00259-es számú projekt célja, hogy hozzájáruljon Szatmár megye lakosságának egészségi állapotának javításához, valamint a demográfiai kihívások kezeléséhez.' => 'The IPOP ROHU00259 project entitled "Improving Demographic Processes at Local Level Through Health Promotion Methods" aims to contribute to improving the health status of the population of Satu Mare County and addressing demographic challenges.',
			'A kezdeményezés a Szatmárnémeti Egészségfejlesztési Iroda létrehozása mellett a megelőzésre, az egészségtudatosság növelésére és a család- és közösségalapú ellátás erősítésére épül.' => 'In addition to establishing the Health Promotion Office in Satu Mare, the initiative focuses on prevention, increasing health awareness, and strengthening family- and community-based care services.',
			'A „Népesedési folyamatok javítása helyi szinten egészségfejlesztési módszerekkel” elnevezésű IPOP ROHU00259-es számú projekt célja, hogy hozzájáruljon Szatmár megye lakosságának egészségi állapotának javításához, valamint a demográfiai kihívások kezeléséhez. A kezdeményezés a Szatmárnémeti Egészségfejlesztési Iroda létrehozása mellett a megelőzésre, az egészségtudatosság növelésére és a család- és közösségalapú ellátás erősítésére épül.' => 'The IPOP ROHU00259 project entitled "Improving Demographic Processes at Local Level Through Health Promotion Methods" aims to contribute to improving the health status of the population of Satu Mare County and addressing demographic challenges. In addition to establishing the Health Promotion Office in Satu Mare, the initiative focuses on prevention, increasing health awareness, and strengthening family- and community-based care services.',
			'Kiemelt programok' => 'Highlighted Programs',
			'KIEMELT PROGRAMOK' => 'HIGHLIGHTED PROGRAMS',
			'Ciklusoktatás' => 'Menstrual Cycle Education',
			'Nőknek szóló termékenységtudatosság' => 'Fertility awareness education for women.',
			'Nőknek szóló termékenységtudatosság.' => 'Fertility awareness education for women.',
			'Meddőségi tanácsadás' => 'Fertility Counseling',
			'Komplex, életmód-alapú megközelítés szakmai háttérrel' => 'A complex, lifestyle-based approach with professional support',
			'Az egészséges életmódot, a betegségmegelőzést, a szűrővizsgálatok jelentőségét népszerűsítő tevékenységek' => 'Activities promoting healthy lifestyles, disease prevention, and the importance of screening.',
			'Az egészséges életmódot, a betegségmegelőzést és a szűrővizsgálatok jelentőségét népszerűsítő tevékenységek' => 'Activities promoting healthy lifestyles, disease prevention, and the importance of screening',
			'Az egészséges életmódot, a betegségmegelőzést és a szűrővizsgálatok jelentőségét népszerűsítő tevékenységek.' => 'Activities promoting healthy lifestyles, disease prevention, and the importance of screening.',
			'Az egészséges életmódot és a szűrővizsgálatok jelentőségét népszerűsítő tevékenységek' => 'Activities promoting healthy lifestyles and the importance of screening',
			'Helyben elérhető szakvizsgálatok a könnyebb hozzáférésért' => 'Specialist medical examinations available locally for easier access.',
			'Helyben elérhető szakvizsgálatok a könnyebb hozzáférésért.' => 'Specialist medical examinations available locally for easier access.',
			'Helyben elérhető onkológiai szűrések a könnyebb hozzáférésért' => 'Locally available oncological screening services for improved accessibility.',
			'Helyben elérhető onkológiai szűrések a könnyebb hozzáférésért.' => 'Locally available oncological screening services for improved accessibility.',
			'Személyre szabott támogatás az egészséges életvitel kialakításához' => 'Personalized support for developing healthy lifestyle habits.',
			'Személyre szabott támogatás az egészséges életvitel kialakításához.' => 'Personalized support for developing healthy lifestyle habits.',
			'Óvodás iskolaérettséget vizsgáló szűrések' => 'PreSchool Screening',
			'Korai felismerés és támogatás a gyermekek fejlődésében' => 'Early detection and support for children’s development.',
			'Korai felismerés és támogatás a gyermekek fejlődésében.' => 'Early detection and support for children’s development.',
			'Részletek a programokról' => 'Learn More About Our Programs',
			'KÖZELGŐ ESEMÉNYEK' => 'UPCOMING EVENTS',
			'Vegyen részt szűréseinken, workshopjainkon és közösségi programjainkon!' => 'Take part in our screenings, workshops, and community programs!',
			'Események megtekintése' => 'View Events',
			'Regisztráció' => 'Registration',
			'IDŐPONTFOGLALÁS' => 'APPOINTMENT BOOKING',
			'Egészsége nem várhat.' => 'Your health cannot wait.',
			'PROJEKT' => 'PROJECT',
			'A projekt céljai' => 'Project Objectives',
			'Projekt célok' => 'Project Objectives',
			'Szatmár megye demográfiai helyzetének javítása' => 'Improving the demographic situation of Satu Mare County',
			'prevenció és egészségnevelés erősítése' => 'Strengthening prevention and health education activities',
			'családalapú ellátás támogatása' => 'Supporting family-based care',
			'az egészségügyi szolgáltatásokhoz való hozzáférés javítása' => 'Improving access to healthcare services',
			'a megelőzés fontossága és az egészséges életmód népszerűsítése' => 'Promoting the importance of prevention and healthy lifestyles',
			'tanácsadói tevékenységek ellátása.' => 'Providing counseling and advisory services.',
			'Stratégiai üzenetek' => 'Strategic Messages of the Project',
			'Stratégiai üzenetek cím' => 'Strategic Messages Title',
			'A projekt három stratégiai üzenete' => 'The project conveys three key strategic messages:',
			'A vidéki egészségügyi szolgáltatásokkal és szűrésekkel az esélyegyenlőség teremtődik meg.' => 'Rural healthcare services and screening programs promote equal opportunities for all residents.',
			'A prevenció kulcsfontosságú a hosszú távú egészség megőrzésében.' => 'Prevention is essential for maintaining long-term health.',
			'Az egészségfejlesztés által az egészséges egyének és családok életerős közösségeket hozhatnak létre.' => 'Through health promotion, healthy individuals and families can build strong and vibrant communities.',
			'Ismerje meg egészségfejlesztési programjainkat, amelyek a megelőzésre, a könnyebb hozzáférésre és a családok támogatására épülnek.' => 'Explore our health promotion programs, which are built around prevention, easier access, and support for families.',
			'Programjainkhoz kapcsolódó képeket vagy videókat a kapcsolat oldalon keresztül is elküldhet.' => 'You can also send photos or videos related to our programs through the contact page.',
			'Van megosztható fotója?' => 'Do you have a photo to share?',
			'Hasznos anyagot keres?' => 'Looking for useful material?',
			'Cikkek, letölthető anyagok és gyakori kérdések a prevenció, az egészséges életmód és a közösségi egészségfejlesztés témáiban.' => 'Articles, downloadable materials, and frequently asked questions on prevention, healthy lifestyles, and community health promotion.',

			// Project page content.
			'A „Népesedési folyamatok javítása helyi szinten egészségfejlesztési módszerekkel” elnevezésű IPOP ROHU00259-es számú, 2025.05.28. - 2027.11.27. időszakban futó projekt a Páli Szent Vincéről Nevezett Szatmári Irgalmas Nővérek Egyesületének a Hódmezővásárhelyi-Makói Egészségügyi Ellátó Központtal partnerségben az Interreg VI-A Románia-Magyarország Program támogatásával, a „4.5 - Az egészségügyi ellátáshoz való egyenlő hozzáférés biztosítása, az egészségügyi rendszerek ellenálló képességének erősítése - beleértve az alapellátást is -, valamint az intézményi ellátásról a családi és közösségi alapú gondozásra való áttérés előmozdítása” egyedi célkitűzés keretén belül valósul meg.' => 'The IPOP ROHU00259 project entitled "Improving Demographic Processes at Local Level Through Health Promotion Methods" is implemented between 28 May 2025 and 27 November 2027 by the Association of the Sisters of Charity of Saint Vincent de Paul from Satu Mare, in partnership with the Hódmezővásárhely-Makó Health Care Centre, with the support of the Interreg VI-A Romania-Hungary Programme. The project is implemented under Specific Objective 4.5 - Ensuring equal access to healthcare services, strengthening the resilience of healthcare systems - including primary healthcare - and promoting the transition from institutional care to family- and community-based care.',
			'A projekt keretén belül kialakított és működés alatt álló Szatmárnémeti Egészségfejlesztési Iroda egy olyan egészségvédelmi és felvilágosító iroda, melynek küldetése a demográfiai helyzet javítása egészségfejlesztési módszerekkel, esélyegyenlőség biztosításával és a család- és közösségalapú ellátás erősítésével, a prevenció, valamint a megye egészségügyi állapotának javítása.' => 'The Health Promotion Office established and operating in Satu Mare through the project serves as a health protection and awareness center. Its mission is to improve demographic conditions through health promotion methods, ensure equal opportunities, strengthen family- and community-based care, promote prevention, and improve the overall health status of the county’s population.',
			'Ennek megfelelően Szatmár megyében legalább 1000 fő részére egy mozgó kardiovaszkuláris és onkológiai - bőr, prosztata, mell, vastagbél - szűrés valósul meg, legalább 10 vidéki háziorvos bevonásával, biztosítva a szükséges szakorvosi vizsgálatok időszakos kihelyezését az érintett rendelőkbe, illetve modern orvosi felszereléseket.' => 'Within the project, at least 1,000 people in Satu Mare County will benefit from mobile cardiovascular and oncological screenings - skin, prostate, breast, and colorectal cancer - involving at least 10 rural family physicians. Periodic specialist consultations and modern medical equipment will be provided in participating medical practices.',
			'A vezető partner irányításával olyan személyeket szándékoznak kiképezni, akik cikluskövetés-oktatást és meddőségi tanácsadást tudnak majd nyújtani fiatal hölgyeknek. A tanult módszerrel a megye legalább 6 gimnáziumába szeretnének eljutni a projekt időtartama alatt.' => 'Under the coordination of the lead partner, selected individuals will receive training to provide menstrual cycle awareness education and fertility counseling for young women. Using this approach, the project aims to reach at least six secondary schools throughout the county during the implementation period.',
			'Szintén a pályázat segítségével a Boldog Scheffler János Központ „Iskolára készen” kampányával Szatmár megye vidéki településein óvodás gyermekek iskola előtti szenzo-motoros, kognitív és pszichológiai szűrését fogják elvégezni.' => 'The project also supports the "Ready for School!" campaign of the Blessed Scheffler János Center, which will carry out sensory-motor, cognitive, and psychological assessments of preschool children in rural communities throughout Satu Mare County.',
			'Projekt időtartama' => 'Project Duration',
			'2025.05.28. - 2027.11.27.' => '28 May 2025 - 27 November 2027',
			'Legalább 1000 fő szűrése' => 'At least 1,000 people screened',
			'Legalább 10 vidéki háziorvos bevonása' => 'At least 10 rural family physicians involved',
			'Legalább 6 gimnázium elérése' => 'At least six secondary schools reached',
			'500-600 óvodás gyermek felmérése' => '500-600 preschool children assessed',
			'A projekt bemutatása, partnerek és közösségi célok.' => 'Project presentation, partners, and community objectives.',
			'A projekt a vezető partner és a projektpartnerek együttműködésével valósul meg.' => 'The project is implemented through cooperation between the lead partner and project partners.',
			'A partnerség célja, hogy a projekt egészségfejlesztési, szűrési és szakmai tevékenységei szervezett együttműködésben valósuljanak meg.' => 'The partnership aims to ensure that the project’s health promotion, screening, and professional activities are implemented through organized cooperation.',
			'Mobil szűrések, tanácsadások, oktatási programok és közösségalapú egészségfejlesztés egy integrált projekt keretében.' => 'Mobile screenings, counseling, educational programs, and community-based health promotion within an integrated project.',
			'A projekt célja, hogy Szatmár megye lakosságának egészségi állapotát, prevenciós lehetőségeit és az egészségügyi szolgáltatásokhoz való hozzáférését javítsa.' => 'The project aims to improve the health status, prevention opportunities, and access to healthcare services of the population of Satu Mare County.',

			// Program pages.
			'Fertilitástudatosság nőknek' => 'Fertility Awareness for Women',
			'Cikluskövetési módszerek és termékenységtudatosság' => 'Menstrual cycle tracking methods and fertility awareness',
			'Cikluskövetés és egészségügyi nevelés' => 'Cycle Tracking and Health Education',
			'Tudatos női egészség' => 'Conscious Women’s Health',
			'Ismeret, cikluskövetés, felelős döntés' => 'Knowledge, cycle tracking, responsible decisions',
			'Termékenységtudatosság és egészségügyi nevelés fiatal lányoknak és nőknek.' => 'Fertility awareness and health education for young girls and women.',
			'8–12. osztályos lányok' => 'Girls in grades 8-12',
			'8–12. osztályos lányoknak' => 'For girls in grades 8-12',
			'8–12. osztályos lányok és érdeklődő nők' => 'Girls in grades 8-12 and interested women',
			'További jelentkezők' => 'Additional Applicants',
			'Egészségfejlesztési Irodába érkező érdeklődők' => 'People seeking support through the Health Promotion Office',
			'A program célja, hogy a szakellátás és a szűrés a vidéki közösségek számára is könnyebben elérhetővé váljon, különösen ott, ahol a hozzáférés ma korlátozott.' => 'The aim of the program is to make specialist healthcare and screening more accessible to rural communities, especially where access is currently limited.',
			'A programok célcsoportja témánként eltérő, de több szolgáltatás fiataloknak, felnőtteknek és családoknak is szól.' => 'The target groups differ by topic, but several services are intended for young people, adults, and families.',
			'A projekt keretében megvalósuló szolgáltatások részvételi feltételeiről az adott program oldalán található információ.' => 'Information about participation conditions for services implemented within the project can be found on each program page.',
			'Jelentkezéshez vagy további információért a kapcsolati oldalon megadott elérhetőségeken lehet érdeklődni.' => 'For registration or additional information, please use the contact details provided on the contact page.',
			'Képzett szakemberek bevonása fiatal hölgyek termékenységtudatosságának fejlesztésére.' => 'Involving trained professionals to develop fertility awareness among young women.',
			'Az abortuszok száma Romániában is rendkívül magas. Az elhagyott újszülöttek aránya és az Európai Unió országai között vezető helyet foglalunk el a gyermekhalandóság területén.' => 'The number of abortions in Romania remains high. In addition, the proportion of abandoned newborns is significant, and the country continues to rank among the European Union member states with the highest infant mortality rates.',
			'Mindemellett nő a koraszülések száma, aggasztóan emelkedett a házaspárok sterilitás aránya, mely összefügg a késői gyerekvállalással is. 30 éves kor felett sokszorosára nő a veleszületett rendellenességek aránya.' => 'At the same time, the number of premature births is increasing, and the proportion of couples affected by infertility has risen considerably, a trend that is also associated with delayed parenthood. After the age of 30, the risk of certain congenital abnormalities increases significantly.',
			'Ugyanakkor hiányos az egészségügyi nevelés, magas a nem kívánt terhességek aránya, valamint rendkívül magas a művi abortuszok száma. Mindez összefüggésben áll a nemi érés és a nemi élet fiziológiai ismereteinek hiányával.' => 'Health education remains insufficient, the rate of unintended pregnancies is still high, and the number of induced abortions continues to be substantial. These issues are closely related to limited knowledge about sexual development and the physiological functioning of the reproductive system.',
			'Mindezen okok miatt fontos a megfelelő cikluskövetés-oktatás és tudásátadás a megye közoktatási intézményeiben, főként a 8–12. osztályos lányok körében, illetve az Egészségfejlesztési Irodába jelentkezőknél, ahol cikluskövetési módszereket sajátíthatnak el a termékenységtudatosság jegyében.' => 'For these reasons, it is important to provide education on menstrual cycle tracking and reproductive health awareness in the county’s educational institutions, particularly among girls in grades 8-12. Individuals who seek support through the Health Promotion Office can also learn cycle-tracking methods that promote fertility awareness.',
			'A cikluskövetés-oktatás célja a megfelelő egészségügyi ismeretek átadása, különösen a 8-12. osztályos lányok körében, illetve az Egészségfejlesztési Irodába jelentkezőknél. A program a termékenységtudatosságot, a felelős döntéseket és az egészségnevelést támogatja.' => 'The purpose of menstrual cycle education is to provide appropriate health knowledge, especially among girls in grades 8-12 and individuals seeking support through the Health Promotion Office. The program supports fertility awareness, responsible decisions, and health education.',
			'A ciklusoktatás célja, hogy a lányok és nők ne információhiányból, hanem hiteles tudás birtokában tudjanak dönteni saját egészségükről és termékenységükről.' => 'The purpose of menstrual cycle education is to help girls and women make decisions about their health and fertility based on credible knowledge, not a lack of information.',
			'A fiatal lányok és nők hiteles, érthető információkat kapnak saját testük működéséről.' => 'Young girls and women receive credible, easy-to-understand information about how their bodies work.',
			'A cikluskövetés segíti a termékenységtudatosság kialakítását.' => 'Cycle tracking supports the development of fertility awareness.',
			'Az oktatás hozzájárulhat a felelősebb döntéshozatalhoz.' => 'Education can contribute to more responsible decision-making.',
			'A program támogatja az egészségügyi nevelést és a prevenciót.' => 'The program supports health education and prevention.',
			'A tudásátadás segíthet csökkenteni a tévhiteket és az információhiányt.' => 'Knowledge transfer can help reduce misconceptions and information gaps.',
			'A foglalkozások célja, hogy érthető, biztonságos és életkornak megfelelő tudást adjanak a női ciklusról, a termékenységről és az egészségtudatos döntésekről.' => 'The sessions aim to provide clear, safe, and age-appropriate knowledge about the female cycle, fertility, and health-conscious decisions.',
			'Érintett fő témák' => 'Main Topics Covered',
			'A női ciklus alapvető működésének megismerése' => 'Understanding the basic functioning of the female cycle',
			'A nemi érés és a női egészség fiziológiai alapjai' => 'Physiological foundations of sexual development and women’s health',
			'A felelős döntésekhez szükséges egészségügyi ismeretek' => 'Health knowledge needed for responsible decisions',
			'Kiemelt célcsoport' => 'Primary Target Group',
			'Tudás' => 'Knowledge',
			'A tudás segít megérteni a test működését és támogatja a felelős döntéseket.' => 'Knowledge helps people understand how the body works and supports responsible decisions.',

			'Egészségvédelem és prevenció' => 'Health Protection and Prevention',
			'Prevenció, tanácsadás és egészségtudatos életmód' => 'Prevention, Counseling, and Health-Conscious Living',
			'Megelőzés, egészségnevelés, közösségi támogatás' => 'Prevention, Health Education, Community Support',
			'A Szatmárnémeti Egészségfejlesztési Iroda a prevenció, az esélyegyenlőség és a család- és közösségalapú ellátás erősítésére épül.' => 'The Health Promotion Office in Satu Mare is built on prevention, equal opportunities, and strengthening family- and community-based care.',
			'Az Egészségfejlesztési Iroda célja, hogy a lakosság ne csak akkor találkozzon az egészségügyi ellátással, amikor már kialakult a probléma, hanem időben, a megelőzés és a tudatos életmód szintjén kapjon támogatást.' => 'The aim of the Health Promotion Office is to help residents receive timely support at the level of prevention and conscious lifestyle choices, not only when a health problem has already developed.',
			'A megyében egyedülálló, hiánypótló egészségügyi tanácsadói iroda az alapellátás szerepének megerősítését tűzi ki egyik fő céljául.' => 'The Health Promotion Office is a unique health counseling service within the county, designed to address an important community need. One of its primary objectives is to strengthen the role of primary healthcare.',
			'Az egészséges életmódot, a betegségmegelőzést és a szűrővizsgálatok jelentőségét népszerűsítő tevékenység ilyen szervezett formában való működtetése ismeretlen régiónkban.' => 'Providing organized programs that promote healthy lifestyles, disease prevention, and awareness of the importance of screening is an innovative initiative in our region.',
			'Az iroda szakemberek bevonásával az egyedi tanácsadástól, a prevención és szűréseken keresztül, a rehabilitációs és terápiás munkáig nyújt szolgáltatásokat.' => 'With the involvement of professionals, the office offers services ranging from individual counseling, prevention, and screenings to rehabilitation support and therapeutic guidance.',
			'Az iroda célja, hogy szakemberek bevonásával, szervezett formában tegye elérhetővé az egészséges életmódot, a betegségmegelőzést és a szűrővizsgálatok fontosságát népszerűsítő szolgáltatásokat.' => 'The office aims to make services that promote healthy lifestyles, disease prevention, and the importance of screening available in an organized way with the involvement of professionals.',
			'Ugyanakkor fiatalok és felnőttek számára szervez népszerűsítő akciókat az egészséges életforma, a betegségeket megelőző életmód és a szűrővizsgálatokon való részvétel fontosságának erősítésére.' => 'In addition, the Health Promotion Office organizes awareness campaigns and educational initiatives for both young people and adults, encouraging healthy lifestyle choices, disease prevention, and participation in screening programs.',
			'Az Egészségfejlesztési Irodába jelentkezők személyre szabottabb támogatást kaphatnak.' => 'People who contact the Health Promotion Office can receive more personalized support.',

			'Szakellátás közelebb a közösségekhez' => 'Specialist Healthcare Closer to Communities',
			'Kardiovaszkuláris és egyéb vizsgálatok vidéki településeken' => 'Cardiovascular and Other Examinations in Rural Communities',
			'Orvosi vizsgálat' => 'Medical Examination',
			'Szakellátás' => 'Specialist Care',
			'10 háziorvos' => '10 Family Physicians',
			'10 háziorvos és szakorvosok' => '10 Family Physicians and Specialists',
			'10 háziorvos bevonása a programba' => '10 family physicians involved in the program',
			'10 háziorvos bevonása vidéki településeken' => '10 family physicians involved in rural communities',
			'10 háziorvosnál, vidéki településeken' => 'At 10 family physicians in rural communities',
			'Romániában köztudott az egészségügyi ellátáshoz (szakellátáshoz) való hozzáférés, igénybevétel óriási különbsége falusi és városi, főleg nagyvárosi összehasonlításban, a falvakon élők rovására.' => 'In Romania, significant disparities exist between urban and rural areas regarding access to specialist healthcare services, with rural populations often facing substantial disadvantages.',
			'Romániában köztudott az egészségügyi ellátáshoz, ezen belül a szakellátáshoz való hozzáférés és annak igénybevétele között óriási különbség van falusi és városi, főleg nagyvárosi összehasonlításban, a falvakon élők rovására.' => 'In Romania, significant disparities exist between urban and rural areas, especially large cities, regarding access to healthcare and specialist care, to the disadvantage of rural residents.',
			'A mozgó szakorvosi szolgálat bevezetésének célja Szatmár megyében a szakorvosi ellátás közösséghez való közelebb vitele, mely által nem a beteg utazik, hanem a szolgáltatás kerül közelebb a beteghez.' => 'The purpose of introducing the Mobile Specialist Medical Service in Satu Mare County is to bring specialist healthcare closer to local communities. Through this approach, patients are no longer required to travel long distances; instead, healthcare services are delivered closer to where people live.',
			'A mozgó szakorvosi szolgálat bevezetésének célja Szatmár megyében a szakorvosi ellátás közösséghez való közelebb vitele. Ennek lényege, hogy nem a beteg utazik, hanem a szolgáltatás kerül közelebb a beteghez.' => 'The purpose of introducing the Mobile Specialist Medical Service in Satu Mare County is to bring specialist healthcare closer to local communities. The essence of this approach is that patients do not travel to the service; instead, the service is brought closer to them.',
			'A mozgó szakorvosi szolgálat célja, hogy a szakellátást közelebb vigye a vidéki közösségekhez. A megye különböző településein 10 háziorvosnál, szakorvosok bevonásával valósulnak meg kardiovaszkuláris és egyéb vizsgálatok.' => 'The Mobile Specialist Medical Service aims to bring specialist healthcare closer to rural communities. In different communities across the county, cardiovascular and other examinations are carried out with specialists through 10 family physicians.',
			'A szolgáltatás célja, hogy a szakellátás ne csak a nagyobb városi központokban legyen könnyebben elérhető, hanem a vidéki lakosság számára is közelségbe kerüljön.' => 'The service aims to make specialist healthcare more accessible not only in larger urban centers, but also for rural residents.',
			'A szolgáltatás közelebb kerül azokhoz, akik nehezebben jutnak el városi központokba.' => 'The service is brought closer to people who have more difficulty reaching urban centers.',
			'Ezáltal lényegesen javulhat a város és a falu lakosainak egészségügyi ellátáshoz való hozzáférése közötti különbség, erősödhet a háziorvosi, családorvosi rendelők és a járóbeteg szakrendelők szakmai kapcsolata.' => 'This can significantly reduce the gap between urban and rural residents in access to healthcare and strengthen professional cooperation between family physician practices and outpatient specialist clinics.',
			'Ezáltal lényegesen javulhat a város és a falu lakosainak egészségügyi ellátáshoz való hozzáférésének a különbsége, erősödhet a háziorvosi (családorvosi) rendelők és a járóbeteg szakrendelők szakmai kapcsolata, a hátrányos települések háziorvosi rendelői szintjén a szakmai munka színvonala, javulhat a háziorvosi tevékenység megelőzésben és ellátásban nyújtott szerepe, valamint a szakmai kapcsolat az alapellátás és a szakrendelői járóbeteg-ellátás között.' => 'This can significantly reduce the gap between urban and rural residents in access to healthcare, strengthen professional cooperation between family physician practices and outpatient specialist clinics, improve the quality of professional work in practices serving disadvantaged communities, and reinforce the role of family physicians in prevention and care.',
			'A program hozzájárulhat a hátrányos, falusi települések háziorvosi rendelői szintjén végzett szakmai munka színvonalának emeléséhez, valamint javíthatja a háziorvosi tevékenység megelőzésben és ellátásban betöltött szerepét.' => 'The program can help improve the quality of professional work in family physician practices serving disadvantaged rural communities and strengthen the role of family physicians in prevention and care.',
			'A program hozzájárulhat a szakorvosi ellátáshoz való jobb hozzáféréshez, különösen a szociálisan hátrányos lakossági csoportok és az infrastrukturálisan izolált települések esetében, és hosszabb távon kedvezően hathat a lakosság morbiditási és mortalitási adataira is.' => 'The program can contribute to better access to specialist healthcare, especially for socially disadvantaged population groups and geographically isolated communities, and may have a favorable long-term impact on morbidity and mortality indicators.',
			'A megye különböző vidéki településein 10 háziorvosnál a szakvizsgálatoknak megfelelő szakorvosok bevonásával fognak kardiovaszkuláris és egyéb vizsgálatokat végezni.' => 'In different rural communities of the county, cardiovascular and other examinations will be carried out through 10 family physicians with the involvement of relevant specialists.',
			'A megye különböző vidéki településein 10 háziorvosnál, a szakvizsgálatoknak megfelelő szakorvosok bevonásával fognak kardiovaszkuláris és egyéb vizsgálatokat végezni.' => 'In different rural communities of the county, cardiovascular and other examinations will be carried out through 10 family physicians with the involvement of relevant specialists.',
			'Kardiovaszkuláris és egyéb szakvizsgálatok vidéki helyszíneken valósulhatnak meg.' => 'Cardiovascular and other specialist examinations can be carried out in rural locations.',
			'Helyben elérhető vizsgálatok a szív- és érrendszeri kockázatok korai felismerésére.' => 'Locally available examinations for early detection of cardiovascular risks.',
			'Csökkenhet a falusi és városi ellátás közötti különbség' => 'Inequalities between rural and urban healthcare can be reduced',
			'Erősödhet a háziorvosok és a szakrendelők szakmai együttműködése' => 'Professional cooperation between family physicians and specialist clinics can be strengthened',
			'Javulhat a megelőzés és az alapellátás szerepe' => 'The role of prevention and primary healthcare can be improved',
			'Nőhet a hozzáférés a szakorvosi ellátáshoz' => 'Access to specialist healthcare can increase',
			'Segítheti a hátrányos helyzetű lakosságot és az izolált településeket' => 'It can support disadvantaged residents and isolated communities',

			'Mobil onkológiai szűrések' => 'Mobile Oncological Screenings',
			'Korai felismerés és könnyebb hozzáférés vidéki közösségekben' => 'Early Detection and Easier Access in Rural Communities',
			'1000 személy szűrése' => '1,000 people screened',
			'1000 személy szűrése vidéki településeken' => '1,000 people screened in rural communities',
			'1000 személy szűrése tervezett, 10 háziorvosnál a megye különböző vidéki településein.' => 'The project plans to provide screening examinations for approximately 1,000 individuals through 10 family medicine practices located in rural communities across the county.',
			'A program keretében 1000 személy szűrése tervezett, 10 háziorvosnál, a megye különböző vidéki településein.' => 'The program plans to provide screening examinations for 1,000 people through 10 family physicians in different rural communities of the county.',
			'A mozgó szűrőakció bevezetésének célja Szatmár megyében a korai szűrés fontosságának tudatosítása és a vidéki közösséghez való közelebb vitele, mely által nem a beteg utazik, hanem a szolgáltatás kerül közelebb a beteghez.' => 'The aim of introducing the Mobile Screening Program in Satu Mare County is to raise awareness about the importance of early detection and to bring healthcare services closer to rural communities. In this approach, it is not the patient who travels to the service; instead, the service is brought closer to the patient.',
			'A mozgó szűrőakció bevezetésének célja Szatmár megyében a korai szűrés fontosságának tudatosítása, valamint a szűrési lehetőségek vidéki közösségekhez való közelebb vitele.' => 'The aim of introducing the mobile screening program in Satu Mare County is to raise awareness about the importance of early detection and bring screening opportunities closer to rural communities.',
			'A mozgó szűrőakció célja a korai felismerés fontosságának tudatosítása. A projekt 1000 személy szűrését tervezi 10 háziorvos bevonásával, többek között prosztata-, mell-, méhnyak-, bőr- és vastagbélrák szűrések biztosításával.' => 'The mobile screening program aims to raise awareness of the importance of early detection. The project plans to screen 1,000 people through 10 family physicians, including prostate, breast, cervical, skin, and colorectal cancer screenings.',
			'A mobil szűrés célja, hogy a lakosság könnyebben elérje azokat a vizsgálatokat, amelyek segíthetik a betegségek korai felismerését, és hozzájárulhatnak a megelőzés erősítéséhez.' => 'Mobile screening aims to make examinations that support early disease detection more accessible to residents and contribute to strengthening prevention.',
			'A mobil szűrés célja, hogy a megelőzés a vidéki közösségek számára is közelségbe kerüljön, és minél több ember eljusson a korai felismerést segítő vizsgálatokig.' => 'Mobile screening aims to bring prevention closer to rural communities and help more people access examinations that support early detection.',
			'A megelőzés ne távoli lehetőség legyen, hanem helyben elérhető támogatás.' => 'Prevention should not be a distant opportunity, but locally available support.',
			'A program szemlélete egyszerű és közösségközpontú: nem a beteg utazik, hanem a szolgáltatás kerül közelebb a beteghez. Ez különösen fontos azokban a településekben, ahol a szűrővizsgálatokhoz való hozzáférés nehezebb lehet.' => 'The program’s approach is simple and community-centered: the patient does not travel; the service is brought closer to the patient. This is especially important in communities where access to screening may be more difficult.',
			'Javítja a hozzáférést a szakellátáshoz' => 'Improves access to specialist healthcare',
			'Támogatja a megelőzést és a korai felismerést' => 'Supports prevention and early detection',
			'Segíti a vidéki lakosság egészségvédelmét' => 'Supports the health protection of rural residents',

			'Életmód, prevenció, személyre szabott támogatás' => 'Lifestyle, Prevention, Personalized Support',
			'Egyéni egészségterv és prevenciós támogatás' => 'Individual Health Plan and Preventive Support',
			'Napi 4 órában' => '4 hours per day',
			'Napi 4 órában várják az egészséges életmódra vágyókat' => 'Available 4 hours per day for people seeking a healthy lifestyle',
			'Az Egészségfejlesztő Iroda keretén belül működő felvilágosító munka, kapcsolattartás és egészségnevelés célja egy tudatosabb, a megelőzést és az egészséges életmódot népszerűsítő tevékenység és szemléletmód meghonosítása.' => 'The information, communication, and health education activities carried out within the Health Promotion Office aim to foster a prevention-oriented mindset and encourage healthier lifestyle choices throughout the community.',
			'A központ figyelemfelkeltő rendezvényeinek, tájékoztató anyagainak, egészségfelmérési tevékenységeinek, valamint csoportos és egyéni tanácsadásának köszönhetően középtávon javulhatnak a lakosság morbiditási és mortalitási adatai.' => 'Through awareness-raising events, educational materials, health assessments, and both individual and group counseling services, the program seeks to improve public health indicators over the medium and long term.',
			'Az egészségnevelési és tanácsadói iroda működtetése nagyban hozzájárulhat az egészséges életmód, a prevenció, a korai felismerés és a hatékony terápia megvalósításához.' => 'Operating a dedicated health education and counseling center contributes significantly to promoting healthy lifestyles, preventing disease, supporting early detection, and facilitating effective therapeutic interventions.',
			'Napi 4 órában különböző szakemberek, pszichológus, táplálkozási szakértő és más segítő szakemberek pszicho-szociális és táplálkozási tanácsadással, egyéni egészségtervvel, valamint prevenciós támogatással várják az egészséges életmódra vágyókat.' => 'As part of the program, professionals including psychologists, nutrition specialists, and other experts will provide daily psychosocial and nutritional counseling, individualized health plans, and preventive support services for individuals seeking to adopt and maintain healthier lifestyles.',
			'Előzetes időpont-egyeztetés alapján különböző szakemberek, pszichológus, táplálkozási szakértő és más segítő szakemberek pszicho-szociális és táplálkozási tanácsadással, egyéni egészségtervvel, valamint prevenciós támogatással várják az egészséges életmódra vágyókat.' => 'By appointment, psychologists, nutrition specialists, and other support professionals provide psychosocial and nutritional counseling, individualized health plans, and preventive support for people seeking a healthy lifestyle.',
			'A tanácsadás célja, hogy az egészséges életmódra vágyók szakemberek segítségével, személyre szabott támogatással alakíthassák ki mindennapi szokásaikat.' => 'The aim of counseling is to help people seeking a healthy lifestyle shape their everyday habits with professional, personalized support.',
			'Az életmódtanácsadás a felvilágosítás, az egészségnevelés és az egyéni támogatás eszközeivel segít abban, hogy a megelőzés és az egészségtudatos döntések a mindennapok részévé váljanak.' => 'Lifestyle counseling uses awareness, health education, and individual support to help prevention and health-conscious decisions become part of everyday life.',
			'Az Egészségfejlesztési Iroda felvilágosító munkával, egészségneveléssel, csoportos és egyéni tanácsadással, egyéni egészségtervvel és prevenciós támogatással segíti az egészségesebb életmód kialakítását.' => 'The Health Promotion Office supports healthier lifestyles through awareness activities, health education, group and individual counseling, individualized health plans, and preventive support.',

			'Iskolára készen!' => 'Ready for School!',
			'Korai szűrés és támogatás az iskolakezdés előtt' => 'Early Screening and Support Before Starting School',
			'Óvodás gyermekek iskola előtti szenzo-motoros, kognitív és pszichológiai szűrése' => 'Sensory-motor, cognitive, and psychological assessments for preschool children before school entry',
			'30 vidéki óvoda' => '30 rural kindergartens',
			'30 vidéki intézmény elérése' => '30 rural institutions reached',
			'800–1000 nagycsoportos óvodás' => '800-1,000 preschool children in their final preschool year',
			'800–1000 nagycsoportos felmérése' => '800-1,000 children in the final preschool year assessed',
			'60 óvónő bevonása' => '60 kindergarten teachers involved',
			'Az Iskolára készen! program óvodás gyermekek iskola előtti szenzo-motoros, kognitív és pszichológiai szűrését támogatja. A cél a rizikótünetek időben történő felismerése, a sikeres iskolai beválás támogatása és a gyermekek fejlődési lemaradásainak csökkentése.' => 'The "Ready for School!" program supports sensory-motor, cognitive, and psychological assessments of preschool children before school entry. The goal is to identify risk factors in time, support successful school adaptation, and reduce developmental delays.',
			'A tipikusan fejlődő óvodás korú gyermekek szűrését korai prevenciós tevékenységnek tekintjük a sikeres iskolai beválás szempontjából.' => 'Screening preschool children with typical development is considered an important early prevention activity that supports successful school adaptation and educational achievement.',
			'Az óvodai nagycsoportban felfedezett rizikó tünetek lehetőséget adnak arra, hogy a gyermek megfelelő fejlesztést kapjon célirányosan a gyengébben működő területeken, és az iskolakezdésre behozza a lemaradását.' => 'Identifying risk factors and developmental difficulties during the final preschool year allows specialists to provide targeted interventions in weaker developmental areas, helping children overcome delays before starting school.',
			'A Boldog Scheffler János Központ indulását követően, 2012-ben egy pilot projektben vett részt, ahol a helyi óvodákban szűrte a tipikusan fejlődő óvodásokat. A három évig tartó projekt eredményei kétségbe ejtőek voltak, hiszen a gyermekek több mint felénél találtak a szűrővizsgálatok alatt idegrendszeri éretlenséget.' => 'Following the establishment of the Blessed Scheffler János Center, the institution participated in a pilot screening project in 2012 involving local kindergartens. The results of the three-year project revealed that more than half of the assessed children showed signs of neurological immaturity.',
			'Az idegrendszeri éretlenség tünetei különböző rizikó tünetek formájában mutatkoztak meg, mint a figyelem gyengesége, grafomotoros éretlenség, a téri tájékozódás éretlensége, lateralitás és dominancia problémák, valamint integrálatlan csecsemőkori reflexek.' => 'The most common indicators included attention and concentration difficulties, graphomotor immaturity, spatial orientation difficulties, laterality and dominance-related challenges, and insufficient integration of primitive reflexes.',
			'A fejlesztések a gyerekek nagy százalékánál, akik elkezdték a preventív célú fejlesztéseket, 6–10 hónapon belül javulást eredményeztek. Ez alátámasztja a korai szűrés és felismerés fontosságát, hiszen az időben felismert rizikó tünetek optimális időn belül fejleszthetőek célzott beavatkozásokat követően.' => 'Experience from the program demonstrated that children who participated in preventive developmental interventions showed significant improvement within approximately 6-10 months. These findings highlight the importance of early screening and timely intervention, as developmental risk factors can often be effectively addressed through targeted support programs.',
			'A projekt legfontosabb üzenete a pedagógusoknak és a szülőknek is az, hogy ha időben sikerül beazonosítani a gyermek nehézségeit, akkor nemcsak sikerélményt biztosíthatunk számára, hanem támogathatjuk a sikeres iskolai beválást, és mentesíthetjük őt a későbbi iskolai kudarcoktól.' => 'The central message of the project for educators and parents is that identifying developmental difficulties in time provides children with better opportunities for success, supports successful school adaptation, and helps prevent future academic difficulties and school failure.',
			'Az Iskolára készen! program célja 30 vidéki óvodába eljutni a megyében található 188-ból, azokba az intézményekbe, ahol legalább 20 nagycsoportos gyermek van.' => 'The program aims to reach 30 kindergartens out of the county’s 188 institutions, focusing primarily on rural communities and facilities with at least 20 children in the final preschool year.',
			'A tevékenységek a Szatmár Megyei Tanfelügyelőséggel szoros együttműködésben valósulnak meg, óvónőknek szóló workshopok, óvodás gyermekek iskola előtti szűrései és szülői tájékoztatók formájában.' => 'The activities will be implemented in close cooperation with the Satu Mare County School Inspectorate and will include workshops for kindergarten teachers, sensory-motor, cognitive, and psychological assessments for preschool children, and information sessions for parents.',
			'A korai szűrés nemcsak a gyermek aktuális fejlődési állapotáról ad képet, hanem lehetőséget teremt arra is, hogy a család, az óvoda és a szakemberek együtt támogassák a sikeres iskolakezdést.' => 'Early screening not only provides insight into the child’s current developmental status, but also creates an opportunity for the family, kindergarten, and specialists to support a successful start to school together.',

			// Events, gallery, partners, knowledge and contact.
			'ESEMÉNYEK' => 'EVENTS',
			'Cikkek' => 'Articles',
			'CIKKEK' => 'ARTICLES',
			'Vegyen részt egészségügyi szűréseinken, workshopjainkon és közösségi programjainkon!' => 'Take part in our health screenings, workshops, and community programs!',
			'Itt találhat információkat a projekt keretében szervezett eseményekről, valamint az egészségfejlesztési, prevenciós és közösségépítő alkalmakról.' => 'Here you can find information about events organized within the project, along with opportunities to participate in health promotion, prevention, and community development activities.',
			'Upcoming Events' => 'Upcoming Events',
			'Past Events' => 'Past Events',
			'Event 1' => 'Event 1',
			'Event 2' => 'Event 2',
			'Event 3' => 'Event 3',
			'Esemény címe' => 'Event Title',
			'Rövid leírás az eseményről.' => 'Short description of the event.',
			'Fotók és videók egészségügyi eseményeinkről, szűréseinkről és közösségi aktivitásainkról.' => 'Explore photos and videos from our activities and community programs.',
			'Kiemelt albumok' => 'Featured Albums',
			'Fotóalbum' => 'Photo Album',
			'Videó' => 'Video',
			'Galéria' => 'Gallery',
			'Összes' => 'All',
			'Szűrések' => 'Screenings',
			'Workshopok' => 'Workshops',
			'Közösségi események' => 'Community Events',
			'Educational activities' => 'Educational activities',
			'A galéria az alábbi pillanatokat mutatja be:' => 'The gallery showcases moments from:',
			'szűrőkampányok' => 'screening campaigns',
			'mobil egészségügyi szolgáltatások' => 'mobile healthcare services',
			'workshopok és szemléletformáló alkalmak' => 'workshops and awareness sessions',
			'oktatási tevékenységek' => 'educational activities',
			'közösségi események' => 'community events',
			'gyermekeknek és családoknak szóló programok' => 'programs for children and families',
			'A képek és videók betekintést adnak a Szatmár megyei közösségekben végzett munkánk hatásába.' => 'Through these images and videos, visitors can gain insight into the impact of our work across communities in Satu Mare County.',
			'PARTNEREK' => 'PARTNERS',
			'A projekt sikeres megvalósítása erős szakmai együttműködésre, valamint intézményi és közösségi partnerekkel való aktív kapcsolatra épül.' => 'The successful implementation of the project is based on strong professional cooperation and active collaboration with institutional and community partners.',
			'Köszönjük mindazon szervezetek és intézmények támogatását, amelyek hozzájárulnak programjaink fejlesztéséhez és megvalósításához.' => 'We thank all organizations and institutions that contribute to the development and implementation of our programs.',
			'TUDÁSTÁR' => 'KNOWLEDGE CENTER',
			'Hasznos információk egészségéért' => 'Useful Information for Your Health',
			'Ez a szekció egészségfejlesztéssel és betegségmegelőzéssel kapcsolatos cikkeket, oktatási anyagokat és gyakorlati forrásokat tartalmaz.' => 'This section provides articles, educational materials, and practical resources related to health promotion and disease prevention.',
			'Ajánlott témák' => 'Suggested Topics',
			'A megelőzés fontossága' => 'The Importance of Prevention',
			'Demográfiai kihívások és népegészségügy' => 'Demographic Challenges and Public Health',
			'Egészséges életmód útmutató' => 'Healthy Lifestyle Guide',
			'Kiegyensúlyozott táplálkozás' => 'Balanced Nutrition',
			'Fizikai aktivitás és egészség' => 'Physical Activity and Health',
			'Családi egészség' => 'Family Health',
			'Szűrés és korai felismerés' => 'Screening and Early Detection',
			'Gyermek- és serdülőkori egészség' => 'Children’s and Adolescent Health',
			'Elérhető források' => 'Available Resources',
			'oktatási cikkek' => 'educational articles',
			'letölthető anyagok' => 'downloadable materials',
			'gyakorlati útmutatók' => 'practical guides',
			'gyakori kérdések' => 'frequently asked questions',
			'Hasznos tartalmak a megelőzésről, a rendszeres szűrések szerepéről és a korai felismerés jelentőségéről.' => 'Useful content about prevention, the role of regular screenings, and the importance of early detection.',
			'Ismeretterjesztő anyagok családokról, közösségekről és a helyi egészségfejlesztés szerepéről.' => 'Educational materials about families, communities, and the role of local health promotion.',
			'Miért fontos a családok, fiatalok és közösségek egészségének támogatása?' => 'Why is it important to support the health of families, young people, and communities?',
			'Ingyenesek a szűrések és tanácsadások?' => 'Are screenings and counseling services free of charge?',
			'Kik vehetnek részt a programokon?' => 'Who can participate in the programs?',
			'Milyen szűréseket biztosítunk?' => 'What screenings do we provide?',
			'Hogyan lehet jelentkezni?' => 'How can I register?',
			'KAPCSOLAT' => 'CONTACT',
			'Lépjen kapcsolatba velünk!' => 'Get in Touch With Us!',
			'Kérdése van programjainkkal, szűréseinkkel vagy tanácsadási lehetőségeinkkel kapcsolatban? Keressen minket bizalommal, munkatársaink készséggel állnak rendelkezésére.' => 'Do you have questions about our programs, screening services, or counseling opportunities? Feel free to contact us. Our team is ready to provide information and assistance.',
			'Kérdése van programjainkkal, szűréseinkkel vagy tanácsadási lehetőségeinkkel kapcsolatban?' => 'Do you have questions about our programs, screening services, or counseling opportunities?',
			'Keressen minket bizalommal, munkatársaink készséggel állnak rendelkezésére.' => 'Feel free to contact us. Our team is ready to provide information and assistance.',
			'Egészsége nem várhat!' => 'Your Health Cannot Wait!',
			'Időpontfoglalás, programjainkról való érdeklődés vagy további információ kérése.' => 'Book an appointment, inquire about our programs, or request additional information.',
			'Telefonhívás' => 'Phone Call',
			'Hívás most' => 'Call Now',
			'Írjon nekünk' => 'Write to Us',
			'Kapcsolati űrlap' => 'Contact Form',
			'Töltse ki az alábbi mezőket, és hamarosan felvesszük Önnel a kapcsolatot.' => 'Fill in the fields below and we will get back to you as soon as possible.',
			'Várjuk megkeresését!' => 'We look forward to hearing from you!',
			'Választott szolgáltatás' => 'Selected Service',
			'Időpont egyeztetés' => 'Appointment Booking',
			'Tanácsadás' => 'Counseling',
			'Egyéb érdeklődés' => 'Other Inquiry',
			'Hol talál minket?' => 'Where to Find Us',
			'Megnyitás térképen' => 'Open in Map',
			'Útvonaltervezés' => 'Get Directions',
			'Térkép megnyitása' => 'Open in Map',
			'Kapcsolatfelvétel megjelenítése' => 'Show Contact Section',
			'Kapcsolódó mobil szűrés' => 'Related Mobile Screening',

			// Additional existing widget defaults and editor labels covered by the RO variants.
			'A kezdeményezés különösen fontos a szociálisan hátrányos lakossági csoportok és az infrastrukturálisan izolált települések számára, ahol a szakorvosi ellátáshoz való hozzáférés korlátozottabb lehet.' => 'The initiative is especially important for socially disadvantaged population groups and geographically isolated communities where access to specialist healthcare may be more limited.',
			'A kitűzött cél legalább 30 megyei intézményben, melyben 500-600 nagycsoportos óvodás felmérése zajlik majd a szakemberek által, az óvónők segítségével.' => 'The objective is to assess 500-600 children in their final preschool year across at least 30 county institutions, with the involvement of specialists and kindergarten teachers.',
			'A korai felismerés és a rendszeres szűrés szerepe az egészségmegőrzésben.' => 'The role of early detection and regular screening in maintaining health.',
			'A megelőzés fontossága és az egészséges életmód népszerűsítése' => 'Promoting the importance of prevention and healthy lifestyles',
			'A megelőzés segít időben felismerni a kockázatokat, támogatja az egészségtudatos döntéseket és hozzájárulhat a hosszabb, aktívabb élethez.' => 'Prevention helps identify risks in time, supports health-conscious decisions, and can contribute to a longer, more active life.',
			'A megyében hiánypótló egészségügyi tanácsadói iroda az alapellátás szerepének megerősítését, a betegségmegelőzést, a szűréseken való részvétel fontosságát és az egészséges életforma népszerűsítését szolgálja.' => 'This health counseling office fills an important gap in the county by strengthening primary healthcare, disease prevention, participation in screenings, and the promotion of healthy lifestyles.',
			'A pilot projektben azonosított gyakori rizikó tünetek' => 'Common risk indicators identified in the pilot project',
			'A prevenció és az egészségmegőrzés fontossága' => 'The importance of prevention and maintaining health',
			'A program fő tevékenységei' => 'Main Program Activities',
			'A projektről' => 'About the Project',
			'A szakorvosi ellátás közelebb kerül a vidéki közösségekhez.' => 'Specialist healthcare is brought closer to rural communities.',
			'A szolgáltatás közelebb kerül a beteghez' => 'The service is brought closer to the patient',
			'A szűrés helybe megy, hogy a megelőzés minél több emberhez eljusson' => 'Screening is delivered locally so prevention can reach more people',
			'A tanácsadás előzetes egyeztetés alapján érhető el.' => 'Counseling is available by prior appointment.',
			'Akcentus kék' => 'Accent Blue',
			'Album' => 'Album',
			'Az Európai Unió társfinanszírozásával' => 'Co-financed by the European Union',
			'Az alapellátás szerepének megerősítése' => 'Strengthening the role of primary healthcare',
			'Az egészséges életmód kialakítása könnyebb, ha szakmai támogatás kíséri.' => 'Developing a healthy lifestyle is easier with professional support.',
			'Az egészségfejlesztés akkor hatékony, ha szervezett, elérhető és közösségközeli.' => 'Health promotion is effective when it is organized, accessible, and close to the community.',
			'Az egészségügyi szolgáltatásokhoz való hozzáférés javítása' => 'Improving access to healthcare services',
			'Az időben felismert nehézségek célzott fejlesztéssel behozhatóak.' => 'Difficulties identified in time can be addressed through targeted development.',
			'Bevont háziorvosok' => 'Involved Family Physicians',
			'Biztosított onkológiai szűrések' => 'Provided Oncological Screenings',
			'Boldog Scheffler János Központ' => 'Blessed Scheffler János Center',
			'Bőr-, prosztata-, mell- és vastagbél-szűrések a megelőzés támogatására.' => 'Skin, prostate, breast, and colorectal screenings to support prevention.',
			'Cikluskövetés-oktatás' => 'Menstrual Cycle Tracking Education',
			'Csak jövőbeli események' => 'Future Events Only',
			'Csak kézi menüpontoknál használatos. WordPress menünél a WordPress current-menu-item osztályai érvényesülnek.' => 'Used only for manual menu items. For WordPress menus, the WordPress current-menu-item classes apply.',
			'Család és közösség' => 'Family and Community',
			'Családalapú ellátás' => 'Family-based Care',
			'Családalapú ellátás támogatása' => 'Supporting family-based care',
			'Csoportos és egyéni egészségnevelés' => 'Group and Individual Health Education',
			'Csökkentheti a falusi és városi ellátáshoz való hozzáférés különbségeit.' => 'It can reduce differences in access to healthcare between rural and urban areas.',
			'Csökkentheti a későbbi iskolai kudarcok kockázatát.' => 'It can reduce the risk of later school difficulties.',
			'Dekor háttér' => 'Decorative Background',
			'Demográfia' => 'Demographics',
			'Demográfiai kihívások' => 'Demographic Challenges',
			'Demográfiai kihívások kezelése' => 'Addressing Demographic Challenges',
			'EFI logó' => 'HPO Logo',
			'EFI logó szélessége' => 'HPO Logo Width',
			'EFI név tipográfia' => 'HPO Name Typography',
			'EFI szöveg színe' => 'HPO Text Color',
			'Egyedi egészségügyi és életmódtanácsadás' => 'Personalized Health and Lifestyle Counseling',
			'Egyedülálló egészségügyi tanácsadói forma a régióban' => 'A unique form of health counseling in the region',
			'Egyeztessen időpontot!' => 'Book an Appointment',
			'Egyszerű, követhető szokások a mindennapi egészség támogatásához.' => 'Simple, easy-to-follow habits to support everyday health.',
			'Egyéni egészségterv készítése' => 'Preparing an Individual Health Plan',
			'Egyéni egészségterv és célzott prevenciós tanácsadás' => 'Individual Health Plan and Targeted Preventive Counseling',
			'Egyéni egészségterv és prevenciós tanácsadás' => 'Individual Health Plan and Preventive Counseling',
			'Egyéni és csoportos tanácsadás' => 'Individual and Group Counseling',
			'Egyéni és csoportos tanácsadással is támogatja az érdeklődőket.' => 'It also supports participants through individual and group counseling.',
			'Egészség közelebb a közösségekhez' => 'Health Closer to Communities',
			'Egészséges életmód' => 'Healthy Lifestyle',
			'Egészséges életmód és prevenció' => 'Healthy Lifestyle and Prevention',
			'Egészségesebb mindennapok tudatos lépésekkel' => 'Healthier Everyday Life Through Conscious Steps',
			'Egészségesebb életmód, tudatosabb döntések' => 'Healthier Lifestyle, More Conscious Decisions',
			'Egészségesebb életmódra törekvő lakosoknak' => 'For residents seeking a healthier lifestyle',
			'Egészségesebb életmódra vágyóknak' => 'For people seeking a healthier lifestyle',
			'Egészségfejlesztési Iroda összefoglaló' => 'Health Promotion Office Summary',
			'Egészségfejlesztési Irodába jelentkezőknek' => 'For people contacting the Health Promotion Office',
			'Egészségfejlesztési programok és lakossági aktivitások.' => 'Health promotion programs and community activities.',
			'Egészségfelmérési tevékenységek' => 'Health Assessment Activities',
			'Egészségi állapot javítása' => 'Improving Health Status',
			'Egészségnevelés, szülői tájékoztatók és szakmai alkalmak.' => 'Health education, parent information sessions, and professional events.',
			'Egészségügyi hozzáférés' => 'Healthcare Access',
			'Egészségügyi tanácsadói iroda' => 'Health Counseling Office',
			'Elem' => 'Item',
			'Elérhető támogatási formák' => 'Available Forms of Support',
			'Elérhetőségek' => 'Contact Details',
			'Előzetes egyeztetés alapján' => 'By prior appointment',
			'Erősítheti az alapellátás és a szakrendelői járóbeteg-ellátás kapcsolatát.' => 'It can strengthen the link between primary healthcare and outpatient specialist care.',
			'Erősíti a helyi háziorvosokkal való együttműködést.' => 'It strengthens cooperation with local family physicians.',
			'Erősíti a megelőzésre épülő szemléletmódot.' => 'It strengthens a prevention-oriented mindset.',
			'Erősíti a szakemberek, óvónők és szülők együttműködését.' => 'It strengthens cooperation among specialists, kindergarten teachers, and parents.',
			'Erősíti az alapellátás szerepét a lakosság egészségvédelmében.' => 'It strengthens the role of primary healthcare in protecting public health.',
			'Események képekben' => 'Events in Pictures',
			'Esélyegyenlőség. Prevenció. Életerős közösségek.' => 'Equal Opportunities. Prevention. Vibrant Communities.',
			'Felhívja a figyelmet a betegségmegelőzés jelentőségére.' => 'It draws attention to the importance of disease prevention.',
			'Felmérés' => 'Assessment',
			'Fiatalok és felnőttek' => 'Young People and Adults',
			'Fiatalok és felnőttek számára is elérhető programokat és akciókat szervez.' => 'It organizes programs and activities available to both young people and adults.',
			'Fiataloknak és felnőtteknek szóló népszerűsítő akciók' => 'Awareness activities for young people and adults',
			'Figyelem gyengesége' => 'Attention Difficulties',
			'Fotó' => 'Photo',
			'Fotók' => 'Photos',
			'Friss tudnivalók' => 'Latest Information',
			'Főbb szolgáltatási területek' => 'Main Service Areas',
			'Főoldal / Programok / Óvodás iskolaérettséget vizsgáló szűrések' => 'Home / Programs / PreSchool Screening',
			'GYIK megjelenítése' => 'Show FAQ',
			'Grafomotoros éretlenség' => 'Graphomotor Immaturity',
			'Gyakorlati tanácsok a mindennapokra.' => 'Practical advice for everyday life.',
			'Gyakorlati tanácsok, letölthető anyagok és GYIK a tudatosabb mindennapokhoz.' => 'Practical advice, downloadable materials, and FAQ for more conscious everyday life.',
			'Gyermek' => 'Children',
			'Gyors elérhetőség' => 'Quick Contact',
			'Ha kitöltöd, a beépített statikus űrlap helyett ez jelenik meg.' => 'If completed, this will be displayed instead of the built-in static form.',
			'Hagyd üresen automatikus felismeréshez. Támogatott példák: _EventVenueID, _event_location_id, location.' => 'Leave empty for automatic detection. Supported examples: _EventVenueID, _event_location_id, location.',
			'Hasznos információk az egészségesebb mindennapokért' => 'Useful Information for Healthier Everyday Life',
			'Hasznos információk és letölthető szűrési anyagok' => 'Useful Information and Downloadable Screening Materials',
			'Hasznosság' => 'Usefulness',
			'Hatások' => 'Effects',
			'Helybe vitt ellátás' => 'Locally Delivered Care',
			'Helyben elérhető ellátás' => 'Locally Available Care',
			'Helyszínek / háziorvosok' => 'Locations / Family Physicians',
			'Helyszíni programok és szakmai aktivitások.' => 'On-site programs and professional activities.',
			'Hero háttérkép' => 'Hero Background Image',
			'Hero megjelenítése' => 'Show Hero',
			'Hiánypótló iroda' => 'Gap-filling Office',
			'Hosszabb távon kedvezően hathat a lakosság egészségi mutatóira.' => 'In the longer term, it may have a favorable impact on public health indicators.',
			'Hozzájárulhat a korai felismerés és a hatékony terápia megvalósításához.' => 'It can contribute to early detection and effective therapy.',
			'Hozzájárulhat a sikeres iskolai beváláshoz.' => 'It can contribute to successful school adaptation.',
			'Háziorvos' => 'Family Physician',
			'Hódmezővásárhelyi-Makói Egészségellátó Központ' => 'Hódmezővásárhely-Makó Health Care Centre',
			'Ide érkeznek majd a szakmai és ismeretterjesztő tartalmak.' => 'Professional and educational content will appear here.',
			'Közérthető, magyar és román nyelvű PDF tájékoztatók a prevenció, a szűrések és az egészségtudatos döntések támogatásához.' => 'Clear Hungarian and Romanian PDF information materials to support prevention, screenings, and health-conscious decisions.',
			'Közérthető PDF tájékoztatók a prevenció, a szűrések és az egészségtudatos döntések támogatásához.' => 'Clear PDF information materials to support prevention, screenings, and health-conscious decisions.',
			'Időpont' => 'Appointment',
			'Időpont-egyeztetés' => 'Appointment Scheduling',
			'Információk' => 'Information',
			'Integrálatlan csecsemőkori reflexek' => 'Unintegrated Primitive Reflexes',
			'Interreg Románia-Magyarország' => 'Interreg Romania-Hungary',
			'Interreg program' => 'Interreg Programme',
			'Intézmény' => 'Institution',
			'Iskola előtti felmérés szakemberek, óvónők és szülők bevonásával' => 'Pre-school assessment involving specialists, kindergarten teachers, and parents',
			'Iskolakezdés előtt álló családoknak' => 'For families preparing for school entry',
			'Iskolaérettséget vizsgáló szűrés' => 'School Readiness Screening',
			'Iskolára készen kampány' => 'Ready for School Campaign',
			'Javíthatja a szakellátáshoz való hozzáférést izolált településeken.' => 'It can improve access to specialist care in isolated communities.',
			'Jelentkezzen szűréseinkre, tanácsadásainkra vagy közösségi programjainkra.' => 'Register for our screenings, counseling services, or community programs.',
			'Jobb oldali logók' => 'Right-side Logos',
			'Kapcsolat gomb' => 'Contact Button',
			'Kapcsolat link' => 'Contact Link',
			'Kapcsolat oldal' => 'Contact Page',
			'Kapcsolat és alsó sáv' => 'Contact and Bottom Bar',
			'Kapcsolatfelvételi űrlap' => 'Contact Form',
			'Kapcsolati információk' => 'Contact Information',
			'Kapcsolódó program' => 'Related Program',
			'Kardiovaszkuláris és egyéb szakvizsgálatok' => 'Cardiovascular and Other Specialist Examinations',
			'Keressen minket, segítünk megtalálni a megfelelő tájékoztatót vagy programot.' => 'Contact us and we will help you find the right information or program.',
			'Kiemelt album' => 'Featured Album',
			'Kiemelt elemek' => 'Featured Items',
			'Kiemelt partner' => 'Featured Partner',
			'Kiemelt szűrések' => 'Featured Screenings',
			'Kiemelt téma' => 'Featured Topic',
			'Kihelyezett kardiovaszkuláris és onkológiai szűrések.' => 'Locally deployed cardiovascular and oncological screenings.',
			'Kihelyezett szakorvosi ellátás' => 'Deployed Specialist Care',
			'Kognitív képességek felmérése' => 'Assessment of Cognitive Abilities',
			'Korai fejlesztést támogató közösségi alkalmak.' => 'Community events supporting early development.',
			'Korai felismerés' => 'Early Detection',
			'Korai felismerés a sikeres iskolakezdésért' => 'Early Detection for a Successful Start to School',
			'Korai onkológiai szűrések helyben' => 'Early Oncological Screenings Locally',
			'Képek és videók' => 'Photos and Videos',
			'Kézi kártyák használata, ha nincs találat' => 'Use Manual Cards if There Are No Results',
			'Könnyebbé teszi a szűrésekhez való hozzáférést vidéki településeken.' => 'It makes access to screenings easier in rural communities.',
			'Közelgő esemény' => 'Upcoming Event',
			'Közoktatási intézmények és Egészségfejlesztési Iroda' => 'Educational Institutions and Health Promotion Office',
			'Középtávon javíthatja a lakosság egészségi mutatóit.' => 'It can improve public health indicators in the medium term.',
			'Közösségi aktivitások' => 'Community Activities',
			'Közösségi alapú ellátás' => 'Community-based Care',
			'Közösségi egészségfejlesztés' => 'Community Health Promotion',
			'Közösségi egészségnap' => 'Community Health Day',
			'Lateralitás és dominancia problémák' => 'Laterality and Dominance-related Challenges',
			'Landing stílus' => 'Landing Style',
			'Legalább 60 óvónő bevonása' => 'At least 60 kindergarten teachers involved',
			'Legalább 60 óvónő és a szülők' => 'At least 60 kindergarten teachers and parents',
			'Legutóbbi feltöltések' => 'Latest Uploads',
			'Lehetőséget ad a rizikó tünetek időben történő felismerésére.' => 'It creates an opportunity to identify risk indicators in time.',
			'Letölthető szűrési anyagok' => 'Downloadable Screening Materials',
			'Letölthető, kétnyelvű tájékoztatók bőr-, mell-, prosztata- és vastagbélrák szűrésről, valamint a szív- és érrendszeri egészségről.' => 'Downloadable bilingual information materials about skin, breast, prostate, and colorectal cancer screening, plus cardiovascular health.',
			'Letölthető tájékoztatók bőr-, mell-, prosztata- és vastagbélrák szűrésről, valamint a szív- és érrendszeri egészségről.' => 'Downloadable information materials about skin, breast, prostate, and colorectal cancer screening, plus cardiovascular health.',
			'Letöltések megtekintése' => 'View Downloads',
			'Videók megjelenítése' => 'Show Videos',
			'Beágyazott videók' => 'Embedded Videos',
			'Videós tartalmak a prevencióhoz, szűrésekhez és egészségtudatos döntésekhez.' => 'Video content for prevention, screenings, and health-conscious decisions.',
			'Videó címe' => 'Video Title',
			'Videó URL vagy iframe kód' => 'Video URL or iframe Code',
			'YouTube/Vimeo URL-t vagy iframe beágyazási kódot is elfogad.' => 'Accepts a YouTube/Vimeo URL or iframe embed code.',
			'Beágyazott videó' => 'Embedded Video',
			'Lépjen kapcsolatba velünk' => 'Contact Us',
			'A PDF-ek magyar és román nyelven érhetők el a legfontosabb szűrési és prevenciós témákban.' => 'The PDFs are available in Hungarian and Romanian for the key screening and prevention topics.',
			'A szűrési és prevenciós témák PDF formátumban érhetők el.' => 'The screening and prevention topics are available in PDF format.',
			'Bőrrák szűrési tájékoztató' => 'Skin Cancer Screening Information',
			'Magyar nyelvű PDF, 2026' => 'Hungarian PDF, 2026',
			'Magyarország Kormánya' => 'Government of Hungary',
			'Megelőzés iránt érdeklődőknek' => 'For people interested in prevention',
			'Megközelítés' => 'Access',
			'Megvalósítás' => 'Implementation',
			'Megvalósítás helye' => 'Implementation Location',
			'Melanóma szűrés' => 'Melanoma Screening',
			'Mellrák szűrés' => 'Breast Cancer Screening',
			'Mellrák szűrési tájékoztató' => 'Breast Cancer Screening Information',
			'Mini téma' => 'Mini Topic',
			'Mobil kardiovaszkuláris szűrés' => 'Mobile Cardiovascular Screening',
			'Mobil szakorvosi szolgálat' => 'Mobile Specialist Medical Service',
			'Mobil szakorvosi szolgálat összefoglaló' => 'Mobile Specialist Medical Service Summary',
			'Mobil szűrés' => 'Mobile Screening',
			'Mobil szűrés megtekintése' => 'View Mobile Screening',
			'Méhnyakrák szűrés' => 'Cervical Cancer Screening',
			'Nagycsoportos óvodás gyermekek' => 'Children in the final preschool year',
			'Nagycsoportos óvodás gyermekeknek' => 'For children in the final preschool year',
			'Nehezebben utazó lakosoknak' => 'For residents who have difficulty traveling',
			'Nem a beteg utazik, hanem a szolgáltatás kerül közelebb hozzá.' => 'The patient does not travel; the service is brought closer to them.',
			'Népesedési folyamatok javítása helyi szinten egészségfejlesztési módszerekkel' => 'Improving Demographic Processes at Local Level Through Health Promotion Methods',
			'Oktatás' => 'Education',
			'Oktatási tartalom' => 'Educational Content',
			'Onkológiai szűrések' => 'Oncological Screenings',
			'Onkológiai szűrések vidéki helyszíneken, háziorvosok bevonásával.' => 'Oncological screenings in rural locations with the involvement of family physicians.',
			'Partner intézmények' => 'Partner Institutions',
			'Partnerek oldal' => 'Partners Page',
			'Pillanatképek helyszíni szűrőprogramjainkról.' => 'Snapshots from our on-site screening programs.',
			'Prevenció' => 'Prevention',
			'Prevenció fontossága' => 'Importance of Prevention',
			'Prevenció iránt érdeklődő fiataloknak és felnőtteknek' => 'For young people and adults interested in prevention',
			'Prevenció és egészségnevelés' => 'Prevention and Health Education',
			'Prevenció és egészségnevelés erősítése' => 'Strengthening prevention and health education',
			'Prevenció és életmódprogramok' => 'Prevention and Lifestyle Programs',
			'Prevenciós tájékoztató' => 'Prevention Information',
			'Prevenciós támogatás' => 'Preventive Support',
			'Prevenciós támogatást kereső fiataloknak és felnőtteknek' => 'For young people and adults seeking preventive support',
			'Prevenciós és egészségnevelési tevékenységek' => 'Prevention and Health Education Activities',
			'Program' => 'Program',
			'Program neve' => 'Program Name',
			'Program szekciók' => 'Program Sections',
			'Programok, találkozók és helyi kezdeményezések.' => 'Programs, meetings, and local initiatives.',
			'Projektbemutató' => 'Project Presentation',
			'Projektpartner' => 'Project Partner',
			'Prosztata, mell, méhnyak, melanóma, vastagbél' => 'Prostate, breast, cervical, melanoma, colorectal',
			'Prosztatarák szűrés' => 'Prostate Cancer Screening',
			'Prosztatarák szűrési tájékoztató' => 'Prostate Cancer Screening Information',
			'Pszicho-szociális tanácsadás' => 'Psychosocial Counseling',
			'Pszicho-szociális, táplálkozási és prevenciós tanácsadás egyéni egészségtervvel.' => 'Psychosocial, nutritional, and preventive counseling with an individual health plan.',
			'Pszichológiai szűrések' => 'Psychological Screenings',
			'Pszichológus, táplálkozási szakértő és más szakemberek' => 'Psychologist, nutrition specialist, and other professionals',
			'Páli Szent Vincéről Nevezett Szatmári Irgalmas Nővérek Egyesülete' => 'Association of the Sisters of Charity of Saint Vincent de Paul from Satu Mare',
			'Rehabilitációt támogató szolgáltatások' => 'Services supporting rehabilitation',
			'Rizikó tünet' => 'Risk Indicator',
			'Román nyelvű PDF, 2026' => 'Romanian PDF, 2026',
			'Rövid videós betekintés a szakmai munkába.' => 'A short video insight into the professional work.',
			'Rövid áttekintés közösségi szinten.' => 'A brief community-level overview.',
			'Rövid összefoglalók eseményeinkről.' => 'Short summaries of our events.',
			'Segítheti a daganatos betegségek korábbi felismerését.' => 'It can support earlier detection of oncological diseases.',
			'Segítheti a háziorvosi munka megelőzésben betöltött szerepét.' => 'It can support the preventive role of family physician work.',
			'Segíti a gyermekek iskolaérettségének korai felmérését.' => 'It supports early assessment of children’s school readiness.',
			'Segíti a lakosság egészségtudatos döntéseit.' => 'It supports health-conscious decisions among residents.',
			'Sticky fejléc' => 'Sticky Header',
			'Szakellátás közelebb vitele a vidéki közösségekhez' => 'Bringing specialist healthcare closer to rural communities',
			'Szakemberek' => 'Professionals',
			'Szakemberek bevonásával nyújt egyedi tanácsadást és támogatást.' => 'It provides personalized counseling and support with the involvement of professionals.',
			'Szakmai találkozók és tájékoztató alkalmak.' => 'Professional meetings and information sessions.',
			'Szakorvosi vizsgálatok, vidéki közösségek és erősebb alapellátási kapcsolatok.' => 'Specialist examinations, rural communities, and stronger primary care connections.',
			'Szakorvosi vizsgálatok, vidéki közösségek, javuló hozzáférés.' => 'Specialist examinations, rural communities, improved access.',
			'Szakvizsgálatok' => 'Specialist Examinations',
			'Szakvizsgálatra váró pácienseknek' => 'For patients waiting for specialist examinations',
			'Szatmár megye vidéki települései' => 'Rural communities of Satu Mare County',
			'Személyre szabott terv' => 'Personalized Plan',
			'Személyre szabott támogatás' => 'Personalized Support',
			'Szenzo-motoros szűrések' => 'Sensory-motor Screenings',
			'Szenzo-motoros, kognitív és pszichológiai szűrések óvodás gyermekeknek.' => 'Sensory-motor, cognitive, and psychological screenings for preschool children.',
			'Szervezett formában népszerűsíti az egészséges életmódot.' => 'It promotes healthy lifestyles in an organized form.',
			'Szolgáltatás' => 'Service',
			'Széles körű támogatás' => 'Broad Support',
			'Szív / egészség' => 'Heart / Health',
			'Szív- és érrendszeri tájékoztató' => 'Cardiovascular Health Information',
			'Szülői tájékoztatók' => 'Parent Information Sessions',
			'Szűrés' => 'Screening',
			'Szűrési anyagok' => 'Screening Materials',
			'Szűrések listája' => 'Screening List',
			'Szűrésekhez nehezebben hozzáférő lakosoknak' => 'For residents with more limited access to screenings',
			'Szűrési területek' => 'Screening Areas',
			'Szűrési tevékenységek' => 'Screening Activities',
			'Szűrési tájékoztatók egy helyen' => 'Screening Information in One Place',
			'Szűrési és tájékoztatási tevékenységek' => 'Screening and Information Activities',
			'Szűrők' => 'Filters',
			'Szűrők megjelenítése' => 'Show Filters',
			'Szűrővizsgálati kisokos' => 'Screening Guide',
			'HU és RO PDF-ek' => 'HU and RO PDFs',
			'PDF tájékoztatók' => 'PDF Information Materials',
			'Szűrővizsgálatok fontosságáról tájékozódni vágyóknak' => 'For people seeking information about the importance of screenings',
			'Szűrővizsgálatok jelentőségének népszerűsítése' => 'Promoting the importance of screenings',
			'Tanácsadás, prevenció és egészségfejlesztés egy helyen' => 'Counseling, Prevention, and Health Promotion in One Place',
			'Tanácsadás, prevenció, szűrések, rehabilitáció' => 'Counseling, Prevention, Screenings, Rehabilitation',
			'Tanácsadás, szűrés, prevenció és szakmai támogatás szervezett formában.' => 'Counseling, screening, prevention, and professional support in an organized form.',
			'Tanácsadási programok' => 'Counseling Programs',
			'Tanácsadási területek' => 'Counseling Areas',
			'Tanácsadástól a prevención át a rehabilitációig' => 'From Counseling through Prevention to Rehabilitation',
			'Tanácsadói tevékenységek ellátása' => 'Providing counseling and advisory services',
			'Telefon gomb' => 'Phone Button',
			'Telefonhívás indítása' => 'Start Phone Call',
			'Termékenységtudatosság' => 'Fertility Awareness',
			'Termékenységtudatosság iránt érdeklődő nőknek' => 'For women interested in fertility awareness',
			'Termékenységtudatosság és cikluskövetési módszerek' => 'Fertility awareness and cycle tracking methods',
			'Tervezett elérés' => 'Planned Reach',
			'Tervezett résztvevők' => 'Planned Participants',
			'Tervezett szűrés' => 'Planned Screening',
			'Terápiás munkát segítő szakmai tevékenységek' => 'Professional activities supporting therapeutic work',
			'Tevékenység' => 'Activity',
			'The Events Calendar esetén hagyd tribe_events értéken.' => 'For The Events Calendar, keep the value tribe_events.',
			'The Events Calendar esetén hagyd üresen vagy használd: _EventStartDate.' => 'For The Events Calendar, leave empty or use: _EventStartDate.',
			'Tudatosítja a korai szűrés és a megelőzés jelentőségét.' => 'It raises awareness of the importance of early screening and prevention.',
			'Tudástár oldal' => 'Knowledge Center Page',
			'Tudástár oldalsáv' => 'Knowledge Center Sidebar',
			'Tudásátadás és felelős döntéshozatal támogatása' => 'Supporting knowledge transfer and responsible decision-making',
			'Tájékoztatók, útmutatók és programismertetők egy helyen.' => 'Information materials, guides, and program descriptions in one place.',
			'Támogathatja a hátrányos helyzetű vidéki közösségek ellátását.' => 'It can support care for disadvantaged rural communities.',
			'Támogathatja a szociálisan hátrányos lakossági csoportokat.' => 'It can support socially disadvantaged population groups.',
			'Támogatja a célirányos, preventív fejlesztések elindítását.' => 'It supports the launch of targeted preventive development.',
			'Támogatja a háziorvosi rendelők és szakrendelők kapcsolatát.' => 'It supports the connection between family physician practices and specialist clinics.',
			'Támogatja a lakosság egészségtudatosabb döntéseit.' => 'It supports more health-conscious decisions among residents.',
			'Támogatja a szűrővizsgálatokon való részvétel fontosságának tudatosítását.' => 'It raises awareness of the importance of participating in screenings.',
			'Támogatja az egészséges életmód kialakítását és fenntartását.' => 'It supports developing and maintaining a healthy lifestyle.',
			'Támogatási formák' => 'Forms of Support',
			'Támogatói és partner logók' => 'Sponsor and Partner Logos',
			'Táplálkozási tanácsadás' => 'Nutritional Counseling',
			'Táplálkozási tanácsadás iránt érdeklődőknek' => 'For people interested in nutritional counseling',
			'Témák' => 'Topics',
			'Téri tájékozódás éretlensége' => 'Spatial Orientation Immaturity',
			'Térkép gomb' => 'Map Button',
			'Térkép helye' => 'Map Location',
			'Térkép link' => 'Map Link',
			'Több képes galéria' => 'Multi-image Gallery',
			'Vastagbélrák szűrés' => 'Colorectal Cancer Screening',
			'Vastagbélrák szűrési tájékoztató' => 'Colorectal Cancer Screening Information',
			'Vegye fel velünk a kapcsolatot bizalommal!' => 'Feel free to contact us!',
			'Vezető partner' => 'Lead Partner',
			'Videók' => 'Videos',
			'Videós beszámolók' => 'Video Reports',
			'Vidéki településeken élőknek' => 'For residents of rural communities',
			'Vizsgálatok' => 'Examinations',
			'Vizsgálatok megtekintése' => 'View Examinations',
			'Vizsgálatok vidéki településeken' => 'Examinations in Rural Communities',
			'Válassz menüt' => 'Choose Menu',
			'Válogatás legfontosabb programjaink pillanataiból.' => 'A selection of moments from our most important programs.',
			'Várható előnyök' => 'Expected Benefits',
			'Várható hatások' => 'Expected Effects',
			'WordPress menü' => 'WordPress Menu',
			'egyedi célkitűzés' => 'specific objective',
			'fotók · videók · beszámolók' => 'photos · videos · reports',
			'gyermek' => 'child',
			'helyben' => 'locally',
			'háziorvos' => 'family physician',
			'iroda' => 'office',
			'kép' => 'image',
			'megyei intézmény az Iskolára készen kampányban' => 'county institutions in the Ready for School campaign',
			'nagycsoportos óvodás felmérése' => 'children in the final preschool year assessed',
			'onkológiai terület' => 'oncological area',
			'osztály' => 'grade',
			'prevenció' => 'prevention',
			'résztvevő mobil szűréseken' => 'participants in mobile screenings',
			'szakvizsgálat' => 'specialist examination',
			'szűrés' => 'screening',
			'tanácsadás' => 'counseling',
			'terület' => 'area',
			'tudás' => 'knowledge',
			'támogatás' => 'support',
			'vidék' => 'rural area',
			'vidéki háziorvos bevonása' => 'rural family physicians involved',
			'Életmód' => 'Lifestyle',
			'Életmódtanácsadás' => 'Lifestyle Counseling',
			'Óvoda' => 'Kindergarten',
			'Óvodai programok' => 'Kindergarten Programs',
			'Óvodás iskolaérettségi szűrések összefoglaló' => 'PreSchool Screening Summary',
			'Óvónő' => 'Kindergarten Teacher',
			'Óvónői megfigyelések bevonása' => 'Including Kindergarten Teacher Observations',
			'Óvónőknek szóló workshopok' => 'Workshops for Kindergarten Teachers',
			'Óvónőknek és óvodai közösségeknek' => 'For kindergarten teachers and kindergarten communities',
			'Összes cikk megtekintése' => 'View All Articles',
			'Összes esemény megtekintése' => 'View All Events',
			'Összes link' => 'All Links',
			'Útvonal gomb' => 'Directions Button',
			'Üzenetek' => 'Messages',
			'óvoda' => 'kindergarten',
			'óvónő' => 'kindergarten teacher',
		);

		return self::$map;
	}
}

trait VitaCenter_EN_Widget_Trait {
	public function get_title() {
		return 'EN ' . $this->vc_en_title;
	}

	protected function register_controls() {
		VitaCenter_EN_Text::begin_filter();

		try {
			parent::register_controls();
		} finally {
			VitaCenter_EN_Text::end_filter();
		}
	}

	protected function render() {
		VitaCenter_EN_Text::begin_filter();

		try {
			ob_start();
			try {
				parent::render();
				$html = ob_get_clean();
			} catch ( \Throwable $exception ) {
				ob_end_clean();
				throw $exception;
			}
		} finally {
			VitaCenter_EN_Text::end_filter();
		}

		echo VitaCenter_EN_Text::translate_markup( $html ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	public function get_settings_for_display( $setting_key = null ) {
		$settings = parent::get_settings_for_display();
		$settings = VitaCenter_EN_Text::translate_value( $settings );

		if ( null === $setting_key ) {
			return $settings;
		}

		return is_array( $settings ) && array_key_exists( $setting_key, $settings ) ? $settings[ $setting_key ] : null;
	}
}

class VitaCenter_EN_Elementor_Header_Widget extends VitaCenter_Elementor_Header_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Header/Nav';
	public function get_name() { return 'vitacenter_en_header_nav'; }
}

class VitaCenter_EN_Elementor_Landing_Widget extends VitaCenter_Elementor_Landing_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Homepage';
	public function get_name() { return 'vitacenter_en_landing_page'; }
}

class VitaCenter_EN_Header_Top_Widget extends VitaCenter_Header_Top_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Header Top';
	public function get_name() { return 'vitacenter_en_header_top'; }
}

class VitaCenter_EN_Header_Menu_Widget extends VitaCenter_Header_Menu_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Header Menu';
	public function get_name() { return 'vitacenter_en_header_menu'; }
}

class VitaCenter_EN_Landing_Hero_Widget extends VitaCenter_Landing_Hero_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Hero';
	public function get_name() { return 'vitacenter_en_landing_hero'; }
}

class VitaCenter_EN_Landing_Project_Widget extends VitaCenter_Landing_Project_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Project Intro';
	public function get_name() { return 'vitacenter_en_landing_project_intro'; }
}

class VitaCenter_EN_Landing_Programs_Widget extends VitaCenter_Landing_Programs_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Programs';
	public function get_name() { return 'vitacenter_en_landing_programs'; }
}

class VitaCenter_EN_Landing_Events_Widget extends VitaCenter_Landing_Events_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Events';
	public function get_name() { return 'vitacenter_en_landing_events'; }
}

class VitaCenter_EN_Upcoming_Events_Widget extends VitaCenter_Upcoming_Events_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Upcoming Events';
	public function get_name() { return 'vitacenter_en_upcoming_events'; }
}

class VitaCenter_EN_All_Events_Widget extends VitaCenter_All_Events_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'All Events';
	public function get_name() { return 'vitacenter_en_all_events'; }
}

class VitaCenter_EN_Landing_Cta_Widget extends VitaCenter_Landing_Cta_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter CTA';
	public function get_name() { return 'vitacenter_en_landing_cta'; }
}

class VitaCenter_EN_Landing_Knowledge_Widget extends VitaCenter_Landing_Knowledge_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Knowledge Cards';
	public function get_name() { return 'vitacenter_en_landing_knowledge'; }
}

class VitaCenter_EN_Knowledge_Widget extends VitaCenter_Knowledge_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Knowledge Center';
	public function get_name() { return 'vitacenter_en_knowledge'; }
}

class VitaCenter_EN_Video_Gallery_Widget extends VitaCenter_Video_Gallery_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Photo and Video Gallery';
	public function get_name() { return 'vitacenter_en_video_gallery'; }
}

class VitaCenter_EN_Partners_Widget extends VitaCenter_Partners_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Partners';
	public function get_name() { return 'vitacenter_en_partners'; }
}

class VitaCenter_EN_Contact_Widget extends VitaCenter_Contact_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Contact';
	public function get_name() { return 'vitacenter_en_contact'; }
}

class VitaCenter_EN_Landing_Contact_Widget extends VitaCenter_Landing_Contact_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Contact/Footer';
	public function get_name() { return 'vitacenter_en_landing_contact_footer'; }
}

class VitaCenter_EN_Legal_Footer_Widget extends VitaCenter_Legal_Footer_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Legal Footer';
	public function get_name() { return 'vitacenter_en_legal_footer'; }
}

class VitaCenter_EN_Project_Content_Widget extends VitaCenter_Project_Content_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Project Content';
	public function get_name() { return 'vitacenter_en_project_content'; }
}

class VitaCenter_EN_Program_Content_Widget extends VitaCenter_Program_Content_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Program Content';
	public function get_name() { return 'vitacenter_en_program_content'; }
}

class VitaCenter_EN_Mobile_Specialist_Widget extends VitaCenter_Mobile_Specialist_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Mobile Specialist Medical Service';
	public function get_name() { return 'vitacenter_en_mobile_specialist'; }
}

class VitaCenter_EN_Mobile_Specialist_V2_Widget extends VitaCenter_Mobile_Specialist_V2_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Mobile Specialist Medical Service 2.0';
	public function get_name() { return 'vitacenter_en_mobile_specialist_v2'; }
}

class VitaCenter_EN_Mobile_Screening_Widget extends VitaCenter_Mobile_Screening_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Mobile Screening';
	public function get_name() { return 'vitacenter_en_mobile_screening'; }
}

class VitaCenter_EN_Ciklusoktatas_Widget extends VitaCenter_Ciklusoktatas_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Menstrual Cycle Education';
	public function get_name() { return 'vitacenter_en_ciklusoktatas'; }
}

class VitaCenter_EN_Egeszsegfejlesztesi_Iroda_Widget extends VitaCenter_Egeszsegfejlesztesi_Iroda_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Health Promotion Office';
	public function get_name() { return 'vitacenter_en_egeszsegfejlesztesi_iroda'; }
}

class VitaCenter_EN_Eletmodtanacsadas_Widget extends VitaCenter_Eletmodtanacsadas_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Lifestyle Counseling';
	public function get_name() { return 'vitacenter_en_eletmodtanacsadas'; }
}

class VitaCenter_EN_Iskolaerettseg_Widget extends VitaCenter_Iskolaerettseg_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter PreSchool Screening';
	public function get_name() { return 'vitacenter_en_iskolaerettseg'; }
}

class VitaCenter_EN_Info_Section_Widget extends VitaCenter_Info_Section_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Info Section';
	public function get_name() { return 'vitacenter_en_info_section'; }
}

class VitaCenter_EN_Registration_Info_Widget extends VitaCenter_Registration_Info_Widget {
	use VitaCenter_EN_Widget_Trait;
	protected $vc_en_title = 'VitaCenter Registration / Contact';
	public function get_name() { return 'vitacenter_en_registration_info'; }
}

final class VitaCenter_EN_Widgets {
	public static function register( $widgets_manager ) {
		foreach ( self::classes() as $class_name ) {
			$widgets_manager->register( new $class_name() );
		}
	}

	private static function classes() {
		return array(
			'VitaCenter_EN_Elementor_Header_Widget',
			'VitaCenter_EN_Elementor_Landing_Widget',
			'VitaCenter_EN_Header_Top_Widget',
			'VitaCenter_EN_Header_Menu_Widget',
			'VitaCenter_EN_Landing_Hero_Widget',
			'VitaCenter_EN_Landing_Project_Widget',
			'VitaCenter_EN_Landing_Programs_Widget',
			'VitaCenter_EN_Landing_Events_Widget',
			'VitaCenter_EN_Upcoming_Events_Widget',
			'VitaCenter_EN_All_Events_Widget',
			'VitaCenter_EN_Landing_Cta_Widget',
			'VitaCenter_EN_Landing_Knowledge_Widget',
			'VitaCenter_EN_Knowledge_Widget',
			'VitaCenter_EN_Video_Gallery_Widget',
			'VitaCenter_EN_Partners_Widget',
			'VitaCenter_EN_Contact_Widget',
			'VitaCenter_EN_Landing_Contact_Widget',
			'VitaCenter_EN_Legal_Footer_Widget',
			'VitaCenter_EN_Project_Content_Widget',
			'VitaCenter_EN_Program_Content_Widget',
			'VitaCenter_EN_Mobile_Specialist_Widget',
			'VitaCenter_EN_Mobile_Specialist_V2_Widget',
			'VitaCenter_EN_Mobile_Screening_Widget',
			'VitaCenter_EN_Ciklusoktatas_Widget',
			'VitaCenter_EN_Egeszsegfejlesztesi_Iroda_Widget',
			'VitaCenter_EN_Eletmodtanacsadas_Widget',
			'VitaCenter_EN_Iskolaerettseg_Widget',
			'VitaCenter_EN_Info_Section_Widget',
			'VitaCenter_EN_Registration_Info_Widget',
		);
	}
}
