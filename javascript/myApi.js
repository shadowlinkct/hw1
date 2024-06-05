//document.addEventListener('DOMContentLoaded', caricaArticoli);

async function caricaArticoli() {
    try {
        const response = await fetch('myApi.php');
        const articoli = await response.json();
        mostraArticoli(articoli);
    } catch (error) {
        mostraErrore(error);
    }
}

function mostraArticoli(articoli) {
    const contenitore = document.querySelector('.contenitore-articoli');

    for (let i = 0; i < articoli.length; i++) {
        creaArticolo(articoli[i], contenitore);
    }

    fetch('myApi.php?preferiti=true')
        .then(response => response.json())
        .then(preferiti => {
            for (let i = 0; i < preferiti.length; i++) {
                const bookmark = document.getElementById('bookmark' + preferiti[i].id_articolo);
                if (bookmark) {
                    bookmark.src = '../img/bookmark.png';
                }
            }
        })
        .catch(error => console.error('Errore nel caricamento dei preferiti:', error));

    aggiungiEventiSegnalibro();
}


function creaArticolo(articolo, contenitore) {
    let articoloDiv;
    if(articolo.intestazione == 1){
        articoloDiv = document.createElement('div');
        articoloDiv.classList.add('largetabitem');
    }else if(articolo.intestazione == 2){
        articoloDiv = document.createElement('div');
        articoloDiv.classList.add('mediumtabitem');
    }else{
        articoloDiv = document.createElement('div');
        articoloDiv.classList.add('smalltabitem');
    }
    
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

    const contenitoreSegnalibro = document.createElement('div');
    contenitoreSegnalibro.classList.add('bookmark-container');

    const immagineSegnalibro = document.createElement('img');
    immagineSegnalibro.id = 'bookmark' + articolo.id;
    immagineSegnalibro.classList.add('bookmark');
    immagineSegnalibro.setAttribute('src', '../img/bookmarkno.png');
    immagineSegnalibro.dataset.articoloId = articolo.id;
    contenitoreSegnalibro.appendChild(immagineSegnalibro);

    descrizioneP.appendChild(contenitoreSegnalibro);
    articoloTextDiv.appendChild(descrizioneP);
    contenitore.appendChild(articoloDiv);
}

function aggiungiEvento(segnalibro) {
    segnalibro.addEventListener('click', async function () {
        const src = segnalibro.src;
        const articoloId = segnalibro.dataset.articoloId;
        let successo;
        if (src.includes('bookmarkno.png')) {
            successo = await salvaPreferito(articoloId);
            if (successo) {
                segnalibro.src = '../img/bookmark.png';
            }
        } else {
            successo = await rimuoviPreferito(articoloId);
            if (successo) {
                segnalibro.src = '../img/bookmarkno.png';
            }
        }
    });
}
function aggiungiEventiSegnalibro() {
    const segnalibri = document.querySelectorAll('.bookmark');
    for (let i = 0; i < segnalibri.length; i++) {
        aggiungiEvento(segnalibri[i]);
    }
}

async function salvaPreferito(articoloId) {
    try {
        const response = await fetch('myApi.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id_articolo: articoloId })
        });

        if (response.status === 401) {
            alert('Devi effettuare l\'accesso per salvare un preferito');
            return false;
        }

        const data = await response.json();
        console.log(data);
        return true;
    } catch (error) {
        console.error('Errore nel salvataggio del preferito:', error);
        return false;
    }
}

async function rimuoviPreferito(articoloId) {
    try {
        const response = await fetch('myApi.php', {
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
caricaArticoli();
