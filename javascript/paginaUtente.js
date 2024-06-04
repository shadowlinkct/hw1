const links = document.querySelectorAll('.sidebar ul li a');
const sections = document.querySelectorAll('.content-section');

for (let i = 0; i < links.length; i++) {
    links[i].addEventListener('click', function (event) {
        event.preventDefault();

        // Rimuovi la classe attiva da tutti i link
        for (let j = 0; j < links.length; j++) {
            links[j].classList.remove('active');
        }

        // Aggiungi la classe attiva al link cliccato
        this.classList.add('active');

        // Nascondi tutte le sezioni
        for (let k = 0; k < sections.length; k++) {
            sections[k].classList.remove('active');
        }

        // Mostra la sezione di destinazione
        const targetId = this.getAttribute('data-content');
        document.getElementById(targetId).classList.add('active');
    });
}
