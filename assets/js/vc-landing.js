(function () {
	'use strict';

	var revealSelector = [
		'.vc-landing__hero-copy',
		'.vc-landing__about-copy',
		'.vc-landing__focus-item',
		'.vc-landing__program-card',
		'.vc-landing__event-card',
		'.efi-event-card',
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
		'.vc-project-page__panel',
		'.vc-project-page__program-card',
		'.vc-project-page__strategy',
		'.vc-mobile-specialist__hero-copy',
		'.vc-mobile-specialist__visual',
		'.vc-mobile-specialist__card',
		'.vc-mobile-specialist__screening',
		'.vc-mobile-specialist__message',
		'.vc-mobile-specialist__side-card',
		'.vc-mobile-specialist__useful',
		'.vc-mobile-specialist__cta',
		'.efi-knowledge-hero',
		'.efi-featured-article',
		'.efi-featured-mini-card',
		'.efi-knowledge-section',
		'.efi-sidebar-card',
		'.efi-gallery-hero',
		'.efi-gallery-filter',
		'.efi-gallery-featured-card',
		'.efi-gallery-item',
		'.efi-gallery-sidebar-card',
		'.efi-partners-hero',
		'.efi-partner-card',
		'.efi-partners-note',
		'.efi-contact-hero',
		'.efi-contact-info-card',
		'.efi-contact-form-card',
		'.efi-contact-side-card',
		'.efi-contact-map'
	].join(',');

	var projectStickyPages = [];
	var projectStickyResizeBound = false;
	var projectStickyScrollBound = false;
	var projectStickyFrame = null;
	var projectStickyMedia = window.matchMedia ? window.matchMedia('(min-width: 981px)') : null;

	function unlockProjectStickyAncestors(overview) {
		var node = overview.parentElement;

		while (node && node !== document.body && node !== document.documentElement) {
			node.style.setProperty('overflow', 'visible', 'important');
			node.style.setProperty('overflow-x', 'visible', 'important');
			node.style.setProperty('overflow-y', 'visible', 'important');
			node.style.setProperty('contain', 'none', 'important');
			node.style.setProperty('transform', 'none', 'important');
			node = node.parentElement;
		}
	}

	function applyProjectSticky(page) {
		var grid = page.querySelector('.vc-project-page__content-grid');
		var overview = page.querySelector('.vc-project-page__overview');
		var placeholder = page.querySelector('.vc-project-page__overview-placeholder');
		var desktop = !projectStickyMedia || projectStickyMedia.matches;

		if (!grid || !overview) {
			return;
		}

		unlockProjectStickyAncestors(overview);
		grid.style.setProperty('overflow', 'visible', 'important');
		grid.style.setProperty('overflow-x', 'visible', 'important');
		grid.style.setProperty('overflow-y', 'visible', 'important');
		grid.style.setProperty('position', 'relative', 'important');

		if (!placeholder) {
			placeholder = document.createElement('div');
			placeholder.className = 'vc-project-page__overview-placeholder';
			placeholder.setAttribute('aria-hidden', 'true');
			grid.insertBefore(placeholder, overview);
		}

		if (desktop) {
			layoutProjectSticky(page, grid, overview, placeholder);
		} else {
			resetProjectSticky(overview, placeholder, true);
		}
	}

	function refreshProjectStickies() {
		projectStickyPages.forEach(applyProjectSticky);
	}

	function scheduleProjectStickyRefresh() {
		if (projectStickyFrame) {
			return;
		}

		projectStickyFrame = window.requestAnimationFrame(function () {
			projectStickyFrame = null;
			refreshProjectStickies();
		});
	}

	function getProjectStickyTop(page) {
		var value = window.getComputedStyle(page).getPropertyValue('--vc-project-sticky-top');
		var top = parseFloat(value);

		return isNaN(top) ? 32 : top;
	}

	function getProjectOverviewWidth(grid, overview) {
		var columns = window.getComputedStyle(grid).gridTemplateColumns.split(' ');
		var width = parseFloat(columns[0]);

		if (isNaN(width) || width <= 0) {
			width = overview.getBoundingClientRect().width;
		}

		return width;
	}

	function resetProjectSticky(overview, placeholder, staticPosition) {
		overview.classList.remove('is-sticky-fixed', 'is-sticky-bottom');
		overview.style.removeProperty('left');
		overview.style.removeProperty('bottom');
		overview.style.removeProperty('width');
		overview.style.removeProperty('transform');

		if (placeholder) {
			placeholder.style.setProperty('display', 'none', 'important');
			placeholder.style.removeProperty('height');
		}

		if (staticPosition) {
			overview.style.setProperty('position', 'static', 'important');
			overview.style.setProperty('top', 'auto', 'important');
			overview.style.removeProperty('align-self');
		} else {
			overview.style.setProperty('position', 'sticky', 'important');
			overview.style.setProperty('top', 'var(--vc-project-sticky-top, 32px)', 'important');
			overview.style.setProperty('align-self', 'start', 'important');
		}
	}

	function layoutProjectSticky(page, grid, overview, placeholder) {
		var topOffset = getProjectStickyTop(page);
		var gridRect = grid.getBoundingClientRect();
		var gridStyle = window.getComputedStyle(grid);
		var paddingBottom = parseFloat(gridStyle.paddingBottom) || 0;
		var overviewHeight = overview.offsetHeight;
		var overviewWidth = getProjectOverviewWidth(grid, overview);
		var gridBottomLimit = gridRect.bottom - paddingBottom;

		overview.style.setProperty('align-self', 'start', 'important');
		overview.style.setProperty('transform', 'none', 'important');

		if (gridRect.top > topOffset) {
			resetProjectSticky(overview, placeholder);
			return;
		}

		placeholder.style.setProperty('display', 'block', 'important');
		placeholder.style.setProperty('height', overviewHeight + 'px', 'important');

		if (gridBottomLimit <= topOffset + overviewHeight) {
			overview.classList.remove('is-sticky-fixed');
			overview.classList.add('is-sticky-bottom');
			overview.style.setProperty('position', 'absolute', 'important');
			overview.style.setProperty('top', Math.max(0, grid.offsetHeight - paddingBottom - overviewHeight) + 'px', 'important');
			overview.style.setProperty('left', '0px', 'important');
			overview.style.setProperty('bottom', 'auto', 'important');
			overview.style.setProperty('width', overviewWidth + 'px', 'important');
			return;
		}

		overview.classList.remove('is-sticky-bottom');
		overview.classList.add('is-sticky-fixed');
		overview.style.setProperty('position', 'fixed', 'important');
		overview.style.setProperty('top', topOffset + 'px', 'important');
		overview.style.setProperty('left', gridRect.left + 'px', 'important');
		overview.style.setProperty('bottom', 'auto', 'important');
		overview.style.setProperty('width', overviewWidth + 'px', 'important');
	}

	function bindProjectStickyRefresh() {
		if (projectStickyResizeBound) {
			return;
		}

		projectStickyResizeBound = true;
		window.addEventListener('resize', function () {
			scheduleProjectStickyRefresh();
		});

		if (projectStickyMedia) {
			if (projectStickyMedia.addEventListener) {
				projectStickyMedia.addEventListener('change', refreshProjectStickies);
			} else if (projectStickyMedia.addListener) {
				projectStickyMedia.addListener(refreshProjectStickies);
			}
		}
	}

	function bindProjectStickyScroll() {
		if (projectStickyScrollBound) {
			return;
		}

		projectStickyScrollBound = true;
		window.addEventListener('scroll', scheduleProjectStickyRefresh, { passive: true });
	}

	function initProjectSticky(root) {
		var pages = [];

		if (root.matches && root.matches('.vc-project-page')) {
			pages.push(root);
		}

		pages = pages.concat(Array.prototype.slice.call(root.querySelectorAll('.vc-project-page')));

		pages.forEach(function (page) {
			if (projectStickyPages.indexOf(page) === -1) {
				projectStickyPages.push(page);
			}

			page.classList.add('vc-project-page--sticky-runtime');
			applyProjectSticky(page);
		});

		if (pages.length) {
			bindProjectStickyRefresh();
			bindProjectStickyScroll();
			window.setTimeout(refreshProjectStickies, 100);
			window.setTimeout(refreshProjectStickies, 500);
		}
	}

	var galleryLightbox = null;
	var galleryLightboxBound = false;
	var galleryLightboxState = {
		images: [],
		index: 0,
		title: ''
	};

	function ensureGalleryLightbox() {
		if (galleryLightbox) {
			return galleryLightbox;
		}

		var root = document.createElement('div');
		root.className = 'efi-gallery-lightbox';
		root.setAttribute('aria-hidden', 'true');
		root.setAttribute('role', 'dialog');
		root.setAttribute('aria-modal', 'true');
		root.innerHTML = [
			'<button class="efi-gallery-lightbox__close" type="button" aria-label="Bezárás">&times;</button>',
			'<button class="efi-gallery-lightbox__nav efi-gallery-lightbox__nav--prev" type="button" aria-label="Előző kép">&#8249;</button>',
			'<figure class="efi-gallery-lightbox__figure">',
			'<img class="efi-gallery-lightbox__image" src="" alt="">',
			'<figcaption class="efi-gallery-lightbox__caption"><strong></strong><span></span></figcaption>',
			'</figure>',
			'<button class="efi-gallery-lightbox__nav efi-gallery-lightbox__nav--next" type="button" aria-label="Következő kép">&#8250;</button>'
		].join('');

		document.body.appendChild(root);

		galleryLightbox = {
			root: root,
			image: root.querySelector('.efi-gallery-lightbox__image'),
			title: root.querySelector('.efi-gallery-lightbox__caption strong'),
			count: root.querySelector('.efi-gallery-lightbox__caption span'),
			close: root.querySelector('.efi-gallery-lightbox__close'),
			prev: root.querySelector('.efi-gallery-lightbox__nav--prev'),
			next: root.querySelector('.efi-gallery-lightbox__nav--next')
		};

		galleryLightbox.close.addEventListener('click', closeGalleryLightbox);
		galleryLightbox.prev.addEventListener('click', function () {
			moveGalleryLightbox(-1);
		});
		galleryLightbox.next.addEventListener('click', function () {
			moveGalleryLightbox(1);
		});
		galleryLightbox.root.addEventListener('click', function (event) {
			if (event.target === galleryLightbox.root) {
				closeGalleryLightbox();
			}
		});

		return galleryLightbox;
	}

	function updateGalleryLightbox() {
		var box = ensureGalleryLightbox();
		var total = galleryLightboxState.images.length;
		var current = galleryLightboxState.images[galleryLightboxState.index];

		if (!current) {
			return;
		}

		box.image.src = current;
		box.image.alt = galleryLightboxState.title || '';
		box.title.textContent = galleryLightboxState.title || '';
		box.count.textContent = (galleryLightboxState.index + 1) + ' / ' + total;
		box.prev.disabled = total < 2;
		box.next.disabled = total < 2;
		box.root.classList.toggle('is-single', total < 2);
	}

	function moveGalleryLightbox(step) {
		var total = galleryLightboxState.images.length;

		if (total < 2) {
			return;
		}

		galleryLightboxState.index = (galleryLightboxState.index + step + total) % total;
		updateGalleryLightbox();
	}

	function closeGalleryLightbox() {
		if (!galleryLightbox) {
			return;
		}

		galleryLightbox.root.classList.remove('is-open');
		galleryLightbox.root.setAttribute('aria-hidden', 'true');
		document.documentElement.classList.remove('efi-gallery-lightbox-open');
		galleryLightbox.image.removeAttribute('src');
	}

	function openGalleryLightbox(trigger) {
		var images = [];

		try {
			images = JSON.parse(trigger.getAttribute('data-efi-gallery-images') || '[]');
		} catch (error) {
			images = [];
		}

		images = images.filter(function (image) {
			return typeof image === 'string' && image.length;
		});

		if (!images.length) {
			return;
		}

		galleryLightboxState.images = images;
		galleryLightboxState.index = 0;
		galleryLightboxState.title = trigger.getAttribute('data-efi-gallery-title') || trigger.getAttribute('aria-label') || '';

		ensureGalleryLightbox();
		updateGalleryLightbox();
		galleryLightbox.root.classList.add('is-open');
		galleryLightbox.root.setAttribute('aria-hidden', 'false');
		document.documentElement.classList.add('efi-gallery-lightbox-open');
		galleryLightbox.close.focus();
	}

	function bindGalleryLightbox() {
		if (galleryLightboxBound) {
			return;
		}

		galleryLightboxBound = true;

		document.addEventListener('click', function (event) {
			var target = event.target && event.target.nodeType === 3 ? event.target.parentElement : event.target;
			var trigger = target && target.closest ? target.closest('[data-efi-gallery-lightbox="true"]') : null;

			if (!trigger) {
				return;
			}

			event.preventDefault();
			event.stopPropagation();
			event.stopImmediatePropagation();
			openGalleryLightbox(trigger);
		}, true);

		document.addEventListener('keydown', function (event) {
			if (!galleryLightbox || !galleryLightbox.root.classList.contains('is-open')) {
				return;
			}

			if (event.key === 'Escape') {
				closeGalleryLightbox();
			} else if (event.key === 'ArrowLeft') {
				moveGalleryLightbox(-1);
			} else if (event.key === 'ArrowRight') {
				moveGalleryLightbox(1);
			}
		});
	}

	function initLanding(root) {
		if (!root) {
			return;
		}

		initProjectSticky(root);

		if (root.dataset.vcLandingReady === 'true') {
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
		bindGalleryLightbox();
		document.querySelectorAll('.vc-landing').forEach(initLanding);
	}

	function bootElementorWidget(scope) {
		bindGalleryLightbox();
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
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_upcoming_events.default', bootElementorWidget);
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_all_events.default', bootElementorWidget);
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_landing_cta.default', bootElementorWidget);
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_landing_knowledge.default', bootElementorWidget);
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_knowledge.default', bootElementorWidget);
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_video_gallery.default', bootElementorWidget);
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_partners.default', bootElementorWidget);
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_contact.default', bootElementorWidget);
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_landing_contact_footer.default', bootElementorWidget);
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_project_content.default', bootElementorWidget);
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_program_content.default', bootElementorWidget);
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_mobile_specialist.default', bootElementorWidget);
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_info_section.default', bootElementorWidget);
		window.elementorFrontend.hooks.addAction('frontend/element_ready/vitacenter_registration_info.default', bootElementorWidget);
	}
}());
