class Validator {

    // PASSWORD
    static passwordValidator(controlName, value, lengthWord) {
        if (!value || value.length === 0) {
            return { error: true, message: `${controlName} est obligatoire` };
        }

        if (value.length < lengthWord) {
            return { error: true, message: `${controlName} doit contenir au moins ${lengthWord} caractères` };
        }

        if (value.startsWith(" ") || value.endsWith(" ")) {
            return { error: true, message: `Les espaces ne sont pas autorisés au début ou à la fin` };
        }

        return null;
    }

    // EMAIL
    static emailValidator(controlName, value) {

        if (!value || value.trim().length === 0) {
            return { error: true, message: `${controlName} est obligatoire` };
        }

        let pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!pattern.test(value.trim())) {
            return { error: true, message: `${controlName} doit être valide (ex: exemple@mail.com)` };
        }

        return null;
    }

    // NAME
    static nameValidator(controlName, minLength, maxLength, value) {
        let pattern = /^[A-Za-z-âéèçàù ]+$/;

        if (!value) {
            return { error: true, message: `${controlName} est obligatoire` };
        }

        if (!pattern.test(value)) {
            return { error: true, message: `${controlName} ne doit contenir que des lettres.` };
        }

        if (value.length < minLength) {
            return { error: true, message: `${controlName} doit contenir au moins ${minLength} lettres.` };
        }

        if (value.length > maxLength) {
            return { error: true, message: `${controlName} doit contenir au plus ${maxLength} lettres.` };
        }

        if (value.startsWith(" ") || value.endsWith(" ")) {
            return { error: true, message: `${controlName} ne doit pas commencer ou finir par un espace.` };
        }

        return null;
    }
}