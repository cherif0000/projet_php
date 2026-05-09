const nomInput         = document.getElementById('nom');
const emailInput       = document.getElementById('email');
const passwordInput    = document.getElementById('password');
const confirmInput     = document.getElementById('confirmPassword');
const btnSubmit        = document.getElementById('btnSubmit');

btnSubmit.disabled = true;

function showError(inputId, message) {
    const input = document.getElementById(inputId);
    const baliseP = document.getElementById('error-' + inputId);

    if (message) {
        baliseP.textContent = message;
        input.classList.add('is-invalid');
    } else {
        baliseP.textContent = '';
        input.classList.remove('is-invalid');
    }
}

function toggleButton() {
    const nomValid     = !Validator.nameValidator("Nom", 2, 50, nomInput.value.trim());
    const emailValid   = !Validator.emailValidator("Email", emailInput.value.trim());
    const passwordValid = !Validator.passwordValidator("Mot de passe", passwordInput.value, 8);
    const confirmValid = passwordInput.value === confirmInput.value && confirmInput.value.length > 0;

    btnSubmit.disabled = !(nomValid && emailValid && passwordValid && confirmValid);
}

// NOM
nomInput.addEventListener('input', () => {
    const error = Validator.nameValidator("Nom", 2, 50, nomInput.value.trim());
    showError('nom', error ? error.message : '');
    toggleButton();
});

// EMAIL
emailInput.addEventListener('input', () => {
    const error = Validator.emailValidator("Email", emailInput.value.trim());
    showError('email', error ? error.message : '');
    toggleButton();
});

// PASSWORD
passwordInput.addEventListener('input', () => {
    const error = Validator.passwordValidator("Mot de passe", passwordInput.value, 8);
    showError('password', error ? error.message : '');

    // re-vérifier la confirmation si déjà remplie
    if (confirmInput.value.length > 0) {
        const match = passwordInput.value === confirmInput.value;
        showError('confirmPassword', match ? '' : 'Les mots de passe ne correspondent pas.');
    }
    toggleButton();
});

// CONFIRM PASSWORD
confirmInput.addEventListener('input', () => {
    const match = passwordInput.value === confirmInput.value;
    showError('confirmPassword', match ? '' : 'Les mots de passe ne correspondent pas.');
    toggleButton();
});