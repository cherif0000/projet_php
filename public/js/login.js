const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const btnSubmit = document.getElementById('btnSubmit');

btnSubmit.disabled = true;

function showError(input, message) {
    const baliseP = input.nextElementSibling;

    if (message) {
        baliseP.textContent = message;
        input.classList.add('is-invalid');
    } else {
        baliseP.textContent = '';
        input.classList.remove('is-invalid');
    }
}

// EMAIL
emailInput.addEventListener('input', () => {
    const email = emailInput.value;

    const error = Validator.emailValidator("Email", email);

    showError(emailInput, error ? error.message : '');
});

// PASSWORD
passwordInput.addEventListener('input', () => {
    const password = passwordInput.value;
    const error = Validator.passwordValidator("Mot de passe", password, 6);

    showError(passwordInput, error ? error.message : '');
    toggleButton();
});

// ACTIVER BOUTON
function toggleButton() {
    const emailValid = !Validator.emailValidator("Email", emailInput.value.trim());
    const passwordValid = !Validator.passwordValidator("Mot de passe", passwordInput.value, 6);

    btnSubmit.disabled = !(emailValid && passwordValid);
}


// affiche message reuissi ou erreur avant redirection

document.getElementById('loginForm').addEventListener('submit', (event) => {
    Swal.fire({
        title: 'Succès',
        text: 'Connexion réussie',
        icon: 'success',
        timer: 1000,
        showConfirmButton: false
    });

    // laisser le formulaire continuer après 1s
    setTimeout(() => {
        event.target.submit();
    }, 1000);
});
