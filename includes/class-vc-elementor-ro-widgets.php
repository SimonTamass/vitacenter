<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Romanian variants for the Hungarian VitaCenter widgets.
 *
 * The RO widgets intentionally reuse the original widget renderers so the
 * visual structure, controls and CSS classes stay identical. Text is translated
 * at render/control-registration time, and legacy contact placeholders are
 * normalized to the current VitaCenter contact details.
 */
final class VitaCenter_RO_Text {
	const DOMAIN  = 'vitacenter-elementor-header';
	const PHONE   = '0742021316';
	const EMAIL   = 'contact@vitacenter.ro';
	const ADDRESS = 'Satu Mare, Str. Ștefan cel Mare nr. 13';

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
		$map  = self::map();

		if ( isset( $map[ $text ] ) ) {
			return $map[ $text ];
		}

		$decoded = html_entity_decode( $text, ENT_QUOTES, 'UTF-8' );

		if ( $decoded !== $text && isset( $map[ $decoded ] ) ) {
			return $map[ $decoded ];
		}

		$normalized = str_replace( array( '–', '—', '‑' ), '-', $decoded );

		if ( preg_match( '/\b[HL]\s*-\s*[PV]\b/i', $normalized ) && false !== strpos( $normalized, '8:00' ) && false !== strpos( $normalized, '16:00' ) ) {
			return 'Programați o consultație!';
		}

		return $text;
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
			'Szatmárnémeti központi részén, a Vasile Lucaciu utcában várjuk az érdeklődőket.' => 'Vă așteptăm în zona centrală a municipiului Satu Mare, pe Str. Ștefan cel Mare nr. 13.',
			'https://www.google.com/maps/search/?api=1&query=Szatm%C3%A1rn%C3%A9meti%2C%20Vasile%20Lucaciu%20u.%2021' => 'https://www.google.com/maps/search/?api=1&query=Satu%20Mare%2C%20Str.%20%C8%98tefan%20cel%20Mare%2013',

			// Common UI.
			'Főoldal' => 'Pagina principală',
			'Projekt' => 'Proiect',
			'Programjaink' => 'Activitățile noastre',
			'Programok' => 'Programe',
			'Események' => 'Evenimente',
			'Közelgő események' => 'Evenimente viitoare',
			'Elmúlt események' => 'Evenimente desfășurate',
			'Elmúlt esemény' => 'Eveniment desfășurat',
			'Elmúlt' => 'Desfășurat',
			'Összes esemény' => 'Toate evenimentele',
			'Fotó- és videógaléria' => 'Galerie foto și video',
			'Partnerek' => 'Parteneri',
			'Tudástár' => 'Centru de cunoștințe',
			'Kapcsolat' => 'Contact',
			'Menü' => 'Meniu',
			'Cím' => 'Adresă',
			'Alcím' => 'Subtitlu',
			'Szöveg' => 'Text',
			'Leírás' => 'Descriere',
			'Bevezető' => 'Introducere',
			'Név' => 'Nume',
			'Teljes név' => 'Nume complet',
			'Telefon' => 'Telefon',
			'E-mail' => 'E-mail',
			'Téma' => 'Subiect',
			'Üzenet' => 'Mesaj',
			'Válasszon témát' => 'Selectați serviciul dorit',
			'Tanácsadás' => 'Consiliere',
			'Egyéb kérdés' => 'Alte întrebări',
			'Írja meg kérdését vagy üzenetét...' => 'Scrieți întrebarea sau mesajul dumneavoastră...',
			'Üzenet küldése' => 'Trimite mesajul',
			'Küldés gomb' => 'Buton trimitere',
			'Részletek' => 'Detalii',
			'Tovább olvasom' => 'Citesc mai mult',
			'További információ' => 'Informații suplimentare',
			'Programok megtekintése' => 'Vezi programele',
			'Időpontfoglalás' => 'Programați o consultație!',
			'Regisztráció / Időpontfoglalás' => 'Programați o consultație!',
			'Kapcsolatfelvétel' => 'Contactați-ne',
			'Érdeklődöm' => 'Mă interesează',
			'Megtekintés' => 'Vizualizare',
			'Megjelenítés' => 'Afișare',
			'Gyors információk' => 'Informații rapide',
			'A programról' => 'Despre program',
			'A szolgáltatásról' => 'Despre serviciu',
			'Miért fontos?' => 'De ce este important?',
			'Kinek ajánlott?' => 'Cui se adresează?',
			'Kinek hasznos?' => 'Cui îi este util?',
			'Célcsoport' => 'Grup țintă',
			'Kiemelt üzenet' => 'Mesaj principal',
			'Szolgáltatások' => 'Servicii',
			'Tevékenységek' => 'Activități',
			'Fókusz' => 'Focus',
			'Cél' => 'Scop',
			'Típus' => 'Tip',
			'Helyszín' => 'Locație',
			'Bevonás' => 'Implicare',
			'Támogatás' => 'Sprijin',
			'Kategóriák' => 'Categorii',
			'Kategória' => 'Categorie',
			'Letöltések' => 'Resurse disponibile',
			'Letölthető anyagok' => 'Materiale descărcabile',
			'Letölthető dokumentum' => 'Document descărcabil',
			'Gyakori kérdések' => 'Întrebări frecvente',
			'Kérdés' => 'Întrebare',
			'Válasz szövege.' => 'Textul răspunsului.',
			'Nyitvatartás' => 'Programați o consultație!',
			'H–P: 8:00 – 16:00' => 'Programați o consultație!',
			'H-P: 8:00 - 16:00' => 'Programați o consultație!',
			'L-V: 8:00 – 16:00' => 'Programați o consultație!',
			'L-V: 8:00 - 16:00' => 'Programați o consultație!',
			'Zárva' => 'Închis',
			'Adatvédelem' => 'Protecția datelor',
			'Impresszum' => 'Impressum',
			'Jelen weboldal tartalma nem feltétlenül tükrözi az Európai Unió hivatalos álláspontját.' => 'Conținutul acestui site nu reflectă neapărat poziția oficială a Uniunii Europene.',
			'© 2025 Egészségfejlesztési Iroda - Szatmár megye' => '© 2025 Birou de Promovare și Protecție a Sănătății - județul Satu Mare',
			'© 2025 Egészségfejlesztési Iroda – Szatmár megye' => '© 2025 Birou de Promovare și Protecție a Sănătății – județul Satu Mare',
			'© 2026 Egészségfejlesztési Iroda - Szatmár megye' => '© 2026 Birou de Promovare și Protecție a Sănătății - județul Satu Mare',
			'IPOP ROHU00259 - Interreg VI-A Románia-Magyarország Program' => 'IPOP ROHU00259 - Programul Interreg VI-A România-Ungaria',
			'IPOP ROHU00259 – Interreg VI-A Románia-Magyarország Program' => 'IPOP ROHU00259 – Programul Interreg VI-A România-Ungaria',
			'Interreg VI-A Románia-Magyarország Program' => 'Programul Interreg VI-A România-Ungaria',
			'Szatmár megye' => 'județul Satu Mare',
			'Egészségfejlesztési Iroda' => 'Birou de Promovare și Protecție a Sănătății',
			'Partner logó' => 'Logo partener',
			'Fő navigáció' => 'Navigație principală',

			// Landing and project.
			"Szűrés. Prevenció. Egészséges életmód.\nEgyütt a hosszabb életért!" => "Screening. Prevenție. Stil de viață sănătos.\nÎmpreună pentru o viață mai lungă!",
			'Szűrővizsgálatok, tanácsadás és közösségi programok Szatmár megyében - a megelőzés és az egészségtudatos életmód szolgálatában.' => 'Investigații de screening, consiliere și programe comunitare în județul Satu Mare - în slujba prevenirii și a unui stil de viață sănătos.',
			'A „Népesedési folyamatok javítása helyi szinten egészségfejlesztési módszerekkel” elnevezésű IPOP ROHU00259-es számú projekt célja, hogy hozzájáruljon Szatmár megye lakosságának egészségi állapotának javításához, valamint a demográfiai kihívások kezeléséhez. A kezdeményezés a Szatmárnémeti Egészségfejlesztési Iroda létrehozása mellett a megelőzésre, az egészségtudatosság növelésére és a család- és közösségalapú ellátás erősítésére épül.' => 'Proiectul IPOP ROHU00259, intitulat „Îmbunătățirea proceselor demografice la nivel local prin metode de promovare a sănătății”, are ca scop contribuția la îmbunătățirea stării de sănătate a populației județului Satu Mare și la gestionarea provocărilor demografice. Pe lângă înființarea Biroului pentru Promovare și Protecție a Sănătății din Satu Mare, inițiativa se bazează pe prevenție, creșterea gradului de conștientizare privind sănătatea și consolidarea serviciilor orientate către familie și comunitate.',
			'A projektről' => 'Despre proiect',
			'Népesedési folyamatok javítása helyi szinten egészségfejlesztési módszerekkel' => 'Îmbunătățirea proceselor demografice la nivel local prin metode de promovare a sănătății',
			'A projekt célja, hogy Szatmár megye lakosságának egészségi állapotát, prevenciós lehetőségeit és az egészségügyi szolgáltatásokhoz való hozzáférését javítsa.' => 'Proiectul are ca scop îmbunătățirea stării de sănătate a populației județului Satu Mare, a posibilităților de prevenție și a accesului la servicii medicale.',
			'A Szatmárnémeti Egészségfejlesztési Iroda a prevenció, az esélyegyenlőség és a család- és közösségalapú ellátás erősítésére épül.' => 'Biroul pentru Promovare și Protecție a Sănătății din Satu Mare se bazează pe prevenție, egalitate de șanse și consolidarea îngrijirii bazate pe familie și comunitate.',
			'Egészségügyi hozzáférés' => 'Acces la servicii medicale',
			'Prevenció' => 'Prevenție',
			'Családalapú ellátás' => 'Îngrijire bazată pe familie',
			'Közösségi egészségfejlesztés' => 'Promovarea sănătății în comunitate',
			'Projektbemutató' => 'Prezentarea proiectului',
			'A projekt céljai' => 'Obiectivele proiectului',
			'Stratégiai üzenetek' => 'Mesajele strategice ale proiectului',
			'Esélyegyenlőség. Prevenció. Életerős közösségek.' => 'Egalitate de șanse. Prevenție. Comunități puternice.',
			'Egészség közelebb a közösségekhez' => 'Sănătatea mai aproape de comunități',
			'Mobil szűrések, tanácsadások, oktatási programok és közösségalapú egészségfejlesztés egy integrált projekt keretében.' => 'Screeninguri mobile, consiliere, programe educaționale și promovarea sănătății în comunitate în cadrul unui proiect integrat.',
			'egyedi célkitűzés' => 'obiectiv specific',
			'Interreg program' => 'program Interreg',
			'résztvevő mobil szűréseken' => 'participanți la screeninguri mobile',
			'vidéki háziorvos bevonása' => 'medici de familie din mediul rural implicați',
			'megyei intézmény az Iskolára készen kampányban' => 'instituții județene în campania „Pregătit pentru școală”',
			'nagycsoportos óvodás felmérése' => 'copii de grupă mare evaluați',
			'Szatmár megye demográfiai helyzetének javítása' => 'Îmbunătățirea situației demografice a județului Satu Mare',
			'Prevenció és egészségnevelés erősítése' => 'Consolidarea activităților de prevenție și educație pentru sănătate',
			'Családalapú ellátás támogatása' => 'Susținerea îngrijirii bazate pe familie',
			'Az egészségügyi szolgáltatásokhoz való hozzáférés javítása' => 'Îmbunătățirea accesului la servicii medicale',
			'A megelőzés fontossága és az egészséges életmód népszerűsítése' => 'Promovarea importanței prevenției și a unui stil de viață sănătos',
			'Tanácsadói tevékenységek ellátása' => 'Furnizarea de activități de consiliere și informare',
			'Mobil kardiovaszkuláris szűrés' => 'Screening cardiovascular mobil',
			'Helyben elérhető vizsgálatok a szív- és érrendszeri kockázatok korai felismerésére.' => 'Investigații disponibile local pentru depistarea timpurie a riscurilor cardiovasculare.',
			'Onkológiai szűrések' => 'Screeninguri oncologice',
			'Bőr-, prosztata-, mell- és vastagbél-szűrések a megelőzés támogatására.' => 'Screeninguri pentru cancer de piele, prostată, sân și colorectal pentru susținerea prevenției.',
			'Cikluskövetés-oktatás' => 'Educație privind monitorizarea ciclului menstrual',
			'Képzett szakemberek bevonása fiatal hölgyek termékenységtudatosságának fejlesztésére.' => 'Implicarea specialiștilor instruiți pentru dezvoltarea conștientizării fertilității în rândul tinerelor.',
			'Iskolára készen kampány' => 'Campania „Pregătit pentru școală!”',
			'Szenzo-motoros, kognitív és pszichológiai szűrések óvodás gyermekeknek.' => 'Evaluări senzorio-motorii, cognitive și psihologice pentru copiii preșcolari.',
			'A vidéki egészségügyi szolgáltatásokkal és szűrésekkel az esélyegyenlőség teremtődik meg.' => 'Prin serviciile medicale și screeningurile oferite în mediul rural se promovează egalitatea de șanse.',
			'A prevenció kulcsfontosságú a hosszú távú egészség megőrzésében.' => 'Prevenția este esențială pentru menținerea sănătății pe termen lung.',
			'Az egészségfejlesztés által az egészséges egyének és családok életerős közösségeket hozhatnak létre.' => 'Prin promovarea sănătății, persoanele și familiile sănătoase pot construi comunități puternice și reziliente.',

			// Program index cards.
			'Ismerje meg egészségfejlesztési programjainkat, amelyek a megelőzésre, a könnyebb hozzáférésre és a családok támogatására épülnek.' => 'Descoperiți programele noastre de promovare a sănătății, bazate pe prevenție, acces mai facil și sprijinirea familiilor.',
			'Ciklusoktatás' => 'Educație privind ciclul menstrual',
			'Nőknek szóló termékenységtudatosság' => 'Conștientizarea fertilității pentru femei',
			'Az egészséges életmódot, a betegségmegelőzést és a szűrővizsgálatok jelentőségét népszerűsítő tevékenységek' => 'Activități de promovare a stilului de viață sănătos, a prevenirii bolilor și a importanței screeningului.',
			'Helyben elérhető szakvizsgálatok a könnyebb hozzáférésért.' => 'Consultații medicale specializate disponibile local pentru un acces mai facil.',
			'Helyben elérhető onkológiai szűrések a könnyebb hozzáférésért.' => 'Screeninguri oncologice disponibile local pentru un acces mai facil.',
			'Személyre szabott támogatás az egészséges életvitel kialakításához.' => 'Sprijin personalizat pentru adoptarea unui stil de viață sănătos.',
			'Korai felismerés és támogatás a gyermekek fejlődésében.' => 'Depistare timpurie și sprijin pentru dezvoltarea copiilor.',
			'Óvodás iskolaérettséget vizsgáló szűrések' => 'Screening preșcolar',
			'Óvodás iskolaérettségi szűrések összefoglaló' => 'Rezumat screening preșcolar',
			'Mobil szakorvosi szolgálat' => 'Serviciu mobil de consultații medicale de specialitate',
			'Mobil szűrés' => 'Screening oncologic mobil',
			'Életmódtanácsadás' => 'Consiliere stil de viață',

			// Cycle education.
			'Főoldal / Programok / Ciklusoktatás' => 'Pagina principală / Activitățile noastre / Educație privind ciclul menstrual',
			'Témák megtekintése' => 'Vezi temele',
			'Tudatos női egészség' => 'Sănătate feminină conștientă',
			'Ismeret, cikluskövetés, felelős döntés' => 'Cunoaștere, monitorizarea ciclului, decizie responsabilă',
			'Termékenységtudatosság és egészségügyi nevelés fiatal lányoknak és nőknek.' => 'Conștientizarea fertilității și educație pentru sănătate pentru fete tinere și femei.',
			'osztály' => 'clase',
			'iroda' => 'birou',
			'tudás' => 'cunoaștere',
			'Program neve' => 'Numele programului',
			'Termékenységtudatosság' => 'Conștientizarea fertilității',
			'8–12. osztályos lányok és érdeklődő nők' => 'Fete din clasele VIII-XII și femei interesate',
			'Közoktatási intézmények és Egészségfejlesztési Iroda' => 'Instituții de învățământ și Biroul pentru Promovare și Protecție a Sănătății',
			'Cikluskövetés és egészségügyi nevelés' => 'Monitorizarea ciclului și educație pentru sănătate',
			'Tudásátadás és felelős döntéshozatal támogatása' => 'Transmiterea cunoștințelor și sprijinirea deciziilor responsabile',
			'Oktatási tartalom' => 'Conținut educațional',
			'Cikluskövetési módszerek és termékenységtudatosság' => 'Metode de monitorizare a ciclului menstrual și conștientizarea fertilității',
			'A foglalkozások célja, hogy érthető, biztonságos és életkornak megfelelő tudást adjanak a női ciklusról, a termékenységről és az egészségtudatos döntésekről.' => 'Scopul activităților este transmiterea unor informații clare, sigure și adecvate vârstei despre ciclul feminin, fertilitate și decizii sănătoase.',
			'Érintett fő témák' => 'Teme principale abordate',
			'Kiemelt célcsoport' => 'Grup țintă principal',
			'8–12. osztályos lányok' => 'Fete din clasele VIII-XII',
			'További jelentkezők' => 'Alți participanți',
			'Egészségfejlesztési Irodába érkező érdeklődők' => 'Persoane interesate care se adresează Biroului pentru Promovare și Protecție a Sănătății',
			'A tudás segít megérteni a test működését és támogatja a felelős döntéseket.' => 'Cunoașterea ajută la înțelegerea funcționării corpului și sprijină deciziile responsabile.',
			'A ciklusoktatás célja, hogy a lányok és nők ne információhiányból, hanem hiteles tudás birtokában tudjanak dönteni saját egészségükről és termékenységükről.' => 'Educația privind ciclul menstrual are ca scop ca fetele și femeile să poată lua decizii privind sănătatea și fertilitatea pe baza unor informații corecte.',
			'Az abortuszok száma Romániában is rendkívül magas. Az elhagyott újszülöttek aránya és az Európai Unió országai között vezető helyet foglalunk el a gyermekhalandóság területén.' => 'Numărul avorturilor în România rămâne ridicat. De asemenea, proporția nou-născuților abandonați este semnificativă, iar țara noastră se află printre statele Uniunii Europene cu cele mai ridicate rate ale mortalității infantile.',
			'Mindemellett nő a koraszülések száma, aggasztóan emelkedett a házaspárok sterilitás aránya, mely összefügg a késői gyerekvállalással is. 30 éves kor felett sokszorosára nő a veleszületett rendellenességek aránya.' => 'În același timp, crește numărul nașterilor premature, iar procentul cuplurilor afectate de infertilitate este în continuă creștere, fenomen asociat și cu amânarea momentului de a avea copii. După vârsta de 30 de ani, riscul anumitor anomalii congenitale crește considerabil.',
			'Ugyanakkor hiányos az egészségügyi nevelés, magas a nem kívánt terhességek aránya, valamint rendkívül magas a művi abortuszok száma. Mindez összefüggésben áll a nemi érés és a nemi élet fiziológiai ismereteinek hiányával.' => 'Totodată, educația pentru sănătate este insuficientă, proporția sarcinilor nedorite rămâne ridicată, iar numărul întreruperilor de sarcină este încă foarte mare. Toate aceste aspecte sunt legate de lipsa cunoștințelor privind dezvoltarea sexuală și funcționarea fiziologică a sistemului reproducător.',
			'Mindezen okok miatt fontos a megfelelő cikluskövetés-oktatás és tudásátadás a megye közoktatási intézményeiben, főként a 8–12. osztályos lányok körében, illetve az Egészségfejlesztési Irodába jelentkezőknél, ahol cikluskövetési módszereket sajátíthatnak el a termékenységtudatosság jegyében.' => 'Din aceste motive, este importantă promovarea educației privind monitorizarea ciclului menstrual și transmiterea unor informații corecte în instituțiile de învățământ din județ, în special în rândul fetelor din clasele VIII-XII, precum și pentru persoanele care se adresează Biroului pentru Promovare și Protecție a Sănătății.',
			'A női ciklus alapvető működésének megismerése' => 'Cunoașterea funcționării de bază a ciclului feminin',
			'Termékenységtudatosság és cikluskövetési módszerek' => 'Conștientizarea fertilității și metode de monitorizare a ciclului',
			'A nemi érés és a női egészség fiziológiai alapjai' => 'Bazele fiziologice ale maturizării sexuale și sănătății feminine',
			'A felelős döntésekhez szükséges egészségügyi ismeretek' => 'Cunoștințe de sănătate necesare deciziilor responsabile',
			'A prevenció és az egészségmegőrzés fontossága' => 'Importanța prevenției și menținerii sănătății',
			'8–12. osztályos lányoknak' => 'Fetelor din clasele VIII-XII',
			'Termékenységtudatosság iránt érdeklődő nőknek' => 'Femeilor interesate de conștientizarea fertilității',
			'Egészségfejlesztési Irodába jelentkezőknek' => 'Persoanelor care se adresează Biroului pentru Promovare și Protecție a Sănătății',

			// Health promotion office.
			'Főoldal / Programok / Egészségfejlesztési Iroda' => 'Pagina principală / Activitățile noastre / Birou de Promovare și Protecție a Sănătății',
			'Szolgáltatások megtekintése' => 'Vezi serviciile',
			'Prevenció és egészségnevelés' => 'Prevenție și educație pentru sănătate',
			'Egészségesebb életmód, tudatosabb döntések' => 'Stil de viață mai sănătos, decizii mai conștiente',
			'Tanácsadás, szűrés, prevenció és szakmai támogatás szervezett formában.' => 'Consiliere, screening, prevenție și sprijin profesional într-o formă organizată.',
			'támogatás' => 'sprijin',
			'prevenció' => 'prevenție',
			'Tanácsadás, prevenció és egészségfejlesztés egy helyen' => 'Consiliere, prevenție și promovarea sănătății într-un singur loc',
			'Az iroda célja, hogy szakemberek bevonásával, szervezett formában tegye elérhetővé az egészséges életmódot, a betegségmegelőzést és a szűrővizsgálatok fontosságát népszerűsítő szolgáltatásokat.' => 'Biroul are ca scop punerea la dispoziție, într-o formă organizată și cu implicarea specialiștilor, a serviciilor care promovează stilul de viață sănătos, prevenirea bolilor și importanța screeningului.',
			'Főbb szolgáltatási területek' => 'Principalele domenii de servicii',
			'Szolgáltatás' => 'Serviciu',
			'Hiánypótló iroda' => 'Birou care răspunde unei nevoi reale',
			'Egyedülálló egészségügyi tanácsadói forma a régióban' => 'Formă unică de consiliere în domeniul sănătății la nivelul regiunii',
			'Széles körű támogatás' => 'Sprijin complex',
			'Tanácsadástól a prevención át a rehabilitációig' => 'De la consiliere și prevenție până la recuperare',
			'Az egészségfejlesztés akkor hatékony, ha szervezett, elérhető és közösségközeli.' => 'Promovarea sănătății este eficientă atunci când este organizată, accesibilă și aproape de comunitate.',
			'Az Egészségfejlesztési Iroda célja, hogy a lakosság ne csak akkor találkozzon az egészségügyi ellátással, amikor már kialakult a probléma, hanem időben, a megelőzés és a tudatos életmód szintjén kapjon támogatást.' => 'Scopul Biroului pentru Promovare și Protecție a Sănătății este ca populația să primească sprijin la timp, la nivelul prevenției și al unui stil de viață conștient, nu doar atunci când problema de sănătate s-a instalat deja.',
			'Egészségügyi tanácsadói iroda' => 'Birou de consiliere în domeniul sănătății',
			'Egészséges életmód és prevenció' => 'Stil de viață sănătos și prevenție',
			'Fiatalok és felnőttek' => 'Tineri și adulți',
			'Tanácsadás, prevenció, szűrések, rehabilitáció' => 'Consiliere, prevenție, screeninguri, recuperare',
			'Az alapellátás szerepének megerősítése' => 'Consolidarea rolului asistenței medicale primare',
			'Egyedi egészségügyi és életmódtanácsadás' => 'Consiliere individuală în sănătate și stil de viață',
			'Prevenciós és egészségnevelési tevékenységek' => 'Activități de prevenție și educație pentru sănătate',
			'Szűrővizsgálatok jelentőségének népszerűsítése' => 'Promovarea importanței screeningului',
			'Rehabilitációt támogató szolgáltatások' => 'Servicii de sprijin pentru recuperare',
			'Terápiás munkát segítő szakmai tevékenységek' => 'Activități profesionale care sprijină intervențiile terapeutice',
			'Fiataloknak és felnőtteknek szóló népszerűsítő akciók' => 'Campanii de informare pentru tineri și adulți',
			'Egészségesebb életmódra törekvő lakosoknak' => 'Persoanelor care doresc un stil de viață mai sănătos',
			'Prevenció iránt érdeklődő fiataloknak és felnőtteknek' => 'Tinerilor și adulților interesați de prevenție',
			'Szűrővizsgálatok fontosságáról tájékozódni vágyóknak' => 'Persoanelor care doresc informații despre importanța screeningului',

			// Lifestyle counseling.
			'Főoldal / Programok / Életmódtanácsadás' => 'Pagina principală / Activitățile noastre / Consiliere stil de viață',
			'Tanácsadási területek' => 'Domenii de consiliere',
			'Személyre szabott támogatás' => 'Sprijin personalizat',
			'Egészségesebb mindennapok tudatos lépésekkel' => 'Zile mai sănătoase prin pași conștienți',
			'Pszicho-szociális, táplálkozási és prevenciós tanácsadás egyéni egészségtervvel.' => 'Consiliere psihosocială, nutrițională și preventivă cu plan individual de sănătate.',
			'tanácsadás' => 'consiliere',
			'Egyéni egészségterv és prevenciós támogatás' => 'Plan individual de sănătate și sprijin pentru prevenție',
			'A tanácsadás célja, hogy az egészséges életmódra vágyók szakemberek segítségével, személyre szabott támogatással alakíthassák ki mindennapi szokásaikat.' => 'Scopul consilierii este ca persoanele care doresc un stil de viață sănătos să își poată forma obiceiurile zilnice cu ajutorul specialiștilor și cu sprijin personalizat.',
			'Elérhető támogatási formák' => 'Forme de sprijin disponibile',
			'Időpont' => 'Programare',
			'Időpont-egyeztetés' => 'Stabilirea unei programări',
			'A tanácsadás előzetes egyeztetés alapján érhető el.' => 'Consilierea este disponibilă pe baza unei programări prealabile.',
			'Személyre szabott terv' => 'Plan personalizat',
			'Egyéni egészségterv és célzott prevenciós tanácsadás' => 'Plan individual de sănătate și consiliere preventivă țintită',
			'Az egészséges életmód kialakítása könnyebb, ha szakmai támogatás kíséri.' => 'Adoptarea unui stil de viață sănătos este mai ușoară atunci când este însoțită de sprijin profesional.',
			'Az életmódtanácsadás a felvilágosítás, az egészségnevelés és az egyéni támogatás eszközeivel segít abban, hogy a megelőzés és az egészségtudatos döntések a mindennapok részévé váljanak.' => 'Consilierea pentru stil de viață ajută, prin informare, educație pentru sănătate și sprijin individual, ca prevenția și deciziile conștiente privind sănătatea să devină parte din viața de zi cu zi.',
			'Egyéni és csoportos tanácsadás' => 'Consiliere individuală și de grup',
			'Előzetes egyeztetés alapján' => 'Pe baza unei programări prealabile',
			'Szakemberek' => 'Specialiști',
			'Pszichológus, táplálkozási szakértő és más szakemberek' => 'Psihologi, nutriționiști și alți specialiști',
			'Pszicho-szociális tanácsadás' => 'Consiliere psihosocială',
			'Táplálkozási tanácsadás' => 'Consiliere nutrițională',
			'Egyéni egészségterv készítése' => 'Elaborarea unui plan individual de sănătate',
			'Prevenciós támogatás' => 'Sprijin pentru prevenție',
			'Egészségfelmérési tevékenységek' => 'Activități de evaluare a stării de sănătate',
			'Csoportos és egyéni egészségnevelés' => 'Educație pentru sănătate individuală și de grup',
			'Egészségesebb életmódra vágyóknak' => 'Persoanelor care doresc un stil de viață mai sănătos',
			'Táplálkozási tanácsadás iránt érdeklődőknek' => 'Persoanelor interesate de consiliere nutrițională',
			'Prevenciós támogatást kereső fiataloknak és felnőtteknek' => 'Tinerilor și adulților care caută sprijin pentru prevenție',

			// Mobile specialist and screening.
			'Főoldal / Programok / Mobil szakorvosi szolgálat' => 'Pagina principală / Activitățile noastre / Serviciu mobil de consultații medicale de specialitate',
			'Főoldal / Programok / Mobil szűrés' => 'Pagina principală / Activitățile noastre / Screening oncologic mobil',
			'Mobil szűrés megtekintése' => 'Vezi screeningul mobil',
			'Vizsgálatok megtekintése' => 'Vezi consultațiile',
			'Szűrések megtekintése' => 'Vezi screeningurile',
			'Helyben elérhető ellátás' => 'Servicii disponibile local',
			'Helybe vitt ellátás' => 'Servicii aduse aproape de comunitate',
			'A szolgáltatás közelebb kerül a beteghez' => 'Serviciul ajunge mai aproape de pacient',
			'Szakorvosi vizsgálatok, vidéki közösségek, javuló hozzáférés.' => 'Consultații de specialitate, comunități rurale, acces îmbunătățit.',
			'Szakorvosi vizsgálatok, vidéki közösségek és erősebb alapellátási kapcsolatok.' => 'Consultații de specialitate, comunități rurale și legături mai puternice cu asistența medicală primară.',
			'háziorvos' => 'medic de familie',
			'szakvizsgálat' => 'consultație de specialitate',
			'vidék' => 'rural',
			'helyben' => 'local',
			'Kihelyezett szakorvosi ellátás' => 'Servicii medicale de specialitate oferite local',
			'Megvalósítás helye' => 'Locul implementării',
			'Szatmár megye vidéki települései' => 'Localități rurale din județul Satu Mare',
			'Bevont háziorvosok' => 'Medici de familie implicați',
			'10 háziorvos' => '10 medici de familie',
			'Vizsgálatok' => 'Consultații',
			'Kardiovaszkuláris és egyéb szakvizsgálatok' => 'Consultații cardiovasculare și alte investigații de specialitate',
			'Megvalósítás' => 'Implementare',
			'Vizsgálatok vidéki településeken' => 'Consultații în localități rurale',
			'A megye különböző vidéki településein 10 háziorvosnál, a szakvizsgálatoknak megfelelő szakorvosok bevonásával fognak kardiovaszkuláris és egyéb vizsgálatokat végezni.' => 'În colaborare cu 10 medici de familie din diferite localități rurale ale județului, specialiști din diverse domenii medicale vor efectua consultații cardiovasculare și alte investigații.',
			'Várható hatások' => 'Efecte așteptate',
			'Háziorvos' => 'Medic de familie',
			'10 háziorvos bevonása vidéki településeken' => 'Implicarea a 10 medici de familie din localități rurale',
			'Szakvizsgálatok' => 'Consultații de specialitate',
			'Nem a beteg utazik, hanem a szolgáltatás kerül közelebb hozzá.' => 'Nu pacientul este cel care călătorește, ci serviciul este adus mai aproape de el.',
			'A szolgáltatás célja, hogy a szakellátás ne csak a nagyobb városi központokban legyen könnyebben elérhető, hanem a vidéki lakosság számára is közelségbe kerüljön.' => 'Scopul serviciului este ca asistența medicală de specialitate să fie mai aproape și de populația rurală, nu doar de marile centre urbane.',
			'Korai felismerés' => 'Depistare timpurie',
			'A szűrés helybe megy, hogy a megelőzés minél több emberhez eljusson' => 'Screeningul ajunge local, pentru ca prevenția să ajungă la cât mai multe persoane',
			'Onkológiai szűrések vidéki helyszíneken, háziorvosok bevonásával.' => 'Screeninguri oncologice în localități rurale, cu implicarea medicilor de familie.',
			'szűrés' => 'screening',
			'terület' => 'domenii',
			'Korai onkológiai szűrések helyben' => 'Screeninguri oncologice timpurii, disponibile local',
			'Tervezett elérés' => 'Acoperire planificată',
			'Szűrések' => 'Screeninguri',
			'Prosztata, mell, méhnyak, melanóma, vastagbél' => 'Prostată, sân, col uterin, melanom, colorectal',
			'Szűrési területek' => 'Domenii de screening',
			'Milyen szűréseket biztosítunk?' => 'Ce screeninguri oferim?',
			'A program keretében 1000 személy szűrése tervezett, 10 háziorvosnál, a megye különböző vidéki településein.' => 'În cadrul proiectului este planificată examinarea a aproximativ 1.000 de persoane prin intermediul a 10 cabinete de medicină de familie din diferite localități rurale ale județului.',
			'Kiemelt szűrések' => 'Screeninguri principale',
			'Tervezett szűrés' => 'Screening planificat',
			'1000 személy szűrése vidéki településeken' => 'Screening pentru 1.000 de persoane din localități rurale',
			'10 háziorvos bevonása a programba' => 'Implicarea a 10 medici de familie în program',
			'A megelőzés ne távoli lehetőség legyen, hanem helyben elérhető támogatás.' => 'Prevenția nu trebuie să fie o posibilitate îndepărtată, ci un sprijin disponibil local.',
			'A mobil szűrés célja, hogy a megelőzés a vidéki közösségek számára is közelségbe kerüljön, és minél több ember eljusson a korai felismerést segítő vizsgálatokig.' => 'Scopul screeningului mobil este ca prevenția să fie aproape și de comunitățile rurale, iar cât mai multe persoane să ajungă la investigațiile care ajută la depistarea timpurie.',
			'Prosztatarák szűrés' => 'Screening pentru cancer de prostată',
			'Mellrák szűrés' => 'Screening pentru cancer de sân',
			'Méhnyakrák szűrés' => 'Screening pentru cancer de col uterin',
			'Melanóma szűrés' => 'Screening pentru melanom',
			'Vastagbélrák szűrés' => 'Screening pentru cancer colorectal',
			'Vidéki településeken élőknek' => 'Persoanelor din localități rurale',
			'Szűrésekhez nehezebben hozzáférő lakosoknak' => 'Persoanelor cu acces mai dificil la screeninguri',
			'Megelőzés iránt érdeklődőknek' => 'Persoanelor interesate de prevenție',
			'Nehezebben utazó lakosoknak' => 'Persoanelor care se deplasează mai greu',
			'Szakvizsgálatra váró pácienseknek' => 'Pacienților care așteaptă consultații de specialitate',

			// School readiness.
			'Főoldal / Programok / Óvodás iskolaérettséget vizsgáló szűrések' => 'Pagina principală / Activitățile noastre / Screening preșcolar',
			'Iskolára készen!' => 'Pregătit pentru școală!',
			'Korai felismerés a sikeres iskolakezdésért' => 'Depistare timpurie pentru un început școlar reușit',
			'óvoda' => 'grădinițe',
			'gyermek' => 'copii',
			'óvónő' => 'educatori',
			'Iskolaérettséget vizsgáló szűrés' => 'Screening pentru pregătirea școlară',
			'Nagycsoportos óvodás gyermekek' => 'Copii preșcolari din grupa mare',
			'30 vidéki óvoda' => '30 de grădinițe rurale',
			'Felmérés' => 'Evaluare',
			'800–1000 nagycsoportos óvodás' => '800-1000 de copii din grupele mari',
			'Legalább 60 óvónő és a szülők' => 'Cel puțin 60 de educatori și părinții',
			'Szűrési és tájékoztatási tevékenységek' => 'Activități de screening și informare',
			'Iskola előtti felmérés szakemberek, óvónők és szülők bevonásával' => 'Evaluare preșcolară cu implicarea specialiștilor, educatorilor și părinților',
			'Az Iskolára készen! program célja 30 vidéki óvodába eljutni a megyében található 188-ból, azokba az intézményekbe, ahol legalább 20 nagycsoportos gyermek van.' => 'Programul „Pregătit pentru școală!” își propune să ajungă în 30 de grădinițe dintre cele 188 existente în județ, cu prioritate în mediul rural și în instituțiile care au cel puțin 20 de copii în grupa mare.',
			'A tevékenységek a Szatmár Megyei Tanfelügyelőséggel szoros együttműködésben valósulnak meg, óvónőknek szóló workshopok, óvodás gyermekek iskola előtti szűrései és szülői tájékoztatók formájában.' => 'Activitățile vor fi implementate în strânsă colaborare cu Inspectoratul Școlar Județean Satu Mare și vor include workshopuri pentru educatori, evaluări preșcolare pentru copii și sesiuni de informare pentru părinți.',
			'A program fő tevékenységei' => 'Principalele activități ale programului',
			'A pilot projektben azonosított gyakori rizikó tünetek' => 'Semne de risc frecvente identificate în proiectul-pilot',
			'Rizikó tünet' => 'Semn de risc',
			'Óvoda' => 'Grădiniță',
			'30 vidéki intézmény elérése' => 'Atingerea a 30 de instituții rurale',
			'800–1000 nagycsoportos felmérése' => 'Evaluarea a 800-1000 de copii din grupa mare',
			'Óvónő' => 'Educator',
			'Legalább 60 óvónő bevonása' => 'Implicarea a cel puțin 60 de educatori',
			'Az időben felismert nehézségek célzott fejlesztéssel behozhatóak.' => 'Dificultățile identificate la timp pot fi recuperate prin dezvoltare țintită.',
			'A korai szűrés nemcsak a gyermek aktuális fejlődési állapotáról ad képet, hanem lehetőséget teremt arra is, hogy a család, az óvoda és a szakemberek együtt támogassák a sikeres iskolakezdést.' => 'Screeningul timpuriu oferă nu doar o imagine asupra dezvoltării copilului, ci și posibilitatea ca familia, grădinița și specialiștii să sprijine împreună un început școlar reușit.',
			'Szenzo-motoros szűrések' => 'Evaluări senzorio-motorii',
			'Kognitív képességek felmérése' => 'Evaluarea abilităților cognitive',
			'Pszichológiai szűrések' => 'Evaluări psihologice',
			'Óvónői megfigyelések bevonása' => 'Implicarea observațiilor educatorilor',
			'Szülői tájékoztatók' => 'Informări pentru părinți',
			'Óvónőknek szóló workshopok' => 'Workshopuri pentru educatori',
			'Figyelem gyengesége' => 'Dificultăți de atenție și concentrare',
			'Grafomotoros éretlenség' => 'Imaturitate grafomotorie',
			'Téri tájékozódás éretlensége' => 'Dificultăți de orientare spațială',
			'Lateralitás és dominancia problémák' => 'Probleme de lateralitate și dominanță',
			'Integrálatlan csecsemőkori reflexek' => 'Reflexe primitive insuficient integrate',
			'Nagycsoportos óvodás gyermekeknek' => 'Copiilor preșcolari din grupa mare',
			'Iskolakezdés előtt álló családoknak' => 'Familiilor aflate înaintea începerii școlii',
			'Óvónőknek és óvodai közösségeknek' => 'Educatorilor și comunităților preșcolare',

			// Knowledge, gallery, partners and contact.
			'Hasznos információk az egészségesebb mindennapokért' => 'Informații utile pentru sănătatea dumneavoastră',
			'Cikkek, letölthető anyagok és gyakori kérdések a prevenció, az egészséges életmód és a közösségi egészségfejlesztés témáiban.' => 'În această secțiune veți găsi articole, materiale informative și resurse educaționale dedicate promovării sănătății și prevenirii bolilor.',
			'Kiemelt téma' => 'Temă principală',
			'Prevenció fontossága' => 'Importanța prevenției',
			'A megelőzés segít időben felismerni a kockázatokat, támogatja az egészségtudatos döntéseket és hozzájárulhat a hosszabb, aktívabb élethez.' => 'Prevenția ajută la identificarea timpurie a riscurilor, sprijină deciziile conștiente privind sănătatea și poate contribui la o viață mai lungă și mai activă.',
			'Friss tudnivalók' => 'Informații noi',
			'Ide érkeznek majd a szakmai és ismeretterjesztő tartalmak.' => 'Aici vor fi publicate materiale profesionale și informative.',
			'Tájékoztatók, útmutatók és programismertetők egy helyen.' => 'Informații, ghiduri și prezentări ale programelor într-un singur loc.',
			'Demográfiai kihívások' => 'Provocări demografice',
			'Egészséges életmód útmutató' => 'Ghid pentru un stil de viață sănătos',
			'Rövid áttekintés közösségi szinten.' => 'Scurtă prezentare la nivel comunitar.',
			'Gyakorlati tanácsok a mindennapokra.' => 'Sfaturi practice pentru viața de zi cu zi.',
			'A korai felismerés és a rendszeres szűrés szerepe az egészségmegőrzésben.' => 'Rolul depistării timpurii și al screeningului regulat în menținerea sănătății.',
			'Miért fontos a családok, fiatalok és közösségek egészségének támogatása?' => 'De ce este important sprijinul pentru sănătatea familiilor, tinerilor și comunităților?',
			'Életmód' => 'Stil de viață',
			'Egyszerű, követhető szokások a mindennapi egészség támogatásához.' => 'Obiceiuri simple și ușor de urmat pentru susținerea sănătății zilnice.',
			'Prevenciós tájékoztató' => 'Material informativ despre prevenție',
			'Szűrővizsgálati kisokos' => 'Ghid pentru screening',
			'Kik vehetnek részt a programokon?' => 'Cine poate participa la programe?',
			'A programok célcsoportja témánként eltérő, de több szolgáltatás fiataloknak, felnőtteknek és családoknak is szól.' => 'Grupul țintă diferă în funcție de temă, dar mai multe servicii se adresează tinerilor, adulților și familiilor.',
			'Ingyenesek a szűrések és tanácsadások?' => 'Screeningurile și consilierile sunt gratuite?',
			'A projekt keretében megvalósuló szolgáltatások részvételi feltételeiről az adott program oldalán található információ.' => 'Informațiile privind condițiile de participare la serviciile realizate în cadrul proiectului se găsesc pe pagina programului respectiv.',
			'Hogyan lehet jelentkezni?' => 'Cum se poate face înscrierea?',
			'Jelentkezéshez vagy további információért a kapcsolati oldalon megadott elérhetőségeken lehet érdeklődni.' => 'Pentru înscriere sau informații suplimentare, ne puteți contacta folosind datele de pe pagina de contact.',
			'Demográfia' => 'Demografie',
			'Egészséges életmód' => 'Stil de viață sănătos',
			'Család és közösség' => 'Familie și comunitate',
			'Hasznos anyagot keres?' => 'Căutați materiale utile?',
			'Keressen minket, segítünk megtalálni a megfelelő tájékoztatót vagy programot.' => 'Contactați-ne și vă ajutăm să găsiți materialul informativ sau programul potrivit.',
			'Galéria' => 'Galerie',
			'Fotók és videók egészségügyi eseményeinkről, szűréseinkről és közösségi aktivitásainkról.' => 'Descoperiți imagini și materiale video din cadrul activităților noastre.',
			'Események képekben' => 'Evenimente în imagini',
			'fotók · videók · beszámolók' => 'fotografii · videoclipuri · relatări',
			'Összes' => 'Toate',
			'Fotók' => 'Fotografii',
			'Videók' => 'Videoclipuri',
			'Videó' => 'Video',
			'Fotó' => 'Foto',
			'Fotóalbum' => 'Album foto',
			'Kiemelt album' => 'Album recomandat',
			'Legutóbbi feltöltések' => 'Cele mai recente încărcări',
			'Képek és videók' => 'Imagini și videoclipuri',
			'Válogatás legfontosabb programjaink pillanataiból.' => 'O selecție de momente din cele mai importante programe ale noastre.',
			'Album' => 'Album',
			'Helyszíni programok és szakmai aktivitások.' => 'Programe locale și activități profesionale.',
			'Videós beszámolók' => 'Relatări video',
			'Rövid összefoglalók eseményeinkről.' => 'Scurte rezumate ale evenimentelor noastre.',
			'Közösségi egészségnap' => 'Zi comunitară a sănătății',
			'Egészségfejlesztési programok és lakossági aktivitások.' => 'Programe de promovare a sănătății și activități comunitare.',
			'Pillanatképek helyszíni szűrőprogramjainkról.' => 'Instantanee din programele noastre de screening la fața locului.',
			'Tanácsadási programok' => 'Programe de consiliere',
			'Rövid videós betekintés a szakmai munkába.' => 'Scurtă perspectivă video asupra activității profesionale.',
			'Óvodai programok' => 'Programe preșcolare',
			'Korai fejlesztést támogató közösségi alkalmak.' => 'Activități comunitare care sprijină dezvoltarea timpurie.',
			'Workshopok' => 'Workshopuri',
			'Szakmai találkozók és tájékoztató alkalmak.' => 'Întâlniri profesionale și sesiuni de informare.',
			'Közösségi aktivitások' => 'Activități comunitare',
			'Programok, találkozók és helyi kezdeményezések.' => 'Programe, întâlniri și inițiative locale.',
			'Van megosztható fotója?' => 'Aveți fotografii de împărtășit?',
			'Programjainkhoz kapcsolódó képeket vagy videókat a kapcsolat oldalon keresztül is elküldhet.' => 'Puteți trimite fotografii sau videoclipuri legate de programele noastre prin pagina de contact.',
			'kép' => 'imagini',
			'A projekt a vezető partner és a projektpartnerek együttműködésével valósul meg.' => 'Succesul proiectului se bazează pe o colaborare profesională solidă și pe implicarea activă a partenerilor instituționali și comunitari.',
			'Partner intézmények' => 'Instituții partenere',
			'Projektpartner' => 'Partener de proiect',
			'Vezető partner' => 'Partener lider',
			'A partnerség célja, hogy a projekt egészségfejlesztési, szűrési és szakmai tevékenységei szervezett együttműködésben valósuljanak meg.' => 'Mulțumim tuturor organizațiilor și instituțiilor care contribuie la implementarea și dezvoltarea programelor noastre.',
			'Partnerek oldal' => 'Pagina partenerilor',
			'Hódmezővásárhelyi-Makói Egészségellátó Központ' => 'Centrul de Asistență Medicală Hódmezővásárhely-Makó',
			'Páli Szent Vincéről Nevezett Szatmári Irgalmas Nővérek Egyesülete' => 'Asociația Surorilor de Caritate Satu Mare „Sfântul Vincențiu de Paul”',
			'Boldog Scheffler János Központ' => 'Centrul Fericitul Scheffler János',
			'Lépjen kapcsolatba velünk' => 'Luați legătura cu noi!',
			'Kérdése van programjainkkal, szűréseinkkel vagy tanácsadási lehetőségeinkkel kapcsolatban? Keressen minket bizalommal, munkatársaink készséggel állnak rendelkezésére.' => 'Aveți întrebări despre programele, screeningurile sau serviciile noastre de consiliere? Contactați-ne cu încredere! Echipa noastră vă stă la dispoziție cu informații și sprijin.',
			'Egészsége nem várhat.' => 'Sănătatea dumneavoastră nu poate aștepta!',
			'Foglaljon időpontot, érdeklődjön programjainkról, vagy kérjen további tájékoztatást.' => 'Programați o consultație!',
			'Telefonhívás indítása' => 'Sună acum',
			'Gyors elérhetőség' => 'Contact rapid',
			'Elérhetőségek' => 'Date de contact',
			'Írjon nekünk' => 'Scrieți-ne',
			'Kapcsolatfelvételi űrlap' => 'Formular de contact',
			'Töltse ki az alábbi mezőket, és hamarosan felvesszük Önnel a kapcsolatot.' => 'Completați câmpurile de mai jos și vă vom contacta în cel mai scurt timp.',
			'Ügyfélfogadás' => 'Programați o consultație!',
			'Egyeztessen időpontot!' => 'Programați o consultație!',
			'A programokon és tanácsadásokon való részvételhez kérjük, egyeztessen időpontot telefonon vagy e-mailben.' => 'Programați o consultație!',
			'Megközelítés' => 'Acces',
			'Hol talál minket?' => 'Unde ne găsiți?',
			'Megnyitás térképen' => 'Deschide pe hartă',
			'Útvonaltervezés' => 'Planificare traseu',
			'Térkép helye' => 'Locația pe hartă',

			// Longer document-based program copy.
			'A „Népesedési folyamatok javítása helyi szinten egészségfejlesztési módszerekkel” elnevezésű IPOP ROHU00259-es számú, 2025.05.28. - 2027.11.27. időszakban futó projekt a Páli Szent Vincéről Nevezett Szatmári Irgalmas Nővérek Egyesületének a Hódmezővásárhelyi-Makói Egészségügyi Ellátó Központtal partnerségben az Interreg VI-A Románia-Magyarország Program támogatásával, a „4.5 - Az egészségügyi ellátáshoz való egyenlő hozzáférés biztosítása, az egészségügyi rendszerek ellenálló képességének erősítése - beleértve az alapellátást is -, valamint az intézményi ellátásról a családi és közösségi alapú gondozásra való áttérés előmozdítása” egyedi célkitűzés keretén belül valósul meg.' => 'Proiectul IPOP ROHU00259, intitulat „Îmbunătățirea proceselor demografice la nivel local prin metode de promovare a sănătății”, se desfășoară în perioada 28.05.2025 - 27.11.2027 și este implementat de Asociația Surorilor de Caritate Satu Mare „Sfântul Vincențiu de Paul”, în parteneriat cu Centrul de Asistență Medicală Hódmezővásárhely-Makó, cu sprijinul Programului Interreg VI-A România-Ungaria, în cadrul obiectivului specific 4.5.',
			'A projekt keretén belül kialakított és működés alatt álló Szatmárnémeti Egészségfejlesztési Iroda egy olyan egészségvédelmi és felvilágosító iroda, melynek küldetése a demográfiai helyzet javítása egészségfejlesztési módszerekkel, esélyegyenlőség biztosításával és a család- és közösségalapú ellátás erősítésével, a prevenció, valamint a megye egészségügyi állapotának javítása.' => 'Biroul pentru Promovare și Protecție a Sănătății din Satu Mare, creat în cadrul proiectului, este un centru de informare și protecție a sănătății, a cărui misiune este îmbunătățirea situației demografice prin metode de promovare a sănătății, asigurarea egalității de șanse, consolidarea îngrijirii bazate pe familie și comunitate, precum și promovarea prevenției și îmbunătățirea stării de sănătate a populației județului.',
			'Ennek megfelelően Szatmár megyében legalább 1000 fő részére egy mozgó kardiovaszkuláris és onkológiai - bőr, prosztata, mell, vastagbél - szűrés valósul meg, legalább 10 vidéki háziorvos bevonásával, biztosítva a szükséges szakorvosi vizsgálatok időszakos kihelyezését az érintett rendelőkbe, illetve modern orvosi felszereléseket.' => 'În cadrul proiectului, cel puțin 1.000 de persoane din județul Satu Mare vor beneficia de screening cardiovascular și oncologic mobil - cancer de piele, prostată, sân și colorectal -, cu implicarea a minimum 10 medici de familie din mediul rural. Vor fi asigurate consultații periodice de specialitate în cabinetele participante și dotări medicale moderne.',
			'A vezető partner irányításával olyan személyeket szándékoznak kiképezni, akik cikluskövetés-oktatást és meddőségi tanácsadást tudnak majd nyújtani fiatal hölgyeknek. A tanult módszerrel a megye legalább 6 gimnáziumába szeretnének eljutni a projekt időtartama alatt.' => 'Sub coordonarea partenerului lider vor fi instruite persoane care vor putea oferi educație privind monitorizarea ciclului menstrual și consiliere în domeniul fertilității pentru tinere. Prin această metodă, proiectul își propune să ajungă în cel puțin 6 licee și gimnazii din județ pe durata implementării.',
			'Szintén a pályázat segítségével a Boldog Scheffler János Központ „Iskolára készen” kampányával Szatmár megye vidéki településein óvodás gyermekek iskola előtti szenzo-motoros, kognitív és pszichológiai szűrését fogják elvégezni.' => 'Tot prin intermediul proiectului, Centrul Fericitul Scheffler János va implementa campania „Pregătit pentru școală!”, în cadrul căreia vor fi realizate evaluări senzorio-motorii, cognitive și psihologice pentru copiii de grădiniță din mediul rural.',
			'A kitűzött cél legalább 30 megyei intézményben, melyben 500-600 nagycsoportos óvodás felmérése zajlik majd a szakemberek által, az óvónők segítségével.' => 'Obiectivul este evaluarea a 500-600 de copii din grupa mare în cel puțin 30 de instituții de învățământ, cu sprijinul educatorilor și al specialiștilor.',
			'A cikluskövetés-oktatás célja a megfelelő egészségügyi ismeretek átadása, különösen a 8-12. osztályos lányok körében, illetve az Egészségfejlesztési Irodába jelentkezőknél. A program a termékenységtudatosságot, a felelős döntéseket és az egészségnevelést támogatja.' => 'Educația privind monitorizarea ciclului menstrual are ca scop transmiterea unor informații corecte de sănătate, în special în rândul fetelor din clasele VIII-XII și al persoanelor care se adresează Biroului pentru Promovare și Protecție a Sănătății. Programul sprijină conștientizarea fertilității, deciziile responsabile și educația pentru sănătate.',
			'A megyében hiánypótló egészségügyi tanácsadói iroda az alapellátás szerepének megerősítését, a betegségmegelőzést, a szűréseken való részvétel fontosságát és az egészséges életforma népszerűsítését szolgálja.' => 'Biroul de Promovare și Protecție a Sănătății reprezintă un serviciu de consiliere în domeniul sănătății unic la nivelul județului și răspunde unei nevoi reale a comunității. Unul dintre obiectivele sale principale este consolidarea rolului asistenței medicale primare și sprijinirea populației prin activități de informare, educație și prevenție.',
			'A mozgó szakorvosi szolgálat célja, hogy a szakellátást közelebb vigye a vidéki közösségekhez. A megye különböző településein 10 háziorvosnál, szakorvosok bevonásával valósulnak meg kardiovaszkuláris és egyéb vizsgálatok.' => 'Scopul serviciului mobil de consultații medicale de specialitate este apropierea serviciilor medicale de comunitățile rurale. În diferite localități ale județului, în colaborare cu 10 medici de familie și specialiști, vor fi realizate consultații cardiovasculare și alte investigații.',
			'A mozgó szűrőakció célja a korai felismerés fontosságának tudatosítása. A projekt 1000 személy szűrését tervezi 10 háziorvos bevonásával, többek között prosztata-, mell-, méhnyak-, bőr- és vastagbélrák szűrések biztosításával.' => 'Scopul programului de screening mobil este creșterea gradului de conștientizare privind importanța depistării precoce. În cadrul proiectului este planificată examinarea a 1.000 de persoane cu implicarea a 10 medici de familie, prin screeninguri pentru cancer de prostată, sân, col uterin, piele și colorectal.',
			'Az Egészségfejlesztési Iroda felvilágosító munkával, egészségneveléssel, csoportos és egyéni tanácsadással, egyéni egészségtervvel és prevenciós támogatással segíti az egészségesebb életmód kialakítását.' => 'Biroul pentru Promovare și Protecție a Sănătății sprijină adoptarea unui stil de viață mai sănătos prin informare, educație pentru sănătate, consiliere individuală și de grup, plan individual de sănătate și sprijin pentru prevenție.',
			'Az Iskolára készen! program óvodás gyermekek iskola előtti szenzo-motoros, kognitív és pszichológiai szűrését támogatja. A cél a rizikótünetek időben történő felismerése, a sikeres iskolai beválás támogatása és a gyermekek fejlődési lemaradásainak csökkentése.' => 'Programul „Pregătit pentru școală!” sprijină evaluările senzorio-motorii, cognitive și psihologice ale copiilor preșcolari înainte de școală. Scopul este identificarea timpurie a semnelor de risc, susținerea adaptării școlare și reducerea întârzierilor în dezvoltarea copiilor.',
			'Vegye fel velünk a kapcsolatot bizalommal!' => 'Contactați-ne cu încredere!',
			'Egészségfejlesztési Iroda összefoglaló' => 'Rezumat Birou de Promovare și Protecție a Sănătății',
			'A megyében egyedülálló, hiánypótló egészségügyi tanácsadói iroda az alapellátás szerepének megerősítését tűzi ki egyik fő céljául.' => 'Biroul de consiliere în domeniul sănătății, unic la nivelul județului, are ca unul dintre obiectivele principale consolidarea rolului asistenței medicale primare.',
			'Az egészséges életmódot, a betegségmegelőzést és a szűrővizsgálatok jelentőségét népszerűsítő tevékenység ilyen szervezett formában való működtetése ismeretlen régiónkban.' => 'Funcționarea într-o formă organizată a unor activități dedicate promovării stilului de viață sănătos, prevenirii bolilor și conștientizării importanței screeningului este o inițiativă inovatoare pentru regiunea noastră.',
			'Az iroda szakemberek bevonásával az egyedi tanácsadástól, a prevención és szűréseken keresztül, a rehabilitációs és terápiás munkáig nyújt szolgáltatásokat.' => 'Cu implicarea specialiștilor, biroul oferă servicii variate, de la consiliere individuală și activități preventive până la sprijin în recuperare și intervenții terapeutice.',
			'Ugyanakkor fiatalok és felnőttek számára szervez népszerűsítő akciókat az egészséges életforma, a betegségeket megelőző életmód és a szűrővizsgálatokon való részvétel fontosságának erősítésére.' => 'Totodată, biroul organizează campanii și acțiuni de informare pentru tineri și adulți, cu scopul de a încuraja un stil de viață sănătos, prevenirea îmbolnăvirilor și participarea la programele de screening.',
			'Erősíti az alapellátás szerepét a lakosság egészségvédelmében.' => 'Consolidează rolul asistenței medicale primare în protejarea sănătății populației.',
			'Szervezett formában népszerűsíti az egészséges életmódot.' => 'Promovează într-o formă organizată stilul de viață sănătos.',
			'Felhívja a figyelmet a betegségmegelőzés jelentőségére.' => 'Atrage atenția asupra importanței prevenirii bolilor.',
			'Támogatja a szűrővizsgálatokon való részvétel fontosságának tudatosítását.' => 'Sprijină conștientizarea importanței participării la screeninguri.',
			'Szakemberek bevonásával nyújt egyedi tanácsadást és támogatást.' => 'Oferă consiliere și sprijin individual cu implicarea specialiștilor.',
			'Fiatalok és felnőttek számára is elérhető programokat és akciókat szervez.' => 'Organizează programe și acțiuni accesibile atât tinerilor, cât și adulților.',
			'Egyéni egészségterv és prevenciós tanácsadás' => 'Plan individual de sănătate și consiliere preventivă',
			'Az Egészségfejlesztő Iroda keretén belül működő felvilágosító munka, kapcsolattartás és egészségnevelés célja egy tudatosabb, a megelőzést és az egészséges életmódot népszerűsítő tevékenység és szemléletmód meghonosítása.' => 'Activitățile de informare, comunicare și educație pentru sănătate desfășurate în cadrul Biroului de Promovare și Protecție a Sănătății au ca obiectiv dezvoltarea unei mentalități orientate spre prevenție și promovarea unui stil de viață sănătos.',
			'A központ figyelemfelkeltő rendezvényeinek, tájékoztató anyagainak, egészségfelmérési tevékenységeinek, valamint csoportos és egyéni tanácsadásának köszönhetően középtávon javulhatnak a lakosság morbiditási és mortalitási adatai.' => 'Prin evenimentele de informare și conștientizare, materialele educative, evaluările stării de sănătate și serviciile de consiliere individuală și de grup, se urmărește îmbunătățirea pe termen mediu a indicatorilor de sănătate ai populației.',
			'Az egészségnevelési és tanácsadói iroda működtetése nagyban hozzájárulhat az egészséges életmód, a prevenció, a korai felismerés és a hatékony terápia megvalósításához.' => 'Funcționarea unui centru dedicat educației pentru sănătate și consilierii contribuie semnificativ la promovarea unui stil de viață sănătos, la prevenirea bolilor, la depistarea precoce și la susținerea intervențiilor terapeutice eficiente.',
			'Előzetes időpont-egyeztetés alapján különböző szakemberek, pszichológus, táplálkozási szakértő és más segítő szakemberek pszicho-szociális és táplálkozási tanácsadással, egyéni egészségtervvel, valamint prevenciós támogatással várják az egészséges életmódra vágyókat.' => 'Pe baza unei programări prealabile, diferiți specialiști - psihologi, nutriționiști și alți experți - oferă consiliere psihosocială și nutrițională, planuri individuale de sănătate și sprijin pentru prevenție persoanelor care doresc un stil de viață sănătos.',
			'Támogatja az egészséges életmód kialakítását és fenntartását.' => 'Sprijină adoptarea și menținerea unui stil de viață sănătos.',
			'Erősíti a megelőzésre épülő szemléletmódot.' => 'Consolidează o abordare bazată pe prevenție.',
			'Segíti a lakosság egészségtudatos döntéseit.' => 'Sprijină deciziile conștiente privind sănătatea ale populației.',
			'Hozzájárulhat a korai felismerés és a hatékony terápia megvalósításához.' => 'Poate contribui la depistarea timpurie și la intervenții terapeutice eficiente.',
			'Egyéni és csoportos tanácsadással is támogatja az érdeklődőket.' => 'Sprijină persoanele interesate prin consiliere individuală și de grup.',
			'Középtávon javíthatja a lakosság egészségi mutatóit.' => 'Poate îmbunătăți pe termen mediu indicatorii de sănătate ai populației.',
			'Napi 4 órában különböző szakemberek, pszichológus, táplálkozási szakértő és más segítő szakemberek pszicho-szociális és táplálkozási tanácsadással, egyéni egészségtervvel, valamint prevenciós támogatással várják az egészséges életmódra vágyókat.' => 'Specialiști precum psihologi, nutriționiști și alți experți oferă consiliere psihosocială și nutrițională, planuri individuale de sănătate și sprijin pentru prevenție persoanelor care doresc un stil de viață sănătos.',
			'Az Európai Unió társfinanszírozásával' => 'Cofinanțat de Uniunea Europeană',
			'A tipikusan fejlődő óvodás korú gyermekek szűrését korai prevenciós tevékenységnek tekintjük a sikeres iskolai beválás szempontjából.' => 'Evaluarea copiilor preșcolari cu dezvoltare tipică este considerată o activitate importantă de prevenție timpurie, care contribuie la integrarea și adaptarea cu succes la mediul școlar.',
			'Az óvodai nagycsoportban felfedezett rizikó tünetek lehetőséget adnak arra, hogy a gyermek megfelelő fejlesztést kapjon célirányosan a gyengébben működő területeken, és az iskolakezdésre behozza a lemaradását.' => 'Identificarea timpurie a factorilor de risc și a eventualelor dificultăți în grupa mare de grădiniță oferă posibilitatea intervenției și dezvoltării țintite a ariilor mai puțin consolidate, astfel încât copilul să poată recupera eventualele întârzieri înainte de începerea școlii.',
			'A Boldog Scheffler János Központ indulását követően, 2012-ben egy pilot projektben vett részt, ahol a helyi óvodákban szűrte a tipikusan fejlődő óvodásokat. A három évig tartó projekt eredményei kétségbe ejtőek voltak, hiszen a gyermekek több mint felénél találtak a szűrővizsgálatok alatt idegrendszeri éretlenséget.' => 'După înființarea Centrului Fericitul Scheffler János, în anul 2012, instituția a participat la un proiect-pilot de screening desfășurat în grădinițele locale. Rezultatele proiectului, derulat pe parcursul a trei ani, au evidențiat faptul că la mai mult de jumătate dintre copiii evaluați au fost identificate diferite semne de imaturitate neurologică.',
			'Az idegrendszeri éretlenség tünetei különböző rizikó tünetek formájában mutatkoztak meg, mint a figyelem gyengesége, grafomotoros éretlenség, a téri tájékozódás éretlensége, lateralitás és dominancia problémák, valamint integrálatlan csecsemőkori reflexek.' => 'Acestea s-au manifestat prin simptome precum dificultăți de atenție și concentrare, imaturitate grafomotorie, dificultăți de orientare spațială, probleme de lateralitate și dominanță, precum și reflexe primitive insuficient integrate.',
			'A fejlesztések a gyerekek nagy százalékánál, akik elkezdték a preventív célú fejlesztéseket, 6–10 hónapon belül javulást eredményeztek. Ez alátámasztja a korai szűrés és felismerés fontosságát, hiszen az időben felismert rizikó tünetek optimális időn belül fejleszthetőek célzott beavatkozásokat követően.' => 'Experiența acumulată a demonstrat că, în cazul copiilor care au beneficiat de intervenții preventive și programe de dezvoltare adecvate, aceste dificultăți s-au ameliorat semnificativ într-o perioadă de aproximativ 6-10 luni. Acest fapt subliniază importanța screeningului și a intervenției timpurii.',
			'A projekt legfontosabb üzenete a pedagógusoknak és a szülőknek is az, hogy ha időben sikerül beazonosítani a gyermek nehézségeit, akkor nemcsak sikerélményt biztosíthatunk számára, hanem támogathatjuk a sikeres iskolai beválást, és mentesíthetjük őt a későbbi iskolai kudarcoktól.' => 'Mesajul principal al proiectului este că identificarea timpurie a dificultăților care pot influența ulterior performanța școlară oferă copiilor șanse mai mari de succes, contribuie la dezvoltarea încrederii în sine și reduce riscul eșecului școlar.',
			'Segíti a gyermekek iskolaérettségének korai felmérését.' => 'Sprijină evaluarea timpurie a pregătirii școlare a copiilor.',
			'Lehetőséget ad a rizikó tünetek időben történő felismerésére.' => 'Oferă posibilitatea identificării la timp a semnelor de risc.',
			'Támogatja a célirányos, preventív fejlesztések elindítását.' => 'Sprijină inițierea unor intervenții preventive și țintite.',
			'Hozzájárulhat a sikeres iskolai beváláshoz.' => 'Poate contribui la adaptarea școlară reușită.',
			'Csökkentheti a későbbi iskolai kudarcok kockázatát.' => 'Poate reduce riscul eșecului școlar ulterior.',
			'Erősíti a szakemberek, óvónők és szülők együttműködését.' => 'Consolidează colaborarea dintre specialiști, educatori și părinți.',
			'Nőknek szóló termékenységtudatosság.' => 'Conștientizarea fertilității pentru femei.',
			'Vegyen részt szűréseinken, workshopjainkon és közösségi programjainkon!' => 'Participați la screeningurile, workshopurile și programele noastre comunitare!',
			'A projekt bemutatása, partnerek és közösségi célok.' => 'Prezentarea proiectului, partenerii și obiectivele comunitare.',
			'Kihelyezett kardiovaszkuláris és onkológiai szűrések.' => 'Screeninguri cardiovasculare și oncologice organizate local.',
			'Egészségnevelés, szülői tájékoztatók és szakmai alkalmak.' => 'Educație pentru sănătate, informări pentru părinți și activități profesionale.',
			'Jelentkezzen szűréseinkre, tanácsadásainkra vagy közösségi programjainkra.' => 'Înscrieți-vă la screeningurile, consilierile sau programele noastre comunitare.',
			'Hasznos tartalmak a megelőzésről, a rendszeres szűrések szerepéről és a korai felismerés jelentőségéről.' => 'Conținuturi utile despre prevenție, rolul screeningurilor regulate și importanța depistării timpurii.',
			'Ismeretterjesztő anyagok családokról, közösségekről és a helyi egészségfejlesztés szerepéről.' => 'Materiale informative despre familii, comunități și rolul promovării sănătății la nivel local.',
			'Gyakorlati tanácsok, letölthető anyagok és GYIK a tudatosabb mindennapokhoz.' => 'Sfaturi practice, materiale descărcabile și întrebări frecvente pentru zile mai conștiente.',
			'A mozgó szűrőakció bevezetésének célja Szatmár megyében a korai szűrés fontosságának tudatosítása, valamint a szűrési lehetőségek vidéki közösségekhez való közelebb vitele.' => 'Scopul introducerii programului de screening mobil în județul Satu Mare este creșterea gradului de conștientizare privind importanța depistării precoce și apropierea serviciilor medicale de comunitățile rurale.',
			'A program szemlélete egyszerű és közösségközpontú: nem a beteg utazik, hanem a szolgáltatás kerül közelebb a beteghez. Ez különösen fontos azokban a településekben, ahol a szűrővizsgálatokhoz való hozzáférés nehezebb lehet.' => 'Abordarea programului este simplă și orientată spre comunitate: nu pacientul călătorește, ci serviciul este adus mai aproape de pacient. Acest lucru este deosebit de important în localitățile unde accesul la screeninguri poate fi mai dificil.',
			'A mobil szűrés célja, hogy a lakosság könnyebben elérje azokat a vizsgálatokat, amelyek segíthetik a betegségek korai felismerését, és hozzájárulhatnak a megelőzés erősítéséhez.' => 'Scopul screeningului mobil este ca populația să aibă acces mai ușor la investigațiile care pot ajuta la depistarea timpurie a bolilor și pot contribui la consolidarea prevenției.',
			'Tudatosítja a korai szűrés és a megelőzés jelentőségét.' => 'Conștientizează importanța screeningului timpuriu și a prevenției.',
			'Könnyebbé teszi a szűrésekhez való hozzáférést vidéki településeken.' => 'Facilitează accesul la screeninguri în localitățile rurale.',
			'A szolgáltatás közelebb kerül azokhoz, akik nehezebben jutnak el városi központokba.' => 'Aduce serviciul mai aproape de persoanele care ajung mai greu în centrele urbane.',
			'Támogatja a lakosság egészségtudatosabb döntéseit.' => 'Sprijină deciziile mai conștiente privind sănătatea ale populației.',
			'Segítheti a daganatos betegségek korábbi felismerését.' => 'Poate ajuta la depistarea mai timpurie a bolilor oncologice.',
			'Erősíti a helyi háziorvosokkal való együttműködést.' => 'Consolidează colaborarea cu medicii de familie locali.',
			'Mobil szakorvosi szolgálat összefoglaló' => 'Rezumat serviciu mobil de consultații medicale de specialitate',
			'Szakellátás közelebb vitele a vidéki közösségekhez' => 'Aducerea consultațiilor de specialitate mai aproape de comunitățile rurale',
			'Romániában köztudott az egészségügyi ellátáshoz, ezen belül a szakellátáshoz való hozzáférés és annak igénybevétele között óriási különbség van falusi és városi, főleg nagyvárosi összehasonlításban, a falvakon élők rovására.' => 'În România există diferențe semnificative între mediul urban și cel rural în ceea ce privește accesul la serviciile medicale specializate, populația din zonele rurale fiind adesea dezavantajată.',
			'A mozgó szakorvosi szolgálat bevezetésének célja Szatmár megyében a szakorvosi ellátás közösséghez való közelebb vitele. Ennek lényege, hogy nem a beteg utazik, hanem a szolgáltatás kerül közelebb a beteghez.' => 'Scopul introducerii serviciului mobil de consultații medicale de specialitate în județul Satu Mare este apropierea serviciilor medicale de comunitățile locale. În acest mod, nu pacientul este obligat să călătorească, ci serviciile sunt oferite cât mai aproape de locul de domiciliu.',
			'Ezáltal lényegesen javulhat a város és a falu lakosainak egészségügyi ellátáshoz való hozzáférése közötti különbség, erősödhet a háziorvosi, családorvosi rendelők és a járóbeteg szakrendelők szakmai kapcsolata.' => 'Implementarea acestui model poate reduce diferențele dintre mediul urban și rural în accesul la servicii medicale și poate consolida colaborarea dintre medicii de familie și medicii specialiști.',
			'A program hozzájárulhat a hátrányos, falusi települések háziorvosi rendelői szintjén végzett szakmai munka színvonalának emeléséhez, valamint javíthatja a háziorvosi tevékenység megelőzésben és ellátásban betöltött szerepét.' => 'Programul poate contribui la creșterea nivelului profesional al cabinetelor medicale din localitățile defavorizate și poate întări rolul medicului de familie în prevenție și îngrijire.',
			'A kezdeményezés különösen fontos a szociálisan hátrányos lakossági csoportok és az infrastrukturálisan izolált települések számára, ahol a szakorvosi ellátáshoz való hozzáférés korlátozottabb lehet.' => 'Inițiativa este deosebit de importantă pentru grupurile vulnerabile și comunitățile izolate infrastructural, unde accesul la servicii medicale specializate poate fi mai limitat.',
			'A szakorvosi ellátás közelebb kerül a vidéki közösségekhez.' => 'Asistența medicală de specialitate ajunge mai aproape de comunitățile rurale.',
			'Támogatja a háziorvosi rendelők és szakrendelők kapcsolatát.' => 'Sprijină colaborarea dintre cabinetele medicilor de familie și ambulatoriile de specialitate.',
			'Kardiovaszkuláris és egyéb szakvizsgálatok vidéki helyszíneken valósulhatnak meg.' => 'Consultațiile cardiovasculare și alte investigații de specialitate pot fi realizate în localități rurale.',
			'Javíthatja a szakellátáshoz való hozzáférést izolált településeken.' => 'Poate îmbunătăți accesul la servicii de specialitate în localitățile izolate.',
			'Támogathatja a szociálisan hátrányos lakossági csoportokat.' => 'Poate sprijini grupurile sociale dezavantajate.',
			'Hosszabb távon kedvezően hathat a lakosság egészségi mutatóira.' => 'Pe termen mai lung poate avea un efect favorabil asupra indicatorilor de sănătate ai populației.',
			'Csökkentheti a falusi és városi ellátáshoz való hozzáférés különbségeit.' => 'Poate reduce diferențele de acces la servicii între mediul rural și urban.',
			'Erősítheti az alapellátás és a szakrendelői járóbeteg-ellátás kapcsolatát.' => 'Poate consolida legătura dintre asistența medicală primară și ambulatoriile de specialitate.',
			'Segítheti a háziorvosi munka megelőzésben betöltött szerepét.' => 'Poate sprijini rolul medicului de familie în prevenție.',
			'Támogathatja a hátrányos helyzetű vidéki közösségek ellátását.' => 'Poate sprijini îngrijirea comunităților rurale defavorizate.',
			'10 háziorvosnál, vidéki településeken' => 'La 10 medici de familie, în localități rurale',
			'A program célja, hogy a szakellátás és a szűrés a vidéki közösségek számára is könnyebben elérhetővé váljon, különösen ott, ahol a hozzáférés ma korlátozott.' => 'Scopul programului este ca serviciile de specialitate și screeningurile să devină mai ușor accesibile și pentru comunitățile rurale, mai ales acolo unde accesul este în prezent limitat.',
			'Romániában köztudott az egészségügyi ellátáshoz (szakellátáshoz) való hozzáférés, igénybevétel óriási különbsége falusi és városi, főleg nagyvárosi összehasonlításban, a falvakon élők rovására.' => 'În România există diferențe majore între mediul rural și cel urban, în special marile orașe, în ceea ce privește accesul la serviciile medicale specializate, în dezavantajul populației rurale.',
			'A mozgó szakorvosi szolgálat bevezetésének célja Szatmár megyében a szakorvosi ellátás közösséghez való közelebb vitele, mely által nem a beteg utazik, hanem a szolgáltatás kerül közelebb a beteghez.' => 'Scopul introducerii serviciului mobil de consultații medicale de specialitate în județul Satu Mare este apropierea serviciilor medicale de comunitate, astfel încât nu pacientul călătorește, ci serviciul ajunge mai aproape de pacient.',
			'Ezáltal lényegesen javulhat a város és a falu lakosainak egészségügyi ellátáshoz való hozzáférésének a különbsége, erősödhet a háziorvosi (családorvosi) rendelők és a járóbeteg szakrendelők szakmai kapcsolata, a hátrányos települések háziorvosi rendelői szintjén a szakmai munka színvonala, javulhat a háziorvosi tevékenység megelőzésben és ellátásban nyújtott szerepe, valamint a szakmai kapcsolat az alapellátás és a szakrendelői járóbeteg-ellátás között.' => 'Astfel se poate îmbunătăți accesul la servicii medicale pentru populația rurală, se poate consolida legătura profesională dintre cabinetele medicilor de familie și ambulatoriile de specialitate, poate crește calitatea muncii profesionale în cabinetele din localități defavorizate și se poate întări rolul medicului de familie în prevenție și îngrijire.',
			'A program hozzájárulhat a szakorvosi ellátáshoz való jobb hozzáféréshez, különösen a szociálisan hátrányos lakossági csoportok és az infrastrukturálisan izolált települések esetében, és hosszabb távon kedvezően hathat a lakosság morbiditási és mortalitási adataira is.' => 'Programul poate contribui la un acces mai bun la servicii de specialitate, în special pentru grupurile sociale dezavantajate și localitățile izolate infrastructural, iar pe termen mai lung poate avea un impact favorabil asupra indicatorilor de morbiditate și mortalitate.',
			'Csökkenhet a falusi és városi ellátás közötti különbség' => 'Se pot reduce diferențele dintre serviciile rurale și urbane',
			'Erősödhet a háziorvosok és a szakrendelők szakmai együttműködése' => 'Se poate consolida colaborarea profesională dintre medicii de familie și ambulatoriile de specialitate',
			'Javulhat a megelőzés és az alapellátás szerepe' => 'Se poate îmbunătăți rolul prevenției și al asistenței medicale primare',
			'Nőhet a hozzáférés a szakorvosi ellátáshoz' => 'Poate crește accesul la consultații de specialitate',
			'Segítheti a hátrányos helyzetű lakosságot és az izolált településeket' => 'Poate sprijini populația dezavantajată și localitățile izolate',
			'A mozgó szűrőakció bevezetésének célja Szatmár megyében a korai szűrés fontosságának tudatosítása és a vidéki közösséghez való közelebb vitele, mely által nem a beteg utazik, hanem a szolgáltatás kerül közelebb a beteghez.' => 'Scopul introducerii acțiunii mobile de screening în județul Satu Mare este conștientizarea importanței depistării precoce și apropierea serviciilor de comunitățile rurale, astfel încât nu pacientul călătorește, ci serviciul ajunge mai aproape de pacient.',
			'1000 személy szűrése tervezett, 10 háziorvosnál a megye különböző vidéki településein.' => 'Este planificată examinarea a 1.000 de persoane prin intermediul a 10 medici de familie din diferite localități rurale ale județului.',
			'Javítja a hozzáférést a szakellátáshoz' => 'Îmbunătățește accesul la servicii de specialitate',
			'Támogatja a megelőzést és a korai felismerést' => 'Sprijină prevenția și depistarea timpurie',
			'Segíti a vidéki lakosság egészségvédelmét' => 'Sprijină protejarea sănătății populației rurale',
			'A fiatal lányok és nők hiteles, érthető információkat kapnak saját testük működéséről.' => 'Tinerele fete și femeile primesc informații credibile și ușor de înțeles despre funcționarea propriului corp.',
			'A cikluskövetés segíti a termékenységtudatosság kialakítását.' => 'Monitorizarea ciclului sprijină dezvoltarea conștientizării fertilității.',
			'Az oktatás hozzájárulhat a felelősebb döntéshozatalhoz.' => 'Educația poate contribui la luarea unor decizii mai responsabile.',
			'A program támogatja az egészségügyi nevelést és a prevenciót.' => 'Programul sprijină educația pentru sănătate și prevenția.',
			'A tudásátadás segíthet csökkenteni a tévhiteket és az információhiányt.' => 'Transmiterea cunoștințelor poate ajuta la reducerea miturilor și a lipsei de informații.',
			'Az Egészségfejlesztési Irodába jelentkezők személyre szabottabb támogatást kaphatnak.' => 'Persoanele care se adresează Biroului pentru Promovare și Protecție a Sănătății pot primi sprijin mai personalizat.',
			'Az egészséges életmódot és a szűrővizsgálatok jelentőségét népszerűsítő tevékenységek' => 'Activități de promovare a stilului de viață sănătos și a importanței screeningului',
			'Az egészséges életmódot, a betegségmegelőzést és a szűrővizsgálatok jelentőségét népszerűsítő tevékenységek.' => 'Activități de promovare a stilului de viață sănătos, a prevenirii bolilor și a importanței screeningului.',
			'Helyben elérhető szakvizsgálatok a könnyebb hozzáférésért' => 'Consultații de specialitate disponibile local pentru un acces mai facil',
			'Helyben elérhető onkológiai szűrések a könnyebb hozzáférésért' => 'Screeninguri oncologice disponibile local pentru un acces mai facil',
			'Személyre szabott támogatás az egészséges életvitel kialakításához' => 'Sprijin personalizat pentru adoptarea unui stil de viață sănătos',
			'Korai felismerés és támogatás a gyermekek fejlődésében' => 'Depistare timpurie și sprijin pentru dezvoltarea copiilor',
			'A megye különböző vidéki településein 10 háziorvosnál a szakvizsgálatoknak megfelelő szakorvosok bevonásával fognak kardiovaszkuláris és egyéb vizsgálatokat végezni.' => 'În diferite localități rurale ale județului, la 10 medici de familie, vor fi realizate consultații cardiovasculare și alte investigații cu implicarea specialiștilor corespunzători.',
			'Jelenleg nincs meghirdetett közelgő esemény.' => 'Momentan nu există evenimente viitoare anunțate.',
			'Az eseménykezelő jelenleg nem érhető el.' => 'Modulul de evenimente nu este disponibil momentan.',
			'Jelenleg nincs megjeleníthető esemény.' => 'Momentan nu există evenimente de afișat.',
			'Ha kitöltöd, a beépített statikus űrlap helyett ez jelenik meg.' => 'Dacă este completat, acesta va fi afișat în locul formularului static inclus.',
			'Csak kézi menüpontoknál használatos. WordPress menünél a WordPress current-menu-item osztályai érvényesülnek.' => 'Se folosește doar pentru elementele de meniu introduse manual. Pentru meniurile WordPress se aplică clasele current-menu-item din WordPress.',
			'The Events Calendar esetén hagyd tribe_events értéken.' => 'Pentru The Events Calendar, păstrați valoarea tribe_events.',
			'The Events Calendar esetén hagyd üresen vagy használd: _EventStartDate.' => 'Pentru The Events Calendar, lăsați gol sau folosiți: _EventStartDate.',
			'Hagyd üresen automatikus felismeréshez. Támogatott példák: _EventVenueID, _event_location_id, location.' => 'Lăsați gol pentru detectare automată. Exemple acceptate: _EventVenueID, _event_location_id, location.',
			'Kézi kártyák használata, ha nincs találat' => 'Folosește carduri manuale dacă nu există rezultate',
		);

		return self::$map;
	}
}

trait VitaCenter_RO_Widget_Trait {
	public function get_title() {
		return 'RO ' . $this->vc_ro_title;
	}

	protected function register_controls() {
		VitaCenter_RO_Text::begin_filter();

		try {
			parent::register_controls();
		} finally {
			VitaCenter_RO_Text::end_filter();
		}
	}

	protected function render() {
		VitaCenter_RO_Text::begin_filter();

		try {
			parent::render();
		} finally {
			VitaCenter_RO_Text::end_filter();
		}
	}

	public function get_settings_for_display( $setting_key = null ) {
		$settings = parent::get_settings_for_display();
		$settings = VitaCenter_RO_Text::translate_value( $settings );

		if ( null === $setting_key ) {
			return $settings;
		}

		return is_array( $settings ) && array_key_exists( $setting_key, $settings ) ? $settings[ $setting_key ] : null;
	}
}

class VitaCenter_RO_Elementor_Header_Widget extends VitaCenter_Elementor_Header_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Fejléc/Nav';
	public function get_name() { return 'vitacenter_ro_header_nav'; }
}

class VitaCenter_RO_Elementor_Landing_Widget extends VitaCenter_Elementor_Landing_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Kezdőlap';
	public function get_name() { return 'vitacenter_ro_landing_page'; }
}

class VitaCenter_RO_Header_Top_Widget extends VitaCenter_Header_Top_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Fejléc felső rész';
	public function get_name() { return 'vitacenter_ro_header_top'; }
}

class VitaCenter_RO_Header_Menu_Widget extends VitaCenter_Header_Menu_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Fejléc menü';
	public function get_name() { return 'vitacenter_ro_header_menu'; }
}

class VitaCenter_RO_Landing_Hero_Widget extends VitaCenter_Landing_Hero_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Hero';
	public function get_name() { return 'vitacenter_ro_landing_hero'; }
}

class VitaCenter_RO_Landing_Project_Widget extends VitaCenter_Landing_Project_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Projekt bemutató';
	public function get_name() { return 'vitacenter_ro_landing_project_intro'; }
}

class VitaCenter_RO_Landing_Programs_Widget extends VitaCenter_Landing_Programs_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Programok';
	public function get_name() { return 'vitacenter_ro_landing_programs'; }
}

class VitaCenter_RO_Landing_Events_Widget extends VitaCenter_Landing_Events_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Események';
	public function get_name() { return 'vitacenter_ro_landing_events'; }
}

class VitaCenter_RO_Upcoming_Events_Widget extends VitaCenter_Upcoming_Events_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Közelgő események';
	public function get_name() { return 'vitacenter_ro_upcoming_events'; }
}

class VitaCenter_RO_All_Events_Widget extends VitaCenter_All_Events_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'Összes esemény';
	public function get_name() { return 'vitacenter_ro_all_events'; }
}

class VitaCenter_RO_Landing_Cta_Widget extends VitaCenter_Landing_Cta_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter CTA';
	public function get_name() { return 'vitacenter_ro_landing_cta'; }
}

class VitaCenter_RO_Landing_Knowledge_Widget extends VitaCenter_Landing_Knowledge_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Tudástár kártyák';
	public function get_name() { return 'vitacenter_ro_landing_knowledge'; }
}

class VitaCenter_RO_Knowledge_Widget extends VitaCenter_Knowledge_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Tudástár';
	public function get_name() { return 'vitacenter_ro_knowledge'; }
}

class VitaCenter_RO_Video_Gallery_Widget extends VitaCenter_Video_Gallery_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Fotó- és videógaléria';
	public function get_name() { return 'vitacenter_ro_video_gallery'; }
}

class VitaCenter_RO_Partners_Widget extends VitaCenter_Partners_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Partnerek';
	public function get_name() { return 'vitacenter_ro_partners'; }
}

class VitaCenter_RO_Contact_Widget extends VitaCenter_Contact_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Kapcsolat';
	public function get_name() { return 'vitacenter_ro_contact'; }
}

class VitaCenter_RO_Landing_Contact_Widget extends VitaCenter_Landing_Contact_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Kapcsolat/Footer';
	public function get_name() { return 'vitacenter_ro_landing_contact_footer'; }
}

class VitaCenter_RO_Legal_Footer_Widget extends VitaCenter_Legal_Footer_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Jogi lábléc';
	public function get_name() { return 'vitacenter_ro_legal_footer'; }
}

class VitaCenter_RO_Project_Content_Widget extends VitaCenter_Project_Content_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Projekt tartalom';
	public function get_name() { return 'vitacenter_ro_project_content'; }
}

class VitaCenter_RO_Program_Content_Widget extends VitaCenter_Program_Content_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Program tartalom';
	public function get_name() { return 'vitacenter_ro_program_content'; }
}

class VitaCenter_RO_Mobile_Specialist_Widget extends VitaCenter_Mobile_Specialist_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Mobil szakorvosi szolgálat';
	public function get_name() { return 'vitacenter_ro_mobile_specialist'; }
}

class VitaCenter_RO_Mobile_Specialist_V2_Widget extends VitaCenter_Mobile_Specialist_V2_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Mobil szakorvosi szolgálat 2.0';
	public function get_name() { return 'vitacenter_ro_mobile_specialist_v2'; }
}

class VitaCenter_RO_Mobile_Screening_Widget extends VitaCenter_Mobile_Screening_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Mobil szűrés';
	public function get_name() { return 'vitacenter_ro_mobile_screening'; }
}

class VitaCenter_RO_Ciklusoktatas_Widget extends VitaCenter_Ciklusoktatas_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Ciklusoktatás';
	public function get_name() { return 'vitacenter_ro_ciklusoktatas'; }
}

class VitaCenter_RO_Egeszsegfejlesztesi_Iroda_Widget extends VitaCenter_Egeszsegfejlesztesi_Iroda_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Egészségfejlesztési Iroda';
	public function get_name() { return 'vitacenter_ro_egeszsegfejlesztesi_iroda'; }
}

class VitaCenter_RO_Eletmodtanacsadas_Widget extends VitaCenter_Eletmodtanacsadas_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Életmódtanácsadás';
	public function get_name() { return 'vitacenter_ro_eletmodtanacsadas'; }
}

class VitaCenter_RO_Iskolaerettseg_Widget extends VitaCenter_Iskolaerettseg_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Iskolaérettség';
	public function get_name() { return 'vitacenter_ro_iskolaerettseg'; }
}

class VitaCenter_RO_Info_Section_Widget extends VitaCenter_Info_Section_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Info szekció';
	public function get_name() { return 'vitacenter_ro_info_section'; }
}

class VitaCenter_RO_Registration_Info_Widget extends VitaCenter_Registration_Info_Widget {
	use VitaCenter_RO_Widget_Trait;
	protected $vc_ro_title = 'VitaCenter Regisztráció / kapcsolat';
	public function get_name() { return 'vitacenter_ro_registration_info'; }
}

final class VitaCenter_RO_Widgets {
	public static function register( $widgets_manager ) {
		foreach ( self::classes() as $class_name ) {
			$widgets_manager->register( new $class_name() );
		}
	}

	private static function classes() {
		return array(
			'VitaCenter_RO_Elementor_Header_Widget',
			'VitaCenter_RO_Elementor_Landing_Widget',
			'VitaCenter_RO_Header_Top_Widget',
			'VitaCenter_RO_Header_Menu_Widget',
			'VitaCenter_RO_Landing_Hero_Widget',
			'VitaCenter_RO_Landing_Project_Widget',
			'VitaCenter_RO_Landing_Programs_Widget',
			'VitaCenter_RO_Landing_Events_Widget',
			'VitaCenter_RO_Upcoming_Events_Widget',
			'VitaCenter_RO_All_Events_Widget',
			'VitaCenter_RO_Landing_Cta_Widget',
			'VitaCenter_RO_Landing_Knowledge_Widget',
			'VitaCenter_RO_Knowledge_Widget',
			'VitaCenter_RO_Video_Gallery_Widget',
			'VitaCenter_RO_Partners_Widget',
			'VitaCenter_RO_Contact_Widget',
			'VitaCenter_RO_Landing_Contact_Widget',
			'VitaCenter_RO_Legal_Footer_Widget',
			'VitaCenter_RO_Project_Content_Widget',
			'VitaCenter_RO_Program_Content_Widget',
			'VitaCenter_RO_Mobile_Specialist_Widget',
			'VitaCenter_RO_Mobile_Specialist_V2_Widget',
			'VitaCenter_RO_Mobile_Screening_Widget',
			'VitaCenter_RO_Ciklusoktatas_Widget',
			'VitaCenter_RO_Egeszsegfejlesztesi_Iroda_Widget',
			'VitaCenter_RO_Eletmodtanacsadas_Widget',
			'VitaCenter_RO_Iskolaerettseg_Widget',
			'VitaCenter_RO_Info_Section_Widget',
			'VitaCenter_RO_Registration_Info_Widget',
		);
	}
}
