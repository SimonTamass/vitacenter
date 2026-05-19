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
		'.vc-landing__contact-bar',
		'.vc-page-heading',
		'.vc-page-card',
		'.vc-stat-card',
		'.vc-message-grid > div',
		'.vc-content-panel',
		'.vc-info-band',
		'.vc-registration-card',
		'.vc-project-page__hero-copy',
		'.vc-project-page__visual',
		'.vc-project-page__highlight',
		'.vc-project-page__overview-card',
		'.vc-project-page__panel',
		'.vc-project-page__program-card',
		'.vc-project-page__strategy'
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
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_landing_hero.default', bootElementorWidget);
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_landing_project_intro.default', bootElementorWidget);
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_landing_programs.default', bootElementorWidget);
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_landing_events.default', bootElementorWidget);
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_landing_cta.default', bootElementorWidget);
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_landing_knowledge.default', bootElementorWidget);
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_landing_contact_footer.default', bootElementorWidget);
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_project_content.default', bootElementorWidget);
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_program_content.default', bootElementorWidget);
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_info_section.default', bootElementorWidget);
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_registration_info.default', bootElementorWidget);
	}
}());
