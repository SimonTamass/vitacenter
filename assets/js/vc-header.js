(function () {
	'use strict';

	function initHeader(header) {
		if (header.dataset.vcHeaderReady === 'true') {
			return;
		}

		var toggle = header.querySelector('.vc-header__toggle');
		var nav = header.querySelector('.vc-header__nav');
		var mobileQuery = window.matchMedia('(max-width: 767px)');

		if (!toggle || !nav) {
			return;
		}

		header.dataset.vcHeaderReady = 'true';

		function setOpen(isOpen) {
			header.classList.toggle('is-open', isOpen);
			toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
		}

		toggle.addEventListener('click', function () {
			setOpen(!header.classList.contains('is-open'));
		});

		nav.addEventListener('click', function (event) {
			var link = event.target.closest('a');

			if (!link || !header.classList.contains('is-open')) {
				return;
			}

			setOpen(false);
		});

		document.addEventListener('click', function (event) {
			if (!header.classList.contains('is-open') || header.contains(event.target)) {
				return;
			}

			setOpen(false);
		});

		document.addEventListener('keydown', function (event) {
			if ('Escape' !== event.key || !header.classList.contains('is-open')) {
				return;
			}

			setOpen(false);
			toggle.focus();
		});

		if (mobileQuery.addEventListener) {
			mobileQuery.addEventListener('change', function (event) {
				if (!event.matches) {
					setOpen(false);
				}
			});
		} else if (mobileQuery.addListener) {
			mobileQuery.addListener(function (event) {
				if (!event.matches) {
					setOpen(false);
				}
			});
		}
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
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_header_top.default', bootElementorWidget);
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_header_menu.default', bootElementorWidget);
	}
}());
