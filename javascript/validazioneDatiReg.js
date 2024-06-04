// Funzione per validare il formato dell'email
function validaFormatoEmail(email) {
    let regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regexEmail.test(email);
}

// Funzione per controllare se l'email è in uso
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

// Funzione per validare la password
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

// Funzione principale per inizializzare il tutto
function inizializzaValidazioneForm() {
    let campoEmail = document.getElementById("email");
    let campoPassword = document.getElementById("password");
    let campoConfermaPassword = document.getElementById("conferma-password");
    let bottoneInvia = document.querySelector("button[type='submit']");
    let emailInUso = false;

    // Event listener per la verifica dell'email quando si perde il focus
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

    // Event listener per la verifica prima dell'invio del form
    bottoneInvia.addEventListener("click", function(event) {
        let password = campoPassword.value;
        let confermaPassword = campoConfermaPassword.value;

        if (emailInUso || !validaPassword(password, confermaPassword)) {
            event.preventDefault();
        }
    });
}

// Aggiunta dell'evento DOMContentLoaded per inizializzare il form
document.addEventListener("DOMContentLoaded", inizializzaValidazioneForm);
