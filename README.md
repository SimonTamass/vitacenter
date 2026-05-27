# VitaCenter Elementor Widgets

WordPress plugin, amely szerkesztheto Elementor widgeteket ad a VitaCenter oldalhoz.

## Telepites Gitbol

1. Szinkronizald vagy klonozd ezt a repot a WordPress telepitesben ide:
   `wp-content/plugins/vitacenter-elementor-header`
2. WordPress adminban aktivald a `VitaCenter Elementor Widgets` plugint.
3. Elementorban keresd a widgeteket a `VitaCenter` kategoriaban:
   - `VitaCenter Header/Nav`
   - `VitaCenter Landing Page`
   - `VitaCenter Header Top`
   - `VitaCenter Header Menu`
   - `VitaCenter Hero`
   - `VitaCenter Project Intro`
   - `VitaCenter Programs`
   - `VitaCenter Events`
   - `VitaCenter Upcoming Events`
   - `All Events`
   - `VitaCenter CTA`
   - `VitaCenter Knowledge Cards`
   - `VitaCenter Knowledge`
   - `VitaCenter Video Gallery`
   - `VitaCenter Partners`
   - `VitaCenter Contact`
   - `VitaCenter Contact/Footer`
   - `VitaCenter Legal Footer`
   - `VitaCenter Project Content`
   - `VitaCenter Program Content`
   - `VitaCenter Mobil szakorvosi szolgálat`
   - `VitaCenter Mobil szakorvosi szolgálat 2.0`
   - `VitaCenter Mobil szűrés`
   - `VitaCenter Ciklusoktatás`
   - `VitaCenter Egészségfejlesztési Iroda`
   - `VitaCenter Életmódtanácsadás`
   - `VitaCenter Iskolaérettség`
   - `VitaCenter Info Section`
   - `VitaCenter Registration Info`

Az elso ket widget egyben tartalmazza a regi teljes blokkot. Ha az Elementor
Navigatorban kulon szerkesztheto, strukturalt felepites kell, az uj kisebb
widgeteket helyezd egymas ala.

## Szerkesztheto elemek

### Header/Nav

- EFI logo, nev, alcim es link.
- Projektkod es programnev.
- Jobb oldali partnerlogok repeater mezokkel.
- WordPress menu valaszto, kezi menupont fallbackkel.
- Szinek, tipografia, spacing, logo meretek es sticky fejlec opcio.

### Landing Page

- Header nelkuli teljes kezdolap tartalom.
- Hero kep, cimsor, alcim es CTA gombok.
- Projekt bemutato blokk es fokuszpontok.
- Kiemelt programok kartyai.
- Kozelgo esemenyek dinamikusan az esemeny plugin postjaibol, kezi fallbackkel.
- Idopontfoglalasi CTA sav.
- Tudastar kartyak.
- Kapcsolati sav es also footer sor.

### Strukturalt widget bontas

- Header: kulon `Header Top` es `Header Menu` widget.
- Landing: kulon hero, projekt intro, programok, esemenyek, CTA, tudastar es
  kapcsolat/footer widget.
- Footer: kulon `Legal Footer` widget EU nyilatkozattal, copyright sorral,
  Interreg linkkel es szerkesztheto elerhetosegekkel.
- Aloldalak: kulon `Project Content`, `Program Content`, `Info Section` es
  `Registration Info` widgetek a honlap.docx tartalma alapjan. A `Project
  Content` widget modern belso projektoldal-layoutot ad hero szakasszal,
  kiemelt szamokkal, attekinto oldalsavval, projektbemutatoval, celokkal,
  programkartyakkal es strategiai uzenetekkel.
- A `VitaCenter Mobil szakorvosi szolgálat` widget header es footer nelkuli
  belso programoldalt ad hero szakasszal, reszletes cikk tartalommal, gyors
  informacios oldalsavval, kapcsolodo mobil szures blokkal es kiemelt
  uzenettel.
- A `VitaCenter Mobil szakorvosi szolgálat 2.0` widget a mobil szakorvosi
  oldal uj, kompaktabb vizualis valtozata hero szakasszal, kiemelt
  kartyakkal, reszletes programleirassal, statisztika kartyakkal es gyors
  informacios oldalsavval. A regi mobil szakorvosi widget tovabbra is
  elerheto marad.
- A `VitaCenter Mobil szűrés` widget kulon mobil szures programoldalt ad
  onkologiai szuresi tartalommal, 1000 fos tervezett eleressel, szuresi
  teruletek kartyaval, gyors informacios oldalsavval es kiemelt uzenettel.
- A `VitaCenter Ciklusoktatás` widget header es footer nelkuli belso
  programoldalt ad termekenysegtudatossagi hero szakasszal, programleirassal,
  temalistaval, gyors informacios oldalsavval es kapcsolat blokkal.
- A `VitaCenter Egészségfejlesztési Iroda` widget header es footer nelkuli
  belso programoldalt ad prevencios hero szakasszal, programleirassal,
  szolgaltatasi teruletekkel, gyors informacios oldalsavval es kapcsolat
  blokkal.
- A `VitaCenter Életmódtanácsadás` widget header es footer nelkuli belso
  programoldalt ad eletmodtanacsadas hero szakasszal, tanacsadasi teruletekkel,
  gyors informacios oldalsavval es kapcsolat blokkal.
- A `VitaCenter Iskolaérettség` widget header es footer nelkuli belso
  programoldalt ad ovodas iskolaerettsegi szures hero szakasszal,
  szuresi tevekenysegekkel, riziko tunet listaval, gyors informacios
  oldalsavval es kapcsolat blokkal.
- A `VitaCenter Events` widget a The Events Calendar `tribe_events` bejegyzeseit
  olvassa, a `_EventStartDate` mezovel jovobeli datum szerint rendezve.
- A `VitaCenter Upcoming Events` widget ugyanezt a forrast hasznalja, de
  shortcode-szeru, kepes, datum-badges esemenykartyakat ad.
- Az `All Events` widget minden `tribe_events` esemenyt megjelenit: elol a
  kovetkezoket novekvo idorendben, utana kulon, jelolve az elmultakat.
- A `VitaCenter Contact` widget teljes kapcsolat oldalt ad hero szakasszal,
  elerhetosegi kartyakkal, urlap/shortcode hellyel, nyitvatartassal es
  terkepblokkal.
- A `VitaCenter Knowledge` widget teljes tudastar oldalt ad hero szakasszal,
  kiemelt temaval, cikkkartyakkal, letoltesekkel, GYIK blokkal es oldalsavval.
- A `VitaCenter Video Gallery` widget foto- es videogaleria oldalt ad hero
  szakasszal, szurokkel, kiemelt albumokkal, galeria raccsal es oldalsavval.
- A `VitaCenter Partners` widget partneroldalt ad szerkesztheto hero
  szakasszal, kiemelt partnerrel, partnerkartyakkal es also megjegyzessel.
- A nagy egyben widgetek megmaradtak kompatibilitas miatt, de uj oldalt inkabb
  a kisebb widgetekbol epits.

Elementor Free eleg hozza; Elementor Pro nem szukseges.
