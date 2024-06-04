//document.addEventListener('DOMContentLoaded', (event) => {

// GESTIONE DELLE SLIDE
let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

// Funzione per mostrare le slide
function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    for (i = 0; i < slides.length; i++) {
        slides[i].classList.remove("activeSlide");
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].classList.remove("actives");
    }
    slides[slideIndex - 1].classList.add("activeSlide");
    dots[slideIndex - 1].classList.add("actives");
}

// Aggiunta dell'evento click ai punti delle slide
for (let i = 1; i <= 3; i++) {
    let slideNumber = i <= 3 ? i : i - 3;
    function callbackFunction() {
        currentSlide(slideNumber);
    }
    document.querySelector("#dot" + i).addEventListener("click", callbackFunction);
}

// Funzioni per passare alla slide precedente o successiva
function prevSlide() {
    plusSlides(-1);
}

function nextSlide() {
    plusSlides(1);
}
document.querySelector('.prev').addEventListener('click', prevSlide);
document.querySelector('.next').addEventListener('click', nextSlide);

function scrollToOtherDiv() {
    // Ottieni l'elemento da mostrare
    let otherDiv = document.querySelector('.slideshow-div');

    // Scorri fino all'elemento
    otherDiv.scrollIntoView();
}

document.querySelector('#alink2').addEventListener('click', scrollToOtherDiv);
// GESTIONE DELLE SLIDE FINE
//});
