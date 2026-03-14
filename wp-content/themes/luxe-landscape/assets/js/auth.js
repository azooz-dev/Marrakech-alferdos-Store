/**
 * Authentication Scripts
 *
 * Handles AJAX requests, UI validation, and custom dropdown logic.
 *
 * @package Luxe_Landscape
 */

(function ($) {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {

		// 1. Custom Dropdown Logic
		var countrySelectBtn = document.getElementById('country-select-button');
		var countryOptionsMenu = document.getElementById('country-options-menu');
		var countryCodeInput = document.getElementById('country-code-input');
		var countrySelectDisplay = document.getElementById('country-select-display');
		var countrySelectIcon = document.getElementById('country-select-icon');

		if (countrySelectBtn && countryOptionsMenu) {
			// Toggle dropdown
			countrySelectBtn.addEventListener('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				var isOpen = !countryOptionsMenu.classList.contains('invisible');
				
				if (isOpen) {
					closeDropdown();
				} else {
					// Open
					countryOptionsMenu.classList.remove('invisible', 'opacity-0', 'scale-95');
					countryOptionsMenu.classList.add('visible', 'opacity-100', 'scale-100');
					countrySelectIcon.classList.add('rotate-180');
					countrySelectBtn.classList.add('ring-2', 'ring-primary', 'border-primary');
				}
			});

			// Select option
			var options = countryOptionsMenu.querySelectorAll('.country-option');
			options.forEach(function(opt) {
				opt.addEventListener('click', function(e) {
					e.preventDefault();
					e.stopPropagation();
					
					// Update values
					var value = this.getAttribute('data-value');
					var label = this.getAttribute('data-label');
					
					countryCodeInput.value = value;
					countrySelectDisplay.textContent = label;
					
					// Update styles to show active
					options.forEach(o => {
						o.classList.remove('bg-slate-50', 'dark:bg-slate-700/30', 'text-primary', 'font-medium');
						o.classList.add('text-slate-700', 'dark:text-slate-300');
					});
					this.classList.remove('text-slate-700', 'dark:text-slate-300');
					this.classList.add('bg-slate-50', 'dark:bg-slate-700/30', 'text-primary', 'font-medium');
					
					closeDropdown();
				});
			});

			// Click outside to close
			document.addEventListener('click', function(e) {
				if (!countrySelectBtn.contains(e.target) && !countryOptionsMenu.contains(e.target)) {
					closeDropdown();
				}
			});

			function closeDropdown() {
				countryOptionsMenu.classList.add('invisible', 'opacity-0', 'scale-95');
				countryOptionsMenu.classList.remove('visible', 'opacity-100', 'scale-100');
				countrySelectIcon.classList.remove('rotate-180');
				countrySelectBtn.classList.remove('ring-2', 'ring-primary', 'border-primary');
			}
		}

		// 2. Validation Helpers
		function showError(inputId, errorId, message) {
			var inputEl = document.getElementById(inputId);
			var errorEl = document.getElementById(errorId);
			if (inputEl) {
				inputEl.classList.add('border-red-500', 'dark:border-red-500/50', 'focus:border-red-500', 'focus:ring-red-500/30');
				inputEl.classList.remove('border-slate-200', 'dark:border-emerald-800/50', 'focus:border-primary', 'focus:ring-primary');
			}
			if (errorEl) {
				var textEl = errorEl.querySelector('.error-text');
				if (textEl) textEl.textContent = message;
				errorEl.classList.remove('hidden', 'opacity-0');
				errorEl.classList.add('opacity-100');
			}
		}

		function hideError(inputId, errorId) {
			var inputEl = document.getElementById(inputId);
			var errorEl = document.getElementById(errorId);
			if (inputEl) {
				inputEl.classList.remove('border-red-500', 'dark:border-red-500/50', 'focus:border-red-500', 'focus:ring-red-500/30');
				inputEl.classList.add('border-slate-200', 'dark:border-emerald-800/50', 'focus:border-primary', 'focus:ring-primary');
			}
			if (errorEl) {
				errorEl.classList.add('hidden', 'opacity-0');
				errorEl.classList.remove('opacity-100');
			}
		}

		// Clean non-numeric characters for validation
		function cleanPhone(phone) {
			return phone.replace(/\D/g, '');
		}

		// Validate phone number based on country code
		function validatePhone(phoneCode, phoneNumber) {
			var cleaned = cleanPhone(phoneNumber);
			
			if (!cleaned) {
				return luxeAjax.isRTL ? 'يرجى إدخال رقم الهاتف' : 'Please enter a phone number';
			}

			if (phoneCode === '+966') {
				// Saudi Arabia: 9 digits starting with 5, or 10 digits starting with 05
				var isValidSA = (/^5\d{8}$/.test(cleaned)) || (/^05\d{8}$/.test(cleaned));
				if (!isValidSA) {
					return luxeAjax.isRTL 
						? 'رقم هاتف سعودي غير صالح (يجب أن يبدأ بـ 5 أو 05)' 
						: 'Invalid SA number. Must start with 5 (9 digits) or 05 (10 digits).';
				}
			} else if (phoneCode === '+1') {
				// US: 10 digits
				if (cleaned.length !== 10) return luxeAjax.isRTL ? 'رقم أمريكي غير صالح (10 أرقام)' : 'Invalid US number (must be 10 digits).';
			} else if (phoneCode === '+44') {
				// UK: 10 digits
				if (cleaned.length !== 10) return luxeAjax.isRTL ? 'رقم بريطاني غير صالح (10 أرقام)' : 'Invalid UK number (must be 10 digits).';
			} else if (phoneCode === '+971') {
				// UAE: 9 digits
				if (cleaned.length !== 9) return luxeAjax.isRTL ? 'رقم إماراتي غير صالح (9 أرقام)' : 'Invalid UAE number (must be 9 digits).';
			} else if (phoneCode === '+33') {
				// FR: 9 digits
				if (cleaned.length !== 9) return luxeAjax.isRTL ? 'رقم فرنسي غير صالح (9 أرقام)' : 'Invalid French number (must be 9 digits).';
			} else {
				// Generic fallback
				if (cleaned.length < 7) {
					return luxeAjax.isRTL ? 'رقم هاتف غير صالح' : 'Invalid phone number.';
				}
			}

			return null; // Valid
		}

		// Real-time revalidation on typing
		var phoneInputEl = document.getElementById('phone-number-input');
		if (phoneInputEl) {
			phoneInputEl.addEventListener('input', function() {
				hideError('phone-number-input', 'phone-error');
			});
		}
		var nameInputEl = document.getElementById('name-input');
		if (nameInputEl) {
			nameInputEl.addEventListener('input', function() {
				hideError('name-input', 'name-error');
			});
		}

		// 3. Handle Sign In form
		var signinBtn = document.querySelector('.auth-submit');
		if (signinBtn && document.querySelector('.auth-title-login')) { // Check we are on signin page
			signinBtn.addEventListener('click', function (e) {
				e.preventDefault();

				var phoneInput = document.getElementById('phone-number-input') ? document.getElementById('phone-number-input').value : '';
				var countryCode = document.getElementById('country-code-input') ? document.getElementById('country-code-input').value : '+966';
				
				hideError('phone-number-input', 'phone-error');

				var validationError = validatePhone(countryCode, phoneInput);
				if (validationError) {
					showError('phone-number-input', 'phone-error', validationError);
					return;
				}

				var fullPhone = countryCode + ' ' + cleanPhone(phoneInput);
				var btnText = signinBtn.querySelector('.auth-btn-login');

				var originalText = btnText.textContent;
				btnText.textContent = luxeAjax.isRTL ? 'جاري التحقق...' : 'Verifying...';
				signinBtn.classList.add('opacity-70', 'pointer-events-none');

				var data = new URLSearchParams();
				data.append('action', 'luxe_signin');
				data.append('nonce', luxeAjax.nonce);
				data.append('phone', fullPhone);

				fetch(luxeAjax.ajaxUrl, {
					method: 'POST',
					body: data
				})
				.then(response => response.json())
				.then(res => {
					if (res.success) {
						window.location.href = res.data.redirect;
					} else {
						showError('phone-number-input', 'phone-error', res.data);
						btnText.textContent = originalText;
						signinBtn.classList.remove('opacity-70', 'pointer-events-none');
					}
				})
				.catch(err => {
					console.error(err);
					showError('phone-number-input', 'phone-error', luxeAjax.isRTL ? 'حدث خطأ. حاول مرة أخرى.' : 'An error occurred. Please try again.');
					btnText.textContent = originalText;
					signinBtn.classList.remove('opacity-70', 'pointer-events-none');
				});
			});
		}

		// 4. Handle Sign Up form
		var signupBtn = document.querySelector('.auth-submit-signup');
		if (signupBtn) {
			signupBtn.addEventListener('click', function (e) {
				e.preventDefault();

				var nameInputObj = document.getElementById('name-input');
				var nameInput = nameInputObj ? nameInputObj.value.trim() : '';
				
				var phoneInput = document.getElementById('phone-number-input') ? document.getElementById('phone-number-input').value : '';
				var countryCode = document.getElementById('country-code-input') ? document.getElementById('country-code-input').value : '+966';
				
				var termsChecked = document.querySelector('input[type="checkbox"]');
				var isTermsChecked = termsChecked ? termsChecked.checked : true;
				
				var hasErrors = false;

				hideError('name-input', 'name-error');
				hideError('phone-number-input', 'phone-error');

				if (!nameInput) {
					showError('name-input', 'name-error', luxeAjax.isRTL ? 'يرجى إدخال اسمك الكامل' : 'Please enter your full name');
					hasErrors = true;
				}

				var phoneValidationError = validatePhone(countryCode, phoneInput);
				if (phoneValidationError) {
					showError('phone-number-input', 'phone-error', phoneValidationError);
					hasErrors = true;
				}

				if (!isTermsChecked) {
					var termsMsg = luxeAjax.isRTL ? 'يجب الموافقة على الشروط أولاً' : 'You must agree to the Terms and Privacy Policy';
					if (!hasErrors) { // Piggyback on name-error strictly for messaging if there are no other errors
						showError('name-input', 'name-error', termsMsg);
						document.getElementById('name-input').classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500/30', 'dark:border-red-500/50');
					}
					hasErrors = true;
				}

				if (hasErrors) return;

				var fullPhone = countryCode + ' ' + cleanPhone(phoneInput);
				var btnText = signupBtn.querySelector('.auth-btn-signup');

				var originalText = btnText.textContent;
				btnText.textContent = luxeAjax.isRTL ? 'جاري الإنشاء...' : 'Creating...';
				signupBtn.classList.add('opacity-70', 'pointer-events-none');

				var data = new URLSearchParams();
				data.append('action', 'luxe_signup');
				data.append('nonce', luxeAjax.nonce);
				data.append('full_name', nameInput);
				data.append('phone', fullPhone);

				fetch(luxeAjax.ajaxUrl, {
					method: 'POST',
					body: data
				})
				.then(response => response.json())
				.then(res => {
					if (res.success) {
						window.location.href = res.data.redirect;
					} else {
						showError('phone-number-input', 'phone-error', res.data);
						btnText.textContent = originalText;
						signupBtn.classList.remove('opacity-70', 'pointer-events-none');
					}
				})
				.catch(err => {
					console.error(err);
					showError('phone-number-input', 'phone-error', luxeAjax.isRTL ? 'حدث خطأ. حاول مرة أخرى.' : 'An error occurred. Please try again.');
					btnText.textContent = originalText;
					signupBtn.classList.remove('opacity-70', 'pointer-events-none');
				});
			});
		}

	});
})(jQuery);
