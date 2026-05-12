(function () {
	'use strict';

	function initHeader(header) {
		if (header.dataset.vcHeaderReady === 'true') {
			return;
		}

		var toggle = header.querySelector('.vc-header__toggle');
		var nav = header.querySelector('.vc-header__nav');

		if (!toggle || !nav) {
			return;
		}

		header.dataset.vcHeaderReady = 'true';

		toggle.addEventListener('click', function () {
			var isOpen = header.classList.toggle('is-open');
			toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
		});

		nav.addEventListener('click', function (event) {
			var link = event.target.closest('a');

			if (!link || !header.classList.contains('is-open')) {
				return;
			}

			header.classList.remove('is-open');
			toggle.setAttribute('aria-expanded', 'false');
		});
	}

	function boot() {
		document.querySelectorAll('.vc-header').forEach(initHeader);
	}

	function bootElementorWidget(scope) {
		var root = scope && scope[0] ? scope[0] : null;

		if (!root) {
			return;
		}

		root.querySelectorAll('.vc-header').forEach(initHeader);
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', boot);
	} else {
		boot();
	}

	if (window.elementorFrontend && window.elementorFrontend.hooks) {
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_header_nav.default', bootElementorWidget);
	}
}());
