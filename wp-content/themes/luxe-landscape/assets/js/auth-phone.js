/**
 * Auth Phone Integration (intl-tel-input)
 * 
 * Initializes the country code flag dropdown on Phone fields in Sign In and Sign Up.
 */
document.addEventListener('DOMContentLoaded', function() {
    // Select the phone inputs
    const signinPhone = document.querySelector('#phone');
    const signupPhone = document.querySelector('#reg_phone');

    const itlOptions = {
        separateDialCode: true,
        initialCountry: "sa",
        allowDropdown: false,
        nationalMode: true,
        utilsScript: luxePhoneData.utilsUrl,
    };

    const restrictToSaudiFormat = (input) => {
        if (!input) return;
        
        input.addEventListener('input', function() {
            // 1. Remove all non-numeric characters
            let val = this.value.replace(/[^0-9]/g, '');
            
            // 2. Enforce starting with 5 or 05
            // If they type something that doesn't start with 0 or 5, clear it
            if (val.length > 0 && !val.startsWith('5') && !val.startsWith('0')) {
                val = '';
            }
            // If it starts with 0 but the second char isn't 5, clear after the 0
            if (val.length > 1 && val.startsWith('0') && val[1] !== '5') {
                val = '0';
            }
            
            this.value = val;
        });
    };

    // Initialize Sign In field if it exists
    if (signinPhone) {
        window.intlTelInput(signinPhone, itlOptions);
        restrictToSaudiFormat(signinPhone);
        
        // Clear value if it's just the dial code
        if (signinPhone.value.trim() === '+966' || signinPhone.value.trim() === '00966') {
            signinPhone.value = '';
        }
    }

    // Initialize Sign Up field if it exists
    if (signupPhone) {
        window.intlTelInput(signupPhone, itlOptions);
        restrictToSaudiFormat(signupPhone);

        // Clear value if it's just the dial code
        if (signupPhone.value.trim() === '+966' || signupPhone.value.trim() === '00966') {
            signupPhone.value = '';
        }
    }
});
