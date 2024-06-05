function validaFormatoEmail(email) {
    let regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regexEmail.test(email);
}

function controllaEmailInUso(email, callback) {
    fetch('../php/registrazione.php?email=' + encodeURIComponent(email))
    .then(function(response) {
        return response.text();
    })
    .then(function(data) {
        callback(data === "in use");
    })
    .catch(function(error) {
        console.error('Errore nella verifica dell\'email:', error);
    });
}

function validaPassword(password, confermaPassword) {
    let lunghezzaMinima = 8;
    let contieneMaiuscola = /[A-Z]/.test(password);
    let contieneNumero = /\d/.test(password);
    let contieneSimbolo = /[\W_]/.test(password);

    if (password.length < lunghezzaMinima || !contieneMaiuscola || !contieneNumero || !contieneSimbolo) {
        alert("La password deve essere lunga almeno 8 caratteri e contenere una lettera maiuscola, un numero e un simbolo.");
        return false;
    }

    if (password !== confermaPassword) {
        alert("Le password non corrispondono. Riprova!");
        return false;
    }

    return true;
}

function inizializzaValidazioneForm() {
    let campoEmail = document.getElementById("email");
    let campoPassword = document.getElementById("password");
    let campoConfermaPassword = document.getElementById("conferma-password");
    let bottoneInvia = document.querySelector("button[type='submit']");
    let emailInUso = false;

    campoEmail.addEventListener("blur", function() {
        let email = campoEmail.value;
        if (!validaFormatoEmail(email)) {
            alert("Inserisci un indirizzo email valido.");
            return;
        }
        controllaEmailInUso(email, function(isInUso) {
            emailInUso = isInUso;
            if (emailInUso) {
                alert("L'email è già in uso. Scegli un'altra email.");
            }
        });
    });

    bottoneInvia.addEventListener("click", function(event) {
        let password = campoPassword.value;
        let confermaPassword = campoConfermaPassword.value;

        if (emailInUso || !validaPassword(password, confermaPassword)) {
            event.preventDefault();
        }
    });
}

document.addEventListener("DOMContentLoaded", inizializzaValidazioneForm);
