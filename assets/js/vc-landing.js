(function () {
	'use strict';

	var revealSelector = [
		'.vc-landing__hero-copy',
		'.vc-landing__about-copy',
		'.vc-landing__focus-item',
		'.vc-landing__program-card',
		'.vc-landing__event-card',
		'.vc-landing__cta',
		'.vc-landing__article-card',
		'.vc-landing__contact-bar'
	].join(',');

	function initLanding(root) {
		if (!root || root.dataset.vcLandingReady === 'true') {
			return;
		}

		root.dataset.vcLandingReady = 'true';
		var items = Array.prototype.slice.call(root.querySelectorAll(revealSelector));

		items.forEach(function (item, index) {
			item.classList.add('vc-landing__reveal');
			item.style.setProperty('--vc-reveal-delay', Math.min(index % 6, 5) * 70 + 'ms');
		});

		if (!('IntersectionObserver' in window)) {
			items.forEach(function (item) {
				item.classList.add('is-visible');
			});
			return;
		}

		var observer = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (!entry.isIntersecting) {
					return;
				}

				entry.target.classList.add('is-visible');
				observer.unobserve(entry.target);
			});
		}, {
			rootMargin: '0px 0px -8% 0px',
			threshold: 0.14
		});

		items.forEach(function (item) {
			observer.observe(item);
		});
	}

	function boot() {
		document.querySelectorAll('.vc-landing').forEach(initLanding);
	}

	function bootElementorWidget(scope) {
		var root = scope && scope[0] ? scope[0] : null;

		if (!root) {
			return;
		}

		root.querySelectorAll('.vc-landing').forEach(initLanding);
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', boot);
	} else {
		boot();
	}

	if (window.elementorFrontend && window.elementorFrontend.hooks) {
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_landing_page.default', bootElementorWidget);
	}
}());
