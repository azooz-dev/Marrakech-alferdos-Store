/**
 * Account Page Interactions
 *
 * Handles: Order tab filtering, Address modal (add/edit) with animations
 */
document.addEventListener('DOMContentLoaded', function () {

	/* =============================================
	   ORDER TABS
	   ============================================= */
	var tabButtons = document.querySelectorAll('[data-tab]');
	var orderCards = document.querySelectorAll('.order-card');

	tabButtons.forEach(function (btn) {
		btn.addEventListener('click', function () {
			var tab = this.getAttribute('data-tab');

			tabButtons.forEach(function (b) {
				b.classList.remove('text-primary', 'border-b-2', 'border-primary', 'font-bold');
				b.classList.add('text-slate-400', 'font-medium');
			});
			this.classList.add('text-primary', 'border-b-2', 'border-primary', 'font-bold');
			this.classList.remove('text-slate-400', 'font-medium');

			orderCards.forEach(function (card) {
				var cardStatus = card.getAttribute('data-status');
				card.style.display = (tab === 'all' || cardStatus === tab) ? '' : 'none';
			});
		});
	});

	/* =============================================
	   ADDRESS MODAL — Animated + Edit Mode
	   ============================================= */
	var openBtn    = document.getElementById('open-address-modal');
	var closeBtn   = document.getElementById('close-address-modal');
	var cancelBtn  = document.getElementById('cancel-address-modal');
	var modal      = document.getElementById('address-modal');
	var panel      = document.getElementById('address-modal-panel');
	var titleEl    = document.getElementById('modal-title');
	var descEl     = document.getElementById('modal-desc');
	var saveTextEl = document.getElementById('modal-save-text');
	var editBtns   = document.querySelectorAll('.edit-address-btn');

	// Form input references
	var inputs = {
		label:  document.getElementById('addr-label'),
		name:   document.getElementById('addr-name'),
		street: document.getElementById('addr-street'),
		city:   document.getElementById('addr-city'),
		postal: document.getElementById('addr-postal'),
		apt:    document.getElementById('addr-apt')
	};

	/* --- Animation Helpers --- */
	function openModal() {
		if (!modal) return;

		// Make visible but transparent
		modal.style.display = '';
		modal.classList.remove('pointer-events-none');
		document.body.style.overflow = 'hidden';

		// Trigger reflow so the transition runs
		void modal.offsetHeight;

		// Animate backdrop in
		modal.classList.remove('opacity-0');
		modal.classList.add('opacity-100');
		modal.style.backdropFilter = 'blur(8px)';
		modal.style.backgroundColor = 'rgba(0,0,0,0.4)';

		// Animate panel in
		if (panel) {
			panel.classList.remove('scale-95', 'translate-y-4', 'opacity-0');
			panel.classList.add('scale-100', 'translate-y-0', 'opacity-100');
		}
	}

	function closeModal() {
		if (!modal) return;

		// Animate out
		modal.classList.remove('opacity-100');
		modal.classList.add('opacity-0');
		modal.style.backdropFilter = 'blur(0px)';
		modal.style.backgroundColor = 'rgba(0,0,0,0)';

		if (panel) {
			panel.classList.remove('scale-100', 'translate-y-0', 'opacity-100');
			panel.classList.add('scale-95', 'translate-y-4', 'opacity-0');
		}

		// After transition ends, fully hide
		setTimeout(function () {
			modal.classList.add('pointer-events-none');
			document.body.style.overflow = '';
		}, 320);
	}

	function clearForm() {
		Object.keys(inputs).forEach(function (key) {
			if (inputs[key]) inputs[key].value = '';
		});
	}

	/* --- "Add New Address" button --- */
	function openAddModal() {
		clearForm();
		if (titleEl)    titleEl.textContent    = titleEl.getAttribute('data-add-text')    || 'Add New Address';
		if (descEl)     descEl.textContent     = descEl.getAttribute('data-add-desc')     || 'Enter your details for biophilic delivery.';
		if (saveTextEl) saveTextEl.textContent  = saveTextEl.getAttribute('data-add-save') || 'Save Address';
		openModal();
	}

	/* --- "Edit" button on an address card --- */
	function openEditModal(btn) {
		// Pre-fill inputs from data attributes
		if (inputs.label)  inputs.label.value  = btn.getAttribute('data-label')  || '';
		if (inputs.name)   inputs.name.value   = btn.getAttribute('data-name')   || '';
		if (inputs.street) inputs.street.value  = btn.getAttribute('data-street') || '';
		if (inputs.city)   inputs.city.value   = btn.getAttribute('data-city')   || '';
		if (inputs.postal) inputs.postal.value = btn.getAttribute('data-postal') || '';
		if (inputs.apt)    inputs.apt.value    = btn.getAttribute('data-apt')    || '';

		// Switch modal text to "Edit" mode
		if (titleEl)    titleEl.textContent    = 'Edit Address';
		if (descEl)     descEl.textContent     = 'Update your delivery location details.';
		if (saveTextEl) saveTextEl.textContent  = 'Update Address';

		openModal();
	}

	/* --- Wire up event listeners --- */
	if (openBtn) openBtn.addEventListener('click', openAddModal);
	if (closeBtn) closeBtn.addEventListener('click', closeModal);
	if (cancelBtn) cancelBtn.addEventListener('click', closeModal);

	editBtns.forEach(function (btn) {
		btn.addEventListener('click', function (e) {
			e.preventDefault();
			openEditModal(this);
		});
	});

	// Close on backdrop click
	if (modal) {
		modal.addEventListener('click', function (e) {
			if (e.target === modal) closeModal();
		});
	}

	// Close on Escape key
	document.addEventListener('keydown', function (e) {
		if (e.key === 'Escape') {
			closeModal();
			closeTrackModal();
		}
	});

	/* =============================================
	   TRACK ORDER MODAL
	   ============================================= */
	var trackModal      = document.getElementById('track-modal');
	var trackPanel      = document.getElementById('track-modal-panel');
	var openTrackBtns   = document.querySelectorAll('.open-track-modal');
	var closeTrackBtn   = document.getElementById('close-track-modal');

	function openTrackModal() {
		if (!trackModal) return;

		trackModal.style.display = 'flex';
		trackModal.classList.remove('pointer-events-none');
		document.body.style.overflow = 'hidden';

		void trackModal.offsetHeight;

		trackModal.classList.remove('opacity-0');
		trackModal.classList.add('opacity-100');
		trackModal.style.backdropFilter = 'blur(8px)';
		trackModal.style.backgroundColor = 'rgba(0,0,0,0.4)';

		if (trackPanel) {
			trackPanel.classList.remove('scale-95', 'translate-y-4', 'opacity-0');
			trackPanel.classList.add('scale-100', 'translate-y-0', 'opacity-100');
		}
	}

	function closeTrackModal() {
		if (!trackModal) return;

		trackModal.classList.remove('opacity-100');
		trackModal.classList.add('opacity-0');
		trackModal.style.backdropFilter = 'blur(0px)';
		trackModal.style.backgroundColor = 'rgba(0,0,0,0)';

		if (trackPanel) {
			trackPanel.classList.remove('scale-100', 'translate-y-0', 'opacity-100');
			trackPanel.classList.add('scale-95', 'translate-y-4', 'opacity-0');
		}

		setTimeout(function () {
			trackModal.classList.add('pointer-events-none');
			document.body.style.overflow = '';
		}, 320);
	}

	openTrackBtns.forEach(function (btn) {
		btn.addEventListener('click', function (e) {
			e.preventDefault();
			openTrackModal();
		});
	});

	if (closeTrackBtn) closeTrackBtn.addEventListener('click', closeTrackModal);

	if (trackModal) {
		trackModal.addEventListener('click', function (e) {
			if (e.target === trackModal) closeTrackModal();
		});
	}

	/* --- Copy Tracking Number --- */
	var copyBtns = document.querySelectorAll('.copy-tracking');
	copyBtns.forEach(function(btn) {
		btn.addEventListener('click', function() {
			var targetId = this.getAttribute('data-target');
			var targetEl = document.getElementById(targetId);
			if (!targetEl) return;

			var text = targetEl.textContent.trim();
			var icon = this.querySelector('.material-symbols-outlined');

			navigator.clipboard.writeText(text).then(function() {
				// Visual feedback
				if (icon) {
					var oldIcon = icon.textContent;
					icon.textContent = 'check';
					btn.classList.add('text-emerald-500');
					btn.classList.remove('text-primary');

					setTimeout(function() {
						icon.textContent = oldIcon;
						btn.classList.remove('text-emerald-500');
						btn.classList.add('text-primary');
					}, 2000);
				}
			});
		});
	});

	/* =============================================
	   PHONE FIELD REFINEMENT (Xootix)
	   ============================================= */
	function refinePhoneField() {
		var phoneCode = document.querySelector('.xoo-ml-phone-cc');
		var phoneInput = document.querySelector('.xoo-ml-phone-input');

		if (phoneCode) {
			phoneCode.value = '+966';
			phoneCode.setAttribute('readonly', 'readonly');
			phoneCode.style.pointerEvents = 'none';
			// Force styling via JS too just in case CSS is being overridden
			phoneCode.style.textAlign = 'center';
			phoneCode.style.height = 'auto';
			phoneCode.style.lineHeight = 'normal';
		}

		if (phoneInput) {
			phoneInput.placeholder = '555-0123';
		}
	}
	
	// Persistent reinforcement because plugins like to re-render
	var observer = new MutationObserver(function(mutations) {
		refinePhoneField();
	});

	var target = document.querySelector('.woocommerce-MyAccount-content');
	if (target) {
		observer.observe(target, { childList: true, subtree: true });
	}
	
	refinePhoneField();
	setTimeout(refinePhoneField, 500);
	setTimeout(refinePhoneField, 2000);
});
