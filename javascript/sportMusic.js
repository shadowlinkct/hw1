// Modulo API
var ClientID = 'ab44cf466d404c1194e90a7b7cd56e2f';
var secretKey = 'c9fe4d2f6b8d433e8f25294f86b26c2c';

async function onResponse(url, options) {
    const response = await fetch(url, options);
    const data = await response.json();
    return data;
}

async function ottieniToken() {
    const response = await fetch('get_token.php');
    const data = await response.json();
    return data.access_token;
}

async function ottieniGeneri(token) {
    const response = await fetch(`get_categories.php?token=${token}`);
    const data = await response.json();
    return data.categories.items;
}

async function ottieniPlaylistPerGenere(token, idGenere) {
    const response = await fetch(`get_playlists.php?token=${token}&idGenere=${idGenere}`);
    const data = await response.json();
    return data.playlists.items;
}


async function ottieniBrani(token, endPointBrani) {
    const response = await fetch(`get_tracks.php?token=${token}&endpoint=${encodeURIComponent(endPointBrani)}`);
    const data = await response.json();
    return data.items;
}


async function ottieniBrano(token, endPointBrano) {
    const response = await fetch(`get_tracks.php?token=${token}&endpoint=${encodeURIComponent(endPointBrano)}`);
    const data = await response.json();
    return data;
}


// Modulo UI
var elementiDOM = {
    //selectGenere: '#select_genre',
    selectPlaylist: '#select_playlist',
    pulsanteInvia: '#btn_submit',
    divDettaglioCanzone: '#song-detail',
    hiddenToken: '#hidden_token',
    divListaCanzoni: '.song-list'
};

function ottieniCampiInput() {
    return {
        genere: document.querySelector(elementiDOM.selectGenere),
        playlist: document.querySelector(elementiDOM.selectPlaylist),
        brani: document.querySelector(elementiDOM.divListaCanzoni),
        invia: document.querySelector(elementiDOM.pulsanteInvia),
        dettaglioCanzone: document.querySelector(elementiDOM.divDettaglioCanzone)
    }
}

function creaGenere(testo, valore) {
    const html = '<option value="' + valore + '">' + testo + '</option>';
    document.querySelector(elementiDOM.selectGenere).insertAdjacentHTML('beforeend', html);
}

function creaPlaylist(testo, valore) {
    const html = '<option value="' + valore + '">' + testo + '</option>';
    document.querySelector(elementiDOM.selectPlaylist).insertAdjacentHTML('beforeend', html);
}


function creaBrano(id, nome) {
    const divListaCanzoni = document.querySelector(elementiDOM.divListaCanzoni);

    const aElement = document.createElement('a');
    aElement.href = "#";
    aElement.id = id;
    aElement.textContent = nome;

    const brElement = document.createElement('br');

    divListaCanzoni.appendChild(aElement);
    divListaCanzoni.appendChild(brElement);
}



function creaDettaglioBrano(img, titolo, artista) {
    const divDettaglio = document.querySelector(elementiDOM.divDettaglioCanzone);
    divDettaglio.textContent = '';

    const imgElement = document.createElement('img');
    imgElement.src = img;
    divDettaglio.appendChild(imgElement);

    const titoloElement = document.createElement('p');
    titoloElement.textContent = "Titolo: " + titolo;
    divDettaglio.appendChild(titoloElement);

    const artistaElement = document.createElement('p');
    artistaElement.textContent = "Artista: " + artista;
    divDettaglio.appendChild(artistaElement);
}

function resettaDettaglioBrano() {
    ottieniCampiInput().dettaglioCanzone.textContent = '';
}

function resettaBrani() {
    ottieniCampiInput().brani.textContent = '';
    resettaDettaglioBrano();
}

function resettaPlaylist() {
    ottieniCampiInput().playlist.textContent = '';
    resettaBrani();
}


function memorizzaToken(valore) {
    document.querySelector(elementiDOM.hiddenToken).value = valore;
}

function ottieniTokenMemorizzato() {
    return {
        token: document.querySelector(elementiDOM.hiddenToken).value
    }
}

// Modulo App
/* async function caricaGeneri() {
    const token = await ottieniToken();
    memorizzaToken(token);
    const generi = await ottieniGeneri(token);
    for (let i = 0; i < generi.length; i++) {
        creaGenere(generi[i].name, generi[i].id);
    }
}
oppure ------------------

async function caricaGeneri() {
    const token = await ottieniToken();           
    memorizzaToken(token);
    const generi = await ottieniGeneri(token);
    let idGenereAllenamento;
    for (let i = 0; i < generi.length; i++) {
        if (generi[i].name.toLowerCase() === "allenamento") {
            creaGenere(generi[i].name, generi[i].id);
            idGenereAllenamento = generi[i].id;
            console.log('ID della categoria "allenamento":', idGenereAllenamento); // Aggiunta di console.log qui
            break;
        }
    }
    if (idGenereAllenamento) {
        const playlist = await ottieniPlaylistPerGenere(token, idGenereAllenamento);
        for (let j = 0; j < playlist.length; j++) {
            creaPlaylist(playlist[j].name, playlist[j].tracks.href);
        }
    }
}
*/
// Modulo App
async function caricaGeneri() {
    const token = await ottieniToken();
    memorizzaToken(token);
    const idGenereAllenamento = '0JQ5DAqbMKFAXlCG6QvYQ4';
    const playlist = await ottieniPlaylistPerGenere(token, idGenereAllenamento);
    for (let j = 0; j < playlist.length; j++) {
        creaPlaylist(playlist[j].name, playlist[j].tracks.href);
    }
}
/* 
campiInputDOM.genere.addEventListener('change', async function () {
    resettaPlaylist();
    const token = ottieniTokenMemorizzato().token;
    const selectGenere = ottieniCampiInput().genere;
    const idGenere = selectGenere.options[selectGenere.selectedIndex].value;
    const playlist = await ottieniPlaylistPerGenere(token, idGenere);
    playlist.forEach(function (p) {
        creaPlaylist(p.name, p.tracks.href);
    });
}); */
let campiInputDOM = ottieniCampiInput();
async function gestisciInvio(evento) {
    evento.preventDefault();
    resettaBrani();
    const token = ottieniTokenMemorizzato().token;
    const selectPlaylist = ottieniCampiInput().playlist;
    const endPointBrani = selectPlaylist.options[selectPlaylist.selectedIndex].value;
    const brani = await ottieniBrani(token, endPointBrani);
    for (const brano of brani) {
        creaBrano(brano.track.href, brano.track.name);
    }
}

campiInputDOM.invia.addEventListener('click', gestisciInvio);

campiInputDOM.brani.addEventListener('click', async function (e) {
    e.preventDefault();
    resettaDettaglioBrano();
    const token = ottieniTokenMemorizzato().token;
    const endPointBrano = e.target.id;
    const brano = await ottieniBrano(token, endPointBrano);
    creaDettaglioBrano(brano.album.images[2].url, brano.name, brano.artists[0].name);
});

function inizia() {
    console.log('L\'applicazione sta iniziando');
    caricaGeneri();
}

inizia();
