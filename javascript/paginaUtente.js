const links = document.querySelectorAll('.sidebar ul li a');
const sections = document.querySelectorAll('.content-section');

for (let i = 0; i < links.length; i++) {
    links[i].addEventListener('click', function (event) {
        event.preventDefault();


        for (let j = 0; j < links.length; j++) {
            links[j].classList.remove('active');
        }

        this.classList.add('active');

        for (let k = 0; k < sections.length; k++) {
            sections[k].classList.remove('active');
        }

        const targetId = this.getAttribute('data-content');
        document.getElementById(targetId).classList.add('active');
    });
}
