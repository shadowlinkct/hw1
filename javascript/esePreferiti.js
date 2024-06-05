async function caricaEse() {
    try {
        await mostraEsePreferiti();
    } catch (error) {
        mostraErrore(error);
    }
}

async function mostraEsePreferiti() {
    try {
        const response = await fetch('getEsePreferiti.php?preferiti=true');
        if (!response.ok) {
            throw new Error('Errore nel caricamento degli esercizi preferiti: ' + response.statusText);
        }
        const data = await response.json();
        mostraEsercizi(data);
    } catch (error) {
        console.error('Errore nel recupero degli esercizi preferiti:', error);
        throw new Error('Errore nel recupero degli esercizi preferiti: ' + error.message);
    }
}

function mostraErrore(error) {
    console.error('Si è verificato un errore:', error);
}

function mostraEsercizi(esercizi) {
    const contenitore = document.querySelector('.contenitore-esercizi');
    while (contenitore.firstChild) {
        contenitore.removeChild(contenitore.firstChild);
    }

    esercizi.forEach(esercizio => {
        const esercizioDiv = document.createElement('div');
        esercizioDiv.classList.add('smalltabitem');

        const esercizioContentDiv = document.createElement('div');
        esercizioContentDiv.classList.add('tabcontent');
        esercizioDiv.appendChild(esercizioContentDiv);

        const imageDiv = document.createElement('div');
        imageDiv.classList.add('imagetab');
        const image = document.createElement('img');
        image.src = esercizio.immagine;
        image.alt = 'Immagine';
        imageDiv.appendChild(image);
        esercizioContentDiv.appendChild(imageDiv);

        const esercizioTextDiv = document.createElement('div');
        esercizioTextDiv.classList.add('tabtext');
        esercizioContentDiv.appendChild(esercizioTextDiv);

        const titoloH4 = document.createElement('h4');
        titoloH4.textContent = esercizio.nome;
        esercizioTextDiv.appendChild(titoloH4);

        const descrizioneP = document.createElement('p');
        descrizioneP.textContent = esercizio.descrizione;
        esercizioTextDiv.appendChild(descrizioneP);

        const contenitoreSegnalibro = document.createElement('div');
        contenitoreSegnalibro.classList.add('bookmark-container');

        const immagineSegnalibro = document.createElement('img');
        immagineSegnalibro.id = 'bookmark' + esercizio.id;
        immagineSegnalibro.classList.add('bookmark');
        immagineSegnalibro.setAttribute('src', '../img/bookmark.png');
        immagineSegnalibro.dataset.esercizioId = esercizio.id;
        contenitoreSegnalibro.appendChild(immagineSegnalibro);

        descrizioneP.appendChild(contenitoreSegnalibro);
        contenitore.appendChild(esercizioDiv);

        aggiungiEventoSegnalibroEse(immagineSegnalibro);
    });
}

function aggiungiEventoSegnalibroEse(elementoSegnalibro) {
    elementoSegnalibro.addEventListener('click', function () {
        const idEsercizio = this.dataset.esercizioId;
        console.log('Segnalibro cliccato per esercizio ID:', idEsercizio);

        fetch('getEsePreferiti.php', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id_esercizio: idEsercizio })
        })
        .then(response => response.json())
        .then(data => {
            if (data.messaggio) {
                console.log(data.messaggio);
                elementoSegnalibro.closest('.smalltabitem').remove();
            } else if (data.errore) {
                console.error(data.errore);
            }
        })
        .catch(error => console.error('Errore nella rimozione dell\'esercizio:', error));
    });
}

const tabs = document.querySelectorAll('.tab');
const sections = document.querySelectorAll('.content-section');

tabs.forEach(tab => {
    tab.addEventListener('click', function() {
        tabs.forEach(t => t.classList.remove('active'));
        sections.forEach(s => s.classList.remove('active'));

        this.classList.add('active');
        const targetId = this.getAttribute('data-content');
        document.getElementById(targetId).classList.add('active');
    });
});

caricaEse().catch(error => console.error('Errore durante il caricamento degli esercizi:', error));
