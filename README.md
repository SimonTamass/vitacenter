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
   - `VitaCenter CTA`
   - `VitaCenter Knowledge Cards`
   - `VitaCenter Contact/Footer`
   - `VitaCenter Legal Footer`
   - `VitaCenter Project Content`
   - `VitaCenter Program Content`
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
- A `VitaCenter Events` widget a The Events Calendar `tribe_events` bejegyzeseit
  olvassa, a `_EventStartDate` mezovel jovobeli datum szerint rendezve.
- A nagy egyben widgetek megmaradtak kompatibilitas miatt, de uj oldalt inkabb
  a kisebb widgetekbol epits.

Elementor Free eleg hozza; Elementor Pro nem szukseges.
