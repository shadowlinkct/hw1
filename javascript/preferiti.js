async function caricaArticoli() {
    try {
        await mostraArticoliPreferiti();
    } catch (error) {
        mostraErrore(error);
    }
}

async function mostraArticoliPreferiti() {
    try {
        const response = await fetch('getPreferiti.php?preferiti=true');
        const articoliPreferiti = await response.json();
        mostraArticoli(articoliPreferiti);
    } catch (error) {
        mostraErrore(error);
    }
}

function mostraArticoli(articoli) {
    const contenitore = document.querySelector('.contenitore-articoli');
    while (contenitore.firstChild) {
        contenitore.removeChild(contenitore.firstChild);
    }

    for (let i = 0; i < articoli.length; i++) {
        const articolo = articoli[i];
        const articoloDiv = document.createElement('div');
        articoloDiv.classList.add('smalltabitem');

        const articoloContentDiv = document.createElement('div');
        articoloContentDiv.classList.add('tabcontent');
        articoloDiv.appendChild(articoloContentDiv);

        const imageDiv = document.createElement('div');
        imageDiv.classList.add('imagetab');
        const image = document.createElement('img');
        image.src = articolo.immagine_principale;
        image.alt = 'Immagine';
        imageDiv.appendChild(image);
        articoloContentDiv.appendChild(imageDiv);

        const articoloTextDiv = document.createElement('div');
        articoloTextDiv.classList.add('tabtext');
        articoloContentDiv.appendChild(articoloTextDiv);

        const dataSpan = document.createElement('span');
        dataSpan.textContent = articolo.data + ' - ';
        articoloTextDiv.appendChild(dataSpan);

        const link = document.createElement('a');
        link.textContent = articolo.categoria || 'Link';
        link.setAttribute('href', articolo.link);
        link.classList.add('academy-link');
        dataSpan.appendChild(link);

        const titoloH4 = document.createElement('h4');
        titoloH4.textContent = articolo.titolo;
        articoloTextDiv.appendChild(titoloH4);

        const descrizioneP = document.createElement('p');
        descrizioneP.textContent = articolo.descrizione;
        articoloTextDiv.appendChild(descrizioneP);

        const contenitoreSegnalibro = document.createElement('div');
        contenitoreSegnalibro.classList.add('bookmark-container');

        const immagineSegnalibro = document.createElement('img');
        immagineSegnalibro.id = 'bookmark' + articolo.id;
        immagineSegnalibro.classList.add('bookmark');
        immagineSegnalibro.setAttribute('src', '../img/bookmark.png');
        immagineSegnalibro.dataset.articoloId = articolo.id;
        contenitoreSegnalibro.appendChild(immagineSegnalibro);

        descrizioneP.appendChild(contenitoreSegnalibro);
        contenitore.appendChild(articoloDiv);

        aggiungiEventoSegnalibro(immagineSegnalibro);
    }
}

function aggiungiEventoSegnalibro(segnalibro) {
    segnalibro.addEventListener('click', async function () {
        const articoloId = segnalibro.dataset.articoloId;
        const successo = await rimuoviPreferito(articoloId);
        if (successo) {
            const articoloDiv = segnalibro.closest('.largetabitem, .mediumtabitem, .smalltabitem');
            if (articoloDiv) {
                articoloDiv.remove();
            }
        }
    });
}

async function rimuoviPreferito(articoloId) {
    try {
        const response = await fetch('getPreferiti.php', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id_articolo: articoloId })
        });

        if (response.status === 401) {
            alert('Devi effettuare l\'accesso per rimuovere un preferito');
            return false;
        }

        const data = await response.json();
        console.log(data);
        return true;
    } catch (error) {
        console.error('Errore nella rimozione del preferito:', error);
        return false;
    }
}

function mostraErrore(error) {
    console.error('Errore nel caricamento degli articoli:', error);
}

function avviaPollingPreferiti() {
    setInterval(async () => {
        await mostraArticoliPreferiti();
    }, 5000); // Controlla ogni 5 secondi
}
caricaArticoli();
avviaPollingPreferiti();